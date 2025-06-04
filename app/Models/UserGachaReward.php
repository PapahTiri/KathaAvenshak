<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserGachaReward extends Model
{
    protected $table = 'user_gacha_rewards';

    protected $fillable = [
        'user_id',
        'gacha_prize_id',
    ];

    public function prize()
    {
        return $this->belongsTo(GachaPrize::class, 'gacha_prize_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
