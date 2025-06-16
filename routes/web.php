<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Novel;
use App\Http\Controllers\GachaController;
use App\Http\Controllers\NovelController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ChapterUnlockController;
use App\Http\Controllers\claimDailyReward;
use App\Http\Controllers\UserCoinController;

// Halaman Utama
Route::get('/', [NovelController::class, 'index']);

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Grup untuk user yang sudah login
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Chapter Unlock
    Route::post('/chapter/{chapter}/unlock', [ChapterUnlockController::class, 'unlock'])
        ->name('chapter.unlock');

    // Claim Daily Reward (HANYA SEKALI, gunakan controller)
    Route::post('/claim-reward', [claimDailyReward::class, 'claim'])
        ->name('claim.reward');

    // Topup Coins
    Route::get('/topup', [UserCoinController::class, 'index'])->name('topup.index');
    Route::post('/topup/beli/{id}', [UserCoinController::class, 'beli'])->name('topup.beli');
});

// Novel
Route::get('/novel/{id}', [NovelController::class, 'show'])->name('novel.show');
Route::get('/novel/{novel}/chapter/{chapter}', [NovelController::class, 'read'])->name('novel.read');

// Gacha
Route::get('/gacha', [GachaController::class, 'index'])->name('gacha.index');
Route::post('/gacha/pull', [GachaController::class, 'pull'])->middleware('auth')->name('gacha.pull');

require __DIR__.'/auth.php';

