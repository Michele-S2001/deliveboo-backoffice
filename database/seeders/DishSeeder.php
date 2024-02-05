<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Dish;
use App\Models\Restaurant;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $restaurants = Restaurant::all();
        $restaurants_ids = $restaurants->pluck('id');

        foreach($restaurants_ids as $restaurant) {

            for ($i = 0; $i < 5; $i++) {
                $new_dish = new Dish ([
                    'name' => $faker -> sentence(2, true),
                    'description' => $faker -> paragraph(3),
                    'price' => $faker -> randomFloat(2, 4, 25),
                    'image' => 'uploads/placeholder-img2.png',
                    'restaurant_id' => $restaurant,
                ]);

                $new_dish -> save();
            }

        }
    }
}
