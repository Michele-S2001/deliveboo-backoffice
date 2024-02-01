<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\Dish;
class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $restaurants_ids = Restaurant::pluck('id');

        $orders_name =

            ['Mario Rossi',
            'Luca Parmitano',
            'Delio Rossi',
            'Valentino Rossi',
            'Francesco Totti'];

        for ($i = 0; $i < count($orders_name); $i++) {

            // Qui prendiamo un id random tra quelli dei ristoranti
            $current_restaurant_id = $faker -> randomElement($restaurants_ids);

            // Recuperiamo QUALCOSA 😂 l'istanza del ristorante tramite id
            $current_restaurant = Restaurant::find($current_restaurant_id);

            // Recuperiamo gli id dei piatti appartenenti al current_restaurant
            $dish_ids = $current_restaurant -> dishes->pluck('id');

            // Prendiamo un numero random tra gli id dei piatti
            $dish_ids = $faker->randomElements($dish_ids, null);

            $new_order = new Order ([
                'full_name' => $orders_name[$i],
                'email' => $faker -> email(),
                'phone_number' => $faker -> phoneNumber(),
                'delivery_address' => $faker -> address(),
                'notes' => $faker ->sentence (),
                'subtotal' => 0,
                'payment_status' => 1,
            ]);

            $total = 0;

            foreach ($dish_ids as $dish_id) {
                $quantity = $faker->numberBetween(1, 4);
                $total += Dish::find($dish_id)->price * $quantity;
            }

            $new_order->subtotal = $total;
            $new_order->save();
            $new_order->dishes()->attach($dish_id, ['quantity' => $quantity]);
        }
    }

}
