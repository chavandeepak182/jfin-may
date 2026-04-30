<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Loan;
use App\Exports\MisExport;
use Maatwebsite\Excel\Facades\Excel;

class DsaController extends Controller
{
    /**
     * Dashboard
     */
   public function dashboard()
{
    if (Session::get('role_id') != 6) {
        return redirect()->route('login')->with('error', 'Unauthorized');
    }

    $userId = Session::get('user_id');

    // ✅ COMMON FILTER (IMPORTANT)
    $filter = function ($q) use ($userId) {
        $q->whereIn('user_id', function($sub) use ($userId) {
            $sub->select('user_id')
                ->from('dsa_customers')
                ->where('dsa_id', $userId);
        });
    };

    // ✅ TOTAL LOANS (DSA WISE)
    $totalLoans = DB::table('loans')
        ->where($filter)
        ->count();

    // ✅ TOTAL DISBURSED AMOUNT (DSA WISE)
    $totalDisbursedAmount = DB::table('loans')
        ->where('status', 'disbursed')
        ->where($filter)
        ->sum('amount');

    // ✅ TOTAL MIS (DSA WISE)
    $totalMIS = DB::table('mis')
        ->where('created_by', $userId)
        ->count();

        $totalCustomers = DB::table('dsa_customers')
    ->where('dsa_id', Session::get('user_id'))
    ->count();
    return view('dsa.dashboard', compact(
        'totalLoans',
        'totalDisbursedAmount',
        'totalMIS',
        'totalCustomers'
    ));
}



public function exportDsaMIS()
{
    // 👇 Force DSA mode
    return Excel::download(new MisExport('dsa_only', 0), 'dsa_mis.xlsx');
}

    
public function allLoans()
{
    if (Session::get('role_id') != 6) {
        return redirect()->route('login')->with('error', 'Unauthorized');
    }

    $userId = Session::get('user_id');

    // 🔥 COMMON FILTER
    $filter = function ($q) use ($userId) {
        $q->whereIn('user_id', function($sub) use ($userId) {
            $sub->select('user_id')
                ->from('dsa_customers')
                ->where('dsa_id', $userId);
        });
    };

    /* ================= COUNTS ================= */

    $totalLoans = Loan::where($filter)->count();

    $inProcessLoans = Loan::where('status', 'in process')
        ->where($filter)
        ->count();

    $trashedloans = Loan::onlyTrashed()
        ->where($filter)
        ->count();

    $approvedLoan = Loan::where('status', 'approved')
        ->where($filter)
        ->count();

    $disbursedLoans = Loan::where('status', 'disbursed')
        ->whereNotNull('loan_reference_id')
        ->where($filter)
        ->count();

    $rejectedLoans = Loan::where('status', 'rejected')
        ->where($filter)
        ->count();

    $pendingLoansCount = Loan::where(function ($query) {
            $query->whereNull('agent_id')
                  ->orWhereIn('agent_action', ['rejected', null]);
        })
        ->where($filter)
        ->count();

    /* ================= LOANS ================= */

    $loans = Loan::with([
            'user.profile.cityRelation',
            'loanCategory',
            'bankDetails'
        ])
        ->where($filter)
        ->orderBy('created_at', 'desc')
        ->paginate(10);

    return view('admin.admin-loans', compact(
        'totalLoans',
        'inProcessLoans',
        'trashedloans',
        'approvedLoan',
        'disbursedLoans',
        'rejectedLoans',
        'loans',
        'pendingLoansCount'
    ));
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
        ->where('users.role_id', 6)
        ->whereNull('deleted_at')
        ->count();
         $query = DB::table('mis')
        ->join('users', 'mis.created_by', '=', 'users.id')
        ->where('users.role_id', 6);

    // 🔥 COUNT
    $total = $query->count();

    $totalCustomers = DB::table('dsa_customers')->count(); // 🔥 ADD

    $states = DB::table('states')->orderBy('name')->get();
    $totalCustomerLoans = DB::table('loans')
    ->join('dsa_customers', 'loans.user_id', '=', 'dsa_customers.user_id')
    ->count();

    return view('admin.dsa.index', compact('totalDSA', 'states','totalCustomerLoans', 'totalCustomers','total'));
}


public function loadAllCustomers(Request $request)
{
    try {

        $query = DB::table('dsa_customers')
            ->leftJoin('states', 'dsa_customers.state_id', '=', 'states.id')
            ->leftJoin('cities', 'dsa_customers.city_id', '=', 'cities.id');

        // 🔍 SEARCH ADD
        if ($request->search) {
            $query->where(function($q) use ($request){
                $q->where('dsa_customers.name','like',"%{$request->search}%")
                  ->orWhere('dsa_customers.email','like',"%{$request->search}%")
                  ->orWhere('dsa_customers.mobile_no','like',"%{$request->search}%");
            });
        }

        $customers = $query->select(
            'dsa_customers.id',
            'dsa_customers.name',
            'dsa_customers.mobile_no',
            'dsa_customers.email',
            'states.name as state_name',
            'cities.city as city_name'
        )->get();

        $html = view('admin.dsa.customers.partials.list', compact('customers'))->render();

        return response()->json(['html' => $html]);

    } catch (\Exception $e) {

        return response()->json([
            'error' => $e->getMessage()
        ]);
    }
}
    // ✅ LOAD DSA LIST (AJAX)

public function loadDSAList(Request $request)
{
    try {

        $query = DB::table('users')
            ->leftJoin('profile', 'users.id', '=', 'profile.user_id')
            ->leftJoin('cities', 'profile.city', '=', 'cities.id')
            ->leftJoin('states', 'profile.state', '=', 'states.id')
            ->where('users.role_id', 6);

        // 🔍 SEARCH ADD
        if ($request->search) {
            $query->where(function($q) use ($request){
                $q->where('users.name','like',"%{$request->search}%")
                  ->orWhere('users.email_id','like',"%{$request->search}%")
                  ->orWhere('users.mobile_no','like',"%{$request->search}%");
            });
        }
$dsas = $query->select(
    'users.id',
    'users.name',
    'users.email_id',
    DB::raw('COALESCE(profile.mobile_no, users.mobile_no) as mobile_no'),
    'cities.city as city_name',
    'states.name as state_name',
    'profile.pincode',
    'profile.pan_number as pan_no',
    'users.dsa_code' // 🔥 MUST ADD
)->get();

        $html = view('admin.dsa.partials.list', compact('dsas'))->render();

        return response()->json(['html' => $html]);

    } catch (\Exception $e) {
        return response()->json([
            'html' => '<tr><td colspan="7">'.$e->getMessage().'</td></tr>'
        ]);
    }
}
public function edit($id)
{
    $data = DB::table('users')
        ->leftJoin('profile', 'users.id', '=', 'profile.user_id')
        ->where('users.id', $id)
        ->select(
            'users.id',
            'users.name',
            'users.email_id',
            'users.mobile_no',
            'profile.pan_number',
            'profile.residence_address',
            'profile.dob',
            'profile.city',
            'profile.state',
             'profile.pincode' // 🔥 ADD THIS
        )
        ->first();

    return response()->json($data);
}

public function checkDuplicate(Request $request)
{
    $exists = false;

    if ($request->field == 'mobile_no') {
        $exists = DB::table('users')
            ->where('mobile_no', $request->value)
            ->exists();
    }

    if ($request->field == 'email_id') {
        $exists = DB::table('users')
            ->where('email_id', $request->value)
            ->exists();
    }

    if ($request->field == 'pan_no') {
        $exists = DB::table('profile')
            ->where('pan_number', $request->value)
            ->exists();
    }

    return response()->json(['exists' => $exists]);
}
  // ✅ ADD DSA (MAIN FUNCTION 🔥)
public function store(Request $request)
{
    DB::beginTransaction();

    try {

        // 🔥 UPDATED VALIDATION
        if ($request->id) {

            // ✅ EDIT
            $request->validate([
                'full_name' => 'required',
                'email_id' => 'required|email|unique:users,email_id,' . $request->id,
                'mobile_no' => 'required|digits:10|unique:users,mobile_no,' . $request->id,
                'pan_no' => 'required|unique:profile,pan_number,' . $request->id . ',user_id',
                'pincode' => 'required|digits:6',
                'dob' => 'required|before:18 years ago'
            ]);

        } else {

            // ✅ ADD
            $request->validate([
                'full_name' => 'required',
                'email_id' => 'required|email|unique:users,email_id',
                'mobile_no' => 'required|digits:10|unique:users,mobile_no',
                'pan_no' => 'required|unique:profile,pan_number',
                'pincode' => 'required|digits:6',
                'dob' => 'required|before:18 years ago',
                'password' => 'required|min:6'
            ]);
        }

        // ================= UPDATE =================
        if ($request->id) {

            $updateData = [
                'name' => $request->full_name,
                'email_id' => $request->email_id,
                'mobile_no' => $request->mobile_no,
                'updated_at' => now()
            ];

            if (!empty($request->password)) {
                $updateData['password'] = bcrypt($request->password);
            }

            DB::table('users')
                ->where('id', $request->id)
                ->update($updateData);

            DB::table('profile')
                ->where('user_id', $request->id)
                ->update([
                    'pan_number' => $request->pan_no,
                    'residence_address' => $request->address,
                    'dob' => $request->dob,
                    'city' => $request->city,
                    'state' => $request->state,
                    'pincode' => $request->pincode,
                    'updated_at' => now()
                ]);

        } 
        // ================= INSERT =================
        else {

            $userId = DB::table('users')->insertGetId([
                'name' => $request->full_name,
                'email_id' => $request->email_id,
                'mobile_no' => $request->mobile_no,
                'password' => bcrypt($request->password),
                'role_id' => 6,
                'is_email_verify' => 1,
                'created_at' => now()
            ]);

            $dsaCode = 'DSA' . str_pad($userId, 4, '0', STR_PAD_LEFT);

            DB::table('users')->where('id', $userId)->update([
                'dsa_code' => $dsaCode
            ]);

            DB::table('profile')->insert([
                'user_id' => $userId,
                'pan_number' => $request->pan_no,
                'residence_address' => $request->address,
                'dob' => $request->dob,
                'city' => $request->city,
                'state' => $request->state,
                'pincode' => $request->pincode
            ]);
        }

        DB::commit();

        return response()->json(['status' => 1]);

    } catch (\Exception $e) {

        DB::rollback();

        return response()->json([
            'status' => 0,
            'error' => $e->getMessage()
        ]);
    }
}


public function users()
{
    $states = DB::table('states')->get(); // 🔥 MUST

    return view('admin.dsa.users.index', compact('states'));
}
public function loadUsers(Request $request)
{
    $userId = Session::get('user_id');
    $search = $request->search;

    $query = DB::table('dsa_customers')
        ->leftJoin('states', 'dsa_customers.state_id', '=', 'states.id')
        ->leftJoin('cities', 'dsa_customers.city_id', '=', 'cities.id')
        ->where('dsa_customers.dsa_id', $userId);

    if($search){
        $query->where(function($q) use ($search){
            $q->where('dsa_customers.name','like',"%$search%")
              ->orWhere('dsa_customers.mobile_no','like',"%$search%")
              ->orWhere('dsa_customers.email','like',"%$search%");
        });
    }

    $users = $query->select(
        'dsa_customers.*',
        'states.name as state_name',
        'cities.city as city_name'
    )->orderBy('dsa_customers.id','desc')->get();

    $html = view('admin.dsa.users.partials.list', compact('users'))->render();

    return response()->json(['html' => $html]);
}
public function saveCustomer(Request $request)
{
    $loginUserId = Session::get('user_id');

    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:dsa_customers,email,' . $request->id,
        'mobile_no' => 'required|digits:10|unique:dsa_customers,mobile_no,' . $request->id,
        'pincode' => 'required|digits:6',
        'state' => 'required',
        'city' => 'required'
    ]);

    DB::beginTransaction();

    try {

        // ================= UPDATE =================
        if ($request->id) {

            // 👉 GET linked user_id
            $customer = DB::table('dsa_customers')->where('id', $request->id)->first();

            // ✅ UPDATE dsa_customers
            DB::table('dsa_customers')
                ->where('id', $request->id)
                ->update([
                    'name' => $request->name,
                    'mobile_no' => $request->mobile_no,
                    'email' => $request->email,
                    'state_id' => $request->state,
                    'city_id' => $request->city,
                    'pincode' => $request->pincode,
                    'address' => $request->address,
                    'dob' => $request->dob,
                    'updated_at' => now()
                ]);

            // ✅ ALSO UPDATE users table (🔥 IMPORTANT)
            if ($customer && $customer->user_id) {
                DB::table('users')
                    ->where('id', $customer->user_id)
                    ->update([
                        'name' => $request->name,
                        'email_id' => $request->email,
                        'mobile_no' => $request->mobile_no,
                        'updated_at' => now()
                    ]);

                // ✅ UPDATE profile
                DB::table('profile')
                    ->where('user_id', $customer->user_id)
                    ->update([
                        'full_name' => $request->name,
                        'mobile_no' => $request->mobile_no,
                        'city' => $request->city,
                        'state' => $request->state,
                        'pincode' => $request->pincode,
                        'updated_at' => now()
                    ]);
            }

        } 
        // ================= INSERT =================
        else {

            // ✅ 1. CREATE USER
            $newUserId = DB::table('users')->insertGetId([
                'name' => $request->name,
                'email_id' => $request->email,
                'mobile_no' => $request->mobile_no,
                'password' => bcrypt($request->password ?? '123456'), // default if not given
                'role_id' => config('constants.roles.customer'), // 🔥 MUST
                'created_at' => now()
            ]);

            // ✅ 2. CREATE PROFILE
            $profileId = DB::table('profile')->insertGetId([
                'user_id' => $newUserId,
                'full_name' => $request->name,
                'mobile_no' => $request->mobile_no,
                'city' => $request->city,
                'state' => $request->state,
                'pincode' => $request->pincode,
                'created_at' => now()
            ]);

            // ✅ 3. UPDATE USER WITH PROFILE
            DB::table('users')->where('id', $newUserId)->update([
                'profile_id' => $profileId
            ]);

            // ✅ 4. INSERT INTO dsa_customers (🔥 LINK)
            DB::table('dsa_customers')->insert([
                'dsa_id' => $loginUserId,
                'user_id' => $newUserId, // 🔥 MOST IMPORTANT
                'name' => $request->name,
                'mobile_no' => $request->mobile_no,
                'email' => $request->email,
                'state_id' => $request->state,
                'city_id' => $request->city,
                'pincode' => $request->pincode,
                'dob' => $request->dob,
                'address' => $request->address,
                'created_at' => now()
            ]);
        }

        DB::commit();

        return response()->json(['status' => 1]);

    } catch (\Exception $e) {

        DB::rollback();

        return response()->json([
            'status' => 0,
            'error' => $e->getMessage()
        ]);
    }
}
public function editCustomer($id)
{
    $data = DB::table('dsa_customers')->where('id', $id)->first();

    return response()->json($data);
}
public function getCities(Request $request)
{
    return DB::table('cities')
        ->where('state_id', $request->state_id)
        ->get();
}
public function loadDsaCustomerLoans(Request $request)
{
    try {

        $query = DB::table('loans')
            ->join('dsa_customers', 'loans.user_id', '=', 'dsa_customers.user_id')
            ->join('users as dsa', 'dsa_customers.dsa_id', '=', 'dsa.id');

        // ✅ FILTER: DSA
        if (!empty($request->dsa)) {
            $query->where('dsa_customers.dsa_id', $request->dsa);
        }

        // ✅ FILTER: Customer
        if (!empty($request->customer)) {
            $query->where('dsa_customers.name', $request->customer);
        }

        // ✅ FILTER: Status
        if (!empty($request->status)) {
            $query->where('loans.status', $request->status);
        }

        // ✅ FILTER: Date
        if (!empty($request->date)) {
            $query->whereDate('loans.created_at', $request->date);
        }

        $loans = $query->select(
                'dsa.name as dsa_name',
                'dsa_customers.name as customer_name',
                'loans.loan_reference_id as loan_ref',
                'loans.amount',
                'loans.status',
                'loans.created_at'
            )
            ->orderBy('loans.loan_id', 'desc')
            ->get();

        // ✅ ALL DSA LIST
        $dsas = DB::table('users')
            ->where('role_id', 6)
            ->select('id','name')
            ->orderBy('name')
            ->get();

        // ✅ CUSTOMER LIST (DSA BASED)
        $customerQuery = DB::table('dsa_customers');

        if ($request->dsa) {
            $customerQuery->where('dsa_id', $request->dsa);
        }

        $customers = $customerQuery->select('name')->distinct()->get();

        $html = view('admin.dsa.partials.customer-loans', compact('loans'))->render();

        return response()->json([
            'html' => $html,
            'customers' => $customers,
            'dsas' => $dsas
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'html' => '<tr><td colspan="6">'.$e->getMessage().'</td></tr>'
        ]);
    }
}

// dsa setting
public function settings()
    {
        $dsaId = session('user_id');

       $documents = DB::table('dsa_documents')
    ->where('dsa_id', $dsaId)
    ->get(); // ✅ CORRECT

        $bank = DB::table('dsa_bank_details')
            ->where('dsa_id', $dsaId)
            ->first();

return view('admin.dsa.settings', compact('documents', 'bank'));    }

    // 🔹 SAVE SETTINGS
    public function saveSettings(Request $request)
    {
        $dsaId = session('user_id');

        // ✅ FILE UPLOAD
        $pan = $request->file('pan_card')
            ? $request->file('pan_card')->store('uploads')
            : null;

        $aadhaar = $request->file('aadhaar_card')
            ? $request->file('aadhaar_card')->store('uploads')
            : null;

        $photo = $request->file('photo')
            ? $request->file('photo')->store('uploads')
            : null;

        // ✅ SAVE DOCUMENTS
        DB::table('dsa_documents')->updateOrInsert(
            ['dsa_id' => $dsaId],
            [
                'pan_card' => $pan,
                'aadhaar_card' => $aadhaar,
                'photo' => $photo,
                'updated_at' => now()
            ]
        );

        // ✅ SAVE BANK DETAILS
       DB::table('dsa_bank_details')->updateOrInsert(
    ['dsa_id' => $dsaId],
    [
        'bank_name' => $request->bank_name,
        'account_number' => $request->account_number,
        'ifsc_code' => $request->ifsc_code,
        'account_holder_name' => $request->account_holder_name,
        'upi_id' => $request->upi_id, // ✅ ADDED ONLY THIS
        'updated_at' => now()
    ]
);

        return back()->with('success', 'Settings saved successfully');
    }

    public function uploadDocument(Request $request)
{
    $request->validate([
        'doc_name' => 'required',
        'file' => 'required|file'
    ]);

    // upload file
    $filePath = $request->file('file')->store('uploads', 'public');

    // save in DB
    \DB::table('dsa_documents')->insert([
        'dsa_id' => auth()->id(),
        'name' => $request->doc_name,
        'file' => $filePath,
        'created_at' => now(),
        'updated_at' => now()
    ]);

    return back()->with('success', 'Document uploaded successfully');
}


}