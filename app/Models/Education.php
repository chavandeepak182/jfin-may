<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Education extends Model
{
    use HasFactory;
    protected $table = 'education_details';
    protected $primaryKey = 'user_id';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        'loan_id', 'user_id', 'qualification', 'pass_year', 'college_name', 'college_address'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}