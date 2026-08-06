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
// public function loanlist()
// {
//     $role   = session('role_id');
//     $userId = session('user_id');

//     /* ================= COMMON FILTER ================= */

//     $applyFilter = function ($query) use ($role, $userId) {

//         // ✅ DSA → both direct + mapped
//         if ($role == 6) {
//             $query->where(function($q) use ($userId){
//                 $q->where('dsa_id', $userId)
//                   ->orWhereIn('user_id', function($sub) use ($userId){
//                       $sub->select('user_id')
//                           ->from('dsa_customers')
//                           ->where('dsa_id', $userId);
//                   });
//             });
//         }

//         // ✅ ADMIN → hide DSA loans
//         if ($role == 4) {
//             $query->where(function($q){
//                 $q->whereNull('dsa_id')
//                   ->orWhere('dsa_id', 0);
//             });
//         }

//         return $query;
//     };

//     /* ================= COUNTS ================= */

//     $totalLoans = $applyFilter(Loan::query())->count();

//     $inProcessLoans = $applyFilter(
//         Loan::where('status', 'in process')
//     )->count();

//     $trashedloans = $applyFilter(
//         Loan::onlyTrashed()
//     )->count();

//     $approvedLoan = $applyFilter(
//         Loan::where('status', 'approved')
//     )->count();

//     $disbursedLoans = $applyFilter(
//         Loan::where('status', 'disbursed')
//             ->whereNotNull('loan_reference_id')
//     )->count();

//     $rejectedLoans = $applyFilter(
//         Loan::where('status', 'rejected')
//     )->count();
// $pendingLoansCount = $applyFilter(
//     Loan::where(function ($query) {
//         $query->whereNull('agent_id')
//               ->orWhere(function($q){
//                   $q->whereNotNull('agent_id')
//                     ->where('agent_action', 'rejected');
//               });
//     })

//     // 🔥 ADD THIS (VERY IMPORTANT)
//     ->whereNotIn('status', [
//         'approved',
//         'disbursed',
//         'rejected'
//     ])
// )->count();

//     /* ================= LOAN LIST ================= */

//     $loans = $applyFilter(
//         Loan::with([
//             'user.profile.cityRelation',
//             'loanCategory',
//             'bankDetails'
//         ])
//     )
//     ->orderBy('created_at', 'desc')
//     ->paginate(10);

//     return view('admin.admin-loans', compact(
//         'totalLoans',
//         'inProcessLoans',
//         'trashedloans',
//         'approvedLoan',
//         'disbursedLoans',
//         'rejectedLoans',
//         'loans',
//         'pendingLoansCount'
//     ));
// }


public function loanlist()
{
    $role   = session('role_id');
    $userId = session('user_id');

    /* ================= COMMON FILTER ================= */

    $applyFilter = function ($query) use ($role, $userId) {

        // ✅ DSA → both direct + mapped
        if ($role == 6) {
            $query->where(function($q) use ($userId){
                $q->where('dsa_id', $userId)
                  ->orWhereIn('user_id', function($sub) use ($userId){
                      $sub->select('user_id')
                          ->from('dsa_customers')
                          ->where('dsa_id', $userId);
                  });
            });
        }

        // ✅ ADMIN → hide DSA loans
        if ($role == 4) {
            $query->where(function($q){
                $q->whereNull('dsa_id')
                  ->orWhere('dsa_id', 0);
            });
        }

        return $query;
    };

    /* ================= COUNTS ================= */

    $totalLoans = $applyFilter(Loan::query())->count();

    $inProcessLoans = $applyFilter(
        Loan::where('status', 'in process')
    )->count();

    $trashedloans = $applyFilter(
        Loan::onlyTrashed()
    )->count();

    $approvedLoan = $applyFilter(
        Loan::where('status', 'approved')
    )->count();

    $disbursedLoans = $applyFilter(
        Loan::where('status', 'disbursed')
            ->whereNotNull('loan_reference_id')
    )->count();

    $rejectedLoans = $applyFilter(
        Loan::where('status', 'rejected')
    )->count();

    // ✅ ONLY ADMIN CAN SEE PENDING ASSIGN COUNT
    $pendingLoansCount = 0;

    if ($role == 4) {

        $pendingLoansCount = $applyFilter(
            Loan::where(function ($query) {

                $query->whereNull('agent_id')
                      ->orWhere(function($q){
                          $q->whereNotNull('agent_id')
                            ->where('agent_action', 'rejected');
                      });
            })

            ->whereNotIn('status', [
                'approved',
                'disbursed',
                'rejected'
            ])
        )->count();
    }

    /* ================= LOAN LIST ================= */

    $loans = $applyFilter(
        Loan::with([
            'user.profile.cityRelation',
            'loanCategory',
            'bankDetails'
        ])
    )
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

    
public function update(Request $request)
{
    try {

        $loan = Loan::with(['user', 'dsaCustomer'])
            ->where('loan_id', $request->loan_id)
            ->firstOrFail();

        $rules = [
            'loan_id'           => 'required|integer',
            'status'            => 'required|string',
            'loan_category_id'  => 'required|integer',
            'amount'            => 'required|numeric',
            'amount_approved'   => [
                'required_if:status,disbursed',
                'numeric',
                'min:0',
                'max:' . $loan->amount
            ],
            'tenure'            => 'required|integer',
            'in_principle'      => 'nullable|string',
            'remarks'           => 'nullable|string',
            'documents.*'       => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
        ];

        // 🔴 SANCTION LETTER CONDITION
        if (
            $request->status === 'disbursed'
            && !$request->hasFile('sanction_letter')
            && empty($loan->sanction_letter)
        ) {
            $rules['sanction_letter'] = 'required|file|mimes:pdf,doc,docx';
        } else {
            $rules['sanction_letter'] = 'nullable|file|mimes:pdf,doc,docx';
        }

        $request->validate($rules, [
            'sanction_letter.required' =>
                'Please upload the sanction letter before disbursing the loan.'
        ]);

        DB::transaction(function () use ($request) {

            $loan = Loan::with(['user', 'dsaCustomer'])
                ->where('loan_id', $request->loan_id)
                ->firstOrFail();

            $oldStatus = $loan->status;
            $newStatus = $request->status;

            // ✅ UPDATE LOAN
            $loan->loan_category_id = $request->loan_category_id;
            $loan->amount = $request->amount;
            $loan->tenure = $request->tenure;
            $loan->status = $newStatus;
            $loan->remarks = $request->remarks;
            $loan->in_principle = $request->in_principle;
            $loan->amount_approved = $request->amount_approved;
            $loan->save();

            // ✅ SAVE REMARKS
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

            // ✅ SANCTION LETTER
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

            // ✅ DOCUMENT UPLOAD
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

            // ✅ EVENT (🔥 FIXED HERE)
          if ($oldStatus !== $newStatus) {

    try {

        event(new LoanStatusUpdated(
            $loan->loan_reference_id,
            auth()->id() ?? session('user_id'),
            optional(auth()->user()->roles)->name ?? 'system',
            $loan->status,
            $loan->user_id
        ));

        // Save notification
      \App\Models\NotificationLog::create([
    'user_id'      => $loan->user_id,
    'title'        => 'Loan Status Updated',
    'description'  => 'Your loan status has been changed to ' . ucfirst($newStatus),
    'url'          => route('loan.view', $loan->loan_id), // replace with your route
    'seen_by_user' => 0,
]);

    } catch (\Exception $e) {

        \Log::error('Notification Error', [
            'error' => $e->getMessage()
        ]);
    }
}

            // ✅ DISBURSED LOGIC
         if ($newStatus === 'disbursed' && session('role_id') != 6){

                $childUserId = $loan->user_id;

                $childName = null;

                if (!empty($loan->user->name)) {
                    $childName = $loan->user->name;
                }

                if (!$childName && $loan->dsaCustomer && !empty($loan->dsaCustomer->name)) {
                    $childName = $loan->dsaCustomer->name;
                }

                if (!$childName) {
                    $childName = 'Unknown User';
                }

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
    // 🔥 IMPORTANT FIX (ADD THIS AT TOP)
if ($request->has('user_id')) {
    session(['selected_user_id' => $request->user_id]);
}
    /* =========================================================
       🔴 ADMIN: NEW APPLICATION RESET (FIRST LOAD ONLY)
       ========================================================= */
    if (in_array(session('role_id'), [2,4]) && !$request->has('current_step')) {

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
   if (in_array(session('role_id'), [2,4])) {   // agent + admin
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

$role = session('role_id');
$loginUserId = session('user_id');

// ✅ ADMIN + AGENT
if (in_array($role, [2,4])) {

    $loanUsers = User::join('otp', 'otp.user_id', '=', 'users.id')
        ->where('users.role_id', 1)
        ->where('otp.is_verify', 1)
        ->where('users.is_email_verify', 1)
        ->whereNull('users.deleted_at')
        ->select(
            'users.id',
            'users.name',
            'users.email_id',
            'users.mobile_no'
        )
        ->distinct()
        ->get();

}
// ✅ DSA ONLY HIS CUSTOMERS
elseif ($role == 6) {

  $loanUsers = DB::table('dsa_customers')
    ->where('dsa_id', $loginUserId)
    ->select(
        'user_id as id',   // 🔥 VERY IMPORTANT FIX
        'name',
        'email as email_id',
        'mobile_no'
    )
    ->get();
}

    /* =========================================================
       🔐 USER DATA LOADING CONTROL
       ========================================================= */

    $selectedUserId   = session('selected_user_id');
    $canLoadUserData  = true;

  if (in_array(session('role_id'), [2,4]) && !$selectedUserId) {
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
        // 🔥 DSA FLOW FIX (NO AUTOFILL)
if (session('role_id') == 6) {

    $profile = null;
    $professional = null;
    $education = null;

}

    /* ---------------- LOAN ---------------- */

    $loan = $canLoadUserData
        ? Loan::where('user_id', $effectiveUserId)
            ->whereNotIn('status', ['disbursed', 'rejected'])
            ->first()
        : null;

    $hasExistingLoan = $canLoadUserData && $existingLoans->count() > 0;

    /* ---------------- USER MODEL ---------------- */

   $user = null;

// 🔥 ONLY OTP USER FIX (NO IMPACT ON ADMIN/DSA)
if (session('role_id') == 6 && $selectedUserId) {
    // DSA selected customer
   $user = DB::table('dsa_customers')
    ->where('user_id', $selectedUserId) // ✅ CORRECT
    ->first();
} else {
    $user = User::where('id', $effectiveUserId)->first();
}



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






public function ajaxList(Request $request)
{
    $search = $request->search;
    $type   = $request->type;

    $role   = session('role_id');
    $userId = session('user_id');

    // ✅ START QUERY (DON'T OVERRIDE LATER)
    $query = Loan::with(['user', 'loanCategory']);

    // 🔍 SEARCH
    if ($search) {
        $query->where(function ($q) use ($search) {

            $q->whereHas('user', function ($u) use ($search) {
                $u->where('name', 'LIKE', "%{$search}%");
            })

            ->orWhereHas('loanCategory', function ($c) use ($search) {
                $c->where('category_name', 'LIKE', "%{$search}%");
            })

            ->orWhere('loan_reference_id', 'LIKE', "%{$search}%");
        });
    }

    // 🎯 TYPE FILTER
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

    // ✅ DSA FILTER (NEW SIMPLE)
 $query = $this->applyRoleFilter($query, $role, $userId);
    // 🔥 ADMIN FILTER (REMOVE DSA LOANS)
   $query = $this->applyRoleFilter($query, $role, $userId);

    $loans = $query->latest()->paginate(10);

    return view('partials.list', compact('loans'));
}


public function ajaxPendingLoans(Request $request)
{
    $search = $request->search;

    $role   = session('role_id');
    $userId = session('user_id');

    $pendingLoans = DB::table('loans')
        ->leftJoin('users', 'loans.user_id', '=', 'users.id')
        ->leftJoin('loan_category', 'loans.loan_category_id', '=', 'loan_category.loan_category_id')

        // ✅ Pending condition
        ->where(function ($query) {
          $query->where(function ($q) {
    $q->whereNull('loans.agent_id')
      ->orWhere(function ($qq) {
          $qq->whereNotNull('loans.agent_id')
             ->where('loans.agent_action', 'rejected');
      });
})

->whereNotIn('loans.status', [
    'approved',
    'disbursed',
    'rejected'
]);
        })

        // ✅ DSA FILTER
        ->when($role == 6, function ($q) use ($userId) {
            $q->where(function($qq) use ($userId){

                // Direct DSA loans
                $qq->where('loans.dsa_id', $userId)

                // OR mapped customers
                ->orWhereIn('loans.user_id', function($sub) use ($userId) {
                    $sub->select('user_id')
                        ->from('dsa_customers')
                        ->where('dsa_id', $userId);
                });

            });
        })

        // ✅ ADMIN FILTER (FIXED 🔥)
        ->when($role == 4, function ($q) {
            $q->where(function($qq){
                $qq->whereNull('loans.dsa_id')
                   ->orWhere('loans.dsa_id', 0);
            });
        })

        // 🔍 SEARCH
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

    // ✅ Agents (no change)
    $agents = DB::table('users')
        ->where('role_id', 2)
        ->where('is_email_verify', 1)
        ->whereNull('deleted_at')
        ->get();

    // ✅ AJAX
    if ($request->ajax()) {
        return view('partials.pending-loans', compact('pendingLoans', 'agents'))->render();
    }

    return view('admin.pending-loans', compact('pendingLoans', 'agents'));
}





public function ajaxInprocessLoans(Request $request)
{
    $search = $request->search;

    $role   = session('role_id');
    $userId = session('user_id');

    $loans = DB::table('loans')
        ->join('users', 'loans.user_id', '=', 'users.id')
        ->join('loan_category', 'loans.loan_category_id', '=', 'loan_category.loan_category_id')

        ->where('loans.status', 'in process')          
        ->whereNotNull('loans.loan_reference_id')      
        ->whereNull('loans.deleted_at')                

        // ✅ DSA FILTER (FIXED 🔥)
        ->when($role == 6, function ($q) use ($userId) {
            $q->where(function($qq) use ($userId){

                // Direct DSA loans
                $qq->where('loans.dsa_id', $userId)

                // OR mapped customers
                ->orWhereIn('loans.user_id', function($sub) use ($userId) {
                    $sub->select('user_id')
                        ->from('dsa_customers')
                        ->where('dsa_id', $userId);
                });

            });
        })

        // ✅ ADMIN FILTER (ADD THIS 🔥)
        ->when($role == 4, function ($q) {
            $q->where(function($qq){
                $qq->whereNull('loans.dsa_id')
                   ->orWhere('loans.dsa_id', 0);
            });
        })

        // 🔍 SEARCH
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

    $role   = session('role_id');
    $userId = session('user_id');

    $loans = \App\Models\Loan::onlyTrashed()
        ->with([
            'user.profile.cityRelation',
            'loanCategory',
            'bankDetails'
        ])
        ->whereNotNull('loan_reference_id')

        // ✅ DSA FILTER (FIXED 🔥)
        ->when($role == 6, function ($q) use ($userId) {
            $q->where(function($qq) use ($userId){

                // Direct DSA loans
                $qq->where('dsa_id', $userId)

                // OR mapped customers
                ->orWhereIn('user_id', function($sub) use ($userId) {
                    $sub->select('user_id')
                        ->from('dsa_customers')
                        ->where('dsa_id', $userId);
                });

            });
        })

        // ✅ ADMIN FILTER (ADD THIS 🔥)
        ->when($role == 4, function ($q) {
            $q->where(function($qq){
                $qq->whereNull('dsa_id')
                   ->orWhere('dsa_id', 0);
            });
        })

        // 🔍 SEARCH
        ->when($search, function ($q) use ($search) {
            $q->where(function ($sub) use ($search) {

                $sub->whereHas('user', function ($u) use ($search) {
                    $u->where('name', 'LIKE', "%{$search}%");
                })

                ->orWhereHas('loanCategory', function ($c) use ($search) {
                    $c->where('category_name', 'LIKE', "%{$search}%");
                })

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

    $role   = session('role_id');
    $userId = session('user_id');

    $loans = DB::table('loans')
        ->join('users', 'loans.user_id', '=', 'users.id')
        ->join('loan_category', 'loans.loan_category_id', '=', 'loan_category.loan_category_id')

        ->where('loans.status', 'approved')
        ->whereNotNull('loans.loan_reference_id')

        // ✅ DSA FILTER (FIXED 🔥)
        ->when($role == 6, function ($q) use ($userId) {
            $q->where(function($qq) use ($userId){

                // Direct DSA loans
                $qq->where('loans.dsa_id', $userId)

                // OR mapped customers
                ->orWhereIn('loans.user_id', function($sub) use ($userId) {
                    $sub->select('user_id')
                        ->from('dsa_customers')
                        ->where('dsa_id', $userId);
                });

            });
        })

        // ✅ ADMIN FILTER (ADD THIS 🔥)
        ->when($role == 4, function ($q) {
            $q->where(function($qq){
                $qq->whereNull('loans.dsa_id')
                   ->orWhere('loans.dsa_id', 0);
            });
        })

        // 🔍 SEARCH
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

    $role   = session('role_id');
    $userId = session('user_id');

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

        // ✅ DSA FILTER (FIXED 🔥)
        ->when($role == 6, function ($q) use ($userId) {
            $q->where(function($qq) use ($userId){

                // Direct DSA loans
                $qq->where('loans.dsa_id', $userId)

                // OR mapped customers
                ->orWhereIn('loans.user_id', function($sub) use ($userId) {
                    $sub->select('user_id')
                        ->from('dsa_customers')
                        ->where('dsa_id', $userId);
                });

            });
        })

        // ✅ ADMIN FILTER (ADD THIS 🔥)
        ->when($role == 4, function ($q) {
            $q->where(function($qq){
                $qq->whereNull('loans.dsa_id')
                   ->orWhere('loans.dsa_id', 0);
            });
        })

        // 🔍 SEARCH
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
    $role_id = session()->get('role_id');
    $userId  = session()->get('user_id');

    // ✅ Allow roles
    if (!in_array($role_id, [2,4,6])) {
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

        // ✅ DSA FILTER (FIXED 🔥)
        ->when($role_id == 6, function ($q) use ($userId) {
            $q->where(function($qq) use ($userId){

                // Direct DSA loans
                $qq->where('loans.dsa_id', $userId)

                // OR mapped customers
                ->orWhereIn('loans.user_id', function($sub) use ($userId) {
                    $sub->select('user_id')
                        ->from('dsa_customers')
                        ->where('dsa_id', $userId);
                });

            });
        })

        // ✅ ADMIN FILTER (ADD THIS 🔥)
        ->when($role_id == 4, function ($q) {
            $q->where(function($qq){
                $qq->whereNull('loans.dsa_id')
                   ->orWhere('loans.dsa_id', 0);
            });
        })

        // 🔍 SEARCH
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
private function applyRoleFilter($query, $role, $userId)
{
    // ✅ DSA
    if ($role == 6) {
        $query->where(function($q) use ($userId){
            $q->where('dsa_id', $userId)
              ->orWhereIn('user_id', function($sub) use ($userId){
                  $sub->select('user_id')
                      ->from('dsa_customers')
                      ->where('dsa_id', $userId);
              });
        });
    }

    // ✅ ADMIN
    if ($role == 4) {
        $query->where(function($q){
            $q->whereNull('dsa_id')
              ->orWhere('dsa_id', 0);
        });
    }

    return $query;
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


    
    public function handleStep(Request $request)
{
    $sessionUserId   = session('user_id');
    $sessionUserRole = session('role_id');

    if (!$sessionUserId) {
        return redirect()->route('login');
    }

    $currentStep = (int) $request->input('current_step');

    // ADMIN user selection
  if (in_array($sessionUserRole,[2,4,6])) {

    if ($request->user_id) {
        session(['selected_user_id' => $request->user_id]);
    }

}
if (in_array($sessionUserRole,[2,4,6])) {

    $userId = session('selected_user_id');

    if (!$userId) {
        return redirect()->back()->withErrors([
            'user_id' => 'Please select customer first'
        ]);
    }

} else {
    $userId = $sessionUserId;
}
    if ($request->has('previous')) {
        return redirect()->route('loan.form', [
            'current_step' => max(1, $currentStep - 1)
        ]);
    }

  // 🔥 STEP 3: DOCUMENT UPLOAD (SEPARATE - VERY IMPORTANT)
if ($request->has('upload_docs')) {

    $this->handleDocumentUpload($request, $userId);

    return back()->with('success', 'Documents uploaded successfully');
}


// 🔥 NORMAL STEP FLOW
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

    return redirect()->route('loan.form', [
        'current_step' => $currentStep + 1
    ]);
}

    return back();
}


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

    //* ===============================
//    STEP 2: FETCH LOAN (SMART FIX)
//    =============================== */

$loan = null;

// 1. Try session loan
if (Session::get('current_loan_id')) {
    $loan = Loan::find(Session::get('current_loan_id'));
}

// 2. If not found → try DB (latest active loan)
if (!$loan) {
   if ($loan) {
    $loan->status = strtolower($request->status);
    $loan->save();
}

    // 👉 found → set session
    if ($loan) {
        Session::put('current_loan_id', $loan->loan_id);
    }
}

// 3. 🔥 FINAL FIX (NO DRAFT, CREATE ONLY WHEN NEEDED)
if (!$loan) {

    $loanCategoryId = Session::get('loan_category_id');
    $bankId = Session::get('bank_id');

    // ❌ still no data → block upload
    if (!$loanCategoryId || !$bankId) {
        return response()->json([
            'status' => 0,
            'msg' => 'Please apply loan first'
        ]);
    }

    // ✅ CREATE LOAN ONLY NOW (NO DRAFT ISSUE)
    $loan = Loan::create([
        'user_id' => $userId,
        'loan_reference_id' => $this->generateLoanReferenceId(),
        'loan_category_id' => $loanCategoryId,
        'bank_id' => $bankId,
        'status' => 'in process' // 🔥 NOT draft
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
        // 🔥 DSA FIX (ADD THIS)
if (session('role_id') == 6) {

    $mappedUserId = DB::table('dsa_customers')
        ->where('id', $userId)
        ->value('user_id');

    if ($mappedUserId) {
        $userId = $mappedUserId;
    }
}
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

  $loan = Loan::create([
    'user_id' => $userId,

    // 🔥 ADD THIS LINE
    'dsa_id' => session('role_id') == 6 ? session('user_id') : null,

    'loan_reference_id' => $this->generateLoanReferenceId(),
    'loan_category_id' => $loan_category_id,
    'bank_id' => $bank_id,
    'amount' => $validated['amount'],
    'tenure' => $validated['tenure'],
    'referral_user_id' => $referralUserId,
    'status' => 'in process',

    'agent_id' => session('role_id') == 2 ? session('user_id') : null,
]);

            Session::put('current_loan_id', $loan->loan_id);

        } else {

        // Update existing loan
        $loan->update([
    'loan_category_id' => $loan_category_id,
    'bank_id' => $bank_id,
    'amount' => $validated['amount'],
    'tenure' => $validated['tenure'],
    'referral_user_id' => $referralUserId,
    'status' => 'in process',

    // 🔥 ADD THIS
    'dsa_id' => session('role_id') == 6 
    ? session('user_id') 
    : ($loan->dsa_id ?? null),

    'agent_id' => session('role_id') == 2 ? session('user_id') : $loan->agent_id,
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

    // ✅ SAFETY CHECK (ADD)
    if (!$userId) {
        return redirect()->route('login')
            ->withErrors('User / Customer session missing.');
    }

    DB::beginTransaction();

    try {

        // ✅ Save Personal Details
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

        // ✅ FETCH EXISTING LOAN (FIX + SOFT DELETE CHECK)
        $loan = Loan::where('user_id', $userId)
            ->whereNotIn('status', ['disbursed','rejected'])
            ->whereNull('deleted_at') // 🔥 ADD
            ->latest()
            ->first();

        // ✅ CREATE IF NOT EXISTS (ADD)
        if (!$loan) {
            $loan = Loan::create([
                'user_id' => $userId,
                'loan_reference_id' => $this->generateLoanReferenceId(),
                'status' => 'in process',
                'dsa_id' => session('role_id') == 6 ? session('user_id') : null,
            ]);
        }

        // ✅ ALWAYS UPDATE
        $loan->update([
            'loan_category_id' => $request->loan_category_id,
            'bank_id' => $request->bank_id,
            'status' => 'in process',

            // 🔥 SAFE DSA UPDATE
            'dsa_id' => session('role_id') == 6 
                ? session('user_id') 
                : $loan->dsa_id,

            'loan_amount' => $request->loan_amount,
            'loan_tenure' => $request->loan_tenure,
            'interest_rate' => $request->interest_rate,
            'purpose' => $request->purpose
        ]);

        // ✅ Save Professional Details
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

        // ✅ Save Education Details
        Education::updateOrCreate(
            ['user_id' => $userId],
            $request->only([
                'qualification',
                'pass_year',
                'college_name',
                'college_address'
            ])
        );

        // ✅ Existing Loans
        if ($request->has('existing_loans')) {
            foreach ($request->existing_loans as $loanData) {
                DB::table('existing_loan')->updateOrInsert(
                    [
                        'user_id' => $userId,
                        'existing_loan_id' => $loanData['existing_loan_id'] ?? null
                    ],
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

        // ✅ Documents Upload
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
            return view('admin.thank-you', [
                'loanReferenceId' => $loan->loan_reference_id
            ]);
        }

        return view('frontend.thank-loan', [
            'loanReferenceId' => $loan->loan_reference_id
        ]);

    } catch (\Exception $e) {

        DB::rollBack();

        Log::error('Loan application submission failed: ' . $e->getMessage(), [
            'stack' => $e->getTraceAsString()
        ]);

        throw $e;
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
   

$totalCount = Loan::where('agent_id', $agent_id)
    ->where('agent_action', 'accepted')
    ->whereNull('deleted_at')
    ->count();

$inProcessCount = Loan::where('agent_id', $agent_id)
    ->where('agent_action', 'accepted')
    ->where('status', 'in process')
    ->count();

$approvedCount = Loan::where('agent_id', $agent_id)
    ->where('agent_action', 'accepted')
    ->where('status', 'approved')
    ->count();

$disbursedCount = Loan::where('agent_id', $agent_id)
    ->where('agent_action', 'accepted')
    ->where('status', 'disbursed')
    ->count();

        $query = DB::table('loans')
            ->join('users', 'loans.user_id', '=', 'users.id')
            ->join('loan_category', 'loans.loan_category_id', '=', 'loan_category.loan_category_id')
            ->where('loans.agent_id', $agent_id)
->where('loans.agent_action', 'accepted')
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

    // ✅ TOTAL COUNT
    $totalCount = Loan::where('agent_id', $agent_id)
        ->where('agent_action', 'accepted')
        ->count();

    // ✅ QUERY
    $query = Loan::with(['user', 'loanCategory'])
        ->where('agent_id', $agent_id)
        ->where('agent_action', 'accepted') // 🔥 FIX

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

    // ✅ PAGINATION
    $loans = $query->orderByDesc('created_at')
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
