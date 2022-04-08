<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Pivots\ChallengeUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChallengeUserPolicy
{
    use HandlesAuthorization;

    public function viewAny(Admin $admin)
    {
        return true;
    }

    public function view(Admin $admin, ChallengeUser $challengeUser)
    {
        return true;
    }

    public function create(Admin $admin)
    {
        return false;
    }

    public function update(Admin $admin, ChallengeUser $challengeUser)
    {
        return true;
    }

    public function delete(Admin $admin, ChallengeUser $challengeUser)
    {
        return true;
    }

    public function restore(Admin $admin, ChallengeUser $challengeUser)
    {
        return true;
    }

    public function forceDelete(Admin $admin, ChallengeUser $challengeUser)
    {
        return true;
    }
}
