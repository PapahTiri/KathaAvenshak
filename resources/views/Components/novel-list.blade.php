<div class="max-w-6xl mx-auto px-4 ">

    {{-- Top Ranking Novel --}}
    <div class="text-center my-8">
        <h2 class="text-xl font-semibold mb-4 text-black dark:text-white">Top Ranking Novel</h2>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 justify-center">
            @forelse ($topNovels as $novel)
                <div class="text-center">
                    @auth
                        <a href="{{ route('novel.show', $novel->id) }}">
                    @else
                        <a href="{{ route('login') }}">
                    @endauth
                        <img src="{{ asset('storage/' . $novel->cover_image) }}"
                             class="mx-auto w-full max-w-[160px] h-auto rounded-xl shadow-md" />
                    </a>

                    @auth
                        <a href="{{ route('novel.show', $novel->id) }}">
                    @else
                        <a href="{{ route('login') }}">
                    @endauth
                        <div class="mt-2 text-sm font-medium dark:text-white">
                            {{ $novel->title }}
                        </div>
                    </a>
                </div>
            @empty
                <p class="text-gray-500">Belum ada novel tersedia.</p>
            @endforelse
        </div>
    </div>

    <div class="w-full h-1 bg-gray-300 mx-auto my-6 rounded-full"></div>

    {{-- Top 300 Novel --}}
    <div class="text-center my-8">
        <h2 class="text-xl font-semibold mb-4 dark:text-white">Top 300 Novel</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-4 justify-center">
            @forelse ($top300Novels as $novel)
                <div class="text-center">
                    @auth
                        <a href="{{ route('novel.show', $novel->id) }}">
                    @else
                        <a href="{{ route('login') }}">
                    @endauth
                        <img src="{{ asset('storage/' . $novel->cover_image) }}"
                             class="mx-auto w-full max-w-[160px] h-auto rounded-xl shadow-md" />
                    </a>

                    @auth
                        <a href="{{ route('novel.show', $novel->id) }}">
                    @else
                        <a href="{{ route('login') }}">
                    @endauth
                        <div class="mt-2 text-sm font-medium dark:text-white">
                            {{ $novel->title }}
                        </div>
                    </a>
                </div>
            @empty
                <p class="text-gray-500">Belum ada novel tersedia.</p>
            @endforelse
        </div>
    </div>
</div>
