<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Otp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;

class AuthV2Controller extends Controller
{
    /**
     * REGISTER USER
     */
    public function registerUserV2(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'mobile_no'  => 'required|digits:10|unique:users,mobile_no',
            'email_id'   => 'required|email|unique:users,email_id',
            'password'   => 'required|confirmed|min:6',
        ]);

        User::create([
            'name'      => $request->name,
            'mobile_no' => $request->mobile_no,
            'email_id'  => $request->email_id,
            'password'  => bcrypt($request->password),
            'role_id'   => 1,
        ]);

        return redirect('/login-mobile')
            ->with('success', 'Registered successfully. Please login.');
    }

    /**
     * SEND OTP
     */
    public function sendOtpV2(Request $request)
    {
        // clear old login
        Auth::logout();
        Session::flush();

        $request->validate([
            'mobile_no' => 'required|digits:10',
        ]);

        $user = User::where('mobile_no', $request->mobile_no)->first();

        if (!$user) {
            return back()->withErrors([
                'mobile_no' => 'Mobile number not registered'
            ]);
        }

        $otp = rand(100000, 999999);

        Otp::create([
            'user_id'    => $user->id,
            'otp'        => $otp,
            'is_verify'  => 0,
            'expires_at' => now()->addMinutes(5),
        ]);

        session()->put('otp_user_id', $user->id);

        return redirect('/verify-otp')
            ->with('success', "OTP sent (Testing OTP: $otp)");
    }

    /**
     * VERIFY OTP + LOGIN
     */
    public function verifyOtpV2(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        $userId = session('otp_user_id');

        if (!$userId) {
            return redirect('/login-mobile')
                ->withErrors('Session expired. Please login again.');
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

        $user = User::findOrFail($userId);

        Auth::login($user);

        // session store
        session([
            'user_id'  => $user->id,
            'username' => $user->name,
            'role_id'  => $user->role_id,
        ]);

        // 🔐 REMEMBER ME (30 days)
        Cookie::queue(
            Cookie::make('remember_user', $user->id, 43200)
        );

        return redirect()->route('loans.loans-list');
    }

    /**
     * RESEND OTP
     */
    public function resendOtp()
    {
        $userId = session('otp_user_id');

        if (!$userId) {
            return redirect('/login-mobile');
        }

        $otp = rand(100000, 999999);

        Otp::create([
            'user_id'    => $userId,
            'otp'        => $otp,
            'is_verify'  => 0,
            'expires_at' => now()->addMinutes(5),
        ]);

        return back()->with('success', "OTP resent (Testing OTP: $otp)");
    }

    /**
     * LOGIN WITH EMAIL + PASSWORD
     */
    public function loginWithEmail(Request $request)
    {
        $request->validate([
            'email_id' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt([
            'email_id' => $request->email_id,
            'password' => $request->password,
        ])) {
            return back()->withErrors([
                'email_id' => 'Invalid email or password'
            ]);
        }

        $user = Auth::user();

        session([
            'user_id'  => $user->id,
            'username' => $user->name,
            'role_id'  => $user->role_id,
        ]);

        // 🔐 REMEMBER ME
        Cookie::queue(
            Cookie::make('remember_user', $user->id, 43200)
        );

        return redirect()->route('loans.loans-list');
    }

    /**
     * LOGOUT
     */
    public function logout()
    {
        Auth::logout();
        Session::flush();
        Cookie::queue(Cookie::forget('remember_user'));

        return redirect('/login-mobile');
    }
}
