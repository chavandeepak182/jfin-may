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
use App\Models\Activity;
use App\Models\UserRelation;
use App\Models\MlmUsers;
use App\Models\Category;
use App\Models\Commission;
use App\Http\Controllers\UsersController;



class CommissionController extends Controller
{

    public function allCommission(){
        
        $data['allCommissions'] = DB::table('commission')->paginate(10);

        return view('commission.allCommissions',compact('data'));
     
    }    

    public function editCommission($com_id){    
       $data['commission'] = DB::table('commission')
    ->where('com_id', $com_id)
    ->first();
        return view('commission.editCommission',compact('data'));

    }

  public function updateCommission(Request $request)
{
    try {
        // ✅ Get ID properly (trim avoids space issue)
        $com_id = trim($request->com_id);

        // ✅ Update data
        DB::table('commission')
            ->where('com_id', $com_id)
            ->update([
                'commission_amount' => $request->commission_amount
            ]);

        // ✅ Safe activity log (won’t break code)
        try {
            if (class_exists(\App\Http\Controllers\UsersController::class)) {
                $username = Session::get('username');
                $user_id = Session::get('user_id');
                $details = "Commission amount updated successfully by " . $username;

                app(\App\Http\Controllers\UsersController::class)
                    ->insertActivityLogs($user_id, $details);
            }
        } catch (\Exception $logError) {
            // ignore log error (important)
        }

        // ✅ Always return JSON
        return response()->json([
            'status' => 1,
            'msg' => 'Commission amount updated successfully!'
        ]);

    } catch (\Exception $e) {
    return response()->json([
        'status' => 0,
        'msg' => $e->getMessage()
    ]);
}
}
    public function deleteCommission(Request $request){
        try{        
            $com_id = $request->com_id;    
            $bank = DB::table('commission')->where('com_id', $com_id)->delete();

            //activity logs
            $username = Session::get('username');
            $user_id = Session::get('user_id');
            $details = "Commission information delete successfully by ".$username; 
            app(UsersController::class)->insertActivityLogs($user_id, $details);
            //end of activity logs   

            if($bank){
                return response()->json(['status'=>1,'msg'=>'Commission information deleted successfully !']);
            }
        }catch (\Exception $e) {
            DB::rollback();            
            dd($e->getMessage());
        }
    }

    
 
}