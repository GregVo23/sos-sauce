<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $recipes = [
            [
                'ingredient_id' => 1,
                'meal_id' => 2,
                'step' => 1,
                'quantity' => 2,
                'description' => "Il faut commencer par faire bouillir de l'eau et ajouter les pâtes.",
                'picture' => "morceau.jpg",
                'time' => "6000000",

            ],
            [
                'ingredient_id' => 2,
                'meal_id' => 2,
                'step' => 2,
                'quantity' => 4,
                'description' => "Servir et ajouter le ketchup ! Bon appétit !",
                'picture' => "ketchup.jpg",
                'time' => "2000000",
            ],
        ];

        foreach ($recipes as $recipe) {
            DB::table('recipes')->insert([
                'ingredient_id' => $recipe['ingredient_id'],
                'meal_id' => $recipe['meal_id'],
                'step' => $recipe['step'],
                'quantity' => $recipe['quantity'],
                'description' => $recipe['description'],
                'time' => $recipe['time'],
            ]);
        }
    }
}
