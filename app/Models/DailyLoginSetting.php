<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyLoginSetting extends Model
{
     // Tabel yang digunakan (boleh dihapus kalau nama sesuai konvensi)
    protected $table = 'daily_login_settings';

    // Kolom yang boleh diisi mass assignment
    protected $fillable = [
        'reward_amount',
    ];

    /**
     * Kembalikan array jadwal reward untuk 7 hari,
     * index mulai 1.
     */
    public function getSchedule(): array
    {
        return [
            1 => $this->reward_amount,
            2 => $this->reward_amount,
            3 => $this->reward_amount,
            4 => $this->reward_amount,
            5 => $this->reward_amount,
            6 => $this->reward_amount * 2,
            7 => $this->reward_amount * 2,
        ];
    }
}
