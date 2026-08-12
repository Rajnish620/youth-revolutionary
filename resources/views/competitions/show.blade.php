<x-app-layout>
    <!-- Google Fonts: Editorial Serif + Modern Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    
    <style>
        [x-cloak] { display: none !important; }
        .font-manrope { font-family: 'Manrope', sans-serif; }
        .font-playfair { font-family: 'Playfair Display', serif; }
        
        /* Tactile Paper Theme Colors */
        .bg-paper { background-color: #F4F4F0; }
        .text-ink { color: #0A0A0A; }
        .bg-ink { background-color: #0A0A0A; }
        .text-accent { color: #FF4400; }
        .bg-accent { background-color: #FF4400; }

        ::selection { background: #FF4400; color: #F4F4F0; }

        /* Light Grain Overlay */
        .grain-overlay {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            pointer-events: none;
            z-index: 30;
            opacity: 0.3;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)'/%3E%3C/svg%3E");
            mix-blend-mode: multiply;
        }

        /* Marquee Animation & Pause on Hover */
        .marquee-container { overflow: hidden; white-space: nowrap; }
        .marquee-content { display: inline-block; animation: marquee 22s linear infinite; }
        .marquee-container:hover .marquee-content { animation-play-state: paused; }
        @keyframes marquee { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }

        /* Image Hover Reveal & Shine Sweep */
        .img-reveal { filter: grayscale(80%) contrast(1.1); transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1); }
        .group:hover .img-reveal { filter: grayscale(0%) contrast(1); transform: scale(1.06); }
        
        .shine-hover { position: relative; overflow: hidden; }
        .shine-hover::after {
            content: '';
            position: absolute;
            top: 0; left: -100%; width: 50%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: all 0.8s ease;
        }
        .shine-hover:hover::after { left: 150%; }

        /* Floating Animation */
        @keyframes float-slow {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-8px) rotate(1.5deg); }
        }
        .animate-float { animation: float-slow 4s ease-in-out infinite; }

        /* Animated SVG Underline */
        @keyframes draw-stroke {
            0% { stroke-dashoffset: 120; opacity: 0; }
            100% { stroke-dashoffset: 0; opacity: 1; }
        }
        .animate-underline {
            stroke-dasharray: 120;
            animation: draw-stroke 1.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        /* Pulse Ring Animation */
        @keyframes pulse-ring {
            0% { transform: scale(0.95); opacity: 0.8; }
            50% { transform: scale(1.08); opacity: 0.4; }
            100% { transform: scale(0.95); opacity: 0.8; }
        }
        .animate-ring { animation: pulse-ring 3.5s cubic-bezier(0.4, 0, 0.6, 1) infinite; }

        .transition-expo { transition-timing-function: cubic-bezier(0.16, 1, 0.3, 1); }
    </style>

    <div class="grain-overlay"></div>

    <div class="bg-paper text-ink font-manrope min-h-screen relative overflow-hidden">
        
        <!-- HERO SECTION -->
        <section class="relative flex flex-col justify-center pt-20 sm:pt-23 lg:pt-64 pb-16 sm:pb-24 border-b border-black/10 overflow-hidden">
            @if(strtolower($category->name) === 'sports')
                <!-- Subtle sports background texture -->
                <div class="absolute inset-0 z-0 pointer-events-none" style="opacity: 0.35;">
                    <img src="{{ asset('images/kabaddi-match.png') }}" alt="Sports Background" class="w-full h-full object-cover filter grayscale">
                    <!-- Gradient to protect text readability on the left -->
                    <div class="absolute inset-0 bg-gradient-to-r from-paper via-paper/50 to-transparent"></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-paper via-transparent to-transparent"></div>
                </div>
            @elseif(str_contains(strtolower($category->name), 'art'))
                <!-- Subtle arts background texture -->
                <div class="absolute inset-0 z-0 pointer-events-none" style="opacity: 0.35;">
                    <img src="{{ asset('images/art-competition.png') }}" alt="Arts Background" class="w-full h-full object-cover filter grayscale">
                    <!-- Gradient to protect text readability on the left -->
                    <div class="absolute inset-0 bg-gradient-to-r from-paper via-paper/50 to-transparent"></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-paper via-transparent to-transparent"></div>
                </div>
            @elseif(str_contains(strtolower($category->name), 'cultur'))
                <!-- Subtle cultural background texture -->
                <div class="absolute inset-0 z-0 pointer-events-none" style="opacity: 0.35;">
                    <img src="{{ asset('images/culture-competition.png') }}" alt="Culture Background" class="w-full h-full object-cover filter grayscale">
                    <!-- Gradient to protect text readability on the left -->
                    <div class="absolute inset-0 bg-gradient-to-r from-paper via-paper/50 to-transparent"></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-paper via-transparent to-transparent"></div>
                </div>
            @elseif(str_contains(strtolower($category->name), 'education'))
                <!-- Subtle education background texture -->
                <div class="absolute inset-0 z-0 pointer-events-none" style="opacity: 0.35;">
                    <img src="{{ asset('images/education-competition.png') }}" alt="Education Background" class="w-full h-full object-cover filter grayscale">
                    <!-- Gradient to protect text readability on the left -->
                    <div class="absolute inset-0 bg-gradient-to-r from-paper via-paper/50 to-transparent"></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-paper via-transparent to-transparent"></div>
                </div>
            @endif
            
            <!-- Ambient Floating Animated Orbs -->
            <div class="absolute top-12 right-12 w-72 h-72 rounded-full bg-accent/10 blur-3xl animate-ring pointer-events-none"></div>
            <div class="absolute bottom-10 left-10 w-96 h-96 rounded-full bg-black/5 blur-3xl animate-ring pointer-events-none" style="animation-delay: 1.5s;"></div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full relative z-10">
                
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-end">
                    <!-- Left: Massive Editorial Typography -->
                    <div class="lg:col-span-8">
                        <div class="flex items-center gap-3 sm:gap-4 mb-4 sm:mb-6">
                            <span class="h-[1px] w-8 sm:w-12 bg-black"></span>
                            <span class="font-manrope text-[10px] sm:text-xs font-extrabold uppercase tracking-[0.25em] text-black/60">The Official Roster</span>
                            <span class="px-2.5 py-0.5 rounded-full bg-accent/10 text-accent font-extrabold text-[10px] uppercase tracking-wider animate-pulse">Live Season</span>
                        </div>

                        <h1 class="text-4xl sm:text-6xl md:text-7xl lg:text-8xl leading-[0.92] text-ink font-playfair tracking-tighter mb-4 lg:mb-0">
                            The <span class="italic text-accent relative inline-block">
                                {{ $category->name }}
                                <svg class="absolute -bottom-2 left-0 w-full h-3 text-accent/40 animate-underline" viewBox="0 0 100 20" preserveAspectRatio="none">
                                    <path d="M0,15 Q50,0 100,15" stroke="currentColor" stroke-width="4" fill="none" />
                                </svg>
                            </span> Arena.
                        </h1>
                    </div>
                    
                    <!-- Right: Subtext & Interactive CTA -->
                    <div class="lg:col-span-4 lg:pb-2">

                        <p class="font-manrope text-sm sm:text-base font-medium leading-relaxed text-black/70 border-l-2 border-black/20 pl-4 sm:pl-6">
                            Step into the ultimate proving ground. Participate in high-stakes {{ strtolower($category->name) }} competitions, showcase your raw talent, and architect your legacy.
                        </p>
                        <div class="mt-6 sm:mt-8 pl-4 sm:pl-6">
                            <a href="#exhibitions" class="group relative inline-flex items-center gap-3 px-7 py-3.5 bg-black text-white font-extrabold text-xs tracking-[0.2em] uppercase hover:bg-accent transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                                <span>Browse Competitions</span>
                                <i class="fa-solid fa-arrow-down text-xs group-hover:translate-y-1.5 transition-transform duration-300"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Background Watermark Text -->
            <div class="absolute bottom-0 right-0 pointer-events-none overflow-hidden opacity-5 select-none w-full text-right"
                 x-cloak x-show="mounted" 
                 x-transition:enter="transition-all transition-expo duration-[1500ms] delay-300" 
                 x-transition:enter-start="opacity-0 translate-x-16" 
                 x-transition:enter-end="opacity-5 translate-x-0">
                <span class="font-playfair italic text-[12vw] leading-none whitespace-nowrap">Compete.</span>
            </div>
        </section>

        <!-- INFINITE MARQUEE BANNER -->
        <div class="py-4 sm:py-5 border-b border-black/10 bg-black text-white overflow-hidden">
            <div class="marquee-container flex items-center">
                <div class="marquee-content font-manrope font-bold text-[11px] sm:text-xs tracking-[0.25em] uppercase">
                    &nbsp;PUSH BOUNDARIES <span class="mx-6 sm:mx-8 text-accent animate-spin inline-block">✦</span> DEFINE THE FUTURE <span class="mx-6 sm:mx-8 text-accent animate-spin inline-block">✦</span> ELEVATE YOUR CRAFT <span class="mx-6 sm:mx-8 text-accent animate-spin inline-block">✦</span> PUSH BOUNDARIES <span class="mx-6 sm:mx-8 text-accent">✦</span> DEFINE THE FUTURE <span class="mx-6 sm:mx-8 text-accent">✦</span> ELEVATE YOUR CRAFT <span class="mx-6 sm:mx-8 text-accent">✦</span>
                    PUSH BOUNDARIES <span class="mx-6 sm:mx-8 text-accent">✦</span> DEFINE THE FUTURE <span class="mx-6 sm:mx-8 text-accent">✦</span> ELEVATE YOUR CRAFT <span class="mx-6 sm:mx-8 text-accent">✦</span> PUSH BOUNDARIES <span class="mx-6 sm:mx-8 text-accent">✦</span> DEFINE THE FUTURE <span class="mx-6 sm:mx-8 text-accent">✦</span> ELEVATE YOUR CRAFT <span class="mx-6 sm:mx-8 text-accent">✦</span>
                </div>
            </div>
        </div>

        <!-- WHY ENGAGE SECTION -->
        <section class="relative border-b border-black/10" x-data="{ shown: false }" x-intersect.margin.-10%="shown = true">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col lg:flex-row relative">
                    
                    <!-- Sticky Header Side -->
                    <div class="w-full lg:w-1/3 py-12 lg:py-24 lg:border-r border-black/10 relative">
                        <div class="lg:sticky lg:top-28 lg:pr-8">
                            <h2 class="font-playfair text-4xl sm:text-5xl md:text-6xl text-ink leading-tight mb-4">
                                Why<br><span class="italic text-accent">Engage?</span>
                            </h2>
                            <p class="font-manrope text-sm sm:text-base text-black/60 font-medium leading-relaxed mb-6">This is not just another event. It is a catalyst for your talent trajectory.</p>
                            
                            <div class="p-4 rounded-xl bg-white border border-black/10 shadow-sm inline-flex items-center gap-3 animate-float">
                                <i class="fa-solid fa-trophy text-accent text-lg"></i>
                                <div class="text-xs font-bold">
                                    <span class="block text-black">100% Certified</span>
                                    <span class="text-black/50 font-normal">State Level Credentials</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Scrolling Content Side -->
                    <div class="w-full lg:w-2/3 py-10 lg:py-24 lg:pl-12">
                        <div class="space-y-8 sm:space-y-12">
                            
                            <!-- Point 1 -->
                            <div class="group flex items-start gap-4 sm:gap-6 p-6 sm:p-8 bg-white border border-black/10 shadow-sm hover:shadow-xl hover:border-accent/40 transition-all duration-500 ease-expo hover:-translate-y-1"
                                 x-cloak x-show="shown"
                                 x-transition:enter="transition-all transition-expo duration-[1000ms] delay-100"
                                 x-transition:enter-start="opacity-0 translate-y-12"
                                 x-transition:enter-end="opacity-100 translate-y-0">
                                <span class="font-manrope text-3xl sm:text-4xl font-extrabold text-accent shrink-0 pt-1 group-hover:scale-110 transition-transform duration-300">01</span>
                                <div>
                                    <h3 class="font-playfair text-2xl sm:text-3xl text-ink mb-3 group-hover:text-accent transition-colors duration-300">State-Level Recognition</h3>
                                    <p class="font-manrope text-sm sm:text-base text-black/70 leading-relaxed font-medium">
                                        Compete on a grand stage. Every participant receives an official state-certified credential, putting your achievements directly in front of leading mentors and academies.
                                    </p>
                                </div>
                            </div>

                            <!-- Point 2 -->
                            <div class="group flex items-start gap-4 sm:gap-6 p-6 sm:p-8 bg-white border border-black/10 shadow-sm hover:shadow-xl hover:border-accent/40 transition-all duration-500 ease-expo hover:-translate-y-1"
                                 x-cloak x-show="shown"
                                 x-transition:enter="transition-all transition-expo duration-[1000ms] delay-200"
                                 x-transition:enter-start="opacity-0 translate-y-12"
                                 x-transition:enter-end="opacity-100 translate-y-0">
                                <span class="font-manrope text-3xl sm:text-4xl font-extrabold text-accent shrink-0 pt-1 group-hover:scale-110 transition-transform duration-300">02</span>
                                <div>
                                    <h3 class="font-playfair text-2xl sm:text-3xl text-ink mb-3 group-hover:text-accent transition-colors duration-300">Substantial Rewards</h3>
                                    <p class="font-manrope text-sm sm:text-base text-black/70 leading-relaxed font-medium">
                                        We don't just give out promises. Winners receive gold medals, trophies, scholarship grants, and hardware rewards to accelerate their growth.
                                    </p>
                                </div>
                            </div>

                            <!-- Point 3 -->
                            <div class="group flex items-start gap-4 sm:gap-6 p-6 sm:p-8 bg-white border border-black/10 shadow-sm hover:shadow-xl hover:border-accent/40 transition-all duration-500 ease-expo hover:-translate-y-1"
                                 x-cloak x-show="shown"
                                 x-transition:enter="transition-all transition-expo duration-[1000ms] delay-300"
                                 x-transition:enter-start="opacity-0 translate-y-12"
                                 x-transition:enter-end="opacity-100 translate-y-0">
                                <span class="font-manrope text-3xl sm:text-4xl font-extrabold text-accent shrink-0 pt-1 group-hover:scale-110 transition-transform duration-300">03</span>
                                <div>
                                    <h3 class="font-playfair text-2xl sm:text-3xl text-ink mb-3 group-hover:text-accent transition-colors duration-300">The Network Effect</h3>
                                    <p class="font-manrope text-sm sm:text-base text-black/70 leading-relaxed font-medium">
                                        Surround yourself with the top performers across Bihar. Find lifelong mentors, peers, and collaborators who share your extreme ambition and drive.
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- DARK FEATURE SECTION (Anatomy of a Revolutionary Event) -->
        <section class="py-16 sm:py-24 bg-black text-white relative overflow-hidden" x-data="{ shown: false }" x-intersect.margin.-10%="shown = true">
            
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="mb-12 sm:mb-16 flex flex-col md:flex-row md:items-end justify-between gap-6 sm:gap-8"
                     x-cloak x-show="shown"
                     x-transition:enter="transition-all transition-expo duration-[1000ms]"
                     x-transition:enter-start="opacity-0 translate-y-8"
                     x-transition:enter-end="opacity-100 translate-y-0">
                    <h2 class="font-playfair text-3xl sm:text-5xl md:text-6xl max-w-2xl leading-tight">The Anatomy of a <span class="italic text-accent">Revolutionary Event.</span></h2>
                    <p class="font-manrope text-white/60 font-bold uppercase tracking-[0.2em] text-[10px] sm:text-xs max-w-xs">Engineered for maximum impact and growth.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 border-t border-white/20">
                    
                    <!-- Feature 1 -->
                    <div class="border-b md:border-b-0 md:border-r border-white/20 p-6 sm:p-8 lg:p-10 group hover:bg-white/5 transition-all duration-500"
                         x-cloak x-show="shown"
                         x-transition:enter="transition-all transition-expo duration-[1000ms] delay-100"
                         x-transition:enter-start="opacity-0 translate-y-12"
                         x-transition:enter-end="opacity-100 translate-y-0">
                        <i class="fa-solid fa-cube text-2xl sm:text-3xl mb-6 text-accent group-hover:rotate-12 group-hover:scale-110 transition-transform duration-500"></i>
                        <h4 class="font-playfair text-xl sm:text-2xl mb-3 group-hover:text-accent transition-colors">Real-World Challenges</h4>
                        <p class="font-manrope text-white/60 text-xs sm:text-sm leading-relaxed">Abandon textbook theory. You will be tackling live, unscripted competitions evaluated directly by expert judges and mentors.</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="border-b md:border-b-0 md:border-r border-white/20 p-6 sm:p-8 lg:p-10 group hover:bg-white/5 transition-all duration-500"
                         x-cloak x-show="shown"
                         x-transition:enter="transition-all transition-expo duration-[1000ms] delay-200"
                         x-transition:enter-start="opacity-0 translate-y-12"
                         x-transition:enter-end="opacity-100 translate-y-0">
                        <i class="fa-solid fa-stopwatch text-2xl sm:text-3xl mb-6 text-accent group-hover:scale-125 transition-transform duration-500"></i>
                        <h4 class="font-playfair text-xl sm:text-2xl mb-3 group-hover:text-accent transition-colors">High-Stakes Performance</h4>
                        <p class="font-manrope text-white/60 text-xs sm:text-sm leading-relaxed">Master the art of performing under pressure. Build stage confidence, rapid problem solving, and decisive action.</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="p-6 sm:p-8 lg:p-10 group hover:bg-white/5 transition-all duration-500"
                         x-cloak x-show="shown"
                         x-transition:enter="transition-all transition-expo duration-[1000ms] delay-300"
                         x-transition:enter-start="opacity-0 translate-y-12"
                         x-transition:enter-end="opacity-100 translate-y-0">
                        <i class="fa-solid fa-certificate text-2xl sm:text-3xl mb-6 text-accent group-hover:rotate-12 group-hover:scale-110 transition-transform duration-500"></i>
                        <h4 class="font-playfair text-xl sm:text-2xl mb-3 group-hover:text-accent transition-colors">Verifiable Credentials</h4>
                        <p class="font-manrope text-white/60 text-xs sm:text-sm leading-relaxed">Walk away with verified certificates of merit to attach to your portfolio, instantly proving your capabilities.</p>
                    </div>

                </div>
            </div>
        </section>

        <!-- DYNAMIC UPCOMING EXHIBITIONS / EVENTS SECTION (ULTRA PREMIUM ANIMATED CARD GRID) -->
        <section id="exhibitions" class="py-16 sm:py-24 md:py-32 relative" x-data="{ showEvents: false, search: '', openModalId: null }" x-intersect.margin.-10%="showEvents = true">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <!-- Section Header -->
                <div class="mb-12 sm:mb-16 flex flex-col md:flex-row md:items-end justify-between gap-6 border-b border-black/10 pb-6 sm:pb-8"
                     x-cloak x-show="showEvents"
                     x-transition:enter="transition-all transition-expo duration-[1000ms]"
                     x-transition:enter-start="opacity-0 translate-y-8"
                     x-transition:enter-end="opacity-100 translate-y-0">
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <span class="font-manrope text-[10px] sm:text-xs font-bold uppercase tracking-[0.25em] text-accent block">The Schedule</span>
                            <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 font-extrabold text-[10px] uppercase flex items-center gap-1.5 shadow-sm border border-emerald-200">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></span>
                                {{ $events->count() }} Competitions Live
                            </span>
                        </div>
                        <h2 class="font-playfair text-4xl sm:text-6xl lg:text-7xl text-ink leading-none">
                            Upcoming <span class="italic text-accent">Exhibitions.</span>
                        </h2>
                    </div>

                    @if($events->count() > 0)
                    <div class="w-full md:w-80">
                        <div class="relative">
                            <input type="text" x-model="search" placeholder="Search competition or location..." class="w-full bg-white border border-black/20 px-4 py-3 text-xs font-manrope font-bold text-ink focus:outline-none focus:border-accent shadow-sm transition-colors rounded-xl">
                            <i class="fa-solid fa-magnifying-glass absolute right-4 top-1/2 -translate-y-1/2 text-black/40 text-xs"></i>
                        </div>
                    </div>
                    @endif
                </div>

                @if($events->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($events as $index => $event)
                            <article x-show="search === '' || '{{ strtolower(addslashes($event->title)) }}'.includes(search.toLowerCase()) || '{{ strtolower(addslashes($event->location ?? '')) }}'.includes(search.toLowerCase())"
                                     class="group relative bg-white rounded-2xl border border-gray-200/80 shadow-md hover:shadow-2xl hover:border-accent/50 hover:-translate-y-2 transition-all duration-500 ease-expo flex flex-col justify-between overflow-hidden"
                                     x-cloak x-show="showEvents"
                                     x-transition:enter="transition-all transition-expo duration-[1000ms]"
                                     x-transition:enter-start="opacity-0 translate-y-16"
                                     x-transition:enter-end="opacity-100 translate-y-0"
                                     style="transition-delay: {{ $index * 120 }}ms;">
                                
                                <div>
                                    <!-- Image Header with Dark Gradient Overlay & Graceful Fallback -->
                                    <div class="relative h-52 sm:h-56 w-full overflow-hidden bg-slate-900 shine-hover">
                                        @php
                                            $fallbackStock = "https://images.unsplash.com/photo-1511578314322-379afb476865?auto=format&fit=crop&q=80&w=800";
                                            $imgUrl = (!empty($event->image) && str_starts_with($event->image, 'http')) ? $event->image : (!empty($event->image) ? asset('storage/' . $event->image) : $fallbackStock);
                                        @endphp

                                        <img src="{{ $imgUrl }}" 
                                             alt="{{ $event->title }}" 
                                             onerror="this.onerror=null; this.src='{{ $fallbackStock }}';"
                                             class="w-full h-full object-cover img-reveal" />
                                        
                                        <!-- Gradient Dark Overlay -->
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/30 to-transparent pointer-events-none"></div>

                                        <!-- Top Badges -->
                                        <div class="absolute top-3 left-3 right-3 flex items-center justify-between z-10">
                                            <div class="flex items-center gap-1.5">
                                                <span class="bg-black/75 backdrop-blur-md text-white font-manrope text-[10px] font-extrabold uppercase tracking-widest px-3 py-1 rounded-lg border border-white/20 shadow-sm">
                                                    {{ $event->category }}
                                                </span>
                                                @if($event->season)
                                                    <span class="bg-accent text-white font-manrope text-[10px] font-extrabold uppercase tracking-wider px-2.5 py-1 rounded-lg shadow-sm">
                                                        {{ $event->season }}
                                                    </span>
                                                @endif
                                            </div>

                                            <span class="bg-emerald-500/90 text-white font-manrope text-[9px] font-extrabold uppercase tracking-wider px-2.5 py-1 rounded-full shadow-md backdrop-blur-md flex items-center gap-1.5 border border-white/20">
                                                <span class="w-1.5 h-1.5 rounded-full bg-white animate-ping"></span>Live
                                            </span>
                                        </div>

                                        <!-- Bottom Date Badge Box -->
                                        <div class="absolute bottom-3 left-3 z-10 bg-white/95 backdrop-blur-md px-3.5 py-1.5 rounded-lg text-ink flex items-center gap-2 shadow-md border border-white/40">
                                            <i class="fa-regular fa-calendar-check text-accent text-xs"></i>
                                            <span class="font-manrope text-xs font-extrabold">{{ $event->event_date ? $event->event_date->format('d M, Y') : 'Date TBA' }}</span>
                                        </div>
                                    </div>

                                    <!-- Content Body -->
                                    <div class="p-6">
                                        <h3 class="font-playfair text-2xl font-bold text-ink mb-3 group-hover:text-accent transition-colors duration-300 line-clamp-2 leading-snug">
                                            {{ $event->title }}
                                        </h3>
                                        
                                        <!-- Time & Location Meta -->
                                        <div class="grid grid-cols-1 gap-2 mb-4">
                                            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-gray-100/80 text-xs font-manrope font-semibold text-gray-700">
                                                <i class="fa-regular fa-clock text-accent text-xs"></i>
                                                <span>Reporting: {{ $event->reporting_time ?: 'TBA' }}</span>
                                            </div>

                                            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-gray-100/80 text-xs font-manrope font-semibold text-gray-700">
                                                <i class="fa-solid fa-location-dot text-gray-900 text-xs"></i>
                                                <span class="truncate">{{ $event->location ?? 'Venue to be announced' }}</span>
                                            </div>
                                        </div>

                                        @if($event->description)
                                            <div class="mb-4">
                                                <button @click.prevent="openModalId = {{ $event->id }}" class="group/more inline-flex items-center gap-1.5 text-[11px] font-extrabold font-manrope uppercase tracking-wider text-accent hover:text-ink transition-colors">
                                                    More Details
                                                    <i class="fa-solid fa-circle-info text-[10px] group-hover/more:scale-110 transition-transform"></i>
                                                </button>
                                            </div>
                                        @endif

                                        <!-- Group Categories Badges -->
                                        @if($event->groups && $event->groups->count() > 0)
                                            <div class="pt-3 border-t border-gray-100 flex flex-wrap gap-1">
                                                @foreach($event->groups as $grp)
                                                    <span class="px-2.5 py-1 rounded-md bg-accent/10 text-accent font-manrope text-[10px] font-extrabold border border-accent/20">
                                                        {{ $grp->name }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Card Footer CTA Button -->
                                <div class="px-6 pb-6 pt-0">
                                    <a href="{{ url('/register') }}?event={{ $event->id }}" class="group/btn w-full inline-flex items-center justify-center gap-2.5 py-3.5 px-4 bg-black hover:bg-accent text-white font-manrope font-extrabold uppercase tracking-wider text-xs rounded-xl transition-all duration-300 shadow-md hover:shadow-accent/30">
                                        <span>Register For Competition</span>
                                        <i class="fa-solid fa-arrow-right text-xs group-hover/btn:translate-x-1.5 transition-transform duration-300"></i>
                                    </a>
                                </div>

                            </article>
                        @endforeach
                    </div>
                @else
                    <div class="max-w-xl mx-auto bg-white p-8 sm:p-12 rounded-2xl border border-gray-200 text-center shadow-sm">
                        <i class="fa-solid fa-trophy text-3xl sm:text-4xl text-gray-300 mb-4 block"></i>
                        <h4 class="font-playfair text-xl sm:text-2xl text-ink mb-2">No Exhibitions Listed</h4>
                        <p class="font-manrope text-xs text-gray-500 mb-6 font-medium">We are currently curating new {{ strtolower($category->name) }} competitions. Stay tuned!</p>
                        <a href="{{ url('/register') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-black text-white font-extrabold text-xs uppercase tracking-widest rounded-xl hover:bg-accent transition-colors">
                            <span>Register Online</span>
                            <i class="fa-solid fa-arrow-right text-xs"></i>
                        </a>
                    </div>
                @endif

                <!-- Modals Rendering -->
                @foreach($events as $event)
                    @if($event->description)
                        <div x-show="openModalId === {{ $event->id }}" x-cloak style="display: none;" class="fixed inset-0 z-[100] flex items-center justify-center bg-black/70 backdrop-blur-md p-4">
                            <div @click.away="openModalId = null" 
                                 x-show="openModalId === {{ $event->id }}" 
                                 x-transition:enter="transition ease-out duration-300"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-200"
                                 x-transition:leave-start="opacity-100 scale-100"
                                 x-transition:leave-end="opacity-0 scale-95"
                                 class="bg-white rounded-3xl max-w-2xl w-full p-8 shadow-2xl relative max-h-[90vh] overflow-y-auto border border-gray-100">
                                 
                                <button @click="openModalId = null" class="absolute top-5 right-5 w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 hover:bg-black hover:text-white text-gray-600 transition-all shadow-sm">
                                    <i class="fa-solid fa-xmark text-lg"></i>
                                </button>
                                
                                <h2 class="font-playfair text-3xl font-bold text-ink mb-2 pr-12 leading-tight">{{ $event->title }}</h2>
                                <div class="flex items-center gap-3 text-xs font-manrope font-bold text-gray-500 mb-6 pb-4 border-b border-gray-100">
                                    <span class="flex items-center gap-1.5"><i class="fa-regular fa-calendar text-accent"></i> {{ $event->event_date ? $event->event_date->format('d M, Y') : 'TBA' }}</span>
                                    <span class="w-1 h-1 rounded-full bg-gray-300"></span>
                                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-location-dot text-accent"></i> {{ $event->location ?? 'TBA' }}</span>
                                </div>
                                
                                <div class="prose prose-sm prose-p:font-manrope prose-p:text-sm prose-p:text-gray-700 max-w-none prose-headings:font-playfair prose-headings:text-ink">
                                    {!! $event->description !!}
                                </div>
                                
                                <div class="mt-8 pt-6 border-t border-gray-100 flex justify-end">
                                    <a href="{{ url('/register') }}?event={{ $event->id }}" class="inline-flex items-center justify-center gap-2 px-8 py-3.5 bg-accent hover:bg-black text-white font-manrope font-extrabold text-xs uppercase tracking-widest rounded-xl transition-all shadow-md">
                                        Register For Competition
                                        <i class="fa-solid fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

            </div>
        </section>

        <!-- INTERACTIVE ACCORDION FAQ SECTION -->
        <section class="py-16 sm:py-24 bg-white border-t border-black/10" x-data="{ openFaq: null, shown: false }" x-intersect.margin.-10%="shown = true">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12 sm:mb-16"
                     x-cloak x-show="shown"
                     x-transition:enter="transition-all transition-expo duration-[1000ms]"
                     x-transition:enter-start="opacity-0 translate-y-8"
                     x-transition:enter-end="opacity-100 translate-y-0">
                    <span class="font-manrope text-[10px] sm:text-xs font-bold uppercase tracking-[0.25em] text-accent mb-2 block">Information Desk</span>
                    <h2 class="font-playfair text-3xl sm:text-5xl text-ink">Frequently Asked <span class="italic text-accent">Questions.</span></h2>
                </div>

                <div class="space-y-4">
                    <!-- FAQ 1 -->
                    <div class="border border-black/10 bg-paper rounded-xl transition-all">
                        <button @click="openFaq = (openFaq === 1 ? null : 1)" class="w-full p-5 sm:p-6 text-left flex items-center justify-between font-playfair font-bold text-lg sm:text-xl text-ink focus:outline-none">
                            <span>Who can participate in {{ $category->name }} competitions?</span>
                            <i class="fa-solid transition-transform duration-300" :class="openFaq === 1 ? 'fa-minus text-accent rotate-180' : 'fa-plus text-black/40'"></i>
                        </button>
                        <div x-show="openFaq === 1" x-collapse class="px-5 pb-6 sm:px-6 font-manrope text-xs sm:text-sm text-black/70 font-medium leading-relaxed border-t border-black/5 pt-4">
                            Students from Class 5th to 12th are eligible to participate across different groups. Check specific event details for category group breakdown.
                        </div>
                    </div>

                    <!-- FAQ 2 -->
                    <div class="border border-black/10 bg-paper rounded-xl transition-all">
                        <button @click="openFaq = (openFaq === 2 ? null : 2)" class="w-full p-5 sm:p-6 text-left flex items-center justify-between font-playfair font-bold text-lg sm:text-xl text-ink focus:outline-none">
                            <span>Will participants receive certificates?</span>
                            <i class="fa-solid transition-transform duration-300" :class="openFaq === 2 ? 'fa-minus text-accent rotate-180' : 'fa-plus text-black/40'"></i>
                        </button>
                        <div x-show="openFaq === 2" x-collapse class="px-5 pb-6 sm:px-6 font-manrope text-xs sm:text-sm text-black/70 font-medium leading-relaxed border-t border-black/5 pt-4">
                            Yes, all registered participants receive official state-certified certificates, while top position holders earn gold medals and trophies.
                        </div>
                    </div>

                    <!-- FAQ 3 -->
                    <div class="border border-black/10 bg-paper rounded-xl transition-all">
                        <button @click="openFaq = (openFaq === 3 ? null : 3)" class="w-full p-5 sm:p-6 text-left flex items-center justify-between font-playfair font-bold text-lg sm:text-xl text-ink focus:outline-none">
                            <span>How do I get my Admit Card after registration?</span>
                            <i class="fa-solid transition-transform duration-300" :class="openFaq === 3 ? 'fa-minus text-accent rotate-180' : 'fa-plus text-black/40'"></i>
                        </button>
                        <div x-show="openFaq === 3" x-collapse class="px-5 pb-6 sm:px-6 font-manrope text-xs sm:text-sm text-black/70 font-medium leading-relaxed border-t border-black/5 pt-4">
                            Once your registration is submitted online, you can download your official Admit Card directly from the Admit Card page by entering your Registeration number or DOB.
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- BOTTOM BRANDING FOOTNOTE -->
        <div class="py-12 border-t border-black/10 bg-paper">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row justify-between items-center gap-4 text-center sm:text-left">
                <div class="font-manrope font-extrabold text-lg uppercase tracking-tighter flex items-center gap-2">
                    <div class="w-3 h-3 bg-black"></div>
                    YOUTH<span class="font-playfair italic font-normal text-accent lowercase">Revolutionary</span>
                </div>
                <p class="font-manrope text-[11px] font-bold uppercase tracking-widest text-black/50">
                    The Official Competition Arena &bull; Youth Revolutionary
                </p>
            </div>
        </div>

    </div>
</x-app-layout>
