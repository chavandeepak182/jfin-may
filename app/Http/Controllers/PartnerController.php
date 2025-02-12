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
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;



class PartnerController extends Controller
{
    public function addAgent()
    {
        return view('agent.addAgent');
    }

    public function allPartners()
{
    $data['allPartners'] = DB::table('users')
        ->join('profile', 'users.id', '=', 'profile.user_id')
        ->where('users.role_id', 3)
        ->whereNull('users.deleted_at') // Exclude soft-deleted users
        ->select('users.id', 'users.name', 'users.email_id', 'profile.mobile_no', 'profile.dob')
        ->paginate(10);

    return view('partner.allPartners', compact('data'));
}


    public function insertPartner(Request $request)
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
                $user->role_id = 3;  //role_id = 3 for the partner standard user
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

                //activity logs
                $username = Session::get('username');
                $user_id = Session::get('user_id');
                $details = "Partner user account is created successfully by ".$username; 
                app(UsersController::class)->insertActivityLogs($user_id, $details);
                //end of activity logs   

                if($user && $profile ){
                    DB::commit();

                     //calling UsersController temail function from FrontendController
                    app(UsersController::class)->temail($request->email_id, $request->full_name, $msg, $temp_id);
                   
                    return response()->json(['status'=>1,'msg'=>'Channel partner added successfully']);
                }
            }

        }catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status'=> 0,'msg'=>$e->getMessage()]);
           // dd($e->getMessage());
        } 
    }

    public function editPartner($id){    
        $id = '"'.$id.'"';
        $data['user'] = DB::select('SELECT u.id,u.name, u.email_id, u.password, p.mobile_no, p.dob, p.residence_address,p.city, p.state, 
        p.pincode FROM users as u, profile p WHERE u.id = p.user_id and u.role_id = 3 and u.id = '.$id);
        return view('partner.editPartner',compact('data'));

    }

    public function updatePartner(Request $request){
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

        //activity logs
        $username = Session::get('username');
        $user_id = Session::get('user_id');
        $details = "Partner user information updated successfully by ".$username; 
        app(UsersController::class)->insertActivityLogs($user_id, $details);
        //end of activity logs   

        try{     
            $update_user = DB::table('users')->where('id',$user_id)->update($updateUser);
            $update_profile = DB::table('profile')->where('user_id',$user_id)->update($updateProfile);
            return response()->json(['status'=>1,'msg'=>'Channel partner information updated successfully !']);

        }catch (\Exception $e) {           
            return $e->getMessage();
        }
    }

    public function deletePartner(Request $request)
{
    try {
        DB::beginTransaction();

        $user_id = $request->user_id;

        $user = User::find($user_id);
        if (!$user) {
            return response()->json(['status' => 0, 'error' => 'Partner not found']);
        }

        // Soft delete user and profile
        $user->delete();
        Profile::where('user_id', $user_id)->update(['deleted_at' => now()]);

        // Log the action
        $username = Session::get('username');
        $admin_id = Session::get('user_id');
        $details = "Partner user soft-deleted by " . $username;
        app(UsersController::class)->insertActivityLogs($admin_id, $details);

        DB::commit();

        return response()->json(['status' => 1, 'msg' => 'Channel Partner deleted successfully!']);
    } catch (\Exception $e) {
        DB::rollback();
        return response()->json(['status' => 0, 'error' => 'Error deleting partner: ' . $e->getMessage()]);
    }
}

    public function partnerDashboard()
    {
        if (!empty(Session::get('role_id'))) {
            return view('partner.partnerDashboard');
        }else{
            return redirect('/');
        }
    }

       
}
