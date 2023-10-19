<?php

namespace App\Models\Transactions;

use App\Events\Subscribed;
use App\Models\Product;

class SubscriptionTransaction extends BaseTransaction
{
    protected $fillable = [
        'product_id', 'wallet_id', 'status', 'account', 'product_key', 'amount', 'expires_at'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public static function boot()
    {
        parent::boot();
        self::created(function($model) {
            event(new Subscribed($model));
        });
    }
}
