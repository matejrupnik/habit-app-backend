<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\HabitResource;
use App\Models\Habit;
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
}
