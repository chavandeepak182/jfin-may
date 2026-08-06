<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class LoanCategory extends Model
{
    use HasFactory;
    protected $table = 'loan_category'; // Ensure this matches your loan_category table name
    protected $primaryKey = 'loan_category_id'; // Ensure this matches your primary key column
    protected $fillable = ['category_name'];
    public $timestamps = false;
    
    public function loans()
    {
        return $this->hasMany(Loan::class, 'loan_category_id', 'loan_category_id');
    }
    public function dsaReferral()
{
    $loanCategories = LoanCategory::orderBy('category_name')->get();

    return view('leadreferral.add-lead', compact('loanCategories'));
}
}