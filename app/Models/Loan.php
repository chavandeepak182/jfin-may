<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'loans';
    protected $primaryKey = 'loan_id';

    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [
        'amount_approved' => 'integer',
    ];

    protected $fillable = [
        'loan_category_id',
        'amount',
        'tenure',
        'status',
        'referral_user_id',
        'amount_approved',
        'loan_reference_id',
        'bank_id',
        'user_id',
        'agent_id',
        'agent_action',
    ];

  public function loanCategory()
{
    return $this->belongsTo(
        LoanCategory::class,
        'loan_category_id',
        'loan_category_id'
    );
}

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function bankDetails()
    {
        return $this->belongsTo(Bank::class, 'bank_id', 'bank_id');
    }
}
