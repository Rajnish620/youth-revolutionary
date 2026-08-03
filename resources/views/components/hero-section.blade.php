<div>
    <section class="relative h-screen flex items-center justify-center text-white overflow-hidden">
        <!-- Background Video -->
        <video autoplay loop muted playsinline class="absolute top-0 left-0 w-full h-full object-cover">
            <source src="{{ asset('video/heroSection.mp4') }}" type="video/mp4" />
        </video>

        <!-- Dark Overlay -->
        <div class="absolute inset-0 bg-black/65"></div>

        <!-- Content -->
        <div class="relative z-10 max-w-7xl mx-auto px-6 lg:pt-40 text-center" x-data="{ show: false }" x-init="setTimeout(() => show = true, 100)">
            <h1 x-show="show" 
                x-transition:enter="transition ease-out duration-700 delay-300"
                x-transition:enter-start="opacity-0 -translate-x-32"
                x-transition:enter-end="opacity-100 translate-x-0"
                class="text-5xl md:text-7xl font-bold mb-6 text-[#F1400C]">
                <span class="text-[#340C6F]">Youth</span> Revolutionary
            </h1>

            <p x-show="show"
               x-transition:enter="transition ease-out duration-700"
               x-transition:enter-start="opacity-0 translate-x-32"
               x-transition:enter-end="opacity-100 translate-x-0"
               class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto">
               Providing Students a Platform to Showcase Their Talent Through Education, Sports, Cultural Programs & Competitive Excellence
            </p>

            <div x-show="show"
                 x-transition:enter="transition ease-out duration-700"
                 x-transition:enter-start="opacity-0 translate-x-32"
                 x-transition:enter-end="opacity-100 translate-x-0"
                 class="flex flex-col sm:flex-row justify-center gap-4">
                 
                <div class="mt-5" x-show="show"
                     x-transition:enter="transition ease-out duration-700"
                     x-transition:enter-start="opacity-0 -translate-y-32"
                     x-transition:enter-end="opacity-100 translate-y-0">
                    <a href="{{ url('/register') }}" class="bg-blue-600 hover:bg-blue-700 px-6 py-3 rounded-lg font-semibold inline-block">
                        Register Now
                    </a>
                </div>

                <div class="mt-5" x-show="show"
                     x-transition:enter="transition ease-out duration-700"
                     x-transition:enter-start="opacity-0 translate-y-32"
                     x-transition:enter-end="opacity-100 translate-y-0">
                    <a href="{{ url('/competitions/education') }}" class="border border-white px-6 py-3 rounded-lg hover:bg-white hover:text-black inline-block transition-colors">
                        Explore Competitions
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
