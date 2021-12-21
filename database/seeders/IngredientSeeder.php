<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ingredients = [
            [
                'name' => 'carotte',
                'description' => 'La carotte est un légume-racine, généralement de couleur orange, bien qu\'il existe des cultivars violets, noirs, rouges, blancs et jaunes, qui sont tous des formes domestiquées de la carotte sauvage, Daucus carota, originaire d\'Europe et d\'Asie du Sud-Ouest.',
                'picture' => 'carotte.jpg',
                'unit' => 'pièce'
            ],
            [
                'name' => 'banane',
                'description' => 'Une banane est un fruit comestible allongé – botaniquement une baie – produit par plusieurs sortes de grandes plantes à fleurs herbacées du genre Musa. Dans certains pays, les bananes utilisées pour la cuisson peuvent être appelées « plantains », ce qui les distingue des bananes dessert.',
                'picture' => 'banane.jpg',
                'unit' => 'pièce'
            ]
        ];

        foreach ($ingredients as $ingredient) {
            DB::table('ingredients')->insert([
                'name' => $ingredient['name'],
                'description' => $ingredient['description'],
                'picture' => $ingredient['picture'],
                'unit' => $ingredient['unit'],
            ]);
        }
    }
}
