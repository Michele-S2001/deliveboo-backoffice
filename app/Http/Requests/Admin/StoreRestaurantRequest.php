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

    public function messages(): array
    {
        return [
            'name.required' => 'Il campo nome è obbligatorio.',
            'name.string' => 'Il campo nome deve essere una stringa.',
            'name.max' => 'Il campo nome non può superare 200 caratteri.',
            'thumb.required' => 'Il campo immagine è obbligatorio.',
            'thumb.file' => 'Il campo immagine deve essere un file.',
            'thumb.mimes' => 'Il campo immagine deve essere di tipo: jpg, jpeg, png, svg, tmp.',
            'thumb.max' => 'Immagine non può superare 15000 kilobytes.',
            'address.required' => 'Il campo indirizzo è obbligatorio.',
            'address.string' => 'Il campo indirizzo deve essere una stringa.',
            'address.max' => 'Il campo indirizzo non può superare 200 caratteri.',
            'vat.required' => 'Il campo partita IVA è obbligatorio.',
            'vat.string' => 'Il campo partita IVA deve essere una stringa.',
            'vat.min' => 'Il campo partita IVA deve essere di almeno 9 caratteri.',
            'vat.max' => 'Il campo partita IVA non può superare 15 caratteri.',
            'categories.required' => 'Il campo categorie è obbligatorio.',
            'categories.exists' => 'La categoria selezionata non esiste.',
        ];
    }
}
