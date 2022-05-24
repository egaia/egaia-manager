<?php

namespace App\Repositories\ChallengeUser;

use App\Models\Challenge;
use App\Models\Pivots\ChallengeUser;
use App\Models\User;

interface ChallengeUserRepository
{
    public function store(Challenge $challenge, User $user, string $picturePath): ChallengeUser;
}
