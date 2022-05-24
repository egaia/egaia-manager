<?php

namespace App\Models;

use App\Models\Pivots\PromotionUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Promotion extends Model
{
    use HasFactory;

    public function partner(): BelongsTo {
        return $this->belongsTo(Partner::class);
    }

    public function users(): BelongsToMany {
        return $this->belongsToMany(User::class, 'promotion_user');
    }

    public function promotionUsers(): HasMany {
        return $this->hasMany(PromotionUser::class);
    }
}
