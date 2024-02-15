<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Braintree\Gateway;
use App\Http\Requests\PaymentRequest;
use App\Models\Order;
use App\Models\Dish;
use App\Models\Restaurant;
use Braintree;
// serve per gestire data e ora corrente
use Illuminate\Support\Carbon;
// fornisce un'API per eseguire query SQL direttamente nel database utilizzando il Query Builder di Laravel 
use Illuminate\Support\Facades\DB;


class PaymentController extends Controller
{

    // generiamo il token da inviare al client dopo chiamata axios
    public function generateToken(Request $request, Gateway $gateway)
    {
        $token = $gateway->clientToken()->generate();   
        $data = [
            'token' => $token,
        ];
        return response()->json([
            'success' => true,
            'data' => $data
        ]); 
    }

    public function makePayment (Request $request) {
        
        $gateway = new Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey'),
        ]);

        $amount = $request->amount;
        $nonce = $request->payment_method_nonce;

        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
            'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {
            $transaction = $result->transaction;

            $data = $request->all();
            // da decidere qui dentro data
            $dishid = $data['itemid']; 
            $foodsqty =$data['itemqty'];

            // $current = Carbon::now();

            $order = new Order;

            $order->name = $data['full_name'];
            $order->email = $data['email'];
            $order->phone_number = $data['phone_number'];
            $order->address = $data['delivery_address'];
            $order->notes = $data['notes'];
            $order->subtotal = $data['subtotal'];
            $order->restaurant_id = $data['restaurant_id'];

            $order->payment()->associate(
                // PaymentController::(
                //     ['status' => 1],
                // )
                );

            $order = $order->save();
        }
        
    }
}
