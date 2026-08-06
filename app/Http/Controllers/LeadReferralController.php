<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LeadReferralController extends Controller
{
 public function dashboard()
{
    $user = Auth::user();

    $totalLeads = DB::table('lead_referral')
        ->where('referral_id', $user->id)
        ->count();

    $todayLeads = DB::table('lead_referral')
        ->where('referral_id', $user->id)
        ->whereDate('created_at', today())
        ->count();

    $closedLeads = DB::table('lead_referral')
        ->where('referral_id', $user->id)
        ->where('status', 'Closed')
        ->count();

    $pendingLeads = DB::table('lead_referral')
        ->where('referral_id', $user->id)
        ->where('status', 'New')
        ->count();

    $latestLeads = DB::table('lead_referral')
        ->where('referral_id', $user->id)
        ->latest()
        ->take(10)
        ->get();

    return view('leadreferral.dashboard', compact(
    'user',
    'totalLeads',
    'todayLeads',
    'closedLeads',
    'pendingLeads',
    'latestLeads'
));
}
public function settings()
{
    return view('leadreferral.settings');
}

public function changePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:6|confirmed',
    ]);

    $user = Auth::user();

    if (!Hash::check($request->current_password, $user->password)) {

        return back()->with('error', 'Current password is incorrect.');

    }

    DB::table('users')
        ->where('id', $user->id)
        ->update([
            'password' => Hash::make($request->new_password),
            'updated_at' => now(),
        ]);

    return back()->with('success', 'Password changed successfully.');
}

public function store(Request $request)
{
    $request->validate([
        'customer_name' => 'required|max:150',
        'mobile_no' => 'required|digits:10',
        'email' => 'required|email',
        'gender' => 'required',
        'address' => 'required',
        'pin_code' => 'required|digits:6',
        'loan_category_id' => 'required|exists:loan_category,loan_category_id',
        'loan_amount' => 'required|numeric',
        'monthly_income' => 'nullable|numeric',
        'remarks' => 'nullable|max:500',
        'documents.*' => 'nullable|mimes:jpg,jpeg,png,pdf|max:5120',
    ]);

    $documents = [];

    if($request->hasFile('documents')){

        foreach($request->file('documents') as $file){

            $documents[] = $file->store('lead-referral-documents','public');

        }
    }

DB::table('lead_referral')->insert([

    'referral_id'      => auth()->id(),
    'customer_name'    => $request->customer_name,
    'mobile_no'        => $request->mobile_no,
    'email'            => $request->email,
    'gender'           => $request->gender,
    'address'          => $request->address,
    'pin_code'         => $request->pin_code,
    'loan_category_id' => $request->loan_category_id,
    'loan_amount'      => $request->loan_amount,
    'monthly_income'   => $request->monthly_income,
    'remarks'          => $request->remarks,
    'documents'        => json_encode($documents),
    'status'           => 'New',
    'created_at'       => now(),
    'updated_at'       => now(),

]);
    return redirect()->route('referraldsa.list')
            ->with('success','Lead Added Successfully');
}
public function list()
{
    $leads = DB::table('lead_referral')
        ->leftJoin('loan_category', 'lead_referral.loan_type', '=', 'loan_category.loan_category_id')
        ->select(
            'lead_referral.*',
            'loan_category.category_name'
        )
        ->where('referral_id', auth()->id())
        ->latest('lead_referral.id')
        ->get();

    return view('leadreferral.index', compact('leads'));
}

public function edit($id)
{
    $lead = DB::table('lead_referral')
            ->where('id',$id)
            ->where('referral_id',auth()->id())
            ->first();

    if(!$lead){
        abort(404);
    }

    $loanCategories = DB::table('loan_category')
        ->orderBy('category_name')
        ->get();

    return view('leadreferral.edit',compact('lead','loanCategories'));
}
public function destroy($id)
{
    DB::table('lead_referral')
        ->where('id',$id)
        ->where('referral_id',auth()->id())
        ->delete();

    return redirect()
            ->route('referraldsa.list')
            ->with('success','Lead Deleted Successfully');
}

public function update(Request $request,$id)
{
    $request->validate([
        'customer_name'=>'required',
        'mobile_no'=>'required|digits:10',
        'email'=>'required|email',
        'loan_amount'=>'required|numeric',
    ]);

    $data=[

        'customer_name'=>$request->customer_name,
        'mobile_no'=>$request->mobile_no,
        'email'=>$request->email,
        'loan_type'=>$request->loan_category_id,
        'loan_amount'=>$request->loan_amount,
        'remarks'=>$request->remarks,
        'updated_at'=>now()

    ];

    DB::table('lead_referral')
        ->where('id',$id)
        ->where('referral_id',auth()->id())
        ->update($data);

    return redirect()
            ->route('referraldsa.list')
            ->with('success','Lead Updated Successfully');
}
public function addLead()
{
    $loanCategories = DB::table('loan_category')
        ->select('loan_category_id', 'category_name')
        ->orderBy('category_name')
        ->get();

    return view('leadreferral.add-lead', compact('loanCategories'));
}

    public function profile()
    {
        $user = Auth::user();

        return view('lead-referral.profile', compact('user'));
    }

    public function logout()
    {
        Auth::logout();
        session()->flush();

        return redirect()->route('authv3.login.form');
    }
}