<?php

namespace App\Http\Controllers;

use App\Models\CoinTopup;
use App\Models\CoinPackage;
use Illuminate\Http\Request;

class UserCoinController extends Controller
{
    public function index()
    {
        $packages = CoinPackage::all();
        return view('topup.index', compact('packages'));
    }

    public function beli($id)
    {
        $package = CoinPackage::findOrFail($id);
        $user = auth()->user();

        // Tambah koin ke user
        $user->increment('coins', $package->coins);

        // Catat transaksi
        CoinTopup::create([
            'user_id' => $user->id,
            'coin_package_id' => $package->id,
            'amount' => $package->price,
            'coins' => $package->coins,
            'payment_method' => 'manual',
            'status' => 'success',
        ]);

        return back()->with('status', 'Top up berhasil!');
    }
}
