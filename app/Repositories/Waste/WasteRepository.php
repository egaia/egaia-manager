<?php

namespace App\Repositories\Waste;

use App\Models\Waste;
use Illuminate\Support\Collection;

interface WasteRepository
{
    public function all(): Collection;

    public function find(int $id): Waste;
}
