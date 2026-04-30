<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DsaMonthlyPayout extends Model
{
    protected $table = 'dsa_monthly_payouts'; // optional (safe)

    protected $fillable = [
        'dsa_id',
        'month',
        'total_loans',
        'total_amount',
        'total_payout',
        'status'
    ];

    // 🔗 Relation with User (DSA)
    public function dsa()
    {
        return $this->belongsTo(User::class, 'dsa_id');
    }
}