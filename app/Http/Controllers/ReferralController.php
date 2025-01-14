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


class ReferralController extends Controller
{
    public function referral_earnings()
    {
            $data['earnings'] = DB::table('users')
        ->join('profile', 'users.id', '=', 'profile.user_id')
        ->join('wallet', 'users.id', '=', 'wallet.user_id')
        ->select('users.id', 'users.name', 'users.email_id', 'users.referral_code', 'profile.mobile_no', 'profile.dob', 'wallet.wallet_balance')
        ->paginate(10);

        return view('admin.earnings',compact('data'));
    }
    //agent wallet
    public function walletbalance()
{
    $userId = session('user_id'); // Assuming user_id is stored in the session
    $walletBalance = DB::table('wallet')->where('user_id', $userId)->value('wallet_balance');

    // Fetch the user's transaction history
    $transactions = DB::table('transactions')
        ->where('user_id', $userId)
        ->select('id', 'user_id', 'amount', 'transaction_id', 'status', 'created_at')
        ->get()
        ->toArray(); // Convert to array

    // Fetch the user's pending withdrawal requests
    $withdrawalRequests = DB::table('withdrawal_requests')
        ->where('user_id', $userId)
        ->where('status', 'pending') // Filter for pending status
        ->select('id', 'amount', 'status', 'created_at')
        ->get()
        ->toArray(); // Convert to array

    // Combine transactions and withdrawal requests
    $combinedData = array_merge($transactions, $withdrawalRequests);

    // Sort by created_at in descending order
    usort($combinedData, function($a, $b) {
        return strtotime($b->created_at) - strtotime($a->created_at);
    });

    return view('admin.walletbalance', compact('walletBalance', 'combinedData'));
}
    public function requestWithdrawal(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);
    
        // Fetch the user ID from the session
        $userId = session('user_id');
        $amount = $request->input('amount');
    
        // Retrieve the user's current wallet balance
        $walletBalance = DB::table('wallet')->where('user_id', $userId)->value('wallet_balance');
    
        // Check if the requested withdrawal amount exceeds the wallet balance
        if ($amount > $walletBalance) {
            return redirect()->back()->with('message', 'You cannot withdraw more than your current wallet balance.');
        }
    
        // Check if the user has sufficient balance for the withdrawal
        if ($walletBalance >= $amount) {
            // Create a new withdrawal request
            DB::table('withdrawal_requests')->insert([
                'user_id' => $userId,
                'amount' => $amount,
                'status' => 'pending',
                'created_at' => now(),
            ]);
    
            return redirect()->back()->with('message', 'Withdrawal request submitted successfully.');
        } else {
            return redirect()->back()->with('message', 'Insufficient balance.');
        }
    }

    public function viewWithdrawalRequests()
    {
        $requests = DB::table('withdrawal_requests')
            ->join('users', 'withdrawal_requests.user_id', '=', 'users.id') // Join with the users table
            ->where('withdrawal_requests.status', 'pending') // Filter pending requests
            ->select('withdrawal_requests.*', 'users.name') // Select all fields from withdrawal_requests and the name from users
            ->get();
    
        return view('admin.withdrawal_requests', compact('requests'));
    }

    // Approve a withdrawal request
    public function approveWithdrawal(Request $request, $id)
    {
        $transactionId = $request->input('transaction_id');
        $withdrawal = DB::table('withdrawal_requests')->where('id', $id)->first();

        if ($withdrawal) {
            // Update the request status to approved
            DB::table('withdrawal_requests')->where('id', $id)->update(['status' => 'approved']);

            // Subtract the amount from the user's wallet
            DB::table('wallet')->where('user_id', $withdrawal->user_id)->decrement('wallet_balance', $withdrawal->amount);

            // Record the transaction
            DB::table('transactions')->insert([
                'user_id' => $withdrawal->user_id,
                'amount' => $withdrawal->amount,
                'transaction_id' => $transactionId,
                'status' => 'completed',
                'created_at' => now(),
            ]);

            return redirect()->back()->with('message', 'Withdrawal approved successfully.');
        } else {
            return redirect()->back()->with('message', 'Withdrawal request not found.');
        }
    }
    //admin
    public function showAllTransactions()
{
    // Fetch all transactions with user details
    $data['transactions'] = DB::table('transactions')
        ->join('users', 'transactions.user_id', '=', 'users.id')
        ->select('transactions.id', 'users.name as user_name', 'transactions.transaction_id', 'transactions.amount', 'transactions.status', 'transactions.created_at')
        ->orderBy('transactions.created_at', 'desc')
        ->paginate(10);

    // Pass the transactions data to the view
    return view('admin.transactions', compact('data'));
}
    //users & agent
    public function showTransactionHistory()
    {
        if (request()->ajax()) {
            $userId = session('user_id');
            // Fetch the transactions for the logged-in user without excluding any status
            $transactions = DB::table('transactions')
                ->where('user_id', $userId)
                ->orderBy('created_at', 'desc')
                ->get();
    
            return DataTables::of($transactions)
                ->editColumn('created_at', function ($transaction) {
                    return \Carbon\Carbon::parse($transaction->created_at)->format('d M Y, h:i A');
                })
                ->make(true);
        }
    
        // Load the view for non-AJAX requests
        return view('agent.transactions');
    }

    //admin wallet
    public function userWalletbalance()
{
    $userId = session('user_id'); // Assuming user_id is stored in the session
    $walletBalance = DB::table('wallet')->where('user_id', $userId)->value('wallet_balance');

    // Fetch the user's transaction history
    $transactions = DB::table('transactions')
        ->where('user_id', $userId)
        ->select('id', 'user_id', 'amount', 'transaction_id', 'status', 'created_at')
        ->get()
        ->toArray(); // Convert to array

    // Fetch the user's pending withdrawal requests
    $withdrawalRequests = DB::table('withdrawal_requests')
        ->where('user_id', $userId)
        ->where('status', 'pending') // Filter for pending status
        ->select('id', 'amount', 'status', 'created_at')
        ->get()
        ->toArray(); // Convert to array

    // Combine transactions and withdrawal requests
    $combinedData = array_merge($transactions, $withdrawalRequests);

    // Sort by created_at in descending order
    usort($combinedData, function($a, $b) {
        return strtotime($b->created_at) - strtotime($a->created_at);
    });

    // return view('admin.walletbalance', compact('walletBalance', 'combinedData'));
    return view('frontend.profile.referrals', compact('walletBalance', 'combinedData'));
}
public function listUsers(Request $request)
{
    $search = $request->input('search');

    // Fetch users with their name, email, and referral code, filtered by search
    $users = DB::table('users')
        ->select('name', 'email_id', 'referral_code')
        ->when($search, function ($query, $search) {
            return $query->where('name', 'like', "%$search%")
                         ->orWhere('email_id', 'like', "%$search%");
        })
        ->paginate(10); // Add pagination

    // Pass the data to the view
    return view('admin.refer-tool', compact('users'));
}
}