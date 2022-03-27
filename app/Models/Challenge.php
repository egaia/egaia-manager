<?php

namespace App\Models;

use App\Models\Pivots\ChallengeUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Challenge extends Model
{
    use HasFactory;

    protected $dates = [
        'started_at',
        'ended_at'
    ];

    public function users(): BelongsToMany {
        return $this->belongsToMany(User::class)
            ->using(ChallengeUser::class)
            ->withPivot([
                'picture',
                'valid'
            ]);
    }

    public function challengeUsers(): HasMany {
        return $this->hasMany(ChallengeUser::class);
    }
}
