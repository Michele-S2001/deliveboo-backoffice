<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use App\Models\Dish;
use App\Models\Order;

class OrderController extends Controller
{
    public function store(Request $request) {

        $requestData = $request->json()->all();

        $cart = $requestData['cart'];
        $customer = $requestData['customer'];

        // dd($cart, $customer);

        $dishIds = [];
            foreach($cart as $item){
            $dishIds[] = $item['id'];
        }

        $order = new Order();
        $order->full_name = $customer['name'];
        $order->email = $customer['email'];
        $order->phone_number = $customer['phone_number'];
        $order->delivery_address = $customer['address'];
        $order->notes = $customer['notes'];
        $order->subtotal = $customer['subtotal'];
        $order->payment_status = $customer['payment_status'];
        $order->save();

        foreach ($dishIds as $dishId) {
            $current_quantity = 0;
            foreach ($cart as $item) {
                if ($item['id'] == $dishId) {
                    $current_quantity = $item['quantity'];
                    break; // Esci dal loop una volta trovato il prodotto nel carrello
                }
            }
            $order->dishes()->attach($dishId, ['quantity' => $current_quantity]);
        }


        return response()->json(
            [
                'success'=> true,
                'message'=> 'Ordine Salvato',
                'orderId'=> $order->id
            ]
        );


        
    }
}
