<?php

namespace App\Repositories\Waste;

use App\Models\Waste;
use App\Repositories\BaseRepository;
use Illuminate\Support\Collection;

class WasteRepositoryEloquent extends BaseRepository implements WasteRepository
{
    protected string $model = Waste::class;

    public function all(): Collection
    {
        return $this->query()->get();
    }

    public function find(int $id): Waste
    {
        return $this->query()
            ->where('id', $id)
            ->firstOrFail();
    }
}
