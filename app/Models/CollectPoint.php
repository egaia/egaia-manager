<?php

namespace App\Models;

use App\Enums\WasteType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollectPoint extends Model
{
    use HasFactory;

    protected $table = 'collect_points';

    protected $casts = [
        'type' => WasteType::class
    ];
}
