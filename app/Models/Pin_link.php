<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pin_link extends Model
{
    protected $fillable = [
        'boardable_id',
        'typeable_id',
        'name',
        'type',
    ];

}
