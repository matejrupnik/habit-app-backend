<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return UserResource::collection(User::paginate(15)); // paginate mors se narest al pa nekak filtr
    }

    public function show(User $user)
    {
        return UserResource::make($user);
    }
}
