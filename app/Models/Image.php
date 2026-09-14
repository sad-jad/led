<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Image extends Model
{
    protected $fillable = [
        'typable_id',
        'typable_type',
        'type',
        'path',
    ];

    public function typable(): MorphTo
    {
        return $this->morphTo();
    }
}
