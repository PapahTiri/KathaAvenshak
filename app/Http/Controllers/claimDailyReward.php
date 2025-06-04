<?php

namespace App\Http\Controllers;

use App\Models\DailyLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class claimDailyReward extends Controller
{
    public function claimDailyReward(Request $request) {
        $user = auth()->user();
        $today = Carbon::today();
        $day = $request->input('day');

        $alreadyClaimed = DailyLogin::where('user_id', $user->id)
            ->where('day', $day)
            ->whereDate('claimed_at', $today)
            ->exists();

        if ($alreadyClaimed) {
            return response()->json(['message' => 'Sudah diklaim.'], 400);
        }

        DailyLogin::create([
            'user_id' => $user->id,
            'day' => $day,
            'claimed_at' => $today,
        ]);

        $user->increment('coins', $this->getRewardAmount($day));

        return response()->json(['message' => 'Berhasil klaim!']);
    }

    private function getRewardAmount($day) {
        return in_array($day, [6, 7]) ? 40 : 20;
    }
}
