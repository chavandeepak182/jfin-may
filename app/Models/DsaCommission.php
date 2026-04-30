<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DsaCommission extends Model
{
    protected $fillable = [
        'dsa_id','loan_id','bank_id','loan_category_id',
        'disbursed_amount','commission_percent','commission_amount',
        'status','release_amount','release_date','released_by'
    ];
}
