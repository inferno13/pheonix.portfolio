<?php

namespace App\Http\Resources;

use App\Models\Partner;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $sponsor = $this->sponsor;
        return [
            'username' => $this->username,
            'balance' => $this->wallet->balance,
            'email' => $this->email,
            'name' => $this->name,
            'surname' => $this->surname,
            'patronymic' => $this->patronymic,
            'invite_code' => $this->invite_code,
            'sponsor_username' => $sponsor ? User::findOrFail($sponsor->parent_id)->username : null,
            'email' => $this->email,
        ];
    }
}
