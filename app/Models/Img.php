<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Img extends Model
{
    const TYPE_ICON = 'icon';

    protected $fillable = [
        'typable_id',
        'typable_type',
        'type',
        'path',
    ];

    public function typable()
    {
        return $this->morphTo();
    }
}
