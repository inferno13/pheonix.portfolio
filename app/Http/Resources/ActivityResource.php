<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ActivityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($this->login_at) {
            $created_at = $this->login_at;
        }
        if ($this->logout_at) {
            $created_at = $this->logout_at;
        }
        return [
            'action' => 'authorization',
            'ip_address' => $this->ip_address,
            'user_agent' => $this->user_agent,
            'created_at' => $created_at
        ];
    }
}
