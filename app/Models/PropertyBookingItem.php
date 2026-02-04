<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyBookingItem extends Model
{
   protected $fillable = [
        'property_booking_id',
        'property_id'
    ];

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id', 'properties_id');
    }
}
