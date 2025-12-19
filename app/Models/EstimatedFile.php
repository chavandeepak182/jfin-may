<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstimatedFile extends Model
{
    protected $fillable = [
        'report_month','app_no','los_no','bm_ch_name','sub_manager',
        'product','sub_product','customer_name','net_amt_disbursed',
        'estimate_revenue','est_net_percent','dsa_payout_percent',
        'est_dsa_payout_amt','tds','net_revenue',
        'emp_name','emp_code','dsa_name','dsa_code',
        'bank_id','source','mobile','email','pan','aadhaar'
    ];

    public function bank()
    {
        return $this->belongsTo(LoanBankDetail::class, 'bank_id');
    }
}
