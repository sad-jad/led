<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Board extends Model
{
    public function micro(): BelongsTo
    {
        return $this->belongsTo(Micro::class);
    }
}