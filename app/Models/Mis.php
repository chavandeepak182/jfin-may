<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mis extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'contact', 'product_type', 'amount', 'address', 'city', 'office_address', 'office_contact', 'bank_name', 'branch_name', 'occupation'
    ];
}
