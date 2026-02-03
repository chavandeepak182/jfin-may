<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\User;
use App\Models\LoanBank;
use App\Models\Mis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\EstimatedFile;
use App\Models\MonthlyPL;
use App\Models\LoanBankDetail;
use Carbon\Carbon;
use App\Exports\MonthlyPLFormattedExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MonthlyPLWithEstimatedExport;


class LeadController extends Controller {

    public function index() {
        // Check if the user is an admin (role_id = 4) from the session
        if (session('role_id') == 4) {
            // Admin sees all leads
            $leads = Lead::with('agent')->paginate(10);
        } elseif (session('role_id') == 2) {
            // Agent sees only assigned leads
            $userId = session('user_id'); // Assuming the user ID is stored in the session
            $leads = Lead::with('agent')->where('assigned_to', $userId)->paginate(10);
        } else {
            // If the user has neither admin nor agent role
            return redirect('/home')->with('error', 'You do not have access to this page.');
        }
        
        return view('leads.index', compact('leads'));
    }

    // count dashboard

// public function leadlist()
// {
//     $enquiriesCount = DB::table('enquiries')->count(); // for card
//     $leadsCount     = DB::table('leads')->count();     // for card

//     $enquiries = DB::table('enquiries')->get();        // ALWAYS load list

//     return view('admin.admin-leads', compact(
//         'enquiriesCount',
//         'leadsCount',
//         'enquiries'
//     ));
// }



public function leadlist(Request $request)
{
    // ================= COUNTS =================
    $enquiriesCount      = DB::table('enquiries')->count();
    $leadsCount          = DB::table('leads')->count();
    $totalEstimatedFiles = EstimatedFile::count();
    $totalMonthlyPL      = MonthlyPL::count();

    // ================= LISTS =================
    $enquiries = DB::table('enquiries')->paginate(10);
    $leads     = Lead::with('agent')->paginate(10);

    // MIS
    $banks      = LoanBank::all();
    $misRecords = Mis::latest()->paginate(10);

    // Loan Banks
    $loanbanks = DB::table('loan_bank_details')->paginate(10);

    // ================= ESTIMATED FILE =================
    $query = EstimatedFile::query();

    if ($request->filled('search')) {
        $query->where(function ($q) use ($request) {
            $q->where('customer_name', 'like', '%' . $request->search . '%')
              ->orWhere('mobile', 'like', '%' . $request->search . '%');
        });
    }

    $grossRevenue = 0;

    if ($request->filled('report_month')) {
        $date = Carbon::createFromFormat('Y-m', $request->report_month);

        $query->whereYear('report_month', $date->year)
              ->whereMonth('report_month', $date->month);

        $grossRevenue = (clone $query)->sum('estimate_revenue');
    }

    $estimatedFiles = $query->orderBy('id', 'desc')->paginate(10);

    // ================= MONTHLY P&L =================
    $pls = MonthlyPL::orderBy('year', 'desc')
                    ->orderBy('month', 'desc')
                    ->paginate(10);

    // ================= REFERRAL LEADS (✅ FIXED) =================
    $referralLeads = DB::table('referral_leads as rl')
        ->join('users as u', 'u.id', '=', 'rl.user_id')
        ->leftJoin('loan_category as lc', 'lc.loan_category_id', '=', 'rl.product_type')
        ->leftJoin('users as cust', 'cust.email_id', '=', 'rl.email')
        ->select(
            'rl.*',
            'u.name as referrer_name',
            'u.mobile_no as referrer_mobile',
            DB::raw("
                CASE
                    WHEN rl.product_type IS NULL THEN rl.other_remark
                    WHEN lc.category_name IS NULL THEN rl.other_remark
                    ELSE lc.category_name
                END AS product_name
            "),
             DB::raw("
                CASE
                    WHEN cust.id IS NOT NULL THEN 'created'
                    ELSE 'pending'
                END AS status
            ")
        )
        
        ->orderBy('rl.created_at', 'desc')
        ->paginate(10);
// ================= STATES (FOR CREATE ACCOUNT MODAL) =================
$states = DB::table('states')
            ->select('id', 'name')
            ->orderBy('name')
            ->get();
    return view('admin.admin-leads', compact(
        'enquiriesCount',
        'leadsCount',
        'totalEstimatedFiles',
        'totalMonthlyPL',
        'enquiries',
        'leads',
        'misRecords',
        'banks',
        'loanbanks',
        'estimatedFiles',
        'grossRevenue',
        'pls',
        'referralLeads',
        'states' // ✅ ADD THIS
    ));
}

// searchbar for referal leads
public function referralAjax(Request $request)
{
    $query = DB::table('referral_leads as rl')
        ->join('users as u', 'u.id', '=', 'rl.user_id')
        ->leftJoin('loan_category as lc', 'lc.loan_category_id', '=', 'rl.product_type')
        ->leftJoin('users as cust', 'cust.email_id', '=', 'rl.email')
        ->select(
            'rl.*',
            'u.name as referrer_name',
            'u.mobile_no as referrer_mobile',
            DB::raw("
                CASE
                    WHEN rl.product_type IS NULL THEN rl.other_remark
                    WHEN lc.category_name IS NULL THEN rl.other_remark
                    ELSE lc.category_name
                END AS product_name
            "),
            DB::raw("
                CASE
                    WHEN cust.id IS NOT NULL THEN 'created'
                    ELSE 'pending'
                END AS status
            ")
        );

    if ($request->filled('name')) {
        $query->where('rl.name', 'like', '%' . $request->name . '%');
    }

    if ($request->filled('mobile')) {
        $query->where('rl.mobile', 'like', '%' . $request->mobile . '%');
    }

    $referralLeads = $query->orderBy('rl.created_at', 'desc')->paginate(10);

    return response()->json([
        'html' => view('admin.partials.referral-table', compact('referralLeads'))->render()
    ]);
}

// seracbar leads
public function enquiryAjax(Request $request)
{
    $query = DB::table('enquiries');

    if ($request->filled('search')) {
        $query->where('enquiries.name', 'like', '%' . $request->search . '%');
    }

    $enquiries = $query
        ->orderBy('enquiries.created_at', 'desc')
        ->paginate(10);

    return response()->json([
        'html' => view('admin.partials.enquiry-table', compact('enquiries'))->render()
    ]);
}

public function leadsAjax(Request $request)
{
    $query = Lead::with('agent')
        ->orderBy('created_at', 'desc');

    // 🔍 Search by Name
    if ($request->filled('name')) {
        $query->where('name', 'like', '%' . $request->name . '%');
    }

    // 📱 Search by Mobile
    if ($request->filled('mobile')) {
        $query->where('phone', 'like', '%' . $request->mobile . '%');
    }

    $leads = $query->paginate(10);

    return response()->json([
        'html' => view('admin.partials.leads-table', compact('leads'))->render()
    ]);
}
public function misAjax(Request $request)
{
    $query = MIS::query()->orderBy('created_at', 'desc');

    // 🔍 Name search
    if ($request->filled('name')) {
        $query->where('name', 'like', '%' . $request->name . '%');
    }

    // 📱 Mobile search
    if ($request->filled('mobile')) {
        $query->where('contact', 'like', '%' . $request->mobile . '%');
    }

    $misRecords = $query->paginate(10);

    return response()->json([
        'html' => view('admin.partials.mis-table', compact('misRecords'))->render()
    ]);
}







    public function create() {
        // Check if the user has role_id 4 (admin) or 2 (agent)
        if (!in_array(session('role_id'), [4, 2])) {
            return redirect('/home')->with('error', 'You do not have access to this page.');
        }
    
        // Proceed if the user is either an admin or an agent
        $agents = User::where('role_id', 2)->get(); // Get agents for assignment
        return view('leads.create', compact('agents'));
    }

    public function store(Request $request) {
        // Check if the user has role_id 4 (admin) or 2 (agent)
        if (!in_array(session('role_id'), [4, 2])) {
            return redirect('/home')->with('error', 'You do not have access to this page.');
        }
    
        // If the user is an agent, automatically set the assigned_to field to the agent's ID
        if (session('role_id') == 2) {
            $request['assigned_to'] = session('user_id'); // Assuming the logged-in user's ID is stored in session as 'user_id'
        }
    
        // Validate the lead data
        // $request->validate([
        //     'name' => 'required',
        //     'email' => 'required|email|unique:leads',
        //     'phone' => 'required',
        //     'lead_source' => 'required',
        //     'property_type' => 'required',
        //     'budget_min' => 'required|numeric',
        //     'budget_max' => 'required|numeric',
        //     'location_preference' => 'required',
        //     'possession_time' => 'required',
        //     'property_status' => 'required',
        //     'lead_status' => 'required',
        //     'lead_score' => 'required|numeric',
        //     'assigned_to' => 'required|exists:users,id',
        //     'lead_type' => 'required',
        //     'financing_status' => 'required',
        // ]);
              $request->validate(
[
    // 👤 BASIC DETAILS
    'name' => [
        'required',
        'string',
        'max:255',
        'regex:/^[a-zA-Z\s]+$/'
    ],

    'email' => 'required|email|unique:leads,email',

    'phone' => [
        'required',
        'digits:10'
    ],

    'alternate_phone' => [
        'nullable',
        'digits:10'
    ],

    // 📌 LEAD INFO
    'lead_source'   => 'required|string',
    'campaign_name' => 'nullable|string|max:255',
    'property_type' => 'required|string',

    // 💰 BUDGET
    'budget_min' => 'required|numeric|min:0',
    'budget_max' => 'required|numeric|gte:budget_min',

    // 🏠 PROPERTY DETAILS
    'location_preference' => 'required|string|max:255',
    'possession_time'     => 'required|string',
    'property_status'     => 'required|string',
    'lead_status'         => 'required|string',

    // 👨‍💼 ASSIGNMENT
    'assigned_to' => 'required|exists:users,id',

    // 📅 DATES
    'follow_up_date' => 'nullable|date',
    'closing_date'   => 'nullable|date',

    // 🔢 AVAILABLE UNITS
    'lead_score' => 'required|integer|min:1',

    // 📝 EXTRA
    'notes' => 'nullable|string',

    // 🏷 TYPE & FINANCE
    'lead_type'        => 'required|string',
    'financing_status' => 'required|string',
    'loan_provider'    => 'nullable|string|max:255',
],
[
    // ❌ CUSTOM ERROR MESSAGES
    'name.required' => 'Full Name is required',
    'name.regex'   => 'Full Name should contain only letters',

    'email.required' => 'Email Address is required',
    'email.unique'   => 'This email is already registered',

    'phone.required' => 'Phone Number is required',
    'phone.digits'   => 'Phone Number must be exactly 10 digits',

    'alternate_phone.digits' => 'Alternate Phone must be 10 digits',

    'budget_max.gte' => 'Maximum Budget must be greater than Minimum Budget',

    'lead_score.required' => 'Available Units is required',
]);

        // Create the lead if valid
        Lead::create($request->all());
        return redirect()->route('admin.listlead')->with('success', 'Lead added successfully.');
    }

    public function show(Lead $lead) {
        return view('leads.show', compact('lead'));
    }

    public function edit(Lead $lead) {
        // Check if the user has role_id 4 (admin) or role_id 2 (agent)
        if (!in_array(session('role_id'), [4, 2])) {
            return redirect('/home')->with('error', 'You do not have access to this page.');
        }
    
        // If the user is an agent, ensure they can only edit leads assigned to them
        if (session('role_id') == 2 && $lead->assigned_to != session('user_id')) {
            return redirect('/home')->with('error', 'You do not have permission to edit this lead.');
        }
    
        // Get all agents (only for admin)
        $agents = User::where('role_id', 2)->get();
    
        return view('leads.edit', compact('lead', 'agents'));
    }

    public function update(Request $request, Lead $lead) {
        // Check if the user has role_id 4 (admin) or role_id 2 (agent)
        if (!in_array(session('role_id'), [4, 2])) {
            return redirect('/home')->with('error', 'You do not have access to this page.');
        }
    
        // If the user is an agent, ensure they can only update leads assigned to them
        if (session('role_id') == 2 && $lead->assigned_to != session('user_id')) {
            return redirect('/home')->with('error', 'You do not have permission to update this lead.');
        }
    
        // Validate the updated lead data
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:leads,email,' . $lead->id,
            'phone' => 'required',
            'lead_source' => 'required',
            'property_type' => 'required',
            'budget_min' => 'required|numeric',
            'budget_max' => 'required|numeric',
            'location_preference' => 'required',
            'possession_time' => 'required',
            'property_status' => 'required',
            'lead_status' => 'required',
            'lead_score' => 'required|numeric',
            'assigned_to' => 'required|exists:users,id',
            'lead_type' => 'required',
            'financing_status' => 'required',
        ]);
    
        // Prevent agents from reassigning leads
        if (session('role_id') == 2) {
            $request['assigned_to'] = session('user_id'); // Keep the lead assigned to the same agent
        }
    
        // Update the lead
        $lead->update($request->all());
    
        return redirect()->route('admin.listlead')->with('success', 'Lead updated successfully.');
    }

    public function destroy(Lead $lead) {
        // Check if the user has role_id 4 (admin)
        if (session('role_id') != 4) {
            return redirect('/home')->with('error', 'You do not have access to this page.');
        }
    
        // Delete the lead if the user is an admin
        $lead->delete();
        return redirect()->route('admin.listlead')->with('success', 'Lead deleted successfully.');
    }
}

