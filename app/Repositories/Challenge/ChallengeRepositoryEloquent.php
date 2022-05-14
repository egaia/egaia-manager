<?php

namespace App\Repositories\Challenge;

use App\Models\Challenge;
use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class ChallengeRepositoryEloquent extends BaseRepository implements ChallengeRepository
{
    protected string $model = Challenge::class;

    public function getFromUser(User $user): Collection
    {
        return $this->query()
            ->whereHas('challengeUsers', function (Builder $builder) use ($user) {
                $builder
                    ->where('valid', '=', true)
                    ->whereHas('user', function (Builder $builder) use ($user) {
                        $builder->where('id', $user->id);
                    });
            })
            ->orderByDesc('ended_at')
            ->get();
    }
}
