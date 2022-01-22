<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'number',
    ];

    protected $table = 'meals';

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
