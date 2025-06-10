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


class LoanApplicationController extends Controller
{

    // protected $creditScoreService;

    // public function __construct(CreditScoreService $creditScoreService)
    // {
    //     $this->creditScoreService = $creditScoreService;
    // }

    public function index(Request $request)
    {
        // Step 1: Build the base query
        $query = \App\Models\Loan::with([
            'user.profile.cityRelation',
            'loanCategory',
            'bankDetails'
        ])
            ->whereNotNull('loan_reference_id');

        // Step 2: Apply filters (before get or paginate)
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [
                $request->input('start_date'),
                $request->input('end_date'),
            ]);
        }

        // Step 3: Order and Paginate
        $paginated = $query->orderBy('created_at', 'desc')->paginate(10);

        // Step 4: Transform paginated result (map the collection inside paginator)
        $paginated->getCollection()->transform(function ($loan) {
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

        $data['loans'] = $paginated;

        // Step 5: Recent 5 loans using Query Builder (optional)
        $recentLoans = DB::table('loans')
            ->join('users', 'loans.user_id', '=', 'users.id')
            ->select(
                'loans.loan_id',
                'loans.amount',
                'users.name as user_name',
                'loans.status'
            )
            ->whereNotNull('loans.loan_reference_id')
            ->orderByDesc('loans.created_at')
            ->take(5)
            ->get();

        return view('frontend.all-loans', compact('data', 'recentLoans'));
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
            'SELECT * FROM profile WHERE user_id = ?',
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
    public function edit($id)
    {
        $loan = Loan::with(['user', 'loanCategory'])->where('loan_id', $id)->first();

        if (!$loan) {
            return redirect()->route('agent.allAgentLoans')->with('error', 'Loan not found');
        }

        // Fetch related data
        $profile = Profile::where('user_id', $loan->user_id)->first();
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

        // Pass all data to the view
        return view('admin.edit-loan', compact('loan', 'loanCategories', 'profile', 'documents', 'professional', 'education', 'agents', 'applyingUser'));
    }

    public function loanedit($id)
    {
        $loan = Loan::with(['user', 'loanCategory'])->where('loan_id', $id)->first();

        if (!$loan) {
            return redirect()->route('agent.allAgentLoans')->with('error', 'Loan not found');
        }

        // Fetch related data
        $profile = Profile::with('cityRelation', 'stateRelation')->where('user_id', $loan->user_id)->first();
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

        // Pass all data to the view
        return view('frontend.profile.loanedit', compact('loan', 'loanCategories', 'profile', 'documents', 'professional', 'education', 'agents', 'applyingUser'));
    }

    public function update(Request $request)
    {
        // dd($request->all());
        try {
            // Validate the request
            $validated = $request->validate([
                'loan_id' => 'required|integer',
                'status' => 'required|string',
                'loan_category_id' => 'required|integer',
                'amount' => 'required|numeric',
                'amount_approved' => ['required_if:status,disbursed','nullable','numeric'],
                'tenure' => 'required|integer',
                'in_principle' => 'nullable|string',
                'remarks' => 'nullable|string',
                'sanction_letter' => 'nullable|file|mimes:pdf,doc,docx',
                'documents.*' => 'nullable|file|mimes:pdf,doc,docx',
            ]);



            \DB::transaction(function () use ($request) {
                $loan = Loan::where('loan_id', $request->input('loan_id'))->firstOrFail();
                $oldStatus = $loan->status;
                $newStatus = $request->input('status');

                \Log::info('Loan status update:', [
                    'loan_id' => $loan->loan_id,
                    'old_status' => $oldStatus,
                    'new_status' => $newStatus,
                ]);

                // Update loan details
                $loan->loan_category_id = $request->input('loan_category_id');
                $loan->amount = $request->input('amount');
                $loan->tenure = $request->input('tenure');
                $loan->status = $newStatus;
                $loan->remarks = $request->input('remarks');
                $loan->in_principle = $request->input('in_principle');
                $loan->amount_approved = $request->input('amount_approved');
                $loan->save();

                // echo $loan;die;

                // Save the remark in the loan_remarks table
                if ($request->input('remarks')) {
                    \DB::table('loan_remarks')->insert([
                        'loan_id' => $loan->loan_id,
                        'agent_id' => session()->get('user_id'),
                        'status' => $newStatus,
                        'remarks' => $request->input('remarks'),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                // Handle sanction letter upload
                if ($request->hasFile('sanction_letter')) {
                    $sanctionLetter = $request->file('sanction_letter');
                    $sanctionLetterPath = $sanctionLetter->storeAs('sanction_letters', time() . '_' . $sanctionLetter->getClientOriginalName(), 'public');
                    $loan->update(['sanction_letter' => $sanctionLetterPath]);
                }

                // Handle document uploads
                if ($request->hasFile('documents')) {
                    $documents = $request->file('documents');
                    $documentNames = $request->input('document_name');

                    foreach ($documents as $index => $document) {
                        // Ensure there's a corresponding name for each document
                        $name = $documentNames[$index] ?? $document->getClientOriginalName();

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

                // Send email notification if the status has changed
                if ($oldStatus !== $newStatus) {
                    log::info('Dispatching LoanStatusUpdated event for loan ID: ' . $loan->loan_reference_id, [
                        'old_status' => $oldStatus,
                        'new_status' => $newStatus,
                        'loan_reference_id' => $loan->loan_reference_id,
                        'user_id' => auth()->id(),
                    ]);
                    event(new LoanStatusUpdated(
                        $loan->loan_reference_id,
                        auth()->id(),
                        auth()->user()->roles->name, // assuming you store role
                        $loan->status,
                        $loan->user_id
                    ));
                    $customer = $loan->user;
                    $customerEmail = $customer->email_id;
                    $customerName = $customer->name;
                    $status = $newStatus;
                    $remarks = $request->input('remarks');
                    $msg = "Your loan status has been updated to: $status. Remarks: $remarks";
                    $temp_id = 4; // Example template ID, adjust accordingly
                    app(UsersController::class)->temail($customerEmail, $customerName, $msg, $temp_id);
                }

                // Start MLM Insertion
                // if ($newStatus == 'disbursed') {
                //     $name = $customerName;
                //     $parent = $loan->referral_user_id;
                //     $nodeInserted = app(CategoryController::class)->addNode($parent, $name);
                //     $amount_approved = $loan->amount_approved;

                //     $userId = $loan->user_id;
                //     app(CategoryController::class)->commission_destribution($parent, $amount_approved, $userId);
                // }

                if ($newStatus == 'disbursed') {
                    $loan->amount_approved = $request->input('amount_approved');
                    $loan->status = $newStatus; // Set status again, to be sure
                    $loan->save(); // Explicitly save all changes

                    Log::info('Loan approved amount set for loan ID: ' . $loan->loan_id);

                    // Handle tree node addition
                    $referralUser = User::find($loan->referral_user_id);

                    if (!$referralUser) {
                        Log::warning("Referral user not found for ID: {$loan->referral_user_id}. Searching for next available node.");
                        $parentNode = app(CategoryController::class)->findNextAvailableNode();

                        if (!$parentNode) {
                            Log::error("No available position found in the tree.");
                            return;
                        }

                        $parentUserId = $parentNode->user_id;
                    } else {
                        Log::info("Referral user found: " . json_encode($referralUser->toArray()));
                        $parentUserId = $referralUser->id;
                    }

                    $childName = $loan->user->name;
                    $childUserId = $loan->user->id;

                    $existingCategory = DB::table('categories')->where('user_id', $childUserId)->first();

                    if ($existingCategory) {
                        Log::info("User already exists in the tree. Skipping node insertion for user ID: {$childUserId}");
                    } else {
                        if (app(CategoryController::class)->addNode($parentUserId, $childName, $childUserId)) {
                            Log::info("Node successfully inserted into tree for loan applicant.");
                        } else {
                            Log::error("Failed to insert node into tree for loan applicant.");
                            return;
                        }
                    }

                    // Fetch ancestors for commission distribution
                    $childCategory = DB::table('categories')->where('user_id', $childUserId)->first();

                    if (!$childCategory) {
                        Log::error("Category not found for Child User ID: {$childUserId}");
                        return;
                    }

                    $ancestors = DB::table('categories')
                        ->where('_lft', '<', $childCategory->_lft)
                        ->where('_rgt', '>', $childCategory->_rgt)
                        ->orderBy('_lft', 'asc')
                        ->get();

                    if ($ancestors->isEmpty()) {
                        Log::info("No ancestors found for Child User ID: {$childUserId}. Skipping commission distribution.");
                        return;
                    }

                    // Distribute commission
                    app(CategoryController::class)->commissionDistribution($childUserId, $loan->amount_approved);

                    if ($referralUser) {
                        Log::info("Commission distribution executed for user: {$loan->user_id}, Parent: {$referralUser->name}");
                    } else {
                        Log::info("Commission distribution executed for user: {$loan->user_id}, No valid referral user found.");
                    }
                }
            });



            return redirect()->back()->with('success', 'Loan updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Error updating loan', ['exception' => $e->getMessage()]);
            if ($request->expectsJson()) {
                return response()->json(['status' => 0, 'msg' => 'An error occurred while updating: ' . $e->getMessage()]);
            }
            return redirect()->back()->withErrors(['error' => 'An error occurred while updating: ' . $e->getMessage()])->withInput();
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
        $currentStep = 1;
        Session::put('is_loan', $id);
        $is_loan = $id;
        $loanCategories = DB::table('loan_category')->get();
        $loanBanks = DB::table('loan_bank_details')->get();
        $userId = session('user_id'); // Get user ID from session

        if (!$userId) {
            return redirect()->route('login')->withErrors('User session expired. Please log in again.');
        }

        // Fetch existing data
        $profile = DB::table('profile')->where('user_id', $userId)->first();
        $professional = DB::table('professional_details')->where('user_id', $userId)->first();
        $education = DB::table('education_details')->where('user_id', $userId)->first();
        $existingLoans = DB::table('existing_loan')->where('user_id', $userId)->get();
        $documents = DB::table('documents')->where('user_id', $userId)->get();
        $loan = DB::table('loans')
            ->select('loan_id', 'loan_reference_id', 'status', 'loan_category_id', 'bank_id') // Include loan_category_id
            ->where('user_id', $userId)
            ->first();
        $hasExistingLoan = !is_null($existingLoans);
        $states = DB::table('states')->get();
        $user = DB::table('users')->where('id', $userId)->first();
        return view('frontend.professional-info', compact(
            'currentStep',
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
            'loan'
        ));
    }


    public function showForm(Request $request)
    {

        // echo "ssf";die;
        $currentStep = $request->input('current_step', 1);
        // dd($currentStep);
        $loanCategories = DB::table('loan_category')->get();
        $loanBanks = DB::table('loan_bank_details')->get();
        $userId = session('user_id'); // Get user ID from session

        // echo 'gfgg';die;


        if (!$userId) {
            return redirect()->route('login')->withErrors('User session expired. Please log in again.');
        }

        // Check if user already has a loan
        // $hasActiveLoan  = Loan::where('user_id', $userId)
        //                     ->whereNotIn('status', ['disbursed', 'rejected'])
        //                     ->exists();
        // if ($hasActiveLoan) {
        //     return redirect()->route('loan.profile');
        // }

        $loanId = session('current_loan_id');

        if (!$loanId) {
            $loanId = Loan::where('user_id', $userId)->value('loan_id');
        }

        $loanUsers = collect();
        if (session('role_id') == 4) {
            $loanUsers = User::where('role_id', 1)
                ->where('is_email_verify', 1)
                ->select('id', 'name', 'email_id')
                ->get();
        }

        $profile = DB::table('profile')->where('user_id', $userId)->latest('profile_id')->first() ?? null;


        $professional = DB::table('professional_details')->where('user_id', $userId)->latest('professional_id')->first() ?? null;
        // dd($professional);
        $education = DB::table('education_details')->where('user_id', $userId)->latest('edu_id')->first() ?? null;

        $documents = DB::table('documents')->where('user_id', $userId)->latest('document_id')->get() ?? null;

        $existingLoans = DB::table('existing_loan')->where('user_id', $userId)->latest('existing_loan_id')->get();

        // echo $documents;die;
        $loan = Loan::where('user_id', $userId)->whereNotIn('status', ['disbursed', 'rejected'])->first();
        $hasExistingLoan = !is_null($existingLoans);
        $user = User::with('loans')->where('id', $userId)->first();
        $states = DB::table('states')->get();
        // echo $states;die;
        $is_loan = Session::get('is_loan');
        return view('frontend.professional-info', compact(
            'currentStep',
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
            'loanUsers'
        ));
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

    public function handleStep(Request $request)
    {
        $sessionUserId = session('user_id');
        $sessionUserRole = session('role_id');

        if (!$sessionUserId) {
            return redirect()->route('login')->withErrors('User session expired. Please log in again.');
        }

        $currentStep = $request->input('current_step');

        try {
            // Save user_id from step 1 dropdown to session if admin
            if ($sessionUserRole == 4 && $currentStep == 1) {
                $selectedUserId = $request->input('user_id');
                if (!$selectedUserId) {
                    return redirect()->back()->withErrors('Please select a user.');
                }
                session(['selected_user_id' => $selectedUserId]);
            }

            // Determine user_id to use
            if ($sessionUserRole == 4) {
                $userId = session('selected_user_id');
                if (!$userId) {
                    return redirect()->route('loan.form', ['current_step' => 1])
                        ->withErrors('User not selected. Please select a user in Step 1.');
                }
            } else {
                $userId = $sessionUserId;
            }

            if ($request->has('previous')) {
                $currentStep = max(1, $currentStep - 1);
                return redirect()->route('loan.form', ['current_step' => $currentStep]);
            } elseif ($request->has('next')) {
                switch ($currentStep) {
                    case 1:
                        $this->handlePersonalDetails($request, $userId);
                        break;
                    case 2:
                        $this->handleProfessionalDetails($request, $userId);
                        break;
                    case 3:
                        $this->handleEducationDetails($request, $userId);
                        break;
                    case 4:
                        $this->handleDocumentUpload($request, $userId);
                        break;
                    case 5:
                        $this->handleLoanDetails($request, $userId);
                        return redirect()->route('loan.thankyou');
                    default:
                        return redirect()->route('loan.form', ['current_step' => 1])
                            ->withErrors('Invalid step. Please restart the application process.');
                }

                return redirect()->route('loan.form', ['current_step' => $currentStep + 1]);
            } else {
                return redirect()->back()->withErrors('Invalid action. Please try again.');
            }
        } catch (\Exception $e) {
            Log::error('Error handling step: ' . $e->getMessage(), ['stack' => $e->getTraceAsString()]);
            return redirect()->back()->withErrors('Something went wrong. Please try again.');
        }
    }



    protected function handlePersonalDetails(Request $request, $userId)
    {
        $validated = $request->validate([
            'mobile_no' => 'required|string|max:15',
            'full_name' => 'required|string',
            'pan_number' => 'required|string',
            'marital_status' => 'required|string|max:50',
            'dob' => 'required|date',
            'residence_address' => 'required|string|max:255',
            'city' => 'required|integer|exists:cities,id',
            'state' => 'required|integer|exists:states,id',
            'pincode' => 'required|string|max:10',
            'loan_category_id' => 'required|integer',
            'bank_id' => 'required|integer',
        ]);

        $loan = Loan::where('user_id', $userId)
            ->whereNotIn('status', ['disbursed', 'rejected'])
            ->first();

        if (!$loan) {
            // Create new loan
            $loan = new Loan();
            $loan->user_id = $userId;
            $loan->loan_reference_id = Str::upper(Str::random(8)); // Generate unique reference ID
            $loan->loan_category_id = $validated['loan_category_id'];
            $loan->bank_id = $validated['bank_id'];
            $loan->status = 'in process';
            $loan->save();
        } else {
            // Update existing loan
            $loan->update([
                'loan_category_id' => $validated['loan_category_id'],
                'bank_id' => $validated['bank_id']
            ]);
        }

        // Update or insert into the 'profile' table
        DB::table('profile')->updateOrInsert(
            [
                'user_id' => $userId,
                'loan_id' => $loan->loan_id
            ],
            [
                'mobile_no' => $validated['mobile_no'],
                'full_name' => $validated['full_name'],
                'pan_number' => $validated['pan_number'],
                'marital_status' => $validated['marital_status'],
                'dob' => $validated['dob'],
                'residence_address' => $validated['residence_address'],
                'city' => $validated['city'],
                'state' => $validated['state'],
                'pincode' => $validated['pincode']
            ]
        );

        // Store loan_category_id and bank_id in session
        Session::put('loan_category_id', $validated['loan_category_id']);
        Session::put('bank_id', $validated['bank_id']);

        // Check if a loan already exists for this user


        Session::put('current_loan_id', $loan->loan_id);
    }


    protected function handleProfessionalDetails(Request $request, $userId)
    {

        // dd($request->all());die;

        $validated = $request->validate([
            'profession_type' => 'required|string|in:salaried,self',
            'company_name' => 'required|string|max:255',
            'industry' => 'required|string|max:100',
            'company_address' => 'required|string|max:255',
            'experience_year' => 'required|integer',
            'designation' => 'required|string|max:100',
            'netsalary' => $request->input('profession_type') === 'salaried' ? 'required|numeric' : 'nullable|numeric',
            'gross_salary' => $request->input('profession_type') === 'salaried' ? 'required|numeric' : 'nullable|numeric',
            'selfincome' => $request->input('profession_type') === 'self' ? 'required|numeric' : 'nullable|numeric',
            'business_establish_date' => $request->input('profession_type') === 'self' ? 'required|date' : 'nullable|date',
        ]);


        $loan_id = Session::get('current_loan_id') ?? Loan::where('user_id', $userId)
            ->whereNotIn('status', ['disbursed', 'rejected'])
            ->first();
        $professional = Professional::where('user_id', $userId)->where('loan_id', $loan_id)->first();

        if (!$professional) {
            // No record exists, create a new one
            Professional::create([
                'user_id' => $userId,
                'loan_id' => $loan_id,
                'profession_type' => $validated['profession_type'],
                'company_name' => $validated['company_name'],
                'industry' => $validated['industry'],
                'company_address' => $validated['company_address'],
                'experience_year' => $validated['experience_year'],
                'designation' => $validated['designation'],
                'netsalary' => $validated['netsalary'] ?? null,
                'gross_salary' => $validated['gross_salary'] ?? null,
                'business_establish_date' => $validated['business_establish_date'] ?? null,
                'selfincome' => $validated['selfincome'] ?? null,
            ]);
        } else {
            // Update existing record
            $professional->update([
                'profession_type' => $validated['profession_type'],
                'company_name' => $validated['company_name'],
                'industry' => $validated['industry'],
                'company_address' => $validated['company_address'],
                'experience_year' => $validated['experience_year'],
                'designation' => $validated['designation'],
                'netsalary' => $validated['netsalary'] ?? null,
                'gross_salary' => $validated['gross_salary'] ?? null,
                'business_establish_date' => $validated['business_establish_date'] ?? null,
                'selfincome' => $validated['selfincome'] ?? null,
            ]);
        }
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

        // Check if education details already exist
        $education = Education::where('user_id', $userId)->where('loan_id', $loan_id)->first();

        if (!$education) {
            // Insert new record if not found
            Education::create([
                'user_id' => $userId,
                'loan_id' => $loan_id,
                'qualification' => $validated['qualification'],
                'pass_year' => $validated['pass_year'],
                'college_name' => $validated['college_name'],
                'college_address' => $validated['college_address'],
            ]);
        } else {
            // Update existing record
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

        $loan_id = Session::get('current_loan_id') ?? Loan::where('user_id', $userId)
            ->whereNotIn('status', ['disbursed', 'rejected'])
            ->first();

        $documents = ['aadhar_card', 'pancard', 'qualification_proof', 'salary_slip', 'form_16', 'bank_statement', 'passport', 'light_bill', 'dl', 'rent_agree']; // List of possible document types

        foreach ($documents as $docType) {
            if ($request->hasFile($docType)) {
                $file = $request->file($docType);
                $fileName = $docType . '_' . $userId . '.' . $file->extension();
                $filePath = $file->storeAs('documents', $fileName, 'public');

                DB::table('documents')->updateOrInsert(
                    [
                        'user_id' => $userId,
                        'loan_id' => $loan_id,
                        'document_name' => $docType
                    ],
                    [
                        'file_path' => $filePath
                    ]
                );
            }
        }
    }
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

    protected function handleLoanDetails(Request $request, $userId)
    {
        // Retrieve stored loan category and bank from session
        $loan_category_id = Session::get('loan_category_id');
        $bank_id = Session::get('bank_id');

        if (!$loan_category_id || !$bank_id) {
            return redirect()->back()->withErrors(['error' => 'Loan category and bank ID are required.']);
        }

        $validated = $request->validate([
            'amount' => 'required|numeric',
            'tenure' => 'required|integer',
            'referral_code' => 'nullable|string|max:50',
        ]);

        $loanReferenceId = Str::upper(Str::random(8));
        $referralUserId = null;

        if (!empty($validated['referral_code'])) {
            $referralUser = DB::table('users')->where('referral_code', $validated['referral_code'])->first();
            $referralUserId = $referralUser->id ?? null;
        }

        $existingLoan = Session::get('current_loan_id');

        if ($existingLoan && is_int($existingLoan)) {
            $existingLoan = Loan::find($existingLoan); // Convert ID to model
        }

        if (!$existingLoan) {
            // First-time creation
            $loan = Loan::create([
                'user_id' => $userId,
                'loan_reference_id' => Str::upper(Str::random(8)),
                'loan_category_id' => $loan_category_id,
                'bank_id' => $bank_id,
                'amount' => $validated['amount'],
                'tenure' => $validated['tenure'],
                'referral_user_id' => $referralUserId,
                'status' => 'in process',
            ]);
            Session::put('current_loan_id', $loan->loan_id);
        } else {
            $existingLoan->update([
                'loan_category_id' => $loan_category_id,
                'bank_id' => $bank_id,
                'amount' => $validated['amount'],
                'tenure' => $validated['tenure'],
                'referral_user_id' => $referralUserId,
            ]);
            Session::put('current_loan_id', $existingLoan->loan_id);
        }

        Session::put('is_loan', true);
    }



    public function submitLoanApplication(Request $request)
    {
        $userId = session('user_id');

        if (!$userId) {
            return redirect()->route('login')->withErrors('User session expired. Please log in again.');
        }

        DB::beginTransaction();
        try {
            // Save Personal Details
            DB::table('profile')->updateOrInsert(
                ['user_id' => $userId],
                $request->only([
                    'mobile_no',
                    'marital_status',
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
                    'loan_reference_id' => Str::upper(Str::random(8)),
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
            return redirect()->back()->withErrors('Something went wrong. Please try again.');
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
        return view('agent.all-loans', compact('data'));
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
            event(new \App\Events\AgentAssigned($adminId, $agentId, $customerId, $loan->loan_reference_id, $agentName));
            return redirect()->route('loans.index')->with('success', 'Agent assigned successfully!');
        }

        return redirect()->route('loans.index')->with('error', 'Failed to assign agent.');
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
                $query->whereNull('agent_id')
                    ->orWhere(function ($subQuery) {
                        $subQuery->whereNotNull('agent_id')
                            ->whereIn('agent_action', ['Pending', 'Rejected', null]);
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


    public function applyNow()
    {

        // $user=Auth::User();
        // echo $user;die;

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
}
