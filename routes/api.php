<?php

use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\HabitController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\SearchController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['namespace' => 'API', 'middleware' => ['guest', 'cors']], function () {
    Route::get('clear/route', [AuthController::class, 'clear_route']);
    Route::post("login", [AuthController::class, "login"]);
    Route::post("/register", [AuthController::class, "register"]);
});

Route::group(['namespace' => 'API', 'middleware' => ['auth:sanctum', 'cors']], function () {
    Route::post("logout", [AuthController::class, "logout"]);

    Route::get('feed', [PostController::class, 'feed'])->name('feed');

    Route::get('users', [UserController::class, 'index'])->name('users');
    Route::get('users/{user}', [UserController::class, 'show'])->name('user');
    Route::get('user', [UserController::class, 'show_current_user'])->name('current_user');
    Route::get('users/{user}/habits', [HabitController::class, 'user_habits'])->name('user_habits');
    Route::get('user/habits', [HabitController::class, 'current_user_habits'])->name('current_user_habits');
    Route::delete('users/{user}', [UserController::class, 'destroy']);

    Route::post('users/{user}/follow/{habit}', [UserController::class, 'follow']);
    Route::post('users/{user}/unfollow/{habit}', [UserController::class, 'unfollow']);

    Route::get('habits', [HabitController::class, 'index'])->name('habits');
    Route::get('habits/{habit}', [HabitController::class, 'show'])->name('habit');
    Route::delete('habits/{habit}', [HabitController::class, 'destroy']);

    Route::get('users/{user}/posts', [PostController::class, 'index_users'])->name('user_posts');
    Route::get('habits/{habit}/posts', [PostController::class, 'index_habits'])->name('habit_posts');
    Route::get('habits/{habit}/users', [UserController::class, 'habit_users'])->name('habit_users');

    Route::get('posts/{post}', [PostController::class, 'show'])->name('post');
    Route::delete('posts/{post}', [PostController::class, 'destroy']);
    Route::post('posts/create', [PostController::class, 'create']);
    Route::post('posts/{post}', [PostController::class, 'update']);

    Route::get('habits/search/{query}', [SearchController::class, 'search_habits'])->name('search_habits');
    Route::get('users/{user}/habits/search/{query}', [SearchController::class, 'search_users_habits'])->name('search_users_habits');
});


