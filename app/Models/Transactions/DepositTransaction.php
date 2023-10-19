<?php

namespace App\Models\Transactions;

use App\Models\DepositMethod;

class DepositTransaction extends BaseTransaction
{
    protected $fillable = [
        'westwallet_id', 'wallet_id', 'amount', 'address',
        'dest_tag', 'blockchain_hash', 'deposit_method_id', 'status'
    ];

    public function depositMethod() {
        return $this->belongsTo(depositMethod::class);
    }
}
