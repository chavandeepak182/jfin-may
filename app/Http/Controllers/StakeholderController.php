<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class StakeholderController extends Controller
{
    /**
     * Dashboard
     */
    public function dashboard()
    {
        // ✅ Only stakeholder allowed
        if (Session::get('role_id') != config('constants.roles.stakeholder')) {
            return redirect()->route('login')->with('error', 'Unauthorized');
        }

       $totalDisbursedAmount = DB::table('loans')
    ->where('status', 'disbursed')
    ->sum('amount');
        $approvedLoans = DB::table('loans')->where('status', 'approved')->count();
        $rejectedLoans = DB::table('loans')->where('status', 'rejected')->count();

        return view('stakeholder.dashboard', compact(
            'totalDisbursedAmount',
            'approvedLoans',
            'rejectedLoans'
        ));
    }

    /**
     * Loan List (example)
     */
    public function allLoans()
    {
        if (Session::get('role_id') != config('constants.roles.stakeholder')) {
            return redirect()->route('login')->with('error', 'Unauthorized');
        }

        $loans = DB::table('loans')
            ->join('users', 'loans.user_id', '=', 'users.id')
            ->select('loans.*', 'users.name')
            ->latest()
            ->get();

        return view('stakeholder.loans', compact('loans'));
    }

    /**
     * Profile
     */
    public function profile()
    {
        if (!Session::get('user_id')) {
            return redirect('/');
        }

        $user = User::find(Session::get('user_id'));

        return view('stakeholder.profile', compact('user'));
    }

    /**
     * Change Password Form
     */
    public function changePasswordForm()
    {
        if (!Session::get('user_id')) {
            return redirect('/');
        }

        return view('stakeholder.change-password');
    }

    /**
     * Update Password
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = User::find(Session::get('user_id'));

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password incorrect']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password changed successfully');
    }
}