<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preperation extends Model
{
    use HasFactory;

    protected $fillable = [
        'steps',
        'preperation',
        'time',
        'picture',
        'sauce_id',
        'meal_id',
    ];

    protected $table = 'preperations';

    public $timestamps = false;

    public function meal()
    {
        return $this->belongsTo(Meal::class);
    }

    public function sauce()
    {
        return $this->belongsTo(Sauce::class);
    }
}
