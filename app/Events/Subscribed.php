<?php

namespace App\Events;
use Illuminate\Queue\SerializesModels;

class Subscribed
{
    use SerializesModels;

    public $subscription;

    public function __construct($subscription)
    {
        $this->subscription = $subscription;
    }
}
