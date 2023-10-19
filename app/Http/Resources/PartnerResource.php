<?php

namespace App\Http\Resources;

use App\Models\Partner;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PartnerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $activation_date = $this
            ->child
            ->wallet
            ->subscriptionTransactions()
            ->whereMonth('created_at', Carbon::now()->month)
            ->first();
        return [
            'id' => $this->id,
            'partner' => new UserResource($this->child),
            'level' => $this->level,
            'created_at' => $this->created_at,
            'activation_date' => $activation_date ? $activation_date->created_at : null,
            'count' => Partner::where('parent_id', $this->child->id)->count()
        ];
    }
}
