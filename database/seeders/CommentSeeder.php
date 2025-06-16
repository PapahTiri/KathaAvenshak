<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Novel;
use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $novels = Novel::all();

        foreach ($novels as $novel) {
            foreach (range(1, 20) as $i) {
                Comment::create([
                    'novel_id' => $novel->id,
                    'user_id' => $users->random()->id,
                    'content' => " Novel {$novel->title} keren banget seru banget",
                ]);
            }
        }
    }
}
