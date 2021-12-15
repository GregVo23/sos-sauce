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
        'preperation_id',
        'user_id',
    ];

    protected $table = 'meals';

    public $timestamps = true;

    public function preperation () {
        return $this->hasOne(Preperation::class);
    }

    public function user () {
        return $this->belongsTo(User::class);
    }
}
