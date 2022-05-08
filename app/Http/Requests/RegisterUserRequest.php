<?php

namespace App\Http\Requests;

class RegisterUserRequest extends JsonApiRequest {

    public function authorize():bool {
        return true;
    }

    public function rules():array {
        return [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'email' => 'required|max:255|email|unique:users,email',
            'password' => 'required|string|min:8|max:255',
        ];
    }

    public function messages()
    {
        return [
            'firstname.required' => 'Le champs prénom est obligatoire',
            'firstname.max' => 'Le champs prénom doit contenir au maximum 255 caractères',
            'lastname.required' => 'Le champs nom est obligatoire',
            'lastname.max' => 'Le champs nom doit contenir au maximum 255 caractères',
            'birthdate.required' => 'Le champs date de naissance est obligatoire',
            'email.required' => 'Le champs email est obligatoire',
            'email.unique' => 'Cet email est déjà utilisé',
            'email.max' => 'Le champs email doit contenir au maximum 255 caractères',
            'email.email' => 'Le champs email doit être au format email',
            'password.required' => 'Le champs mot de passe est obligatoire',
            'password.max' => 'Le champs mot de passe doit contenir au maximum 255 caractères',
            'password.min' => 'Le champs mot de passe doit contenir au minimum 8 caractères',
        ];
    }
}
