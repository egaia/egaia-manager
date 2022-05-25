<?php

namespace App\Models;

use App\Models\Pivots\ChallengeUser;
use App\Models\Pivots\PromotionUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'birthdate' => 'date',
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
    ];

    public function challenges(): BelongsToMany {
        return $this->belongsToMany(Challenge::class)
            ->using(ChallengeUser::class)
            ->withPivot([
                'picture',
                'valid'
            ]);
    }

    public function challengeUsers(): HasMany {
        return $this->hasMany(ChallengeUser::class);
    }

    public function promotions(): BelongsToMany {
        return $this->belongsToMany(Promotion::class)
            ->using(PromotionUser::class);
    }

    public function promotionUsers(): HasMany {
        return $this->hasMany(PromotionUser::class);
    }

    public function getHistoric(): array {
        $historic = [];

        foreach ($this->challengeUsers as $challengeUser) {
            $historic[] = [
                'id' => $challengeUser->challenge->id,
                'label' => $challengeUser->challenge->title,
                'type' => 'challenge',
                'points' => $challengeUser->challenge->points,
                'date' => $challengeUser->created_at
            ];
        }

        foreach ($this->promotionUsers as $promotionUser) {
            $historic[] = [
                'id' => $promotionUser->promotion->id,
                'label' => $promotionUser->promotion->partner->name.': '.$promotionUser->promotion->label,
                'type' => 'promotion',
                'points' => $promotionUser->promotion->cost,
                'date' => $promotionUser->created_at
            ];
        }

        return collect($historic)->sortByDesc('date')->toArray();
    }
}
