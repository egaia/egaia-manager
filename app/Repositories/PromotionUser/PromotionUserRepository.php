<?php

namespace App\Repositories\PromotionUser;

use App\Models\Pivots\PromotionUser;
use App\Models\Promotion;
use App\Models\User;

interface PromotionUserRepository
{
    public function store(Promotion $promotion, User $user): PromotionUser;
}
