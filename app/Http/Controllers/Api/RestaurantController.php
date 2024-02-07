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

        $restaurants = null;

        if($request->has('arrOfSelectedCat')) {
            $selectedCategories = $data['arrOfSelectedCat'];
            $restaurantIds = [];

            /*Iteriamo attraverso le categorie selezionate
            e per ciascuna eseguiamo una query per ottenere
            gli ID dei ristoranti associati a quella categoria.*/
            foreach ($selectedCategories as $categoryId) {
                $restaurantsByCategory = Restaurant::whereHas('categories', function ($query) use ($categoryId) {
                    $query->where('id', $categoryId);
                })->pluck('id')->toArray();

                if (empty($restaurantIds)) {
                    $restaurantIds = $restaurantsByCategory;
                } else {
                    /*Incrociamo gli array, per ottenere gli id comuni*/
                    $restaurantIds = array_intersect($restaurantIds, $restaurantsByCategory);
                }
            }

            $restaurants = Restaurant::whereIn('id', $restaurantIds)
                ->with('categories');

        } else {
            $restaurants = Restaurant::with('categories');
        }

        $getRestaurants = $restaurants->paginate(8);

        return response()->json ([
            'success' => true,
            'results' => $getRestaurants
        ]);
    }
}
