<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    {{-- Banner --}}


<div class="max-w-6xl mx-auto px-4 ">
    {{-- Top Ranking Novel --}}
<div class="text-center my-8">
    <h2 class="text-xl font-semibold mb-4">Top Ranking Novel</h2>
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 justify-center">
        @forelse ($topNovels as $novel)
            <div class="text-center">
            <a href="{{ route('novel.show', $novel->id) }}" >
                <img src="{{ asset('storage/' . $novel->cover_image) }}"
                class="mx-auto w-full max-w-[160px] h-auto rounded-xl shadow-md" />
            </a>
            <a href="{{ route('novel.show', $novel->id) }}">
                <div class="mt-2 text-sm font-medium">{{ $novel->title }}</div>
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
    <h2 class="text-xl font-semibold mb-4 ">Top 300 Novel</h2>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-4 justify-center">
        @forelse ($top300Novels as $novel)
            <div class="text-center">
                <img src="{{ asset('storage/' . $novel->cover_image) }}"
                     class="mx-auto w-full max-w-[160px] h-auto rounded-xl shadow-md" />
                <div class="mt-2 text-sm font-medium">{{ $novel->title }}</div>
            </div>
        @empty
            <p class="text-gray-500">Belum ada novel tersedia.</p>
        @endforelse
    </div>
</div>
</div>
</x-app-layout>
