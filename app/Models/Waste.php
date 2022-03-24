<?php

namespace App\Models;

use App\Models\Pivots\WastePivotPart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Waste extends Model
{
    use HasFactory;

    protected $table = 'wastes';

    public function wasteCategory(): BelongsTo {
        return $this->belongsTo(WasteCategory::class);
    }

    public function wasteParts(): BelongsToMany {
        return $this->belongsToMany(WastePart::class)
            ->using(WastePivotPart::class);
    }
}
