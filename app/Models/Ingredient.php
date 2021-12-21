<?php

namespace App\Models;

use App\Models\RecipeMeal;
use App\Models\RecipeSauce;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'picture',
        'description',
        'price',
        'unit',
    ];

    protected $table = 'ingredients';

    public $timestamps = false;

    public function recipeSauces () {
        return $this->belongsToMany(RecipeSauce::class);
    }

    public function recipeMeals () {
        return $this->belongsToMany(RecipeMeal::class);
    }
}
