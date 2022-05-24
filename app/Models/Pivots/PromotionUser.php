<?php

namespace App\Models\Pivots;

use App\Models\Promotion;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PromotionUser extends Pivot
{
    protected $table = 'promotion_user';

    public function promotion(): BelongsTo {
        return $this->belongsTo(Promotion::class);
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
