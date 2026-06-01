<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DsaMonthlyPayout;
use App\Models\User;   // ✅ ONLY HERE
use Carbon\Carbon;
use DB;
use App\Models\DsaWallet;
use App\Models\DsaPayout;


class DsaMonthlyPayoutController extends Controller
{

    // 🔹 INDEX PAGE
   public function index(Request $request)
{
    $dsas = User::where('role_id', 6)->pluck('name', 'id');

    $query = DsaMonthlyPayout::with('dsa')->latest();

    // ✅ FILTER: DSA
    if ($request->filled('dsa_id')) {
        $query->where('dsa_id', $request->dsa_id);
    }

    // ✅ FILTER: MONTH
    if ($request->filled('month')) {
        $query->where('month', $request->month);
    }

    $payouts = $query->get();

    return view('admin.dsa-payouts.index', compact('dsas', 'payouts'));
}


    // 🔹 CALCULATE PAYOUT

public function calculate(Request $request)
{
    $request->validate([
        'dsa_id' => 'required',
        'month'  => 'required'
    ]);

    $startDate = Carbon::parse($request->month)->startOfMonth();
    $endDate   = Carbon::parse($request->month)->endOfMonth();

    // ✅ Existing payout record
    $existingPayout = DsaMonthlyPayout::where('dsa_id', $request->dsa_id)
        ->where('month', $request->month)
        ->first();

    // 🔥 Fetch loans
    $loans = DB::table('loans')
        ->join('dsa_customers', 'loans.user_id', '=', 'dsa_customers.user_id')
        ->where('dsa_customers.dsa_id', $request->dsa_id)
        ->where('loans.status', 'disbursed')
        ->whereBetween('loans.created_at', [$startDate, $endDate])
        ->select('loans.*')
        ->get();

    if ($loans->isEmpty()) {
        return redirect()->back()->with('error', 'No disbursed loans found for this month');
    }

    $totalLoans  = 0;
    $totalAmount = 0;
    $totalPayout = 0;

    foreach ($loans as $loan) {

        $totalLoans++;

        $amount = $loan->amount_approved ?? 0;
        $totalAmount += $amount;

        $config = DB::table('dsa_payout_configs')
            ->where('bank_id', $loan->bank_id)
            ->where('loan_category_id', $loan->loan_category_id)
            ->first();

        if ($config && $config->percentage > 0) {
            // ✅ FIX: अलग variable
            $loanPayout = ($amount * $config->percentage) / 100;
            $totalPayout += $loanPayout;
        }
    }

    // ✅ SAVE / UPDATE
    if ($existingPayout) {
      $existingPayout->update([

    'total_loans'  => $totalLoans,
    'total_amount' => $totalAmount,
    'total_payout' => $totalPayout,

    'status' => (
        $totalPayout > $existingPayout->released_amount
    )
    ? 'pending'
    : 'released'

]);
    } else {
        DsaMonthlyPayout::create([
            'dsa_id'       => $request->dsa_id,
            'month'        => $request->month,
            'total_loans'  => $totalLoans,
            'total_amount' => $totalAmount,
            'total_payout' => $totalPayout,
            'status'       => 'pending'
        ]);
    }

    return redirect()->route('dsa.payout.index')
        ->with('success', 'Monthly payout calculated successfully');
}
public function details($dsaId, $month)
{
    $startDate = \Carbon\Carbon::parse($month)->startOfMonth();
    $endDate   = \Carbon\Carbon::parse($month)->endOfMonth();

    // ✅ GET DSA NAME
    $dsa = User::find($dsaId);

  $loans = DB::table('loans')
    ->join('dsa_customers', 'loans.user_id', '=', 'dsa_customers.user_id')

    ->leftJoin('loan_bank_details as banks', 'banks.bank_id', '=', 'loans.bank_id')
    ->leftJoin('loan_category as cat', 'cat.loan_category_id', '=', 'loans.loan_category_id')

    // ✅ JOIN PAYOUT CONFIG
    ->leftJoin('dsa_payout_configs as config', function ($join) {
        $join->on('config.bank_id', '=', 'loans.bank_id')
             ->on('config.loan_category_id', '=', 'loans.loan_category_id');
    })

    ->where('dsa_customers.dsa_id', $dsaId)
    ->where('loans.status', 'disbursed')
    ->whereBetween('loans.created_at', [$startDate, $endDate])

    ->select(
        'loans.loan_id',
        'loans.amount_approved',
        'banks.bank_name',
        'cat.category_name',
        'config.percentage' // ✅ ADD THIS
    )
    ->get();

    return view('admin.dsa-payouts.details', compact('loans', 'month', 'dsa'));
}


    // 🔹 RELEASE PAYMENT
public function release($id)
{
    $payout = DsaMonthlyPayout::findOrFail($id);

    // LAST BALANCE
    $lastBalance = DsaWallet::where('dsa_id', $payout->dsa_id)
                    ->latest()
                    ->value('balance');

    $lastBalance = $lastBalance ?? 0;

    // ONLY NEW AMOUNT
    $pendingAmount =
        $payout->total_payout - $payout->released_amount;

    // Already fully released
    if($pendingAmount <= 0)
    {
        return back()->with(
            'error',
            'Already fully released'
        );
    }

    // NEW BALANCE
    $newBalance =
        $lastBalance + $pendingAmount;

    // WALLET ENTRY
    DsaWallet::create([

        'dsa_id' => $payout->dsa_id,
        'payout_id' => $payout->id,

        'credit' => $pendingAmount,
        'debit' => 0,

        'balance' => $newBalance,

        'remark' => 'Monthly payout released'

    ]);

    // UPDATE RELEASED AMOUNT
    $payout->released_amount =
        $payout->released_amount +
        $pendingAmount;

    // STATUS UPDATE
    if(
        $payout->released_amount >=
        $payout->total_payout
    )
    {
        $payout->status = 'released';
    }
    else
    {
        $payout->status = 'pending';
    }

    $payout->save();

    return back()->with(
        'success',
        'Payout Released Successfully'
    );
}
public function wallet()
{
    $dsaId = session('user_id');

    $wallets = DsaWallet::where('dsa_id', $dsaId)
                ->latest()
                ->get();

    $balance = DsaWallet::where('dsa_id', $dsaId)
                ->latest()
                ->value('balance');

    $balance = $balance ?? 0;

    return view('admin.dsa.wallet', compact('wallets','balance'));
}
}