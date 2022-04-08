<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(Admin $admin)
    {
        return true;
    }

    public function view(Admin $admin, User $user)
    {
        return true;
    }

    public function create(Admin $admin)
    {
        return false;
    }

    public function update(Admin $admin, User $user)
    {
        return true;
    }

    public function delete(Admin $admin, User $user)
    {
        return true;
    }

    public function restore(Admin $admin, User $user)
    {
        return true;
    }

    public function forceDelete(Admin $admin, User $user)
    {
        return true;
    }
}
