<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WithdrawTransactionResource extends JsonResource
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
            'amount' => $this->amount,
            'status' => $this->status,
            'deposit_method' => new DepositMethodResource($this->depositMethod),
            'transaction_type' => $this::tableName(),
            'user' => new UserResource($this->wallet->user),
            'address' => substr_replace($this->address, str_repeat('*', 17), 5, 23),
            'created_at' => $this->created_at
        ];
    }
}
