<?php

namespace App\Http\Resources\Collections;

use App\Http\Resources\ChallengeResource;
use App\Models\Challenge;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ChallengeCollection extends ResourceCollection
{
    private bool $light;

    public function __construct($resource, bool $light = false)
    {
        parent::__construct($resource);
        $this->light = $light;
    }

    public function toArray($request)
    {
        return $this->collection->map(function (Challenge $challenge) {
            return new ChallengeResource($challenge, $this->light);
        })->toArray();
    }
}
