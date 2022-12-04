<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Habit;
use App\Models\Media;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Media::factory(10)->create();
        Habit::factory(10)
            ->has(User::factory(10))
            ->create();
        Post::factory(1000)->create();
    }
}
