<?php

namespace App\Http\Requests;


class PasswordUserRequest extends JsonApiRequest {

    public function authorize():bool {
        return true;
    }

    public function rules():array {
        return [
            'password' => 'required|string|min:8|max:255'
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'Le champs mot de passe est obligatoire',
            'password.max' => 'Le champs mot de passe doit contenir au maximum 255 caractères',
            'password.min' => 'Le champs mot de passe doit contenir au minimum 8 caractères',
        ];
    }
}
