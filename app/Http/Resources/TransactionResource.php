<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $resource = [
            'id' => $this->id,
            'transaction_type' => $this::tableName(),
            'user' => new UserResource($this->wallet->user),
            'amount' => $this->amount,
            'status' => $this->status,
            'deposit_method' => new DepositMethodResource($this->depositMethod),
            'created_at' => $this->created_at,
        ];
        if ($this::tableName() === 'transfer_transactions') {
            $resource['recipient'] = new UserResource($this->recipient);
            $resource['sender'] = new UserResource($this->sender);
        }
        return $resource;
    }
}
