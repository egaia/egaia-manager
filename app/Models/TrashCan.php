<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TrashCan extends Model
{
    use HasFactory;

    protected $table = 'trash_cans';

    public function wasteParts(): HasMany {
        return $this->hasMany(WastePart::class);
    }
}
