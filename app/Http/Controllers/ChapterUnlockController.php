<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\DailyLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChapterUnlockController extends Controller
{
   public function unlock(Chapter $chapter)
    {
        $user = auth()->user();

        // 1) Jika chapter sudah otomatis terbuka (lewat waktu) atau dibuka manual
        if ($chapter->isUnlocked() || $user->hasPurchased($chapter)) {
            return redirect()->route('chapter.show', [$chapter->novel_id, $chapter->id]);
        }

        // 2) Cek koin cukup atau tidak
        if ($user->coins < $chapter->unlock_price) {
            return back()->with('error', 'Koin Anda tidak cukup untuk membuka chapter ini.');
        }

        // 3) Proses beli
        $user->decrement('coins', $chapter->unlock_price);
        $user->purchasedChapters()->attach($chapter->id);

        return redirect()->route('chapter.show', [$chapter->novel_id, $chapter->id])
                    ->with('success', 'Chapter berhasil dibuka.');
    }
}
