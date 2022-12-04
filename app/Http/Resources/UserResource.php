<?php

namespace App\Http\Resources;

use App\Models\Habit;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Route;

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
        return [
            'id' => $this->id,
            'username' => $this->username,
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'media' => MediaResource::make($this->media),
//            'posts' => Route::is('user') ? PostResource::collection($this->posts) : null,
//            'habits' => Route::is('user') ? HabitResource::collection($this->habits) : null,
            'email' => $this->email
        ];
    }
}
