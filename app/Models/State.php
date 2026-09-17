<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = [
        'typeable_type',
        'typeable_id',
        'name',
        'type',
    ];

    //برد
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
