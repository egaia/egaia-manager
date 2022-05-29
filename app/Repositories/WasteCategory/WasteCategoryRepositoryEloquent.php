<?php

namespace App\Repositories\WasteCategory;

use App\Models\WasteCategory;
use App\Repositories\BaseRepository;
use Illuminate\Support\Collection;

class WasteCategoryRepositoryEloquent extends BaseRepository implements WasteCategoryRepository
{
    protected string $model = WasteCategory::class;

    public function all(): Collection
    {
        return $this->query()
            ->whereHas('wastes')
            ->get();
    }

    public function find(int $id): WasteCategory
    {
        return $this->query()
            ->where('id', $id)
            ->firstOrFail();
    }
}
