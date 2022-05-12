<?php

namespace App\Http\Resources\Collections;

use App\Http\Resources\WasteCategoryResource;
use App\Models\WasteCategory;
use Illuminate\Http\Resources\Json\ResourceCollection;

class WasteCategoryCollection extends ResourceCollection
{
    private bool $light;

    public function __construct($resource, bool $light = false)
    {
        parent::__construct($resource);
        $this->light = $light;
    }

    public function toArray($request)
    {
        return $this->collection->map(function (WasteCategory $wasteCategory) {
            return new WasteCategoryResource($wasteCategory, $this->light);
        })->toArray();
    }
}
