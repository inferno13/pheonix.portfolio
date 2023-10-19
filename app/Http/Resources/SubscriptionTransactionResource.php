<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionTransactionResource extends JsonResource
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
            'product' => new ProductResource($this->product),
            'user' => new UserResource($this->wallet->user),
            'product_key' => $this->product_key,
            'amount' => $this->amount,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'expires_at' => $this->expires_at,
            'updated_at' => $this->updated_at
        ];
    }
}
