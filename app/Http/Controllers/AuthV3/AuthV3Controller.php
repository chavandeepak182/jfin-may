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
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;


class AuthV3Controller extends Controller
{
    /* ================= SIGNUP ================= */

    public function signupForm()
    {
        return view('authv3.signup');
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
        'otp' => 'required|digits_between:4,6',
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
        return back()->withErrors(['otp' => 'Invalid or expired OTP']);
    }

    try {

        // ✅ mark verified
        $otpRow->update(['is_verify' => 1]);

        // login user
      Auth::loginUsingId($userId);

User::where('id', $userId)->update([
    'last_login_at' => now(),
    'is_email_verify' => 1
]);

        session([
            'user_id'  => Auth::id(),
            'username' => Auth::user()->name,
            'role_id'  => Auth::user()->role_id,
        ]);

        $purpose = session('otp_purpose');

// mark OTP verified
$otpRow->update(['is_verify' => 1]);

if ($purpose === 'forgot_password') {

    session()->forget('otp_purpose');

    return redirect()->route('authv3.reset.form');
}

// NORMAL LOGIN / SIGNUP FLOW
Auth::loginUsingId($userId);

User::where('id', $userId)->update([
    'last_login_at' => now()
]);

session([
    'user_id'  => Auth::id(),
    'username' => Auth::user()->name,
    'role_id'  => Auth::user()->role_id,
]);

session()->forget('otp_user_id');

return $this->redirectByRole(Auth::user());


    } catch (\Throwable $e) {
        \Log::error('OTP verify failed', ['error' => $e->getMessage()]);
        return back()->withErrors(['otp' => 'OTP verification failed']);
    }
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
    $user = User::find($userId);
    if (!$user) return false;

    try {

        $apiKey = config('services.twofactor.api_key');
        $mobile = "91" . $user->mobile_no;
        $templateName = "Register";

        // Generate OTP
        $otp = rand(100000, 999999);

        // 2Factor Endpoint
        $url = "https://2factor.in/API/V1/{$apiKey}/SMS/{$mobile}/{$otp}/{$templateName}";

        // FORCE IPv4 (fix for server 404)
        $response = Http::withOptions([
            'force_ip_resolve' => 'v4'
        ])->timeout(20)->get($url);

        // Raw log
        \Log::info("OTP API RAW", [
            'status' => $response->status(),
            'body'   => $response->body()
        ]);

        if (!$response->successful()) {
            return false;
        }

        $json = $response->json();

        // If response is not JSON
        if (!is_array($json)) {
            \Log::error("OTP INVALID RESPONSE", [
                'raw' => $response->body()
            ]);
            return false;
        }

        // If API failed
        if (($json['Status'] ?? '') !== 'Success') {
            \Log::error("OTP API FAILED", $json);
            return false;
        }

        // Delete old OTPs
        Otp::where('user_id', $userId)->delete();

        // Insert new OTP
        Otp::create([
            'user_id'    => $userId,
            'otp'        => $otp,
            'session_id' => null,
            'is_verify'  => 0,
            'expires_at' => now()->addMinutes(10),
        ]);

        return true;

    } catch (\Throwable $e) {
        \Log::error("OTP Send Exception", [
            'error' => $e->getMessage()
        ]);
        return false;
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
    // ADMIN
    if ($user->role_id == 4) {
        return redirect('/admin/dashboard');
    }

    // AGENT
    if ($user->role_id == 2) {
        return redirect('/agent/agentDashboard');
    }

    // PARTNER
    if ($user->role_id == 3) {
        return redirect('/partner/partnerDashboard');
    }

    // BROKER
    if ($user->role_id == 5) {
        return redirect('/broker/allLoansApplications');
    }

  // ✅ DSA redirect
if ($user->role_id == config('constants.roles.dsa')) {
    return redirect()->route('dsa.dashboard');
}

    // CUSTOMER
    if ($user->role_id == 1) {
        return redirect('/loans-list');
    }

    // fallback
    return redirect('/');
}

public function forgotForm()
{
    return view('authv3.forgot_password');
}
public function forgotSubmit(Request $request)
{
    $request->validate([
        'mobile_no' => 'required|digits:10',
    ]);

    $user = User::where('mobile_no', $request->mobile_no)->first();

    if (!$user) {
        return back()->withErrors(['mobile_no' => 'Mobile number not registered']);
    }

    $this->generateOtp($user->id);

    session()->put('otp_user_id', $user->id);
    session()->put('otp_purpose', 'forgot_password');

    return redirect()->route('authv3.otp.form')
        ->with('success', 'OTP sent to reset password');
}
public function resetForm()
{
    if (!session()->has('otp_user_id')) {
        return redirect()->route('authv3.login.form');
    }

    return view('authv3.reset_password');
}
public function resetPassword(Request $request)
{
    $request->validate([
        'password' => 'required|min:6|confirmed',
    ]);

    $userId = session('otp_user_id');

    User::where('id', $userId)->update([
        'password' => Hash::make($request->password),
    ]);

    session()->forget('otp_user_id');

    return redirect()->route('authv3.login.form')
        ->with('success', 'Password reset successfully');
}
// for mobile application
public function apiSignup(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|regex:/^[a-zA-Z\s]+$/|max:255',
        'mobile_no' => 'required|digits:10',
        'email_id' => 'required|email',
        'password' => 'required|min:6',
    ]);

    if ($validator->fails()) {
        return response()->json(['status'=>false,'errors'=>$validator->errors()],422);
    }

    $user = User::where('mobile_no',$request->mobile_no)
        ->orWhere('email_id',$request->email_id)->first();

    if ($user) {
        if ($user->role_id == 1) {
            return response()->json([
                'status'=>false,
                'message'=>'Already registered'
            ],409);
        }

        $user->update(['role_id'=>1]);

    } else {

        do {
            $referralCode = Str::upper(Str::random(8));
        } while (User::where('referral_code',$referralCode)->exists());

        $user = User::create([
            'name'=>$request->name,
            'email_id'=>$request->email_id,
            'mobile_no'=>$request->mobile_no,
            'password'=>Hash::make($request->password),
            'role_id'=>1,
            'referral_code'=>$referralCode,
        ]);
    }

    $this->generateOtp($user->id);

    return response()->json([
        'status'=>true,
        'message'=>'OTP sent',
        'user_id'=>$user->id
    ]);
}
public function apiLoginWithEmail(Request $request)
{
    $request->validate([
        'email_id'=>'required|email',
        'password'=>'required'
    ]);

    $user = User::where('email_id',$request->email_id)->first();

    if (!$user || !Hash::check($request->password,$user->password)) {
        return response()->json([
            'status'=>false,
            'message'=>'Invalid credentials'
        ],401);
    }

    $user->update(['last_login_at'=>now()]);

    return response()->json([
        'status'=>true,
        'message'=>'Login successful',
        'data'=>$user
    ]);
}
public function apiSendLoginOtp(Request $request)
{
    $request->validate([
        'mobile_no'=>'required|digits:10'
    ]);

    $user = User::where('mobile_no',$request->mobile_no)->first();

    if (!$user) {
        return response()->json([
            'status'=>false,
            'message'=>'User not found'
        ],404);
    }

    $this->generateOtp($user->id);

    return response()->json([
        'status'=>true,
        'message'=>'OTP sent',
        'user_id'=>$user->id
    ]);
}
// public function apiVerifyOtp(Request $request)
// {
//     $request->validate([
//         'user_id'=>'required',
//         'otp'=>'required|digits_between:4,6'
//     ]);

//     $otpRow = Otp::where('user_id',$request->user_id)
//         ->where('otp',$request->otp)
//         ->where('is_verify',0)
//         ->where('expires_at','>=',now())
//         ->latest()
//         ->first();

//     if (!$otpRow) {
//         return response()->json([
//             'status'=>false,
//             'message'=>'Invalid or expired OTP'
//         ],400);
//     }

//     $otpRow->update(['is_verify'=>1]);

//     $user = User::find($request->user_id);

//     $user->update([
//         'last_login_at'=>now(),
//         'is_email_verify'=>1
//     ]);

//     return response()->json([
//         'status'=>true,
//         'message'=>'OTP verified',
//         'data'=>$user
//     ]);
// }
public function apiVerifyOtp(Request $request)
{
    $request->validate([
        'user_id'=>'required',
        'otp'=>'required|digits_between:4,6'
    ]);

    $otpRow = Otp::where('user_id',$request->user_id)
        ->where('otp',$request->otp)
        ->where('is_verify',0)
        ->where('expires_at','>=',now())
        ->latest()
        ->first();

    if (!$otpRow) {
        return response()->json([
            'status'=>false,
            'message'=>'Invalid or expired OTP'
        ],400);
    }

    // ✅ mark verified
    $otpRow->update(['is_verify'=>1]);

    $user = User::find($request->user_id);

    $user->update([
        'last_login_at'=>now(),
        'is_email_verify'=>1
    ]);

    // 🔥 CREATE TOKEN HERE
    $token = $user->createToken('mobile')->plainTextToken;

    return response()->json([
        'status'=>true,
        'message'=>'OTP verified successfully',
        'token'=>$token,
        'user'=>$user
    ]);
}
public function apiResendOtp(Request $request)
{
    $request->validate([
        'user_id'=>'required'
    ]);

    $this->generateOtp($request->user_id);

    return response()->json([
        'status'=>true,
        'message'=>'OTP resent'
    ]);
}
public function apiForgotPassword(Request $request)
{
    $request->validate([
        'mobile_no'=>'required|digits:10'
    ]);

    $user = User::where('mobile_no',$request->mobile_no)->first();

    if (!$user) {
        return response()->json([
            'status'=>false,
            'message'=>'User not found'
        ],404);
    }

    $this->generateOtp($user->id);

    return response()->json([
        'status'=>true,
        'message'=>'OTP sent for reset',
        'user_id'=>$user->id
    ]);
}
public function apiResetPassword(Request $request)
{
    $request->validate([
        'user_id'=>'required',
        'password'=>'required|min:6|confirmed'
    ]);

    User::where('id',$request->user_id)->update([
        'password'=>Hash::make($request->password)
    ]);

    return response()->json([
        'status'=>true,
        'message'=>'Password reset successful'
    ]);
}





}
