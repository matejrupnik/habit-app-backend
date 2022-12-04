<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\HabitResource;
use App\Models\Habit;
use App\Models\User;
use Illuminate\Http\Request;

class HabitController extends Controller
{
    public function index()
    {
        return HabitResource::collection(Habit::paginate(15)); // paginate mors se narest al pa nekak filtr
    }

    public function show(Habit $habit)
    {
        return HabitResource::make($habit);
    }

    public function user_habits(User $user) {
        return HabitResource::collection($user->habits()->paginate(15));
    }
}
