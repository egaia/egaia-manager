<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Pivots\PromotionUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class PromotionUserPolicy
{
    use HandlesAuthorization;

    public function viewAny(Admin $admin)
    {
        return true;
    }

    public function view(Admin $admin, PromotionUser $promotionUser)
    {
        return true;
    }

    public function create(Admin $admin)
    {
        return false;
    }

    public function update(Admin $admin, PromotionUser $promotionUser)
    {
        return false;
    }

    public function delete(Admin $admin, PromotionUser $promotionUser)
    {
        return true;
    }

    public function restore(Admin $admin, PromotionUser $promotionUser)
    {
        return true;
    }

    public function forceDelete(Admin $admin, PromotionUser $promotionUser)
    {
        return true;
    }
}
