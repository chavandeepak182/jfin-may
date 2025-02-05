<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Professional extends Model
{
    use HasFactory;
    protected $table = 'professional_details';
    protected $primaryKey = 'user_id';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        'user_id', 'company_name', 'industry', 'company_address', 'business_establish_date', 'experience_year', 'designation', 'netsalary', 'gross_salary', 'selfincome'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}