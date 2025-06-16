<?php

namespace Database\Seeders;

use App\Models\Novel;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LeaderBoardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $novels = Novel::take(2)->get(); // ambil 2 novel pertama

        foreach ($novels as $novel) {
            $novel->update([
                'views' => fake()->numberBetween(100, 10000),
                'likes' => fake()->numberBetween(10, 1000),
                'comments' => fake()->numberBetween(0, 500),
                'earned_coins' => fake()->numberBetween(1000, 50000),
            ]);
        }

        $this->command->info("2 Novel berhasil diupdate dengan data dummy leaderboard.");
    }
}
