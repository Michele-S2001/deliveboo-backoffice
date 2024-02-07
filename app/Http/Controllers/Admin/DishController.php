<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\StoreDishRequest;
use App\Http\Requests\Admin\UpdateDishRequest;
use Illuminate\Support\Facades\Auth;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $restaurant_id = Auth::user()->restaurant->id;
        $dishes = Dish::where('restaurant_id', $restaurant_id)->orderBy('name', 'ASC')->get();

        return view('admin.dishes.index', compact('dishes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dishes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDishRequest $request)
    {
        $data = $request->validated();

        if(!$request->has('visibility')) {
            $data['visibility'] = 0;
        }

        //salviamo l'immagine del piatto
        $img_path = Storage::put('uploads', $data['image']);
        $data['image'] = $img_path;

        //recuperiamo l'id del ristorante appartenente all'utente
        $restaurant_id = Auth::user()->restaurant->id;
        $data['restaurant_id'] = $restaurant_id;

        //salviamo il piatto
        Dish::create($data);

        return redirect()->route('admin.dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dish $dish)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dish $dish)
    {

        if (Auth::check() && Auth::user()->restaurant->id === $dish->restaurant_id) {
            return view('admin.dishes.edit', compact('dish'));
        } else {
            return redirect()->route('admin.dishes.index');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDishRequest $request, Dish $dish)
    {
        if (Auth::check() && Auth::user()->restaurant->id === $dish->restaurant_id) {
            $data = $request -> validated();

            if(!$request->has('visibility')) {
                $data['visibility'] = 0;
            }

            if ($request -> has('image')) {
                Storage::delete($dish -> image);
                $img_path = Storage::put('uploads', $data['image']);
                $data['image'] = $img_path;
            }
            $dish -> update($data);

            return redirect()->route('admin.dishes.index');
        } else {
            return redirect()->route('admin.dishes.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dish $dish)
    {

        if (Auth::check() && Auth::user()->restaurant->id === $dish->restaurant_id) {
            Storage::delete($dish->image);
            $dish->delete();
            return redirect()->route('admin.dishes.index');
        } else {
            return redirect()->route('admin.dishes.index');
        }

    }
         
}
