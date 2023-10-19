<?php

namespace App\Models\Transactions;

use App\Models\Wallet;
use App\Models\DepositMethod;

class WithdrawTransaction extends BaseTransaction
{
    protected $fillable = ['amount', 'wallet_id', 'address', 'status'];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    public function depositMethod() {
        return $this->belongsTo(DepositMethod::class);
    }
}
