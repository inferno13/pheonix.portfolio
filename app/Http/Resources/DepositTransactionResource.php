<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DepositTransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'dest_tag' => $this->dest_tag,
            'user' => new UserResource($this->wallet->user),
            'blockchain_hash' => $this->blockchain_hash,
            'amount' => $this->amount,
            'address' => $this->address,
            'transaction_type' => $this::tableName(),
            'deposit_method' => new DepositMethodResource($this->depositMethod),
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
