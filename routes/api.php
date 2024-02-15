<?php

use App\Http\Controllers\Api\RestaurantController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\DishController;
use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PaymentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/restaurants', [RestaurantController::class, 'index']);
Route::get('/restaurants/{restaurant:slug}', [RestaurantController::class, 'show']);

Route::get('/categories', [CategoryController::class, 'index']);

Route::get('/dishes', [DishController::class, 'index']);

Route::get('/payment/token', [PaymentController::class, 'generateToken']);
Route::post('/payment/process', [PaymentController::class, 'makePayment']);
    