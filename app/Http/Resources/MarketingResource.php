<?php

namespace App\Http\Resources;

use App\Models\Campaign;
use Illuminate\Http\Resources\Json\JsonResource;

class MarketingResource extends JsonResource
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
            'first_partners_count_target' => Campaign::first_partners_count_target(),
            'second_partners_count_target' => Campaign::second_partners_count_target(),
            'first_pull_target' => Campaign::first_pull_target(),
            'second_pull_target' => Campaign::second_pull_target(),
            'first_and_second_pull_target' => Campaign::first_and_second_pull_target(),
            'user' => $this->marketing()
        ];
    }
}
