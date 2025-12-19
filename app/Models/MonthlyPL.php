<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonthlyPL extends Model
{
     protected $table = 'monthly_pls'; 
    protected $fillable = [
        'month','year','gross_revenue','insurance','revenue_total',
        'staff_cost','staff_incentive','broker_commission','salary_total',
        'rental','opex','admin_overheads',
        'cso_cost','admin_fixed_cost','travel_cost','tds','cost_total',
        'total_cost','net_profit','manager_pl','net_company'
    ];
}
