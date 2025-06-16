<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            Pilih Paket Koin
        </h2>
    </x-slot>

    <div class="py-10">
        @if(session('status'))
            <div class="mb-6 rounded-lg bg-green-100 border border-green-200 text-green-800 px-5 py-3 shadow-sm">
                {{ session('status') }}
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            @foreach($packages as $package)
                <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition duration-300 text-center">
                    <h3 class="text-xl font-semibold text-gray-800">{{ $package->name }}</h3>
                    <p class="mt-3 text-gray-600 text-sm">Harga</p>
                    <p class="text-lg font-bold text-gray-900">Rp {{ number_format($package->price) }}</p>
                    <p class="mt-2 text-green-600 font-semibold">+{{ $package->coins }} Koin</p>

                    <form method="POST" action="{{ route('topup.beli', $package->id) }}" class="mt-5">
                        @csrf
                        <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition">
                            Beli Sekarang
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
