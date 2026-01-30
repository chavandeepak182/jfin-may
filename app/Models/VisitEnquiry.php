<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitEnquiry extends Model
{
    //
    protected $table = 'visit_enquiry';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'visitedate'
    ];
}
