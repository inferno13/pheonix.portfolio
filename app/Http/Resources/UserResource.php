<?php

namespace App\Http\Resources;

use App\Models\Transactions\WithdrawTransaction;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;

class UserResource extends JsonResource
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
        $full_name = null;
        if ($this->name && $this->surname && $this->patronymic) {
            $full_name = $this->surname . ' ' . $this->name . ' ' . $this->patronymic;
        }
        $avatar = $this->getMedia('avatars')->last();
        if ($avatar) {
            $avatar = $avatar->getUrl('500x500');
        }
        else {
            $avatar = "/media/default_avatar.png";
        }
        $resource = [
            'id' => $this->id,
            'sponsor_username' => $sponsor ? User::findOrFail($sponsor->parent_id)->username : null,
            'balance' => $this->wallet->getBalanceAttribute(),
            'invite_code' => $this->invite_code,
            'transfer_address' => $this->transfer_address,
            'username' => $this->username,
            'avatar' => $avatar,
            'name' => $this->name,
            'country' => new CountryResource($this->country),
            'patronymic' => $this->patronymic,
            'full_name' => $full_name,
            'surname' => $this->name,
            'telegram' => $this->telegram->name,
            'roles' => $this->getRoleNames(),
            'email' => $this->email,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
        ];
        if (in_array('admin', $this->getRoleNames())) {
            $resource['withdraw_request_count'] = WithdrawTransaction::whereStatus('created')->count();
        }
        return $resource;
    }
}
