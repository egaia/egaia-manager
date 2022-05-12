<?php

namespace App\Http\Resources;

use App\Http\Resources\Collections\WasteCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class WasteCategoryResource extends JsonResource
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
        $data = [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'image' => asset('storage/'.$this->resource->image)
        ];

        if(!$this->light) {
            $additionalData = [
                'wastes' => new WasteCollection($this->resource->wastes, true)
            ];

            $data = array_merge($data, $additionalData);
        }

        return $data;
    }
}
