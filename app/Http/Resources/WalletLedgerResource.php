<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WalletLedgerResource extends JsonResource
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
            'transaction_type' => $this->transaction::tableName(),
            'status' => $this->transaction->status,
            'amount' => $this->amount,
            'updated_at' => $this->updated_at
        ];
    }
}
