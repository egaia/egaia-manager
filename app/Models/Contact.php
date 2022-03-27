<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $dates = [
        'archived_at'
    ];

    public function isArchived(): bool {
        return (bool)$this->archived_at;
    }

    public function getIsArchivedAttribute():bool {
        return $this->isArchived();
    }
}
