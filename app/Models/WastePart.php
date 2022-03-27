<?php

namespace App\Models;

use App\Enums\WasteType;
use App\Models\Pivots\WastePivotPart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class WastePart extends Model
{
    use HasFactory;

    protected $table = 'waste_parts';

    protected $casts = [
        'type' => WasteType::class
    ];

    public function wastes(): BelongsToMany {
        return $this->belongsToMany(Waste::class, 'waste_pivot_part')
            ->using(WastePivotPart::class);
    }

    public function trashCan(): BelongsTo {
        return $this->belongsTo(TrashCan::class);
    }
}
