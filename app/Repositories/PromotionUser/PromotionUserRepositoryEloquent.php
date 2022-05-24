<?php

namespace App\Repositories\PromotionUser;

use App\Models\Pivots\PromotionUser;
use App\Models\Promotion;
use App\Models\User;
use App\Repositories\BaseRepository;

class PromotionUserRepositoryEloquent extends BaseRepository implements PromotionUserRepository
{
    protected string $model = PromotionUser::class;

    public function store(Promotion $promotion, User $user): PromotionUser
    {
        $promotionUser = new PromotionUser();
        $promotionUser->promotion()->associate($promotion);
        $promotionUser->user()->associate($user);
        $promotionUser->saveOrFail();
        return $promotionUser;
    }
}
