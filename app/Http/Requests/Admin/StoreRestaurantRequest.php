<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreRestaurantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:200',
            'thumb' => 'required|file|mimes:jpg,jpeg,png,svg,tmp|max:15000',
            'address' => 'required|string|max:200',
            // verificare lunghezza partita iva
            'vat' => 'required|string|min:9|max:15',
            'categories' => 'required|exists:categories,id',
        ];
    }
}
