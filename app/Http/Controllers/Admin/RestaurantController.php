<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRestaurantRequest;
use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.restaurants.create', compact ('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRestaurantRequest $request)
    {
        $data = $request -> validated ();
        
        // Salviamo le immagini
        $img_path = Storage::put ('uploads', $data ['thumb']);
        $data['thumb'] = $img_path;
        $data['slug'] = Str::slug($data['name']);

        //Recuperiamo utente autenticato
        $user = Auth::user();
        $data['user_id'] = $user -> id;
        
        //Salviamo il ristorante
        $new_restaurant = Restaurant::create($data);
        $new_restaurant -> categories() -> attach ($data ['categories']);

        return redirect() -> route('admin.dashboard');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
