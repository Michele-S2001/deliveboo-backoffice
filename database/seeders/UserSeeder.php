<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Marta Scardillo',
                'email' => 'martascardillo@gmail.com',
                'password' => 'admin1234',
            ],
            [
                'name' => 'Michele Serafini',
                'email' => 'micheleserafini@gmail.com',
                'password' => 'admin1234',
            ],
            [
                'name' => 'Emiliano Aprile',
                'email' => 'emilianoaprile@gmail.com',
                'password' => 'admin1234',
            ],

            
        ];
        foreach ($users as &$user) {
            $user['password'] = Hash::make($user['password']);
        }
        DB::table('users')->insert($users);
    }
}