<?php

namespace App\Http\Controllers;

use App\Models\DailyLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class claimDailyReward extends Controller
{
   public function claim(Request $request)
    {
        $user = $request->user();
        $day = (int) $request->input('day');
        $today = Carbon::today();

        // Cek apakah sudah klaim hari ke-X sebelumnya (tidak hanya hari ini)
        $alreadyClaimed = DailyLogin::where('user_id', $user->id)
            ->where('day', $day)
            ->exists();

        if ($alreadyClaimed) {
            return response()->json([
                'success' => false,
                'message' => 'Reward hari ke-' . $day . ' sudah diklaim.'
            ], 400);
        }

        // Simpan klaim reward
        DailyLogin::create([
            'user_id' => $user->id,
            'day' => $day,
            'claimed_at' => $today,
        ]);

        // Tambah koin ke user
        $rewardAmount = $this->getRewardAmount($day);
        $user->increment('coins', $rewardAmount);

        return response()->json([
            'success' => true,
            'message' => 'Reward berhasil diklaim!',
            'reward' => $rewardAmount,
            'coins' => $user->coins,
            'claimed_day' => $day
        ]);
    }

    private function getRewardAmount($day)
    {
        return in_array($day, [6, 7]) ? 40 : 20;
    }
}
