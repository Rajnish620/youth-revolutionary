@php
$galleryImages = [
    "images/NIKON Z 502317.JPG.jpeg",
    "images/1000262316.jpg.jpeg",
    "images/1000262334.jpg.jpeg",
    "images/1000262354.jpg.jpeg",
    "images/1000262510.jpg.jpeg",
    "images/1000262505.jpg.jpeg",
];
@endphp

<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        
        <!-- Heading -->
        <div class="text-center mb-14" x-data="{ show: false }" x-intersect.once="show = true">
            <span x-show="show" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="text-blue-600 font-semibold uppercase tracking-widest">
                Gallery
            </span>
            <h2 x-show="show" x-transition:enter="transition ease-out duration-700 delay-100" x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0" class="text-4xl md:text-5xl font-bold mt-3">
                Moments That Inspire
            </h2>
            <p x-show="show" x-transition:enter="transition ease-out duration-700 delay-200" x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0" class="text-gray-600 mt-4 max-w-2xl mx-auto">
                Explore highlights from our Education, Sports and Cultural Competitions held across different locations.
            </p>
        </div>

        <!-- Gallery Grid -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4" x-data="{ show: false }" x-intersect.once="show = true">
            
            <!-- Large Image -->
            <div x-show="show" x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="col-span-2 row-span-2 relative group overflow-hidden rounded-3xl cursor-pointer">
                <img src="{{ asset($galleryImages[0]) }}" alt="Gallery Large" class="w-full h-full object-cover group-hover:scale-110 transition duration-700" />
                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                    <i class="fa-solid fa-camera text-white text-5xl"></i>
                </div>
            </div>

            <!-- Smaller Images -->
            @foreach(array_slice($galleryImages, 1) as $index => $img)
                <div x-show="show" x-transition:enter="transition ease-out duration-700 delay-[{{ ($index+1) * 150 }}ms]" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="relative group overflow-hidden rounded-3xl cursor-pointer">
                    <img src="{{ asset($img) }}" alt="Gallery" class="w-full h-64 object-cover group-hover:scale-110 transition duration-700" />
                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                        <i class="fa-regular fa-image text-white text-4xl"></i>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Stats -->
        <div x-data="{ show: false }" x-intersect.once="show = true" class="grid md:grid-cols-3 gap-6 mt-16">
            <div x-show="show" x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0 translate-y-24" x-transition:enter-end="opacity-100 translate-y-0" class="bg-blue-50 p-8 rounded-3xl text-center">
                <h3 class="text-4xl font-bold text-blue-600">10000+</h3>
                <p class="text-gray-600 mt-2">Student Participants</p>
            </div>
            <div x-show="show" x-transition:enter="transition ease-out duration-1000 delay-150" x-transition:enter-start="opacity-0 translate-y-24" x-transition:enter-end="opacity-100 translate-y-0" class="bg-orange-50 p-8 rounded-3xl text-center">
                <h3 class="text-4xl font-bold text-orange-500">100+</h3>
                <p class="text-gray-600 mt-2">Competitions Organized</p>
            </div>
            <div x-show="show" x-transition:enter="transition ease-out duration-1000 delay-300" x-transition:enter-start="opacity-0 translate-y-24" x-transition:enter-end="opacity-100 translate-y-0" class="bg-green-50 p-8 rounded-3xl text-center">
                <h3 class="text-4xl font-bold text-green-600">50+</h3>
                <p class="text-gray-600 mt-2">Schools Connected</p>
            </div>
        </div>

        <!-- CTA -->
        <div class="text-center mt-14" x-data="{ show: false }" x-intersect.once="show = true">
            <div x-show="show" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0" class="inline-block transform transition-transform hover:scale-105 active:scale-95">
                <a href="{{ url('/gallery') }}" class="inline-flex items-center gap-2 bg-blue-600 text-white px-8 py-4 rounded-xl hover:bg-blue-700 transition">
                    View Full Gallery
                </a>
            </div>
        </div>
    </div>
</section>
