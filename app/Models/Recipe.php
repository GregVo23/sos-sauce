<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * A recipe is composed by one or many steps
 * 
 */
class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'ingredient_id',
        'quantity',
        'picture',
        'meal_id',
        'step',
        'description',
        'time',
    ];

    protected $table = 'recipes';

    public $timestamps = false;

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class);
    }

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }
}
