<?php

namespace App\Http\Controllers;

use App\Models\GachaPrize;
use App\Models\GachaSetting;
use Illuminate\Http\Request;
use App\Models\UserGachaReward;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GachaController extends Controller
{

    public function index()
    {
        $setting = GachaSetting::first();

        return view('novel.gacha', compact('setting'));
    }

     public function pull(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // 1) Ambil setting harga
        $setting = GachaSetting::first();
        if (! $setting) {
            return response()->json([
                'success' => false,
                'message' => 'Gacha belum diatur. Hubungi admin.',
            ], 400);
        }
        $cost = $setting->cost_per_pull;

        // 2) Cek saldo koin cukup
        if ($user->coins < $cost) {
            return response()->json([
                'success' => false,
                'message' => 'Koin Anda tidak cukup.',
            ], 402);
        }

        // 3) Ambil semua prize dengan bobot
        $prizes = GachaPrize::all();
        if ($prizes->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada hadiah tersedia.',
            ], 400);
        }

        // 4) Weighted random selection
        $totalWeight = $prizes->sum('weight');
        $rand = random_int(1, $totalWeight);
        $cumulative = 0;
        $selected = null;

        foreach ($prizes as $prize) {
            $cumulative += $prize->weight;
            if ($rand <= $cumulative) {
                $selected = $prize;
                break;
            }
        }
        if (! $selected) {
            // fallback, ambil satu acak
            $selected = $prizes->random();
        }

        // 5) Kurangi koin user
        $user->decrement('coins', $cost);

        // 6) Catat hadiah ke user
        UserGachaReward::create([
            'user_id'        => $user->id,
            'gacha_prize_id' => $selected->id,
        ]);

        // 7) Kembalikan response
        return response()->json([
            'success' => true,
            'prize'   => [
                'name'  => $selected->name,
                'type'  => $selected->type,
                'value' => $selected->value,
            ],
            'remaining_coins' => $user->coins,
        ]);
    }
}
