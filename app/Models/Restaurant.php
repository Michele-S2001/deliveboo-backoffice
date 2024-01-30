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
}
