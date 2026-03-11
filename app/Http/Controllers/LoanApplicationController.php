<?php

namespace App\Http\Controllers;

use App\Events\LoanStatusUpdated;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Session;
use App\Models\Profile;
use App\Models\Professional;
use App\Models\Education;
use App\Models\LoanCategory;
use App\Models\ExistingLoan;
use App\Models\Document;
use App\Models\User;
use App\Models\Loan;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use App\Services\CreditScoreService;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cookie;
use Carbon\Carbon;
use App\Models\States;   // ✅ add
use App\Models\Cities;    // ✅ add
use Illuminate\Validation\Rule;






class LoanApplicationController extends Controller
{

    // protected $creditScoreService;

    // public function __construct(CreditScoreService $creditScoreService)
    // {
    //     $this->creditScoreService = $creditScoreService;
    // }


    // admin loan link
   


//    public function index(Request $request)
// {
   
//     $totalLoans      = DB::table('loans')->count();

//     $inProcessLoans  = DB::table('loans')
//         ->where('status', 'in process')
//         ->count();

//     $trashedLoans    = DB::table('loans')
//         ->whereNotNull('deleted_at')
//         ->count();

//     $approvedLoans   = DB::table('loans')
//         ->where('status', 'approved')
//         ->count();

//     $disbursedLoans  = DB::table('loans')
//         ->where('status', 'disbursed')
//         ->count();

//     $rejectedLoans   = DB::table('loans')
//         ->where('status', 'rejected')
//         ->count();


   
//     $query = \App\Models\Loan::with([
//         'user.profile.cityRelation',
//         'loanCategory',
//         'bankDetails'
//     ])
//     ->whereNotNull('loan_reference_id');


   
//     if ($request->filled('status')) {
//         $query->where('status', $request->input('status'));
//     }

//     if ($request->filled('start_date') && $request->filled('end_date')) {
//         $query->whereBetween('created_at', [
//             $request->input('start_date'),
//             $request->input('end_date'),
//         ]);
//     }


 
//     $paginated = $query
//         ->orderBy('created_at', 'desc')
//         ->paginate(10);


//     $paginated->getCollection()->transform(function ($loan) {
//         return [
//             'loan_id'             => $loan->loan_id,
//             'amount'              => $loan->amount,
//             'tenure'              => $loan->tenure,
//             'loan_reference_id'   => $loan->loan_reference_id,
//             'user_name'           => $loan->user->name ?? null,
//             'status'              => $loan->status,
//             'city'                => $loan->user->profile->cityRelation->city ?? null,
//             'loan_category_name'  => $loan->loanCategory->category_name ?? null,
//             'bank_name'           => $loan->bankDetails->bank_name ?? null,
//             'agent_action'        => $loan->agent_action,
//         ];
//     });

//     $data['loans'] = $paginated;


   
//     $recentLoans = DB::table('loans')
//         ->join('users', 'loans.user_id', '=', 'users.id')
//         ->select(
//             'loans.loan_id',
//             'loans.amount',
//             'users.name as user_name',
//             'loans.status'
//         )
//         ->whereNotNull('loans.loan_reference_id')
//         ->orderByDesc('loans.created_at')
//         ->take(5)
//         ->get();


    
//     return view('frontend.all-loans', compact(
//         'data',
//         'recentLoans',
//         'totalLoans',
//         'inProcessLoans',
//         'trashedLoans',
//         'approvedLoans',
//         'disbursedLoans',
//         'rejectedLoans'
//     ));
// }
public function index(Request $request)
{
    // base query (AS IT IS)
    $query = \App\Models\Loan::with([
        'user.profile.cityRelation',
        'loanCategory',
        'bankDetails'
    ])->whereNotNull('loan_reference_id');

    // 🔹 CARD STATUS FILTER (NEW)
    if ($request->filled('card')) {
        switch ($request->card) {
            case 'in process':
                $query->where('status', 'in process');
                break;

            case 'approved':
                $query->where('status', 'approved');
                break;

            case 'rejected':
                $query->where('status', 'rejected');
                break;

            case 'disbursed':
                $query->where('status', 'disbursed');
                break;

            case 'trashed':
                $query->onlyTrashed();
                break;
        }
    }

    // paginate
    $loans = $query->orderBy('created_at', 'desc')->paginate(10);

    // COUNTS (as it is)
    $totalLoans      = \App\Models\Loan::count();
    $inProcessLoans  = \App\Models\Loan::where('status','in process')->count();
    $approvedLoans   = \App\Models\Loan::where('status','approved')->count();
    $disbursedLoans  = \App\Models\Loan::where('status','disbursed')->count();
    $rejectedLoans   = \App\Models\Loan::where('status','rejected')->count();
    $trashedLoans    = \App\Models\Loan::onlyTrashed()->count();

    $data['loans'] = $loans;

    return view('frontend.all-loans', compact(
        'data',
        'totalLoans',
        'inProcessLoans',
        'approvedLoans',
        'disbursedLoans',
        'rejectedLoans',
        'trashedLoans'
    ));
}



    public function view($id)
    {
        // Fetch loan details along with related user and category information
        $loan = DB::selectOne(
            'SELECT l.*, u.name AS user_name, lc.category_name AS loan_category_name
            FROM loans AS l
            JOIN users AS u ON l.user_id = u.id
            JOIN loan_category AS lc ON l.loan_category_id = lc.loan_category_id
            WHERE l.loan_id = ?',
            [$id]
        );

        if (!$loan) {
            return redirect()->route('loans.index')->with('error', 'Loan not found');
        }

        // Fetch related profile details
       $profile = DB::selectOne(
    'SELECT 
        p.*,
        c.city AS city_name,
        s.name AS state_name
     FROM profile p
     LEFT JOIN cities c ON c.id = p.city
     LEFT JOIN states s ON s.id = p.state
     WHERE p.user_id = ?',
    [$loan->user_id]
);

        // Fetch related professional details
        $professional = DB::selectOne(
            'SELECT * FROM professional_details WHERE user_id = ?',
            [$loan->user_id]
        );

        // Fetch related educational details
        $education = DB::selectOne(
            'SELECT * FROM education_details WHERE user_id = ?',
            [$loan->user_id]
        );
        //Fetch related document
        $documents = DB::select(
            'SELECT * FROM documents WHERE user_id = ?',
            [$loan->user_id]
        );

        // Pass all data to the view
        return view('frontend.loan-details', [
            'loan' => $loan,
            'profile' => $profile,
            'professional' => $professional,
            'education' => $education,
            'documents' => $documents,
            'sanctionLetter' => $loan->sanction_letter,
        ]);
    }


    // count dashboard
public function loanlist()
{
    /* ================= COUNTS ================= */

    $totalLoans = Loan::count();

    $inProcessLoans = Loan::where('status', 'in process')->count();

    $trashedloans = Loan::onlyTrashed()->count();

    $approvedLoan = Loan::where('status', 'approved')->count();

    $disbursedLoans = Loan::where('status', 'disbursed')
        ->whereNotNull('loan_reference_id')
        ->count();

    $rejectedLoans = DB::table('loans')
    ->where('status', 'rejected')
    ->count();
    $pendingLoansCount = DB::table('loans')
    ->where(function ($query) {
        $query->whereNull('agent_id')
              ->orWhereIn('agent_action', ['rejected', null]);
    })
    ->count();




    /* ================= PAGINATED LOANS ================= */

    $loans = Loan::with([
            'user.profile.cityRelation',
            'loanCategory',
            'bankDetails'
        ])
        ->orderBy('created_at', 'desc')
        ->paginate(10);   // 👈 REQUIRED


    return view('admin.admin-loans', compact(
        'totalLoans',
        'inProcessLoans',
        'trashedloans',
        'approvedLoan',
        'disbursedLoans',
        'rejectedLoans',
        'loans', // 👈 IMPORTANT
        'pendingLoansCount'
    ));
}
    public function edit($id)
    {
        $loan = Loan::with(['user', 'loanCategory'])->where('loan_id', $id)->first();

        if (!$loan) {
            return redirect()->route('agent.allAgentLoans')->with('error', 'Loan not found');
        }

        // Fetch related data
        // $profile = Profile::where('user_id', $loan->user_id)->first();
        $profile = Profile::with(['cityRelation', 'stateRelation'])
    ->where('user_id', $loan->user_id)
    ->first();
        $professional = Professional::where('user_id', $loan->user_id)->first();
        $education = Education::where('user_id', $loan->user_id)->first();
        $documents = \DB::table('documents')->where('user_id', $loan->user_id)->get();

        // Fetch all users with role_id 2 (agents) and loan categories
        $agents = User::join('role_user', 'users.id', '=', 'role_user.user_id')
            ->where('role_user.role_id', 2)
            ->select('users.id', 'users.name')
            ->get();

        $applyingUser = User::find($loan->user_id);
        $loanCategories = LoanCategory::all();
        // ✅ NEW
          $states = States::all();

$state = States::where('name', $profile->state)->first();

$cities = [];

if ($state) {
    $cities = Cities::where('state_id', $state->id)->get();
}

return view('admin.edit-loan', compact(
    'loan',
    'loanCategories',
    'profile',
    'documents',
    'professional',
    'education',
    'agents',
    'applyingUser',
    'states',
    'cities'
));
    }
    

    // public function loanedit($id)
    // {
    //     $loan = Loan::with(['user', 'loanCategory'])->where('loan_id', $id)->first();

    //     if (!$loan) {
    //         return redirect()->route('agent.allAgentLoans')->with('error', 'Loan not found');
    //     }

    //     // Fetch related data
    //     $profile = Profile::with('cityRelation', 'stateRelation')->where('user_id', $loan->user_id)->first();
    //     $professional = Professional::where('user_id', $loan->user_id)->first();
    //     $education = Education::where('user_id', $loan->user_id)->first();
    //     $documents = \DB::table('documents')->where('user_id', $loan->user_id)->get();

    //     // Fetch all users with role_id 2 (agents) and loan categories
    //     $agents = User::join('role_user', 'users.id', '=', 'role_user.user_id')
    //         ->where('role_user.role_id', 2)
    //         ->select('users.id', 'users.name')
    //         ->get();

    //     $applyingUser = User::find($loan->user_id);
    //     $loanCategories = LoanCategory::all();

    //     // Pass all data to the view
    //     return view('frontend.profile.loanedit', compact('loan', 'loanCategories', 'profile', 'documents', 'professional', 'education', 'agents', 'applyingUser'));
    // }

    // public function update(Request $request)
    // {
    //     // dd($request->all());
    //     try {
    //         // Validate the request
    //         $validated = $request->validate([
    //             'loan_id' => 'required|integer',
    //             'status' => 'required|string',
    //             'loan_category_id' => 'required|integer',
    //             'amount' => 'required|numeric','min:0',
    //             'amount_approved' => ['required_if:status,disbursed','nullable','numeric','min:0'],
    //             'tenure' => 'required|integer',
    //             'in_principle' => 'nullable|string',
    //             'remarks' => 'nullable|string',
    //             'sanction_letter' => 'nullable|file|mimes:pdf,doc,docx',
    //             'documents.*' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120'

    //         ]);



    //         \DB::transaction(function () use ($request) {
    //             $loan = Loan::where('loan_id', $request->input('loan_id'))->firstOrFail();
    //             $oldStatus = $loan->status;
    //             $newStatus = $request->input('status');

    //             \Log::info('Loan status update:', [
    //                 'loan_id' => $loan->loan_id,
    //                 'old_status' => $oldStatus,
    //                 'new_status' => $newStatus,
    //             ]);

    //             // Update loan details
    //             $loan->loan_category_id = $request->input('loan_category_id');
    //             $loan->amount = $request->input('amount');
    //             $loan->tenure = $request->input('tenure');
    //             $loan->status = $newStatus;
    //             $loan->remarks = $request->input('remarks');
    //             $loan->in_principle = $request->input('in_principle');
    //             $loan->amount_approved = $request->input('amount_approved');
    //             $loan->save();

    //             // echo $loan;die;

    //             // Save the remark in the loan_remarks table
    //             if ($request->input('remarks')) {
    //                 \DB::table('loan_remarks')->insert([
    //                     'loan_id' => $loan->loan_id,
    //                     'agent_id' => session()->get('user_id'),
    //                     'status' => $newStatus,
    //                     'remarks' => $request->input('remarks'),
    //                     'created_at' => now(),
    //                     'updated_at' => now(),
    //                 ]);
    //             }

    //             // Handle sanction letter upload
    //             if ($request->hasFile('sanction_letter')) {
    //                 $sanctionLetter = $request->file('sanction_letter');
    //                 $sanctionLetterPath = $sanctionLetter->storeAs('sanction_letters', time() . '_' . $sanctionLetter->getClientOriginalName(), 'public');
    //                 $loan->update(['sanction_letter' => $sanctionLetterPath]);
    //             }

    //             // Handle document uploads
    //             if ($request->hasFile('documents')) {
    //                 $documents = $request->file('documents');
    //                 $documentNames = $request->input('document_name');

    //                 foreach ($documents as $index => $document) {
    //                     // Ensure there's a corresponding name for each document
    //                     $name = $documentNames[$index] ?? $document->getClientOriginalName();

    //                     $path = $document->store('documents', 'public');

    //                     Document::create([
    //                         'user_id' => $loan->user_id,
    //                         'loan_id' => $loan->loan_id,
    //                         'document_name' => $name,
    //                         'file_path' => $path,
    //                         'created_at' => now(),
    //                         'updated_at' => now(),
    //                     ]);
    //                 }
    //             }

    //             // Send email notification if the status has changed
    //             if ($oldStatus !== $newStatus) {
    //                 log::info('Dispatching LoanStatusUpdated event for loan ID: ' . $loan->loan_reference_id, [
    //                     'old_status' => $oldStatus,
    //                     'new_status' => $newStatus,
    //                     'loan_reference_id' => $loan->loan_reference_id,
    //                     'user_id' => auth()->id(),
    //                 ]);
    //                 event(new LoanStatusUpdated(
    //                     $loan->loan_reference_id,
    //                     auth()->id(),
    //                     auth()->user()->roles->name, // assuming you store role
    //                     $loan->status,
    //                     $loan->user_id
    //                 ));
    //                 $customer = $loan->user;
    //                 $customerEmail = $customer->email_id;
    //                 $customerName = $customer->name;
    //                 $status = $newStatus;
    //                 $remarks = $request->input('remarks');
    //                 $msg = "Your loan status has been updated to: $status. Remarks: $remarks";
    //                 $temp_id = 4; // Example template ID, adjust accordingly
    //                 app(UsersController::class)->temail($customerEmail, $customerName, $msg, $temp_id);
    //             }

    //             // Start MLM Insertion
    //             // if ($newStatus == 'disbursed') {
    //             //     $name = $customerName;
    //             //     $parent = $loan->referral_user_id;
    //             //     $nodeInserted = app(CategoryController::class)->addNode($parent, $name);
    //             //     $amount_approved = $loan->amount_approved;

    //             //     $userId = $loan->user_id;
    //             //     app(CategoryController::class)->commission_destribution($parent, $amount_approved, $userId);
    //             // }

    //             if ($newStatus == 'disbursed') {
    //                 $loan->amount_approved = $request->input('amount_approved');
    //                 $loan->status = $newStatus; // Set status again, to be sure
    //                 $loan->save(); // Explicitly save all changes

    //                 Log::info('Loan approved amount set for loan ID: ' . $loan->loan_id);

    //                 // Handle tree node addition
    //                 $referralUser = User::find($loan->referral_user_id);

    //                 if (!$referralUser) {
    //                     Log::warning("Referral user not found for ID: {$loan->referral_user_id}. Searching for next available node.");
    //                     $parentNode = app(CategoryController::class)->findNextAvailableNode();

    //                     if (!$parentNode) {
    //                         Log::error("No available position found in the tree.");
    //                         return;
    //                     }

    //                     $parentUserId = $parentNode->user_id;
    //                 } else {
    //                     Log::info("Referral user found: " . json_encode($referralUser->toArray()));
    //                     $parentUserId = $referralUser->id;
    //                 }

    //                 $childName = $loan->user->name;
    //                 $childUserId = $loan->user->id;

    //                 $existingCategory = DB::table('categories')->where('user_id', $childUserId)->first();

    //                 if ($existingCategory) {
    //                     Log::info("User already exists in the tree. Skipping node insertion for user ID: {$childUserId}");
    //                 } else {
    //                     if (app(CategoryController::class)->addNode($parentUserId, $childName, $childUserId)) {
    //                         Log::info("Node successfully inserted into tree for loan applicant.");
    //                     } else {
    //                         Log::error("Failed to insert node into tree for loan applicant.");
    //                         return;
    //                     }
    //                 }

    //                 // Fetch ancestors for commission distribution
    //                 $childCategory = DB::table('categories')->where('user_id', $childUserId)->first();

    //                 if (!$childCategory) {
    //                     Log::error("Category not found for Child User ID: {$childUserId}");
    //                     return;
    //                 }

    //                 $ancestors = DB::table('categories')
    //                     ->where('_lft', '<', $childCategory->_lft)
    //                     ->where('_rgt', '>', $childCategory->_rgt)
    //                     ->orderBy('_lft', 'asc')
    //                     ->get();

    //                 if ($ancestors->isEmpty()) {
    //                     Log::info("No ancestors found for Child User ID: {$childUserId}. Skipping commission distribution.");
    //                     return;
    //                 }

    //                 // Distribute commission
    //                 app(CategoryController::class)->commissionDistribution($childUserId, $loan->amount_approved);

    //                 if ($referralUser) {
    //                     Log::info("Commission distribution executed for user: {$loan->user_id}, Parent: {$referralUser->name}");
    //                 } else {
    //                     Log::info("Commission distribution executed for user: {$loan->user_id}, No valid referral user found.");
    //                 }
    //             }
    //         });



    //         return redirect()->back()->with('success', 'Loan updated successfully!');
    //     } catch (\Exception $e) {
    //         \Log::error('Error updating loan', ['exception' => $e->getMessage()]);
    //         if ($request->expectsJson()) {
    //             return response()->json(['status' => 0, 'msg' => 'An error occurred while updating: ' . $e->getMessage()]);
    //         }
    //         return redirect()->back()->withErrors(['error' => 'An error occurred while updating: ' . $e->getMessage()])->withInput();
    //     }
    // }



    public function loanedit($id)
{
    $loan = Loan::with(['user', 'loanCategory'])
                ->where('loan_id', $id)
                ->first();

    if (!$loan) {
        return redirect()
            ->route('agent.allAgentLoans')
            ->with('error', 'Loan not found');
    }

    // Fetch related data
    $profile = Profile::with('cityRelation', 'stateRelation')
                      ->where('user_id', $loan->user_id)
                      ->first();

    $professional = Professional::where('user_id', $loan->user_id)->first();
    $education    = Education::where('user_id', $loan->user_id)->first();
    $documents    = \DB::table('documents')->where('user_id', $loan->user_id)->get();

    // Fetch agents (role_id = 2)
    $agents = User::join('role_user', 'users.id', '=', 'role_user.user_id')
        ->where('role_user.role_id', 2)
        ->select('users.id', 'users.name')
        ->get();

    $applyingUser  = User::find($loan->user_id);
    $loanCategories = LoanCategory::all();

    // 🔐 Check if logged-in user is Admin
    $isAdmin = auth()->check() && auth()->user()->role === 'admin';

    // Pass everything to view
    return view(
        'frontend.profile.loanedit',
        compact(
            'loan',
            'loanCategories',
            'profile',
            'documents',
            'professional',
            'education',
            'agents',
            'applyingUser',
            'isAdmin'
        )
    );
}

    // public function update(Request $request)
    // {
    //     // dd($request->all());
    //     try {
    //         // Validate the request
    //         $validated = $request->validate([
    //             'loan_id' => 'required|integer',
    //             'status' => 'required|string',
    //             'loan_category_id' => 'required|integer',
    //             'amount' => 'required|numeric','min:0',
    //             'amount_approved' => ['required_if:status,disbursed','nullable','numeric','min:0'],
    //             'tenure' => 'required|integer',
    //             'in_principle' => 'nullable|string',
    //             'remarks' => 'nullable|string',
    //             'sanction_letter' => 'nullable|file|mimes:pdf,doc,docx|max:2048',

    //             'documents.*' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120'

    //         ]);



    //         \DB::transaction(function () use ($request) {
    //             $loan = Loan::where('loan_id', $request->input('loan_id'))->firstOrFail();
    //             $oldStatus = $loan->status;
    //             $newStatus = $request->input('status');

    //             \Log::info('Loan status update:', [
    //                 'loan_id' => $loan->loan_id,
    //                 'old_status' => $oldStatus,
    //                 'new_status' => $newStatus,
    //             ]);

    //             // Update loan details
    //             $loan->loan_category_id = $request->input('loan_category_id');
    //             $loan->amount = $request->input('amount');
    //             $loan->tenure = $request->input('tenure');
    //             $loan->status = $newStatus;
    //             $loan->remarks = $request->input('remarks');
    //             $loan->in_principle = $request->input('in_principle');
    //             $loan->amount_approved = $request->input('amount_approved');
    //             $loan->save();

    //             // echo $loan;die;

    //             // Save the remark in the loan_remarks table
    //             if ($request->input('remarks')) {
    //                 \DB::table('loan_remarks')->insert([
    //                     'loan_id' => $loan->loan_id,
    //                     'agent_id' => session()->get('user_id'),
    //                     'status' => $newStatus,
    //                     'remarks' => $request->input('remarks'),
    //                     'created_at' => now(),
    //                     'updated_at' => now(),
    //                 ]);
    //             }

    //            if ($request->hasFile('sanction_letter')) {
    //                     $file = $request->file('sanction_letter');

    //                     $filename = time() . '_' . $file->getClientOriginalName();

    //                     $file->storeAs('sanction_letters', $filename, 'public');

    //                     $loan->sanction_letter = $filename;
    //                     $loan->save();
    //                 }


    //             // Handle document uploads
    //             if ($request->hasFile('documents')) {
    //                 $documents = $request->file('documents');
    //                 $documentNames = $request->input('document_name');

    //                 foreach ($documents as $index => $document) {
    //                     // Ensure there's a corresponding name for each document
    //                     $name = $documentNames[$index] ?? $document->getClientOriginalName();

    //                     $path = $document->store('documents', 'public');

    //                     Document::create([
    //                         'user_id' => $loan->user_id,
    //                         'loan_id' => $loan->loan_id,
    //                         'document_name' => $name,
    //                         'file_path' => $path,
    //                         'created_at' => now(),
    //                         'updated_at' => now(),
    //                     ]);
    //                 }
    //             }

    //             // Send email notification if the status has changed
    //             if ($oldStatus !== $newStatus) {
    //                 log::info('Dispatching LoanStatusUpdated event for loan ID: ' . $loan->loan_reference_id, [
    //                     'old_status' => $oldStatus,
    //                     'new_status' => $newStatus,
    //                     'loan_reference_id' => $loan->loan_reference_id,
    //                     'user_id' => auth()->id(),
    //                 ]);
    //                 event(new LoanStatusUpdated(
    //                     $loan->loan_reference_id,
    //                     auth()->id(),
    //                     auth()->user()->roles->name, // assuming you store role
    //                     $loan->status,
    //                     $loan->user_id
    //                 ));
    //                 $customer = $loan->user;
    //                 $customerEmail = $customer->email_id;
    //                 $customerName = $customer->name;
    //                 $status = $newStatus;
    //                 $remarks = $request->input('remarks');
    //                 $msg = "Your loan status has been updated to: $status. Remarks: $remarks";
    //                 $temp_id = 4; // Example template ID, adjust accordingly
    //                 app(UsersController::class)->temail($customerEmail, $customerName, $msg, $temp_id);
    //             }

    //             // Start MLM Insertion
    //             // if ($newStatus == 'disbursed') {
    //             //     $name = $customerName;
    //             //     $parent = $loan->referral_user_id;
    //             //     $nodeInserted = app(CategoryController::class)->addNode($parent, $name);
    //             //     $amount_approved = $loan->amount_approved;

    //             //     $userId = $loan->user_id;
    //             //     app(CategoryController::class)->commission_destribution($parent, $amount_approved, $userId);
    //             // }

    //             if ($newStatus == 'disbursed') {
    //                 $loan->amount_approved = $request->input('amount_approved');
    //                 $loan->status = $newStatus; // Set status again, to be sure
    //                 $loan->save(); // Explicitly save all changes

    //                 Log::info('Loan approved amount set for loan ID: ' . $loan->loan_id);

    //                 // Handle tree node addition
    //                 $referralUser = User::find($loan->referral_user_id);

    //                 if (!$referralUser) {
    //                     Log::warning("Referral user not found for ID: {$loan->referral_user_id}. Searching for next available node.");
    //                     $parentNode = app(CategoryController::class)->findNextAvailableNode();

    //                     if (!$parentNode) {
    //                         Log::error("No available position found in the tree.");
    //                         return;
    //                     }

    //                     $parentUserId = $parentNode->user_id;
    //                 } else {
    //                     Log::info("Referral user found: " . json_encode($referralUser->toArray()));
    //                     $parentUserId = $referralUser->id;
    //                 }

    //                 $childName = $loan->user->name;
    //                 $childUserId = $loan->user->id;

    //                 $existingCategory = DB::table('categories')->where('user_id', $childUserId)->first();

    //                 if ($existingCategory) {
    //                     Log::info("User already exists in the tree. Skipping node insertion for user ID: {$childUserId}");
    //                 } else {
    //                     if (app(CategoryController::class)->addNode($parentUserId, $childName, $childUserId)) {
    //                         Log::info("Node successfully inserted into tree for loan applicant.");
    //                     } else {
    //                         Log::error("Failed to insert node into tree for loan applicant.");
    //                         return;
    //                     }
    //                 }

    //                 // Fetch ancestors for commission distribution
    //                 $childCategory = DB::table('categories')->where('user_id', $childUserId)->first();

    //                 if (!$childCategory) {
    //                     Log::error("Category not found for Child User ID: {$childUserId}");
    //                     return;
    //                 }

    //                 $ancestors = DB::table('categories')
    //                     ->where('_lft', '<', $childCategory->_lft)
    //                     ->where('_rgt', '>', $childCategory->_rgt)
    //                     ->orderBy('_lft', 'asc')
    //                     ->get();

    //                 if ($ancestors->isEmpty()) {
    //                     Log::info("No ancestors found for Child User ID: {$childUserId}. Skipping commission distribution.");
    //                     return;
    //                 }

    //                 // Distribute commission
    //                 app(CategoryController::class)->commissionDistribution($childUserId, $loan->amount_approved);

    //                 if ($referralUser) {
    //                     Log::info("Commission distribution executed for user: {$loan->user_id}, Parent: {$referralUser->name}");
    //                 } else {
    //                     Log::info("Commission distribution executed for user: {$loan->user_id}, No valid referral user found.");
    //                 }
    //             }
    //         });



    //         return redirect()->back()->with('success', 'Loan updated successfully!');
    //     } catch (\Exception $e) {
    //         \Log::error('Error updating loan', ['exception' => $e->getMessage()]);
    //         if ($request->expectsJson()) {
    //             return response()->json(['status' => 0, 'msg' => 'An error occurred while updating: ' . $e->getMessage()]);
    //         }
    //         return redirect()->back()->withErrors(['error' => 'An error occurred while updating: ' . $e->getMessage()])->withInput();
    //     }
    // }

// public function update(Request $request)
// {
//     try {

//         // ✅ VALIDATION (CORRECT)
//         $request->validate([
//             'loan_id'           => 'required|integer',
//             'status'            => 'required|string',
//             'loan_category_id'  => 'required|integer',
//             'amount'            => 'required|numeric|min:0',
//             'amount_approved' => 'required_if:status,approved,disbursed',
//             'tenure'            => 'required|integer',
//             'in_principle'      => 'nullable|string',
//             'remarks'           => 'nullable|string',
//             'sanction_letter' => 'required_if:status,approved,disbursed|file|mimes:pdf,doc,docx|max:2048',

//             'documents.*'       => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
//         ]);

//         DB::transaction(function () use ($request) {

//             $loan = Loan::where('loan_id', $request->loan_id)->firstOrFail();

//             $oldStatus = $loan->status;
//             $newStatus = $request->status;

//             // ✅ UPDATE LOAN
//             $loan->update([
//                 'loan_category_id' => $request->loan_category_id,
//                 'amount'           => $request->amount,
//                 'tenure'           => $request->tenure,
//                 'status'           => $newStatus,
//                 'remarks'          => $request->remarks,
//                 'in_principle'     => $request->in_principle,
//                 'amount_approved'  => $request->amount_approved,
//             ]);

//             // ✅ SAVE REMARKS
//             if (!empty($request->remarks)) {
//                 DB::table('loan_remarks')->insert([
//                     'loan_id'    => $loan->loan_id,
//                     'agent_id'   => auth()->id(), // ✅ safer than session()
//                     'status'     => $newStatus,
//                     'remarks'    => $request->remarks,
//                     'created_at' => now(),
//                     'updated_at' => now(),
//                 ]);
//             }

//            if ($request->hasFile('sanction_letter')) {

//     $file = $request->file('sanction_letter');

//     $filename = uniqid().'_'.$file->getClientOriginalName();

//     // store file
//     $path = $file->storeAs('sanction_letters', $filename, 'public');

//     // ✅ save FULL path
//     $loan->sanction_letter = $path; // sanction_letters/filename.pdf
//     $loan->save();
// }


//             // ✅ DOCUMENT UPLOAD
//             if ($request->hasFile('documents')) {
//                 foreach ($request->file('documents') as $index => $doc) {
//                     $path = $doc->store('documents', 'public');

//                     Document::create([
//                         'user_id'       => $loan->user_id,
//                         'loan_id'       => $loan->loan_id,
//                         'document_name' => $request->document_name[$index] ?? $doc->getClientOriginalName(),
//                         'file_path'     => $path,
//                     ]);
//                 }
//             }

//             // ✅ STATUS CHANGE EVENT + EMAIL
//             if ($oldStatus !== $newStatus) {

//                 $roleName = auth()->user()?->roles?->first()?->name ?? null;

//                 event(new LoanStatusUpdated(
//                     $loan->loan_reference_id,
//                     auth()->id(),
//                     $roleName,
//                     $newStatus,
//                     $loan->user_id
//                 ));

//                 $customer = $loan->user;
//                 app(UsersController::class)->temail(
//                     $customer->email_id,
//                     $customer->name,
//                     "Your loan status has been updated to: $newStatus. Remarks: {$request->remarks}",
//                     4
//                 );
//             }

//             // ✅ MLM / COMMISSION (ONLY WHEN DISBURSED)
//             if ($newStatus === 'disbursed') {

//                 $referralUser = User::find($loan->referral_user_id);

//                 $parentUserId = $referralUser?->id
//                     ?? app(CategoryController::class)->findNextAvailableNode()?->user_id
//                     ?? throw new \Exception('No parent node available');

//                 $childUserId = $loan->user_id;

//                 if (!DB::table('categories')->where('user_id', $childUserId)->exists()) {
//                     app(CategoryController::class)->addNode(
//                         $parentUserId,
//                         $loan->user->name,
//                         $childUserId
//                     );
//                 }

//                 app(CategoryController::class)->commissionDistribution(
//                     $childUserId,
//                     $loan->amount_approved
//                 );
//             }
//         });

//         // ✅ JSON RESPONSE FOR AJAX
//         return response()->json([
//             'status' => 1,
//             'msg' => 'Loan updated successfully'
//         ]);

//     } catch (\Exception $e) {

//         return response()->json([
//             'status' => 0,
//             'msg' => $e->getMessage()
//         ], 422);
//     }
// }
// public function update(Request $request)
// {
//     try {

//         Log::info('Loan update request initiated', [
//             'loan_id'      => $request->loan_id,
//             'requested_by' => auth()->id(),
//         ]);

//         // 🔹 Fetch loan
//         $loan = Loan::where('loan_id', $request->loan_id)->firstOrFail();
//         $user = auth()->user();

//         /**
//          * -------------------------------------------------
//          * ✅ VALIDATION (FIXED)
//          * -------------------------------------------------
//          */
//         $rules = [
//             // loan
//             'loan_id'          => 'required|integer',
//             'status'           => 'required|string',
//             'loan_category_id' => 'required|integer',
//             'amount'           => 'required|numeric|min:0',
//             'tenure'           => 'required|integer',
//             'in_principle'     => 'nullable|string',
//             'remarks'          => 'nullable|string',
//             'amount_approved'  => 'nullable|numeric|min:0',

//             // user
//             'name'             => 'nullable|string|max:255',
//             'mobile_no'        => 'nullable|string|max:15',

//             // profile
//             'marital_status'   => 'nullable|string',
//             'dob'              => 'nullable|date',
//             'residence_address'=> 'nullable|string',
//             'city'             => 'nullable|string',
//             'state'            => 'nullable|string',
//             'pincode'          => 'nullable|string',

//             // professional
//             'company_name'     => 'nullable|string',
//             'industry'         => 'nullable|string',
//             'company_address'  => 'nullable|string',
//             'experience_year'  => 'nullable|numeric',
//             'designation'      => 'nullable|string',
//             'netsalary'        => 'nullable|numeric',

//             // files
//             'documents.*'      => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
//         ];

//         if (in_array($request->status, ['approved', 'disbursed']) && empty($loan->sanction_letter)) {
//             $rules['sanction_letter'] = 'required|file|mimes:pdf,doc,docx|max:2048';
//         }

//         $request->validate($rules);

//         /**
//          * -------------------------------------------------
//          * ✅ TRANSACTION
//          * -------------------------------------------------
//          */
//         DB::transaction(function () use ($request, $loan, $user) {

//             $oldStatus = $loan->status;
//             $newStatus = $request->status;

//             // =========================
//             // ✅ UPDATE USERS
//             // =========================
//             User::where('id', $loan->user_id)->update(array_filter([
//                 'name'       => $request->name,
//                 'mobile_no'  => $request->mobile_no,
//             ]));

//             // =========================
//             // ✅ UPDATE PROFILE
//             // =========================
//             Profile::updateOrCreate(
//                 ['user_id' => $loan->user_id],
//                 array_filter([
//                     'marital_status'    => $request->marital_status,
//                     'dob'               => $request->dob,
//                     'residence_address' => $request->residence_address,
//                     'city'              => $request->city,
//                     'state'             => $request->state,
//                     'pincode'           => $request->pincode,
//                 ])
//             );

//             // =========================
//             // ✅ UPDATE PROFESSIONAL
//             // =========================
//             Professional::updateOrCreate(
//                 ['user_id' => $loan->user_id],
//                 array_filter([
//                     'company_name'    => $request->company_name,
//                     'industry'        => $request->industry,
//                     'company_address' => $request->company_address,
//                     'experience_year' => $request->experience_year,
//                     'designation'     => $request->designation,
//                     'netsalary'       => $request->netsalary,
//                 ])
//             );

//             // =========================
//             // ✅ UPDATE LOAN
//             // =========================
//             $loan->update([
//                 'loan_category_id' => $request->loan_category_id,
//                 'amount'           => $request->amount,
//                 'tenure'           => $request->tenure,
//                 'status'           => $newStatus,
//                 'remarks'          => $request->remarks,
//                 'in_principle'     => $request->in_principle,
//                 'amount_approved'  => $request->amount_approved,
//             ]);

//             // =========================
// // ✅ SANCTION LETTER (AS-IT-IS FROM OLD CODE)
// // =========================
// if ($request->hasFile('sanction_letter')) {

//     // delete old file if exists
//     if ($loan->sanction_letter && Storage::disk('public')->exists($loan->sanction_letter)) {
//         Storage::disk('public')->delete($loan->sanction_letter);
//     }

//     $file = $request->file('sanction_letter');

//     $filename = uniqid().'_'.$file->getClientOriginalName();

//     // store file
//     $path = $file->storeAs('sanction_letters', $filename, 'public');

//     // save FULL path
//     $loan->sanction_letter = $path;
//     $loan->save();
// }


//             // =========================
//             // ✅ DOCUMENTS
//             // =========================
//             if ($request->hasFile('documents')) {
//                 foreach ($request->file('documents') as $index => $doc) {
//                     Document::create([
//                         'user_id'       => $loan->user_id,
//                         'loan_id'       => $loan->loan_id,
//                         'document_name' => $request->document_name[$index]
//                             ?? $doc->getClientOriginalName(),
//                         'file_path'     => $doc->store('documents', 'public'),
//                     ]);
//                 }
//             }

//             // =========================
//             // ✅ STATUS EVENT
//             // =========================
//             if ($oldStatus !== $newStatus) {
//                 event(new LoanStatusUpdated(
//                     $loan->loan_reference_id,
//                     $user->id,
//                     $user->role_id,
//                     $newStatus,
//                     $loan->user_id
//                 ));
//             }
//         });

//         return response()->json([
//             'status' => 1,
//             'msg'    => 'Loan updated successfully'
//         ]);

//     } catch (\Throwable $e) {

//         Log::error('Loan update failed', [
//             'loan_id' => $request->loan_id,
//             'error'   => $e->getMessage(),
//         ]);

//         return response()->json([
//             'status' => 0,
//             'msg'    => $e->getMessage()
//         ], 422);
//     }
// }

public function update(Request $request)
{
    try {
        $loan = Loan::where('loan_id', $request->loan_id)->firstOrFail();


        // ===============================
        // VALIDATION (UNCHANGED)
        // ===============================
        // $validated = $request->validate([
        //     'loan_id' => 'required|integer',
        //     'status' => 'required|string',
        //     'loan_category_id' => 'required|integer',
        //     'amount' => 'required|numeric',
        //     'amount_approved' => ['required_if:status,disbursed', 'nullable', 'numeric', 'min:0'],
        //     'tenure' => 'required|integer',
        //     'in_principle' => 'nullable|string',
        //     'remarks' => 'nullable|string',
        //     // 'sanction_letter' => 'nullable|file|mimes:pdf,doc,docx',
        //     'documents.*' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120'
        // ]);
        $rules = [
    'loan_id'           => 'required|integer',
    'status'            => 'required|string',
    'loan_category_id'  => 'required|integer',
    'amount'            => 'required|numeric',
    'amount_approved'   => 'required_if:status,disbursed|nullable|numeric|min:0',
    'tenure'            => 'required|integer',
    'in_principle'      => 'nullable|string',
    'remarks'           => 'nullable|string',
    'documents.*'       => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
];
           // ===============================
        // 🔴 SANCTION LETTER CONDITION (ONLY FOR DISBURSED)
        // ===============================
        if (
            $request->status === 'disbursed'
            && !$request->hasFile('sanction_letter')
            && empty($loan->sanction_letter)
        ) {
            $rules['sanction_letter'] = 'required|file|mimes:pdf,doc,docx';
        } else {
            $rules['sanction_letter'] = 'nullable|file|mimes:pdf,doc,docx';
        }
        $request->validate(
    $rules,
    [
        'sanction_letter.required' =>
            'Please upload the sanction letter before disbursing the loan.'
    ]
);


        DB::transaction(function () use ($request) {

            // ===============================
            // FETCH LOAN
            // ===============================
            $loan = Loan::where('loan_id', $request->loan_id)->firstOrFail();
            $oldStatus = $loan->status;
            $newStatus = $request->status;

            Log::info('Loan status update', [
                'loan_id' => $loan->loan_id,
                'old_status' => $oldStatus,
                'new_status' => $newStatus,
            ]);

            // ===============================
            // UPDATE LOAN BASIC DETAILS
            // ===============================
            $loan->loan_category_id = $request->loan_category_id;
            $loan->amount = $request->amount;
            $loan->tenure = $request->tenure;
            $loan->status = $newStatus;
            $loan->remarks = $request->remarks;
            $loan->in_principle = $request->in_principle;
            $loan->amount_approved = $request->amount_approved;
            $loan->save();

            // ===============================
            // SAVE REMARKS
            // ===============================
            if ($request->remarks) {
                DB::table('loan_remarks')->insert([
                    'loan_id' => $loan->loan_id,
                    'agent_id' => session()->get('user_id'),
                    'status' => $newStatus,
                    'remarks' => $request->remarks,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // ===============================
            // SANCTION LETTER UPLOAD
            // ===============================
            if ($request->hasFile('sanction_letter')) {

                if ($loan->sanction_letter && Storage::disk('public')->exists($loan->sanction_letter)) {
                    Storage::disk('public')->delete($loan->sanction_letter);
                }

                $file = $request->file('sanction_letter');
                $filename = uniqid() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('sanction_letters', $filename, 'public');

                $loan->sanction_letter = $path;
                $loan->save();
            }

            // ===============================
            // DOCUMENT UPLOADS
            // ===============================
            if ($request->hasFile('documents')) {
                foreach ($request->file('documents') as $index => $document) {

                    $name = $request->document_name[$index] ?? $document->getClientOriginalName();
                    $path = $document->store('documents', 'public');

                    Document::create([
                        'user_id' => $loan->user_id,
                        'loan_id' => $loan->loan_id,
                        'document_name' => $name,
                        'file_path' => $path,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            // ===============================
            // EMAIL & EVENT (UNCHANGED)
            // ===============================
            if ($oldStatus !== $newStatus) {

                event(new LoanStatusUpdated(
                    $loan->loan_reference_id,
                    auth()->id(),
                    auth()->user()->roles->name,
                    $loan->status,
                    $loan->user_id
                ));

                $customer = $loan->user;
                app(UsersController::class)->temail(
                    $customer->email_id,
                    $customer->name,
                    "Your loan status has been updated to: {$newStatus}. Remarks: {$request->remarks}",
                    4
                );
            }

            // ==================================================
            // DISBURSED LOGIC (CORRECTED & FINAL)
            // ==================================================
            if ($newStatus === 'disbursed') {

                $childUserId = $loan->user_id;
                $childName = $loan->user->name;

                // -------------------------------
                // MLM INSERTION (ONLY ONCE)
                // -------------------------------
                $existsInMLM = DB::table('categories')
                    ->where('user_id', $childUserId)
                    ->exists();

                if (!$existsInMLM) {

                    $parentUserId = null;

                    if ($loan->referral_user_id) {
                        $referralUser = User::find($loan->referral_user_id);
                        if ($referralUser) {
                            $parentUserId = $referralUser->id;
                        }
                    }

                    if (!$parentUserId) {
                        $parentNode = app(CategoryController::class)->findNextAvailableNode();
                        if ($parentNode) {
                            $parentUserId = $parentNode->user_id;
                        }
                    }

                    if ($parentUserId) {
                        app(CategoryController::class)
                            ->addNode($parentUserId, $childName, $childUserId);
                    }
                }

                // -------------------------------
                // COMMISSION (EVERY LOAN)
                // -------------------------------
                $childCategory = DB::table('categories')
                    ->where('user_id', $childUserId)
                    ->first();

                if ($childCategory) {
                    app(CategoryController::class)
                        ->commissionDistribution($childUserId, $loan->amount_approved);
                }
            }
        });

        return redirect()->back()->with('success', 'Loan updated successfully!');

    } catch (\Exception $e) {

        Log::error('Error updating loan', ['exception' => $e->getMessage()]);

        if ($request->expectsJson()) {
            return response()->json(['status' => 0, 'msg' => $e->getMessage()]);
        }

        return redirect()->back()
            ->withErrors(['error' => $e->getMessage()])
            ->withInput();
    }
}



    //admin
    public function inprocess()
    {
        $data['loans'] = DB::table('loans')
            ->join('users', 'loans.user_id', '=', 'users.id')
            ->join('loan_category', 'loans.loan_category_id', '=', 'loan_category.loan_category_id')
            ->where('loans.status', 'in process')
            ->whereNotNull('loans.loan_reference_id') // Ensure loan_reference_id is present
            ->select('loans.*', 'users.name as user_name', 'loan_category.category_name as category_name')
            ->paginate(10);

        $data['users'] = DB::table('users')->get();
        $data['loanCategories'] = DB::table('loan_category')->get();
        $data['agents'] = DB::table('users')->where('role_id', 2)->get();

        return view('frontend.in-process', compact('data'));
    }
    public function approved()
    {
        // Fetch approved loans with necessary joins and only include loans with a loan_reference_id
        $data['loans'] = DB::table('loans')
            ->join('users', 'loans.user_id', '=', 'users.id')
            ->join('loan_category', 'loans.loan_category_id', '=', 'loan_category.loan_category_id')
            ->where('loans.status', 'approved')
            ->whereNotNull('loans.loan_reference_id') // Ensure loan_reference_id is present
            ->select('loans.*', 'users.name as user_name', 'loan_category.category_name')
            ->paginate(10);

        // Fetch users, loan categories, and agents for other purposes
        $data['users'] = DB::table('users')->get();
        $data['loanCategories'] = DB::table('loan_category')->get();
        $data['agents'] = DB::table('users')->where('role_id', 2)->get();

        // Pass data to the view
        return view('frontend.approved_loans', compact('data'));
    }
    //admin
    public function rejected()
    {
        $data['loans'] = DB::table('loans')
            ->join('users', 'loans.user_id', '=', 'users.id')
            ->join('loan_category', 'loans.loan_category_id', '=', 'loan_category.loan_category_id')
            ->select('loans.loan_id', 'loans.loan_reference_id', 'loans.amount', 'loans.tenure', 'users.name as user_name', 'loan_category.category_name')
            ->where('loans.status', 'rejected')
            ->whereNotNull('loans.loan_reference_id')
            ->paginate(10);

        return view('frontend.rejected_loans', compact('data'));
    }
    //admin
    public function disbursed()
    {
        $data['loans'] = DB::table('loans')
            ->join('users', 'loans.user_id', '=', 'users.id')
            ->join('loan_category', 'loans.loan_category_id', '=', 'loan_category.loan_category_id')
            ->select('loans.loan_id', 'loans.loan_reference_id', 'loans.amount', 'loans.tenure', 'users.name as user_name', 'loan_category.category_name')
            ->where('loans.status', 'disbursed')
            ->whereNotNull('loans.loan_reference_id')
            ->paginate(10);

        return view('frontend.disbursed_loans', compact('data'));
    }
    public function getCities($state_id)
    {
        $cities = DB::table('cities')->where('state_id', $state_id)->get();
        return response()->json($cities);
    }
    // public function start_loan($id)
    // {
    //     $currentStep = 1;
    //     Session::put('is_loan', $id);
    //     $is_loan = $id;
    //     $loanCategories = DB::table('loan_category')->get();
    //     $loanBanks = DB::table('loan_bank_details')->get();
    //     $userId = session('user_id'); // Get user ID from session

    //     if (!$userId) {
    //         return redirect()->route('login')->withErrors('User session expired. Please log in again.');
    //     }

    //     // Fetch existing data
    //     $profile = DB::table('profile')->where('user_id', $userId)->first();
    //     $professional = DB::table('professional_details')->where('user_id', $userId)->first();
    //     $education = DB::table('education_details')->where('user_id', $userId)->first();
    //     $existingLoans = DB::table('existing_loan')->where('user_id', $userId)->get();
    //     $documents = DB::table('documents')->where('user_id', $userId)->get();
    //     $loan = DB::table('loans')
    //         ->select('loan_id', 'loan_reference_id', 'status', 'loan_category_id', 'bank_id') // Include loan_category_id
    //         ->where('user_id', $userId)
    //         ->first();
    //     $hasExistingLoan = !is_null($existingLoans);
    //     $states = DB::table('states')->get();
    //     $user = DB::table('users')->where('id', $userId)->first();
    //     return view('frontend.professional-info', compact(
    //         'currentStep',
    //         'is_loan',
    //         'loanCategories',
    //         'states',
    //         'hasExistingLoan',
    //         'loanBanks',
    //         'profile',
    //         'professional',
    //         'education',
    //         'existingLoans',
    //         'documents',
    //         'loan'
    //     ));
    // }




    public function start_loan($id)
{
    Session::put('is_loan', $id);
    $is_loan = $id;

    $userId = session('user_id');
    if (!$userId) {
        return redirect()->route('login')
            ->withErrors('User session expired. Please log in again.');
    }

    // ===============================
    // STEP TRACKING LOGIC ⭐⭐⭐
    // ===============================
    $currentStep = 1;
    $completedSteps = [];

    // Step 1: Personal profile
    $profile = DB::table('profile')->where('user_id', $userId)->first();
    if ($profile) {
        $completedSteps[] = 1;
        $currentStep = 2;
    }

    // Step 2: Professional details
    $professional = DB::table('professional_details')->where('user_id', $userId)->first();
    if ($professional) {
        $completedSteps[] = 2;
        $currentStep = 3;
    }

    // Step 3: Education details
    $education = DB::table('education_details')->where('user_id', $userId)->first();
    if ($education) {
        $completedSteps[] = 3;
        $currentStep = 4;
    }

    // ===============================
    // OTHER DATA
    // ===============================
    $loanCategories = DB::table('loan_category')->get();
    $loanBanks = DB::table('loan_bank_details')->get();
    $existingLoans = DB::table('existing_loan')->where('user_id', $userId)->get();
    $documents = DB::table('documents')->where('user_id', $userId)->get();

    $loan = DB::table('loans')
        ->select('loan_id', 'loan_reference_id', 'status', 'loan_category_id', 'bank_id')
        ->where('user_id', $userId)
        ->first();

    $hasExistingLoan = $existingLoans->count() > 0;
    $states = DB::table('states')->get();
    $user = DB::table('users')->where('id', $userId)->first();

    return view('frontend.professional-info', compact(
        'currentStep',
        'completedSteps',   // ⭐⭐ IMPORTANT
        'is_loan',
        'loanCategories',
        'states',
        'hasExistingLoan',
        'loanBanks',
        'profile',
        'professional',
        'education',
        'existingLoans',
        'documents',
        'loan',
        'user'
    ));
}

public function showForm(Request $request)
{
    /* =========================================================
       🔴 ADMIN: NEW APPLICATION RESET (FIRST LOAD ONLY)
       ========================================================= */
    if (session('role_id') == 4 && !$request->has('current_step')) {

        Log::info('ADMIN clicked NEW LOAN APPLICATION', [
            'admin_id'            => session('user_id'),
            'old_selected_user_id'=> session('selected_user_id'),
            'old_current_loan_id' => session('current_loan_id'),
        ]);

        session()->forget([
            'selected_user_id',
            'current_loan_id',
            'loan_reference_id',
            'loan_category_id',
            'bank_id',
            'is_loan',
        ]);

        Log::info('ADMIN loan session CLEARED successfully');
    }

    /* ========================================================= */

    $currentStep = $request->input('current_step', 1);

    /* ---------------- LAYOUT ---------------- */
    $layout = 'frontend.layouts.header';
    if (session('role_id') == 4) {
        $layout = 'layouts.header';
    }

    /* ---------------- VALIDATION ---------------- */
    if ($request->isMethod('post')) {

        $rules = [
            'mobile_no' => ['required', 'digits:10', 'regex:/^[6-9]\d{9}$/'],
            'otp'       => ['required', 'digits:6'],
            'pincode'   => ['required', 'digits:6', 'regex:/^[1-9][0-9]{5}$/'],
            'email'     => ['required', 'email'],
            'name'      => ['required', 'string', 'max:255'],
            'state_id'  => ['required', 'integer', 'exists:states,id'],
        ];

        $messages = [
            'mobile_no.required' => 'Please enter your mobile number.',
            'mobile_no.digits'   => 'Mobile number must be 10 digits.',
            'mobile_no.regex'    => 'Please enter a valid mobile number.',
            'otp.required'       => 'Please enter OTP.',
            'otp.digits'         => 'OTP must be exactly 6 digits.',
            'pincode.required'   => 'Please enter your pincode.',
            'pincode.digits'     => 'Pincode must be exactly 6 digits.',
            'pincode.regex'      => 'Please enter a valid pincode.',
            'email.required'     => 'Please enter your email.',
            'email.email'        => 'Please enter a valid email address.',
            'name.required'      => 'Please enter your full name.',
            'state_id.required'  => 'Please select your state.',
        ];

        $request->validate($rules, $messages);
    }

    /* ---------------- COMMON DATA ---------------- */

    $loanCategories = DB::table('loan_category')->get();
    $loanBanks      = DB::table('loan_bank_details')->get();

    $userId = session('user_id');
    if (!$userId) {
        return redirect()->route('login')
            ->withErrors('User session expired. Please log in again.');
    }

    Log::info('Loan session check', [
        'admin_id'         => $userId,
        'current_step'     => $currentStep,
        'selected_user_id' => session('selected_user_id'),
        'current_loan_id'  => session('current_loan_id'),
        'db_disbursed_loan'=> Loan::where('user_id', $userId)
            ->where('status', 'disbursed')
            ->value('loan_id'),
    ]);

    /* ---------------- ADMIN USER LIST ---------------- */

    $loanUsers = collect();

    if (session('role_id') == 4) {
        $loanUsers = User::join('otp', 'otp.user_id', '=', 'users.id')
            ->where('users.role_id', 1)
            ->where('otp.is_verify', 1)
            ->where('users.is_email_verify', 1) // ✅ ACTIVE USERS ONLY
        ->whereNull('users.deleted_at') // ✅ ignore deleted users
            ->select(
                'users.id',
                'users.name',
                'users.email_id',
                'users.mobile_no'
            )
            ->distinct()
            ->get();
    }

    /* =========================================================
       🔐 USER DATA LOADING CONTROL
       ========================================================= */

    $selectedUserId   = session('selected_user_id');
    $canLoadUserData  = true;

    if (session('role_id') == 4 && !$selectedUserId) {
        $canLoadUserData = false;
    }

    Log::info('User data load decision', [
        'role_id'          => session('role_id'),
        'selected_user_id' => $selectedUserId,
        'canLoadUserData'  => $canLoadUserData,
    ]);

    /* ---------------- USER RELATED TABLES ---------------- */

    $effectiveUserId = $selectedUserId ?? $userId;

    $profile = $canLoadUserData
        ? DB::table('profile')->where('user_id', $effectiveUserId)->latest('profile_id')->first()
        : null;

    $professional = $canLoadUserData
        ? DB::table('professional_details')->where('user_id', $effectiveUserId)->latest('professional_id')->first()
        : null;

    $education = $canLoadUserData
        ? DB::table('education_details')->where('user_id', $effectiveUserId)->latest('edu_id')->first()
        : null;

    $documents = $canLoadUserData
        ? DB::table('documents')->where('user_id', $effectiveUserId)->latest('document_id')->get()
        : collect();

    $existingLoans = $canLoadUserData
        ? DB::table('existing_loan')->where('user_id', $effectiveUserId)->latest('existing_loan_id')->get()
        : collect();

    /* ---------------- LOAN ---------------- */

    $loan = $canLoadUserData
        ? Loan::where('user_id', $effectiveUserId)
            ->whereNotIn('status', ['disbursed', 'rejected'])
            ->first()
        : null;

    $hasExistingLoan = $canLoadUserData && $existingLoans->count() > 0;

    /* ---------------- USER MODEL ---------------- */

    $user = $canLoadUserData
        ? User::with('loans')->where('id', $effectiveUserId)->first()
        : null;

    /* ---------------- COMMON ---------------- */

    $states  = DB::table('states')->get();
    $is_loan = Session::get('is_loan');

    /* ---------------- COMPLETED STEPS (UNCHANGED) ---------------- */

    $completedSteps = [];

    if ($profile && $currentStep > 1)                $completedSteps[] = 1;
    if ($professional && $currentStep > 2)           $completedSteps[] = 2;
    if ($education && $currentStep > 3)              $completedSteps[] = 3;
    if ($documents->count() > 0 && $currentStep > 4) $completedSteps[] = 4;
    if ($loan && $currentStep > 5)                   $completedSteps[] = 5;

    /* ---------------- VIEW ---------------- */

    return view('frontend.professional-info', compact(
        'currentStep',
        'layout',
        'loanCategories',
        'states',
        'hasExistingLoan',
        'loanBanks',
        'profile',
        'professional',
        'education',
        'existingLoans',
        'documents',
        'loan',
        'is_loan',
        'user',
        'loanUsers',
        'completedSteps'
    ));
}







// public function ajaxList(Request $request)
// {
//     $type = $request->type;

//     $query = Loan::query();

//     if ($type === 'pending') {
//         $query->whereNull('assigned_to');
//     }
//     elseif ($type === 'inprocess') {
//         $query->where('status', 'inprocess');
//     }
//     elseif ($type === 'approved') {
//         $query->where('status', 'approved');
//     }
//     elseif ($type === 'disbursed') {
//         $query->where('status', 'disbursed');
//     }
//     elseif ($type === 'rejected') {
//         $query->where('status', 'rejected');
//     }
//     elseif ($type === 'trashed') {
//         $query->onlyTrashed();
//     }

//     // ✅ NEW FIRST (LATEST)
//     $loans = $query->latest()->paginate(10);
//     // OR
//     // $loans = $query->orderBy('created_at', 'desc')->paginate(10);

//     return view('partials.list', compact('loans'))->render();
// }

public function ajaxList(Request $request)
{
    $search = $request->search;
    $type   = $request->type;

    $query = Loan::query();

    if ($search) {
    $query->where(function ($q) use ($search) {

        // Applicant name
        $q->whereHas('user', function ($u) use ($search) {
            $u->where('name', 'LIKE', "%{$search}%");
        })

        // Loan category name
        ->orWhereHas('loanCategory', function ($c) use ($search) {
            $c->where('category_name', 'LIKE', "%{$search}%");
        })

        // Loan Reference ID (NOT loan_id)
        ->orWhere('loan_reference_id', 'LIKE', "%{$search}%");
    });
}

    if ($type === 'pending') {
        $query->whereNull('assigned_to');
    } elseif ($type === 'inprocess') {
        $query->where('status', 'inprocess');
    } elseif ($type === 'approved') {
        $query->where('status', 'approved');
    } elseif ($type === 'disbursed') {
        $query->where('status', 'disbursed');
    } elseif ($type === 'rejected') {
        $query->where('status', 'rejected');
    } elseif ($type === 'trashed') {
        $query->onlyTrashed();
    }

    $loans = $query->latest()->paginate(10);

    return view('partials.list', compact('loans'));
}


// public function ajaxPendingLoans()
// {
//     $pendingLoans = DB::table('loans')
//         ->leftJoin('users', 'loans.user_id', '=', 'users.id')
//         ->leftJoin('loan_category', 'loans.loan_category_id', '=', 'loan_category.loan_category_id')
//         ->where(function ($query) {
//             $query->whereNull('loans.agent_id')
//                 ->orWhere(function ($subQuery) {
//                     $subQuery->whereNotNull('loans.agent_id')
//                         ->whereIn('loans.agent_action', ['pending', 'rejected'])
//                         ->orWhereNull('loans.agent_action');
//                 });
//         })
//         ->select(
//             'loans.*',
//             'users.name as user_name',
//             'loan_category.category_name as category_name'
//         )
//         ->orderByDesc('loans.created_at')
//         ->paginate(10);

//     $agents = DB::table('users')->where('role_id', 2)->get();

//     return view('partials.pending-loans', compact('pendingLoans', 'agents'));
// }

public function ajaxPendingLoans(Request $request)
{
    $search = $request->search;

    $pendingLoans = DB::table('loans')
        ->leftJoin('users', 'loans.user_id', '=', 'users.id')
        ->leftJoin('loan_category', 'loans.loan_category_id', '=', 'loan_category.loan_category_id')

        ->where(function ($query) {
            $query->whereNull('loans.agent_id')
                ->orWhere(function ($q) {
                    $q->whereNotNull('loans.agent_id')
                      ->where('loans.agent_action', 'rejected');
                });
        })

        ->when($search, function ($q) use ($search) {
            $q->where(function ($sub) use ($search) {
                $sub->where('users.name', 'LIKE', "%{$search}%")
                    ->orWhere('loan_category.category_name', 'LIKE', "%{$search}%")
                    ->orWhere('loans.loan_reference_id', 'LIKE', "%{$search}%");
            });
        })

        ->select(
            'loans.*',
            'users.name as user_name',
            'loan_category.category_name as category_name'
        )

        ->orderByDesc('loans.created_at')
        ->paginate(10)
        ->appends(['search' => $search]);

    $agents = DB::table('users')
        ->where('role_id', 2)
        ->where('is_email_verify', 1)
        ->whereNull('deleted_at')
        ->get();

    // 🔥 IMPORTANT FIX FOR AJAX PAGINATION
    if ($request->ajax()) {
        return view('partials.pending-loans', compact('pendingLoans', 'agents'))->render();
    }

    return view('admin.pending-loans', compact('pendingLoans', 'agents'));
}


// public function ajaxInprocessLoans()
// {
//     $loans = DB::table('loans')
//         ->join('users', 'loans.user_id', '=', 'users.id')
//         ->join('loan_category', 'loans.loan_category_id', '=', 'loan_category.loan_category_id')
//         ->select(
//             'loans.loan_id',
//             'loans.loan_reference_id',
//             'loans.amount',
//             'loans.tenure',
//             'users.name as user_name',
//             'loan_category.category_name'
//         )
//         ->where('loans.status', 'in process')   // ✅ only in-process
//         ->whereNull('loans.deleted_at')          // ✅ exclude trashed
//         ->orderByDesc('loans.created_at')
//         ->paginate(10);

//     return view('partials.inprocess-loans', compact('loans'));
// }






public function ajaxInprocessLoans(Request $request)
{
    $search = $request->search;

    $loans = DB::table('loans')
        ->join('users', 'loans.user_id', '=', 'users.id')
        ->join('loan_category', 'loans.loan_category_id', '=', 'loan_category.loan_category_id')
        ->where('loans.status', 'in process')          
        ->whereNotNull('loans.loan_reference_id')      
        ->whereNull('loans.deleted_at')                

        // 🔍 SAME SEARCH LOGIC
        ->when($search, function ($q) use ($search) {
            $q->where(function ($sub) use ($search) {
                $sub->where('users.name', 'LIKE', "%{$search}%")
                    ->orWhere('loan_category.category_name', 'LIKE', "%{$search}%")
                    ->orWhere('loans.loan_reference_id', 'LIKE', "%{$search}%");
            });
        })

        ->select(
            'loans.*',
            'users.name as user_name',
            'loan_category.category_name as category_name'
        )
        ->orderByDesc('loans.created_at')
        ->paginate(10)
        ->appends(['search' => $search]);

    return view('partials.inprocess-loans', compact('loans'));
}


public function ajaxTrashedLoans(Request $request)
{
    $search = $request->search;

    $loans = \App\Models\Loan::onlyTrashed()
        ->with([
            'user.profile.cityRelation',
            'loanCategory',
            'bankDetails'
        ])
        ->whereNotNull('loan_reference_id')

        // 🔍 SAME SEARCH LOGIC
        ->when($search, function ($q) use ($search) {
            $q->where(function ($sub) use ($search) {

                // Applicant name
                $sub->whereHas('user', function ($u) use ($search) {
                    $u->where('name', 'LIKE', "%{$search}%");
                })

                // Loan category
                ->orWhereHas('loanCategory', function ($c) use ($search) {
                    $c->where('category_name', 'LIKE', "%{$search}%");
                })

                // Loan Reference ID
                ->orWhere('loan_reference_id', 'LIKE', "%{$search}%");
            });
        })

        ->orderBy('deleted_at', 'desc')
        ->paginate(10)
        ->appends(['search' => $search]);

    return view('partials.trashed-loans', compact('loans'));
}

public function restoreLoan(Request $request)
{
    $loan = \App\Models\Loan::withTrashed()
        ->where('loan_id', $request->loan_id)
        ->first();

    if (!$loan) {
        return response()->json([
            'status' => 1,
            'msg' => 'Loan not found'
        ], 404);
    }

    $loan->restore();

    return response()->json([
        'status' => 0,
        'msg' => 'Loan restored successfully'
    ]);
}


public function ajaxApprovedLoans(Request $request)
{
    $search = $request->search;

    $loans = DB::table('loans')
        ->join('users', 'loans.user_id', '=', 'users.id')
        ->join('loan_category', 'loans.loan_category_id', '=', 'loan_category.loan_category_id')
        ->where('loans.status', 'approved')
        ->whereNotNull('loans.loan_reference_id')

        // 🔍 SAME SEARCH LOGIC
        ->when($search, function ($q) use ($search) {
            $q->where(function ($sub) use ($search) {
                $sub->where('users.name', 'LIKE', "%{$search}%")
                    ->orWhere('loan_category.category_name', 'LIKE', "%{$search}%")
                    ->orWhere('loans.loan_reference_id', 'LIKE', "%{$search}%");
            });
        })

        ->select(
            'loans.*',
            'users.name as user_name',
            'loan_category.category_name as loan_category_name'
        )
        ->orderByDesc('loans.created_at')
        ->paginate(10)
        ->appends(['search' => $search]);

    return view('partials.approved-loans', compact('loans'));
}




public function ajaxDisbursedLoans(Request $request)
{
    $search = $request->search;

    $loans = DB::table('loans')
        ->join('users', 'loans.user_id', '=', 'users.id')
        ->join('loan_category', 'loans.loan_category_id', '=', 'loan_category.loan_category_id')
        ->select(
            'loans.loan_id',
            'loans.loan_reference_id',
            'loans.amount',
            'loans.tenure',
            'loans.status',
            'users.name as user_name',
            'loans.amount_approved',
            'loan_category.category_name'
        )
        ->where('loans.status', 'disbursed')
        ->whereNotNull('loans.loan_reference_id')

        // 🔍 SAME SEARCH LOGIC
        ->when($search, function ($q) use ($search) {
            $q->where(function ($sub) use ($search) {
                $sub->where('users.name', 'LIKE', "%{$search}%")
                    ->orWhere('loan_category.category_name', 'LIKE', "%{$search}%")
                    ->orWhere('loans.loan_reference_id', 'LIKE', "%{$search}%");
            });
        })

        ->orderByDesc('loans.created_at')
        ->paginate(10)
        ->appends(['search' => $search]);

    return view('partials.disbursed-loans', compact('loans'));
}
public function ajaxRejectedLoans(Request $request)
{
    $role_id  = session()->get('role_id');
    $agent_id = session()->get('user_id');

    // Only agent or admin
    if ($role_id != 2 && $role_id != 4) {
        abort(403);
    }

    $search = $request->search;

    $loans = DB::table('loans')
        ->join('users', 'loans.user_id', '=', 'users.id')
        ->join('loan_category', 'loans.loan_category_id', '=', 'loan_category.loan_category_id')
        ->select(
            'loans.loan_id',
            'loans.loan_reference_id',
            'loans.amount',
            'loans.tenure',
            'loans.status',
            'users.name as user_name',
            'loan_category.category_name as loan_category_name'
        )
        ->where('loans.status', 'rejected')

        // 🔍 SAME SEARCH LOGIC
        ->when($search, function ($q) use ($search) {
            $q->where(function ($sub) use ($search) {
                $sub->where('users.name', 'LIKE', "%{$search}%")
                    ->orWhere('loan_category.category_name', 'LIKE', "%{$search}%")
                    ->orWhere('loans.loan_reference_id', 'LIKE', "%{$search}%");
            });
        })

        ->orderByDesc('loans.created_at')
        ->paginate(10)
        ->appends(['search' => $search]);

    return view('partials.rejected-loans', compact('loans'));
}



    //CreditReport

    public function fetchReport(Request $request)
    {
        $apiUrl = 'https://sandbox.surepass.io/api/v1/credit-report-experian/fetch-report';

        $apiToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJmcmVzaCI6ZmFsc2UsImlhdCI6MTc0MjgwMDI2NCwianRpIjoiZDRlOWMxM2ItYjliYS00MTUzLWJkNDQtZTc0OWE2MGIzNGQ0IiwidHlwZSI6ImFjY2VzcyIsImlkZW50aXR5IjoiZGV2Lmpmc3RlY2hub2xvZ2llc0BzdXJlcGFzcy5pbyIsIm5iZiI6MTc0MjgwMDI2NCwiZXhwIjoxNzQ1MzkyMjY0LCJlbWFpbCI6Impmc3RlY2hub2xvZ2llc0BzdXJlcGFzcy5pbyIsInRlbmFudF9pZCI6Im1haW4iLCJ1c2VyX2NsYWltcyI6eyJzY29wZXMiOlsidXNlciJdfX0.RAccsE0Rt3MNrWStW9i1LOflGeIAOWIvLGu9wrzghMw';

        // Prepare request data
        $postData = [
            'name' => $request->input('name'),
            'consent' => 'Y',
            'mobile' => $request->input('mobile'),
            'pan' => $request->input('pan'),
        ];

        // Initialize cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $apiToken,
        ]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));

        // Execute cURL request
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        // Return response to frontend
        return response()->json([
            'status' => $httpCode,
            'data' => json_decode($response, true),
        ]);
    }


    // public function handleStep(Request $request)
    // {
    //     $userId = session('user_id'); // Get user ID from session
    //     if (!$userId) {
    //         return redirect()->route('login')->withErrors('User session expired. Please log in again.');
    //     }

    //     $currentStep = $request->input('current_step');

    //     try {
    //         // Determine whether the "Previous" or "Next" button was clicked
    //         if ($request->has('previous')) {
    //             $currentStep = max(1, $currentStep - 1); // Ensure the step doesn't go below 1
    //             return redirect()->route('loan.form', ['current_step' => $currentStep]);
    //         } elseif ($request->has('next')) {
    //             // Validate and handle the current step
    //             switch ($currentStep) {
    //                 case 1:
    //                     $this->handlePersonalDetails($request, $userId);
    //                     break;
    //                 case 2:
    //                     $this->handleProfessionalDetails($request, $userId);
    //                     break;
    //                 case 3:
    //                     $this->handleEducationDetails($request, $userId);
    //                     break;

    //                 case 4:
    //                     $this->handleDocumentUpload($request, $userId);
    //                     break;
    //                 case 5:
    //                     $this->handleLoanDetails($request, $userId);

    //                     return redirect()->route('loan.thankyou');
    //                 default:
    //                     return redirect()->route('loan.form', ['current_step' => 1])
    //                         ->withErrors('Invalid step. Please restart the application process.');
    //             }

    //             // Move to the next step
    //             return redirect()->route('loan.form', ['current_step' => $currentStep + 1]);
    //         } else {
    //             return redirect()->back()->withErrors('Invalid action. Please try again.');
    //         }
    //     } catch (\Exception $e) {
    //         Log::error('Error handling step: ' . $e->getMessage(), ['stack' => $e->getTraceAsString()]);
    //         return redirect()->back()->withErrors('Something went wrong. Please try again.');
    //     }
    // }

    // public function handleStep(Request $request)
    // {
    //     $sessionUserId = session('user_id');
    //     $sessionUserRole = session('role_id');

    //     if (!$sessionUserId) {
    //         return redirect()->route('login')->withErrors('User session expired. Please log in again.');
    //     }

    //     $currentStep = $request->input('current_step');

    //     try {
    //         // Save user_id from step 1 dropdown to session if admin
    //         if ($sessionUserRole == 4 && $currentStep == 1) {
    //             $selectedUserId = $request->input('user_id');
    //             if (!$selectedUserId) {
    //                 return redirect()->back()->withErrors('Please select a user.');
    //             }
    //             session(['selected_user_id' => $selectedUserId]);
    //         }

          
    //         if ($sessionUserRole == 4) {
    //             $userId = session('selected_user_id');
    //             if (!$userId) {
    //                 return redirect()->route('loan.form', ['current_step' => 1])
    //                     ->withErrors('User not selected. Please select a user in Step 1.');
    //             }
    //         } else {
    //             $userId = $sessionUserId;
    //         }

    //         if ($request->has('previous')) {
    //             $currentStep = max(1, $currentStep - 1);
    //             return redirect()->route('loan.form', ['current_step' => $currentStep]);
    //         } elseif ($request->has('next')) {
    //             switch ($currentStep) {
    //                 case 1:
    //                     $this->handlePersonalDetails($request, $userId);
    //                     break;
    //                 case 2:
    //                     $this->handleProfessionalDetails($request, $userId);
    //                     break;
    //                 case 3:
    //                     $this->handleEducationDetails($request, $userId);
    //                     break;
    //                 case 4:
    //                     $this->handleDocumentUpload($request, $userId);
    //                     break;
    //                 case 5:
    //                     $this->handleLoanDetails($request, $userId);
    //                     return redirect()->route('loan.thankyou');
    //                 default:
    //                     return redirect()->route('loan.form', ['current_step' => 1])
    //                         ->withErrors('Invalid step. Please restart the application process.');
    //             }

    //             return redirect()->route('loan.form', ['current_step' => $currentStep + 1]);
    //         } else {
    //             return redirect()->back()->withErrors('Invalid action. Please try again.');
    //         }
    //     } catch (\Exception $e) {
    //         Log::error('Error handling step: ' . $e->getMessage(), ['stack' => $e->getTraceAsString()]);
    //         return redirect()->back()->withErrors('Something went wrong. Please try again.');
    //     }
    // }
    public function handleStep(Request $request)
{
    $sessionUserId   = session('user_id');
    $sessionUserRole = session('role_id');

    if (!$sessionUserId) {
        return redirect()->route('login');
    }

    $currentStep = (int) $request->input('current_step');

    // ADMIN user selection
    if ($sessionUserRole == 4 && $currentStep == 1) {
        if (!$request->user_id) {
            return back()->withErrors(['user_id' => 'Please select user']);
        }
        session(['selected_user_id' => $request->user_id]);
    }

    $userId = $sessionUserRole == 4
        ? session('selected_user_id')
        : $sessionUserId;

    if ($request->has('previous')) {
        return redirect()->route('loan.form', [
            'current_step' => max(1, $currentStep - 1)
        ]);
    }

    if ($request->has('next')) {

        switch ($currentStep) {
            case 1:
                $this->handlePersonalDetails($request, $userId);
                break;

            case 2:
                $this->handleProfessionalDetails($request, $userId);
                break;

            case 3:
                $this->handleDocumentUpload($request, $userId);
                break;

            case 4:
                $this->handleLoanDetails($request, $userId);
                return redirect()->route('loan.thankyou');
        }

        // ✅ ONLY if validation passed
        return redirect()->route('loan.form', [
            'current_step' => $currentStep + 1
        ]);
    }

    return back();
}

//  public function handleStep(Request $request)
//     {
//         $sessionUserId   = session('user_id');
//         $sessionUserRole = session('role_id');

//         if (!$sessionUserId) {
//             return redirect()->route('login')
//                 ->withErrors('User session expired. Please log in again.');
//         }

//         $currentStep = (int) $request->input('current_step');

//         try {

//             /* ---------------- ADMIN USER SELECTION (STEP 1) ---------------- */
//             if ($sessionUserRole == 4 && $currentStep == 1) {
//                 $selectedUserId = $request->input('user_id');
//                 if (!$selectedUserId) {
//                     return redirect()->back()->withErrors('Please select a user.');
//                 }
//                 session(['selected_user_id' => $selectedUserId]);
//             }

//             /* ---------------- USER ID RESOLUTION ---------------- */
//             if ($sessionUserRole == 4) {
//                 $userId = session('selected_user_id');
//                 if (!$userId) {
//                     return redirect()->route('loan.form', ['current_step' => 1])
//                         ->withErrors('User not selected. Please select a user in Step 1.');
//                 }
//             } else {
//                 $userId = $sessionUserId;
//             }

//             /* ---------------- PREVIOUS BUTTON ---------------- */
//             if ($request->has('previous')) {
//                 return redirect()->route('loan.form', [
//                     'current_step' => max(1, $currentStep - 1)
//                 ]);
//             }

//             /* ---------------- NEXT BUTTON ---------------- */
//             if ($request->has('next')) {

//                 switch ($currentStep) {

//                     case 1:
//                         $this->handlePersonalDetails($request, $userId);
//                         break;

//                     case 2:
//                         $this->handleProfessionalDetails($request, $userId);
//                         break;

//                     case 3:
//                         // ✅ FIX: Step-3 is Upload Documents
//                         $this->handleDocumentUpload($request, $userId);
//                         break;

//                     case 4:
//                         // ✅ FIX: Step-4 is Loan Details
//                         $this->handleLoanDetails($request, $userId);
//                         return redirect()->route('loan.thankyou');

//                     default:
//                         return redirect()->route('loan.form', ['current_step' => 1])
//                             ->withErrors('Invalid step. Please restart the application.');
//                 }

//                 // ✅ MOVE TO NEXT STEP
//                 return redirect()->route('loan.form', [
//                     'current_step' => $currentStep + 1
//                 ]);
//             }

//             return redirect()->back()->withErrors('Invalid action.');

//         } catch (\Exception $e) {
//             Log::error('Loan Step Error', [
//                 'message' => $e->getMessage(),
//                 'step'    => $currentStep,
//                 'user'    => $userId
//             ]);

//             // return redirect()->back()
//             //     ->withErrors('Something went wrong. Please try again.');
//             return redirect()->back();

//         }
//     }



    // protected function handlePersonalDetails(Request $request, $userId)
    // {
    //     $validated = $request->validate([
    //         'mobile_no' => 'required|string|max:15',
    //         'full_name' => 'required|string',
    //         'pan_number' => 'required|string',
    //         'marital_status' => 'required|string|max:50',
    //         'dob' => 'required|date',
    //         'residence_address' => 'required|string|max:255',
    //         'city' => 'required|integer|exists:cities,id',
    //         'state' => 'required|integer|exists:states,id',
    //         'pincode' => 'required|string|max:10',
    //         'loan_category_id' => 'required|integer',
    //         'bank_id' => 'required|integer',
    //     ]);

    //     $loan = Loan::where('user_id', $userId)
    //         ->whereNotIn('status', ['disbursed', 'rejected'])
    //         ->first();

    //     if (!$loan) {
           
    //         $loan = new Loan();
    //         $loan->user_id = $userId;
    //         $loan->loan_reference_id = $this->generateLoanReferenceId(); // Generate unique reference ID
    //         $loan->loan_category_id = $validated['loan_category_id'];
    //         $loan->bank_id = $validated['bank_id'];
    //         $loan->status = 'in process';
    //         $loan->save();
    //     } else {
           
    //         $loan->update([
    //             'loan_category_id' => $validated['loan_category_id'],
    //             'bank_id' => $validated['bank_id']
    //         ]);
    //     }

       
    //     DB::table('profile')->updateOrInsert(
    //         [
    //             'user_id' => $userId,
    //             'loan_id' => $loan->loan_id
    //         ],
    //         [
    //             'mobile_no' => $validated['mobile_no'],
    //             'full_name' => $validated['full_name'],
    //             'pan_number' => $validated['pan_number'],
    //             'marital_status' => $validated['marital_status'],
    //             'dob' => $validated['dob'],
    //             'residence_address' => $validated['residence_address'],
    //             'city' => $validated['city'],
    //             'state' => $validated['state'],
    //             'pincode' => $validated['pincode']
    //         ]
    //     );

   
    //     Session::put('loan_category_id', $validated['loan_category_id']);
    //     Session::put('bank_id', $validated['bank_id']);

       


    //     Session::put('current_loan_id', $loan->loan_id);
    // }
//       protected function handlePersonalDetails(Request $request, $userId)
//     {
//         $validated = $request->validate([
//             'mobile_no' => 'required|string|max:15',
//             'full_name' => 'required|string',
//             'pan_number' => 'required|string',
//             'marital_status' => 'required|string|max:50',
//             'dob' => 'required|date',
//             'residence_address' => 'required|string|max:255',
//             'city' => 'required|integer|exists:cities,id',
//             'state' => 'required|integer|exists:states,id',
//             'pincode' => 'required|string|max:10',
//             'loan_category_id' => 'required|integer',
//             'bank_id' => 'required|integer',
//         ]);

//         $loan = Loan::where('user_id', $userId)
//             ->whereNotIn('status', ['disbursed', 'rejected'])
//             ->first();

//         if (!$loan) {
           
//             $loan = new Loan();
//             $loan->user_id = $userId;
//             $loan->loan_reference_id = $this->generateLoanReferenceId(); // Generate unique reference ID
//             $loan->loan_category_id = $validated['loan_category_id'];
//             $loan->bank_id = $validated['bank_id'];
//             $loan->status = 'in process';
//             $loan->save();
//         } else {
           
//             $loan->update([
//                 'loan_category_id' => $validated['loan_category_id'],
//                 'bank_id' => $validated['bank_id']
//             ]);
//         }

       
//    Profile::updateOrCreate(
//     ['user_id' => $userId],   // ✅ ONLY user_id (UNIQUE)
//     [
//         'mobile_no'         => $validated['mobile_no'],
//         'full_name'         => $validated['full_name'],
//         'pan_number'        => $validated['pan_number'],
//         'marital_status'    => $validated['marital_status'],
//         'dob'               => $validated['dob'],
//         'residence_address' => $validated['residence_address'],
//         'city'              => $validated['city'],
//         'state'             => $validated['state'],
//         'pincode'           => $validated['pincode'],
//     ]
// );

   
//         Session::put('loan_category_id', $validated['loan_category_id']);
//         Session::put('bank_id', $validated['bank_id']);

       


//         Session::put('current_loan_id', $loan->loan_id);
//     }

// protected function handlePersonalDetails(Request $request, $userId)
// {
//     $validated = $request->validate([
//     'mobile_no' => 'required|digits:10',
//     'full_name' => 'required|string|min:3',
//     'pan_number' => 'required|regex:/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/',
//     'marital_status' => 'required',
//     'dob' => 'required|date',
//     'residence_address' => 'required|min:5',
//     'state' => 'required',
//     'city' => 'required',
//     'pincode' => 'required|digits:6',
//     'loan_category_id' => 'required',
//     'bank_id' => 'required',
// ]);

//     // ✅ ONLY PROFILE (NO LOAN HERE)
//     Profile::updateOrCreate(
//         ['user_id' => $userId],
//         [
//             'mobile_no'         => $validated['mobile_no'],
//             'full_name'         => $validated['full_name'],
//             'pan_number'        => $validated['pan_number'],
//             'marital_status'    => $validated['marital_status'],
//             'dob'               => $validated['dob'],
//             'residence_address' => $validated['residence_address'],
//             'city'              => $validated['city'],
//             'state'             => $validated['state'],
//             'pincode'           => $validated['pincode'],
//         ]
//     );

//     // store only selections
//     Session::put('loan_category_id', $validated['loan_category_id']);
//     Session::put('bank_id', $validated['bank_id']);
// }
protected function handlePersonalDetails(Request $request, $userId)
{
  // Normalize gender to lowercase
    if ($request->filled('gender')) {
        $request->merge([
            'gender' => strtolower($request->gender)
        ]);
    }

    $validated = $request->validate(
        [
            'mobile_no' => 'required|digits:10',

            // 🔴 NAME: only letters + space, no digits
            'full_name' => [
                'required',
                'regex:/^[A-Za-z ]+$/',
                'min:3'
            ],
'pan_number' => [
    'required',
    'regex:/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/',
    Rule::unique('profile', 'pan_number')->ignore($userId, 'user_id'),
],

'dob' => [
        'required',
        'date',
        'before:today',
        function ($attribute, $value, $fail) {
            if (Carbon::parse($value)->age < 18) {
                $fail('You must be at least 18 years old to apply for a loan');
            }
        },
    ],
            'marital_status' => 'required',
            'gender' => 'required|in:male,female,other',

            // 'dob' => 'required|date',
            'residence_address' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pincode' => 'required|digits:6',
            'loan_category_id' => 'required',
            'bank_id' => 'required',
        ],
        [
            // ✅ Custom messages (clear & user friendly)
            'full_name.required' => 'Full name is required.',
            'full_name.regex' => 'Name should contain only letters and spaces.',
            'mobile_no.digits' => 'Mobile number must be exactly 10 digits.',
            'pan_number.regex' => 'Enter valid PAN number (ABCDE1234F).',
            'pincode.digits' => 'Pincode must be 6 digits.',
            'pan_number.unique' => 'This PAN number is already registered.',

        ]
    );

    // ✅ ONLY PROFILE (NO LOAN HERE)
    Profile::updateOrCreate(
        ['user_id' => $userId],
        [
            'mobile_no'         => $validated['mobile_no'],
            'full_name'         => $validated['full_name'],
            'pan_number'        => $validated['pan_number'],
            'marital_status'    => $validated['marital_status'],
          'gender'            => $validated['gender'], // ✅ SAVED
            'dob'               => $validated['dob'],
            'residence_address' => $validated['residence_address'],
            'city'              => $validated['city'],
            'state'             => $validated['state'],
            'pincode'           => $validated['pincode'],
        ]
    );

    // ✅ store only selections
    Session::put('loan_category_id', $validated['loan_category_id']);
    Session::put('bank_id', $validated['bank_id']);
}




    // protected function handleProfessionalDetails(Request $request, $userId)
    // {

       

    //     $validated = $request->validate([
    //         'profession_type' => 'required|string|in:salaried,self',
    //         'company_name' => 'required|string|max:255',
    //         'industry' => 'required|string|max:100',
    //         'company_address' => 'required|string|max:255',
    //         'experience_year' => 'required|integer',
    //         'designation' => 'required|string|max:100',
    //         'netsalary' => $request->input('profession_type') === 'salaried' ? 'required|numeric' : 'nullable|numeric',
    //         'gross_salary' => $request->input('profession_type') === 'salaried' ? 'required|numeric' : 'nullable|numeric',
    //         'selfincome' => $request->input('profession_type') === 'self' ? 'required|numeric' : 'nullable|numeric',
    //         'business_establish_date' => $request->input('profession_type') === 'self' ? 'required|date' : 'nullable|date',
    //     ]);


    //     $loan_id = Session::get('current_loan_id') ?? Loan::where('user_id', $userId)
    //         ->whereNotIn('status', ['disbursed', 'rejected'])
    //         ->first();
    //     $professional = Professional::where('user_id', $userId)->where('loan_id', $loan_id)->first();

    //     if (!$professional) {
            
    //         Professional::create([
    //             'user_id' => $userId,
    //             'loan_id' => $loan_id,
    //             'profession_type' => $validated['profession_type'],
    //             'company_name' => $validated['company_name'],
    //             'industry' => $validated['industry'],
    //             'company_address' => $validated['company_address'],
    //             'experience_year' => $validated['experience_year'],
    //             'designation' => $validated['designation'],
    //             'netsalary' => $validated['netsalary'] ?? null,
    //             'gross_salary' => $validated['gross_salary'] ?? null,
    //             'business_establish_date' => $validated['business_establish_date'] ?? null,
    //             'selfincome' => $validated['selfincome'] ?? null,
    //         ]);
    //     } else {
          
    //         $professional->update([
    //             'profession_type' => $validated['profession_type'],
    //             'company_name' => $validated['company_name'],
    //             'industry' => $validated['industry'],
    //             'company_address' => $validated['company_address'],
    //             'experience_year' => $validated['experience_year'],
    //             'designation' => $validated['designation'],
    //             'netsalary' => $validated['netsalary'] ?? null,
    //             'gross_salary' => $validated['gross_salary'] ?? null,
    //             'business_establish_date' => $validated['business_establish_date'] ?? null,
    //             'selfincome' => $validated['selfincome'] ?? null,
    //         ]);
    //     }
    // }

//     protected function handleProfessionalDetails(Request $request, $userId)
// {
//     $validated = $request->validate([
//         'profession_type' => 'required|string|in:salaried,self',
//         'company_name' => 'required|string|max:255',
//         'industry' => 'required|string|max:100',
//         'company_address' => 'required|string|max:255',
//         'experience_year' => 'required|integer',
//         'designation' => 'required|string|max:100',
//         'netsalary' => $request->profession_type === 'salaried' ? 'required|numeric' : 'nullable|numeric',
//         'gross_salary' => $request->profession_type === 'salaried' ? 'required|numeric' : 'nullable|numeric',
//         'selfincome' => $request->profession_type === 'self' ? 'required|numeric' : 'nullable|numeric',
//         'business_establish_date' => $request->profession_type === 'self' ? 'required|date' : 'nullable|date',
//     ]);

   
//     $loanId = session('current_loan_id');

//     if (!$loanId) {
//         throw new \Exception('Loan ID missing in session');
//     }

   
//     Professional::updateOrCreate(
//         [
//             'loan_id' => $loanId,   // UNIQUE KEY
//         ],
//         [
//             'user_id' => $userId,
//             'profession_type' => $validated['profession_type'],
//             'company_name' => $validated['company_name'],
//             'industry' => $validated['industry'],
//             'company_address' => $validated['company_address'],
//             'experience_year' => $validated['experience_year'],
//             'designation' => $validated['designation'],
//             'netsalary' => $validated['netsalary'] ?? null,
//             'gross_salary' => $validated['gross_salary'] ?? null,
//             'selfincome' => $validated['selfincome'] ?? null,
//             'business_establish_date' => $validated['business_establish_date'] ?? null,
//         ]
//     );
// }
// protected function handleProfessionalDetails(Request $request, $userId)
// {
//     // $validated = $request->validate([
//     //     'profession_type' => 'required|string|in:salaried,self',
//     //     'company_name' => 'required|string|max:255',
//     //     'industry' => 'required|string|max:100',
//     //     'company_address' => 'required|string|max:255',
//     //     'experience_year' => 'required|integer',
//     //     'designation' => 'required|string|max:100',
//     //     'netsalary' => $request->profession_type === 'salaried' ? 'required|numeric' : 'nullable|numeric',
//     //     'gross_salary' => $request->profession_type === 'salaried' ? 'required|numeric' : 'nullable|numeric',
//     //     'selfincome' => $request->profession_type === 'self' ? 'required|numeric' : 'nullable|numeric',
//     //     'business_establish_date' => $request->profession_type === 'self' ? 'required|date' : 'nullable|date',
//     // ]);
//     $validated = $request->validate([
//     'profession_type' => 'required|in:salaried,self',
//     'company_name' => 'required|min:2',
//     'industry' => 'required',
//     'company_address' => 'required|min:5',
//     'experience_year' => 'required|integer|min:0',
//     'designation' => 'required',

//     'netsalary' => $request->profession_type === 'salaried'
//         ? 'required|numeric|min:1'
//         : 'nullable',

//     'gross_salary' => $request->profession_type === 'salaried'
//         ? 'required|numeric|min:1'
//         : 'nullable',

//     'selfincome' => $request->profession_type === 'self'
//         ? 'required|numeric|min:1'
//         : 'nullable',

//     'business_establish_date' => $request->profession_type === 'self'
//         ? 'required|date'
//         : 'nullable',
// ]);

//     // ✅ NO loan_id here
//     Professional::updateOrCreate(
//         ['user_id' => $userId],
//         [
//             'profession_type' => $validated['profession_type'],
//             'company_name' => $validated['company_name'],
//             'industry' => $validated['industry'],
//             'company_address' => $validated['company_address'],
//             'experience_year' => $validated['experience_year'],
//             'designation' => $validated['designation'],
//             'netsalary' => $validated['netsalary'] ?? null,
//             'gross_salary' => $validated['gross_salary'] ?? null,
//             'selfincome' => $validated['selfincome'] ?? null,
//             'business_establish_date' => $validated['business_establish_date'] ?? null,
//         ]
//     );
// }

protected function handleProfessionalDetails(Request $request, $userId)
{
    $validated = $request->validate(
        [
            'profession_type' => 'required|in:salaried,self',

            'company_name' => [
                'required',
                'regex:/^[A-Za-z0-9 .,&()-]+$/',
                'min:2'
            ],

            'industry' => [
                'required',
                'regex:/^[A-Za-z .,&()-]+$/'
            ],

            'company_address' => 'required',

            'experience_year' => 'required|integer|min:0|max:99',


            'designation' => [
                'required',
                'regex:/^[A-Za-z .,&()-]+$/'
            ],

            // 🔹 Salaried validation
            'netsalary' => $request->profession_type === 'salaried'
                ? 'required|numeric|min:1'
                : 'nullable',

            'gross_salary' => $request->profession_type === 'salaried'
                ? 'required|numeric|min:1'
                : 'nullable',

            // 🔹 Self employed validation
            'selfincome' => $request->profession_type === 'self'
                ? 'required|numeric|min:1'
                : 'nullable',

            'business_establish_date' => $request->profession_type === 'self'
                ? 'required|date'
                : 'nullable',
        ],
        [
            // ✅ Custom messages
            'company_name.regex' => 'Company name contains invalid characters.',
            'industry.regex' => 'Industry name should contain only letters.',
            'designation.regex' => 'Designation should contain only letters.',
            'netsalary.min' => 'Net salary must be greater than zero.',
            'gross_salary.min' => 'Gross salary must be greater than zero.',
            'selfincome.min' => 'Total income must be greater than zero.',
            'experience_year.max' => 'Experience year must be maximum 2 digits.',
              'experience_year.min' => 'Experience year cannot be negative.',
              'profession_type.required' => 'Please select profession type.',


        ]
    );

    // ✅ SAVE PROFESSIONAL DETAILS
    Professional::updateOrCreate(
        ['user_id' => $userId],
        [
            'profession_type' => $validated['profession_type'],
            'company_name' => $validated['company_name'],
            'industry' => $validated['industry'],
            'company_address' => $validated['company_address'],
            'experience_year' => $validated['experience_year'],
            'designation' => $validated['designation'],
            'netsalary' => $validated['netsalary'] ?? null,
            'gross_salary' => $validated['gross_salary'] ?? null,
            'selfincome' => $validated['selfincome'] ?? null,
            'business_establish_date' => $validated['business_establish_date'] ?? null,
        ]
    );
}



    protected function handleEducationDetails(Request $request, $userId)
    {
        $validated = $request->validate([
            'qualification' => 'required|string|max:100',
            'pass_year' => 'required|integer',
            'college_name' => 'required|string|max:255',
            'college_address' => 'required|string|max:255'
        ]);

        $loan_id = Session::get('current_loan_id') ?? Loan::where('user_id', $userId)
            ->whereNotIn('status', ['disbursed', 'rejected'])
            ->first();

        
        $education = Education::where('user_id', $userId)->where('loan_id', $loan_id)->first();

        if (!$education) {
          
            Education::create([
                'user_id' => $userId,
                'loan_id' => $loan_id,
                'qualification' => $validated['qualification'],
                'pass_year' => $validated['pass_year'],
                'college_name' => $validated['college_name'],
                'college_address' => $validated['college_address'],
            ]);
        } else {
           
            $education->update([
                'qualification' => $validated['qualification'],
                'pass_year' => $validated['pass_year'],
                'college_name' => $validated['college_name'],
                'college_address' => $validated['college_address'],
            ]);
        }
    }

    protected function handleExistingLoanDetails(Request $request, $userId)
    {
        $existingLoanIds = $request->input('existing_loan_id', []);
        $typeLoans = $request->input('type_loan', []);
        $loanAmounts = $request->input('loan_amount', []);
        $tenureLoans = $request->input('tenure_loan', []);
        $emiAmounts = $request->input('emi_amount', []);
        $sanctionDates = $request->input('sanction_date', []);
        $emiBounceCounts = $request->input('emi_bounce_count', []);

        // Iterate over the existing loans
        for ($i = 0; $i < count($typeLoans); $i++) {
            DB::table('existing_loan')->updateOrInsert(
                [
                    'user_id' => $userId,
                    'existing_loan_id' => $existingLoanIds[$i] ?? null, // If you have existing loan IDs
                ],
                [
                    'type_loan' => $typeLoans[$i] ?? null,
                    'loan_amount' => $loanAmounts[$i] ?? null,
                    'tenure_loan' => $tenureLoans[$i] ?? null,
                    'emi_amount' => $emiAmounts[$i] ?? null,
                    'sanction_date' => $sanctionDates[$i] ?? null,
                    'emi_bounce_count' => $emiBounceCounts[$i] ?? null,
                ]
            );
        }
    }
    // protected function handleDocumentUpload(Request $request, $userId)
    // {

    //     $loan_id = Session::get('current_loan_id') ?? Loan::where('user_id', $userId)
    //         ->whereNotIn('status', ['disbursed', 'rejected'])
    //         ->first();

    //     $documents = ['aadhar_card', 'pancard', 'qualification_proof', 'salary_slip', 'form_16', 'bank_statement', 'passport', 'light_bill', 'dl', 'rent_agree']; // List of possible document types

    //     foreach ($documents as $docType) {
    //         if ($request->hasFile($docType)) {
    //             $file = $request->file($docType);
    //             $fileName = $docType . '_' . $userId . '.' . $file->extension();
    //             $filePath = $file->storeAs('documents', $fileName, 'public');

    //             DB::table('documents')->updateOrInsert(
    //                 [
    //                     'user_id' => $userId,
    //                     'loan_id' => $loan_id,
    //                     'document_name' => $docType
    //                 ],
    //                 [
    //                     'file_path' => $filePath
    //                 ]
    //             );
    //         }
    //     }
    // }
    // protected function handleLoanDetails(Request $request, $userId)
    // {
    //     // Retrieve stored loan category and bank from session
    //     $loan_category_id = Session::get('loan_category_id');
    //     $bank_id = Session::get('bank_id');

    //     if (!$loan_category_id || !$bank_id) {
    //         return redirect()->back()->withErrors(['error' => 'Loan category and bank ID are required.']);
    //     }

    //     $validated = $request->validate([
    //         'amount' => 'required|numeric',
    //         'tenure' => 'required|integer',
    //         'referral_code' => 'nullable|string|max:50',
    //     ]);

    //     if (!empty($validated['referral_code'])) {
    //         $referralUser = DB::table('users')->where('referral_code', $validated['referral_code'])->first();

    //              if ($referralUser=="" || $referralUser==Null || $referralUser==null ) {
    //                 // dd($referralUser);die;
    //                 return redirect()->back()->withErrors(['error' => 'Referral code is incorrect. Please try again.']);
    //               }

    //          // If referral user not found, return an error


    //         $referralUserId = $referralUser->id ?? null;
    //     }

    //     // dd($validated);die;

    //     $loanReferenceId = Str::upper(Str::random(8));
    //     $referralUserId = null;



    //     $is_loan = Session::get('is_loan');
    //     $loan_id = Session::get('loan_id', null);

    //     if ($is_loan == 1) {
    //         // Ensure the loan is created if not existing
    //         $loan = Loan::updateOrCreate(
    //             ['user_id' => $userId, 'loan_id' => $loan_id], // Find existing loan if any
    //             [
    //                 'user_id' => $userId,
    //                 'loan_reference_id' => $loanReferenceId,
    //                 'loan_category_id' => $loan_category_id,
    //                 'bank_id' => $bank_id,
    //                 'amount' => $validated['amount'],
    //                 'tenure' => $validated['tenure'],
    //                 'referral_user_id' => $referralUserId,
    //                 'status' => 'in process',
    //             ]
    //         );

    //         // Store loan ID in session for further steps
    //         Session::put('loan_id', $loan->loan_id);
    //     } else {
    //         // If not a new loan, update the existing loan details
    //         DB::table('loans')->where('user_id', $userId)->update([
    //             'loan_category_id' => $loan_category_id,
    //             'amount' => $validated['amount'],
    //             'tenure' => $validated['tenure'],
    //             'referral_user_id' => $referralUserId,
    //         ]);
    //     }
    // }

    //     protected function handleLoanDetails(Request $request)
    // {

    //     $loan_category_id = Session::get('loan_category_id');
    //     $bank_id = Session::get('bank_id');



    //     if (!$loan_category_id || !$bank_id) {
    //         return redirect()->back()->withErrors(['error' => 'Loan category and bank ID are required.']);
    //     }

    //     $validated = $request->validate([
    //         'amount' => 'required|numeric',
    //         'tenure' => 'required|integer',
    //         'referral_code' => 'nullable|string|max:50',
    //     ]);


    //     // Generate loan reference ID
    //     $loanReferenceId = Str::upper(Str::random(8));
    //     $referralUserId = null;




    //     if (!empty($validated['referral_code'])) {
    //         $referralUser = DB::table('users')->where('referral_code', $validated['referral_code'])->first();
    //         if (!$referralUser) {
    //             // echo $referralUser;die;
    //             return redirect()->back()->withErrors(['referral_code' => 'Referral code is incorrect. Please try again.']);

    //                 // dd($validated);die;

    //         }
    //         $referralUserId = $referralUser->id;
    //     } 



    //     // Check loan session and create or update loan data
    //     $is_loan = Session::get('is_loan');
    //     $loan_id = Session::get('loan_id', null);

    //     if ($is_loan == 1) {
    //         // Ensure the loan is created if not existing
    //         $loan = Loan::updateOrCreate(
    //             ['user_id' => $user->id, 'loan_id' => $loan_id], // Find existing loan if any
    //             [
    //                 'user_id' => $user->id,
    //                 'loan_reference_id' => $loanReferenceId,
    //                 'loan_category_id' => $loan_category_id,
    //                 'bank_id' => $bank_id,
    //                 'amount' => $validated['amount'],
    //                 'tenure' => $validated['tenure'],
    //                 'referral_user_id' => $referralUserId,
    //                 'status' => 'in process',
    //             ]
    //         );

    //         // Store loan ID in session for further steps
    //         Session::put('loan_id', $loan->loan_id);
    //     } else {
    //         // If not a new loan, update the existing loan details
    //         DB::table('loans')->where('user_id', $user->id)->update([
    //             'loan_category_id' => $loan_category_id,
    //             'amount' => $validated['amount'],
    //             'tenure' => $validated['tenure'],
    //             'referral_user_id' => $referralUserId,
    //         ]);
    //     }


    //      return redirect()->route('loan.thankyou');



    // }

    // protected function handleLoanDetails(Request $request, $userId)
    // {
    //     // Retrieve stored loan category and bank from session
    //     $loan_category_id = Session::get('loan_category_id');
    //     $bank_id = Session::get('bank_id');

    //     if (!$loan_category_id || !$bank_id) {
    //         return redirect()->back()->withErrors(['error' => 'Loan category and bank ID are required.']);
    //     }

    //     $validated = $request->validate([
    //         'amount' => 'required|numeric',
    //         'tenure' => 'required|integer',
    //         'referral_code' => 'nullable|string|max:50',
    //     ]);

    //     $loanReferenceId = $this->generateLoanReferenceId();
    //     $referralUserId = null;

    //     if (!empty($validated['referral_code'])) {
    //         $referralUser = DB::table('users')->where('referral_code', $validated['referral_code'])->first();
    //         $referralUserId = $referralUser->id ?? null;
    //     }

    //     $existingLoan = Session::get('current_loan_id');

    //     if ($existingLoan && is_int($existingLoan)) {
    //         $existingLoan = Loan::find($existingLoan); // Convert ID to model
    //     }

    //     if (!$existingLoan) {
    //         // First-time creation
    //         $loan = Loan::create([
    //             'user_id' => $userId,
    //             'loan_reference_id' => $loanReferenceId,
    //             'loan_category_id' => $loan_category_id,
    //             'bank_id' => $bank_id,
    //             'amount' => $validated['amount'],
    //             'tenure' => $validated['tenure'],
    //             'referral_user_id' => $referralUserId,
    //             'status' => 'in process',
    //         ]);
    //         Session::put('loan_reference_id', $loanReferenceId);
    //         Session::put('current_loan_id', $loan->loan_id);
    //     } else {
    //         $existingLoan->update([
    //             'loan_category_id' => $loan_category_id,
    //             'bank_id' => $bank_id,
    //             'amount' => $validated['amount'],
    //             'tenure' => $validated['tenure'],
    //             'referral_user_id' => $referralUserId,
    //         ]);
    //         Session::put('loan_reference_id', $loanReferenceId);
    //         Session::put('current_loan_id', $existingLoan->loan_id);
    //     }

    //     Session::put('is_loan', true);
    // }

// protected function handleDocumentUpload(Request $request, $userId)
// {
//     /* ===============================
//        STEP 1: VALIDATION (OPTIONAL FILES)
//        =============================== */

//     $request->validate([
//         'aadhar_card'         => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
//         'pancard'             => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
//         'qualification_proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
//         'salary_slip'         => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
//         'form_16'             => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
//         'bank_statement'      => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
//         'passport'            => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
//         'light_bill'          => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
//         'driving_license'     => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
//         'rent_agreement'          => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
//         'business_license'            => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
//         'itr_with_tax_paid_challan'   => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
//         'balance_sheet'               => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
//         'bank_acount_statments'       => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
//         'offer_letter'                => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
//         'hr_verification_letter'      => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
//         'closure_letter'              => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
//         'degree_certificate'          => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
//         'propert_document'            => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
//         'existing_loan_statment'      => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
//         'saction_letter'              => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
//     ], [
//         'mimes' => 'Only JPG, PNG or PDF files are allowed.',
//         'max'   => 'File size must be less than 2MB.',
//     ]);

//     /* ===============================
//        STEP 2: LOAN FETCH (SAFE)
//        =============================== */

//     $loan = Session::get('current_loan_id')
//         ? Loan::find(Session::get('current_loan_id'))
//         : Loan::where('user_id', $userId)
//             ->whereNotIn('status', ['disbursed', 'rejected'])
//             ->first();

//     if (!$loan) {
//         return; // loan नसल्यास upload skip
//     }

//     /* ===============================
//        STEP 3: DOCUMENT UPLOAD
//        =============================== */

//     $documents = [
//         'aadhar_card',
//         'pancard',
//         'qualification_proof',
//         'salary_slip',
//         'form_16',
//         'bank_statement',
//         'passport',
//         'light_bill',
//         'driving_license',
//         'rent_agreement',
//         'business_license',
//         'itr_with_tax_paid_challan',
//         'balance_sheet',
//         'bank_acount_statments',
//         'offer_letter',
//         'hr_verification_letter',
//         'closure_letter',
//         'degree_certificate',
//         'propert_document',
//         'existing_loan_statment',
//         'saction_letter',
//     ];

//     foreach ($documents as $docType) {

//         if ($request->hasFile($docType)) {

//             $file = $request->file($docType);

//             // ✅ unique filename (overwrite issue avoid)
//             $fileName = $docType . '_' . $userId . '_' . time() . '.' . $file->getClientOriginalExtension();

//             $filePath = $file->storeAs('documents', $fileName, 'public');

//             DB::table('documents')->updateOrInsert(
//                 [
//                     'user_id'       => $userId,
//                     'loan_id'       => $loan->loan_id,
//                     'document_name' => $docType
//                 ],
//                 [
//                     'file_path' => $filePath,
//                     'updated_at' => now(),
//                     'created_at' => now(),
//                 ]
//             );
//         }
//     }
// }
protected function handleDocumentUpload(Request $request, $userId)
{
    /* ===============================
       STEP 1: VALIDATION
       =============================== */

    $request->validate([
        'aadhar_card'                  => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'pancard'                      => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'qualification_proof'          => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'salary_slip'                  => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'form_16'                      => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'bank_statement'               => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'passport'                     => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'light_bill'                   => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'driving_license'              => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'rent_agreement'               => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'business_license'             => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'itr_with_tax_paid_challan'    => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'balance_sheet'                => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'bank_account_statements'      => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'offer_letter'                 => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'hr_verification_letter'       => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'closure_letter'               => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'degree_certificate'           => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'property_document'            => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'existing_loan_statement'      => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'sanction_letter'              => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    /* ===============================
       STEP 2: FETCH LOAN
       =============================== */

    $loan = Session::get('current_loan_id')
        ? Loan::find(Session::get('current_loan_id'))
        : Loan::where('user_id', $userId)
            ->whereNotIn('status', ['disbursed', 'rejected'])
            ->first();

   if (!$loan) {
    // ✅ CREATE DRAFT LOAN FOR FIRST TIME
   $loanCategoryId = Session::get('loan_category_id');
    $bankId = Session::get('bank_id');

    if (!$loanCategoryId || !$bankId) {
        throw new \Exception('Loan category or bank missing before document upload');
    }

    $loan = Loan::create([
        'user_id'           => $userId,
    'loan_reference_id' => $this->generateLoanReferenceId(),
    'loan_category_id'  => $loanCategoryId,   // ✅ REQUIRED
    'bank_id'           => $bankId,            // ✅ REQUIRED
    'status'            => 'draft',
]);

    Session::put('current_loan_id', $loan->loan_id);
}


    /* ===============================
       STEP 3: UPLOAD DOCUMENTS
       =============================== */

    $documents = [
        'aadhar_card',
        'pancard',
        'qualification_proof',
        'salary_slip',
        'form_16',
        'bank_statement',
        'passport',
        'light_bill',
        'driving_license',
        'rent_agreement',
        'business_license',
        'itr_with_tax_paid_challan',
        'balance_sheet',
        'bank_account_statements',
        'offer_letter',
        'hr_verification_letter',
        'closure_letter',
        'degree_certificate',
        'property_document',
        'existing_loan_statement',
        'sanction_letter',
    ];

    foreach ($documents as $docType) {
        if ($request->hasFile($docType)) {

            $file = $request->file($docType);
            $fileName = $docType . '_' . $userId . '_' . time() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('documents', $fileName, 'public');

            DB::table('documents')->updateOrInsert(
                [
                    'user_id'       => $userId,
                    'loan_id'       => $loan->loan_id,
                    'document_name' => $docType,
                ],
                [
                    'file_path'  => $filePath,
                    'updated_at' => now(),
                ]
            );
        }
    }
}



protected function handleLoanDetails(Request $request, $userId)
{
    Log::info('DEBUG ADMIN LOAN SESSION', [
    'role_id' => session('role_id'),
    'user_id_used' => $userId,
    'loan_category_id' => Session::get('loan_category_id'),
    'bank_id' => Session::get('bank_id'),
    'current_loan_id' => Session::get('current_loan_id'),
]);
    DB::beginTransaction();

    try {

        /**
         * -------------------------------------------------
         * 🔹 GET REQUIRED SESSION DATA
         * -------------------------------------------------
         */
        $loan_category_id = Session::get('loan_category_id');
        $bank_id = Session::get('bank_id');

        if (!$loan_category_id || !$bank_id) {
            throw new \Exception('Loan category and bank ID are missing from session.');
        }

        /**
         * -------------------------------------------------
         * 🔹 VALIDATION
         * -------------------------------------------------
         */
        $validated = $request->validate([
            'amount'        => 'required|numeric|min:1',
            'tenure'        => 'required|integer|min:1|max:30',
            'referral_code' => 'nullable|string|max:50',
        ]);

        /**
         * -------------------------------------------------
         * 🔹 REFERRAL CODE LOGIC
         * -------------------------------------------------
         */
        $referralUserId = null;

        if (!empty($validated['referral_code'])) {
            $referralUser = DB::table('users')
                ->where('referral_code', $validated['referral_code'])
                ->first();

            $referralUserId = $referralUser->id ?? null;
        }

        /**
         * -------------------------------------------------
         * 🔹 CHECK EXISTING LOAN IN SESSION
         * -------------------------------------------------
         */
       $existingLoanId = Session::get('current_loan_id');
$loan = null;

if ($existingLoanId) {
    $loan = Loan::where('loan_id', $existingLoanId)
        ->where('user_id', $userId)   // 🔥 CRITICAL FIX
        ->first();
}

// If loan exists but belongs to another user → ignore it
if ($loan && in_array($loan->status, ['disbursed', 'rejected'])) {
    Session::forget('current_loan_id');
    $loan = null;
}
        /**
         * -------------------------------------------------
         * 🔹 CREATE OR UPDATE LOAN
         * -------------------------------------------------
         */
        if (!$loan) {

            // First-time loan creation
            $loan = Loan::create([
                'user_id'            => $userId,
                'loan_reference_id'  => $this->generateLoanReferenceId(),
                'loan_category_id'   => $loan_category_id,
                'bank_id'            => $bank_id,
                'amount'             => $validated['amount'],
                'tenure'             => $validated['tenure'],
                'referral_user_id'   => $referralUserId,
                'status'             => 'in process',
            ]);

            Session::put('current_loan_id', $loan->loan_id);

        } else {

        // Update existing loan
        $loan->update([
            'loan_category_id' => $loan_category_id,
            'bank_id'          => $bank_id,
            'amount'           => $validated['amount'],
            'tenure'           => $validated['tenure'],
            'referral_user_id' => $referralUserId,
            'status'           => 'in process', // ✅ ADD THIS LINE
        ]);

        Log::info('Loan moved from draft to in process', [ // ✅ ADD LOG
            'loan_id' => $loan->loan_id,
            'old_status' => 'draft',
            'new_status' => 'in process',
        ]);
    }

        /**
         * -------------------------------------------------
         * 🔹 COMMON SESSION FLAGS
         * -------------------------------------------------
         */
        Session::put('loan_reference_id', $loan->loan_reference_id);
        Session::put('is_loan', true);

        DB::commit();

    } catch (\Exception $e) {

        DB::rollBack();

        \Log::error('Loan creation/update failed', [
            'user_id' => $userId,
            'error'   => $e->getMessage(),
        ]);

        throw $e;
    }
}



    protected function generateLoanReferenceId()
{
    do {
        $reference = 'JFIN' . random_int(100000, 999999);
    } while (
        Loan::where('loan_reference_id', $reference)->exists()
    );

    return $reference;
}



    public function submitLoanApplication(Request $request)
    {
        $userId = session('user_id'); // default = customer

// ✅ ADMIN FLOW FIX
if (session('role_id') == 4) {
    $userId = session('selected_user_id'); // customer selected by admin
}

         if (!$userId) {
        return redirect()->route('login')
            ->withErrors('User / Customer session missing.');
    }

        DB::beginTransaction();
        try {
            // Save Personal Details
            DB::table('profile')->updateOrInsert(
                ['user_id' => $userId],
                $request->only([
                    'mobile_no',
                    'marital_status',
                    'gender',
                    'dob',
                    'residence_address',
                    'city',
                    'state',
                    'pincode',
                    'loan_category_id',
                    'bank_id'
                ])
            );

            // Create or Update Loan
            $loan = Loan::updateOrCreate(
                ['user_id' => $userId],
                [
                    'loan_reference_id' => session('loan_reference_id') ?? $this->generateLoanReferenceId(),
                    'loan_category_id' => $request->loan_category_id,
                    'bank_id' => $request->bank_id,
                    'status' => 'in process',
                    'loan_amount' => $request->loan_amount,
                    'loan_tenure' => $request->loan_tenure,
                    'interest_rate' => $request->interest_rate,
                    'purpose' => $request->purpose
                ]
            );

            // Save Professional Details
            Professional::updateOrCreate(
                ['user_id' => $userId],
                $request->only([
                    'profession_type',
                    'company_name',
                    'industry',
                    'company_address',
                    'experience_year',
                    'designation',
                    'netsalary',
                    'gross_salary',
                    'selfincome',
                    'business_establish_date'
                ])
            );

            // Save Education Details
            Education::updateOrCreate(
                ['user_id' => $userId],
                $request->only(['qualification', 'pass_year', 'college_name', 'college_address'])
            );

            // Save Existing Loan Details (If Any)
            if ($request->has('existing_loans')) {
                foreach ($request->existing_loans as $loanData) {
                    DB::table('existing_loan')->updateOrInsert(
                        ['user_id' => $userId, 'existing_loan_id' => $loanData['existing_loan_id'] ?? null],
                        [
                            'type_loan' => $loanData['type_loan'] ?? null,
                            'loan_amount' => $loanData['loan_amount'] ?? null,
                            'tenure_loan' => $loanData['tenure_loan'] ?? null,
                            'emi_amount' => $loanData['emi_amount'] ?? null,
                            'sanction_date' => $loanData['sanction_date'] ?? null,
                            'emi_bounce_count' => $loanData['emi_bounce_count'] ?? null,
                        ]
                    );
                }
            }

            // Save Uploaded Documents
            if ($request->hasFile('documents')) {
                foreach ($request->file('documents') as $document) {
                    $documentPath = $document->store('documents/' . $userId, 'public');

                    DB::table('document_uploads')->insert([
                        'user_id' => $userId,
                        'document_path' => $documentPath,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            DB::commit();


            $role_id = session()->get('role_id');

            if ($role_id == 4) {
                return view('admin.thank-you', ['loanReferenceId' => $loan->loan_reference_id]);
            }

            // Return Thank You View with Loan Reference ID
            return view('frontend.thank-loan', ['loanReferenceId' => $loan->loan_reference_id]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Loan application submission failed: ' . $e->getMessage(), ['stack' => $e->getTraceAsString()]);
            // return redirect()->back()->withErrors('Something went wrong. Please try again.');
            throw $e; // or just let validation handle it

        }
    }




    public function thankYou()
    {

        $role_id = session()->get('role_id');
        $loanReferenceId = session('loan_reference_id');

        if ($role_id == 4) {
            return view('admin.thank-you', ['loanReferenceId' => $loanReferenceId]);
        }


        return view('frontend.thank-loan', compact('loanReferenceId'));
    }

    public function Error()
    {
        return view('frontend.error');
    }

    public function getBack()
    {
        $loanReferenceId = session('loan_reference_id');
        return view('frontend.get-back', compact('loanReferenceId'));
    }
    public function checkReferralCode(Request $request)
    {
        $request->validate([
            'referral_code' => 'required|string'
        ]);

        $referralCode = $request->input('referral_code');

        // Check if the referral code exists in the users table
        $user = User::where('referral_code', $referralCode)->first();

        if ($user) {
            return response()->json([
                'success' => true,
                'message' => 'Referral code is valid.',
                'user_name' => $user->name // Return the name of the user associated with the referral code
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Referral code is invalid.'
            ]);
        }
    }
    public function allAgentLoans(Request $request)
    {
        $agent_id = session()->get('user_id');
        $status = $request->input('status');
          // 🔹 Assigned Agent COUNT
    // $assignedCount = Loan::where('agent_id', $agent_id)->count();
    $assignedCount = Loan::where('agent_id', $agent_id)
    ->whereIn('agent_action', ['pending', 'accepted', 'in process'])
    ->count();
        // ✅ ADD THIS
    $totalCount = DB::table('loans')
        ->where('agent_id', $agent_id)
        ->count();
        $inProcessCount = Loan::where('agent_id', $agent_id)
        ->where('status', 'in process')
        ->count();
        $approvedCount = Loan::where('agent_id', $agent_id)
        ->where('status', 'approved')
        ->count();
        $disbursedCount = Loan::where('agent_id', $agent_id)
        ->where('status', 'disbursed')
        ->count();

        $query = DB::table('loans')
            ->join('users', 'loans.user_id', '=', 'users.id')
            ->join('loan_category', 'loans.loan_category_id', '=', 'loan_category.loan_category_id')
            ->where('loans.agent_id', $agent_id)
            ->orderByDesc('loans.created_at')
            ->select(
                'loans.loan_id',
                'loans.amount',
                'loans.tenure',
                'loans.loan_reference_id',
                'users.name as user_name',
                'loan_category.category_name as loan_category_name',
                'loans.agent_action',
                'loans.status'
            );

        if (!empty($status)) {
            $query->where('loans.status', $status);
        }

        $data['loans'] = $query->paginate(10)->withQueryString();
        return view('agent.all-loans', compact('data','assignedCount','totalCount','inProcessCount','approvedCount','disbursedCount'));
    }

    public function loanShow($id)
    {
        // Fetch the loan by ID
        $loan = Loan::findOrFail($id);

        // Return the view with loan data
        return view('agent.loan-view', compact('loan'));
    }
    public function assignAgent(Request $request)
    {
        $validated = $request->validate([
            'loan_id' => 'required|exists:loans,loan_id',
            'agent_id' => 'nullable|exists:users,id',
        ]);

        $loan = Loan::find($validated['loan_id']);
        if ($loan) {
            $loan->agent_id = $validated['agent_id'];
            $loan->agent_action = 'pending'; // Set initial action status to pending
            $loan->save();

            // Notifications
            $adminId = auth()->id(); // Assuming logged-in user is admin
            $agentId = $validated['agent_id'];
            $agentName = User::find($agentId)->name ?? 'Agent'; // Get agent name or default to 'Agent'
            $customerId = $loan->user_id;

            // Send notifications
            event(new \App\Events\AgentAssigned($adminId, $agentId, $customerId, $loan->loan_id, $loan->loan_reference_id, $agentName));
            return redirect()->route('admin.loans')->with('success', 'Agent assigned successfully!');
        }

        return redirect()->route('admin.loans')->with('error', 'Failed to assign agent.');
    }
    public function assignedLoans()
    {
        // Get the role_id and agent_id from the session
        $role_id = session()->get('role_id');
        $agent_id = session()->get('user_id'); // Assuming the agent's ID is stored as 'user_id'

        // Check if the role_id indicates an agent or admin
        if ($role_id != 2 && $role_id != 4) {
            return redirect('/');
        }

        // Fetch loans assigned to the agent
        $loans = Loan::where('agent_id', $agent_id)
            ->with(['user', 'loanCategory'])
            ->orderByDesc('created_at')
            ->paginate(10); // Adjust the number of items per page as needed

        // Return view with loans data
        return view('agent.assigned_loans', compact('loans'));
    }


    // ajax
public function assignedLoansAjax(Request $request)
{
    
    $agent_id = session()->get('user_id');
    $search = $request->search;
    

    // 🔹 Assigned Agent COUNT
    // $assignedCount = Loan::where('agent_id', $agent_id)->count();
    $assignedCount = Loan::where('agent_id', $agent_id)
    ->whereIn('agent_action', ['pending', 'accepted', 'in process'])
    ->count();


    // 🔹 Assigned Loans LIST (with search)
    $loans = Loan::where('agent_id', $agent_id)
        ->when($search, function ($q) use ($search) {
            $q->where('loan_reference_id', 'like', "%$search%")
              ->orWhereHas('user', function ($q2) use ($search) {
                  $q2->where('name', 'like', "%$search%");
              })
              ->orWhereHas('loanCategory', function ($q3) use ($search) {
                  $q3->where('category_name', 'like', "%$search%");
              });
        })
        ->with(['user', 'loanCategory'])
        ->orderByDesc('created_at')
        ->paginate(10);

    return view('agent.partials.assigned_loans_table', compact('loans', 'assignedCount'));
}
public function allLoansAjax(Request $request)
{
    $agent_id = session()->get('user_id');
    $search   = $request->search;
    $status   = $request->status;

    // ✅ TOTAL COUNT (without pagination)
    $totalCount = Loan::where('agent_id', $agent_id)->count();

    // ✅ FILTERED QUERY
    $query = Loan::with(['user', 'loanCategory'])
        ->where('agent_id', $agent_id)

        ->when($search, function ($q) use ($search) {
            $q->where(function ($sub) use ($search) {
                $sub->where('loan_reference_id', 'like', "%{$search}%")
                    ->orWhereHas('user', fn ($q2) =>
                        $q2->where('name', 'like', "%{$search}%")
                    )
                    ->orWhereHas('loanCategory', fn ($q3) =>
                        $q3->where('category_name', 'like', "%{$search}%")
                    );
            });
        })

        ->when($status, function ($q) use ($status) {
            $q->where('status', $status);
        });

    // ✅ FILTERED COUNT
    $filteredCount = $query->count();

    // ✅ PAGINATED DATA
    $loans = $query
        ->orderByDesc('created_at')
        ->paginate(10)
        ->withQueryString();

    return view(
        'agent.partials.all_loans_table',
        compact('loans', 'totalCount', 'filteredCount')
    );
}

public function inProcessLoansAjax(Request $request)
{
    $agent_id = session()->get('user_id');
    $search   = $request->search;

    $query = Loan::with(['user', 'loanCategory'])
        ->where('agent_id', $agent_id)
        ->where('status', 'in process');

    // 🔍 Search
    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('loan_reference_id', 'like', "%$search%")
              ->orWhereHas('user', fn($u) => $u->where('name', 'like', "%$search%"))
              ->orWhereHas('loanCategory', fn($c) => $c->where('category_name', 'like', "%$search%"));
        });
    }

    $loans = $query->orderByDesc('created_at')->paginate(10)->withQueryString();

    $inProcessCount = Loan::where('agent_id', $agent_id)
        ->where('status', 'in process')
        ->count();

    return view('agent.partials.inprocess_loans_table', compact('loans', 'inProcessCount'));
}
public function approvedLoansAjax(Request $request)
{
    $agent_id = session()->get('user_id');

    // COUNT (for card, optional)
    $approvedCount = Loan::where('agent_id', $agent_id)
        ->where('status', 'approved')
        ->count();

    // LIST
    $loans = Loan::with(['user','loanCategory'])
        ->where('agent_id', $agent_id)
        ->where('status', 'approved')
        ->orderByDesc('created_at')
        ->paginate(10)
        ->withQueryString();

    return view(
        'agent.partials.approved_loans_table',
        compact('loans','approvedCount')
    );
}
public function disbursedLoansAjax(Request $request)
{
    $agent_id = session()->get('user_id');

    // 🔹 COUNT
    $disbursedCount = Loan::where('agent_id', $agent_id)
        ->where('status', 'disbursed')
        ->count();

    // 🔹 LIST
    $loans = Loan::with(['user','loanCategory'])
        ->where('agent_id', $agent_id)
        ->where('status', 'disbursed')   // ✅ ONLY CHANGE
        ->orderByDesc('created_at')
        ->paginate(10)
        ->withQueryString();

    return view(
        'agent.partials.disbursed_loans_table',
        compact('loans','disbursedCount')
    );
}














    public function acceptLoan(Request $request)
    {
        // Start a database transaction
        DB::beginTransaction();

        try {
            // Validate the request to ensure loan_id exists
            $validated = $request->validate([
                'loan_id' => 'required|exists:loans,loan_id',
            ]);

            // Find the loan by loan_id
            $loan = Loan::find($validated['loan_id']);
            if ($loan) {
                // Update the loan status and agent action
                $loan->agent_action = 'accepted';
                $loan->status = 'in process';
                $loan->save();

                // Get the customer details
                $customer = $loan->user;
                $customerEmail = $customer->email_id;
                $customerName = $customer->name;

                // Commit the transaction after loan update
                DB::commit();

                // Prepare email content
                $msg = 'Your loan has been accepted and is now in process.';
                $temp_id = 3;

                // Call the temail function from UsersController to send an email
                app(UsersController::class)->temail($customerEmail, $customerName, $msg, $temp_id);

                // Redirect with success message
                return redirect()->route('agent.assignedLoans')->with('success', 'Loan accepted successfully!');
            }

            // If loan is not found, rollback transaction and redirect with error
            DB::rollBack();
            return redirect()->route('agent.assignedLoans')->with('error', 'Loan not found.');
        } catch (\Exception $e) {
            // Rollback transaction in case of an exception
            DB::rollBack();
            return redirect()->route('agent.assignedLoans')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function rejectLoan(Request $request)
    {
        $validated = $request->validate([
            'loan_id' => 'required|exists:loans,loan_id',
            'remarks' => 'required|string',
        ]);

        $loan = Loan::find($validated['loan_id']);
        if ($loan) {
            $loan->agent_action = 'rejected';
            $loan->remarks = $validated['remarks'];
            $loan->status = 'document-pending';
            $loan->save();

            return redirect()->route('agent.assignedLoans')->with('success', 'Loan rejected successfully!');
        }

        return redirect()->route('agent.assignedLoans')->with('error', 'Loan not found.');
    }


    public function pendingLoans()
    {
        $pendingLoans = DB::table('loans')
            ->leftJoin('users', 'loans.user_id', '=', 'users.id') // Join with users table
            ->leftJoin('loan_category', 'loans.loan_category_id', '=', 'loan_category.loan_category_id') // Join with loan_category table
            ->where(function ($query) {
                $query->whereNull('loans.agent_id')   // Not assigned yet

                    ->orWhere(function ($q) {
                        $q->whereNotNull('loans.agent_id')
                            ->where('loans.agent_action', 'rejected'); // Only rejected loans
                    });
            })
            ->select('loans.*', 'users.name as user_name', 'loan_category.category_name as category_name') // Select necessary fields
            ->orderByDesc('loans.created_at')
            ->paginate(20); // Adjust pagination as needed
        $agents = DB::table('users')->where('role_id', 2)->get(); // Fetch agents from users table

        return view('frontend.pending_loans', compact('pendingLoans', 'agents'));
    }
    public function agentInprocess()
    {
        $role_id = session()->get('role_id');
        $agent_id = session()->get('user_id'); // Assuming the agent's ID is stored as 'user_id'

        // Ensure that only agents and admins can access this
        if ($role_id != 2 && $role_id != 4) {
            return redirect('/');
        }

        $data['loans'] = DB::table('loans')
            ->join('users', 'loans.user_id', '=', 'users.id')
            ->join('loan_category', 'loans.loan_category_id', '=', 'loan_category.loan_category_id')
            ->where('loans.status', 'in process')
            ->where('loans.agent_id', $agent_id)
            ->select('loans.*', 'users.name as user_name', 'loan_category.category_name as category_name')
            ->paginate(10);

        $data['users'] = DB::table('users')->get();
        $data['loanCategories'] = DB::table('loan_category')->get();
        $data['agents'] = DB::table('users')->where('role_id', 2)->get();

        return view('agent.in-process', compact('data'));
    }
    public function agentApproved()
    {
        $role_id = session()->get('role_id');
        $agent_id = session()->get('user_id'); // Assuming the agent's ID is stored as 'user_id'

        // Ensure that only agents and admins can access this
        if ($role_id != 2 && $role_id != 4) {
            return redirect('/');
        }

        $data['loans'] = DB::table('loans')
            ->join('users', 'loans.user_id', '=', 'users.id')
            ->join('loan_category', 'loans.loan_category_id', '=', 'loan_category.loan_category_id')
            ->select(
                'loans.loan_id',
                'loans.amount',
                'loans.tenure',
                'loans.loan_reference_id',
                'users.name as user_name',
                'loan_category.category_name as loan_category_name',
                'loans.agent_action'
            )
            ->where('loans.status', 'approved')
            ->where('loans.agent_id', $agent_id)
            ->paginate(10); // Adjust the pagination limit if necessary

        return view('agent.approved_loans', compact('data'));
    }
    public function agentRejected()
    {
        $role_id = session()->get('role_id');
        $agent_id = session()->get('user_id'); // Assuming the agent's ID is stored as 'user_id'

        // Ensure that only agents and admins can access this
        if ($role_id != 2 && $role_id != 4) {
            return redirect('/');
        }

        $data['loans'] = DB::table('loans')
            ->join('users', 'loans.user_id', '=', 'users.id')
            ->join('loan_category', 'loans.loan_category_id', '=', 'loan_category.loan_category_id')
            ->select(
                'loans.loan_id',
                'loans.amount',
                'loans.tenure',
                'loans.loan_reference_id',
                'users.name as user_name',
                'loan_category.category_name as loan_category_name',
                'loans.agent_action'
            )
            ->where('loans.status', 'rejected')
            ->where('loans.agent_id', $agent_id)
            ->paginate(10); // Adjust the pagination limit if necessary

        return view('agent.rejected_loans', compact('data'));
    }

    public function agentDocumentPending()
    {
        $role_id = session()->get('role_id');
        $agent_id = session()->get('user_id'); // Assuming the agent's ID is stored as 'user_id'

        // Ensure that only agents and admins can access this
        if ($role_id != 2 && $role_id != 4) {
            return redirect('/');
        }

        $data['loans'] = DB::table('loans')
            ->join('users', 'loans.user_id', '=', 'users.id')
            ->join('loan_category', 'loans.loan_category_id', '=', 'loan_category.loan_category_id')
            ->select(
                'loans.loan_id',
                'loans.amount',
                'loans.tenure',
                'loans.loan_reference_id',
                'users.name as user_name',
                'loan_category.category_name as loan_category_name',
                'loans.agent_action'
            )
            ->where('loans.status', 'document pending')
            ->where('loans.agent_id', $agent_id)
            ->paginate(10); // Adjust the pagination limit if necessary

        return view('agent.document-pending', compact('data'));
    }


    // public function applyNow()
    // {

        
    //     return view('frontend.firstloan');
    // }



    
public function applyNow()
{
    // If user is already logged in
    if (Auth::check() || Session::has('username')) {
        return redirect('/start_loan/1');
    }

    // New customer (not logged in)
    return view('frontend.firstloan');
}


// public function applyNow()
// {
//     if (Auth::check()) {
//         // user already logged in
//         return redirect('/start_loan/1');
//     }

//     // user not logged in → go to login/signup
//     return redirect()->route('authv3.login.form');
// }

    //fetch recent loans
    public function fetchRecentLoans($limit = 5)
    {
        $recentLoans = DB::table('loans')
            ->join('users', 'loans.user_id', '=', 'users.id')
            ->select(
                'loans.loan_id',
                'loans.amount',
                'users.name as user_name',
                'loans.status'
            )
            ->latest('loans.created_at')
            ->take($limit)
            ->get();

        return $recentLoans;
    }
    public function destroy(Request $request)
{
    $loanId = $request->loan_id;
    $loan = Loan::find($loanId);

    if ($loan) {
        $loan->delete(); // Soft delete
        return response()->json(['message' => 'Loan soft deleted successfully.']);
    } else {
        return response()->json(['error' => 'Loan not found.'], 404);
    }
}
public function trashedLoans(Request $request)
{
    $trashedLoans = \App\Models\Loan::onlyTrashed()
        ->with([
            'user.profile.cityRelation',
            'loanCategory',
            'bankDetails'
        ])
        ->whereNotNull('loan_reference_id')
        ->orderBy('deleted_at', 'desc')
        ->paginate(10);

    $trashedLoans->getCollection()->transform(function ($loan) {
        return [
            'loan_id' => $loan->loan_id,
            'amount' => $loan->amount,
            'tenure' => $loan->tenure,
            'loan_reference_id' => $loan->loan_reference_id,
            'user_name' => $loan->user->name ?? null,
            'status' => $loan->status,
            'city' => $loan->user->profile->cityRelation->city ?? null,
            'loan_category_name' => $loan->loanCategory->category_name ?? null,
            'bank_name' => $loan->bankDetails->bank_name ?? null,
            'agent_action' => $loan->agent_action,
        ];
    });

    return view('frontend.trashed-loans', ['loans' => $trashedLoans]);
}
public function restore(Request $request)
{
    $loanId = $request->loan_id;

    $loan = Loan::withTrashed()->find($loanId);

    if (!$loan) {
        return response()->json(['message' => 'Loan not found.'], 404);
    }

    $loan->restore();

    return response()->json(['message' => 'Loan restored successfully.']);
}
}
