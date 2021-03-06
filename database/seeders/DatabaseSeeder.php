<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            IngredientSeeder::class,
            UserSeeder::class,
            MealSeeder::class,
            RecipeSeeder::class,
            IngredientRecipeSeeder::class,
            FavoriSeeder::class,
        ]);
    }
}
