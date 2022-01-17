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
        'user_id',
    ];

    protected $table = 'meals';

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favoriteUser()
    {
        return $this->belongsToMany(User::class);
    }

    public function recettes()
    {
        return $this->hasMany(Recipe::class);
    }
}
