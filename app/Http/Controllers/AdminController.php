<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
use Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use App\Models\Users;
use App\Models\Activity;
use App\Models\SanctionCalculator;
use DataTables;



class AdminController extends Controller
{
    public function loginView(){
        return view('welcome');
    }

    public function dashboard()
{
    if (!empty(Session::get('role_id'))) {
        $totalLoans = DB::table('loans')->count();
        $inProcessLoans = DB::table('loans')->where('status', 'in process')->count();
        $approvedLoans = DB::table('loans')->where('status', 'approved')->count();
        $disbursedLoans = DB::table('loans')->where('status', 'disbursed')->count();
        $rejectedLoans = DB::table('loans')->where('status', 'rejected')->count();
        $totalUsers = DB::table('users')->count();
		$totalCustomers = DB::table('users')->where('role_id', 1)->count();
		$totalOfficers = DB::table('users')->where('role_id', 2)->count();
		$leads = DB::table('leads')->count();
		$enquiries = DB::table('enquiries')->count();
		$properties = DB::table('properties')->count();
        $recentLoans = $this->fetchRecentLoans();

        // Fetch monthly data for disbursed loans
        $monthlyDisbursedData = DB::table('loans')
            ->select(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"),
                DB::raw("COUNT(*) as total_loans"),
                DB::raw("SUM(amount) as total_amount")
            )
            ->where('status', 'disbursed')
            ->groupBy('month')
            ->orderBy('month', 'ASC')
            ->get();

        $loanStatuses = [
            'In Process' => $inProcessLoans,
            'Approved' => $approvedLoans,
            'Disbursed' => $disbursedLoans,
            'Rejected' => $rejectedLoans,
        ];

        return view('admin.dashboard-dark', compact(
            'totalLoans',
            'approvedLoans',
            'rejectedLoans',
            'loanStatuses',
            'totalUsers',
            'disbursedLoans',
            'recentLoans',
            'monthlyDisbursedData',
			'totalCustomers',
			'totalOfficers',
			'leads',
			'enquiries',
			'properties'
        ));
    } else {
        return redirect('/');
    }
}
public function fetchRecentLoans($limit = 5)
{
    $recentLoans = DB::table('loans')
        ->join('users', 'loans.user_id', '=', 'users.id')
        ->join('loan_category', 'loans.loan_category_id', '=', 'loan_category.loan_category_id')
        ->select(
            'loans.loan_reference_id',
            'loans.amount',
            'users.name as user_name',
            'loan_category.category_name as loan_category_name',
            'loans.status'
        )
        ->whereNotNull('loans.loan_reference_id') // Only fetch loans where loan_reference_id is not null
        ->latest('loans.created_at')
        ->take($limit)
        ->get();

    return $recentLoans;
}
	public function adminDashboard()
    {
        if (!empty(Session::get('role_id'))) {
            return view('admindash.dashboard');
			
        }else{
            return redirect('/');
        }
    }

	public function allUserN()
    {
        if (!empty(Session::get('role_id'))) {
            return view('admindash.allUsers');
			
        }else{
            return redirect('/');
        }
    }

    public function activities()
    {
            $data['allActivies'] = DB::table('activity_logs')
        ->join('users', 'users.id', '=', 'activity_logs.user_id')
        ->select('activity_logs.id','users.name', 'activity_logs.activity_details')
        ->paginate(200);

        return view('admin.activityLogs',compact('data'));
    }
    //MIS
    public function adminMis()
    {
        $data['loans'] = DB::table('loans')
        ->join('users', 'loans.user_id', '=', 'users.id')
        ->join('loan_category', 'loans.loan_category_id', '=', 'loan_category.loan_category_id')
		->leftJoin('loan_bank_details', 'loans.bank_id', '=', 'loan_bank_details.bank_id')
        ->join('profile', 'users.id', '=', 'profile.user_id')
        ->select(
            'loans.loan_id',
            'loans.amount',
            'loans.tenure',
            'loans.loan_reference_id',
            'users.name as user_name',
            'users.email_id as email',
            'profile.mobile_no',
            'profile.city',
			'loan_bank_details.bank_name as bank_name',
            'loan_category.category_name as loan_category_name',
            'loans.agent_action'
        )
        ->paginate(10); // Adjust the pagination limit if necessary

    return view('frontend.admin-mis', compact('data'));
    
    }
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
public function getSanctionCalculator(){
    return view('admin.calculator.emi-calculator');
}
public function getEditSanctionCalculator(Request $request){
      
	$id=$request->id;

	$sanction=SanctionCalculator::find($id);

	  return view('admin.calculator.editsanction')->with('sanction',$sanction);
  }
public function postAddSanctionCalculator(Request $request)
	{	

		// dd($request->all());
	
    $sanction=new SanctionCalculator();
		$sanction->profession_type=$request->profession_type;
		$sanction->name=$request->name;	
		$sanction->dob=$request->dob;	
		$sanction->age=$request->age;	
		$sanction->cm_gross_margin=$request->master_income_margin;
		$sanction->cm_rental_margin=$request->master_rental_margin;
		$sanction->cm_ltv_margin_1=$request->master_ltv_margin;
		$sanction->cm_ltv_margin_2=$request->master_ltv_margin2;	
		$sanction->cm_ltv_margin_3=$request->master_ltv_margin3;


		$sanction->selfb_gi_year1=$request->selfb_gi_year1;
		$sanction->selfb_gi_year2=$request->selfb_gi_year2;
		$sanction->selfb_gi_yearlatest=$request->selfb_gi_yearlatest;
		$sanction->selfb_gi_avg_latest=$request->selfb_gi_avg_latest;
		$sanction->selfb_gi_avg_all=$request->selfb_gi_avg_all;


		$sanction->selfb_sr_year1=$request->selfb_sr_year1;
		$sanction->selfb_sr_year2=$request->selfb_sr_year2;
		$sanction->selfb_sr_yearlatest=$request->selfb_sr_yearlatest;
		$sanction->selfb_sr_avg_latest=$request->selfb_sr__avg_latest;
		$sanction->selfb_sr_avg_all=$request->selfb_sr_avg_all;

		$sanction->selfb_interest_year1=$request->selfb_interest_year1;
		$sanction->selfb_interest_year2=$request->selfb_interest_year2;
		$sanction->selfb_interest_yearlatest=$request->selfb_interest_yearlatest;
		$sanction->selfb_interest_avg_latest=$request->selfb_interest_avg_latest;
		$sanction->selfb_interest_avg_all=$request->selfb_interest_avg_all;

		$sanction->selfco_sr_year1=$request->selfco_sr_year1;
		$sanction->selfco_sr_year2=$request->selfco_sr_year2;
		$sanction->selfco_sr_yearlatest=$request->selfco_sr_yearlatest;
		$sanction->selfco_sr_avg_latest=$request->selfco_sr__avg_latest;
		$sanction->selfco_sr_avg_all=$request->selfco_sr_avg_all;

		$sanction->selfco_interest_year1=$request->selfco_interest_year1;
		$sanction->selfco_interest_year2=$request->selfco_interest_year2;
		$sanction->selfco_interest_yearlatest=$request->selfco_interest_yearlatest;
		$sanction->selfco_interest_avg_latest=$request->selfco_interest_avg_latest;
		$sanction->selfco_interest_avg_all=$request->selfco_interest_avg_all;


		$sanction->selfb_ai_year1=$request->selfb_ai_year1;
		$sanction->selfb_ai_year2=$request->selfb_ai_year2;
		$sanction->selfb_ai_yearlatest=$request->selfb_ai_yearlatest;
		$sanction->selfb_ai_avg_latest=$request->selfb_ai_avg_latest;
		$sanction->selfb_ai_avg_all=$request->selfb_ai_avg_all;
		$sanction->selfb_oi_year1=$request->selfb_oi_year1;
		$sanction->selfb_oi_year2=$request->selfb_oi_year2;
		$sanction->selfb_oi_yearlatest=$request->selfb_oi_yearlatest;
		$sanction->selfb_oi_avg_latest=$request->selfb_oi_avg_latest;
		$sanction->selfb_oi_avg_all=$request->selfb_oi_avg_all;
		$sanction->selfb_d_year1=$request->selfb_d_year1;
		$sanction->selfb_d_year2=$request->selfb_d_year2;
		$sanction->selfb_d_yearlatest=$request->selfb_d_yearlatest;
		$sanction->selfb_d_avg_latest=$request->selfb_d_avg_latest;
		$sanction->selfb_d_avg_all=$request->selfb_d_avg_all;
		$sanction->selfb_tgi_year1=$request->selfb_tgi_year1;
		$sanction->selfb_tgi_year2=$request->selfb_tgi_year2;
		$sanction->selfb_tgi_yearlatest=$request->selfb_tgi_yearlatest;
		$sanction->selfb_tgi_avg_latest=$request->selfb_tgi_avg_latest;
		$sanction->selfb_tgi_avg_all=$request->selfb_tgi_avg_all;
		$sanction->selfb_tax_year1=$request->selfb_tax_year1;
		$sanction->selfb_tax_year2=$request->selfb_tax_year2;
		$sanction->selfb_tax_yearlatest=$request->selfb_tax_yearlatest;	
		$sanction->selfb_tax_avg_latest=$request->selfb_tax_avg_latest;	
		$sanction->selfb_tax_avg_all=$request->selfb_tax_avg_all;		
		$sanction->selfb_od_year1=$request->selfb_od_year1;	
		$sanction->selfb_od_year2=$request->selfb_od_year2;	
		$sanction->selfb_od_yearlatest=$request->selfb_od_yearlatest;
		$sanction->selfb_od_avg_latest=$request->selfb_od_avg_latest;	
		$sanction->selfb_od_avg_all=$request->selfb_od_avg_all;	
		$sanction->selfb_td_year1=$request->selfb_td_year1;	
		$sanction->selfb_td_year2=$request->selfb_td_year2;	
		$sanction->selfb_td_yearlatest=$request->selfb_td_yearlatest;
		$sanction->selfb_td_avg_latest=$request->selfb_td_avg_latest;	
		$sanction->selfb_td_avg_all=$request->selfb_td_avg_all;	
		$sanction->selfco_gi_year1=$request->selfco_gi_year1;	
		$sanction->selfco_gi_year2=$request->selfco_gi_year2;	
		$sanction->selfco_gi_yearlatest=$request->selfco_gi_yearlatest;	
		$sanction->selfco_gi_avg_latest=$request->selfco_gi_avg_latest;	
		$sanction->selfco_gi_avg_all=$request->selfco_gi_avg_all;	
		$sanction->selfco_ai_year1=$request->selfco_ai_year1;	
		$sanction->selfco_ai_year2=$request->selfco_ai_year2;	
		$sanction->selfco_ai_yearlatest=$request->selfco_ai_yearlatest;	
		$sanction->selfco_ai_avg_latest=$request->selfco_ai_avg_latest;
		$sanction->selfco_ai_avg_all=$request->selfco_ai_avg_all;	
		$sanction->selfco_oi_year1=$request->selfco_oi_year1;	
		$sanction->selfco_oi_year2=$request->selfco_oi_year2;	
		$sanction->selfco_oi_yearlatest=$request->selfco_oi_yearlatest;	
		$sanction->selfco_oi_avg_latest=$request->selfco_oi_avg_latest;	
		$sanction->selfco_oi_avg_all=$request->selfco_oi_avg_all;	
		$sanction->selfco_d_year1=$request->selfco_d_year1;	
		$sanction->selfco_d_year2=$request->selfco_d_year2;	
		$sanction->selfco_d_yearlatest=$request->selfco_d_yearlatest;	
		$sanction->selfco_d_avg_latest=$request->selfco_d_avg_latest;	
		$sanction->selfco_d_avg_all=$request->selfco_d_avg_all;	
		$sanction->selfco_tgi_year1=$request->selfco_tgi_year1;	
		$sanction->selfco_tgi_year2=$request->selfco_tgi_year2;	
		$sanction->selfco_tgi_yearlatest=$request->selfco_tgi_yearlatest;	
		$sanction->selfco_tgi_avg_latest=$request->selfco_tgi_avg_latest;	
		$sanction->selfco_tgi_year_all=$request->selfco_tgi_year_all;	
		$sanction->selfco_tax_year1=$request->selfco_tax_year1;	
		$sanction->selfco_tax_year2=$request->selfco_tax_year2;
		$sanction->selfco_tax_yearlatest=$request->selfco_tax_yearlatest;
		$sanction->selfco_tax_avg_latest=$request->selfco_tax_avg_latest;
		$sanction->selfco_tax_avg_all=$request->selfco_tax_avg_all;
		$sanction->selfco_od_year1=$request->selfco_od_year1;
		$sanction->selfco_od_year2=$request->selfco_od_year2;
		$sanction->selfco_od_yearlatest=$request->selfco_od_yearlatest;
		$sanction->selfco_od_avg_latest=$request->selfco_od_avg_latest;
		$sanction->selfco_od_avg_all=$request->selfco_od_avg_all;
		$sanction->selfco_td_year1=$request->selfco_td_year1;
		$sanction->selfco_td_year2=$request->selfco_td_year2;
		$sanction->selfco_td_yearlatest=$request->selfco_td_yearlatest;
		$sanction->selfco_td_avg_latest=$request->selfco_td_avg_latest;
		$sanction->selfco_td_avg_all=$request->selfco_td_avg_all;
		$sanction->salb_gi_month1=$request->salb_gi_month1;
		$sanction->salb_gi_month2=$request->salb_gi_month2;
		$sanction->salb_gi_month3=$request->salb_gi_month3;
		$sanction->salb_gi_month4=$request->salb_gi_month4;
		$sanction->salb_gi_month5=$request->salb_gi_month5;
		$sanction->salb_gi_monthlatest=$request->salb_gi_monthlatest;
		$sanction->salb_gi_avg=$request->salb_gi_avg;
		$sanction->salb_tax_month1=$request->salb_tax_month1;
		$sanction->salb_tax_month2=$request->salb_tax_month2;
		$sanction->salb_tax_month3=$request->salb_tax_month3;
		$sanction->salb_tax_month4=$request->salb_tax_month4;
		$sanction->salb_tax_month5=$request->salb_tax_month5;
		$sanction->salb_tax_monthlatest=$request->salb_tax_monthlatest;
		$sanction->salb_tax_avg=$request->salb_tax_avg;
		$sanction->salb_od_month1=$request->salb_od_month1;
		$sanction->salb_od_month2=$request->salb_od_month2;
		$sanction->salb_od_month3=$request->salb_od_month3;	
		$sanction->salb_od_month4=$request->salb_od_month4;
		$sanction->salb_od_month5=$request->salb_od_month5;	
		$sanction->salb_od_monthlatest=$request->salb_od_monthlatest;	
		$sanction->salb_od_avg=$request->salb_od_avg;
		$sanction->salb_nmi_month1=$request->salb_nmi_month1;
		$sanction->salb_nmi_month2=$request->salb_nmi_month2;
		$sanction->salb_nmi_month3=$request->salb_nmi_month3;
		$sanction->salb_nmi_month4=$request->salb_nmi_month4;
		$sanction->salb_nmi_month5=$request->salb_nmi_month5;
		$sanction->salb_nmi_monthlatest=$request->salb_nmi_monthlatest;
		$sanction->salb_nmi_avg=$request->salb_nmi_avg;
		$sanction->salco_gi_month1=$request->salco_gi_month1;
		$sanction->salco_gi_month2=$request->salco_gi_month2;
		$sanction->salco_gi_month3=$request->salco_gi_month3;
		$sanction->salco_gi_month4=$request->salco_gi_month4;
		$sanction->salco_gi_month5=$request->salco_gi_month5;
		$sanction->salco_gi_monthlatest=$request->salco_gi_monthlatest;
		$sanction->salco_gi_avg=$request->salco_gi_avg;
		$sanction->salco_tax_month1=$request->salco_tax_month1;
		$sanction->salco_tax_month2=$request->salco_tax_month2;
		$sanction->salco_tax_month3=$request->salco_tax_month3;
		$sanction->salco_tax_month4=$request->salco_tax_month4;
		$sanction->salco_tax_month5=$request->salco_tax_month5;
		$sanction->salco_tax_monthlatest=$request->salco_tax_monthlatest;	
		$sanction->salco_tax_avg=$request->salco_tax_avg;	
		$sanction->salco_od_month1=$request->salco_od_month1;
		$sanction->salco_od_month2=$request->salco_od_month2;
		$sanction->salco_od_month3=$request->salco_od_month3;
		$sanction->salco_od_month4=$request->salco_od_month4;
		$sanction->salco_od_month5=$request->salco_od_month5;
		$sanction->salco_od_monthlatest=$request->salco_od_monthlatest;
		$sanction->salco_od_avg=$request->salco_od_avg;
		$sanction->salco_nmi_month1=$request->salco_nmi_month1;
		$sanction->salco_nmi_month2=$request->salco_nmi_month2;
		$sanction->salco_nmi_month3=$request->salco_nmi_month3;
		$sanction->salco_nmi_month4=$request->salco_nmi_month4;	
		$sanction->salco_nmi_month5=$request->salco_nmi_month5;
		$sanction->salco_nmi_monthlatest=$request->salco_nmi_monthlatest;
		$sanction->salco_nmi_avg=$request->salco_nmi_avg;
		$sanction->rent=$request->rent;
		$sanction->eligible_rental_income=$request->eligible_rental_income;	
		$sanction->other_monthly=$request->other_monthly;
		$sanction->eligible_other_income=$request->eligible_other_income;
		$sanction->disposal_gi_latest_itr=$request->disposal_gi_latest_itr;
		$sanction->disposal_gi_avg_itr=$request->disposal_gi_avg_itr;
		$sanction->disposal_d_latest_itr=$request->disposal_d_latest_itr;
		$sanction->disposal_d_avg_itr=$request->disposal_d_avg_itr;
		$sanction->disposal_niat_latest_itr=$request->disposal_niat_latest_itr;
		$sanction->disposal_niat_avg_itr=$request->disposal_niat_avg_itr;
		$sanction->disposal_otheremi_latest_itr=$request->disposal_otheremi_latest_itr;
		$sanction->disposal_otheremi_avg_itr=$request->disposal_otheremi_avg_itr;
		$sanction->disposal_niad_latest_itr=$request->disposal_niad_latest_itr;
		$sanction->disposal_niad_avg_itr=$request->disposal_niad_avg_itr;
		$sanction->disposal_grossi_latest_itr=$request->disposal_grossi_latest_itr;	
		$sanction->disposal_grossi_avg_itr=$request->disposal_grossi_avg_itr;	
		$sanction->disposable_income_latest_itr=$request->disposable_income_latest_itr;	
		$sanction->disposable_income_avg_itr=$request->disposable_income_avg_itr;	
		$sanction->reverse_loan_amt=$request->reverse_loan_amt;
		$sanction->reverse_interest=$request->reverse_interest;	
		$sanction->reverse_time_period=$request->reverse_time_period;	
		$sanction->reverse_emi=$request->reverse_emi;	
		$sanction->quantam_applicant=$request->quantam_applicant;	
		$sanction->quantam_coapplicant1=$request->quantam_coapplicant1;	
		$sanction->quantam_coapplicant2=$request->quantam_coapplicant2;
		$sanction->quantam_coapplicant3=$request->quantam_coapplicant3;	
		$sanction->max_quantam_homeloan=$request->max_quantam_homeloan;
		$sanction->max_age_months=$request->max_age_months;	
		$sanction->remaining_age=$request->remaining_age;	
		$sanction->max_eligible_term=$request->max_eligible_term;	
		$sanction->max_eligible_term_relex=$request->max_eligible_term_relex;	
		$sanction->repayment_capacity_interest_rate=$request->repayment_capacity_interest_rate;
		$sanction->no_of_months=$request->no_of_months;	
		$sanction->emi_per_lakhs=$request->emi_per_lakhs;	
		$sanction->eligible_avg_income=$request->eligible_avg_income;	
		$sanction->eligible_latest_income=$request->eligible_latest_income;	
		$sanction->ltv_mkt_property_val=$request->ltv_mkt_property_val;
		$sanction->cost_of_project=$request->cost_of_project;	
		$sanction->ltv_loan_amount=$request->ltv_loan_amount;	
		$sanction->ltv_value_consider=$request->ltv_value_consider;	
		$sanction->ltv_takeover=$request->ltv_takeover;	
		$sanction->eligible_ltv=$request->eligible_ltv;	
		$sanction->eligible_ltv_takeover=$request->eligible_ltv_takeover;	
		$sanction->eligible_max_home_loan_amt_avg=$request->eligible_max_home_loan_amt_avg;	
		$sanction->eligible_max_home_loan_amt_latest=$request->eligible_max_home_loan_amt_latest;	
		$sanction->calc_loan_amt=$request->calc_loan_amt;	
		$sanction->calc_interest_rate=$request->calc_interest_rate;	
		$sanction->calc_time_period=$request->calc_time_period;
		$sanction->calc_emi=$request->calc_emi;
		$sanction->save();
		
		
			$notification = array(
				'message' => 'Saved Successfully', 
				'alert-type' => 'success'
			);

		return redirect()->back()->with($notification);

	}
	public function getSanctionCalculatorHistory($value='')
	{
		return view('admin.calculator.history');
	}
	public function getAllSanctionCalculatorHistory($value='')
	{
		$sanction=SanctionCalculator::get();
        return DataTables::of($sanction)->make(true);
	}

	//exoprt excel
	
}
