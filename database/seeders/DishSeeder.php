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
        $restaurants_ids = $restaurants-> pluck ('id');

        for ($i = 0; $i < 10; $i++) {
            $new_dish = new Dish ([
                'name' => $faker -> sentence(2, true),
                'description' => $faker -> paragraph(3),
                'price' => $faker -> randomFloat(2, 4, 25),
                'restaurant_id' => $faker -> randomElement($restaurants_ids),
            ]);

            $new_dish -> save();
        }
    }
}
