<?php

namespace App\Repositories\WasteCategory;

use App\Models\WasteCategory;
use Illuminate\Support\Collection;

interface WasteCategoryRepository
{
    public function all(): Collection;

    public function find(int $id): WasteCategory;
}
