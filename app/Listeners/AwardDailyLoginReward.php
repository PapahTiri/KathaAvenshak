<?php

namespace App\Listeners;

use App\Models\DailyLoginRewardLog;
use App\Models\DailyLoginSetting;
use Carbon\Carbon;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AwardDailyLoginReward
{
    // /**
    //  * Create the event listener.
    //  */
    // public function __construct()
    // {
    //     //
    // }

    /**
     * Handle the event.
     */
  public function handle(Login $event): void
    {
        $user  = $event->user;
        $today = Carbon::today();

        // Reset cycle jika sudah lewat 7 hari sejak start
        if (! $user->login_streak_start ||
            $today->diffInDays(Carbon::parse($user->login_streak_start)) >= 7
        ) {
            $user->login_streak_start = $today;
            $user->login_streak_count = 0;
        }

        // Cek apakah user sudah klaim reward hari ini
        if (DailyLoginRewardLog::where('user_id', $user->id)
            ->where('date', $today->toDateString())
            ->exists()
        ) {
            return;
        }

        // Hitung hari ke-n (1–7)
        $dayIndex = min($user->login_streak_count + 1, 7);

        // Ambil setting (asumsi 1 record)
        $setting = DailyLoginSetting::first();
        if (! $setting) {
            return;
        }

        // Tentukan reward berdasarkan hari ke-n
        $schedule = $setting->getSchedule(); // method baru, lihat model
        $amount   = $schedule[$dayIndex] ?? $setting->reward_amount;

        // Simpan log dan update user
        DailyLoginRewardLog::create([
            'user_id' => $user->id,
            'date'    => $today->toDateString(),
            'amount'  => $amount,
        ]);

        $user->coins += $amount;
        $user->login_streak_count = $dayIndex;
        $user->save();

        // Flash notification
        session()->flash('success', "Kamu mendapat {$amount} koin untuk login hari ke-{$dayIndex}!");
    }
}
