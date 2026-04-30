<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DsaCustomer extends Model
{
    protected $table = 'dsa_customers';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'dsa_id',
        'name',
        'mobile_no',
        'email',
        'password',
        'dob',
        'address',
        'state_id',
        'city_id',
        'pincode',
        'pan_no',
        'status',
        'user_id'
    ];

    /* ==============================
       RELATIONSHIPS
    ============================== */

    // 🔹  with users table
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // 🔹 DSA (agent) relation
    public function dsa()
    {
        return $this->belongsTo(User::class, 'dsa_id', 'id');
    }

    // 🔹 State relation
    public function state()
    {
        return $this->belongsTo(States::class, 'state_id', 'id');
    }

    // 🔹 City relation
    public function city()
    {
        return $this->belongsTo(Cities::class, 'city_id', 'id');
    }

    // 🔹 Loans (optional but useful)
    public function loans()
    {
        return $this->hasMany(Loan::class, 'user_id', 'user_id');
    }
}