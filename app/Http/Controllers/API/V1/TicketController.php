<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\TicketCloseRequest;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use App\Models\TicketCategory;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth('sanctum')->user();
        return TicketResource::collection(Ticket::where(['user_id' => $user->id])->orderBy('updated_at', 'DESC')->get());
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
        $ticket_category_id = TicketCategory::findOrFail($request['category']['value'])->id;
        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => $request['title'],
            'ticket_category_id' => $ticket_category_id,
            'description' => $request['description'],
            'status' => 'awaiting_support'
        ]);
        return new TicketResource($ticket);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new TicketResource(Ticket::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TicketCloseRequest $request, $id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->update([
            'status' => 'closed'
        ]);
        return new TicketResource($ticket);
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
