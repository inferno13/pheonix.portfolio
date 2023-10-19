<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
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
            'next' => $this->next,
            'is_unlocked' => $this->is_unlocked,
            'number' => $this->number,
            'duration' => $this->video->duration,
            'src' => $this->video->src,
            'poster' => $this->video->poster,
            'title' => $this->video->title,
            'description' => $this->video->description
        ];
    }
}
