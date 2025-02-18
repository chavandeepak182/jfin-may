<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyTaker extends Model
{
    use HasFactory;

    protected $table = 'property_takers';
    protected $casts = [
        'agreement_date' => 'datetime',
    ];
    protected $fillable = [
        'builder_name',
        'project_name',
        'address',
        'property_type',
        'carpet_area',
        'builtup_area',
        'actual_agreement_cost',
        'gst',
        'extra_charges',
        'stamp_duty',
        'registration_fees',
        'any_other_charges',
        'total_charges',
        'source_by',
        'source_name',
        'agreement_date',
        'registration_number',
    ];
}
