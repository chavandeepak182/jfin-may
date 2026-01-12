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
use App\Models\Property;
use App\Models\Range;
use App\Models\Bank;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use App\Models\LoanBank;
use App\Models\EstimatedFile;
use App\Models\MonthlyPL;



class BankController extends Controller
{
    public function addProperty()
    {
        $data['range'] = DB::table('price_range')->get();
        $data['category'] = DB::table('property_category')->get();
        return view('property.addProperty',compact('data'));
    }


    // count dashboard
public function loanbankslist(Request $request)
{
    // ================= COUNTS =================
    $totalloanbank        = DB::table('loan_bank_details')->count();
    $totalmis             = DB::table('mis')->count();
    $totalEstimatedFiles  = DB::table('estimated_files')->count();
    $totalMonthlyPL       = DB::table('monthly_pls')->count();

    // ================= LOAN BANK LIST =================
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

    $estimatedFiles = $query->orderBy('id', 'desc')->get();

    // ================= MONTHLY P&L =================
    $pls = MonthlyPL::orderBy('year', 'desc')
                    ->orderBy('month', 'desc')
                    ->get();

    return view('admin.admin-tool', compact(
        'totalloanbank',
        'totalmis',
        'totalEstimatedFiles',
        'totalMonthlyPL',
        'loanbanks',
        'estimatedFiles',
        'grossRevenue',
        'pls'
    ));
}

    public function listreferral()
{
    return view('admin.admin-referral');
}
public function eligiblelist()
{
    $totaleligible = DB::table('eligiblity_criteria')->count();
    return view('admin.admin-eligible' ,compact('totaleligible'));
}


    public function insertBank(Request $request)
    {  
        DB::beginTransaction();

        try{
                
                $p = new Bank;
                $p->ifsc_code = $request->ifsc_code;
                $p->bank_name = $request->bank_name;
                $p->branch_name = $request->branch_name;
                $p->manager_name = $request->manager_name;  
                $p->bank_address = $request->bank_address;
                $p->manager_number = $request->manager_number;

                $p->save();

                //activity logs
                $username = Session::get('username');
                $user_id = Session::get('user_id');
                $details = "Bank added successfully by ".$username; 
                app(UsersController::class)->insertActivityLogs($user_id, $details);
                //end of activity logs   

                if($p ){
                    DB::commit();
                    return response()->json(['status'=>1,'msg'=>'Bank added successfully']);
                }
            

        }catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status'=> 0,'msg'=>$e->getMessage()]);
           // dd($e->getMessage());
        } 
    }

    public function allBanks()
    {
        $data['allBanks'] = DB::table('company_bank_details')->paginate(10);

        return view('bank.allBanks',compact('data'));
    }

    public function pendingProperties()
    {
            $data['allProperties'] = DB::table('properties')
        ->join('price_range', 'properties.price_range_id', '=', 'price_range.range_id')
        ->join('property_category', 'properties.property_type_id', '=', 'property_category.pid')
        ->where('properties.is_active',0)
        ->select('properties.properties_id', 'properties.title', 'properties.property_type_id', 'properties.builder_name','properties.select_bhk', 
        'properties.address','properties.facilities',  'properties.contact', 'price_range.from_price', 'price_range.to_price', 'property_category.category_name')
        ->paginate(10);

        return view('property.pendingProperties',compact('data'));
    }

    public function viewDetails($property_id){    
        $data['propertie_details'] = DB::select('select * from properties as p, price_range as pr, property_category as pc where 
        p.price_range_id = pr.range_id and pc.pid = p.property_type_id and p.properties_id =' . $property_id);

        return view('property.propertyDetails',compact('data'));

    }

    public function activate(Request $request){
        $updatePropertie = array(
            'is_active'=> 1
        );

        try{        
            $property_id = $request->propertie_id;    
            $update_propertie = DB::table('properties')->where('properties_id',$property_id)->update($updatePropertie);

            //activity logs
            $username = Session::get('username');
            $user_id = Session::get('user_id');
            $details = "Bank Activated successfully by ".$username; 
            app(UsersController::class)->insertActivityLogs($user_id, $details);
            //end of activity logs   
           
            if($update_propertie){
                return response()->json(['status'=>1,'msg'=>'Propertie is successfully activated !']);
            }
        }catch (\Exception $e) {
            DB::rollback();            
            dd($e->getMessage());
        }
    }

    public function editBank($bank_id){    
        $data['bank'] = DB::table('company_bank_details')->where('bank_id', $bank_id)->get();
        return view('bank.editBank',compact('data'));

    }

    public function updateBank(Request $request){
        $bank_id = $request->bank_id;
  
        $updateBank = array(
            'ifsc_code'=> $request->ifsc_code,
            'bank_name'=> $request->bank_name,
            'branch_name'=> $request->branch_name,
            'manager_name'=> $request->manager_name,
            'bank_address'=> $request->bank_address,
            'manager_number'=> $request->manager_number,
        );

        try{     

            //activity logs
            $username = Session::get('username');
            $user_id = Session::get('user_id');
            $details = "Bank information successfully by ".$username; 
            app(UsersController::class)->insertActivityLogs($user_id, $details);
            //end of activity logs   

            $update_bank = DB::table('company_bank_details')->where('bank_id',$bank_id)->update($updateBank);
            return response()->json(['status'=>1,'msg'=>'Bank information updated successfully !']);

        }catch (\Exception $e) {           
            return $e->getMessage();
        }
    }


    public function deleteBank(Request $request){
        try{        
            $bank_id = $request->bank_id;    
            $bank = DB::table('company_bank_details')->where('bank_id', $bank_id)->delete();

            //activity logs
            $username = Session::get('username');
            $user_id = Session::get('user_id');
            $details = "Bank information delete successfully by ".$username; 
            app(UsersController::class)->insertActivityLogs($user_id, $details);
            //end of activity logs   

            if($bank){
                return response()->json(['status'=>1,'msg'=>'Bank deleted successfully !']);
            }
        }catch (\Exception $e) {
            DB::rollback();            
            dd($e->getMessage());
        }
    }

    //Loan banks
    public function loanbanks()
    {
        $data['loanbanks'] = DB::table('loan_bank_details')->paginate(10);

        return view('loanbank.loanbanks',compact('data'));
    }
    public function insertLoanBank(Request $request)
{  
    DB::beginTransaction();

    try {
        // Directly insert data into loan_bank_details table
        DB::table('loan_bank_details')->insert([
            'ifsc_code'      => $request->ifsc_code,
            'bank_name'      => $request->bank_name,
            'branch_name'    => $request->branch_name,
            'manager_name'   => $request->manager_name,  
            'bank_address'   => $request->bank_address,
            'manager_number' => $request->manager_number,
            'created_at'     => now(), // Set created_at timestamp
            'updated_at'     => now()  // Set updated_at timestamp
        ]);

        DB::commit();
        return response()->json(['status' => 1, 'msg' => 'Bank added successfully']);
        
    } catch (\Exception $e) {
        DB::rollback();
        return response()->json(['status' => 0, 'msg' => $e->getMessage()]);
    } 
}
public function editLoanBank($bank_id)
{
    $data['bank'] = DB::table('loan_bank_details')->where('bank_id', $bank_id)->first(); // Fetch single bank
    return view('loanbank.editLoanBank', compact('data'));
}
public function updateLoanBank(Request $request)
{
    $bank_id = $request->bank_id;

    $updateBank = [
        'ifsc_code'      => $request->ifsc_code,
        'bank_name'      => $request->bank_name,
        'branch_name'    => $request->branch_name,
        'manager_name'   => $request->manager_name,
        'bank_address'   => $request->bank_address,
        'manager_number' => $request->manager_number,
        'updated_at'     => now(), // Update the timestamp
    ];

    try {
        // Directly update data in loan_bank_details table
        DB::table('loan_bank_details')->where('bank_id', $bank_id)->update($updateBank);

        return response()->json(['status' => 1, 'msg' => 'Bank information updated successfully!']);

    } catch (\Exception $e) {
        return response()->json(['status' => 0, 'msg' => $e->getMessage()]);
    }
}
public function deleteLoanBank(Request $request)
{
    try {
        $bank_id = $request->bank_id;    
        DB::table('loan_bank_details')->where('bank_id', $bank_id)->delete();

        // Activity logs
        $username = Session::get('username');
        $user_id = Session::get('user_id');
        $details = "Bank information deleted successfully by " . $username;
        app(UsersController::class)->insertActivityLogs($user_id, $details);

        return response()->json(['status' => 1, 'msg' => 'Bank deleted successfully!']);

    } catch (\Exception $e) {
        return response()->json(['status' => 0, 'msg' => $e->getMessage()]);
    }
}
}
