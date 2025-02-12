<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
use Validator;
use App\Models\Professional;
use App\Models\Education;
use App\Models\LoanCategory;
use App\Models\ExistingLoan;
use App\Models\Document;
use App\Models\Category;
use App\Models\Loan;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use App\Models\User;
use App\Models\Profile;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use App\Models\Notification;



class AgentController extends Controller
{
    public function addAgent()
    {
        return view('agent.addAgent');
    }

    public function allAgents()
{
    $data['allAgents'] = DB::table('users')
        ->join('profile', 'users.id', '=', 'profile.user_id')
        ->where('users.role_id', 2)
        ->whereNull('users.deleted_at') // Exclude soft deleted users
        ->select('users.id', 'users.name', 'users.email_id', 'profile.mobile_no', 'profile.dob')
        ->paginate(10);

    return view('agent.allAgents', compact('data'));
}


    public function insertAgent(Request $request)
    {   
        DB::beginTransaction();

        try{

            $validator = Validator::make($request->all(),[
                'email_id' => 'required|unique:users,email_id'
            ]);

            if(!$validator->passes()){
                return response()->json(['status'=>0,'error'=>$validator->errors()->toArray()]);
            }else{
             
                $six_digit_random_number = random_int(100000, 999999);

                //generating the referal code
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                    for ($i = 0; $i < 10; $i++) {
                        $randomString .= $characters[random_int(0, $charactersLength - 1)];
                    }
              

                $user = new User;
                $user->name = $request->full_name;
                $user->email_id = $request->email_id;
                $user->password = md5($request->password);
                $user->role_id = 2;  //role_id = 2 for the agent standard user
                $user->email_otp = $six_digit_random_number;
                $user->referral_code	 = $randomString;

                $user->save();

                $profile = new Profile;
                $profile->user_id = $user->id; 
                $profile->mobile_no = $request->mobile_no; 
                $profile->dob = $request->dob;
                $profile->residence_address = $request->address;
                $profile->city = $request->city;
                $profile->state = $request->state;
                $profile->pincode = $request->pincode;

                $profile->save();

                //fetching data after insertion in user and profile table
                $user_id = $user->id;
                $profile_id = $profile->profile_id;

                //update the profile id in users table
                $update_user = User::where('id', $user_id)->update(['profile_id' => $profile_id]);

                $msg = "http://127.0.0.1:8000/userAuth/".$user_id."/".$six_digit_random_number;
                $temp_id = 1;

                if($user && $profile ){
                    DB::commit();

                     //calling UsersController temail function from FrontendController
                    app(UsersController::class)->temail($request->email_id, $request->full_name, $msg, $temp_id);

                    //activity logs
                    $username = Session::get('username');
                    $user_id = Session::get('user_id');
                    $details = "Agent is created successfully by ".$username; 
                    app(UsersController::class)->insertActivityLogs($user_id, $details);
                    //end of activity logs   
                   
                    return response()->json(['status'=>1,'msg'=>'User added successfully']);
                }
            }

        }catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status'=> 0,'msg'=>$e->getMessage()]);
           // dd($e->getMessage());
        } 
    }

    public function editAgent($id){    
        $id = '"'.$id.'"';
        $data['user'] = DB::select('SELECT u.id,u.name, u.email_id, u.password, p.mobile_no, p.dob, p.residence_address,p.city, p.state, 
        p.pincode FROM users as u, profile p WHERE u.id = p.user_id and u.role_id = 2 and u.id = '.$id);
        return view('agent.editAgent',compact('data'));

    }

    public function updateAgent(Request $request){
        $user_id = $request->user_id;
       
        $updateUser = array(
            'name'=> $request->full_name,
            'email_id'=>$request->email_id,
        );

        $updateProfile = array(
            'mobile_no'=> $request->mobile_no,
            'dob'=>$request->dob,
            'residence_address'=>$request->address,
            'city'=>$request->city,
            'state'=>$request->state,
            'pincode'=>$request->pincode
        );

        try{     

            //activity logs
            $username = Session::get('username');
            $user_id = Session::get('user_id');
            $details = "Agent information updated successfully by ".$username; 
            app(UsersController::class)->insertActivityLogs($user_id, $details);
            //end of activity logs   

            $update_user = DB::table('users')->where('id',$user_id)->update($updateUser);
            $update_profile = DB::table('profile')->where('user_id',$user_id)->update($updateProfile);
            return response()->json(['status'=>1,'msg'=>'User information updated successfully !']);

        }catch (\Exception $e) {           
            return $e->getMessage();
        }
    }

    public function deleteAgent(Request $request)
{
    try {
        DB::beginTransaction();

        $user_id = $request->user_id;

        // Find user and soft delete
        $user = User::find($user_id);
        if (!$user) {
            return response()->json(['status' => 0, 'error' => 'Agent not found']);
        }
        $user->delete(); // Soft delete user

        // Soft delete profile if the model supports it
        $profile = Profile::where('user_id', $user_id)->first();
        if ($profile) {
            $profile->delete(); // This will automatically update deleted_at if SoftDeletes is used
        }

        // Log activity
        $username = session()->get('username');
        $admin_id = session()->get('user_id');
        $details = "Agent was deleted successfully by " . $username;
        app(UsersController::class)->insertActivityLogs($admin_id, $details);

        DB::commit();
        return response()->json(['status' => 1, 'msg' => 'Agent user deleted successfully!']);
    } catch (\Exception $e) {
        DB::rollback();
        return response()->json(['status' => 0, 'error' => 'Error deleting agent: ' . $e->getMessage()]);
    }
}

    public function agentDashboard()
{
    $userId = Session::get('user_id'); // Retrieve user_id from session

    if (empty($userId)) {
        return redirect('/')->with('error', 'User not logged in.');
    }

    // Debugging: Check if userId is correctly retrieved
    \Log::info('User ID: ' . $userId);

    // Fetch wallet balance
    $walletBalance = DB::table('wallet')
        ->where('user_id', $userId)
        ->value('wallet_balance');

    // Debugging: Check if walletBalance is retrieved
    \Log::info('Wallet Balance: ' . $walletBalance);

    // Fetch total number of loans assigned to the current user
    $assignedLoans = DB::table('loans')
        ->where('agent_id', $userId)
        ->count();

    // Debugging: Check if assignedLoans is retrieved
    \Log::info('Assigned Loans Count: ' . $assignedLoans);

    return view('agent.agentDashboard', compact('walletBalance', 'assignedLoans'));
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

    // Fetch all users with role_id 2 (agents) and loan categories
    $agents = User::join('role_user', 'users.id', '=', 'role_user.user_id')
                  ->where('role_user.role_id', 2)
                  ->select('users.id', 'users.name')
                  ->get();
    
    $applyingUser = User::find($loan->user_id);
    $loanCategories = LoanCategory::all();

    // Fetch existing documents
    $documents = \DB::table('documents')->where('user_id', $loan->user_id)->get();
    
    return view('agent.edit-loan', compact('loan', 'loanCategories', 'profile', 'professional', 'education', 'agents', 'applyingUser', 'documents'));
}
//view loan
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

    // Fetch related documents
    $documents = DB::select(
        'SELECT * FROM documents WHERE user_id = ?',
        [$loan->user_id]
    );

    // Pass all data to the view, including the sanction letter
    return view('agent.loan-details', [
        'loan' => $loan,
        'profile' => $profile,
        'professional' => $professional,
        'education' => $education,
        'documents' => $documents,
        'sanctionLetter' => $loan->sanction_letter, // Add this line
    ]);
}
public function update(Request $request)
{
    try {
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

            $loan->update([
                'loan_category_id' => $request->input('loan_category_id'),
                'amount' => $request->input('amount'),
                'tenure' => $request->input('tenure'),
                'status' => $newStatus,
                'remarks' => $request->input('remarks'),
                'in_principle' => $request->input('in_principle'),
            ]);

            \Log::info('Loan details updated for loan ID: ' . $loan->loan_id);

            if ($newStatus == 'disbursed') {
                $loan->amount_approved = $request->input('amount_approved');
                $loan->status = $newStatus; // Set status again, to be sure
                $loan->save(); // Explicitly save all changes

                \Log::info('Loan approved amount set for loan ID: ' . $loan->loan_id);

                // Handle tree node addition
                $referralUser = User::find($loan->referral_user_id);

                if (!$referralUser) {
                    \Log::warning("Referral user not found for ID: {$loan->referral_user_id}. Searching for next available node.");
                    $parentNode = app(CategoryController::class)->findNextAvailableNode();

                    if (!$parentNode) {
                        \Log::error("No available position found in the tree.");
                        return;
                    }

                    $parentUserId = $parentNode->user_id;
                } else {
                    \Log::info("Referral user found: " . json_encode($referralUser->toArray()));
                    $parentUserId = $referralUser->id;
                }

                $childName = $loan->user->name;
                $childUserId = $loan->user->id;

                if (app(CategoryController::class)->addNode($parentUserId, $childName, $childUserId)) {
                    \Log::info("Node successfully inserted into tree for loan applicant.");
                } else {
                    \Log::error("Failed to insert node into tree for loan applicant.");
                    return;
                }

                // Fetch ancestors for commission distribution
                $childCategory = DB::table('categories')->where('user_id', $childUserId)->first();

                if (!$childCategory) {
                    \Log::error("Category not found for Child User ID: {$childUserId}");
                    return;
                }

                $ancestors = DB::table('categories')
                    ->where('_lft', '<', $childCategory->_lft)
                    ->where('_rgt', '>', $childCategory->_rgt)
                    ->orderBy('_lft', 'asc')
                    ->get();

                if ($ancestors->isEmpty()) {
                    \Log::info("No ancestors found for Child User ID: {$childUserId}. Skipping commission distribution.");
                    return;
                }

                // Distribute commission
                app(CategoryController::class)->commissionDistribution($childUserId, $loan->amount_approved);

                if ($referralUser) {
                    \Log::info("Commission distribution executed for user: {$loan->user_id}, Parent: {$referralUser->name}");
                } else {
                    \Log::info("Commission distribution executed for user: {$loan->user_id}, No valid referral user found.");
                }            }
        });

        return redirect()->back()->with('success', 'Loan updated successfully!');
    } catch (\Exception $e) {
        \Log::error("Error updating loan:", ['exception' => $e->getMessage()]);
        return redirect()->back()->withErrors(['error' => "An error occurred: {$e->getMessage()}"])->withInput();
    }
}
public function agentMis()
{
    $agent_id = session()->get('user_id'); // Assuming the agent's ID is stored as 'user_id'

    $data['loans'] = DB::table('loans')
        ->join('users', 'loans.user_id', '=', 'users.id')
        ->join('loan_category', 'loans.loan_category_id', '=', 'loan_category.loan_category_id')
        ->join('profile', 'users.id', '=', 'profile.user_id')
        ->where('loans.agent_id', $agent_id) // Filter by the logged-in agent's ID
        ->select(
            'loans.loan_id',
            'loans.amount',
            'loans.tenure',
            'loans.loan_reference_id',
            'users.name as user_name',
            'users.email_id as email',
            'profile.mobile_no',
            'profile.city',
            'loan_category.category_name as loan_category_name',
            'loans.agent_action'
        )
        ->paginate(10); // Adjust the pagination limit if necessary

    return view('agent.mis', compact('data'));
}
//view MIS
public function viewMis($id)
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

    // Fetch related documents
    $documents = DB::select(
        'SELECT * FROM documents WHERE user_id = ?',
        [$loan->user_id]
    );

    // Pass all data to the view, including the sanction letter
    return view('agent.view-mis', [
        'loan' => $loan,
        'profile' => $profile,
        'professional' => $professional,
        'education' => $education,
        'documents' => $documents,
        'sanctionLetter' => $loan->sanction_letter, // Add this line
    ]);
}
       
}
