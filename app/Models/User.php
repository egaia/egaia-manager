<?php

namespace App\Models;

use App\Models\Pivots\ChallengeUser;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
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
}
