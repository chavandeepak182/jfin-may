<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model {
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'phone', 'alternate_phone', 'lead_source', 'campaign_name',
        'inquiry_date', 'property_type', 'budget_min', 'budget_max', 'location_preference',
        'possession_time', 'property_status', 'lead_status', 'follow_up_date', 'lead_score',
        'assigned_to', 'notes', 'lead_type', 'financing_status', 'loan_provider', 'closing_date'
    ];

    public function agent() {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
