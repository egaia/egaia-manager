<?php

namespace App\Http\Resources\Collections;

use App\Http\Resources\PromotionResource;
use App\Models\Promotion;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PromotionCollection extends ResourceCollection
{
    private bool $light;

    public function __construct($resource, bool $light = false)
    {
        parent::__construct($resource);
        $this->light = $light;
    }

    public function toArray($request)
    {
        return $this->collection->map(function (Promotion $promotion) {
            return new PromotionResource($promotion, $this->light);
        })->toArray();
    }
}
