<?php

namespace App\Http\Controllers;
use App\Models\Package;
use App\Services\CryptoData;
use App\Services\InvestmentService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Traits\Payment;
use App\Mail\supportEmailToAdmin;
use App\Mail\supportEmail;
use App\Models\History;
use App\Models\User;

class HomeController extends Controller
{
    use Payment;
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $investmentService;

    public function __construct(InvestmentService $investmentService)
    {
        $this->investmentService = $investmentService;
        $this->middleware(['auth', 'verified'])->except('landing');
    }



    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function landing()
    {
        return view('auth.login');
    }


    public function index()
    {

        $user = auth()->user();
        $bonus = $user->referrer_bonus;

        $data = \App\Models\User::all();

        $ref_bonus = 0;
        for ($i = 0; $i < count($data); $i++) {
            $ref_bonus += $data[$i]->referrer_bonus;
        }

        if ($user->referrer_bonus == null || $user->referrer_bonus == "") {
            $bonus = 0;
        }

        // Crypto API logic
        $cryptoData = CryptoData::getCryptoData();

        $this->investmentService->processDailyPayouts($user);
        // Now, you can retrieve the data for your dashboard with accurate values
        $investment = $user->investments()->where('status', 'active')->first();
        // Box 1: Initial Deposit
        $initialDeposit = $investment ? $investment->initial_deposit : 0;
        // Box 2: Total Daily Incurred
        // Since we just ran the payouts, the total accrued today should be a single payout amount,
        // unless they have multiple active investments. Let's get the sum for the current day.
        $dailyIncurred = $investment ? $investment->dailyInterestPayouts()->whereDate('created_at', today())->sum('amount') : 0;

        $totalCapital = $user->wallet;



        $data = History::where('user_id',$user->id)->orderBy('id','Desc')->limit(3)->get();


        return view('home', compact('bonus', 'ref_bonus', 'cryptoData','initialDeposit', 'dailyIncurred', 'totalCapital','data'));
    }


    public function about()
    {
        return view('home.about');
    }

    public function testimony()
    {
        return view('home.testimonies');
    }


    public function profile()
    {
        return view('home.profile');
    }

    public function howItWorks()
    {
        return view('home.how-it-works');
    }

    public function comingsoon()
    {
        return view('home.coming-soon');
    }

    public function support()
    {
        return view('home.support');
    }
    public function postSupport(Request $request)
    {


        $this->validate($request, [
            'subject' => ['required', 'string'],
            'message' => ['required' ],
          ]);

          $to = $request->email;
          $username = $request->username;
          $subject = $request->subject;
          $comment = $request->message;
          $ticket = "#".$this->generateRandomString();

          $dataAdmin = [
           'username'  => $username,
           'subject'   => $subject,
           'ticket'    => $ticket,
           'comment'   => $comment,
           'email'   => $to,
         ];
         $data = [
           'username'  => $username,
           'subject'   => $subject,
           'ticket'    => $ticket,
         ];


       // send email
       Mail::to(env("SUPPORT_EMAIL"))->send(new supportEmailToAdmin($dataAdmin));
       Mail::to($to)->send(new supportEmail($data));
       return redirect()->back()->with('success','Your message has been sent and you will be contacted within the next 24hrs.');
    }


    public function history()
    {
        $user = auth()->user();
        $data = History::where('user_id',$user->id)->orderBy('id','Desc')->get();
        return view('home.history',compact('data'));
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }


    public function packages()
    {
        $packages = Package::all();
        return view('home.packages',compact('packages'));
    }


}
