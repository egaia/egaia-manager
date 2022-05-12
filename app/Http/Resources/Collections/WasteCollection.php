<?php

namespace App\Http\Resources\Collections;

use App\Http\Resources\WasteResource;
use App\Models\Waste;
use Illuminate\Http\Resources\Json\ResourceCollection;

class WasteCollection extends ResourceCollection
{
    private bool $light;

    public function __construct($resource, bool $light = false)
    {
        parent::__construct($resource);
        $this->light = $light;
    }

    public function toArray($request)
    {
        return $this->collection->map(function (Waste $waste) {
            return new WasteResource($waste, $this->light);
        })->toArray();
    }
}
