<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $fillable = [
    'novel_id',
    'chapter_number',
    'title',
    'content',
    'unlock_price',
    'lock_days',
    'unlocked_manually',
    ];

    public function novel()
    {
        return $this->belongsTo(Novel::class);
    }

    public function purchasers()
    {
        return $this->belongsToMany(User::class, 'purchased_chapters');
    }

    public function hasPurchased(Chapter $chapter)
    {
        return $this->purchasedChapters->contains($chapter->id);
    }

    public function isUnlocked()
    {
        return $this->unlocked_manually || now()->diffInDays($this->created_at) >= $this->lock_days;
    }

}
