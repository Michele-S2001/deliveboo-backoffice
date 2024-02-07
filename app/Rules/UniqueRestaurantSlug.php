<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;
use App\Models\Restaurant;

class UniqueRestaurantSlug implements Rule
{
    public function passes($attribute, $value)
    {
        // Verifica se lo slug esiste già nella tabella dei ristoranti
        return !Restaurant::where('slug', $value)->exists();
    }

    public function message()
    {
        return 'Lo slug del ristorante deve essere unico.';
    }
}
