<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habit extends Model
{
    use HasFactory;
    protected $table = 'habits';
    protected $fillable = [
        "id",
        "name",
        "created_at",
        "updated_at"
    ];

    public function users() {
        return $this->belongsToMany(User::class);
    }

    public function posts() {
        return $this->hasMany(Post::class);
    }
}
