<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DailyLoginRewardLog extends Model
{
   // Tabel yang digunakan
    protected $table = 'daily_login_reward_logs';

    // Kolom yang boleh diisi mass assignment
    protected $fillable = [
        'user_id',
        'date',
        'amount',
    ];

    /**
     * Relasi ke user yang menerima reward
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
