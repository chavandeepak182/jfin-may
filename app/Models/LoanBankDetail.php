<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanBankDetail extends Model
{
    protected $table = 'loan_bank_details';

    protected $primaryKey = 'bank_id';

    public $incrementing = false; // because bank_id is int but not auto-increment in table

    protected $keyType = 'int';

    protected $fillable = [
        'bank_id',
        'acc_name',
        'acc_number',
        'ifsc_code',
        'bank_name',
        'branch_name',
        'gst_number',
        'pan_number',
        'manager_name',
        'manager_number',
        'bank_address',
    ];

    protected $casts = [
        'acc_number' => 'integer',
    ];

    /**
     * Relationship: Bank has many estimated files
     */
    public function estimatedFiles()
    {
        return $this->hasMany(EstimatedFile::class, 'bank_id', 'bank_id');
    }
}
