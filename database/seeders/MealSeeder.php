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
                'picture' => 'stoemp.JPG',
                'difficulty' => '1',
                'time' => '12000000',
                'review' => '1',
                'taste' => 'salé',
                'temperature' => 'chaud',
                'user_id' => 1,
                'number' => 4,
            ],
            [
                'name' => 'Spaghetti ketchup',
                'description' => 'Un plat de fainéant, particulièrement dégueulasse"...',
                'picture' => 'ketchup.jpg',
                'difficulty' => '1',
                'time' => '12000000',
                'review' => '1',
                'taste' => 'salé',
                'temperature' => 'chaud',
                'user_id' => 1,
                'number' => 3,
            ],
            [
                'name' => 'Lasagne',
                'description' => 'La lasagne est un plat d\'origine italienne, a base de pâte et de sauce tomate.',
                'picture' => 'lasagne.jpg',
                'difficulty' => '1',
                'time' => '12000000',
                'review' => '1',
                'taste' => 'salé',
                'temperature' => 'chaud',
                'user_id' => 1,
                'number' => 4,
            ],
            [
                'name' => 'Chicons',
                'description' => 'Les chicons sont des dégumes originaire de Belgique, un plat typique.',
                'picture' => 'chicon.jpg',
                'difficulty' => '1',
                'time' => '12000000',
                'review' => '1',
                'taste' => 'salé',
                'temperature' => 'chaud',
                'user_id' => 1,
                'number' => 2,
            ],
            [
                'name' => 'Raviolis',
                'description' => 'Une bonne boite de raviolis, rien de pire pour un repas bien dégueulasse...',
                'picture' => 'raviolis.jpg',
                'difficulty' => '1',
                'time' => '12000000',
                'review' => '1',
                'taste' => 'salé',
                'temperature' => 'chaud',
                'user_id' => 1,
                'number' => 3,
            ],
            [
                'name' => 'Frittes',
                'description' => 'Une bonne fritte, toujours une réussite !',
                'picture' => 'frittes.jpg',
                'difficulty' => '1',
                'time' => '12000000',
                'review' => '1',
                'taste' => 'salé',
                'temperature' => 'chaud',
                'user_id' => 1,
                'number' => 1,
            ],
            [
                'name' => 'Ris de veau aux morilles',
                'description' => 'Un plat unique, à déguster sans modération !',
                'picture' => 'morilles.jpg',
                'difficulty' => '2',
                'time' => '12000000',
                'review' => '1',
                'taste' => 'salé',
                'temperature' => 'chaud',
                'user_id' => 1,
                'number' => 3,
            ],
            [
                'name' => 'Boulettes sauce tomate',
                'description' => 'Un plat facile et apprécié des enfants',
                'picture' => 'boules.jpeg',
                'difficulty' => '2',
                'time' => '10000000',
                'review' => '1',
                'taste' => 'salé',
                'temperature' => 'chaud',
                'user_id' => 1,
                'number' => 3,
            ],
            [
                'name' => 'Arancini',
                'description' => 'Les célèbres boules de riz italienne !',
                'picture' => 'arancini.jpeg',
                'difficulty' => '2',
                'time' => '18000000',
                'review' => '1',
                'taste' => 'salé',
                'temperature' => 'chaud',
                'user_id' => 1,
                'number' => 3,
            ],
            [
                'name' => 'Cerf sauce papa',
                'description' => 'Un plat digne des plus grands noms de la cuisine française !',
                'picture' => 'cerf.jpeg',
                'difficulty' => '2',
                'time' => '12000000',
                'review' => '1',
                'taste' => 'salé',
                'temperature' => 'chaud',
                'user_id' => 1,
                'number' => 3,
            ],
        ];

        foreach ($meals as $meal) {
            DB::table('meals')->insert([
                'name' => $meal['name'],
                'description' => $meal['description'],
                'slug' =>  Str::slug($meal['name'], '-'),
                'picture' => $meal['picture'],
                'difficulty' => $meal['difficulty'],
                'time' => $meal['time'],
                'review' => $meal['review'],
                'taste' => $meal['taste'],
                'temperature' => $meal['temperature'],
                'user_id' => $meal['user_id'],
                'number' => $meal['number'],
            ]);
        }
    }
}
