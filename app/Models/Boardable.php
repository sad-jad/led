<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Boardable extends Model
{
    protected $fillable = [
        'board_id',
        'boardable_type',
        'boardable_id',
        'refable_type',
        'refable_id',
    ];
}
