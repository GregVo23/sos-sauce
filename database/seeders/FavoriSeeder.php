<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FavoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $favoris = [
            [
                'meal_id' => 2,
                'user_id' => 1
            ],
            [
                'meal_id' => 1,
                'user_id' => 2
            ],
            [
                'meal_id' => 2,
                'user_id' => 2
            ],
        ];

        foreach ($favoris as $favori) {
            DB::table('meal_user')->insert([
                'meal_id' => $favori['meal_id'],
                'user_id' => $favori['user_id'],
            ]);
        }
    }
}
