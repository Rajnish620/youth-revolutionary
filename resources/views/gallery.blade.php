<x-app-layout>
    @php
    $categories = ["All", "Session 1", "Session 2", "Session 3", "Session 4"];

    $galleryItems = [
        "Session 1" => [
            ["image" => "images/dance1.JPG", "title" => "Quiz Competition"],
            ["image" => "images/dance2.JPG", "title" => "Cricket Tournament"],
            ["image" => "images/dance3.JPG", "title" => "Dance Performance"],
        ],
        "Session 2" => [
            ["image" => "images/danses.jpeg", "title" => "Debate Competition"],
            ["image" => "images/quize.jpg", "title" => "Chess Championship"],
            ["image" => "images/sports.png", "title" => "Singing Event"],
        ],
        "Session 3" => [],
        "Session 4" => [
            ["image" => "images/song.JPG", "title" => "Singing Event"],
            ["image" => "images/NIKON Z 502317.JPG.jpeg", "title" => "Award Ceremony"],
            ["image" => "images/image2.jpg", "title" => "Chess Championship"],
            ["image" => "images/image3.jpg", "title" => "Singing Event"],
            ["image" => "images/image4.jpg", "title" => "Award Ceremony"],
            ["image" => "images/image5.JPG", "title" => "Winner Celebration"],
            ["image" => "images/1000262268.jpg.jpeg", "title" => "Singing Event"],
            ["image" => "images/1000262306.jpg.jpeg", "title" => "Award Ceremony"],
            ["image" => "images/1000262316.jpg.jpeg", "title" => "Winner Celebration"],
            ["image" => "images/1000262334.jpg.jpeg", "title" => "Chess Championship"],
            ["image" => "images/1000262354.jpg.jpeg", "title" => "Singing Event"],
            ["image" => "images/1000262356.jpg.jpeg", "title" => "Award Ceremony"],
            ["image" => "images/1000262437.jpg.jpeg", "title" => "Winner Celebration"],
            ["image" => "images/WhatsApp Image 2026-06-24 at 1.07.17 PM.jpeg", "title" => "Singing Event"],
            ["image" => "images/WhatsApp Image 2026-06-24 at 1.07.18 PM.jpeg", "title" => "Award Ceremony"],
            ["image" => "images/WhatsApp Image 2026-06-24 at 1.07.20 PM.jpeg", "title" => "Winner Celebration"],
            ["image" => "images/WhatsApp Image 2026-06-24 at 1.07.21 PM.jpeg", "title" => "Chess Championship"],
            ["image" => "images/WhatsApp Image 2026-06-24 at 1.07.24 PM.jpeg", "title" => "Singing Event"],
            ["image" => "images/WhatsApp Image 2026-06-24 at 1.07.27 PM.jpeg", "title" => "Award Ceremony"],
            ["image" => "images/WhatsApp Image 2026-06-24 at 1.07.29 PM.jpeg", "title" => "Winner Celebration"],
            ["image" => "images/WhatsApp Image 2026-06-24 at 1.07.30 PM.jpeg", "title" => "Singing Event"],
            ["image" => "images/WhatsApp Image 2026-06-24 at 1.07.32 PM.jpeg", "title" => "Award Ceremony"],
            ["image" => "images/WhatsApp Image 2026-06-24 at 1.07.35 PM.jpeg", "title" => "Winner Celebration"],
            ["image" => "images/WhatsApp Image 2026-06-24 at 1.07.36 PM.jpeg", "title" => "Chess Championship"],
            ["image" => "images/WhatsApp Image 2026-06-24 at 1.07.37 PM.jpeg", "title" => "Singing Event"],
            ["image" => "images/WhatsApp Image 2026-06-24 at 1.07.38 PM.jpeg", "title" => "Award Ceremony"],
            ["image" => "images/WhatsApp Image 2026-06-24 at 1.07.39 PM.jpeg", "title" => "Winner Celebration"],
            ["image" => "images/WhatsApp Image 2026-06-24 at 1.07.42 PM.jpeg", "title" => "Singing Event"],
            ["image" => "images/WhatsApp Image 2026-06-24 at 1.07.44 PM.jpeg", "title" => "Award Ceremony"],
            ["image" => "images/WhatsApp Image 2026-06-24 at 1.07.45 PM.jpeg", "title" => "Winner Celebration"],
            ["image" => "images/WhatsApp Image 2026-06-24 at 1.07.47 PM.jpeg", "title" => "Singing Event"],
            ["image" => "images/WhatsApp Image 2026-06-24 at 1.07.49 PM.jpeg", "title" => "Award Ceremony"],
            ["image" => "images/WhatsApp Image 2026-06-24 at 1.07.50 PM.jpeg", "title" => "Winner Celebration"],
            ["image" => "images/WhatsApp Image 2026-06-24 at 1.07.51 PM.jpeg", "title" => "Singing Event"],
            ["image" => "images/WhatsApp Image 2026-06-24 at 1.07.53 PM.jpeg", "title" => "Award Ceremony"],
            ["image" => "images/WhatsApp Image 2026-06-24 at 1.07.54 PM.jpeg", "title" => "Winner Celebration"],
            ["image" => "images/WhatsApp Image 2026-06-24 at 1.07.59 PM.jpeg", "title" => "Chess Championship"],
            ["image" => "images/WhatsApp Image 2026-06-24 at 1.08.00 PM.jpeg", "title" => "Singing Event"],
            ["image" => "images/WhatsApp Image 2026-06-24 at 1.08.02 PM.jpeg", "title" => "Award Ceremony"],
            ["image" => "images/WhatsApp Image 2026-06-24 at 1.08.03 PM.jpeg", "title" => "Winner Celebration"],
            ["image" => "images/WhatsApp Image 2026-06-24 at 1.08.04 PM.jpeg", "title" => "Chess Championship"],
            ["image" => "images/WhatsApp Image 2026-06-24 at 1.08.05 PM.jpeg", "title" => "Singing Event"],
            ["image" => "images/WhatsApp Image 2026-06-24 at 1.08.06 PM.jpeg", "title" => "Award Ceremony"],
            ["image" => "images/WhatsApp Image 2026-06-24 at 1.08.07 PM.jpeg", "title" => "Winner Celebration"],
            ["image" => "images/WhatsApp Image 2026-06-24 at 1.08.08 PM.jpeg", "title" => "Winner Celebration"],
            ["image" => "images/WhatsApp Image 2026-06-24 at 1.08.10 PM.jpeg", "title" => "Winner Celebration"],
        ]
    ];

    for ($i = 2; $i <= 50; $i++) {
        $galleryItems["Session 3"][] = ["image" => "images/Session-3/image copy {$i}.png"];
    }

    $allImages = [];
    foreach($galleryItems as $session => $items) {
        foreach($items as $item) {
            $allImages[] = array_merge($item, ['session' => $session]);
        }
    }
    @endphp

    <section class="py-24 bg-slate-50 mt-20" x-data="{ 
            activeCategory: 'All', 
            selectedIndex: null,
            images: {{ json_encode($allImages) }},
            get filteredImages() {
                return this.activeCategory === 'All' 
                    ? this.images 
                    : this.images.filter(img => img.session === this.activeCategory);
            },
            nextImage() {
                this.selectedIndex = this.selectedIndex === this.filteredImages.length - 1 ? 0 : this.selectedIndex + 1;
            },
            prevImage() {
                this.selectedIndex = this.selectedIndex === 0 ? this.filteredImages.length - 1 : this.selectedIndex - 1;
            }
        }">
        <div class="max-w-7xl mx-auto px-6">
            
            <!-- Heading -->
            <div class="text-center mb-12" x-data="{ show: false }" x-init="setTimeout(() => show = true, 100)">
                <h2 x-show="show" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 translate-x-12" x-transition:enter-end="opacity-100 translate-x-0" class="text-5xl font-bold mb-4">Event Gallery</h2>
                <p x-show="show" x-transition:enter="transition ease-out duration-700 delay-100" x-transition:enter-start="opacity-0 translate-y-12" x-transition:enter-end="opacity-100 translate-y-0" class="text-gray-600">Moments of Learning, Sports & Celebration</p>
            </div>

            <!-- Filter Buttons -->
            <div class="flex flex-wrap justify-center gap-3 mb-14">
                @foreach($categories as $category)
                    <button @click="activeCategory = '{{ $category }}'; selectedIndex = null"
                            :class="activeCategory === '{{ $category }}' ? 'bg-blue-600 text-white' : 'bg-white border border-gray-200'"
                            class="px-5 py-1.5 rounded-full transition hover:-translate-y-0.5 duration-300 shadow">
                        {{ $category }}
                    </button>
                @endforeach
            </div>

            <!-- Masonry Gallery -->
            <div class="columns-1 sm:columns-2 lg:columns-3 gap-3">
                <template x-for="(item, index) in filteredImages" :key="item.image">
                    <div @click="selectedIndex = index" class="mb-3 break-inside-avoid overflow-hidden rounded-md cursor-pointer group relative">
                        <img :src="'{{ asset('') }}' + item.image" alt="image" class="w-full rounded-md group-hover:scale-110 transition duration-700" />
                        <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition flex flex-col justify-end p-5"></div>
                    </div>
                </template>
            </div>
        </div>

        <!-- Fullscreen Lightbox -->
        <div x-show="selectedIndex !== null" style="display: none;" class="fixed inset-0 z-50 bg-black/95 flex items-center justify-center">
            
            <!-- Close -->
            <button @click="selectedIndex = null" class="absolute top-6 right-6 text-white hover:text-gray-300 transition">
                <i class="fa-solid fa-xmark text-4xl"></i>
            </button>

            <!-- Previous -->
            <button @click="prevImage()" class="absolute left-5 text-white hover:text-gray-300 transition">
                <i class="fa-solid fa-chevron-left text-5xl"></i>
            </button>

            <!-- Image -->
            <img :src="'{{ asset('') }}' + filteredImages[selectedIndex]?.image" class="max-w-[90vw] max-h-[90vh] object-contain rounded-2xl" />

            <!-- Next -->
            <button @click="nextImage()" class="absolute right-5 text-white hover:text-gray-300 transition">
                <i class="fa-solid fa-chevron-right text-5xl"></i>
            </button>

            <!-- Counter -->
            <div class="absolute bottom-6 text-white text-lg font-semibold">
                <span x-text="selectedIndex + 1"></span> / <span x-text="filteredImages.length"></span>
            </div>
        </div>
    </section>
</x-app-layout>
