<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Board extends Model
{
    protected $fillable = [
        'name',
        'type',
    ];

    public function micro(): BelongsTo
    {
        return $this->belongsTo(Micro::class);
    }

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class);
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'typable');
    }

    public function featuredImage(): ?Image
    {
        return $this->images->firstWhere('type', Image::TYPE_FEATURED);
    }
}
