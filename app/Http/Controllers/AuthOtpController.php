<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Otp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthOtpController extends Controller
{
    /* ================= SIGNUP ================= */

    public function showSignup()
    {
        return view('auth.signup');
    }

    public function signup(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'mobile_no' => 'required|digits:10',
            'email_id'  => 'required|email',
        ]);

        $user = User::firstOrCreate(
            ['mobile_no' => $request->mobile_no],
            [
                'name'     => $request->name,
                'email_id'=> $request->email_id,
                'password'=> bcrypt('dummy'),
                'role_id' => 1
            ]
        );

        $this->sendOtp($user->id);

        session(['otp_user_id' => $user->id]);

        return redirect()->route('otp.form');
    }

    /* ================= LOGIN ================= */

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'mobile_no' => 'required|digits:10'
        ]);

        $user = User::where('mobile_no', $request->mobile_no)->first();

        if (!$user) {
            return back()->withErrors(['mobile_no' => 'Mobile not registered']);
        }

        $this->sendOtp($user->id);
        session(['otp_user_id' => $user->id]);

        return redirect()->route('otp.form');
    }

    /* ================= OTP ================= */

    public function showOtp()
    {
        if (!session('otp_user_id')) {
            return redirect()->route('login.form');
        }
        return view('auth.verify_otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required|digits:4']);

        $userId = session('otp_user_id');

        $otp = Otp::where('user_id', $userId)
            ->where('otp', $request->otp)
            ->where('is_verify', 0)
            ->where('expires_at', '>=', now())
            ->latest()
            ->first();

        if (!$otp) {
            return back()->withErrors(['otp' => 'Invalid OTP']);
        }

        $otp->update(['is_verify' => 1]);

        Auth::loginUsingId($userId);

        session([
            'user_id' => $userId,
            'username'=> Auth::user()->name,
            'role_id' => Auth::user()->role_id
        ]);

        return redirect('/loans-list');
    }

    /* ================= HELPER ================= */

    private function sendOtp($userId)
    {
        Otp::create([
            'user_id'    => $userId,
            'otp'        => rand(1000, 9999),
            'is_verify'  => 0,
            'expires_at'=> now()->addMinutes(5)
        ]);
    }
}
