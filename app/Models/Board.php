<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    protected $fillable = [
        'name',
        'type',
        'micro_id',
    ];

    public function micro()
    {
        return $this->belongsTo(Micro::class);
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }

    //عکس
    public function imgs()
    {
        return $this->morphMany(Img::class, 'typable');
    }

    public function icon()
    {
        return $this->imgs->firstWhere('type', Img::TYPE_ICON);
    }
}
