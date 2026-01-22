<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    use HasFactory;

    protected $table = 'otp';
    protected $primaryKey = 'otp_id';

    protected $fillable = [
        'user_id',
        'otp',
        'is_verify',
        'session_id',
        'expires_at',   // ✅ ADD THIS
    ];

    protected $casts = [
        'expires_at' => 'datetime', // ✅ ADD THIS
    ];

    public $timestamps = true;
}
