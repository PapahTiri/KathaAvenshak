<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GachaPrize extends Model
{
    protected $fillable = [
        'name',
        'weight',
        'type',
        'value',
    ];
}
