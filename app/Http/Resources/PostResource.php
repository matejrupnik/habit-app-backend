<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Route;

class PostResource extends JsonResource
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
            'caption' => $this->caption,
            'media' => MediaResource::make($this->media),
            'user' => Route::is('post', 'habit_posts', 'feed') ? UserResource::make($this->user) : null,
            'habit' => Route::is('post', 'user_posts', 'feed') ? HabitResource::make($this->habit) : null,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
