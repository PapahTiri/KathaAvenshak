<?php

namespace Database\Seeders;

use App\Models\CoinPackage;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CoinPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CoinPackage::insert([
        ['name' => 'Hemat', 'price' => 10000, 'coins' => 100],
        ['name' => 'Medium', 'price' => 20000, 'coins' => 220],
        ['name' => 'Sultan', 'price' => 50000, 'coins' => 600],
    ]);
    }
}
