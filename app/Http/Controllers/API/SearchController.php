<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Habit;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search_habits($query) {
        // ce bi se dodala searchanje userjev pa postov bi
        // loh mela pr search tri tabe al pa sectioine
        // in v vsakmu klices tuki v temu controllerju svojo
        // funkcijo naprimer search_users in search_posts
        return Habit::where('name', 'like', '%'.$query.'%')->get();
    }

    public function search_users_habits(User $user, $query) {
        $user = User::find($user->id);
        return $user->habits()->where('name', 'like', '%'.$query.'%')->get();
    }
}
