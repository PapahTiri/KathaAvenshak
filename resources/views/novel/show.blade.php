<x-app-layout>
    <div class="max-w-5xl mx-auto py-6 px-4 bg-white dark:bg-gray-900 rounded-md shadow-md">

        {{-- Tombol Back --}}
        <a href="{{ route('dashboard') }}"  
                class="flex items-center mb-6 text-gray-700 dark:text-gray-300 hover:text-cyan-500 dark:hover:text-cyan-400 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 me-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            <span>Back</span>
        </a>

        {{-- Judul --}}
        <h1 class="text-2xl font-semibold mb-6 text-gray-900 dark:text-gray-100">Detail Novel</h1>

        {{-- Card Info --}}
        <div class="relative flex flex-col md:flex-row items-center md:items-start gap-6 bg-white dark:bg-gray-800 shadow p-6 rounded-xl mb-10">
            {{-- Badge Likes --}}
            <div class="absolute top-4 right-4 flex items-center gap-1 text-pink-600 dark:text-pink-400 text-sm font-semibold bg-pink-100 dark:bg-pink-900 px-3 py-1 rounded-full shadow hover:scale-105 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-current" viewBox="0 0 20 20">
                    <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"/>
                </svg>
                {{ number_format($novel->likes) }}
            </div>

            {{-- Gambar Cover --}}
            <img src="{{ asset('storage/' . $novel->cover_image) }}" 
                class="w-48 h-64 object-cover rounded-md" 
                alt="{{ $novel->title }}">

            {{-- Info --}}
            <div class="flex-1">
                <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ $novel->title }}</h2>
                <p class="text-gray-700 dark:text-gray-300"><strong>Author:</strong> {{ $novel->author }}</p>
                <p class="text-gray-700 dark:text-gray-300"><strong>Genre:</strong> - </p>

                <div class="mt-4">
                    <h3 class="font-semibold text-gray-900 dark:text-gray-100">Sinopsis</h3>
                    <p class="text-gray-700 dark:text-gray-300">{{ $novel->sinopsis }}</p>
                </div>

                <div class="mt-6 flex gap-3">
                    <a href="#" class="bg-cyan-400 hover:bg-cyan-500 text-white px-4 py-2 rounded">Novel Chap</a>
                </div>
            </div>
        </div>

        {{-- Latest Series --}}
        <h2 class="text-lg font-semibold mb-2 text-gray-900 dark:text-gray-100">Latest Series - Novel</h2>
        <hr class="border-black dark:border-gray-400 border-2 mb-6" />

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            @foreach ($novel->chapters as $chapter)
                @php
                    $locked = !$chapter->isUnlocked() && !auth()->user()->hasPurchased($chapter);
                @endphp

                <div class="p-4 border rounded-lg bg-white dark:bg-gray-800 shadow-sm border-gray-300 dark:border-gray-700">
                    <div class="flex items-start justify-between">
                        <div class="max-w-[75%]">
                            <h3 class="font-semibold text-gray-900 dark:text-gray-100">
                                Chapter {{ $chapter->chapter_number }}: {{ $chapter->title }}
                            </h3>

                            @if (!$locked)
                                <div class="mt-1">
                                    <a href="{{ route('chapter.show', [$novel->id, $chapter->id]) }}"
                                        class="inline-block bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition">
                                        Baca Chapter
                                    </a>

                                    @if($chapter->unlocked_manually)
                                        <span class="block text-xs text-gray-400 dark:text-gray-500 mt-1">Unlocked oleh admin</span>
                                    @elseif($chapter->isUnlocked())
                                        <span class="block text-xs text-gray-400 dark:text-gray-500 mt-1">Unlocked otomatis</span>
                                    @endif
                                </div>
                            @endif
                        </div>

                        @if ($locked)
                            <form action="{{ route('chapter.unlock', $chapter) }}" method="POST" class="ml-4">
                                @csrf
                                <button type="submit"
                                    class="flex items-center bg-blue-400 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                                    Buka ({{ $chapter->unlock_price }})
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-2 text-yellow-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375
                                               m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375
                                               m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375
                                               m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75
                                               C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75
                                               m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125"/>
                                    </svg>
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
                @endforeach
            </div> 
            <livewire:novel-comments :novel="$novel" />
        </div>
</x-app-layout>
