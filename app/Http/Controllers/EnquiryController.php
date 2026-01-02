<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Enquiry;
use Illuminate\Support\Facades\DB;
use App\Models\User;
class EnquiryController extends Controller
{




public function enquiryLead()
{
    // ONLINE LEADS
    $enquiries = Enquiry::latest()->paginate(10);

    // ALL LEADS
    $allLeads = Enquiry::latest()->paginate(10);

    // MIS
    $misRecords = DB::table('mis')->latest()->paginate(10);
    $totalMIS   = DB::table('mis')->count();

    // LOAN BANKS
    $loanBanks = DB::table('loan_bank_details')->latest()->paginate(10);
    $totalLoanBanks = DB::table('loan_bank_details')->count();

    // ✅ AGENTS (IMPORTANT FIX)
    $agents = $agents = User::all();
    // OR: ->where('role_id', 3)

    return view('admin.enquiry.index', compact(
        'enquiries',
        'allLeads',
        'misRecords',
        'loanBanks',
        'totalMIS',
        'totalLoanBanks',
        'agents' // ✅ PASS TO VIEW
    ));
}


    public function showForm()
    {
        return view('frontend.enquiry-form');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contact' => 'required|string|max:15',
            'amount' => '|numeric',
            'address' => '|string',
            'message' => '|string',
            'enquiry_type' => 'string'
        ]);
        Enquiry::create($validated);
        return view('frontend.thank-loan');
    }
}
