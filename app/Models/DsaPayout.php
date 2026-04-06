<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DsaPayout extends Model
{
    protected $fillable = [
        'loan_id',
        'user_id',
        'bank_id',
        'loan_category_id',
        'loan_amount',
        'percentage',
        'payout_amount',
        'status',
        'disbursed_at',
        'paid_at'
    ];

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
