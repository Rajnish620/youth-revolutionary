<x-app-layout>
    <x-hero-section />
    
    <x-categories-section />

    <!-- Upcoming Events Section -->
    <section class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-14" x-data="{ show: false }" x-intersect.once="show = true">
                <h2 x-show="show" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0" class="text-4xl font-bold text-center mb-12 text-blue-600">
                    Upcoming Events
                </h2>
                <h2 x-show="show" x-transition:enter="transition ease-out duration-700 delay-100" x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0" class="text-4xl md:text-5xl font-bold mt-3">
                    Participate & Showcase Your Talent
                </h2>
                <p x-show="show" x-transition:enter="transition ease-out duration-700 delay-200" x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0" class="text-gray-600 mt-4 max-w-2xl mx-auto">
                    Join exciting competitions in Education, Sports and Cultural activities and compete with talented students.
                </p>
            </div>

            <!-- Featured Video -->
            <div class="mb-16" x-data="{ show: false }" x-intersect.once="show = true">
                <div x-show="show" x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="relative overflow-hidden rounded-3xl shadow-2xl h-64 md:h-[500px]">
                    <video autoplay muted loop playsinline class="absolute top-0 left-0 w-full h-full object-cover">
                        <source src="{{ asset('video/videoplayback (4).mp4') }}" type="video/mp4" />
                    </video>
                    <div class="absolute inset-0 bg-black/50"></div>
                    <div class="absolute inset-0 flex items-center justify-center text-center px-6">
                        <div>
                            <h3 class="text-white text-4xl md:text-6xl font-bold mb-4">Youth Revolutionary Events</h3>
                            <p class="text-gray-200 text-lg md:text-xl max-w-2xl mx-auto">
                                Experience the excitement of competitions, sports tournaments and cultural performances.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-events-section />
    <x-gallery-section />

    <!-- About -->
    <section class="py-20">
        <div class="max-w-6xl mx-auto px-6 text-center" x-data="{ show: false }" x-intersect.once="show = true">
            <h2 x-show="show" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0" class="text-4xl font-bold mb-6">
                About Youth Revolutionary
            </h2>
            <p x-show="show" x-transition:enter="transition ease-out duration-700 delay-100" x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0" class="text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Youth Revolutionary is a platform for students from Class 5th to 12th to showcase their talent through Education, Sports and Cultural Competitions.
            </p>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="bg-gray-100 py-20">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-4xl font-bold text-center mb-12" x-data="{ show: false }" x-intersect.once="show = true" x-show="show" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0">
                Why Choose Us
            </h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6 text-center" x-data="{ show: false }" x-intersect.once="show = true">
                <div x-show="show" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 translate-y-24" x-transition:enter-end="opacity-100 translate-y-0" class="bg-white p-6 rounded-xl shadow hover:-translate-y-2 transition duration-300">
                    <span class="text-4xl">🏆</span>
                    <h3 class="font-bold mt-3 text-lg">Fair Competition</h3>
                </div>
                <div x-show="show" x-transition:enter="transition ease-out duration-700 delay-[150ms]" x-transition:enter-start="opacity-0 translate-y-24" x-transition:enter-end="opacity-100 translate-y-0" class="bg-white p-6 rounded-xl shadow hover:-translate-y-2 transition duration-300">
                    <span class="text-4xl">📜</span>
                    <h3 class="font-bold mt-3 text-lg">Certificates</h3>
                </div>
                <div x-show="show" x-transition:enter="transition ease-out duration-700 delay-[300ms]" x-transition:enter-start="opacity-0 translate-y-24" x-transition:enter-end="opacity-100 translate-y-0" class="bg-white p-6 rounded-xl shadow hover:-translate-y-2 transition duration-300">
                    <span class="text-4xl">🎯</span>
                    <h3 class="font-bold mt-3 text-lg">Skill Development</h3>
                </div>
                <div x-show="show" x-transition:enter="transition ease-out duration-700 delay-[450ms]" x-transition:enter-start="opacity-0 translate-y-24" x-transition:enter-end="opacity-100 translate-y-0" class="bg-white p-6 rounded-xl shadow hover:-translate-y-2 transition duration-300">
                    <span class="text-4xl">🌍</span>
                    <h3 class="font-bold mt-3 text-lg">State Level Exposure</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="bg-[#028CD4] text-white py-20">
        <div class="text-center px-6" x-data="{ show: false }" x-intersect.once="show = true">
            <h2 x-show="show" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="text-4xl font-bold mb-4">
                Ready to Showcase Your Talent?
            </h2>
            <p x-show="show" x-transition:enter="transition ease-out duration-700 delay-100" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="mb-8 text-lg">
                Join Youth Revolutionary Today
            </p>
            <div x-show="show" x-transition:enter="transition ease-out duration-700 delay-200" x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0">
                <a href="{{ url('/register') }}" class="inline-block bg-white text-blue-600 px-8 py-4 rounded-lg font-bold text-lg hover:bg-gray-100 transition transform hover:scale-105 active:scale-95 shadow-lg">
                    Register Now
                </a>
            </div>
        </div>
    </section>
</x-app-layout>
