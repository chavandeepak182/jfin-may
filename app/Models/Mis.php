<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mis extends Model
{
    use HasFactory;

   protected $fillable = [
    'name', 'email', 'contact', 'office_contact', 'product_type', 'bank_name',
    'occupation', 'branch_name', 'amount', 'address', 'office_address', 'city',
    'bm_name', 'login_date', 'status', 'in_principle', 'remark',
    'legal', 'valuation', 'leads', 'file_work'
];
}
