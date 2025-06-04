<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GachaController;
use App\Http\Controllers\NovelController;
use App\Http\Controllers\claimDailyReward;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ChapterUnlockController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
    
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// routes/web.php
Route::get('/novel/{id}', [NovelController::class, 'show'])->name('novel.show');
Route::get('/novel/{novel}/chapter/{chapter}', [NovelController::class, 'read'])->name(('novel.read'));
Route::get('/novel/{novel}/chapter/{chapter}', [NovelController::class, 'showChapter'])->name('chapter.show');

Route::post('/claim-reward', [claimDailyReward::class, 'claim'])->middleware('auth');
Route::post('/claim-reward', function (Request $request) {
    
    $day = $request->input('day');

    /** @var \App\Models\User $user */
    $user = Auth::user();

    if (!$user) {
        return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
    }

    // Cast kolom 'claimed_days' sebagai array (pastikan di DB ada kolom ini bertipe JSON)
    $claimed = $user->claimed_days ?? [];

    if (in_array($day, $claimed)) {
        return response()->json(['success' => false, 'message' => 'Sudah diambil']);
    }

    // Ambil reward dari setting
    $rewardAmount = \App\Models\DailyLoginSetting::latest()->first()?->getSchedule()[$day] ?? 0;

    
    $user->update([
        'claimed_days' => [...$claimed, $day],
        'coins' => ($user->coins ?? 0) + $rewardAmount,
    ]);

    return response()->json(['success' => true, 'reward' => $rewardAmount]);
})->middleware('auth');

Route::post('/chapter/{chapter}/unlock', [ChapterUnlockController::class, 'unlock'])
    ->middleware('auth')
    ->name('chapter.unlock');

// web.php
Route::get('/gacha', [GachaController::class, 'index'])->name('gacha.index');

Route::post('/gacha/pull', [GachaController::class, 'pull'])
    ->middleware('auth')
    ->name('gacha.pull');

require __DIR__.'/auth.php';
