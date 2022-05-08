<?php

namespace App\Http\Requests;


class LoginUserRequest extends JsonApiRequest {

    public function authorize():bool {
        return true;
    }

    public function rules():array {
        return [
            'email' => 'required|max:255|email',
            'password' => 'required|string|min:8|max:255'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Le champs email est obligatoire',
            'email.max' => 'Le champs email doit contenir au maximum 255 caractères',
            'email.email' => 'Le champs email doit être au format email',
            'password.required' => 'Le champs mot de passe est obligatoire',
            'password.max' => 'Le champs mot de passe doit contenir au maximum 255 caractères',
            'password.min' => 'Le champs mot de passe doit contenir au minimum 8 caractères',
        ];
    }
}
