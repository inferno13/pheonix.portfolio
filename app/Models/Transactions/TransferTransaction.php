<?php

namespace App\Models\Transactions;

use App\Models\Transactions\BaseTransaction;
use App\Models\User;

class TransferTransaction extends BaseTransaction
{
    protected $fillable = [
        'sender_id', 'wallet_id', 'recipient_id', 'amount', 'status'
    ];

    public function sender() {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function recipient() {
        return $this->belongsTo(User::class, 'recipient_id');
    }
}
