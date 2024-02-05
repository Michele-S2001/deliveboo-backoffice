<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $users = User::all();
        $users_ids = $users->pluck('id');

        $categories = Category::all();
        $categories_ids = $categories->pluck('id');

        $restaurants = [
            [
                'name' => 'La Trattoria Ciccio',
                'address' => 'Via Santa Maria, 345',
                'vat' => '84635295843'
            ],
            [
                'name' => 'Pizzeria da Gennarino',
                'address' => 'Via I Maggio, 13',
                'vat' => '17483926574'
            ],
            [
                'name' => 'Lucky Sushi',
                'address' => 'Viale Toscana, 1234',
                'vat' => '28506756375'
            ],
            [
                'name' => 'Da Michele',
                'address' => 'Via Giacomo d\'ancona, 65',
                'vat' => '58438463529'
            ],
            [
                'name' => 'American bbq',
                'address' => 'Via emiolio, 12',
                'vat' => '17482657439'
            ],
            [
                'name' => 'Sushi mania',
                'address' => 'Viale Lombardia, 90',
                'vat' => '06756375285'
            ],
            [
                'name' => 'Pizzeria super buona',
                'address' => 'Via paolo grande, 32',
                'vat' => '84643352958'
            ],
            [
                'name' => 'Magna tutto',
                'address' => 'Via cellulare, 21',
                'vat' => '92657417483'
            ],
            [
                'name' => 'E andiamo !',
                'address' => 'Viale fois, 320',
                'vat' => '20006756375'
            ],
            [
                'name' => 'Assaporaa',
                'address' => 'Viale Puglia, 1245',
                'vat' => '22504433331'
            ],
        ];

        for ($i = 0; $i < count($users); $i++) {
            $new_restaurant = new Restaurant([
                'name' => $restaurants[$i]['name'],
                'address' => $restaurants[$i]['address'],
                'vat' => $restaurants[$i]['vat'],
                'user_id' => $users_ids[$i],
                'thumb' => 'uploads/cibo-nei-fast-food-qualità-peggiorata.jpg',
                'slug' => Str::slug($restaurants[$i]['name']),
            ]);

            $new_restaurant->save();

            $new_restaurant->categories()->attach($faker->randomElements($categories_ids, $faker->numberBetween(1, 3)));
        }
    }
}
