<style>
    @keyframes marquee {
        0% { transform: translateX(100vw); }
        100% { transform: translateX(-100%); }
    }
    .animate-marquee {
        animation: marquee 25s linear infinite;
    }
    .animate-marquee:hover {
        animation-play-state: paused;
    }
</style>

<!-- Top Updates Ticker -->
<div class="fixed top-0 left-0 w-full bg-black text-white z-[60] h-8 sm:h-10 flex items-center overflow-hidden border-b border-white/20 shadow-md">
    <div class="whitespace-nowrap animate-marquee flex items-center">
        @php
            // Fetch the latest 5 active events/competitions from the database (status: upcoming or ongoing)
            $recentEvents = \App\Models\Event::whereIn('status', ['upcoming', 'ongoing'])->latest()->take(5)->get();
        @endphp

        @forelse($recentEvents as $event)
            <a href="{{ url('/competitions/' . strtolower(str_replace(' ', '-', $event->category))) }}" class="inline-flex items-center gap-2 hover:text-accent transition-colors font-manrope font-bold text-[10px] sm:text-xs tracking-wider uppercase px-4 cursor-pointer">
                <span class="relative flex h-2 w-2 mr-1">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-accent opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-2 w-2 bg-accent"></span>
                </span>
                New Registration Open: {{ $event->title }}! Apply Now.
            </a>
            <span class="text-white/30 mx-4">✦</span>
        @empty
            <a href="{{ url('/competitions') }}" class="inline-flex items-center gap-2 hover:text-accent transition-colors font-manrope font-bold text-[10px] sm:text-xs tracking-wider uppercase px-4 cursor-pointer">
                <span class="relative flex h-2 w-2 mr-1">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-accent opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-2 w-2 bg-accent"></span>
                </span>
                Stay tuned for upcoming competitions!
            </a>
            <span class="text-white/30 mx-4">✦</span>
        @endforelse
    </div>
</div>

<nav
    x-data="{ 
        menuOpen: false, 
        dropdownOpen: false, 
        mobileCompetitionOpen: false, 
        scrolled: false 
    }"
    @scroll.window="scrolled = (window.pageYOffset > 50)"
    :class="scrolled ? 'top-8 sm:top-10 w-full shadow-md bg-white/90 backdrop-blur-xl md:rounded-b-4xl border-b border-gray-100' : 'top-12 sm:top-16 md:top-20 w-[92%] sm:w-[90%] lg:w-[85%] max-w-7xl rounded-3xl shadow-lg bg-white/80 backdrop-blur-3xl border border-white/50'"
    class="fixed left-1/2 -translate-x-1/2 z-50 transition-all duration-500 ease-out"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex justify-between items-center h-16 sm:h-20">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="flex items-center gap-2 sm:gap-3 shrink-0">
                <img src="{{ asset('logo/logo.jpeg') }}" alt="Youth Revolutionary" class="w-9 h-9 sm:w-11 sm:h-11 md:w-13 md:h-13 rounded-full object-cover border-2 border-[#F1400C]">
                <div class="flex flex-col leading-none">
                    <span class="font-bold text-[#340C6F] text-xs sm:text-sm md:text-base lg:text-lg">YOUTH</span>
                    <span class="font-bold text-[#F1400C] text-[10px] sm:text-xs md:text-sm lg:text-base">REVOLUTIONARY</span>
                </div>
            </a>

            <!-- Desktop Menu (Shows on lg / 1024px+ screens) -->
            <div class="hidden lg:flex items-center gap-4 xl:gap-7">
                <a href="{{ url('/') }}" class="focus:text-[#028CD4] hover:text-[#028CD4] font-medium text-xs xl:text-sm text-gray-800 transition-colors">Home</a>
                <a href="{{ url('/about') }}" class="focus:text-[#028CD4] hover:text-[#028CD4] font-medium text-xs xl:text-sm text-gray-800 transition-colors">About</a>

                <!-- Competition Dropdown -->
                <div class="relative" @click.away="dropdownOpen = false">
                    <button @click="dropdownOpen = !dropdownOpen" class="flex items-center gap-1.5 focus:text-[#028CD4] hover:text-[#028CD4] font-medium text-xs xl:text-sm text-gray-800 transition-colors cursor-pointer">
                        <span>Competitions</span>
                        <i x-show="!dropdownOpen" class="fa-solid fa-chevron-down text-[10px]"></i>
                        <i x-show="dropdownOpen" class="fa-solid fa-chevron-up text-[10px]" style="display: none;"></i>
                    </button>

                    <div x-show="dropdownOpen" style="display: none;"
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="transform opacity-0 scale-95 -translate-y-2"
                         x-transition:enter-end="transform opacity-100 scale-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="transform opacity-100 scale-100 translate-y-0"
                         x-transition:leave-end="transform opacity-0 scale-95 -translate-y-2"
                         class="absolute top-full left-0 mt-3 w-56 rounded-2xl border border-blue-100 bg-white shadow-xl py-2 z-50">
                        @php
                            $navCategories = \App\Models\Category::orderBy('name', 'asc')->get();
                        @endphp
                        @foreach($navCategories as $category)
                            @php 
                                $slug = strtolower(str_replace(' ', '-', $category->name)); 
                            @endphp
                            <a href="{{ url('/competitions/' . $slug) }}" class="block px-4 py-2.5 hover:bg-blue-50 text-xs font-semibold text-gray-700 hover:text-[#028CD4] transition-colors">{{ $category->name }}</a>
                        @endforeach
                    </div>
                </div>

                {{-- <a href="{{ url('/events') }}" class="focus:text-[#028CD4] hover:text-[#028CD4] font-medium text-xs xl:text-sm text-gray-800 transition-colors">Events</a> --}}
                <a href="{{ route('admit-card.index') }}" class="focus:text-[#028CD4] hover:text-[#028CD4] font-medium text-xs xl:text-sm text-gray-800 transition-colors">Admit Card</a>
                <a href="{{ url('/results') }}" class="focus:text-[#028CD4] hover:text-[#028CD4] font-medium text-xs xl:text-sm text-gray-800 transition-colors">Results</a>
                <a href="{{ url('/gallery') }}" class="focus:text-[#028CD4] hover:text-[#028CD4] font-medium text-xs xl:text-sm text-gray-800 transition-colors">Gallery</a>
                <a href="{{ url('/contact') }}" class="focus:text-[#028CD4] hover:text-[#028CD4] font-medium text-xs xl:text-sm text-gray-800 transition-colors">Contact</a>

                <div class="flex gap-3 items-center shrink-0">
                    <div class="relative transform transition-all duration-300 hover:scale-105 hover:-translate-y-0.5 active:scale-95">
                        <span class="absolute -top-1 -right-1 flex h-3 w-3">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#3c19d8] opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-[#3c19d8]"></span>
                        </span>
                        <a href="{{ url('/register') }}" class="px-4 py-2.5 sm:px-5 sm:py-3 rounded-xl bg-[#F1400C] text-white text-xs xl:text-sm font-bold shadow-lg border-2 border-[#F1400C] hover:bg-white hover:text-[#F1400C] transition-all duration-300 inline-block">
                            Register Now
                        </a>
                    </div>
                    <div class="relative transform transition-all duration-300 hover:scale-105 hover:-translate-y-0.5 active:scale-95">
                        <a href="{{ url('/login') }}" class="px-3.5 py-2 text-xs xl:text-sm rounded-xl bg-blue-600 text-white font-bold shadow-lg border-2 border-blue-600 hover:bg-white hover:text-blue-600 transition-all duration-300 inline-block">
                            Admin
                        </a>
                    </div>
                </div>
            </div>

            <!-- Mobile Button -->
            <button class="lg:hidden text-2xl sm:text-3xl text-gray-800 p-1.5 focus:outline-none" @click="menuOpen = !menuOpen" aria-label="Toggle menu">
                <span x-text="menuOpen ? '✕' : '☰'"></span>
            </button>
        </div>

        <!-- Mobile Menu (Drawer inside glass pill) -->
        <div x-show="menuOpen" style="display: none;"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="absolute top-full left-0 right-0 mt-2 z-50 bg-white/95 backdrop-blur-2xl border border-gray-100 shadow-2xl rounded-3xl p-5 flex flex-col gap-3 font-medium text-gray-800">
            <a href="{{ url('/') }}" @click="menuOpen = false" class="hover:text-[#028CD4] py-1">Home</a>
            <a href="{{ url('/about') }}" @click="menuOpen = false" class="hover:text-[#028CD4] py-1">About</a>

            <div>
                <button @click="mobileCompetitionOpen = !mobileCompetitionOpen" class="w-full flex justify-between items-center py-1 hover:text-[#028CD4]">
                    <span>Competitions</span>
                    <span class="text-xs" x-text="mobileCompetitionOpen ? '▲' : '▼'"></span>
                </button>

                <div x-show="mobileCompetitionOpen" style="display: none;" class="ml-4 mt-2 flex flex-col gap-2.5 border-l-2 border-blue-200 pl-4 text-sm">
                    @php
                        $navCategories = \App\Models\Category::orderBy('name', 'asc')->get();
                    @endphp
                    @foreach($navCategories as $category)
                        @php 
                            $slug = strtolower(str_replace(' ', '-', $category->name)); 
                        @endphp
                        <a href="{{ url('/competitions/' . $slug) }}" @click="menuOpen = false" class="hover:text-[#028CD4]">{{ $category->name }}</a>
                    @endforeach
                </div>
            </div>

            {{-- <a href="{{ url('/events') }}" @click="menuOpen = false" class="hover:text-[#028CD4] py-1">Events</a> --}}
            <a href="{{ route('admit-card.index') }}" @click="menuOpen = false" class="hover:text-[#028CD4] py-1">Admit Card</a>
            <a href="{{ url('/results') }}" @click="menuOpen = false" class="hover:text-[#028CD4] py-1">Results</a>
            <a href="{{ url('/gallery') }}" @click="menuOpen = false" class="hover:text-[#028CD4] py-1">Gallery</a>
            <a href="{{ url('/contact') }}" @click="menuOpen = false" class="hover:text-[#028CD4] py-1">Contact</a>

            <div class="flex flex-col gap-2.5 pt-2 border-t border-gray-100 mt-1">
                <a href="{{ url('/register') }}" @click="menuOpen = false" class="text-center py-3 rounded-xl bg-[#F1400C] text-white font-bold shadow-md">
                    Register Now
                </a>
                <a href="{{ url('/login') }}" @click="menuOpen = false" class="text-center py-2.5 rounded-xl bg-blue-600 text-white font-bold text-sm shadow-md">
                    Admin
                </a>
            </div>
        </div>
    </div>
</nav>
