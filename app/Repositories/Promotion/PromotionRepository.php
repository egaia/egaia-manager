<?php

namespace App\Repositories\Promotion;

use App\Models\Promotion;
use Illuminate\Support\Collection;

interface PromotionRepository
{
    public function all(): Collection;

    public function find(int $id): ?Promotion;
}
