<div>
    <section class="relative min-h-[100vh] flex items-center justify-center overflow-hidden font-sans pt-20 pb-10">
        
        <!-- Background Video -->
        <video autoplay loop muted playsinline class="absolute inset-0 w-full h-full object-cover z-0">
            <source src="{{ asset('video/heroSection.mp4') }}" type="video/mp4" />
        </video>
        
        <!-- Dark Overlay for better text readability -->
        <div class="absolute inset-0 bg-black/60 z-0"></div>

        <!-- Centered Content -->
        <div class="relative z-10 w-full max-w-6xl mx-auto flex flex-col items-center justify-center text-center p-6 text-white" x-data="{ show: false }" x-init="setTimeout(() => show = true, 100)">
            <style>
                .metallic-blue-shine {
                    background: linear-gradient(110deg, #1e3c72 0%, #3a7bd5 25%, #8bbdeb 45%, #ffffff 50%, #8bbdeb 55%, #3a7bd5 75%, #1e3c72 100%);
                    background-size: 200% auto;
                    -webkit-background-clip: text;
                    -webkit-text-fill-color: transparent;
                    color: transparent;
                    animation: metallicShine 3s linear infinite;
                }
                .metallic-orange-shine {
                    background: linear-gradient(110deg, #8a1a03 0%, #f1400c 25%, #ff8c6b 45%, #ffffff 50%, #ff8c6b 55%, #f1400c 75%, #8a1a03 100%);
                    background-size: 200% auto;
                    -webkit-background-clip: text;
                    -webkit-text-fill-color: transparent;
                    color: transparent;
                    animation: metallicShine 3s linear infinite;
                }
                @keyframes metallicShine {
                    to { background-position: 200% center; }
                }
                .text-shine-white {
                    background: linear-gradient(110deg, #bbbbbb 0%, #ffffff 25%, #ffffff 45%, #ffffff 50%, #ffffff 55%, #bbbbbb 75%, #bbbbbb 100%);
                    background-size: 200% auto;
                    -webkit-background-clip: text;
                    -webkit-text-fill-color: transparent;
                    color: transparent;
                    animation: metallicShine 4s linear infinite;
                }
            </style>

            <h1 x-show="show" 
                x-transition:enter="transition ease-out duration-700 delay-300"
                x-transition:enter-start="opacity-0 -translate-y-8 sm:-translate-x-32 sm:translate-y-0"
                x-transition:enter-end="opacity-100 translate-x-0 translate-y-0"
                class="text-5xl sm:text-7xl md:text-8xl font-bold mb-6">
                <span class="metallic-blue-shine drop-shadow-[0_0_10px_rgba(58,123,213,0.5)]">Youth</span>
                <br class="sm:hidden" />
                <span class="metallic-orange-shine drop-shadow-[0_0_10px_rgba(241,64,12,0.5)]">Revolutionary</span>
            </h1>

            <p x-show="show"
               x-transition:enter="transition ease-out duration-700"
               x-transition:enter-start="opacity-0 translate-y-8 sm:translate-x-32 sm:translate-y-0"
               x-transition:enter-end="opacity-100 translate-x-0 translate-y-0"
               class="text-lg sm:text-xl md:text-2xl mb-8 max-w-4xl mx-auto min-h-[5rem] sm:min-h-[4rem] font-medium text-shine-white"
               x-data="{ 
                   text: 'Providing Students a Platform to Showcase Their Talent Through Education, Sports, Cultural Programs & Competitive Excellence',
                   typewriterText: '',
                   typeWriter() {
                       let i = 0;
                       let isDeleting = false;
                       let speed = 40;
                       
                       let loop = () => {
                           if (!isDeleting && i <= this.text.length) {
                               this.typewriterText = this.text.substring(0, i);
                               i++;
                               setTimeout(loop, speed);
                           } else if (isDeleting && i >= 0) {
                               this.typewriterText = this.text.substring(0, i);
                               i--;
                               setTimeout(loop, speed / 2);
                           } else {
                               isDeleting = !isDeleting;
                               setTimeout(loop, isDeleting ? 3000 : 500);
                           }
                       };
                       loop();
                   }
               }"
               x-init="setTimeout(() => typeWriter(), 1000)">
               <span x-text="typewriterText"></span><span class="animate-pulse text-white">|</span>
            </p>

            <div x-show="show"
                 x-transition:enter="transition ease-out duration-700"
                 x-transition:enter-start="opacity-0 translate-y-8 sm:translate-x-32 sm:translate-y-0"
                 x-transition:enter-end="opacity-100 translate-x-0 translate-y-0"
                 class="flex flex-col sm:flex-row justify-center gap-4 mt-8">
                 
                <div class="mt-2">
                    <a href="{{ url('/register') }}" class="bg-blue-600 hover:bg-blue-700 px-8 py-4 rounded-lg font-bold text-lg inline-block text-white transition-all transform hover:scale-105 shadow-lg">
                        Register Now
                    </a>
                </div>

                <div class="mt-2">
                    <a href="{{ url('/competitions/education') }}" class="bg-white/10 backdrop-blur-md border border-white/50 px-8 py-4 rounded-lg hover:bg-white hover:text-black inline-block transition-all transform hover:scale-105 shadow-lg text-white font-bold text-lg">
                        Explore Competitions
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
