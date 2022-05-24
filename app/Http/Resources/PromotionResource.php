<?php

namespace App\Http\Resources;

use App\Http\Resources\Collections\WastePartCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class PromotionResource extends JsonResource
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
            'label' => $this->resource->label,
            'description' => $this->resource->description,
            'cost' => $this->resource->cost,
            'number_of_uses' => $this->resource->number_of_uses,
            'number_of_uses_remaining' => $this->resource->number_of_uses - count($this->resource->users)
        ];

        if(!$this->light) {
            $additionalData = [
                'partner' => new PartnerResource($this->resource->partner)
            ];

            $data = array_merge($data, $additionalData);
        }

        return $data;
    }
}
