<?php

namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonusTransaction extends BaseTransaction
{
    use HasFactory;
    protected $fillable = ['status', 'amount', 'wallet_id'];
}
