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
use App\Models\Loan;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use App\Models\User;
use App\Models\Profile;
use App\Models\Foir;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use App\Models\Notification;
use App\Models\EligibilityCriteria;



class EligibilityCriteriaController extends Controller
{
    public function calculateEligibility(Request $request)
{
    $hasCoapplicant = $request->has('co_applicant_checkbox');

    $request->validate([
        'salary' => 'required|numeric',
        'rent_income_name' => 'array',
        'rent_income_amount' => 'array',
        'firm_share_profit_json' => 'array',
        'firm_share_profit_amount' => 'array',
        'agriculture_income_json' => 'array',
        'agriculture_income_amount' => 'array',
        'remunration_income_json' => 'array',
        'remunration_income_amount' =>'array',
        'coapplicant_remunration_income_json' =>'array',
        'coapplicant_remunration_income_amount' =>'array',
        'co_firm_share_profit_json' => 'array',
        'co_firm_share_profit_amount' => 'array',
        'co_agriculture_income_json' => 'array',
        'co_agriculture_income_amount' => 'array',
        'tax_amount' => 'required|numeric',
        'coapplicant_tax_amount' => 'nullable|numeric',
        'deduction_name' => 'array',
        'deduction_amount' => 'array',
        'coapplicant_deduction_json' => 'array', // Added for co-applicant deductions
        'coapplicant_deduction_amount' => 'array',
        'coapplicant_salary' => 'nullable|numeric',
        'bank_id' => 'required|exists:foir,id', // This should check against the foir table
        
    ]);

        // Monthly salary
        $salary = $request->input('salary') / 12; // Convert annual salary to monthly
        $coapplicantSalary = $request->input('coapplicant_salary', 0);
        //remunaration income
        $remunerationIncomeNames = $request->input('remunration_income_json', []); 
        $remunerationIncomeAmounts = $request->input('remunration_income_amount', []);

        $remunerationIncomeDetails = [];
        foreach ($remunerationIncomeNames as $key => $source) {
            $amount = $remunerationIncomeAmounts[$key] ?? 0;
            if ($source && $amount > 0) {
                $remunerationIncomeDetails[] = [
                    'source' => $source,
                    'amount' => (float) $amount  // Convert to monthly remuneration income
                ];
            }
        }
        $totalRemunerationIncome = array_sum(array_column($remunerationIncomeDetails, 'amount'));
        // Co-applicant's Remuneration Income
        $coapplicantRemunerationIncomeNames = $request->input('coapplicant_remunration_income_json', []); 
        $coapplicantRemunerationIncomeAmounts = $request->input('coapplicant_remunration_income_amount', []);

        $coapplicantRemunerationIncomeDetails = [];
        foreach ($coapplicantRemunerationIncomeNames as $key => $source) {
            $amount = $coapplicantRemunerationIncomeAmounts[$key] ?? 0;
            if ($source && $amount > 0) {
                $coapplicantRemunerationIncomeDetails[] = [
                    'source' => $source,
                    'amount' => (float) $amount  // Convert to monthly coapplicant remuneration income
                ];
            }
        }

        // Calculate total remuneration income for coapplicant
        $totalCoapplicantRemunerationIncome = array_sum(array_column($coapplicantRemunerationIncomeDetails, 'amount'));   
        // Capture rent income details and calculate monthly rent income
        $rentIncomeNames = $request->input('rent_income_name', []);
        $rentIncomeAmounts = $request->input('rent_income_amount', []);

        $rentalIncomeDetails = [];
        foreach ($rentIncomeNames as $key => $source) {
            $amount = $rentIncomeAmounts[$key] ?? 0;
            if ($source && $amount > 0) {
                $rentalIncomeDetails[] = [
                    'source' => $source,
                    'amount' => (float) $amount  // Convert to monthly rent income
                ];
            }
        }
        $totalRentIncome = array_sum(array_column($rentalIncomeDetails, 'amount'));
        // Co-Applicant's Rental Income
        $coapplicantRentalIncomeNames = $request->input('coapplicant_rent_income_name', []); 
        $coapplicantRentalIncomeAmounts = $request->input('coapplicant_rent_income_amount', []);

        $coapplicantRentalIncomeDetails = [];
        foreach ($coapplicantRentalIncomeNames as $key => $source) {
            $amount = $coapplicantRentalIncomeAmounts[$key] ?? 0;
            if ($source && $amount > 0) {
                $coapplicantRentalIncomeDetails[] = [
                    'source' => $source,
                    'amount' => (float) $amount  // Convert to yearly rental income
                ];
            }
        }

        // Calculate total rental income for coapplicant
        $totalCoapplicantRentalIncome = array_sum(array_column($coapplicantRentalIncomeDetails, 'amount'));
         // Co-Applicant's profit share Income
         $coapplicantProfitIncomeNames = $request->input('co_firm_share_profit_json', []); 
         $coapplicantProfitIncomeAmounts = $request->input('co_firm_share_profit_amount', []);
 
         $coapplicantProfitIncomeDetails = [];
         foreach ($coapplicantProfitIncomeNames as $key => $source) {
             $amount = $coapplicantProfitIncomeAmounts[$key] ?? 0;
             if ($source && $amount > 0) {
                 $coapplicantProfitIncomeDetails[] = [
                     'source' => $source,
                     'amount' => (float) $amount  // Convert to yearly rental income
                 ];
             }
         }
 
         // Calculate total rental income for coapplicant
         $totalCoapplicantProfitIncome = array_sum(array_column($coapplicantProfitIncomeDetails, 'amount'));

        // Capture Profit Share income and calculate monthly profit share income
        $profitShareIncomeNames = $request->input('firm_share_profit_json', []);
        $profitShareIncomeAmounts = $request->input('firm_share_profit_amount', []);

        $profitShareIncomeDetails = [];
        foreach ($profitShareIncomeNames as $key => $source) {
            $amount = $profitShareIncomeAmounts[$key] ?? 0;
            if ($source && $amount > 0) {
                $profitShareIncomeDetails[] = [
                    'source' => $source,
                    'amount' => (float) $amount  // Convert to monthly profit share income
                ];
            }
        }
        $totalProfitShareIncome = array_sum(array_column($profitShareIncomeDetails, 'amount'));

  

        // Agriculture income is handled as 'other_income'
        $agricultureIncomeNames = $request->input('agriculture_income_json', []);
        $agricultureIncomeAmounts = $request->input('agriculture_income_amount', []);

        $agricultureIncomeDetails = [];
        foreach ($agricultureIncomeNames as $key => $source) {
            $amount = $agricultureIncomeAmounts[$key] ?? 0;
            if ($source && $amount > 0) {
                $agricultureIncomeDetails[] = [
                    'source' => $source,
                    'amount' => (float) $amount // Store amount as a float
                ];
            }
        }

        // Calculating total agriculture income (sum of all other income)
        $totalAgricultureIncome = array_sum(array_column($agricultureIncomeDetails, 'amount'));    // Total monthly income

         // co-applicant Agriculture income is handled as 'other_income'
         $coapplicantagricultureIncomeNames = $request->input('co_agriculture_income_json', []);
         $coapplicantagricultureIncomeAmounts = $request->input('co_agriculture_income_amount', []);
         
         $coapplicantagricultureIncomeDetails = [];
         foreach ($coapplicantagricultureIncomeNames as $key => $source) {
             $amount = $coapplicantagricultureIncomeAmounts[$key] ?? 0;
             if ($source && $amount > 0) {
                 $coapplicantagricultureIncomeDetails[] = [
                     'source' => $source,
                     'amount' => (float) $amount // Store amount as a float
                 ];
             }
         }
         
         // Calculating total agriculture income (sum of all other income)
         $totalcoapplicantAgricultureIncome = array_sum(array_column($coapplicantagricultureIncomeDetails, 'amount'));

        $totalIncome = $salary + ($totalRentIncome / 12) + ($totalAgricultureIncome / 12) + ($totalProfitShareIncome / 12) + ($totalRemunerationIncome / 12) + ($coapplicantSalary / 12) + ($totalCoapplicantRemunerationIncome / 12) + ($totalCoapplicantRentalIncome / 12) + ($totalCoapplicantProfitIncome / 12) + ($totalcoapplicantAgricultureIncome / 12);

    
        // Capture Deduction details and calculate the total deductions
        $deductionNames = $request->input('deduction_json', []); // Fetching the deduction names
        $deductionAmounts = $request->input('deduction_amount', []); // Fetching the deduction amounts

        $deductionDetails = [];
        foreach ($deductionNames as $key => $source) {
            $amount = $deductionAmounts[$key] ?? 0;
            if ($source && $amount > 0) {
                $deductionDetails[] = [
                    'source' => $source,
                    'amount' => (float) $amount // Store amount as a float
                ];
            }
        }

        // Calculating total deductions (sum of all deduction amounts)
        $totalDeductions = array_sum(array_column($deductionDetails, 'amount'));
        // Capture co-applicant deduction details
        $totalCoapplicantDeductions = 0;
        $coapplicant_deduction_json = $request->input('coapplicant_deduction_json', []);  // Deduction names
        $coapplicant_deduction_amount = $request->input('coapplicant_deduction_amount', []);  // Deduction amounts

        $coapplicantDeductionDetails = []; // Array to hold processed co-applicant deduction details

        foreach ($coapplicant_deduction_json as $key => $source) {
            $amount = $coapplicant_deduction_amount[$key] ?? 0; // Use 0 if the amount doesn't exist
            if ($source && $amount > 0) {
                $coapplicantDeductionDetails[] = [
                    'source' => $source, // Source of the co-applicant deduction
                    'amount' => (float) $amount // Store amount as a float
                ];
            }
        }

        // Calculating total deductions for co-applicant (sum of all deduction amounts)
        $totalCoapplicantDeductions = array_sum(array_column($coapplicantDeductionDetails, 'amount'));

        // Tax amount (assuming annual and converting to monthly)
        $taxAmount = (float) $request->input('tax_amount', 0) / 12;
        $coapplicantTaxAmount = (float) $request->input('coapplicant_tax_amount', 0) / 12;

        // Fetch the bank's FOIR percentage
        $selectedBank = $request->input('bank_id');
        $bank = Foir::find($selectedBank);
        $foirPercentage = $bank->foir_percentage / 100; // Convert to decimal

        // Apply the formula (Total Monthly Income - Monthly Tax) * FOIR% - Monthly Deductions = Proposed EMI
        $remainingIncomeAfterTax = $totalIncome - ($taxAmount + $coapplicantTaxAmount);
        $proposedEmi = ($remainingIncomeAfterTax * $foirPercentage) - ($totalDeductions + $totalCoapplicantDeductions);
        // Prepare eligibility data for storage (all income amounts should be annual)
        $eligibilityData = [
            'user_id' => $request->input('user_id'),
            'loan_id' => $request->input('loan_id'),
            'coapplicant_salary' => $coapplicantSalary,
            'rental_income_json' => json_encode($rentalIncomeDetails), // Rental income details for the primary applicant
            'rental_income_amount' => $totalRentIncome, // Total rental income for the primary applicant, converted to annual
            'coapplicant_rent_income_json' => json_encode($coapplicantRentalIncomeDetails), // Storing co-applicant's rental income as JSON
            'coapplicant_rent_income_amount' => $totalCoapplicantRentalIncome, // Total rental income for the co-applicant
            'income_from_business_json' => json_encode([]), // Placeholder for income from business
            'income_from_business_amount' => 0, // Total business income amount, set to 0 for now
            'remunration_income_json' => json_encode($remunerationIncomeDetails), // Remuneration income details
            'remunration_income_amount' => $totalRemunerationIncome, // Total remuneration income amount
            'firm_share_profit_json' => json_encode($profitShareIncomeDetails), // Profit share income details
            'firm_share_profit_amount' => $totalProfitShareIncome, // Total profit share income amount
            'capital_interest_income_json' => json_encode([]), // Placeholder for capital interest income
            'capital_interest_income_amount' => 0, // Total capital interest income amount, set to 0 for now
            'depreciation_json' => json_encode([]), // Placeholder for depreciation details
            'depreciation_amount' => 0, // Total depreciation amount, set to 0 for now
            'agriculture_income_json' => json_encode($agricultureIncomeDetails), // Agriculture income details
            'agriculture_income_amount' => $totalAgricultureIncome, // Total agriculture income amount
            'deduction_json' => json_encode($deductionDetails), // Deductions for the primary applicant, stored as JSON
            'deduction_amount' => $totalDeductions, // Total deductions for the primary applicant
            'tax_amount' => $taxAmount * 12, // Annual tax amount calculation
            'income_json' => json_encode($totalIncome), // Total income for the primary applicant, stored as JSON
            'income_amount' => $totalIncome, // Total income amount for the primary applicant
            'all_existing_emi_json' => json_encode([]), // Placeholder for existing EMIs
            'all_existing_emi_amount' => 0, // Total existing EMI amount, set to 0 for now
            'proposed_emi' => $proposedEmi, // Proposed EMI calculated earlier
        ];
        
        // Store eligibility criteria data
        EligibilityCriteria::updateOrCreate(
            [
                'user_id' => $request->input('user_id'),
                'loan_id' => $request->input('loan_id')
            ],
            $eligibilityData
        );
    
        if ($request->ajax()) {
            return response()->json([
                'totalIncome' => $totalIncome,
                'taxAmount' => $taxAmount,
                'remainingIncomeAfterTax' => $remainingIncomeAfterTax,
                'foirPercentage' => $foirPercentage * 100,
                'totalDeductions' => $totalDeductions + $totalCoapplicantDeductions, // Sum of deductions from both applicants
                'proposedEmi' => $proposedEmi, // Proposed EMI considering both applicants
                'bankName' => $bank->name, // Bank name associated with the loan
            ]);
        }
    
        // Return the view with calculated values and bank details
        return view('admin.calculator.eligibility_result', [
            'totalIncome' => $totalIncome,
            'taxAmount' => $taxAmount,
            'remainingIncomeAfterTax' => $remainingIncomeAfterTax,
            'foirPercentage' => $foirPercentage * 100,
            'totalDeductions' => $totalDeductions + $totalCoApplicantDeductions, // Total deductions from both applicants
            'proposedEmi' => $proposedEmi, // Proposed EMI for both applicants
            'bankName' => $bank->name, // Bank name associated with the loan
        ]);
}
    public function eligibilityCriteria(){
        $data['lists'] = DB::table('SELECT u.name, p.dob FROM loans l, users u, profile p WHERE l.user_id = u.id and p.user_id = u.id');

        $data['lists'] = DB::table('loans')
        ->join('users', 'loans.user_id', '=', 'users.id')
        ->join('profile', 'users.id', '=', 'profile.user_id')
        ->select(
            'loans.loan_id',
            'loans.amount',
            'users.name',
            'profile.dob',
            'users.created_at'
        )
        ->paginate(10); 
        return view('eligibility.allEligiblity', compact('data'));
    }

    public function eligiblityDetails($id){
        $data['userDetails'] = DB::table('loans')
        ->join('users', 'loans.user_id', '=', 'users.id')
        ->join('professional_details', 'loans.user_id', '=', 'professional_details.user_id')
        ->where('loans.loan_id', $id)
        ->select('users.id as user_id', 'users.name','loans.loan_id','professional_details.netsalary', 'professional_details.profession_type')
        ->first();

    // Check if user details were found
        if (!$data['userDetails']) {
            return response()->json(['error' => 'Loan not found or user details missing'], 404);
        }

        // Fetch eligible banks based on user's net salary
        $data['foirBanks'] = Foir::where('min_salary', '<=', $data['userDetails']->netsalary)
                                ->where('max_salary', '>=', $data['userDetails']->netsalary)
                                ->get();
        $data['criteria'] = DB::table('eligiblity_criteria')
        ->where('user_id', $data['userDetails']->user_id)
        ->where('loan_id', $id)
        ->first();
        if($data['userDetails']->profession_type === 'self')
            {
            return view('admin.calculator.eligibility_calculator', compact('data'));
            }
            
        else{
            return view('admin.calculator.eligibility_calculator_salaried', compact('data'));
            }
    }
    public function eligiblityDetailsAll(){

            {
            return view('admin.calculator.eligibility_calculator_all');
            }
         
    }
    public function insertRentalIncome(Request $request)
    {  
        DB::beginTransaction();

        try{
                $p = new EligibilityCriteria;
                $p->user_id = $request->ifsc_code;
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


    //salaried function for calculator
    public function calculateEligibilitySalaried(Request $request)
{
    // Check if there is a co-applicant
    $hasCoapplicant = $request->has('co_applicant_checkbox');

    // Validate the request inputs
    $request->validate([
        'salary' => 'required|numeric',
        'tax_amount' => 'required|numeric',
        'coapplicant_tax_amount' => 'nullable|numeric',
        'deduction_name' => 'array',
        'deduction_amount' => 'array',
        'coapplicant_deduction_json' => 'array',
        'coapplicant_deduction_amount' => 'array',
        'coapplicant_salary' => 'nullable|numeric',
        'bank_id' => 'required|exists:foir,id',
        'provisional_fund_name' => 'array',
        'provisional_fund_amount' => 'array',
        'professional_tax_name' => 'array',
        'professional_tax_amount' => 'array',
    ]);

    // Monthly salary
    $salary = $request->input('salary'); 
    $coapplicantSalary = $request->input('coapplicant_salary', 0);

    // Calculate total income
    $totalIncome = $salary + $coapplicantSalary;

    // Capture deduction details and calculate total deductions
    $deductionNames = $request->input('deduction_name', []);
    $deductionAmounts = $request->input('deduction_amount', []);
    
    // Prepare deductions for the applicant
    $deductionDetails = [];
    foreach ($deductionNames as $key => $source) {
        $amount = $deductionAmounts[$key] ?? 0;
        if ($source && $amount > 0) {
            $deductionDetails[] = [
                'source' => $source,
                'amount' => (float) $amount
            ];
        }
    }

    // Calculate total deductions for the applicant
    $totalDeductions = array_sum(array_column($deductionDetails, 'amount'));

    // Capture co-applicant deduction details
    $coapplicant_deduction_json = $request->input('coapplicant_deduction_json', []);
    $coapplicant_deduction_amount = $request->input('coapplicant_deduction_amount', []);
    
    // Prepare deductions for the co-applicant
    $coapplicantDeductionDetails = [];
    foreach ($coapplicant_deduction_json as $key => $source) {
        $amount = $coapplicant_deduction_amount[$key] ?? 0;
        if ($source && $amount > 0) {
            $coapplicantDeductionDetails[] = [
                'source' => $source,
                'amount' => (float) $amount
            ];
        }
    }

    // Calculate total deductions for co-applicant
    $totalCoapplicantDeductions = array_sum(array_column($coapplicantDeductionDetails, 'amount'));

    $provisionalFundAmounts = $request->input('provisional_fund_amount', []); // Get all amounts as an array
    $professionalTaxAmounts = $request->input('professional_tax_amount', []); 

    $provisionalFund = array_sum($provisionalFundAmounts);
    $professionalTax = array_sum($professionalTaxAmounts);

    // Log the provisional funds for debugging
    \Log::info('Provisional Fund:', ['provisional_fund' => $provisionalFund]);

    // Tax amount (monthly)
    $taxAmount = (float) $request->input('tax_amount', 0) / 12;
    $coapplicantTaxAmount = (float) $request->input('coapplicant_tax_amount', 0) / 12;

    // Fetch the bank's FOIR percentage
    $selectedBank = $request->input('bank_id');
    $bank = Foir::find($selectedBank);
    $foirPercentage = $bank->foir_percentage / 100;

    // Calculate remaining income after tax
    $remainingIncomeAfterTax = $totalIncome - ($taxAmount + $coapplicantTaxAmount);
    \Log::info('Remaining Income After Tax:', ['remaining_income' => $remainingIncomeAfterTax]);

    // Calculate proposed EMI including provisional fund
    $proposedEmi = ($remainingIncomeAfterTax * $foirPercentage) - 
    ($totalDeductions + $totalCoapplicantDeductions + $provisionalFund + $professionalTax);
    // Log the proposed EMI
    \Log::info('Proposed EMI:', [
        'proposed_emi' => $proposedEmi,
        'foir_percentage' => $foirPercentage,
        'remaining_income_after_tax' => $remainingIncomeAfterTax,
        'total_deductions' => $totalDeductions,
        'coapplicant_deductions' => $totalCoapplicantDeductions,
        'professional_tax' => $professionalTax
    ]);

    // Prepare eligibility data for storage (all income amounts should be annual)
    $eligibilityData = [
        'user_id' => $request->input('user_id'),
        'loan_id' => $request->input('loan_id'),
        'coapplicant_salary' => $coapplicantSalary,
        'deduction_json' => json_encode($deductionDetails),
        'deduction_amount' => $totalDeductions,
        'tax_amount' => $taxAmount * 12,
        'income_json' => json_encode($totalIncome),
        'income_amount' => $totalIncome,
        'all_existing_emi_json' => json_encode([]),
        'all_existing_emi_amount' => 0,
        'proposed_emi' => $proposedEmi,
    ];

    // Store eligibility criteria data
    EligibilityCriteria::updateOrCreate(
        [
            'user_id' => $request->input('user_id'),
            'loan_id' => $request->input('loan_id')
        ],
        $eligibilityData
    );

    // Return response based on AJAX request or standard request
    if ($request->ajax()) {
        return response()->json([
            'totalIncome' => $totalIncome,
            'taxAmount' => $taxAmount,
            'remainingIncomeAfterTax' => $remainingIncomeAfterTax,
            'foirPercentage' => $foirPercentage * 100,
            'totalDeductions' => $totalDeductions + $totalCoapplicantDeductions,
            'proposedEmi' => $proposedEmi,
            'bankName' => $bank->name,
        ]);
    }

    // Return the view with calculated values and bank details
    return view('admin.calculator.eligibility_result', [
        'totalIncome' => $totalIncome,
        'taxAmount' => $taxAmount,
        'remainingIncomeAfterTax' => $remainingIncomeAfterTax,
        'foirPercentage' => $foirPercentage * 100,
        'totalDeductions' => $totalDeductions + $totalCoapplicantDeductions,
        'proposedEmi' => $proposedEmi,
        'bankName' => $bank->name,
    ]);
}

//stand alone calculator
public function showStandaloneForm()
    {
        $userSalary = 50000;  // Replace with actual logic to get user's salary

        // Fetch eligible banks based on salary
        $data['foirBanks'] = Foir::where('min_salary', '<=', $userSalary)
                                ->where('max_salary', '>=', $userSalary)
                                ->get();
    
        return view('admin.calculator.standalone_self', compact('data'));
    }
public function calculateStandaloneEligibility(Request $request)
{
    $request->validate([
        'salary' => 'required|numeric',
        'rent_income_name' => 'array',
        'rent_income_amount' => 'array',
        'firm_share_profit_json' => 'array',
        'firm_share_profit_amount' => 'array',
        'agriculture_income_json' => 'array',
        'agriculture_income_amount' => 'array',
        'remunration_income_json' => 'array',
        'remunration_income_amount' =>'array',
        'tax_amount' => 'required|numeric',
        'deduction_name' => 'array',
        'deduction_amount' => 'array',
        'bank_id' => 'required|exists:foir,id', // Check against the foir table
    ]);

    // Monthly salary
    $salary = $request->input('salary') / 12; // Convert annual salary to monthly
    
    // Remuneration income
    $remunerationIncomeNames = $request->input('remunration_income_json', []); 
    $remunerationIncomeAmounts = $request->input('remunration_income_amount', []);
    $remunerationIncomeDetails = [];
    foreach ($remunerationIncomeNames as $key => $source) {
        $amount = $remunerationIncomeAmounts[$key] ?? 0;
        if ($source && $amount > 0) {
            $remunerationIncomeDetails[] = [
                'source' => $source,
                'amount' => (float) $amount  // Convert to monthly remuneration income
            ];
        }
    }
    $totalRemunerationIncome = array_sum(array_column($remunerationIncomeDetails, 'amount'));

    // Rent income
    $rentIncomeNames = $request->input('rent_income_name', []);
    $rentIncomeAmounts = $request->input('rent_income_amount', []);
    $rentalIncomeDetails = [];
    foreach ($rentIncomeNames as $key => $source) {
        $amount = $rentIncomeAmounts[$key] ?? 0;
        if ($source && $amount > 0) {
            $rentalIncomeDetails[] = [
                'source' => $source,
                'amount' => (float) $amount  // Convert to monthly rent income
            ];
        }
    }
    $totalRentIncome = array_sum(array_column($rentalIncomeDetails, 'amount'));

    // Profit Share income
    $profitShareIncomeNames = $request->input('firm_share_profit_json', []);
    $profitShareIncomeAmounts = $request->input('firm_share_profit_amount', []);
    $profitShareIncomeDetails = [];
    foreach ($profitShareIncomeNames as $key => $source) {
        $amount = $profitShareIncomeAmounts[$key] ?? 0;
        if ($source && $amount > 0) {
            $profitShareIncomeDetails[] = [
                'source' => $source,
                'amount' => (float) $amount  // Convert to monthly profit share income
            ];
        }
    }
    $totalProfitShareIncome = array_sum(array_column($profitShareIncomeDetails, 'amount'));

    // Agriculture income (other income)
    $agricultureIncomeNames = $request->input('agriculture_income_json', []);
    $agricultureIncomeAmounts = $request->input('agriculture_income_amount', []);
    $agricultureIncomeDetails = [];
    foreach ($agricultureIncomeNames as $key => $source) {
        $amount = $agricultureIncomeAmounts[$key] ?? 0;
        if ($source && $amount > 0) {
            $agricultureIncomeDetails[] = [
                'source' => $source,
                'amount' => (float) $amount  // Store amount as a float
            ];
        }
    }
    $totalAgricultureIncome = array_sum(array_column($agricultureIncomeDetails, 'amount'));    // Total monthly income

    // Total income calculation
    $totalIncome = $salary + ($totalRentIncome / 12) + ($totalAgricultureIncome / 12) + ($totalProfitShareIncome / 12) + ($totalRemunerationIncome / 12);

    // Deductions calculation
    $deductionNames = $request->input('deduction_name', []);
    $deductionAmounts = $request->input('deduction_amount', []);
    $deductionDetails = [];
    foreach ($deductionNames as $key => $source) {
        $amount = $deductionAmounts[$key] ?? 0;
        if ($source && $amount > 0) {
            $deductionDetails[] = [
                'source' => $source,
                'amount' => (float) $amount // Store amount as a float
            ];
        }
    }
    $totalDeductions = array_sum(array_column($deductionDetails, 'amount'));

    // Tax amount (assuming annual and converting to monthly)
    $taxAmount = (float) $request->input('tax_amount', 0) / 12;

    // Fetch bank's FOIR percentage
    $selectedBank = $request->input('bank_id');
    $bank = Foir::find($selectedBank);
    $foirPercentage = $bank->foir_percentage / 100; // Convert to decimal

    // Calculate eligibility based on formula
    $remainingIncomeAfterTax = $totalIncome - $taxAmount;
    $proposedEmi = ($remainingIncomeAfterTax * $foirPercentage) - $totalDeductions;

    // Prepare eligibility data for storage or display
    $eligibilityData = [
        'salary' => $salary,
        'rental_income_json' => json_encode($rentalIncomeDetails), // Rental income details
        'rental_income_amount' => $totalRentIncome, // Total rental income
        'remunration_income_json' => json_encode($remunerationIncomeDetails), // Remuneration income details
        'remunration_income_amount' => $totalRemunerationIncome, // Total remuneration income
        'firm_share_profit_json' => json_encode($profitShareIncomeDetails), // Profit share income details
        'firm_share_profit_amount' => $totalProfitShareIncome, // Total profit share income
        'agriculture_income_json' => json_encode($agricultureIncomeDetails), // Agriculture income details
        'agriculture_income_amount' => $totalAgricultureIncome, // Total agriculture income
        'deduction_json' => json_encode($deductionDetails), // Deduction details
        'deduction_amount' => $totalDeductions, // Total deductions
        'tax_amount' => $taxAmount, // Monthly tax amount
        'emi' => $proposedEmi, // Proposed EMI based on eligibility
    ];

    return response()->json([
        'eligibility_data' => $eligibilityData,
        'proposed_emi' => $proposedEmi
    ]);
}
}