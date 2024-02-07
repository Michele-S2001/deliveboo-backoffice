<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use Illuminate\Support\Facades\DB;

class RestaurantController extends Controller
{
    public function index (Request $request) {

        $data = $request->validate([
            'arrOfSelectedCat' => "nullable|exists:categories,id"
        ]);

        /*if($request->has('arrOfSelectedCat')) {
            //$query
        } else {
            $query = Restaurant::with('type');
        }

        $restaurants = $query->paginate(6);

        return response()->json ([
            'success' => true,
            'results' => $restaurants
        ]); */

        $restaurants = Restaurant::with('categories')->paginate(8);

        return response()->json ([
            'success' => true,
            'results' => $restaurants,
            'richiesta' => $data
        ]);
    }
}
