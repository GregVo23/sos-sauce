<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sauce extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'picture',
        'difficulty',
        'time',
        'review',
        'taste',
        'temperature',
        'recipe_sauce_id',
        'user_id',
    ];

    protected $table = 'sauces';

    public $timestamps = true;

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function favoriteUsers()
    {
        return $this->belongsToMany(User::class);
    }

    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }
}
