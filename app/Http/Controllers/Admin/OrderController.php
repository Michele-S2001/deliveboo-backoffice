<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index() {

        $restaurant = Auth::user()->restaurant;

        $orders = Order::whereHas('dishes', function ($q) use ($restaurant) {
            $q->where('restaurant_id', $restaurant->id);
        })->with(['dishes' => function ($q) use ($restaurant) {
            $q->where('restaurant_id', $restaurant->id);
        }])->orderBy('created_at', 'desc')->get();

        return view('admin.orders.index', compact('orders'));
    }
}
