<?php

namespace App\Http\Controllers\AuthV3;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Otp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PropertyAuthController extends Controller
{
    /* ========== PROPERTY LOGIN PAGE ========== */
    public function loginForm()
    {
        return view('authv3.property-login');
    }

    /* ========== PROPERTY SIGNUP PAGE ========== */
    public function signupForm()
    {
        return view('authv3.property-signup');
    }

    /* ========== PROPERTY SIGNUP SUBMIT ========== */
  public function signupSubmit(Request $request)
{
    $request->validate([
        'name'      => 'required|string|max:255',
        'mobile_no' => 'required|digits:10',
        'email_id'  => 'required|email',
        'password'  => 'required|min:6',
    ]);

    // 🔍 Check if user already exists (by mobile OR email)
    $user = User::where('mobile_no', $request->mobile_no)
                ->orWhere('email_id', $request->email_id)
                ->first();

    if ($user) {

        // ❌ Already Property user
        if ($user->role_id == 2) {
            return back()->withErrors([
                'mobile_no' => 'You already have a Property account'
            ]);
        }

        // ✅ Existing Finance user → upgrade to Property
        $user->update([
            'role_id' => 2 // PROPERTY ROLE
        ]);

    } else {

        // ✅ Fresh user
        $user = User::create([
            'name'      => $request->name,
            'mobile_no' => $request->mobile_no,
            'email_id'  => $request->email_id,
            'password'  => Hash::make($request->password),
            'role_id'   => 2, // PROPERTY ROLE
        ]);
    }

    // 🔐 OTP
    $this->generateOtp($user->id);
    session(['property_otp_user_id' => $user->id]);

    return redirect()->route('property.otp.form')
        ->with('success', 'OTP sent successfully');
}


    /* ========== SEND OTP (LOGIN) ========== */
    public function loginWithOtp(Request $request)
    {
        $request->validate([
            'mobile_no' => 'required|digits:10',
        ]);

        $user = User::where('mobile_no', $request->mobile_no)->first();

        if (!$user) {
            return back()->withErrors(['mobile_no' => 'Mobile not registered']);
        }

        $this->generateOtp($user->id);
        session(['property_otp_user_id' => $user->id]);

        return redirect()->route('property.otp.form');
    }

    /* ========== OTP FORM ========== */
    public function otpForm()
    {
        if (!session()->has('property_otp_user_id')) {
            return redirect()->route('property.login');
        }

        return view('authv3.property-verify-otp');
    }

    /* ========== VERIFY OTP ========== */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:4',
        ]);

        $userId = session('property_otp_user_id');

        $otp = Otp::where('user_id', $userId)
            ->where('otp', $request->otp)
            ->where('is_verify', 0)
            ->where('expires_at', '>=', now())
            ->first();

        if (!$otp) {
            return back()->withErrors(['otp' => 'Invalid OTP']);
        }

        $otp->update(['is_verify' => 1]);

        Auth::loginUsingId($userId);

        session()->forget('property_otp_user_id');

        // 🔥 FINAL REDIRECT
        return redirect('/properties');
    }

    /* ========== OTP GENERATE ========== */
    private function generateOtp($userId)
    {
        Otp::create([
            'user_id'    => $userId,
            'otp'        => rand(1000, 9999),
            'is_verify'  => 0,
            'expires_at'=> now()->addMinutes(5),
        ]);
    }
}
