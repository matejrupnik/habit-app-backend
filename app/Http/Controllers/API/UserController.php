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
        return UserResource::collection(User::paginate(15)); // paginate mors se narest al pa nekak filtr
    }

    public function show()
    {
        return UserResource::make(auth()->user());
    }

    public function habit_users(Habit $habit) {
        return UserResource::collection($habit->users()->paginate(15));
    }
}
