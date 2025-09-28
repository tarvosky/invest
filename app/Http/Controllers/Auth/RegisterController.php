<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Traits\Payment;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    use Payment, RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the registration form.
     */
    public function showRegistrationForm(Request $request)
    {
        if ($request->has('ref')) {
            session(['referrer' => $request->query('ref')]);
        }

        return view('auth.register');
    }

    /**
     * Get a validator for an incoming registration request.
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'unique:users', 'alpha_dash', 'min:3', 'max:30'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => [
                'required',
                'string',
                'confirmed',
                Password::min(8)->letters()->numbers(),
            ],
            'captcha'  => ['required', 'captcha'],
        ]);
    }

    /**
     * Ajax endpoint to reload captcha.
     */
    public function reloadCaptcha()
    {
        return response()->json(['captcha' => captcha_img()]);
    }

    /**
     * Create a new user instance after a valid registration.
     */
    protected function create(array $data)
    {
        try {
            $referrer = User::whereUsername(session()->pull('referrer'))->first();

            Log::info('Registering user', [
                'name' => $data['name'],
                'username' => $data['username'],
                'email' => $data['email'],
                'referrer' => $referrer ? $referrer->username : null,
            ]);

            $user = User::create([
                'name'        => $data['name'],
                'username'    => $data['username'],
                'email'       => $data['email'],
                'referrer_id' => $referrer ? $referrer->id : null,
                'password'    => Hash::make($data['password']),
                'ip'          => $this->getIp(),
                'role'        => 'user',
                'wallet'      => 0,
            ]);

            Log::info('User registered successfully', ['id' => $user->id]);

            return $user;

        } catch (\Exception $e) {
            Log::error('User registration failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return back()->with('error', 'Something went wrong during registration. Please try again later.');
        }
    }
}
