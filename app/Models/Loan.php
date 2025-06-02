<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;
    protected $table = 'loans'; // Ensure this matches your loans table name
    protected $primaryKey = 'loan_id'; // Ensure this matches your primary key column
    protected $casts = [
        'amount_approved' => 'integer',
    ];
    protected $fillable = ['loan_category_id', 'amount', 'tenure', 'status', 'referral_user_id', 'amount_approved'];
    public function loanCategory()
    {
        return $this->belongsTo(LoanCategory::class, 'loan_category_id', 'loan_category_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_id');
    }
    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }
}
