<?php

namespace App\Http\Requests;

class ParticipateToChallengeRequest extends JsonApiRequest {

    public function authorize():bool {
        return true;
    }

    public function rules():array {
        return [
            'picture' => 'required|image|mimes:jpg,jpeg,png',
            'challenge_id' => 'required|integer|exists:challenges,id'
        ];
    }

    public function messages()
    {
        return [
            'picture.required' => 'Le champs picture est obligatoire',
            'picture.image' => 'Le champs picture doit être une image',
            'picture.mimes' => 'Le champs picture doit être au format jpg, jpeg ou png',
            'lastname.max' => 'Le champs nom doit contenir au maximum 255 caractères',
            'challenge_id.required' => 'Le champs challenge_id est obligatoire',
            'challenge_id.integer' => 'Le champs challenge_id doit être un entier',
            'challenge_id.exists' => 'Le champs challenge_id doit exister parmis les challenges',
        ];
    }
}
