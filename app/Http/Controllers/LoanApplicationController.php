<?php
namespace App\Http\Controllers;
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
    $query = DB::table('loans')
        ->join('users', 'loans.user_id', '=', 'users.id')
        ->join('loan_category', 'loans.loan_category_id', '=', 'loan_category.loan_category_id')
        ->leftJoin('loan_bank_details', 'loans.bank_id', '=', 'loan_bank_details.bank_id')
        ->leftJoin('profile', 'users.id', '=', 'profile.user_id')
        ->select(
            'loans.loan_id',
            'loans.amount',
            'loans.tenure',
            'loans.loan_reference_id',
            'users.name as user_name',
            'loans.status',
            'profile.city as city',
            'loan_category.category_name as loan_category_name',
            'loan_bank_details.bank_name as bank_name',
            'loans.agent_action'
        )
        ->whereNotNull('loans.loan_reference_id'); // Add the condition to exclude loans without loan_reference_id

    // Apply filters if present
    if ($request->filled('status')) {
        $query->where('loans.status', $request->input('status'));
    }

    if ($request->filled('start_date') && $request->filled('end_date')) {
        $query->whereBetween('loans.created_at', [$request->input('start_date'), $request->input('end_date')]);
    }

    $data['loans'] = $query->paginate(10);

    // Fetch recent 5 loans (optional, same as before)
    $recentLoans = DB::table('loans')
        ->join('users', 'loans.user_id', '=', 'users.id')
        ->select(
            'loans.loan_id',
            'loans.amount',
            'users.name as user_name',
            'loans.status'
        )
        ->whereNotNull('loans.loan_reference_id') // Add the condition here too
        ->latest('loans.created_at')
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
public function update(Request $request)
{
    try {
        // Validate the request
        $validated = $request->validate([
            'loan_id' => 'required|integer',
            'status' => 'required|string',
            'loan_category_id' => 'required|integer',
            'amount' => 'required|numeric',
            'amount_approved' => 'required_if:status,disbursed|numeric',
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
            $loan->save();

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
                foreach ($request->file('documents') as $index => $document) {
                    $filename = time() . '_' . $document->getClientOriginalName();
                    $filePath = $document->storeAs('documents', $filename, 'public');
                    \DB::table('documents')->insert([
                        'user_id' => $loan->user_id,
                        'document_name' => $request->input('document_names.' . $index, $filename),
                        'file_path' => $filePath,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            // Send email notification if the status has changed
            if ($oldStatus !== $newStatus) {
                $customer = $loan->user; 
                $customerEmail = $customer->email_id;
                $customerName = $customer->name;
                $status = $newStatus;
                $remarks = $request->input('remarks');
                $msg = "Your loan status has been updated to: $status. Remarks: $remarks";
                $temp_id = 4; // Example template ID, adjust accordingly
                app(UsersController::class)->temail($customerEmail, $customerName, $msg, $temp_id);

                // Start MLM Insertion
                if($newStatus == 'disbursed'){
                    $name = $customerName;
                    $parent = $loan->referral_user_id;
                    $nodeInserted = app(CategoryController::class)->addNode($parent, $name);
                    $amount_approved = $loan->amount_approved;
                    
                    $userId = $loan->user_id;
                    app(CategoryController::class)->commission_destribution($parent, $amount_approved, $userId);
                }
                // End MLM Insertion
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
        ->select('loan_id', 'loan_reference_id', 'status', 'loan_category_id','bank_id') // Include loan_category_id
        ->where('user_id', $userId)
        ->first();
        $hasExistingLoan = !is_null($existingLoans);
        $states = DB::table('states')->get();
        $user = DB::table('users')->where('id', $userId)->first();
        return view('frontend.professional-info', compact(
            'currentStep', 'is_loan','loanCategories', 'states', 'hasExistingLoan','loanBanks', 'profile', 'professional', 'education', 'existingLoans', 'documents', 'loan'
        ));
    }


    public function showForm(Request $request)
    {
        $currentStep = $request->input('current_step', 1);
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
        ->select('loan_id', 'loan_reference_id', 'status', 'loan_category_id','bank_id') // Include loan_category_id
        ->where('user_id', $userId)
        ->first();
        $hasExistingLoan = !is_null($existingLoans);
        $user = DB::table('users')->where('id', $userId)->first();
        $states = DB::table('states')->get();
        $is_loan = Session::get('is_loan');

        return view('frontend.professional-info', compact(
            'currentStep', 'loanCategories', 'states', 'hasExistingLoan','loanBanks', 'profile', 'professional', 'education', 'existingLoans', 'documents', 'loan','is_loan'
        ));
    }
    
   
    public function handleStep(Request $request)
{
    $userId = session('user_id'); // Get user ID from session
    if (!$userId) {
        return redirect()->route('login')->withErrors('User session expired. Please log in again.');
    }

    $currentStep = $request->input('current_step');

    try {
        // Determine whether the "Previous" or "Next" button was clicked
        if ($request->has('previous')) {
            $currentStep = max(1, $currentStep - 1); // Ensure the step doesn't go below 1
            return redirect()->route('loan.form', ['current_step' => $currentStep]);
        } elseif ($request->has('next')) {
            // Validate and handle the current step
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
                    $this->handleExistingLoanDetails($request, $userId);
                    break;
                case 5:
                    $this->handleDocumentUpload($request, $userId);
                    break;
                case 6:
                    $this->handleLoanDetails($request, $userId);
                    return redirect()->route('loan.thankyou');
                default:
                    return redirect()->route('loan.form', ['current_step' => 1])
                        ->withErrors('Invalid step. Please restart the application process.');
            }

            // Move to the next step
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
            'marital_status' => 'required|string|max:50',
            'dob' => 'required|date',
            'residence_address' => 'required|string|max:255',
            'city' => 'required|integer|exists:cities,id',
            'state' => 'required|integer|exists:states,id',
            'pincode' => 'required|string|max:10',
            'loan_category_id' => 'required|integer',
            'bank_id' => 'required|integer',
        ]);
    
        // Update or insert into the 'profile' table for personal details
        DB::table('profile')->updateOrInsert(
            ['user_id' => $userId],
            [
                'mobile_no' => $validated['mobile_no'],
                'marital_status' => $validated['marital_status'],
                'dob' => $validated['dob'],
                'residence_address' => $validated['residence_address'],
                'city' => $validated['city'],
                'state' => $validated['state'],
                'pincode' => $validated['pincode']
            ]
        );

        $is_loan = Session::get('is_loan');
        $is_exist = DB::table('loans')->where('user_id', $userId)->first();

         if($is_loan == 1){
            $l = new Loan;
            $l->user_id = $userId;
            $l->loan_category_id = $validated['loan_category_id'];
            $l->bank_id = $validated['bank_id'];
            $l->save();
            
            $loan_id = $l->loan_id;
            Session::put('loan_id', $loan_id);

        }else{
                $updateLoan = array(
                    'loan_category_id' => $validated['loan_category_id']
                );

            $update_loan = DB::table('loans')->where('user_id',$userId)->update($updateLoan);
        }
    }


    protected function handleProfessionalDetails(Request $request, $userId)
    {
        $validated = $request->validate([
            'profession_type' => 'required|string|in:salaried,self',
            'company_name' => 'required|string|max:255',
            'industry' => 'required|string|max:100',
            'company_address' => 'required|string|max:255',
            'experience_year' => 'required|integer',
            'designation' => 'required|string|max:100',
            'netsalary' => 'nullable|numeric',
            'selfincome' => 'nullable|numeric',
            'business_establish_date' => 'nullable|date',
            'gross_salary' => 'nullable|numeric'
        ]);

        $is_loan = Session::get('is_loan');
        $is_exist = DB::table('professional_details')->where('user_id', $userId)->first();

        if($is_loan == 1 && empty($is_exist )){
            $p = new Professional;
            $p->user_id = $userId;
            $p->profession_type = $validated['profession_type'];
            $p->company_name = $validated['company_name'];
            $p->industry = $validated['industry'];
            $p->company_address = $validated['company_address'];
            $p->experience_year = $validated['experience_year'];
            $p->designation = $validated['designation'];
            $p->netsalary = $validated['netsalary'];
            $p->gross_salary = $validated['gross_salary'];
            $p->business_establish_date = $validated['business_establish_date'];
            $p->selfincome = $validated['selfincome'];
            $p->save();

        }else{
                $updateLoan = array(
                    'profession_type' => $validated['profession_type'],
                    'company_name' => $validated['company_name'],
                    'industry' => $validated['industry'],
                    'company_address' => $validated['company_address'],
                    'experience_year' => $validated['experience_year'],
                    'designation' => $validated['designation'],
                    'netsalary' => $validated['netsalary'],
                    'gross_salary' => $validated['gross_salary'],
                    'business_establish_date' => $validated['business_establish_date'],
                    'selfincome' => $validated['selfincome']
                );

            $update_loan = DB::table('professional_details')->where('user_id',$userId)->update($updateLoan);
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

        $is_loan = Session::get('is_loan');
        $is_exist = DB::table('education_details')->where('user_id', $userId)->first();

        if($is_loan == 1 && empty($is_exist )){
            $p = new Education;
            $p->user_id = $userId;
            $p->qualification = $validated['qualification'];
            $p->pass_year = $validated['pass_year'];
            $p->college_name = $validated['college_name'];
            $p->college_address = $validated['college_address'];
            $p->save();

        }else{
                $updateEducation = array(
                    'qualification' => $validated['qualification'],
                    'pass_year' => $validated['pass_year'],
                    'college_name' => $validated['college_name'],
                    'college_address' => $validated['college_address']
                );

            $update_loan = DB::table('education_details')->where('user_id',$userId)->update($updateEducation);
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
    $documents = ['aadhar_card', 'pancard', 'qualification_proof', 'salary_slip', 'form_16', 'bank_statement', 'passport', 'light_bill', 'dl', 'rent_agree']; // List of possible document types

    foreach ($documents as $docType) {
        if ($request->hasFile($docType)) {
            $file = $request->file($docType);
            $fileName = $docType . '_' . $userId . '.' . $file->extension();
            $filePath = $file->storeAs('documents', $fileName);

                DB::table('documents')->updateOrInsert(
                    [
                        'user_id' => $userId,
                        'document_name' => $docType
                    ],
                    [
                        'file_path' => $filePath
                    ]
                );
            }
        }
    }

    protected function handleLoanDetails(Request $request, $userId)
{
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

    $is_loan = Session::get('is_loan');
    $loan_id = Session::get('loan_id', null);

    if ($is_loan == 1 && empty(DB::table('loans')->where('user_id', $userId)->first())) {
        $l = new Loan;
        $l->user_id = $userId;
        $l->loan_category_id = $validated['loan_category_id'];
        $l->bank_id = $validated['bank_id'];
        $l->loan_reference_id = $loanReferenceId;
        $l->save();
    } else {
        if (!$loan_id) {
            \Log::warning('No loan_id found in session for user_id: ' . $userId);
            return redirect()->route('loan.getback')->withErrors('No active loan found.');
        }
        DB::table('loans')->where('loan_id', $loan_id)->update([
            'referral_user_id' => $referralUserId,
            'amount' => $validated['amount'],
            'tenure' => $validated['tenure'],
            'loan_reference_id' => $loanReferenceId,
        ]);
    }

    session(['loan_reference_id' => $loanReferenceId]);

    $credit = DB::table('credit')->where('user_id', $userId)->first();
    if ($credit) {
        $creditScore = (int) $credit->credit_score;
        \Log::info('Credit score for user_id ' . $userId . ': ' . $creditScore);
        return redirect()->route($creditScore < 700 ? 'loan.getback' : 'loan.thankyou');
    }

    \Log::error('No credit score found for user_id ' . $userId);
    return redirect()->route('loan.getback')->withErrors('Credit score not found.');
}

    public function thankYou()
    {
        $loanReferenceId = session('loan_reference_id');
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
    public function allAgentLoans()
{
    $agent_id = session()->get('user_id'); // Assuming the agent's ID is stored as 'user_id'

    $data['loans'] = DB::table('loans')
        ->join('users', 'loans.user_id', '=', 'users.id')
        ->join('loan_category', 'loans.loan_category_id', '=', 'loan_category.loan_category_id')
        ->where('loans.agent_id', $agent_id) // Filter by the logged-in agent's ID
        ->select(
            'loans.loan_id',
            'loans.amount',
            'loans.tenure',
            'loans.loan_reference_id',
            'users.name as user_name',
            'loan_category.category_name as loan_category_name',
            'loans.agent_action'
        )
        ->paginate(10); // Adjust the pagination limit if necessary

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
        ->whereNotNull('loan_reference_id') // Ensure loan_reference_id is present
        ->where(function ($query) {
            $query->whereNull('agent_id')
                ->orWhere('agent_action', 'Pending')
                ->orWhereNull('agent_action')
                ->orWhere('agent_action', 'rejected'); // Include rejected loans
        })
        ->paginate(10); // Adjust pagination as needed

    $agents = DB::table('users')->where('role_id', 2)->get(); // Fetch agents from the users table

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


    public function applyNow(){
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