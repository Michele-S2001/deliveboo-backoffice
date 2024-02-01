<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;
// relation between retaurant and user
    public function user () {
        return $this->belongsTo(User::class);
    }
// relation between retaurant and dishes
    public function dishes () {
        return $this->hasMany(Dish::class);
    } 

    public function categories (){
        return $this->belongsToMany(Category::class);
    }

    protected $fillable = [
        'name',
        'thumb',
        'address',
        'vat',
        'slug',
        'user_id'
    ];
}
