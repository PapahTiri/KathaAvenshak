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
        'views',
        'likes',
        'comments',
        'earned_coins',
    ];

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


}
