<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeMeal extends Model
{
    use HasFactory;

    protected $fillable = [
        'ingredient_id',
        'quantity',
        'meat',
        'starchy',
    ];

    protected $table = 'recipes_meals';

    public $timestamps = false;

    public function ingredients () {
        return $this->belongsToMany(Ingredient::class);
    }
}
