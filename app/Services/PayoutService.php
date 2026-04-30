<?php
namespace App\Services;

use App\Models\DsaPayout;
use App\Models\DsaPayoutConfig;
use App\Models\User;

class PayoutService
{
    public function generatePayout($loan)
    {
        // Prevent duplicate
        if (DsaPayout::where('loan_id', $loan->id)->exists()) {
            return;
        }

        $user = User::find($loan->created_by);

        // Only DSA
        if (!$user || $user->role_id != 6) {
            return;
        }

        $config = DsaPayoutConfig::where('bank_id', $loan->bank_id)
            ->where('loan_category_id', $loan->loan_category_id)
            ->first();

        if (!$config) {
            throw new \Exception("Payout config not found");
        }

        $payoutAmount = ($loan->amount * $config->percentage) / 100;

        DsaPayout::create([
            'loan_id' => $loan->id,
            'user_id' => $user->id,
            'bank_id' => $loan->bank_id,
            'loan_category_id' => $loan->loan_category_id,
            'loan_amount' => $loan->amount,
            'percentage' => $config->percentage,
            'payout_amount' => $payoutAmount,
            'status' => 'pending',
            'disbursed_at' => now()
        ]);
    }
}