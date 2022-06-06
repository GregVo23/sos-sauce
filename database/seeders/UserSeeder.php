<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'last_name' => 'Van Mossel',
                'first_name' => 'Luc',
                'email' => 'jean@vanmossel.com',
                'password' => 'epfcepfc',
            ],
            [
                'last_name' => 'Epfc',
                'first_name' => 'Jean',
                'email' => 'epfc@epfc.com',
                'password' => 'epfcepfc',
            ],
        ];

        foreach ($users as $user) {
            DB::table('users')->insert([
                'last_name' => $user['last_name'],
                'first_name' => $user['last_name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
            ]);
        }
    }
}
