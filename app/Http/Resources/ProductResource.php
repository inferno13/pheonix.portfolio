<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'category' => new CategoryResource($this->category),
            'version' => $this->version,
            'download_link' => $this->download_link,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'license' => $this->license,
            'currency' => $this->currency,
            'crypto' => $this->crypto,
            'index' => $this->index,
            'period' => $this->period,
            'tutorial' => $this->tutorial,
            'tech_support' => $this->tech_support,
            'marketing' => $this->marketing,
            'bonus' => $this->bonus,
            'pull' => $this->pull
        ];
    }
}
