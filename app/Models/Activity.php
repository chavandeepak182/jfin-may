<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activity'; // ⚠️ change if your table name is different

    protected $fillable = [
        'user_id',
        'details'
    ];
}