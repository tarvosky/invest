<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Withdrawal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Custom;
use App\Models\Invoice;
use App\Traits\Payment;
use App\Models\Payment as Pay;
use App\Models\Redemption;
use App\Mail\redemption as mailRedeem;
use App\Mail\redemptionAdmin;
use App\Mail\Custom as CustomMail;
use App\Mail\CustomAdmin;
use App\Mail\PaymentMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Image;



class PaymentController extends Controller
{
    use Payment;

    public function __construct()
    {
        $this->middleware('auth', ['except' => 'ipn']);
        $this->middleware('verified', ['except' => 'ipn']);
    }


    public function balance(User $user)
    {
        return response()->json([
            'success'=>$user->wallet
        ]);
    }


    public function withdraw()
    {
        $data = Withdrawal::all();
        return view('payment.withdraw',compact('data'));
    }



    public function withdrawPost(Request $request)
    {
        $request->validate([
            'amount' => ['required', 'numeric', 'min:1'],
        ]);

        $user = Auth::user();


        if ($request->amount > $user->wallet) {
            return back()->withErrors([
                'amount' => 'Insufficient wallet balance.',
            ]);
        }


        $firstInvestment = $user->investments()->orderBy('start_date', 'asc')->first();

        if ($firstInvestment) {
            if (now()->diffInDays($firstInvestment->start_date) < 30) {
                return back()->withErrors([
                    'amount' => 'Withdrawals are not allowed until 30 days after your first investment.',
                ]);
            }
        } else {
            return back()->withErrors([
                'amount' => 'You must have an active investment before withdrawing.',
            ]);
        }


        Withdrawal::create([
            'user_id' => $user->id,
            'amount'  => $request->amount,
            'status'  => 'pending', // default
        ]);

        return redirect()
            ->route('payment.withdraw')
            ->with('success', 'Withdrawal request submitted successfully and is pending approval.');
    }


    public function customize($slug)
    {
        $data = Custom::where('slug',$slug)->first();
        return view('payment.customize',compact('data'));
    }

    public function customizePost(Request $request)
    {



        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        $user = auth()->user();
        if($request->amount > $user->wallet){
            return  redirect()->back()->withErrors("insufficient funds");
        }



           $file = $request->file('image');

           // for save original image
           $ogImage = Image::make($file);
           $originalPath  = public_path('custom/');
           $newName = time().$file->getClientOriginalName();
           $ogImage =  $ogImage->save($originalPath.$newName);
           $path ="custom/".$newName;
           $ticket = $this->generateRandomString();
           $data = $user->redemptions()->create([
            "amount"  => $request->amount,
            "address" => $request->description,
            "order_slug" => $request->slug,
            "status"  =>  "pending",
            "ticket"  => $ticket
           ]);
           $this->remove_from_wallet_and_update($user,$request->amount);  //update cost
           $this->recordHistory("Customised Order  at $".$request->amount,$user,"customize"); //update history

           $data = [
            'username'  => $user->username,
            'email'     => $user->email,
            'ticket'    => "#".$ticket,
            'amount'    => $request->amount,
            'description'    => $request->description,
            'path'    => $path,
          ];

        // send email
        Mail::to($user->email)->send(new CustomMail($data));
        Mail::to( env("SUPPORT_EMAIL"))->send(new customAdmin($data));
        return back()->with('success','Request has been sent. You will hear from us within 24hrs!');
    }


    public function index(Request $request)
    {
        $amount = $request->amount;
        $data = Invoice::where('user_id',auth()->user()->id)->orderBy('id','Desc')->get();
        return view('payment.form',compact('data','amount'));
    }




    public function addToWalletFromRef(Request $request)
    {

        $user = auth()->user();

        $this->validate($request, [
            'referrer_bonus' => ['required', 'numeric' ]
          ]);


        if($request->referrer_bonus < 10){
            return  redirect()->back()->withErrors("Minimum transfer amount is $10");
        }

        if($user->referrer_bonus < $request->referrer_bonus){
            return  redirect()->back()->withErrors("Insufficient Amount!");
        }

          $result = $user->referrer_bonus  - $request->referrer_bonus;

          $wallet = $user->wallet;
          $total = $wallet + $request->referrer_bonus;
          $user->wallet = $total;
          $user->referrer_bonus = $result;
          $user->save();


         $des = "Transferred  $". $request->referrer_bonus." into Wallet from ref bonus";
         $this->recordHistory($des,$user,"top-up-from-ref-bonus");
         return back()->with('success','transferred successfully .');

    }

    public function redeem()
    {

        $user = auth()->user();
        $data = Redemption::where('user_id',$user->id)->orderBy('id','Desc')->get();
        return view('payment.redeem',compact('data'));
    }


    public function redeemPost(Request $request)
    {
        $this->validate($request, [
            'amount' => ['required', 'numeric' ],
            'address' =>'required'
          ]);
        $user = auth()->user();
        if($request->amount > $user->referrer_bonus){
            return  redirect()->back()->withErrors("insufficient funds to withdraw!");
        }

        if($request->amount < 50){
            return  redirect()->back()->withErrors("minimum withdrawal amount is $50");
        }

        $ticket = $this->generateRandomString();
        $percent = 0.07 *  $request->amount;
        $amount  = $request->amount - $percent;
        $data = $user->redemptions()->create([
            "amount"  => $amount ,
            "address" => $request->address,
            "status"  =>  "pending",
            "ticket"  => $ticket
        ]);

        // update the remaining bonus
        $remains = $user->referrer_bonus - $request->amount;
        $user->referrer_bonus = $remains;
        $user->save();

        $data = [
            'username'  => $user->username,
            'email'  => $user->email,
            'ticket'   => "#".$ticket,
            'amount'    => $amount,
          ];

        // send email
        Mail::to($user->email)->send(new mailRedeem($data));
        Mail::to(env("SUPPORT_EMAIL"))->send(new redemptionAdmin($data));
        return back()->with('success','withdrawal request has been submitted!');
    }




    public function createInvoice($amount){
        $code = $this->generateRandomString(25);
        $address = $this->generateAddress();
        $status = -1;
        $ip = $this->getIp();
        $user = auth()->user();

        //dd($address,$ip,$amount);

        $user->invoices()->create([
            'code'=> $code,
            'address'=> $address,
            'ip'=> $ip,
            'amount'=> $amount,
            'status'=> $status,
        ]);
        return $code;
    }

    public function updateInvoiceStatus($code,$status){
        $pay = Invoice::where('code',$code)->first();
        $pay->status = $status;
        $pay->save();
    }

    protected function add_to_withdrawal($user,$amount){
        $w = $user->withdrawals()->create([
            'amount' => $amount
        ]);
    }



    public function postPayment(Request $request)
    {
        //dd(number_format($request->amount,2));
       // dd($request->all());
        $this->validate($request, [
            'amount' => ['required', 'numeric' ]
          ]);

          if($request->amount < 50){
            return  redirect()->back()->withErrors("Minimum Deposit is $50");
          }
        $code = $this->createInvoice($request->amount);
        return  redirect()->route('form.summary',[ 'item_name' => $request->item_name,'currency' => $request->currency,'code'=>$code,'amount' => $request->amount ] );

    }



    public function Address(Request $request,$code)
    {
      $data = Invoice::where('code',$code)->first();
      $btc  = $this->USDtoBTC($data->amount);
      return view('payment.address',compact('data','btc'));
    }

    public function formSummary(Request $request,$item_name,$currency,$amount,$code){
        return view('payment.form-summary',compact('item_name','currency','amount','code'));
    }


    public function ipn(Request $request)
    {




       // http://dl.local/payment/ipn?secret=al9cyT2mBkHm2YN7xxxxxx3433TYHU23sssa&addr=1FNqARc22mKNFiwXctMFbBJmJxfhFajKUP&status=2&txid=WarningThisIsAGeneratedTestPaymentAndNotARealBitcoinTransaction&value=20000

     //   $secretlocal = "al9cyT2mBkHm2YN7xxxxxx3433TYHU23sssa"; // Code in the callback, make sure this matches to what youve set


        //$secret = $request->secret;
        // // Get all these values
        $txid = $request->txid;
        $value = $request->value;
        $status = $request->status;
        $addr = $request->addr;
        $secret = $request->secret;



        //  Storage::put( 'test/test.txt', "mapping");
         // Storage::put( 'test/file.txt', $txid." ".$secret." ".$value." ".$addr." ".$status);  // stores in storage folder

        // // Check all are set
        if(empty($txid) || empty($value) || empty($addr) || empty($secret)){
            exit();
        }

        if($secret != config('services.blockonomics.secret_key')){
            exit();
        }

        // // Get invoice price

        $infon = Invoice::where('address',$addr)->first();
        $code = $infon->code;
        $price = $infon->amount;
        // Convert price to satoshi for check
        $price = $this->USDtoBTC($price);
        $priceSatochi = $price *10000000;


        Log::info('Blockonomics callback data received', [
            'txid' => $txid,
            'secret' => $secret,
            'addr' => $addr,
            'value' => $value,
            'status' => $status,
            'amount' => $infon->amount,
            'price' => $price
        ]);



        // Expired
        if($status < 0){
            exit();
        }

        if($value >= round($priceSatochi)){
            // Update invoice status
            $this->updateInvoiceStatus($code, $status);
            if($status == 2){
                // Correct amount paid and fully confirmed
                // Do whatever you want here once payment is correct
                 $user = User::find($infon->user_id);
                 // payment Bonus
                 //$percentage = $this->paymentBonusOn500Above1000($infon->amount);
                // $updatedAmount = $percentage + $infon->amount;
                $updatedAmount =  $infon->amount;
                 $this->add_to_wallet_and_update($user,$updatedAmount);
                 $this->recordHistory("paid $".$updatedAmount." into account",$user,"payment");

                $package = Package::where('price', $updatedAmount)->first();


                if ($package) {
                    $user->investments()->create([
                        'package_id'        => $package->id,
                        'initial_deposit'   => $updatedAmount,
                        'status'            => 'active',
                        'start_date'       => now(),
                        'last_payout_date'  => null, // No payouts yet
                    ]);
                }
                 $data = [
                    'username'  => $user->username,
                    'amount'    => $infon->amount,
                ];
                Mail::to(env("SUPPORT_EMAIL"))->send(new PaymentMail($data));
                //referal bonus
               // $this->referral_bonus($user,$infon->amount);



                //test
                // return response()->json([
                //     'txid'=>$txid,
                //     'secret'=>$secret,
                //     'addr'=> $addr,
                //     'value'=>$value,
                //     'status'=>$status,
                //     'amount'=> $infon->amount,
                //     'price'=> $price,
                //     'user'=>$user,
                // ]);
            }
        }else {
            // Buyer hasnt paid enough
            $this->updateInvoiceStatus($code, -2);
        }

    }


}
