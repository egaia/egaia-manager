<?php

namespace App\Models\Pivots;

use App\Models\Waste;
use App\Models\WastePart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class WastePivotPart extends Pivot
{
    use HasFactory;

    protected $table = 'waste_pivot_part';

    public function waste(): BelongsTo {
        return $this->belongsTo(Waste::class);
    }

    public function wastePart(): BelongsTo {
        return $this->belongsTo(WastePart::class);
    }
}
