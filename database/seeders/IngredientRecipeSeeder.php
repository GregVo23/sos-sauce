<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredientRecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ingredientRecipe = [
            [
                'recipe_id' => 2,
                'ingredient_id' => 1
            ],
            [
                'recipe_id' => 1,
                'ingredient_id' => 2
            ],
            [
                'recipe_id' => 1,
                'ingredient_id' => 1
            ],
        ];

        foreach ($ingredientRecipe as $data) {
            DB::table('ingredient_recipe')->insert([
                'recipe_id' => $data['recipe_id'],
                'ingredient_id' => $data['ingredient_id'],
            ]);
        }
    }
}
