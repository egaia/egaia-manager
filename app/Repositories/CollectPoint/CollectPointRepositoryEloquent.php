<?php

namespace App\Repositories\CollectPoint;

use App\Models\CollectPoint;
use App\Repositories\BaseRepository;
use Illuminate\Support\Collection;

class CollectPointRepositoryEloquent extends BaseRepository implements CollectPointRepository
{
    protected string $model = CollectPoint::class;

    public function all(float $latitude, float $longitude): Collection
    {
        return $this->query()
            ->whereRaw('ST_Distance_Sphere(point(?, ?), point(collect_points.longitude, collect_points.latitude))/1000 <= ?',
                [
                    $longitude,
                    $latitude,
                    1
                ])
            ->get();
    }
}
