<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $table = 'documents';
    // Specify the primary key column if different from 'id'
    protected $primaryKey = 'document_id';
    // Indicate if the primary key is auto-incrementing
    public $incrementing = true;
    // If you don't want timestamps, set this to false
    public $timestamps = true;
    // Specify which attributes should be mass-assignable
    protected $fillable = [
        'loan_id',
        'user_id',
        'aadhar_card',
        'pancard',
        'age_proof',
        'residence_proof',
        'qualification_proof',
        'salary_slip',
        'form_16',
        'bank_statement',
        'file_path',
        'document_name'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
