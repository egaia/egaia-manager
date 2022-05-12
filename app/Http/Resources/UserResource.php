<?php

namespace App\Http\Resources;

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
            'email' => $this->resource->email,
            'points' => $this->resource->points,
            'apiToken' => $this->resource->api_token
        ];
    }
}
