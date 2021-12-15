<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $meals = [
            [
                'name' => 'Stoemp',
                'description' => 'Une purée de carottes et pommes de terre, il s\'agit d\'un plat typique "belge"...',
                'picture' => 'stoemp.jpeg',
                'difficulty' => '1',
                'time' => '12000000',
                'review' => '1',
                'taste' => 'salé',
                'temperature' => 'chaud',
                'recipe_meal_id' => null,
                'preparation_id' => null,
                'user_id' => 1,
            ],
        ];

        foreach ($meals as $meal) {
            DB::table('meals')->insert([
                'name' => $meal['name'],
                'description' => $meal['description'],
                'slug' =>  Str::slug($meal['name'],'-'),
                'picture' => $meal['picture'],
                'difficulty' => $meal['difficulty'],
                'time' => $meal['time'],
                'review' => $meal['review'],
                'taste' => $meal['taste'],
                'temperature' => $meal['temperature'],
                //'recipe_meal_id' => $meal['recipe_meal_id'],
                //'preparation_id' => $meal['preparation_id'],
                'user_id' => $meal['user_id'],
            ]);
        }
    }
}
