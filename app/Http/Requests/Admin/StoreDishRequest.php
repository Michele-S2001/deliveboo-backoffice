<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreDishRequest extends FormRequest
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
            'image' => 'required|file|mimes:jpg,jpeg,png,svg,tmp|max:15000',
            'description' => 'required|string|min:10|max:5000',
            'price' => 'required|decimal:2|min:0.01|max:99.99',
            'visibility' => 'boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Il campo nome è obbligatorio.',
            'name.string' => 'Il campo nome deve essere una stringa.',
            'name.max' => 'Il campo nome non può superare 200 caratteri.',
            'image.required' => 'Il campo immagine è obbligatorio.',
            'image.file' => 'Il campo immagine deve essere un file.',
            'image.mimes' => 'Il campo immagine deve essere di tipo: jpg, jpeg, png, svg, tmp.',
            'image.max' => 'Immagine non può superare 15000 kilobytes.',
            'description.required' => 'Il campo descrizione è obbligatorio.',
            'description.string' => 'Il campo descrizione deve essere una stringa.',
            'description.min' => 'Il campo descrizione deve essere di almeno 10 caratteri.',
            'description.max' => 'Il campo descrizione non può superare 5000 caratteri.',
            'price.required' => 'Il campo prezzo è obbligatorio.',
            'price.decimal' => 'Il campo prezzo deve essere un numero decimale con massimo due cifre decimali.',
            'price.min' => 'Il campo prezzo deve essere almeno 0.01.',
            'price.max' => 'Il campo prezzo non può superare 99.99.',
            'visibility.boolean' => 'Il campo visibilità deve essere vero o falso.',
        ];
    }
}
