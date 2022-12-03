<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Habit;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index_users(User $user)
    {
        return PostResource::collection($user->posts);
    }

    public function index_habits(Habit $habit)
    {
        return PostResource::collection($habit->posts);
    }

    public function show(Post $post)
    {
        return PostResource::make($post);
    }
}
