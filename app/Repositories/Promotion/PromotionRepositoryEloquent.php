<?php

namespace App\Repositories\Promotion;

use App\Models\Promotion;
use App\Repositories\BaseRepository;
use Illuminate\Support\Collection;

class PromotionRepositoryEloquent extends BaseRepository implements PromotionRepository
{
    protected string $model = Promotion::class;

    public function all(): Collection
    {
        return $this->query()
            ->orderBy('cost')
            ->get()
            ->filter(function (Promotion $promotion) {
                return count($promotion->users) < $promotion->number_of_uses;
            });
    }

    public function find(int $id): ?Promotion
    {
        return $this->query()
            ->where('id', $id)
            ->first();
    }
}
