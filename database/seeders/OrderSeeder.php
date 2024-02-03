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

            // Recuperiamo l'istanza del ristorante tramite id
            $current_restaurant = Restaurant::find($faker->randomElement($restaurants_ids));

            // Prendo un numero casuale tra gli id dei piatti associati
            $all_dish_ids = $current_restaurant->dishes->pluck('id');
            $rdm_dish_ids = $faker->randomElements($all_dish_ids, null);

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
            $quantities = [];

            foreach ($rdm_dish_ids as $dish_id) {
                $quantity = $faker->numberBetween(1, 4);
                array_push($quantities, $quantity);
                $total += Dish::find($dish_id)->price * $quantity;
            }

            $new_order->subtotal = $total;
            $new_order->save();

            /**
             * relazione 'ordine-id' - 'piatto-id' - 'quantità'
             */
            for($i = 0; $i < count($rdm_dish_ids); $i++) {
                $currDishId = $rdm_dish_ids[$i];
                $currQuantity = $quantities[$i];
                $new_order->dishes()->attach($currDishId, ['quantity' => $currQuantity]);
            }
        }
    }

}
