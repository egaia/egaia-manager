<?php

namespace App\Repositories\ChallengeUser;

use App\Models\Pivots\ChallengeUser;
use App\Models\User;

interface ChallengeUserRepository
{
    public function store(int $challenge_id, string $picturePath, User $user): ChallengeUser;
}
