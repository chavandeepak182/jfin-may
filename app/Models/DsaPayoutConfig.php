<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DsaPayoutConfig extends Model
{
     protected $fillable = [
        'bank_id',
        'loan_category_id',
        'percentage'
    ];

    public function bank()
    {
        return $this->belongsTo(LoanBankDetail::class, 'bank_id', 'bank_id');
    }

    public function category()
    {
        return $this->belongsTo(LoanCategory::class, 'loan_category_id', 'loan_category_id');
    }
}
