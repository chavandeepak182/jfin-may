<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DsaWallet extends Model
{
    protected $table = 'dsa_wallets';

    protected $fillable = [
        'dsa_id',
        'payout_id',
        'credit',
        'debit',
        'balance',
        'remark'
    ];
}