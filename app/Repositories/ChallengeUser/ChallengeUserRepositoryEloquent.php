<?php

namespace App\Repositories\ChallengeUser;

use App\Models\Challenge;
use App\Models\Pivots\ChallengeUser;
use App\Models\User;
use App\Repositories\BaseRepository;

class ChallengeUserRepositoryEloquent extends BaseRepository implements ChallengeUserRepository
{
    protected string $model = ChallengeUser::class;

    public function store(Challenge $challenge, User $user, string $picturePath): ChallengeUser
    {
        $pathExplode = explode('/', $picturePath);
        $pictureName = $pathExplode[count($pathExplode)-1];

        $challengeUser = new ChallengeUser();
        $challengeUser->challenge()->associate($challenge);
        $challengeUser->user()->associate($user);
        $challengeUser->setAttribute('picture', $pictureName);
        $challengeUser->setAttribute('valid', false);
        $challengeUser->saveOrFail();

        return $challengeUser;
    }
}
