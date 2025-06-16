{{-- Tambahkan di bagian <head> --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/css/splide.min.css" />

{{-- Carousel Container --}}
<div class="max-w-6xl mx-auto py-6">
    <h2 class="text-xl font-semibold mb-4 text-center">Recommended Novels</h2>

    <div id="novel-carousel" class="splide" aria-label="Recommended Novels">
        <div class="splide__track">
            <ul class="splide__list">
                @foreach ($novels as $novel)
                    <li class="splide__slide">
                        <div class="relative rounded-xl overflow-hidden shadow-lg w-40">
                            <a href="{{ route('novel.show', $novel->id) }}">   
                                {{-- Gambar Cover --}}
                                <img src="{{ asset('storage/' . $novel->cover_image) }}"
                                alt="{{ $novel->title }}"
                                class="w-full h-auto aspect-[3/4] object-cover rounded-xl transition-transform duration-300 transform hover:scale-105" />
                                
                                <div class="absolute bottom-0 left-0 w-full p-2 bg-gradient-to-t from-black/80 via-black/40 to-transparent text-white text-xs">
                                    <h3 class="font-semibold text-sm leading-tight line-clamp-2">{{ $novel->title }}</h3>
                                    <div class="flex items-center justify-between text-[11px] mt-1">
                                        <span>💗 {{ $novel->likes ?? 0 }} Likes</span>
                                        <span class="text-blue-300 font-semibold">78%</span>
                                    </div>
                                    <p class="text-[11px] text-gray-300">Ongoing</p>
                                </div>
                            </a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

{{-- Tambahkan sebelum </body> --}}
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/js/splide.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        new Splide('#novel-carousel', {
            type    : 'loop',
            perPage : 5,
            gap     : '1rem',
            pagination: false,
            arrows: true,
            breakpoints: {
                1280: { perPage: 4 },
                1024: { perPage: 3 },
                768: { perPage: 2 },
                640: { perPage: 1 },
            }
        }).mount();
    });
</script>
