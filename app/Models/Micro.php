<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Micro extends Model
{
    protected $fillable = [
        'name',
        'type',
    ];

    public function boards()
    {
        return $this->hasMany(Board::class);
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
