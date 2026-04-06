<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DsaPayout;

class DsaPayoutController extends Controller
{
    public function index()
{
    $payouts = DsaPayout::with(['user', 'loan'])
        ->latest()
        ->get();

    return view('admin.payouts.index', compact('payouts'));
}
    public function release($id)
{
    $payout = DsaPayout::findOrFail($id);

    // ❌ Prevent duplicate payment
    if ($payout->status == 'paid') {
        return back()->with('error', 'Already paid');
    }

    $payout->update([
        'status' => 'paid',
        'paid_at' => now()
    ]);

    return back()->with('success', 'Payout released successfully');
}
}
