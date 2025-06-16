<?php

namespace App\Http\Controllers;

use App\Models\Novel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        // Ambil semua data novel yang ada
        $novels = Novel::all();

        // Top Ranking kita ambil maksimal 4, bisa kurang
        $topNovels = $novels->take(4);

        // Top 300, ambil semua (karena isinya belum banyak)
        $top300Novels = $novels;

        return view('dashboard', compact('topNovels', 'top300Novels', 'novels'));
    }


}
