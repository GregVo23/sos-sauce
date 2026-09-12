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
            CategorySeeder::class,
            IngredientSeeder::class,
            UserSeeder::class,
            MealSeeder::class,
            RecipeSeeder::class,
            IngredientRecipeSeeder::class,
            FavoriSeeder::class,
        ]);
    }
}
