<?php

namespace App\Http\Resources;

use App\Http\Resources\Collections\ChallengeCollection;
use App\Http\Resources\Collections\PromotionCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'firstname' => $this->resource->firstname,
            'lastname' => $this->resource->lastname,
            'birthdate' => $this->resource->birthdate,
            'image' => $this->resource->image ? asset('storage/'.$this->resource->image) : asset('assets/utilisateur.png'),
            'email' => $this->resource->email,
            'points' => $this->resource->points,
            'apiToken' => $this->resource->api_token,
            'historic' => $this->resource->getHistoric()
        ];
    }
}
