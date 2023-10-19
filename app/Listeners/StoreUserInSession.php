<?php

namespace App\Listeners;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class StoreUserInSession
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $user = Auth::user();
        Session::put('user_id', $user->id);
    }
}
