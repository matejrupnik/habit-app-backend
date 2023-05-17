<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Habit;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return UserResource::collection(User::paginate(15));
    }

    public function show(User $user)
    {
        return UserResource::make($user);
    }

    public function show_current_user()
    {
        return UserResource::make(auth()->user());
    }

    public function habit_users(Habit $habit) {
        return UserResource::collection($habit->users()->paginate(15));
    }

    public function destroy($id) {
        $user = User::find($id);
        $user->posts()->delete();

        $user->delete();
        return response("success", 200);
    }

    public function follow(User $user, Habit $habit) {
        $user = User::find($user->id);
        $habit = Habit::find($habit->id);

        if (!$user || !$habit) {
            return response('error', 400);
        }

        $user->habits()->attach($habit);

        return response('success', 200);
    }

    public function unfollow(User $user, Habit $habit) {
        $user = User::find($user->id);
        $habit = Habit::find($habit->id);

        if (!$user || !$habit) {
            return response('error', 400);
        }

        $user->habits()->detach($habit);

        return response('success', 200);
    }
}
