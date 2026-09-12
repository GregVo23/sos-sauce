<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Entrée',
            'Plat principal',
            'Dessert',
            'Sauce',
            'Accompagnement',
            'Apéritif',
            'Végétarien',
            'Soupe',
        ];

        foreach ($categories as $name) {
            DB::table('categories')->insert([
                'name' => $name,
                'slug' => Str::slug($name, '-'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
