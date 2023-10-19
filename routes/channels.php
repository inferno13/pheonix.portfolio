<?php

use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Gate;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
 */

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat.ticket.{id}', function ($user, $id) {
    $ticket = Ticket::findOrFail($id);
    return Gate::allows('isAdmin') || (int) $user->id === (int) $ticket->user_id;
});

Broadcast::channel('notification.user.{notificationId}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
