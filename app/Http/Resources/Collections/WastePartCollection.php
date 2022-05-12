<?php

namespace App\Http\Resources\Collections;

use App\Http\Resources\WastePartResource;
use App\Models\WastePart;
use Illuminate\Http\Resources\Json\ResourceCollection;

class WastePartCollection extends ResourceCollection
{
    private bool $light;

    public function __construct($resource, bool $light = false)
    {
        parent::__construct($resource);
        $this->light = $light;
    }

    public function toArray($request)
    {
        return $this->collection->map(function (WastePart $wastePart) {
            return new WastePartResource($wastePart, $this->light);
        })->toArray();
    }
}
