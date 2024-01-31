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
                'address' => 'Via Santa Maria',
                'vat' => '84635295843'
            ],
            [
                'name' => 'Pizzeria da Gennarino',
                'address' => 'Via I Maggio',
                'vat' => '17483926574'
            ],
            [
                'name' => 'Lucky Sushi',
                'address' => 'Viale Toscana',
                'vat' => '28506756375'
            ],
        ];

        for ($i = 0; $i < count($users); $i++) { 
            $new_restaurant = new Restaurant([
                'name' => $restaurants[$i]['name'],
                'address' => $restaurants[$i]['address'],
                'vat' => $restaurants[$i]['vat'],
                'user_id' => $users_ids[$i],
                'slug' => Str::slug($restaurants[$i]['name']),
            ]);
            
            $new_restaurant -> save();

            $new_restaurant -> categories()->attach($faker -> randomElements($categories_ids, $faker -> numberBetween(1, 3)));
        }
    }
}
