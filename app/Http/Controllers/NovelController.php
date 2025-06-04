<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Novel;
use Illuminate\Http\Request;

class NovelController extends Controller
{
    public function show($id)
    {
        $novel = Novel::with('chapters')->findOrFail($id);
        return view('novel.show', compact('novel'));
    }

    public function read($novelId, $chapterId) 
    {
        $novel = Novel::findOrFail($novelId);
        $chapter = Chapter::where('novel_id', $novelId)->findOrFail($chapterId);

        return view('novel.read', compact('novel', 'chapter'));
    }

    public function showChapter($novelId, $chapterId)
    {
        $novel = Novel::findOrFail($novelId);
        $chapter = Chapter::where('novel_id', $novelId)->findOrFail($chapterId);

        $previousChapter = Chapter::where('novel_id', $novelId)
            ->where('chapter_number', '<', $chapter->chapter_number)
            ->orderBy('chapter_number', 'desc')
            ->first();

        $nextChapter = Chapter::where('novel_id', $novelId)
            ->where('chapter_number', '>', $chapter->chapter_number)
            ->orderBy('chapter_number', 'asc')
            ->first();

        return view('novel.read', compact('novel', 'chapter', 'previousChapter', 'nextChapter'));

    }

}
