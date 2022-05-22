<?php

namespace App\Repositories\Challenge;

use App\Http\Resources\Collections\ChallengeCollection;
use App\Models\Challenge;
use App\Models\User;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
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

    public function getCurrentChallenge(): Challenge
    {
        return $this->query()
            ->where('started_at', '<=', now())
            ->where('ended_at', '>=', now())
            ->first();
    }


    public function allByMonthYear(): Collection
    {
        $date_month = $this->query()
            ->selectRaw('date_format(started_at, "%Y/%m") as date_month')
            ->groupBy('date_month')
            ->orderByDesc('date_month')
            ->get()
            ->toArray();

        $results = [];

        foreach ($date_month as $month){
            $date = Carbon::createFromFormat('Y/m', $month['date_month']);
            $month['carbon_date'] = $date;
            $month['results'] = new ChallengeCollection($this->query()
                ->whereDate('started_at', '<=', now())
                ->whereMonth('started_at', $date->month)
                ->whereYear('started_at', $date->year)
                ->orderBy('started_at')
                ->get());
            $results[] = $month;
        }

        return collect($results);
    }

}
