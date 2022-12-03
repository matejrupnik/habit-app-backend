<?php

use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\HabitController;
use App\Http\Controllers\API\PostController;
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

Route::post("/login", [AuthController::class, "login"]);
Route::post("/register", [AuthController::class, "register"]);

Route::group(['namespace' => 'API', 'middleware' => 'auth:sanctum'], function () {
    Route::post("/logout", [AuthController::class, "logout"]);

    Route::get('users', [UserController::class, 'index'])->name('users');
    Route::get('users/{user}', [UserController::class, 'show'])->name('user');

    Route::get('habits', [HabitController::class, 'index'])->name('habits');
    Route::get('habits/{habit}', [HabitController::class, 'show'])->name('habit');

    Route::get('users/{user}/posts', [PostController::class, 'index_users'])->name('user_posts');
    Route::get('habits/{habit}/posts', [PostController::class, 'index_habits'])->name('habit_posts');

    Route::get('posts/{post}', [PostController::class, 'show'])->name('post');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
