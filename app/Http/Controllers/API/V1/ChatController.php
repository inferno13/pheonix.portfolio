<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Events\MessageSent;
use App\Models\Ticket;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth('sanctum')->user();
        return MessageResource::collection(Message::with('user')->where('user_id', $user->id)->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth('sanctum')->user();
        $ticket = Ticket::findOrFail($request['ticket_id']);
        if ($ticket->status === 'completed') {
            abort(403);
        }
        if ($ticket->user_id === $user->id) {
            $ticket->update([
                'status' => 'awaiting_support'
            ]);
        }
        else {
            $ticket->update([
                'status' => 'awaiting_user'
            ]);
        }
        $ticket->save();
        $message = Message::create([
            'ticket_id' => $ticket->id,
            'user_id' => $user->id,
            'text' => $request['text'],
        ]);
        broadcast(new MessageSent($ticket, $message))->toOthers();
        return new MessageResource($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
