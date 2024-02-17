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

    public function makePayment (Request $request, Gateway $gateway) {
        
        $current_order = Order::where('id', $request->orderId)->first();

        $result = $gateway->transaction()->sale([
            'amount' => $current_order['subtotal'],
            'paymentMethodNonce' => $request->token,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {

            Order::where('id', $request->orderId)->update(['payment_status' => true]);

            $data = [
                'status' => 1,
                'success' => true,
                'message' => 'Pagamento eseguito con successo e ordine preso in carico!'
            ];

            return response()->json($data, 200);
        } else {
            $data = [
                'success' => false,
                'message' => 'Transazione Fallita!',
            ];

            return response()->json($data, 401);
        }
        
    }
}
