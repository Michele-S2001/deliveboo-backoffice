<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDishRequest extends FormRequest
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
            'image' => 'file|mimes:jpg,jpeg,png,svg,tmp|max:15000',
            'description' => 'required|string|min:10|max:5000',
            'price' => 'required|decimal:2|min:1.00|max:99.99',
            'visibility' => 'boolean'
        ];
    }
}
