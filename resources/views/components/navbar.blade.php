<nav
    x-data="{ 
        menuOpen: false, 
        dropdownOpen: false, 
        mobileCompetitionOpen: false, 
        scrolled: false 
    }"
    @scroll.window="scrolled = (window.pageYOffset > 100)"
    :class="scrolled ? 'top-0 w-full shadow-md bg-white/80 backdrop-blur-lg md:rounded-b-4xl lg:rounded-b-4xl' : 'top-8 w-[85%] rounded-3xl shadow-md bg-white/80 backdrop-blur-3xl'"
    class="fixed left-1/2 -translate-x-1/2 z-50 transition-all duration-500 ease-out"
>
    <div class="max-w-7xl mx-auto px-5">
        <div class="flex justify-between items-center h-20">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="flex items-center gap-2 sm:gap-3">
                <img src="{{ asset('logo/logo.jpeg') }}" alt="Youth Revolutionary" class="w-10 h-10 sm:w-12 sm:h-12 md:w-14 md:h-14 rounded-full object-cover border-2 border-[#F1400C]">
                <div class="flex flex-col leading-none">
                    <span class="font-bold text-[#340C6F] text-xs sm:text-sm md:text-lg lg:text-xl">YOUTH</span>
                    <span class="font-bold text-[#F1400C] text-xs sm:text-sm md:text-lg lg:text-xl">REVOLUTIONARY</span>
                </div>
            </a>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center gap-8">
                <a href="{{ url('/') }}" class="focus:text-[#028CD4] font-medium">Home</a>
                <a href="{{ url('/about') }}" class="focus:text-[#028CD4] font-medium">About</a>

                <!-- Competition Dropdown -->
                <div class="relative" @click.away="dropdownOpen = false">
                    <button @click="dropdownOpen = !dropdownOpen" class="flex items-center gap-1 font-medium">
                        Competitions
                        <i x-show="!dropdownOpen" class="fa-solid fa-chevron-down text-sm"></i>
                        <i x-show="dropdownOpen" class="fa-solid fa-chevron-up text-sm" style="display: none;"></i>
                    </button>

                    <div x-show="dropdownOpen" style="display: none;"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="absolute top-10 left-0 w-56 rounded-xl border border-blue-100 bg-white shadow-xl">
                        <a href="{{ url('/competitions/education') }}" class="block px-4 py-3 hover:bg-gray-100">Education</a>
                        <a href="{{ url('/competitions/sports') }}" class="block px-4 py-3 hover:bg-gray-100">Sports</a>
                        <a href="{{ url('/competitions/cultural') }}" class="block px-4 py-3 hover:bg-gray-100">Cultural</a>
                    </div>
                </div>

                <a href="{{ url('/events') }}" class="focus:text-[#028CD4] font-medium">Events</a>
                <a href="{{ url('/results') }}" class="focus:text-[#028CD4] font-medium">Results</a>
                <a href="{{ url('/gallery') }}" class="focus:text-[#028CD4] font-medium">Gallery</a>
                <a href="{{ url('/contact') }}" class="focus:text-[#028CD4] font-medium">Contact</a>

                <div class="flex gap-4 items-center">
                    <div class="relative transform transition-all duration-300 hover:scale-105 hover:-translate-y-1 active:scale-95">
                        <span class="absolute inline-flex h-3 w-3 left-34 bottom-7 animate-ping rounded-full bg-[#3c19d8]"></span>
                        <span class="absolute inline-flex h-3 w-3 left-34 bottom-7 rounded-full bg-[#3c19d8]"></span>
                        <a href="{{ url('/register') }}" class="px-5 py-3 rounded-xl bg-[#F1400C] text-white font-bold shadow-lg border-2 border-[#F1400C] hover:bg-white hover:text-[#F1400C] transition-all duration-300">
                            Register Now
                        </a>
                    </div>
                    <div class="relative transform transition-all duration-300 hover:scale-105 hover:-translate-y-1 active:scale-95">
                        <a href="{{ url('/login') }}" class="px-4 py-2 text-sm rounded-xl bg-blue-600 text-white font-bold shadow-lg border-2 border-blue-600 hover:bg-white hover:text-blue-600 transition-all duration-300">
                            Admin
                        </a>
                    </div>
                </div>
            </div>

            <!-- Mobile Button -->
            <button class="md:hidden text-3xl" @click="menuOpen = !menuOpen">
                ☰
            </button>
        </div>

        <!-- Mobile Menu -->
        <div x-show="menuOpen" style="display: none;"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="absolute top-full left-0 right-0 z-50 bg-white/80 backdrop-blur-xl border-t shadow-2xl rounded-b-3xl p-5 flex flex-col gap-4">
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ url('/about') }}">About</a>

            <div>
                <button @click="mobileCompetitionOpen = !mobileCompetitionOpen" class="w-full flex justify-between items-center">
                    <span>Competitions</span>
                    <span x-text="mobileCompetitionOpen ? '▲' : '▼'"></span>
                </button>

                <div x-show="mobileCompetitionOpen" style="display: none;" class="ml-4 mt-3 flex flex-col gap-3 border-l-2 border-gray-200 pl-4">
                    <a href="{{ url('/competitions/education') }}">Education</a>
                    <a href="{{ url('/competitions/sports') }}">Sports</a>
                    <a href="{{ url('/competitions/cultural') }}">Cultural</a>
                </div>
            </div>

            <a href="{{ url('/events') }}">Events</a>
            <a href="{{ url('/results') }}">Results</a>
            <a href="{{ url('/gallery') }}">Gallery</a>
            <a href="{{ url('/contact') }}">Contact</a>

            <div class="flex flex-col gap-3">
                <a href="{{ url('/register') }}" class="text-center py-3 rounded-xl bg-[#F1400C] text-white font-bold">
                    Register Now
                </a>
                <a href="{{ url('/login') }}" class="text-center py-2 rounded-xl bg-blue-600 text-white font-bold text-sm">
                    Admin
                </a>
            </div>
        </div>
    </div>
</nav>
