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
        'preperation_id',
        'user_id',
    ];

    protected $table = 'sauces';

    public $timestamps = true;

    public function preperation () {
        return $this->hasOne(Preperation::class);
    }

    public function user () {
        return $this->belongsTo(User::class);
    }
}
