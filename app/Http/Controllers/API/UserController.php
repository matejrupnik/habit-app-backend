<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Habit;
use App\Models\User;
use Illuminate\Http\Request;

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
}
