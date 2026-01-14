<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'ticket_no','user_id','loan_id','agent_id','subject','status','priority'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function loan()
    {
        return $this->belongsTo(Loan::class,'loan_id','loan_id');
    }

    public function agent()
    {
        return $this->belongsTo(User::class,'agent_id');
    }

    public function messages()
    {
        return $this->hasMany(TicketMessage::class);
    }
}

