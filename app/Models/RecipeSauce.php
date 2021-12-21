<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeSauce extends Model
{
    use HasFactory;

    protected $fillable = [
        'ingredient',
        'quantity',
    ];

    protected $table = 'recipe_sauces';

    public $timestamps = false;

    public function ingredients () {
        return $this->belongsToMany(Ingredient::class);
    }
}
