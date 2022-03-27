<?php

namespace App\Models\Pivots;

use App\Models\Challenge;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ChallengeUser extends Pivot
{
    use HasFactory;

    protected $table = 'challenge_user';

    public function challenge(): BelongsTo {
        return $this->belongsTo(Challenge::class);
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function getIsValidAttribute() {
        return $this->valid;
    }
}
