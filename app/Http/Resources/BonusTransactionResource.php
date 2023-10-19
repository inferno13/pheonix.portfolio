<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BonusTransactionResource extends JsonResource
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
            'transaction_type' => $this::tableName(),
            'status' => $this->status,
        ];
    }
}
