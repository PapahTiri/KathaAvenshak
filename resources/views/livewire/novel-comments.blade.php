<div class="mt-10">
    <h2 class="text-xl font-bold mb-6 text-gray-900 dark:text-gray-100">💬 Komentar</h2>

    {{-- Daftar Komentar --}}
    <div class="space-y-5">
        @forelse ($comments as $c)
            <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between mb-2">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-cyan-500 text-white flex items-center justify-center rounded-full text-sm font-bold">
                            {{ strtoupper(substr($c->user->name ?? 'A', 0, 1)) }}
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900 dark:text-gray-100">
                                {{ $c->user->name ?? 'Anonim' }}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                {{ $c->created_at->diffForHumans() ?? '-' }}
                            </p>
                        </div>
                    </div>
                </div>
                <p class="text-gray-800 dark:text-gray-200">{{ $c->content }}</p>
            </div>
        @empty
            <p class="text-gray-600 dark:text-gray-400">Belum ada komentar.</p>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $comments->links() }}
    </div>

       {{-- Notifikasi sukses --}}
    @if (session()->has('message'))
        <div class="mb-6 bg-green-100 text-green-800 px-4 py-2 rounded shadow">
            {{ session('message') }}
        </div>
    @endif

    {{-- Form Komentar --}}
    <div class="mt-10">
        <form wire:submit.prevent="postComment" wire:key="form-{{ now()->timestamp }}"
              class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow border border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Tulis Komentar</h3>

            <textarea wire:model.defer="content"
                      class="w-full p-2 border border-gray-300 dark:border-gray-600 rounded dark:bg-gray-900 dark:text-white"
                      placeholder="Tulis komentar..." rows="3"></textarea>

            <button type="submit"
                    class="mt-4 bg-cyan-500 hover:bg-cyan-600 text-white font-semibold px-5 py-2 rounded-lg transition">
                Kirim
            </button>
        </form>
    </div>
</div>
