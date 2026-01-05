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
    /* ================= PROPERTY LOGIN PAGE ================= */
    public function loginForm()
    {
        return view('authv3.property-login');
    }

    /* ================= PROPERTY SIGNUP PAGE ================= */
    public function signupForm()
    {
        return view('authv3.property-signup');
    }

    /* ================= PROPERTY SIGNUP SUBMIT ================= */
    public function signupSubmit(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'mobile_no' => 'required|digits:10',
            'email_id'  => 'required|email',
            'password'  => 'required|min:6',
        ]);

        // Check existing user (mobile OR email)
        $user = User::where('mobile_no', $request->mobile_no)
                    ->orWhere('email_id', $request->email_id)
                    ->first();

        if ($user) {

            // Already property user
            if ($user->role_id == 2) {
                return back()->withErrors([
                    'mobile_no' => 'You already have a Property account'
                ]);
            }

            // Upgrade finance → property
            $user->update(['role_id' => 2]);

        } else {

            // New property user
            $user = User::create([
                'name'      => $request->name,
                'mobile_no' => $request->mobile_no,
                'email_id'  => $request->email_id,
                'password'  => Hash::make($request->password),
                'role_id'   => 2,
            ]);
        }

        // Send OTP
        $this->generateAndSendOtp($user);

        session(['property_otp_user_id' => $user->id]);

        return redirect()->route('property.otp.form')
            ->with('success', 'OTP sent successfully');
    }

    /* ================= LOGIN WITH OTP ================= */
    public function loginWithOtp(Request $request)
    {
        $request->validate([
            'mobile_no' => 'required|digits:10',
        ]);

        $user = User::where('mobile_no', $request->mobile_no)->first();

        if (!$user) {
            return back()->withErrors(['mobile_no' => 'Mobile not registered']);
        }

        $this->generateAndSendOtp($user);

        session(['property_otp_user_id' => $user->id]);

        return redirect()->route('property.otp.form')
            ->with('success', 'OTP sent successfully');
    }

    /* ================= OTP FORM ================= */
    public function otpForm()
    {
        if (!session()->has('property_otp_user_id')) {
            return redirect()->route('property.login');
        }

        return view('authv3.property-verify-otp');
    }

    /* ================= VERIFY OTP ================= */
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
                  ->latest()
                  ->first();

        if (!$otp) {
            return back()->withErrors(['otp' => 'Invalid or expired OTP']);
        }

        $otp->update(['is_verify' => 1]);

        Auth::loginUsingId($userId);

        session()->forget('property_otp_user_id');

        return redirect('/properties')
            ->with('success', 'Login successful');
    }

    /* ================= GENERATE + SEND OTP ================= */
    private function generateAndSendOtp(User $user)
    {
        // Invalidate old OTPs
        Otp::where('user_id', $user->id)->update(['is_verify' => 1]);

        $otpCode = rand(1000, 9999);

        // Save OTP
        Otp::create([
            'user_id'    => $user->id,
            'otp'        => $otpCode,
            'is_verify'  => 0,
            'expires_at'=> now()->addMinutes(5),
        ]);

        // Send OTP via 2Factor
        $mobile = env('TWO_FACTOR_COUNTRY_CODE') . $user->mobile_no;

        $url = "https://2factor.in/API/V1/"
             . env('TWO_FACTOR_API_KEY')
             . "/SMS/{$mobile}/{$otpCode}/"
             . env('TWO_FACTOR_SENDER');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);

        curl_exec($ch);
        curl_close($ch);
    }
}
