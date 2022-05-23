<?php

namespace App\Repositories\ChallengeUser;

use App\Models\Pivots\ChallengeUser;
use App\Models\User;
use App\Repositories\BaseRepository;

class ChallengeUserRepositoryEloquent extends BaseRepository implements ChallengeUserRepository
{
    protected string $model = ChallengeUser::class;

    public function store(int $challenge_id, string $picturePath, User $user): ChallengeUser
    {
        $pathExplode = explode('/', $picturePath);
        $pictureName = $pathExplode[count($pathExplode)-1];

        $challengeUser = new ChallengeUser();
        $challengeUser->challenge()->associate($challenge_id);
        $challengeUser->user()->associate($user);
        $challengeUser->setAttribute('picture', $pictureName);
        $challengeUser->setAttribute('valid', false);
        $challengeUser->saveOrFail();

        return $challengeUser;
    }
}
