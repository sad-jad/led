<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Micro extends Model
{
    protected $fillable = [
        'name',
    ];

    public function boards(): HasMany
    {
        return $this->hasMany(Board::class);
    }
}