<?php

namespace App\Events;

use App\Http\Resources\MessageResource;
use App\Http\Resources\TicketResource;
use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Ticket;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $ticket;
    public $message;
    
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Ticket $ticket, Message $message)
    {
        $this->ticket = new TicketResource($ticket);
        $this->message = new MessageResource($message);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('chat.ticket.' . $this->ticket->id);
    }
}
