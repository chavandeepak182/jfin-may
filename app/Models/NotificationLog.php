<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationLog extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'seen_by_user'
    ];

    protected $casts = [
        'seen_by_user' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
