<?php

namespace App\Http\Requests;

class UpdateUserRequest extends JsonApiRequest {

    public function authorize():bool {
        return true;
    }

    public function rules():array {
        return [
            'firstname' => 'nullable|string|max:255',
            'lastname' => 'nullable|string|max:255',
            'birthdate' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,jpg,png',
            'email' => 'nullable|max:255|email|unique:users,email',
            'password' => 'nullable|string|min:8|max:255',
            'remove_image' => 'nullable|boolean'
        ];
    }

    public function messages()
    {
        return [
            'firstname.max' => 'Le champs prénom doit contenir au maximum 255 caractères',
            'lastname.max' => 'Le champs nom doit contenir au maximum 255 caractères',
            'image.image' => 'Le champs image doit être une image',
            'image.mimes' => 'Le champs image doit être au format jpeg, jpg ou png',
            'email.unique' => 'Cet email est déjà utilisé',
            'email.max' => 'Le champs email doit contenir au maximum 255 caractères',
            'email.email' => 'Le champs email doit être au format email',
            'password.max' => 'Le champs mot de passe doit contenir au maximum 255 caractères',
            'password.min' => 'Le champs mot de passe doit contenir au minimum 8 caractères',
        ];
    }
}
