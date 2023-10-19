<?php

namespace App\Models\Transactions;

use App\Contracts\WalletTransaction;
use App\Models\Wallet;
use App\Traits\CanCreateNotification;
use App\Traits\CanGetTableNameStatically;
use Illuminate\Database\Eloquent\Model;
use App\Models\Notification;
use App\Events\NotificationSent;

class BaseTransaction extends Model implements WalletTransaction
{
    use CanGetTableNameStatically;
    use CanCreateNotification;

    public static function boot()
    {
        parent::boot();
        self::created(function ($model) {
            $notification = Notification::create([
                'user_id' => $model->user()->id,
                'detail_id' => $model->id,
                'detail_type' => $model::class,
                'name' => $model::tableName()
            ]);
            event(new NotificationSent($notification));
        });
    }

    public static function getDeclaredClasses() {
        return get_declared_classes();
    }
    
    public function getAmount()
    {
        return $this->amount;
    }

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    public function user()
    {
        return $this->wallet->user()->first();
    }
}
