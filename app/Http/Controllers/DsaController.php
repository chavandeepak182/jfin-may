<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class DsaController extends Controller
{
    /**
     * Dashboard
     */
    public function dashboard()
    {
        // ✅ Only DSA allowed
        if (Session::get('role_id') != config('constants.roles.dsa')) {
            return redirect()->route('login')->with('error', 'Unauthorized');
        }

        $totalDisbursedAmount = DB::table('loans')
            ->where('status', 'disbursed')
            ->sum('amount');

        $approvedLoans = DB::table('loans')
            ->where('status', 'approved')
            ->count();

        $rejectedLoans = DB::table('loans')
            ->where('status', 'rejected')
            ->count();

        return view('dsa.dashboard', compact(
            'totalDisbursedAmount',
            'approvedLoans',
            'rejectedLoans'
        ));
    }

    /**
     * Loan List
     */
    public function allLoans()
    {
        if (Session::get('role_id') != config('constants.roles.dsa')) {
            return redirect()->route('login')->with('error', 'Unauthorized');
        }

        $loans = DB::table('loans')
            ->join('users', 'loans.user_id', '=', 'users.id')
            ->select('loans.*', 'users.name')
            ->latest()
            ->get();

        return view('dsa.loans', compact('loans'));
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

        return view('dsa.profile', compact('user'));
    }

    /**
     * Change Password Form
     */
    public function changePasswordForm()
    {
        if (!Session::get('user_id')) {
            return redirect('/');
        }

        return view('dsa.change-password');
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

        if (!$user || !Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password incorrect']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password changed successfully');
    }


// ✅ PAGE LOAD (DSA DASHBOARD)
    public function index()
    {
        $totalDSA = DB::table('users')
            ->where('role_id', 5)
            ->whereNull('deleted_at')
            ->count();

        $states = DB::table('states')->orderBy('name')->get();

        return view('admin.dsa.index', compact('totalDSA', 'states'));
    }

    // ✅ LOAD DSA LIST (AJAX)
    public function loadDSAList(Request $request)
{
    $search = $request->search;

    $query = DB::table('users')
        ->leftJoin('profile', 'users.id', '=', 'profile.user_id')
        ->where('users.role_id', 5)
        ->whereNull('users.deleted_at');

    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('users.name', 'like', "%$search%")
              ->orWhere('users.email_id', 'like', "%$search%")
              ->orWhere('profile.mobile_no', 'like', "%$search%");
        });
    }

    $dsas = $query->select(
            'users.id',
            'users.name',
            'users.email_id',
            DB::raw('COALESCE(profile.mobile_no, users.mobile_no) as mobile_no'),
            'profile.city',
            'profile.state',
            'profile.pincode'
        )
        ->orderBy('users.created_at', 'desc')
        ->get();

    $html = view('admin.dsa.partials.list', compact('dsas'))->render();

    return response()->json([  // 🔥 THIS WAS MISSING
        'html' => $html
    ]);
}

    // ✅ ADD DSA (MAIN FUNCTION 🔥)
    public function store(Request $request)

    {
        
        // ✅ VALIDATION
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email_id'  => 'required|email|unique:users,email_id',
            'mobile_no' => 'required|digits:10|unique:users,mobile_no',
            'password'  => 'required|min:6',
            'state'     => 'required',
            'city'      => 'required',
            'pincode'   => 'required|digits:6',
        ]);

        DB::beginTransaction();

        try {

            // 🔥 INSERT USER
            $userId = DB::table('users')->insertGetId([
                'name'        => $request->full_name,
                'email_id'    => $request->email_id,
                'mobile_no'   => $request->mobile_no,
                'password'    => bcrypt($request->password),
                'role_id'     => 5, // DSA ROLE
                'created_at'  => now(),
                'updated_at'  => now()
            ]);

            // 🔥 INSERT PROFILE (IMPORTANT)
            DB::table('profile')->insert([
                'user_id'           => $userId,
                'mobile_no'         => $request->mobile_no,
                'city'              => $request->city,
                'state'             => $request->state,
                'pincode'           => $request->pincode,
                'created_at'        => now(),
                'updated_at'        => now()
            ]);

            DB::commit();

            return response()->json([
                'status' => 1,
                'msg' => 'DSA Added Successfully'
            ]);

        } catch (\Exception $e) {

            DB::rollback();

            return response()->json([
                'status' => 0,
                'msg' => 'Something went wrong',
                'error' => $e->getMessage()
            ]);
        }
    }
}