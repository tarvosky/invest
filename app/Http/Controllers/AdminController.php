<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Image;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\Redemption;
use App\Models\History;
use App\Models\User;
use App\Models\Invoice;
use App\Models\LicenseImage;
use App\Mail\StatusMail;
use App\Mail\CreditUserMail;
use App\Traits\Payment;
use Session;

class AdminController extends Controller
{
    use Payment;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function history()
    {
        $data = History::orderBy('id','Desc')->get();
        return view('admin.history',compact('data'));
    }

    public function invoice()
    {
        $data = Invoice::orderBy('id','Desc')->get();
        return view('admin.invoice',compact('data'));
    }

    public function edit(Announcement $announcement)
    {
        return view('admin.announcement')
        ->with('data', $announcement);
    }

    public function update(Request $request,Announcement $announcement)
    {
        $announcement->title= $request->title;
        $announcement->message= $request->message;
        $announcement->save();
        Session::flash('message', 'Successfully updated!');
        return  redirect()->route('admin.announcement',$announcement->id);
    }

    public function redemption()
    {
        $data = Redemption::orderBy('id','Desc')->get();
        return view('admin.redemption')
        ->with('data', $data);
    }

    public function redemptionEdit(Redemption $redemption)
    {
        return view('admin.redemption-edit')
        ->with('data', $redemption);
    }


    public function users()
    {
        $data = User::where('email_verified_at','!=',null)->orderBy('id','Desc')->get();
        return view('admin.users')
        ->with('data', $data);
    }

    public function redemptionUpdate(Request $request,Redemption $redemption)
    {
        if($request->status == "completed"){
            $content = "Your Order is complete, Check your wallet for confirmation";
            if($request->order_slug =="edit-picture"){
               $content = "Your Order is complete, Login to your backend you will see your requested picture under the Uploaded Title";
            }
            $data = [
                'ticket'    => "#".$request->ticket,
                'content'    => $content,
                'username'    => $request->username,
              ];
            // send email
            Mail::to($request->email)->send(new StatusMail($data));
        }

        $redemption->status = $request->status;
        $redemption->save();
        return redirect('admin/redemption');
    }

    public function editedPicture()
    {
        return view('admin.edited-picture');
    }

    public function postPicture(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'bail|required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'email' => 'bail|required|email|exists:users',
        ]);
        $user = User::where('email',$request->email)->first();
        $file = $request->file('image');
        // for save original image
        $ogImage = Image::make($file);
        $originalPath  = public_path('license/photo/');
        $newName = time().$file->getClientOriginalName();
        $ogImage =  $ogImage->save($originalPath.$newName);
        $ogImage->resize(120,120);
        $thumbPath  = public_path('license/photo/thumb/');
        $ogImage =  $ogImage->save($thumbPath.$newName);

        $d = LicenseImage::create([
                'user_id' => $user->id,
                'category' => 'young',
                'image' => $newName,
        ]);

        return back()->with('success','Image updated, update status now please')
                     ->with('image',$thumbPath.$newName);
    }


    public function creditUserForm(){
        return view('admin.credit-user-form');
    }

    public function creditUser(Request $request){

        $validatedData = $request->validate([
            'email' => 'bail|required|email|exists:users',
            'amount' => 'bail|required',
            'subject' => 'bail|required',
            'category' => 'bail|required',
            'description' => 'bail|required',
        ]);

        DB::transaction(function () use ($request) {
            $user = User::where('email', $request->email)->lockForUpdate()->firstOrFail(); // Use firstOrFail() for better error handling

            // Perform all database operations inside the transaction
            $this->add_to_wallet_and_update($user, $request->amount);
            $this->recordHistory($request->description, $user, $request->category);

            // Prepare data for the email
            $data = [
                'email'       => $request->email,
                'amount'      => $request->amount,
                'username'    => $user->username,
                'description' => $request->description,
                'subject'     => $request->subject,
            ];
        });




        return back()->with('success','Amount Sent');
    }
}
