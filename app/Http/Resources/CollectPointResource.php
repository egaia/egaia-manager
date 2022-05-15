<?php

namespace App\Http\Resources;

use App\Http\Resources\Collections\WastePartCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CollectPointResource extends JsonResource
{
    private bool $light;

    public function __construct($resource, bool $light = false)
    {
        parent::__construct($resource);
        $this->light = $light;
    }

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
            'name' => $this->resource->name,
            'address' => $this->resource->address,
            'latitude' => $this->resource->latitude,
            'longitude' => $this->resource->longitude,
            'type' => $this->resource->type,
            'custom' => $this->resource->custom,
        ];
    }
}
