<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;
    // relation between dish and restaurant
    public function restaurant (){
        return $this->belongsTo(Restaurant::class);
    }

    public function orders (){
        return $this->belongsToMany(Order::class)->withPivot('quantity');
    }

    protected $fillable = [
        'name',
        'image',
        'price',
        'description',
        'restaurant_id',
        'visibility'
    ];
}
