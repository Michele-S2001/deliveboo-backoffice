<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;

class RestaurantController extends Controller
{
    public function index () {
        // da fare filtro per le tipologie
        $restaurants = Restaurant::all();

        return response () -> json ([
            'success' => true,
            'result' => $restaurants,
        ]);
    }
}
