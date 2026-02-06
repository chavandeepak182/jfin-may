<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


    class PropertyBooking extends Model
{
    protected $casts = [
    'offers' => 'array',
];
   protected $fillable = [
    'customer_id',
    'admin_id',
    'status',
        'customer_name',
    'customer_email',
    'customer_mobile',
    'customer_pan',

    'co_name',
    'co_email',
    'co_mobile',
    'co_employment_type',
    'co_designation',
    'co_gender',
    'co_marital_status',


    'agreement_cost',
    'commission_percentage',
    'actual_commission',

    'tds_percentage',
    'gst_percentage',
    'tds_amount',
    'gst_amount',

    'net_commission',
    'mlm_amount',

    'offer_pool',
    'final_commission',

    'offers',
    'selected_offer',

    'offer_type',
    'cashback_amount',
    'admin_furniture_amount',
    'customer_furniture_amount',
];

    public function items()
    {
        return $this->hasMany(PropertyBookingItem::class);
    }

    public function customer()
    {
        return $this->belongsTo(User::class,'customer_id');
    }
}

