<?php

namespace App\Http\Requests;

class UsePromotionRequest extends JsonApiRequest {

    public function authorize():bool {
        return true;
    }

    public function rules():array {
        return [
            'promotion_id' => 'required|integer|exists:promotions,id'
        ];
    }

    public function messages()
    {
        return [
            'promotion_id.required' => 'Le champs promotion_id est obligatoire',
            'promotion_id.integer' => 'Le champs promotion_id doit être un entier',
            'promotion_id.exists' => 'Le champs promotion_id doit exister parmis les promotions',
        ];
    }
}
