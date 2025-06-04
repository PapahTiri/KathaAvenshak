<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 py-6 bg-white">

        {{-- Kembali ke halaman novel --}}
        <div class="flex justify-between items-center mb-2">
            <a href="{{ route('novel.show', $novel->id) }}" class="text-sm text-black hover:underline">
                ← {{ $novel->title }}
            </a>
            <div class="flex gap-3 text-lg">
                <span>🕮</span>
                <span>🕐</span>
            </div>
        </div>

        {{-- Garis tebal --}}
        <hr class="border-black border-2 mb-6" />

        {{-- Judul Chapter --}}
        <h1 class="text-lg font-bold mb-4">Chapter {{ $chapter->chapter_number }} : {{ $chapter->title }}</h1>

        {{-- Isi Konten --}}
        <div class="text-gray-700 leading-relaxed">
            {!! $chapter->content ?? 'Belum ada isi konten.' !!}
        </div>
         @if (isset($previousChapter) && isset($nextChapter))
            {{-- navigasi chapter --}}
            @include('novel.chapter')
        @endif


    </div>

    {{-- Footer --}}
    <footer class="text-center text-sm text-gray-600 py-6 bg-white">
        <p>Footer @ByPapahTiri</p>
        <p>Universitas Dian Nuswantoro Semarang</p>
    </footer>
</x-app-layout>
