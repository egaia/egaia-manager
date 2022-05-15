<?php

namespace App\Repositories\CollectPoint;

use Illuminate\Support\Collection;

interface CollectPointRepository
{
    public function all(float $latitude, float $longitude): Collection;
}
