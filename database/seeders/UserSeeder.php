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
                'email' => 'serafini.michele01@gmail.com',
                'password' => 'admin1234',
            ],
            [
                'name' => 'Emiliano Aprile',
                'email' => 'emilianoaprile@gmail.com',
                'password' => 'admin1234',
            ],
            [
                'name' => 'Debora Chiarelli',
                'email' => 'deborachiarelli@gmail.com',
                'password' => 'admin1234',
            ],
            [
                'name' => 'Gianfranco Piersanti',
                'email' => 'gianfrancopiersanti@gmail.com',
                'password' => 'admin1234',
            ],
            [
                'name' => 'Francesco Franco',
                'email' => 'francescofranco@gmail.com',
                'password' => 'admin1234',
            ],
            [
                'name' => 'Marco Tonnarelli',
                'email' => 'marcotonnarelli@gmail.com',
                'password' => 'admin1234',
            ],
            [
                'name' => 'Steve Jobs',
                'email' => 'stevejobs@gmail.com',
                'password' => 'admin1234',
            ],
            [
                'name' => 'Alessandro Magno',
                'email' => 'alessandromagno@gmail.com',
                'password' => 'admin1234',
            ],
            [
                'name' => 'Giuseppe Sedano',
                'email' => 'giuseppesedano@gmail.com',
                'password' => 'admin1234',
            ]
        ];
        foreach ($users as &$user) {
            $user['password'] = Hash::make($user['password']);
        }
        DB::table('users')->insert($users);
    }
}
