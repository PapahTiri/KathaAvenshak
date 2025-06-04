        <div class="mt-10 flex justify-between items-center text-sm text-blue-500">
            @if ($previousChapter)
                <a href="{{ route('chapter.show', ['novel' => $novel->id, 'chapter' => $previousChapter->id]) }}" class="hover:underline">
                    ← Chapter {{ $previousChapter->chapter_number }}: {{ Str::limit($previousChapter->title, 30) }}
                </a>
            @else
                <span></span>
            @endif

            @if ($nextChapter)
                <a href="{{ route('chapter.show', ['novel' => $novel->id, 'chapter' => $nextChapter->id]) }}" class="hover:underline">
                    Chapter {{ $nextChapter->chapter_number }}: {{ Str::limit($nextChapter->title, 30) }} →
                </a>
            @endif
        </div>

