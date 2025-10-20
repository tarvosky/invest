<?php

namespace App\Http\Controllers;
use App\Mail\ProfileSubmitted;
use App\Models\Package;
use App\Models\Profile;
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
        $this->middleware(['web','auth', 'verified','profile.completed'])->except('landing');
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

        $packages = Package::where("status", 1)->get();

        $minAmount = $packages->min('price');

        // Crypto API logic
        $cryptoData = CryptoData::getCryptoData();
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


        return view('home', compact('bonus', 'ref_bonus', 'cryptoData','initialDeposit', 'dailyIncurred', 'totalCapital','data','packages','minAmount'));
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



    public function profileDetails()
    {
        $user = auth()->user();
        $profile = $user->profile;
        return view('home.profile-details', compact('profile'));
    }


    public function storeProfile(Request $request)
    {
        $user = $request->user();

        // validation rules
        $rules = [
            'dob' => ['required','date','before:'.now()->subYears(18)->toDateString()], // example: require 18+
            'address' => ['required','string','max:255'],
            'phone' => ['required','string','max:50'],
            'id_type' => ['required','in:drivers_license,international_passport'],
            'id_front' => ['required','file','mimes:jpg,jpeg,png,pdf','max:5120'],
            'id_back' => ['nullable','file','mimes:jpg,jpeg,png,pdf','max:5120'],
        ];

        // if driver's license is selected, id_back is required
        if ($request->input('id_type') === 'drivers_license') {
            $rules['id_back'][] = 'required';
        }

        $validated = $request->validate($rules);

        // store files in a user-specific folder (private)
        $folder = "profiles/{$user->id}";
        $frontPath = $request->file('id_front')->store($folder); // stored in storage/app/profiles/{id}/...
        $backPath = $request->hasFile('id_back') ? $request->file('id_back')->store($folder) : null;

        // create or update profile
        $profile = Profile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'dob' => $validated['dob'],
                'address' => $validated['address'],
                'phone' => $validated['phone'],
                'id_type' => $validated['id_type'],
                'id_front_path' => $frontPath,
                'id_back_path' => $backPath,
            ]
        );

        // send email with attachments
        $receiver = config('app.profile_receiver') ?? env('PROFILE_RECEIVER_EMAIL');

        if ($receiver) {
            Mail::to($receiver)->send(new ProfileSubmitted($user, $profile));
        }

        return redirect()->route('profile')->with('success', 'Profile submitted successfully. Thank you!');
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
        $packages = Package::where('status',1)->get();
        return view('home.packages',compact('packages'));
    }


}
