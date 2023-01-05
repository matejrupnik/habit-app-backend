<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Habit;
use App\Models\Media;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function feed() {
        $habits = auth()->user()->habits()->get();
        $habits_ids  = $habits->map(function ($habit) {
            return $habit->id;
        });
        return PostResource::collection(
            Post::whereIn('habit_id', $habits_ids)
                ->orderBy('created_at', 'desc')
                ->paginate(15)
        );
    }

    public function index_users(User $user)
    {
        return PostResource::collection($user->posts()->paginate(15));
    }

    public function index_habits(Habit $habit)
    {
        return PostResource::collection($habit->posts()->paginate(15));
    }

    public function show(Post $post)
    {
        return PostResource::make($post);
    }

    public function create(Request $request) {
        $request->validate([
            "caption" => "string",
            "habit_id" => "required|int",
            "media" => "required|mimes:jpg,jpeg,png"
            ]);

        $media_name = time()."-".auth()->id().".".$request->media->extension();
        $request->media->move(storage_path('app/public/media/'), $media_name);

        $media = Media::create([
            'file_name' => $media_name,
            'alt' => $request->caption
        ]);

        return Post::create([
            "caption" => $request->caption,
            "user_id" => auth()->id(),
            "habit_id" => $request->habit_id,
            "media_id" => $media->id
        ]);
    }

    public function destroy($id) {
        return Post::destroy($id);
    }

    public function update(Request $request, $post) {
        $post = Post::find($post->id);
        $post->update($request->all());
        return $post;
    }
}
