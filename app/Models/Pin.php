<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pin extends Model
{
    protected $fillable = [
        'typeable_id',
        'typeable_type',
        'name',
        'x',
        'y',
    ];

    public function typeable()
    {
        return $this->morphTo();
    }
}
