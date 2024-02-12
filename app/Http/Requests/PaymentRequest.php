<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest {
// determina se l'utente è autorizzato a fare la richiesta
    public function authorize () {
        return true;
    }

    // ottieniamo le regole di validazione da applicare alla request
    public function rules() {
        return [
            'token'=> ['required'],
        ];
    }
}

