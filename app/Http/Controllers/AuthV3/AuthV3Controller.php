<?php

namespace App\Http\Controllers\AuthV3;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Otp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;



class AuthV3Controller extends Controller
{
    /* ================= SIGNUP ================= */

    public function signupForm()
    {
        return view('authv3.signup');
    }

//   public function signupSubmit(Request $request)
// {
//     $request->validate([
//         'name'      => 'required|string|max:255',
//         'mobile_no' => 'required|digits:10|unique:users,mobile_no',
//         'email_id'  => 'required|email|unique:users,email_id',
//         'password'  => 'required|min:6',
//     ]);

//     $user = User::create([
//         'name'      => $request->name,
//         'email_id'  => $request->email_id,
//         'mobile_no' => $request->mobile_no,
//         'password'  => Hash::make($request->password), // ✅ REAL PASSWORD
//         'role_id'   => 1,
//     ]);

//     // OTP flow stays SAME
//     $this->generateOtp($user->id);
//     session()->put('otp_user_id', $user->id);

//     return redirect()->route('authv3.otp.form')
//         ->with('success', 'OTP sent to your mobile');
// }


    /* ================= LOGIN ================= */


public function signupSubmit(Request $request)
{
    $request->validate(
        [
            'name' => [
                'required',
                'regex:/^[a-zA-Z\s]+$/',
                'max:255',
            ],
            'mobile_no' => [
                'required',
                'digits:10',
            ],
            'email_id' => [
                'required',
                'email',
            ],
            'password' => [
                'required',
                'min:6',
            ],
        ],
        [
            'name.required'      => 'Full name is required',
            'name.regex'         => 'Name can contain only letters and spaces',
            'mobile_no.required' => 'Mobile number is required',
            'mobile_no.digits'   => 'Mobile number must be exactly 10 digits',
            'email_id.required'  => 'Email address is required',
            'email_id.email'     => 'Please enter a valid email address',
            'password.required'  => 'Password is required',
            'password.min'       => 'Password must be at least 6 characters',
        ]
    );

    $user = User::where('mobile_no', $request->mobile_no)
                ->orWhere('email_id', $request->email_id)
                ->first();

    if ($user) {

        if ($user->role_id == 1) {
            return back()
                ->withErrors(['mobile_no' => 'You already have a Finance account'])
                ->withInput();
        }

        $user->update([
            'role_id' => 1
        ]);

    } else {

        do {
            $referralCode = Str::upper(Str::random(8));
        } while (User::where('referral_code', $referralCode)->exists());

        $user = User::create([
            'name'          => $request->name,
            'email_id'      => $request->email_id,
            'mobile_no'     => $request->mobile_no,
            'password'      => Hash::make($request->password),
            'role_id'       => 1,
            'referral_code' => $referralCode,
        ]);
    }

    $this->generateOtp($user->id);
    session()->put('otp_user_id', $user->id);

    return redirect()->route('authv3.otp.form')
        ->with('success', 'OTP sent to your mobile');
}

    public function loginForm()
    {
        return view('authv3.login');
    }

    public function loginSubmit(Request $request)
    {
        $request->validate([
            'mobile_no' => 'required|digits:10',
        ]);

        $user = User::where('mobile_no', $request->mobile_no)->first();

        if (!$user) {
            return back()->withErrors([
                'mobile_no' => 'Mobile number not registered'
            ]);
        }

        $this->generateOtp($user->id);

        session()->put('otp_user_id', $user->id);

        return redirect()->route('authv3.otp.form')
            ->with('success', 'OTP sent to your mobile');
    }

    /* ================= OTP ================= */

    public function otpForm()
    {
        if (!session()->has('otp_user_id')) {
            return redirect()->route('authv3.login.form');
        }

        return view('authv3.verify_otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:4',
        ]);

        $userId = session('otp_user_id');

        if (!$userId) {
            return redirect()->route('authv3.login.form')
                ->withErrors('Session expired. Please try again.');
        }

        $otpRow = Otp::where('user_id', $userId)
            ->where('otp', $request->otp)
            ->where('is_verify', 0)
            ->where('expires_at', '>=', now())
            ->latest()
            ->first();

        if (!$otpRow) {
            return back()->withErrors([
                'otp' => 'Invalid or expired OTP'
            ]);
        }

        $otpRow->update(['is_verify' => 1]);

        Auth::loginUsingId($userId);
        User::where('id', $userId)->update([
            'last_login_at' => now()
        ]);
        session([
            'user_id'  => Auth::id(),
            'username' => Auth::user()->name,
            'role_id'  => Auth::user()->role_id,
        ]);

        // 🔐 clear otp session
        session()->forget('otp_user_id');

        // return redirect('/loans-list');
        return $this->redirectByRole(Auth::user());

    }

    /* ================= RESEND OTP ================= */

    public function resendOtp()
    {
        $userId = session('otp_user_id');

        if (!$userId) {
            return redirect()->route('authv3.signup.form')
                ->withErrors('Session expired. Please signup again.');
        }

        $this->generateOtp($userId);

        return redirect()->route('authv3.otp.form')
            ->with('success', 'OTP resent successfully');
    }

    /* ================= HELPER ================= */

    // private function generateOtp($userId)
    // {
    //     Otp::create([
    //         'user_id'    => $userId,
    //         'otp'        => rand(1000, 9999),
    //         'is_verify'  => 0,
    //         'expires_at'=> now()->addMinutes(5),
    //     ]);
    // }
    private function generateOtp($userId)
{
    // 🔹 get user
    $user = User::find($userId);
    if (!$user) {
        return;
    }

    // 🔹 generate OTP
    $otp = rand(1000, 9999);

    // 🔹 save OTP in DB (same as before)
    Otp::create([
        'user_id'     => $userId,
        'otp'         => $otp,
        'is_verify'   => 0,
        'expires_at'  => now()->addMinutes(5),
    ]);

    // 🔹 send OTP SMS via TwoFactor
    try {

        $apiKey = env('TWO_FACTOR_API_KEY');
        $sender = env('TWO_FACTOR_SENDER');
        $countryCode = env('TWO_FACTOR_COUNTRY_CODE');

        $mobile = $countryCode . $user->mobile_no;

        // TwoFactor API URL
        $url = "https://2factor.in/API/V1/{$apiKey}/SMS/{$mobile}/{$otp}/{$sender}";

        // CURL request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);

        $response = curl_exec($ch);
        curl_close($ch);

        // Optional: log response (debug)
        // \Log::info('TwoFactor OTP Response', ['response' => $response]);

    } catch (\Exception $e) {
        \Log::error('OTP SMS Failed', ['error' => $e->getMessage()]);
    }
}


public function loginWithEmail(Request $request)
{
    $request->validate([
        'email_id' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email_id', $request->email_id)->first();

    if (!$user) {
        return back()->withErrors([
            'email_id' => 'Email not registered'
        ]);
    }

    if (!Hash::check($request->password, $user->password)) {
        return back()->withErrors([
            'password' => 'Invalid email or password'
        ]);
    }

    Auth::loginUsingId($user->id);
    /* ✅ UPDATE LAST LOGIN TIME */
$user->update([
    'last_login_at' => now()
]);

    session([
        'user_id'  => $user->id,
        'username' => $user->name,
        'role_id'  => $user->role_id,
    ]);

    // return redirect('/loans-list');
    return $this->redirectByRole($user);
}



public function loginWithOtp(Request $request)
{
    // 1️⃣ Validate input
    $request->validate([
        'mobile_no' => 'required|digits:10',
    ]);

    // 2️⃣ Find user by mobile number
    $user = User::where('mobile_no', $request->mobile_no)->first();

    if (!$user) {
        return back()->withErrors([
            'mobile_no' => 'Mobile number not registered'
        ]);
    }

    // 3️⃣ Generate OTP (same helper used everywhere)
    $this->generateOtp($user->id);

    // 4️⃣ Store user id in session (same as signup OTP)
    session()->put('otp_user_id', $user->id);

    // 5️⃣ Redirect to OTP verification page
    return redirect()->route('authv3.otp.form')
        ->with('success', 'OTP sent to your mobile');
}


public function redirectToGoogle()
{
    return Socialite::driver('google')->redirect();
}

public function handleGoogleCallback()
{
    // ✅ Google sends ?code=xxxx here
    $googleUser = Socialite::driver('google')->user();

    // find existing user
    $user = User::where('email_id', $googleUser->getEmail())->first();

    // signup if not exists
    if (!$user) {
        $user = User::create([
            'name'     => $googleUser->getName(),
            'email_id' => $googleUser->getEmail(),
            'password' => Hash::make(uniqid()),
            'role_id'  => 1,
        ]);
    }

    // login user
    Auth::login($user);
    Auth::login($user);

/* ✅ UPDATE LAST LOGIN TIME */
$user->update([
    'last_login_at' => now()
]);


    // ✅ SAME redirect as OTP & Email login
    return redirect('/loans-list');
}

private function redirectByRole($user)
{
    // ✅ ADMIN
    if ($user->role_id == 4) {
        return redirect('/admin/dashboard');
    }

    // ✅ FINANCE / CUSTOMER
    if ($user->role_id == 1) {
        return redirect('/loans-list');
    }

    // fallback
    return redirect('/');
}








}
