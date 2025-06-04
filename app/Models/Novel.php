<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Novel extends Model
{
    protected $fillable = [
        'title',
        'author',
        'sinopsis',
        'cover_image',
    ];

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

}
