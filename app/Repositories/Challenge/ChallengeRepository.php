<?php

namespace App\Repositories\Challenge;

use App\Models\Challenge;
use App\Models\User;
use Illuminate\Support\Collection;

interface ChallengeRepository
{
    public function getFromUser(User $user): Collection;

    public function getCurrentChallenge(): Challenge;

    public function allByMonthYear(): Collection;
}
