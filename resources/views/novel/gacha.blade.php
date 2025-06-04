<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            🎲 Gacha Rewards
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto mt-10 px-4">

        {{-- Informasi Koin --}}
        <div class="text-right mb-4 flex justify-end items-center gap-1 text-sm">
            <span class="font-medium">Saldo Koin:</span>
            <span id="user-coins" class="font-bold">{{ auth()->user()->coins }}</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-yellow-500" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
            </svg>
        </div>

        {{-- Tombol Gacha --}}
        <div x-data="gachaComponent({{ auth()->user()->coins }})" class="text-center">
            <button @click="pullGacha()" :disabled="loading"
                class="bg-indigo-600 text-white px-6 py-3 rounded-lg disabled:opacity-50 inline-flex items-center justify-center gap-1">
                <template x-if="!loading">
                    <span class="inline-flex items-center">
                        Gacha ({{ $setting->cost_per_pull ?? 0 }})
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-400 ml-1" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                        </svg>
                    </span>
                </template>
                <span x-show="loading">Loading...</span>
            </button>

            {{-- Hasil Gacha --}}
            <template x-if="prize">
                <div class="mt-6 p-4 border rounded-lg bg-gray-50">
                    <h3 class="text-lg font-semibold">Selamat!</h3>
                    <p class="mt-2">
                        Anda mendapatkan:
                        <span class="font-bold" x-text="prize.name"></span>
                        (<span x-text="prize.type"></span> -
                        <span x-text="prize.value"></span>)
                    </p>
                </div>
            </template>

            {{-- Pesan Error --}}
            <template x-if="error">
                <div class="mt-6 p-4 border border-red-500 rounded-lg bg-red-50 text-red-700">
                    <p x-text="error"></p>
                </div>
            </template>
        </div>
    </div>

    <script>
        function gachaComponent(initialCoins) {
            return {
                loading: false,
                prize: null,
                error: null,
                userCoins: initialCoins,

                pullGacha() {
                    this.error = null;
                    this.prize = null;
                    this.loading = true;

                    fetch('{{ route('gacha.pull') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        },
                        body: JSON.stringify({}),
                    })
                        .then(async response => {
                            this.loading = false;
                            const data = await response.json();
                            if (!data.success) {
                                this.error = data.message || 'Gagal melakukan gacha.';
                                return;
                            }
                            this.prize = data.prize;
                            this.userCoins = data.remaining_coins;
                            document.getElementById('user-coins').innerText = this.userCoins;
                        })
                        .catch(() => {
                            this.loading = false;
                            this.error = 'Terjadi kesalahan. Coba lagi.';
                        });
                }
            }
        }
    </script>
</x-app-layout>
