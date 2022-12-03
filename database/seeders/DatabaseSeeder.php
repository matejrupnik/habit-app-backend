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
        // \App\Models\User::factory(10)->create();

        Media::query()->create([
            'file_name' => 'slika',
            'alt' => 'alt slike',
        ]);

        User::query()->create([
            'username' => 'test',
            'email' => 'test@example.com',
            'password' => Hash::make("test1234"),
            'first_name' => 'matej',
            'middle_name' => 'car',
            'last_name' => 'rupnik',
            'media_id' => 1
        ]);



        Habit::query()->create([
            'name' => 'slika',
        ])->users()->attach(1);

        Post::query()->create([
            'caption' => "test",
            'media_id' => 1,
            'user_id' => 1,
            'habit_id' => 1,
        ]);
    }
}
