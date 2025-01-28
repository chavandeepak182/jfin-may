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
    $requestedAmount = $request->input('amount');

    // Retrieve the user's current wallet balance
    $walletBalance = DB::table('wallet')->where('user_id', $userId)->value('wallet_balance');

    // Check if the requested withdrawal amount exceeds the wallet balance
    if ($requestedAmount > $walletBalance) {
        return redirect()->back()->with('message', 'You cannot withdraw more than your current wallet balance.');
    }

    // GST and TDS percentages
    $gstPercentage = 10; // Example: 10%
    $tdsPercentage = 5;  // Example: 5%

    // Calculate GST, TDS, and final amount after deductions
    $gstAmount = ($requestedAmount * $gstPercentage) / 100;
    $tdsAmount = ($requestedAmount * $tdsPercentage) / 100;
    $finalAmount = $requestedAmount - $gstAmount - $tdsAmount;

    // Create a new withdrawal request
    DB::table('withdrawal_requests')->insert([
        'user_id' => $userId,
        'amount' => $requestedAmount, // Requested amount
        'gst' => $gstAmount,
        'tds' => $tdsAmount,
        'final_amount' => $finalAmount, // Amount after GST & TDS
        'status' => 'pending',
        'created_at' => now(),
    ]);

    return redirect()->back()->with('message', 'Withdrawal request submitted successfully.');
}

    public function viewWithdrawalRequests()
    {
        $requests = DB::table('withdrawal_requests')
            ->join('users', 'withdrawal_requests.user_id', '=', 'users.id') // Join with the users table
            ->where('withdrawal_requests.status', 'pending') // Filter pending requests
            ->select('withdrawal_requests.*', 'users.name', 'users.referral_code') // Select all fields from withdrawal_requests, the name, and referral_code from users
            ->get();
    
        return view('admin.withdrawal_requests', compact('requests'));
    }

    // Approve a withdrawal request
    public function approveWithdrawal(Request $request, $id)
    {
        $transactionId = $request->input('transaction_id');
    
        // Find the withdrawal request
        $withdrawal = DB::table('withdrawal_requests')->where('id', $id)->first();
    
        if ($withdrawal) {
            // Check if the request is already approved
            if ($withdrawal->status === 'approved') {
                return redirect()->back()->with('message', 'This withdrawal request is already approved.');
            }
    
            // Retrieve requested amount, GST, TDS, and final amount
            $requestedAmount = $withdrawal->amount; // Full amount requested
            $gstPercentage = 2; // Example GST rate
            $tdsPercentage = 2; // Example TDS rate
    
            // Calculate GST and TDS based on the requested amount
            $gstAmount = ($requestedAmount * $gstPercentage) / 100;
            $tdsAmount = ($requestedAmount * $tdsPercentage) / 100;
    
            // Final amount to be transferred after GST and TDS deductions
            $finalAmount = $requestedAmount - $gstAmount - $tdsAmount;
    
            // Check if the wallet balance is sufficient
            $walletBalance = DB::table('wallet')->where('user_id', $withdrawal->user_id)->value('wallet_balance');
    
            if ($walletBalance < $requestedAmount) {
                return redirect()->back()->with('message', 'Insufficient wallet balance for this transaction.');
            }
    
            // Deduct the requested amount (full amount) from the user's wallet
            DB::table('wallet')->where('user_id', $withdrawal->user_id)->decrement('wallet_balance', $requestedAmount);
    
            // Update the withdrawal request to approved and save the updated amounts
            DB::table('withdrawal_requests')->where('id', $id)->update([
                'status' => 'approved',
                'gst' => $gstAmount,
                'tds' => $tdsAmount,
                'final_amount' => $finalAmount, // Save the calculated final amount
                'transaction_id' => $transactionId,
                'updated_at' => now(),
            ]);
    
            // Record the transaction
            DB::table('transactions')->insert([
                'user_id' => $withdrawal->user_id,
                'amount' => $requestedAmount, // The full amount requested
                'transaction_id' => $transactionId,
                'status' => 'completed',
                'gst' => $gstAmount,
                'tds' => $tdsAmount,
                'final_amount' => $finalAmount, // Final amount after GST and TDS
                'created_at' => now(),
            ]);
    
            return redirect()->back()->with('message', 'Withdrawal approved successfully.');
        } else {
            return redirect()->back()->with('message', 'Withdrawal request not found.');
        }
    }
    //admin
    public function showAllTransactions(Request $request)
{
    $search = $request->input('search');

    $query = DB::table('transactions')
        ->join('users', 'transactions.user_id', '=', 'users.id')
        ->select(
            'transactions.id',
            'users.name as user_name',
            'users.email_id',
            'transactions.transaction_id',
            'transactions.amount',
            'transactions.status',
            'transactions.created_at'
        )
        ->orderBy('transactions.created_at', 'desc');

    // Apply search filter if search term exists
    if (!empty($search)) {
        $query->where(function ($q) use ($search) {
            $q->where('users.name', 'LIKE', "%$search%")
                ->orWhere('users.email_id', 'LIKE', "%$search%")
                ->orWhere('transactions.transaction_id', 'LIKE', "%$search%")
                ->orWhere('transactions.status', 'LIKE', "%$search%");
        });
    }

    // Paginate AFTER filtering results
    $data['transactions'] = $query->paginate(10)->appends(['search' => $search]);

    return view('admin.transactions', compact('data'));
}
public function showAllTransactionsUser(Request $request)
{
    $userId = session('user_id'); // Ensure user is logged in

    // If no user is logged in, redirect to login
    if (!$userId) {
        return redirect()->route('login')->with('error', 'Please log in to view your transactions.');
    }

    $search = $request->input('search'); // Get the search term

    // Query transactions for the logged-in user
    $query = DB::table('transactions')
        ->where('transactions.user_id', $userId)
        ->join('users', 'transactions.user_id', '=', 'users.id') // Join users table for user details
        ->select('transactions.id', 'transactions.transaction_id', 'transactions.amount', 'transactions.status', 'transactions.created_at', 'users.name as user_name')
        ->orderBy('transactions.created_at', 'desc');

    // Apply search filter if search term exists
    if (!empty($search)) {
        $query->where(function ($q) use ($search) {
            $q->where('transactions.transaction_id', 'LIKE', "%$search%")
              ->orWhere('transactions.status', 'LIKE', "%$search%");
        });
    }

    // Paginate the results
    $transactions = $query->paginate(10)->appends(['search' => $search]);

    // Return the transactions view
    return view('user.transaction-user', compact('transactions', 'search'));
}
public function showTransactionHistoryadmin($transactionId)
{
    // Fetch the transaction details by transaction ID
    $transaction = DB::table('transactions')
                    ->join('users', 'transactions.user_id', '=', 'users.id')
                    ->select(
                        'transactions.transaction_id',
                        'users.name as user_name',
                        'transactions.amount',
                        'transactions.gst',
                        'transactions.tds',
                        'transactions.final_amount',
                        'transactions.status',
                        'transactions.created_at'
                    )
                    ->where('transactions.transaction_id', $transactionId)
                    ->first();

    // If no transaction is found, return an error
    if (!$transaction) {
        return response()->json(['error' => 'Transaction not found.'], 404);
    }

    // Return the transaction data as a JSON response
    return response()->json($transaction);
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