<x-app-layout>
    @php
    $categories = ['All'];
    if (isset($seasons)) {
        foreach($seasons as $season) {
            $categories[] = $season->name;
        }
    }

    $allImages = [];
    if(isset($galleries) && $galleries->count() > 0) {
        foreach($galleries as $item) {
            $allImages[] = [
                'id' => $item->id,
                'image' => $item->image,
                'title' => $item->title ?? 'Memorable Moment',
                'session' => $item->season ? $item->season->name : 'Uncategorized',
                'description' => $item->description ?? 'Youth Revolutionary Event Gallery',
                'date' => $item->created_at ? $item->created_at->format('M d, Y') : ''
            ];
        }
    }

    $pinColors = ['bg-red-500', 'bg-pink-500', 'bg-purple-500', 'bg-[#F1400C]', 'bg-sky-500'];
    @endphp

    <!-- Include Caveat / Handwriting Font for Polaroid Captions -->
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@600;700&display=swap" rel="stylesheet">

    <style>
        /* Wall Texture Background */
        .polaroid-wall-bg {
            background-color: #e5e7eb;
            background-image: 
                radial-gradient(#d1d5db 1px, transparent 1px),
                linear-gradient(to bottom, #f3f4f6, #e5e7eb);
            background-size: 24px 24px, 100% 100%;
        }

        .polaroid-card {
            background: #ffffff;
            box-shadow: 
                0 4px 6px -1px rgba(0, 0, 0, 0.1),
                0 10px 15px -3px rgba(0, 0, 0, 0.08),
                0 20px 25px -5px rgba(0, 0, 0, 0.05);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .polaroid-card:hover {
            transform: scale(1.05) rotate(0deg) !important;
            box-shadow: 
                0 20px 25px -5px rgba(0, 0, 0, 0.15),
                0 25px 50px -12px rgba(0, 0, 0, 0.25);
            z-index: 30;
        }

        /* Handwritten Caption Font */
        .polaroid-caption {
            font-family: 'Caveat', cursive;
            font-size: 1.35rem;
            line-height: 1.2;
            color: #1f2937;
        }

        /* Push Pin Styling */
        .push-pin {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            position: absolute;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 20;
            box-shadow: 
                inset -2px -2px 4px rgba(0,0,0,0.4),
                inset 2px 2px 4px rgba(255,255,255,0.6),
                0 3px 6px rgba(0,0,0,0.3);
        }

        /* Random Alternating Tilts */
        .tilt-left-1 { transform: rotate(-2.5deg); }
        .tilt-right-1 { transform: rotate(2deg); }
        .tilt-left-2 { transform: rotate(-1.5deg); }
        .tilt-right-2 { transform: rotate(3deg); }
        .tilt-zero { transform: rotate(0.5deg); }
    </style>

    <!-- Main Section -->
    <section class="py-24 polaroid-wall-bg min-h-screen relative overflow-hidden mt-16 text-gray-900" 
        x-data="{ 
            activeCategory: 'All', 
            selectedIndex: null,
            images: {{ json_encode($allImages) }},
            
            get filteredImages() {
                if (this.activeCategory === 'All') return this.images;
                return this.images.filter(img => img.session === this.activeCategory);
            },
            
            nextImage() {
                if(this.filteredImages.length === 0) return;
                this.selectedIndex = this.selectedIndex === this.filteredImages.length - 1 ? 0 : this.selectedIndex + 1;
            },
            
            prevImage() {
                if(this.filteredImages.length === 0) return;
                this.selectedIndex = this.selectedIndex === 0 ? this.filteredImages.length - 1 : this.selectedIndex - 1;
            }
        }"
        x-on:keydown.escape.window="selectedIndex = null"
        x-on:keydown.left.window="if(selectedIndex !== null) prevImage()"
        x-on:keydown.right.window="if(selectedIndex !== null) nextImage()"
    >

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            
            <!-- Polaroid Wall Header -->
            <div class="text-center mb-14 space-y-3">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white text-xs font-bold text-[#F1400C] shadow-md border border-gray-200">
                    <span class="w-2.5 h-2.5 rounded-full bg-red-500 shadow-sm animate-ping"></span>
                    POLAROID PHOTO WALL
                </div>

                <h1 class="text-4xl sm:text-6xl font-black text-[#340C6F] tracking-tight">
                    MEMORIES & SEASONS
                </h1>
                
                <p class="text-gray-600 text-sm sm:text-base max-w-xl mx-auto font-medium">
                    Explore pinned event moments season by season. Click on any photo to open full view.
                </p>
            </div>

            <!-- Season Switcher (Pinned Ribbon Style) -->
            <div class="flex items-center justify-center mb-16">
                <div class="p-2 rounded-2xl bg-white/90 backdrop-blur-md border border-gray-300 shadow-xl flex flex-wrap justify-center gap-2">
                    @foreach($categories as $category)
                        <button 
                            @click="activeCategory = '{{ $category }}'; selectedIndex = null"
                            :class="activeCategory === '{{ $category }}' 
                                ? 'bg-[#F1400C] text-white font-bold shadow-md scale-105' 
                                : 'text-gray-700 hover:text-[#340C6F] hover:bg-gray-100 font-semibold'"
                            class="px-5 py-2.5 rounded-xl text-xs sm:text-sm transition-all duration-300 transform active:scale-95 flex items-center gap-2 cursor-pointer"
                        >
                            <span>{{ $category }}</span>
                            <span 
                                x-show="activeCategory === '{{ $category }}'"
                                class="w-1.5 h-1.5 rounded-full bg-white"
                            ></span>
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Polaroid Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
                <template x-for="(item, index) in filteredImages" :key="index">
                    <div 
                        @click="selectedIndex = index"
                        :class="[
                            index % 5 === 0 ? 'tilt-left-1' : '',
                            index % 5 === 1 ? 'tilt-right-1' : '',
                            index % 5 === 2 ? 'tilt-left-2' : '',
                            index % 5 === 3 ? 'tilt-right-2' : '',
                            index % 5 === 4 ? 'tilt-zero' : ''
                        ]"
                        class="polaroid-card relative p-4 pb-6 rounded-sm cursor-pointer group"
                    >
                        <!-- Colored Push Pin -->
                        <div class="push-pin" :class="['bg-red-500', 'bg-pink-500', 'bg-purple-500', 'bg-orange-500', 'bg-indigo-500'][index % 5]"></div>

                        <!-- Photo Frame -->
                        <div class="relative overflow-hidden aspect-square bg-gray-100 rounded-sm border border-gray-200/60 shadow-inner">
                            <img 
                                :src="item.image.startsWith('http') ? item.image : '{{ asset('') }}' + item.image" 
                                :alt="item.title" 
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out"
                            />
                            
                            <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-colors"></div>
                        </div>

                        <!-- Handwritten Bottom Caption -->
                        <div class="mt-4 text-center">
                            <h3 class="polaroid-caption truncate px-2" x-text="item.title"></h3>
                            <div class="flex items-center justify-between text-[11px] font-semibold text-gray-500 mt-1 px-1">
                                <span class="bg-gray-100 px-2 py-0.5 rounded text-gray-600 font-bold" x-text="item.session"></span>
                                <span x-text="item.date || 'Moment'"></span>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Empty State Note Card (Matches image sample!) -->
            <div x-show="filteredImages.length === 0" 
                class="polaroid-card relative max-w-md mx-auto p-8 pt-10 rounded-sm text-center my-12 tilt-right-1"
            >
                <div class="push-pin bg-pink-500"></div>
                <h3 class="polaroid-caption text-2xl text-[#F1400C]">Note: No Photos Yet!</h3>
                <p class="polaroid-caption text-lg text-gray-600 mt-2">
                    Photos added to <span class="font-bold text-[#340C6F]" x-text="activeCategory"></span> from the Admin Panel will be pinned here automatically.
                </p>
            </div>

        </div>

        <!-- Sleek Fullscreen Lightbox -->
        <div 
            x-show="selectedIndex !== null" 
            style="display: none;"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 backdrop-blur-none"
            x-transition:enter-end="opacity-100 backdrop-blur-xl"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 backdrop-blur-xl"
            x-transition:leave-end="opacity-0 backdrop-blur-none"
            class="fixed inset-0 z-50 bg-gray-950/90 backdrop-blur-2xl flex items-center justify-center p-4 sm:p-8"
        >
            <!-- Close -->
            <button @click="selectedIndex = null" class="absolute top-6 right-6 text-white hover:text-orange-400 transition text-3xl z-50">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <!-- Left -->
            <button @click="prevImage()" class="absolute left-6 text-white hover:text-orange-400 transition text-3xl sm:text-5xl z-50">
                <i class="fa-solid fa-chevron-left"></i>
            </button>

            <!-- Lightbox Polaroid Box -->
            <div class="flex flex-col items-center justify-center max-w-[85vw] max-h-[85vh]">
                <div class="polaroid-card p-4 pb-8 rounded-sm max-w-[85vw] max-h-[75vh] flex flex-col items-center shadow-2xl">
                    <div class="push-pin bg-red-500"></div>
                    <img 
                        :src="filteredImages[selectedIndex]?.image.startsWith('http') ? filteredImages[selectedIndex]?.image : '{{ asset('') }}' + filteredImages[selectedIndex]?.image" 
                        class="max-w-[80vw] max-h-[60vh] object-contain rounded-sm" 
                    />
                    <h3 class="polaroid-caption text-2xl mt-4 text-center" x-text="filteredImages[selectedIndex]?.title"></h3>
                </div>
            </div>

            <!-- Right -->
            <button @click="nextImage()" class="absolute right-6 text-white hover:text-orange-400 transition text-3xl sm:text-5xl z-50">
                <i class="fa-solid fa-chevron-right"></i>
            </button>

            <!-- Counter -->
            <div class="absolute bottom-6 text-gray-400 text-sm font-semibold">
                <span x-text="selectedIndex + 1"></span> / <span x-text="filteredImages.length"></span>
            </div>
        </div>

    </section>
</x-app-layout>
