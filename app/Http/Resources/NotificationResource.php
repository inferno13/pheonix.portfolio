<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
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
            'user_id' => $this->user_id,
            'name' => $this->name,
            'unread' => $this->unread,
            'details' => $this->getDetailsResource(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }

    public function getDetailsResource() {
        if ($this->details instanceof \App\Models\Transactions\DepositTransaction) {
            return new DepositTransactionResource($this->details);
        }
        if ($this->details instanceof \App\Models\Transactions\MarketingTransaction) {
            return new MarketingTransactionResource($this->details);
        }
        if ($this->details instanceof \App\Models\Transactions\BonusTransaction) {
            return new BonusTransactionResource($this->details);
        }
        if ($this->details instanceof \App\Models\Transactions\WithdrawTransaction) {
            return new WithdrawTransactionResource($this->details);
        }
        if ($this->details instanceof \App\Models\Transactions\TransferTransaction) {
            return new TransferTransactionResource($this->details);
        }
        if ($this->details instanceof \App\Models\Transactions\SubscriptionTransaction) {
            return new SubscriptionTransactionResource($this->details);
        }
        return null;
    }
}
