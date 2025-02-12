<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
use Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use App\Models\User;
use App\Models\Profile;
use App\Models\Activity;
use Spatie\Permission\Models\Role;
use App\Models\Notification;
use Illuminate\Support\Facades\Log;


class UsersController extends Controller
{
    public function addUser()
    {
        return view('admin.addUser');
    }

   public function allUsers()
{
    $query = DB::table('users')
        ->join('profile', 'users.id', '=', 'profile.user_id')
        ->select('users.id', 'users.name', 'users.email_id', 'profile.mobile_no', 'profile.dob', 'users.is_email_verify')
        ->whereNull('users.deleted_at');
    $data['allUsers'] = $query->paginate(10);

    return view('admin.allUsers', compact('data'));
}
    public function updateUserStatus(Request $request)
    {
        DB::table('users')
            ->where('id', $request->user_id)
            ->update(['is_email_verify' => $request->is_email_verify]);
    
        return response()->json(['message' => 'User status updated successfully']);
    }

    public function insertUser(Request $request)
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
                $user->role_id = 1;  //role_id = 1 for the customer hardcoded
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
                $temp_id = 3;

                if($user && $profile ){
                    DB::commit();
                    $this->temail($request->email_id, $request->full_name, $msg, $temp_id);
                    return response()->json(['status'=>1,'msg'=>'User added successfully']);
                }
            }

        }catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        } 
    }
    //customer registration
    public function registerUser(Request $request)
{
    DB::beginTransaction();

    try {
        // Validate request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'mobile_no' => 'required|numeric|digits:10',
            'email_id' => 'required|email|unique:users,email_id',
            'password' => 'required|min:6|confirmed', // Confirmed rule checks for password confirmation
        ], [
            'email_id.unique' => 'This email address is already registered.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Generate OTP and Referral Code
        $six_digit_random_number = random_int(100000, 999999);
        $randomString = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 10);

        // Create User
        $user = new User;
        $user->name = $request->name;
        $user->email_id = $request->email_id;
        $user->password = md5($request->password); // MD5 hashing
        $user->role_id = 1; // role_id = 1 for the customer hardcoded
        $user->email_otp = $six_digit_random_number;
        $user->referral_code = $randomString;
        $user->save();

        // Create Profile
        $profile = new Profile;
        $profile->user_id = $user->id;
        $profile->mobile_no = $request->mobile_no;
        $profile->dob = $request->dob;
        $profile->residence_address = $request->address;
        $profile->city = $request->city;
        $profile->state = $request->state;
        $profile->pincode = $request->pincode;
        $profile->save();

        // Update Profile ID in User
        $user->update(['profile_id' => $profile->profile_id]);

        DB::commit();

        // Send Email
        $msg = "http://127.0.0.1:8000/userAuth/" . $user->id . "/" . $six_digit_random_number;
        $this->temail($request->email_id, $request->name, $msg, 3);

        return redirect()->back()->with('success', 'Registration Successful! Please check your email for a verification link.');
    } catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage())->withInput();
    }
}
    public function editUser($id){    
        $id = '"'.$id.'"';
        $data['user'] = DB::select('SELECT u.id,u.name, u.email_id, u.password, p.mobile_no, p.dob, p.residence_address,p.city, p.state, 
        p.pincode FROM users as u, profile p WHERE u.id = p.user_id and u.id = '.$id);
        return view('admin.editUser',compact('data'));

    }

    public function updateUser(Request $request){
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
            $update_user = DB::table('users')->where('id',$user_id)->update($updateUser);
            $update_profile = DB::table('profile')->where('user_id',$user_id)->update($updateProfile);
            return response()->json(['status'=>1,'msg'=>'User information updated successfully !']);

        }catch (\Exception $e) {           
            return $e->getMessage();
        }
    }

    public function deleteUser(Request $request){
        try {
            $user = User::find($request->user_id);
            if ($user) {
                $user->delete(); // Soft delete instead of hard delete
                return response()->json(['status' => 1, 'msg' => 'User deleted successfully!']);
            } else {
                return response()->json(['status' => 0, 'error' => 'User not found']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 0, 'error' => $e->getMessage()]);
        }
    }
    //user register
    public function register(Request $request)
        {
            DB::beginTransaction();

        try{

            $validator = Validator::make($request->all(), [
                'full_name' => 'required|string|max:255',
                'email_id' => 'required|email|unique:users,email_id',
                'password' => 'required|string|min:8|confirmed',
                'mobile_no' => 'required|numeric|digits_between:10,15', 
            ]);

            if(!$validator->passes()){
                return response()->json(['status'=>0,'error'=>$validator->errors()->toArray()]);
            }else{
             
                $six_digit_random_number = random_int(100000, 999999);


                $user = new User;
                $user->name = $request->full_name;
                $user->email_id = $request->email_id;
                $user->password = md5($request->password);
                $user->role_id = 1;  //role_id = 1 for the customer hardcoded
                $user->email_otp = $six_digit_random_number;

                $user->save();

                $profile = new Profile;
                $profile->user_id = $user->id; 
                $profile->mobile_no = $request->mobile_no; 
                $profile->save();

                //fetching data after insertion in user and profile table
                $user_id = $user->id;
                $profile_id = $profile->profile_id;

                //update the profile id in users table
                $update_user = User::where('id', $user_id)->update(['profile_id' => $profile_id]);

                $msg = "http://127.0.0.1:8000/userAuth/".$user_id."/".$six_digit_random_number;
                $temp_id = 1;

                //activity logs
                $username = Session::get('username');
                $user_id = Session::get('user_id');
                $details = "Customer user register successfully by ".$username; 
                app(UsersController::class)->insertActivityLogs($user_id, $details);
                //end of activity logs   

                if($user && $profile ){
                    DB::commit();
                    $this->temail($request->email_id, $request->full_name, $msg, $temp_id);
                    return response()->json(['status'=>1,'msg'=>'User added successfully']);
                }
            }
        }catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        } 
    }

    //Roles related functions

    public function index()
    {
        $users = User::get();
        $roles = Role::get();
        return view('admin.role-permission.user.index',[
            'users' => $users,
            'roles' =>$roles
        ]);
    }
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('admin.role-permission.user.create',[
            'roles' => $roles
        ]);
        
    }
    public function store(Request $request)
    {
        // Log::info($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'email_id' => 'required|email|max:255|unique:users,email_id',
            'password' => 'required|string|min:8|max:255',
            'roles' => 'array'
        ]);
        $user = User::create([
            'name' => $request->name,
            'email_id' => $request->email_id,
            'password' => Hash::make($request->password),
        ]);
        if ($request->has('roles')) {
            // Fetch role IDs from role names
            $roleNames = $request->input('roles');
            $roleIds = Role::whereIn('name', $roleNames)->pluck('id')->toArray();
    
            // Sync roles using IDs
            $user->roles()->sync($roleIds);
        }
    
        return redirect()->back()->with('status', 'User created successfully with roles');
    }

    public function edit(User $user)
    {
        $roles = Role::pluck('name','name')->all();
        $userRoles = $user->roles->pluck('name','name')->all();
        return view('admin.role-permission.user.edit',[
            'user' => $user,
            'roles' => $roles,
            'userRoles' => $userRoles
        ]);
    }
    
    public function update(Request $request, User $user)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|max:255',
            'roles' => 'array',
            'roles.*' => 'exists:roles,name' // Validate that each role name exists
        ]);

        // Prepare data for updating the user
        $data = [
            'name' => $request->name,
            'email_id' => $request->email_id,
        ];

        // Update password if provided
        if (!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        }

        // Update the user
        $user->update($data);

        // Convert role names to role IDs
        $roleNames = $request->input('roles', []);
        $roleIds = Role::whereIn('name', $roleNames)->pluck('id')->toArray();

        // Synchronize user roles
        $user->roles()->sync($roleIds);

        // Redirect with success message
        return redirect('admin/users')->with('status', 'User updated successfully with roles');
    }
    public function destroy($userId)
    {
        $user = User::find($userId);
        $user->delete();
        return redirect('admin/users')->with('status', 'User has been deleted');

    }


    //send an email
    function temail($email, $firstname, $msg, $temp_id)
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://api.sendinblue.com/v3/smtp/email');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
        "to" => [
            [
                "email" => $email,
                "name" => $firstname
            ]
        ],
        "templateId" => $temp_id,
        "params" => [
            "name" => $firstname,
            "email" => $email,
            "url" => $msg
        ],
        "headers" => [
            "X-Mailin-custom" => "custom_header_1:custom_value_1|custom_header_2:custom_value_2|custom_header_3:custom_value_3",
            "charset" => "iso-8859-1"
        ]
    ]));

    $headers = [
        'Accept: application/json',
        'Content-Type: application/json'
    ];
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    // Execute curl request and fetch response
    $result = curl_exec($ch);

    // Check for curl errors
    if (curl_errno($ch)) {
        $error = curl_error($ch);
        Log::error('Sendinblue Email Error: ' . $error);
        echo 'Error: ' . $error;
    } else {
        // Decode the response and log the result
        $response = json_decode($result, true);
        if (isset($response['messageId'])) {
            Log::info('Email sent successfully to ' . $email . ' with Message ID: ' . $response['messageId']);
        } else {
            Log::error('Email sending failed for ' . $email . '. Response: ' . $result);
        }
    }

    curl_close($ch);
}

    //customer profile
    public function showProfile(Request $request)
{
    $section = $request->query('section', 'personal');
    $userId = session('user_id'); // Retrieve user ID from session

    if (!$userId) {
        return redirect()->route('login')->withErrors('User session expired. Please log in again.');
    }

    // Fetch user-related data
    $user = DB::table('users')->where('id', $userId)->first();
    $referralCode = $user->referral_code ?? ''; // Fetch referral code

    // Other existing data fetching (loans, wallet, etc.)
    $profile = DB::table('profile')->where('user_id', $userId)->first();
    $professionalDetails = DB::table('professional_details')->where('user_id', $userId)->first();
    $educationalDetails = DB::table('education_details')->where('user_id', $userId)->first();
    $documents = DB::table('documents')->where('user_id', $userId)->get();
    $loans = DB::table('loans')->where('user_id', $userId)->get();
    $loanCount = $loans->count();
    $disbursedLoanCount = DB::table('loans')->where('user_id', $userId)->where('status', 'disbursed')->count();
    $wallet = DB::table('wallet')->where('user_id', $userId)->first();
    $walletBalance = $wallet->wallet_balance ?? 0;

    return view('frontend.user-dash', compact(
        'section',
        'user',
        'profile',
        'professionalDetails',
        'educationalDetails',
        'documents',
        'loans',
        'loanCount',
        'disbursedLoanCount',
        'walletBalance',
        'referralCode' // Pass referral code to the view
    ));
}
    public function test(Request $request)
    {
    $userId = session('user_id'); // Retrieve user ID from session

    if (!$userId) {
        return redirect()->route('login')->withErrors('User session expired. Please log in again.');
    }

    // Fetch the profile information
    $user = DB::table('users')->where('id', $userId)->first();
    $profile = DB::table('profile')->where('user_id', $userId)->first();
    $professionalDetails = DB::table('professional_details')->where('user_id', $userId)->first();
    $educationalDetails = DB::table('education_details')->where('user_id', $userId)->first();
    $documents = DB::table('documents')->where('user_id', $userId)->get();
    $loans = DB::table('loans')->where('user_id', $userId)->get();
    return view('frontend.profile.all-loans', compact('section','user', 'profile','professionalDetails','educationalDetails','documents','loans'));
    }
    
    public function updateDocuments(Request $request)
{
    $userId = session('user_id'); // Retrieve user ID from session

    if (!$userId) {
        return redirect()->route('login')->withErrors('User session expired. Please log in again.');
    }

    // Validate the request
    $request->validate([
        'documents.*.document_name' => 'required|string',
        'documents.*.file' => 'required|file|mimes:pdf,doc,docx,jpg,png|max:2048',
    ]);

    // Fetch all document fields from the request
    $documents = $request->input('documents');

    // Loop through each document
    foreach ($documents as $index => $document) {
        // Check if the file is present in the request
        if ($request->hasFile("documents.$index.file")) {
            $file = $request->file("documents.$index.file");
            $filePath = $file->store('documents'); // Store the file and get its path

            // Store or update document information in the database
            DB::table('documents')->updateOrInsert(
                ['user_id' => $userId, 'document_name' => $document['document_name']],
                ['file_path' => $filePath, 'updated_at' => now()]
            );
        }
    }

    return redirect()->route('loan.profile', ['section' => 'document'])->with('success', 'Documents updated successfully.');
}

public function updateProfile(Request $request)
{
    $userId = session('user_id'); // Retrieve user ID from session

    if (!$userId) {
        return redirect()->route('login')->withErrors('User session expired. Please log in again.');
    }

    // Validate the input
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'mobile_no' => 'required|string|max:15',
        'dob' => 'required|date',
        'marital_status' => 'nullable|string',
        'residence_address' => 'nullable|string|max:255',
        'city' => 'nullable|string|max:100',
        'state' => 'nullable|string|max:100',
        'pincode' => 'nullable|string|max:10',
    ]);

    // Update user information
    DB::table('users')->where('id', $userId)->update([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
    ]);

    // Update profile information
    DB::table('profile')->where('user_id', $userId)->update([
        'mobile_no' => $validatedData['mobile_no'],
        'dob' => $validatedData['dob'],
        'marital_status' => $validatedData['marital_status'],
        'residence_address' => $validatedData['residence_address'],
        'city' => $validatedData['city'],
        'state' => $validatedData['state'],
        'pincode' => $validatedData['pincode'],
    ]);

    return redirect()->back()->with('success', 'Profile updated successfully.');
}
//personal info update
public function updateUserProfile(Request $request)
{
    \Log::info('Received Request', $request->all());

    // Validate the request
    $request->validate([
        'name' => 'required|string|max:255',
        'email_id' => 'required|email|max:255',
        'mobile_no' => 'nullable|string|max:15',
        'dob' => 'nullable|date',
        'marital_status' => 'nullable|string|max:20',
        'residence_address' => 'nullable|string|max:255',
        'city' => 'nullable|string|max:100',
        'state' => 'nullable|string|max:100',
        'pincode' => 'nullable|numeric|digits:6'
    ]);

    // Update the user
    $userUpdated = DB::table('users')
        ->where('id', $request->user_id)
        ->update([
            'name' => $request->name,
            'email_id' => $request->email_id,
        ]);

    \Log::info('User update result:', ['user_id' => $request->user_id, 'result' => $userUpdated]);

    // Update the profile
    $profileUpdated = DB::table('profile')
        ->where('profile_id', $request->profile_id)
        ->update([
            'mobile_no' => $request->mobile_no,
            'dob' => $request->dob,
            'marital_status' => $request->marital_status,
            'residence_address' => $request->residence_address,
            'city' => $request->city,
            'state' => $request->state,
            'pincode' => $request->pincode
        ]);

    \Log::info('Profile update result:', ['profile_id' => $request->profile_id, 'result' => $profileUpdated]);

    // Check if update was successful
    if ($userUpdated === 0 && $profileUpdated === 0) {
        \Log::warning('No changes detected during update.', [
            'user_id' => $request->user_id,
            'profile_id' => $request->profile_id
        ]);
        return redirect()->back()->with('warning', 'No changes were made to your profile.');
    }

    return redirect()->back()->with('success', 'Profile updated successfully!');
}
//education detail update
public function updateUserEducational(Request $request)
{
    $request->validate([
        'edu_id' => 'required|integer',
       
    ]);

    // Log the query before execution
    DB::enableQueryLog();

    // Update the professional details
    $updated = DB::table('education_details')
        ->where('edu_id', $request->edu_id)
        ->update([
            'qualification' => $request->qualification,
            'college_name' => $request->college_name,
            'pass_year' => $request->pass_year,
            'college_address' => $request->college_address,
        ]);

    // Log the executed query
    \Log::info(DB::getQueryLog());

    if ($updated === 0) {
        \Log::error('Update failed or no changes made.');
        return redirect()->back()->with('error', 'Failed to update educational information or no changes were made.');
    }

    return redirect()->back()->with('success', 'Educational information updated successfully!');
}
//professional detail update
public function updateUserProfessional(Request $request)
{
    $request->validate([
        'professional_id' => 'required|integer',
       
    ]);

    // Log the query before execution
    DB::enableQueryLog();

    // Update the professional details
    $updated = DB::table('professional_details')
        ->where('professional_id', $request->professional_id)
        ->update([
            'profession_type' => $request->profession_type,
            'company_name' => $request->company_name,
            'experience_year' => $request->experience_year,
            'company_address' => $request->company_address,
            'industry' => $request->industry,
            'designation' => $request->designation,
        ]);

    // Log the executed query
    \Log::info(DB::getQueryLog());

    if ($updated === 0) {
        \Log::error('Update failed or no changes made.');
        return redirect()->back()->with('error', 'Failed to update professional information or no changes were made.');
    }

    return redirect()->back()->with('success', 'Professional information updated successfully!');
}
public function customerLoans()
    {
        $customer_id = session()->get('user_id'); // Get the logged-in customer's ID from the session

        // Fetch loans assigned to the logged-in customer
        $loans = DB::table('loans')
            ->join('loan_category', 'loans.loan_category_id', '=', 'loan_category.loan_category_id')
            ->where('loans.user_id', $customer_id) // Filter by user_id
            ->select(
                'loans.loan_id',
                'loans.amount',
                'loans.tenure',
                'loans.loan_reference_id',
                'loan_category.category_name as loan_category_name',
                'loans.status' // Assuming you have a status field
            )
            ->paginate(10); // Paginate the results

        // Return the view with the loans data
        return view('frontend.profile.all-loans', compact('loans'));
    }

    //activity logs
    function insertActivityLogs($user_id, $details)
    {  
        $p = new Activity;
        $p->user_id = $user_id;
        $p->activity_details = $details;
        $p->save();
    }
    //user dashboard myloans/personal/professional
    public function myloans(Request $request)
    {
    $section = $request->query('section', 'personal');
    $userId = session('user_id'); // Retrieve user ID from session

    if (!$userId) {
        return redirect()->route('login')->withErrors('User session expired. Please log in again.');
    }
    

    // Fetch the profile information
    $user = DB::table('users')->where('id', $userId)->first();
    
    $loans = DB::table('loans')->where('user_id', $userId)->get();
    return view('frontend.profile.all-loans', compact('user', 'loans'));
    }

    public function myLoanList(Request $request)
{
    $userId = session('user_id'); // Retrieve the user ID from the session

    if (!$userId) {
        return redirect()->route('login')->withErrors('User session expired. Please log in again.');
    }

    // Get the loan status filter from the query string, if any
    $statusFilter = $request->query('status', ''); // Default to empty string if no filter is applied

    // Define available loan statuses for the filter dropdown
    $statuses = ['approved', 'rejected', 'disbursed', 'pending']; 

    // Fetch loans for the logged-in customer with optional status filter
    $query = DB::table('loans')->where('user_id', $userId);

    // Apply the status filter if provided and valid
    if ($statusFilter && in_array($statusFilter, $statuses)) {
        $query->where('status', $statusFilter);
    }

    // Optionally, paginate results (for example, 10 loans per page)
    $loans = $query->paginate(10); // Use paginate() for better performance with large datasets

    return view('frontend.profile.myloanlist', compact('loans', 'statuses', 'statusFilter'));
}
public function mydetails(Request $request)
{
    $section = $request->query('section', 'personal'); // Default to 'personal'
    $userId = session('user_id'); // Retrieve user ID from session

    if (!$userId) {
        return redirect()->route('login')->withErrors('User session expired. Please log in again.');
    }

    // Fetch user information
    $user = DB::table('users')->where('id', $userId)->first();

    // Fetch profile, professional, and educational details
    $profile = DB::table('profile')->where('user_id', $userId)->first();
    $professionalDetails = DB::table('professional_details')->where('user_id', $userId)->first();
    $educationalDetails = DB::table('education_details')->where('user_id', $userId)->first();

    // Fetch user documents
    $documents = DB::table('documents')->where('user_id', $userId)->get();

    // Fetch notifications
    $notificationsResponse = $this->getNotifications($userId, 5, 'Profile update');

    if ($notificationsResponse->status() !== 200) {
        Log::error('Failed to fetch notifications', ['response' => $notificationsResponse->getContent()]);
        $notifications = [];
    } else {
        $notifications = $notificationsResponse->getData()->notifications;
    }

    // Return a single Blade view
    return view('frontend.profile.personal-info', compact(
        'user', 'profile', 'professionalDetails', 'educationalDetails', 'documents', 'notifications', 'section'
    ));
} 
public function markAsRead($id)
{
    $notification = Notification::find($id);
    if ($notification) {
        $notification->is_read = 1;
        $notification->save();
    }

    return response()->json(['status' => 'success']);
}
public function getNotifications($userId = null, $limit = 5, $customMessage = null)
{
    // Retrieve user ID from session if not provided
    $userId = $userId ?: session()->get('user_id');

    if (!$userId) {
        return response()->json(['error' => 'User not authenticated'], 401);
    }

    // Start building the query
    $notificationsQuery = Notification::where('receiver_id', $userId)
                                      ->orderBy('created_at', 'desc')
                                      ->take($limit);

    // Add custom message filter if provided
    if ($customMessage) {
        $notificationsQuery->where('message', 'LIKE', "%$customMessage%");
    }

    // Execute the query and get notifications
    $notifications = $notificationsQuery->get();

    // Format notifications for the frontend
    $notificationsData = $notifications->map(function ($notification) {
        return [
            'id' => $notification->id,
            'message' => $notification->message,
            'created_at' => $notification->created_at->diffForHumans(),
            'is_read' => $notification->is_read,
        ];
    });

    return response()->json(['notifications' => $notificationsData]);
}
}
