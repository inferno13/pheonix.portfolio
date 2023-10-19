<?php

namespace App\Traits;

use App\Events\NotificationSent;
use App\Models\Notification;

trait CanCreateNotification
{
    use CanGetTableNameStatically;

    public static function boot()
    {
        parent::boot();
        self::created(function ($model) {
            $notification = Notification::create([
                'user_id' => $model->user->id,
                'detail_id' => $model->id,
                'detail_type' => $model::class,
                'name' => $model::tableName()
            ]);
            event(new NotificationSent($notification));
        });
    }
}
