<?php

namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class MarketingTransaction extends BaseTransaction
{
    use HasFactory;
    protected $fillable = ['amount', 'status', 'wallet_id'];
}
