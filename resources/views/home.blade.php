<x-app-layout>
    <!-- DO NOT TOUCH HERO SECTION -->
    <x-hero-section />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;600;700;800;900&display=swap');
        
        .brutalist-font {
            font-family: 'Space Grotesk', sans-serif;
        }

        .bg-cream { background-color: #F2EFE9; }
        .bg-dark-brown { background-color: #1A1818; }
        .bg-neo-yellow { background-color: #FDE047; }
        .bg-neo-pink { background-color: #F472B6; }
        .bg-neo-cyan { background-color: #67E8F9; }
        .bg-neo-lime { background-color: #D9F99D; }
        .text-neo-pink { color: #F952EC; }
        
        .shining-pink {
            background: linear-gradient(110deg, #F952EC 0%, #ff9aee 25%, #ffffff 45%, #ffffff 50%, #ff9aee 55%, #F952EC 75%, #F952EC 100%);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            color: transparent;
            animation: shineAnim 3s linear infinite;
        }
        @keyframes shineAnim {
            to { background-position: 200% center; }
        }
        
        .neo-border {
            border: 3px solid #000;
        }
        
        .neo-shadow {
            box-shadow: 6px 6px 0px 0px rgba(0,0,0,1);
        }
        
        .neo-shadow:hover {
            box-shadow: 2px 2px 0px 0px rgba(0,0,0,1);
            transform: translate(4px, 4px);
        }
        
        .neo-shadow-lg {
            box-shadow: 12px 12px 0px 0px rgba(0,0,0,1);
        }

        .polaroid {
            background: #fff;
            padding: 8px 8px 30px 8px;
            border: 2px solid #000;
            box-shadow: 6px 6px 0px 0px rgba(0,0,0,1);
        }

        .text-mask {
            background-image: url('https://images.unsplash.com/photo-1540575467063-178a50c2df87?q=80&w=2000&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            -webkit-background-clip: text;
            color: transparent;
            -webkit-text-fill-color: transparent;
        }

        .tape {
            position: absolute;
            width: 80px;
            height: 25px;
            background-color: rgba(255, 255, 255, 0.6);
            border: 1px solid #ccc;
            box-shadow: 1px 1px 3px rgba(0,0,0,0.1);
            z-index: 10;
            transform: rotate(-3deg);
        }
    </style>

    <!-- SECTION 1: IMPACT (Scattered Polaroids & Massive Text) -->
    <section class="bg-cream py-24 relative overflow-hidden brutalist-font">
        <div class="max-w-6xl mx-auto px-6 relative z-10 text-center">
            
            <div class="mb-12 relative z-20">
                <span class="inline-block px-6 py-2 bg-neo-yellow neo-border text-black font-bold uppercase text-xs mb-8">
                    join the competitions
                </span>
                
                <h2 class="text-5xl md:text-7xl font-black text-black leading-[1.1] max-w-4xl mx-auto tracking-tighter lowercase relative z-20">
                    what if 
                    <span class="shining-pink" 
                          x-data="{ 
                              text: 'participating', 
                              typewriterText: '', 
                              typeWriter() { 
                                  let i = 0; 
                                  let speed = 100; 
                                  let interval = setInterval(() => { 
                                      if(i < this.text.length) { 
                                          this.typewriterText += this.text.charAt(i); 
                                          i++; 
                                      } else { 
                                          clearInterval(interval); 
                                      } 
                                  }, speed); 
                              } 
                          }" 
                          x-init="setTimeout(() => typeWriter(), 500)">
                        <span x-text="typewriterText"></span><span class="animate-pulse text-black">|</span>
                    </span> 
                    in competitions could change <span class="text-neo-yellow" style="-webkit-text-stroke: 2px #000;">everything?</span>
                </h2>
            </div>

            <div class="max-w-3xl mx-auto mb-20 text-center">
                <p class="text-gray-800 font-semibold leading-relaxed text-sm md:text-base">
                    A single performance clears the stage, reveals the talent, builds confidence, and drives ambition. Now imagine thousands. Imagine communities coming together, getting their hands dirty, stepping onto the ground. Together, we're turning potential into power, and a future we can actually believe in.
                </p>
            </div>

            <!-- Massive +25k Text with Image Mask and Assembly Animation -->
            <div class="relative w-full flex justify-center mb-10 py-10 overflow-hidden" 
                 x-data="{ show: false }"
                 x-init="
                     let observer = new IntersectionObserver((entries) => {
                         if(entries[0].isIntersecting) {
                             setTimeout(() => show = true, 100);
                             observer.disconnect();
                         }
                     }, { threshold: 0.3 });
                     observer.observe($el);
                 ">
                <h1 class="text-[120px] md:text-[200px] font-black tracking-tighter leading-none text-mask drop-shadow-[8px_8px_0px_rgba(0,0,0,1)] flex" style="-webkit-text-stroke: 4px #000;">
                    <span class="inline-block transition-all duration-1000 ease-[cubic-bezier(0.34,1.56,0.64,1)]"
                          :class="show ? 'translate-y-0 translate-x-0 rotate-0 scale-100 opacity-100' : '-translate-y-64 -translate-x-64 -rotate-90 scale-50 opacity-0'">
                        +
                    </span>
                    <span class="inline-block transition-all duration-1000 delay-100 ease-[cubic-bezier(0.34,1.56,0.64,1)]"
                          :class="show ? 'translate-y-0 translate-x-0 rotate-0 scale-100 opacity-100' : '-translate-y-64 translate-x-64 rotate-90 scale-50 opacity-0'">
                        2
                    </span>
                    <span class="inline-block transition-all duration-1000 delay-200 ease-[cubic-bezier(0.34,1.56,0.64,1)]"
                          :class="show ? 'translate-y-0 translate-x-0 rotate-0 scale-100 opacity-100' : 'translate-y-64 -translate-x-64 -rotate-90 scale-50 opacity-0'">
                        5
                    </span>
                    <span class="inline-block transition-all duration-1000 delay-300 ease-[cubic-bezier(0.34,1.56,0.64,1)]"
                          :class="show ? 'translate-y-0 translate-x-0 rotate-0 scale-100 opacity-100' : 'translate-y-64 translate-x-64 rotate-90 scale-50 opacity-0'">
                        k
                    </span>
                </h1>
            </div>
            
            <p class="font-black text-black text-lg md:text-xl uppercase tracking-tight mb-4">
                25,000+ students have joined the Competitions.
            </p>
            <p class="text-gray-600 text-xs md:text-sm font-semibold max-w-xl mx-auto mb-10">
                Students from all walks of life are stepping up to learn, compete, and build their futures. Together, we're taking education to the next level.
            </p>

            <a href="{{ url('/register') }}" class="inline-block bg-neo-lime neo-border px-8 py-3 font-black text-black uppercase hover:bg-black hover:text-neo-lime transition-colors">
                register with us
            </a>

            <!-- SCATTERED POLAROIDS (Absolute positioned) -->
            <!-- Polaroid 1 (Top Left) -->
            <div class="absolute top-16 -left-10 xl:-left-24 2xl:-left-12 -rotate-[12deg] w-48 hidden xl:block z-0 opacity-90 hover:opacity-100 transition-opacity duration-300 hover:z-30 hover:scale-105">
                <div class="tape -top-3 left-1/2 -translate-x-1/2"></div>
                <div class="polaroid">
                    <img src="{{ $homeSetting->polaroid_1_image ? asset($homeSetting->polaroid_1_image) : 'https://images.unsplash.com/photo-1577896851231-70ef18881754?q=80&w=600&auto=format&fit=crop' }}" class="w-full h-40 object-cover border border-black mb-2" alt="Polaroid 1">
                    <p class="font-bold text-center text-sm transform -rotate-2 handwritten font-serif">{{ $homeSetting->polaroid_1_text }}</p>
                </div>
            </div>

            <!-- Polaroid 2 (Middle Right) -->
            <div class="absolute top-48 -right-10 xl:-right-24 2xl:-right-12 rotate-[8deg] w-48 hidden xl:block z-0 opacity-90 hover:opacity-100 transition-opacity duration-300 hover:z-30 hover:scale-105">
                <div class="tape -top-3 left-1/2 -translate-x-1/2 rotate-6"></div>
                <div class="polaroid">
                    <img src="{{ $homeSetting->polaroid_2_image ? asset($homeSetting->polaroid_2_image) : 'https://images.unsplash.com/photo-1517649763962-0c623066013b?q=80&w=600&auto=format&fit=crop' }}" class="w-full h-40 object-cover border border-black mb-2" alt="Polaroid 2">
                    <p class="font-bold text-center text-sm transform rotate-1 handwritten font-serif">{{ $homeSetting->polaroid_2_text }}</p>
                </div>
            </div>

            <!-- Polaroid 3 (Bottom Left) -->
            <div class="absolute bottom-20 -left-10 xl:-left-24 2xl:-left-12 -rotate-[6deg] w-56 hidden xl:block z-0 opacity-90 hover:opacity-100 transition-opacity duration-300 hover:z-30 hover:scale-105">
                <div class="tape -top-3 left-1/2 -translate-x-1/2 -rotate-2"></div>
                <div class="polaroid">
                    <img src="{{ $homeSetting->polaroid_3_image ? asset($homeSetting->polaroid_3_image) : 'https://images.unsplash.com/photo-1543269865-cbf427effbad?q=80&w=600&auto=format&fit=crop' }}" class="w-full h-48 object-cover border border-black mb-2" alt="Polaroid 3">
                    <p class="font-bold text-center text-sm font-serif">{{ $homeSetting->polaroid_3_text }}</p>
                </div>
            </div>
            
        </div>
    </section>

    <!-- SECTION 2: WHAT YOU CAN DO (Bento Grid) -->
    <!-- We use a subtle topography/noise background pattern via inline CSS or Tailwind if available -->
    <section class="bg-dark-brown py-24 relative overflow-hidden brutalist-font" style="background-image: radial-gradient(rgba(255,255,255,0.05) 1px, transparent 1px); background-size: 20px 20px;">
        <div class="max-w-4xl mx-auto px-6">
            
            <h2 class="text-5xl md:text-6xl font-black text-white text-center mb-16 tracking-tighter lowercase drop-shadow-[4px_4px_0_#000]" style="-webkit-text-stroke: 1px #000;">
                what you can do?
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <!-- Box 1 (Yellow) - Education -->
                <a href="{{ url('/competitions/education') }}" class="block bg-neo-yellow neo-border neo-shadow p-6 flex flex-col justify-between aspect-video md:aspect-auto transition-transform">
                    <div class="text-4xl text-black mb-4">
                        <i class="fa-solid fa-book-open"></i>   
                    </div>
                    <div class="flex justify-end w-full">
                        <h3 class="font-black text-black text-2xl lowercase tracking-tight">education</h3>
                    </div>
                </a>

                <!-- Box 2 (Pink) - Sports -->
                <a href="{{ url('/competitions/sports') }}" class="block bg-neo-pink neo-border neo-shadow p-6 flex flex-col justify-between aspect-video md:aspect-auto transition-transform">
                    <div class="flex gap-2 mb-4">
                        <img src="https://images.unsplash.com/photo-1541534741688-6078c6bfb5c5?w=100&h=100&fit=crop" class="w-12 h-12 rounded-full border-2 border-black object-cover" alt="S1">
                        <img src="https://images.unsplash.com/photo-1517649763962-0c623066013b?w=100&h=100&fit=crop" class="w-12 h-12 rounded-full border-2 border-black object-cover -ml-4" alt="S2">
                    </div>
                    <div class="flex justify-end w-full">
                        <h3 class="font-black text-black text-2xl lowercase tracking-tight">join sports</h3>
                    </div>
                </a>

                <!-- Box 3 (Cyan) - Cultural -->
                <a href="{{ url('/competitions/cultural') }}" class="block bg-neo-cyan neo-border neo-shadow p-6 flex flex-col justify-between aspect-video md:aspect-auto transition-transform">
                    <div class="text-4xl text-black mb-4">
                        <i class="fa-solid fa-masks-theater"></i>
                    </div>
                    <div class="flex justify-end w-full">
                        <h3 class="font-black text-black text-2xl lowercase tracking-tight">cultural events</h3>
                    </div>
                </a>

                <!-- Box 4 (Pink) - Volunteer/Register -->
                <a href="{{ url('/register') }}" class="block bg-neo-pink neo-border neo-shadow p-6 flex flex-col justify-center items-center aspect-video md:aspect-auto transition-transform">
                    <h3 class="font-black text-black text-2xl lowercase tracking-tight text-center">
                        become a<br>participant
                    </h3>
                </a>

                {{-- 
                <!-- Box (Lime) - Full Width -->
                <a href="{{ url('/competitions') }}" class="block md:col-span-2 bg-neo-lime neo-border neo-shadow p-6 flex items-center justify-center transition-transform hover:-translate-y-1 hover:shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                    <h3 class="font-black text-black text-2xl lowercase tracking-tight">
                        view all categories
                    </h3>
                </a>
                --}}

            </div>
        </div>
    </section>

    {{-- 
    <!-- SECTION 3: HUMANS WHO CARE (Cards) -->
    <section class="bg-[#24211D] py-24 brutalist-font border-t-[6px] border-black">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-4xl md:text-5xl font-black text-neo-pink tracking-tighter lowercase mb-12">
                humans who care
            </h2>

            <!-- Horizontal Scroll Container -->
            <div class="flex overflow-x-auto gap-6 pb-8 hide-scrollbar snap-x">
                
                <!-- Card 1 -->
                <div class="min-w-[320px] max-w-[320px] md:min-w-[400px] bg-[#1E1C19] border-2 border-[#3A3835] p-6 rounded-lg snap-start">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-neo-lime font-black text-2xl leading-tight w-1/2">fair<br>competition</h3>
                        <img src="https://images.unsplash.com/photo-1577896851231-70ef18881754?q=80&w=200&auto=format&fit=crop" class="w-24 h-24 object-cover neo-border grayscale" alt="Thumb">
                    </div>
                    <p class="text-gray-400 text-xs font-semibold leading-relaxed">
                        A methodology where human bias meets AI fairness. We know what deserves recognition. Equal opportunities, exciting stages, oxygen, and inspiration. Free events for all eligible candidates.
                    </p>
                </div>

                <!-- Card 2 -->
                <div class="min-w-[320px] max-w-[320px] md:min-w-[400px] bg-[#1E1C19] border-2 border-[#3A3835] p-6 rounded-lg snap-start">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-neo-lime font-black text-2xl leading-tight w-1/2">teens for<br>talent</h3>
                        <img src="https://images.unsplash.com/photo-1543269865-cbf427effbad?q=80&w=200&auto=format&fit=crop" class="w-24 h-24 object-cover neo-border grayscale" alt="Thumb">
                    </div>
                    <p class="text-gray-400 text-xs font-semibold leading-relaxed">
                        Armed with passion, determination, and raw talent, they transform into local heroes. This is the first step towards a better future—one student, one performance, and one stage at a time.
                    </p>
                </div>

                <!-- Card 3 -->
                <div class="min-w-[320px] max-w-[320px] md:min-w-[400px] bg-[#1E1C19] border-2 border-[#3A3835] p-6 rounded-lg snap-start">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-neo-lime font-black text-2xl leading-tight w-1/2">support<br>network</h3>
                        <img src="https://images.unsplash.com/photo-1526676037777-05a232554f77?q=80&w=200&auto=format&fit=crop" class="w-24 h-24 object-cover neo-border grayscale" alt="Thumb">
                    </div>
                    <p class="text-gray-400 text-xs font-semibold leading-relaxed">
                        People from all over the state are stepping up to protect and empower the youth. Together we are turning raw potential into champions of tomorrow, across all districts.
                    </p>
                </div>

            </div>

            <!-- Scroll indicator -->
            <div class="flex justify-center items-center gap-4 mt-8 text-neo-pink font-black text-xl">
                <span>01</span>
                <div class="w-32 h-2 flex items-center">
                    <div class="w-full border-t-[3px] border-dashed border-[#3A3835]"></div>
                    <i class="fa-solid fa-leaf text-neo-lime absolute left-1/2 -translate-x-1/2 bg-[#24211D] px-2 text-2xl"></i>
                </div>
                <span>03</span>
            </div>
        </div>
    </section>
    --}}

    <!-- SECTION 4: CTA FOOTER -->
    <section class="bg-cream py-32 text-center brutalist-font border-t-[6px] border-black">
        <div class="max-w-5xl mx-auto px-6">
            
            <h1 class="text-[100px] sm:text-[150px] md:text-[250px] font-black tracking-tighter leading-none text-mask mb-10" style="-webkit-text-stroke: 4px #000; background-image: url('https://images.unsplash.com/photo-1511632765486-a01980e01a18?q=80&w=2000&auto=format&fit=crop');">
                next gen.
            </h1>

            <a href="{{ url('/register') }}" class="inline-block bg-black text-white px-10 py-4 font-black text-sm uppercase tracking-widest hover:bg-neo-lime hover:text-black neo-border transition-colors">
                let's grow. Register Now
            </a>
            
        </div>
    </section>

</x-app-layout>
