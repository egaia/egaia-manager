<?php

namespace App\Http\Resources\Collections;

use App\Http\Resources\CollectPointResource;
use App\Models\CollectPoint;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CollectPointCollection extends ResourceCollection
{
    private bool $light;

    public function __construct($resource, bool $light = false)
    {
        parent::__construct($resource);
        $this->light = $light;
    }

    public function toArray($request)
    {
        return $this->collection->map(function (CollectPoint $collectPoint) {
            return new CollectPointResource($collectPoint, $this->light);
        })->toArray();
    }
}
