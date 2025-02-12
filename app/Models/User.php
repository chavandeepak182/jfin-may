<?php
namespace App\Models;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\CibilScore;
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email_id',
        'password',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime'
        ];
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }
    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id');
    }
    // Define relationship with Education
    public function education()
    {
        return $this->hasOne(Education::class, 'user_id');
    }
    // Define relationship with Professional
    public function professional()
    {
        return $this->hasOne(Professional::class, 'user_id');
    }
    public function loans()
    {
        return $this->hasMany(Loan::class, 'user_id', 'id');
    }

    public function cibilScore()
    {
        return $this->hasOne(CibilScore::class);
    }
}