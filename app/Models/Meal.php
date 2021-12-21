<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'picture',
        'difficulty',
        'time',
        'review',
        'taste',
        'temperature',
        'recipe_meal_id',
        'user_id',
    ];

    protected $table = 'meals';

    public $timestamps = true;

    public function preperations()
    {
        return $this->hasMany(Preperation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favoriteUser()
    {
        return $this->belongsToMany(User::class);
    }
}
