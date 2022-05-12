<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class WastePartResource extends JsonResource
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
            'type' => $this->resource->type,
            'trash_can' => new TrashCanResource($this->resource->trashCan)
        ];
    }
}
