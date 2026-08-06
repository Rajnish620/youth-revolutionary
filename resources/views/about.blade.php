<x-app-layout>
    @php
        $heroImage = (!empty($setting->hero_bg_image) && file_exists(public_path($setting->hero_bg_image))) 
            ? asset($setting->hero_bg_image) 
            : asset('images/NIKON Z 502317.JPG.jpeg');
            
        $whoImage = (!empty($setting->who_we_are_image) && file_exists(public_path($setting->who_we_are_image))) 
            ? asset($setting->who_we_are_image) 
            : asset('images/WhatsApp Image 2026-06-24 at 12.37.06 PM.jpeg');

        $featuredMembers = $teamMembers->where('is_featured', true);
    @endphp

    <!-- HERO BANNER SECTION (Who We Are Se Pehle Header Banner) -->
    <section class="relative h-[70vh] min-h-[480px] flex items-center justify-center overflow-hidden" x-data="{ show: false }" x-init="setTimeout(() => show = true, 100)">
        <img src="{{ $heroImage }}" alt="About Banner" class="absolute w-full h-full object-cover transition-all duration-1000 transform scale-110" :class="{'scale-100': show}">
        <!-- Dark Overlay -->
        <div class="absolute inset-0 bg-black/65 backdrop-blur-[1px]"></div>
        
        <!-- Centered Text -->
        <div class="relative z-10 text-center text-white px-6 pt-20 sm:pt-24 transition duration-1000 opacity-0 translate-y-10" :class="{'opacity-100 translate-y-0': show}" style="transition-delay: 200ms;">
            <h1 class="text-5xl sm:text-7xl md:text-8xl font-black tracking-tight mb-4 text-white drop-shadow-lg">
                {{ $setting->hero_title ?? 'About Us' }}
            </h1>
            <p class="text-lg sm:text-2xl text-gray-200 max-w-3xl mx-auto font-medium leading-relaxed drop-shadow-md">
                {{ $setting->hero_subtitle ?? 'Empowering Young Minds Through Education, Sports & Cultural Excellence.' }}
            </p>
        </div>
    </section>

    <!-- WHO WE ARE SECTION -->
    <section class="py-20 md:py-28 bg-white overflow-hidden" x-data="{ show: false }" x-intersect.once="show = true">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 lg:gap-16 items-center">
            <div class="transition duration-1000 opacity-0 translate-y-8 sm:-translate-x-12 sm:translate-y-0" :class="{'opacity-100 translate-x-0 translate-y-0': show}">
                <div class="relative rounded-3xl overflow-hidden shadow-2xl border-4 border-white transform transition duration-700 hover:scale-[1.02]">
                    <img src="{{ $whoImage }}" class="w-full h-[300px] sm:h-[400px] object-cover" alt="Who We Are Image">
                </div>
            </div>
            <div class="transition duration-1000 opacity-0 translate-y-8 sm:translate-x-12 sm:translate-y-0" :class="{'opacity-100 translate-x-0 translate-y-0': show}" style="transition-delay: 150ms;">
                <h2 class="text-4xl sm:text-6xl lg:text-7xl font-black text-[#F1400C] tracking-tight mb-3">Who We Are?</h2>
                <h3 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 mb-6 tracking-tight">{{ $setting->who_we_are_title ?? 'Youth Revolutionary' }}</h3>
                <p class="text-slate-600 text-base sm:text-lg leading-relaxed font-medium">
                    {!! nl2br(e($setting->who_we_are_description ?? 'Youth Revolutionary is a student-focused organization dedicated to discovering, nurturing, and recognizing young talents across academics, sports, and cultural competitions.')) !!}
                </p>
            </div>
        </div>
    </section>

    <!-- MISSION / VISION SECTION -->
    <section class="py-20 md:py-28 bg-slate-50 border-y border-slate-100 overflow-hidden" x-data="{ show: false }" x-intersect.once="show = true">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-8">
            <!-- Mission -->
            <div class="p-8 sm:p-10 rounded-3xl bg-white border border-slate-100 shadow-xl shadow-slate-100/60 hover:border-[#340C6F]/30 hover:-translate-y-2 transition-all duration-700 opacity-0 translate-y-10" :class="{'opacity-100 translate-y-0': show}">
                <div class="w-16 h-16 rounded-2xl bg-purple-50 text-[#340C6F] flex items-center justify-center text-3xl mb-6 shadow-inner">
                    <i class="fa-solid fa-bullseye"></i>
                </div>
                <h3 class="text-2xl sm:text-3xl font-black text-slate-900 mb-4">{{ $setting->mission_title ?? 'Our Mission' }}</h3>
                <p class="text-slate-600 text-base leading-relaxed font-medium">
                    {{ $setting->mission_description ?? 'To provide students with a competitive platform that inspires excellence, builds confidence, and fosters holistic development.' }}
                </p>
            </div>
            
            <!-- Vision -->
            <div class="p-8 sm:p-10 rounded-3xl bg-white border border-slate-100 shadow-xl shadow-slate-100/60 hover:border-[#F1400C]/30 hover:-translate-y-2 transition-all duration-700 opacity-0 translate-y-10" :class="{'opacity-100 translate-y-0': show}" style="transition-delay: 200ms;">
                <div class="w-16 h-16 rounded-2xl bg-orange-50 text-[#F1400C] flex items-center justify-center text-3xl mb-6 shadow-inner">
                    <i class="fa-solid fa-eye"></i>
                </div>
                <h3 class="text-2xl sm:text-3xl font-black text-slate-900 mb-4">{{ $setting->vision_title ?? 'Our Vision' }}</h3>
                <p class="text-slate-600 text-base leading-relaxed font-medium">
                    {{ $setting->vision_description ?? 'To become a premier youth movement that transforms potential into achievements for thousands of students across the region.' }}
                </p>
            </div>
        </div>
    </section>

    <!-- MEET OUR TEAM SECTION -->
    <section class="py-20 md:py-28 bg-white overflow-hidden" x-data="{ show: false }" x-intersect.once="show = true">
        <div class="max-w-7xl mx-auto px-6 text-center mb-14 transition duration-1000 opacity-0 translate-y-8" :class="{'opacity-100 translate-y-0': show}">
            <span class="text-xs font-black uppercase tracking-widest text-[#340C6F] bg-purple-50 px-3 py-1.5 rounded-lg">Leadership & Team</span>
            <h2 class="text-4xl sm:text-5xl font-black text-slate-900 mt-3 tracking-tight">Meet Our Team</h2>
        </div>

        <div class="max-w-7xl mx-auto px-6 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($teamMembers as $index => $member)
                <div class="group overflow-hidden rounded-3xl border border-slate-100 bg-white hover:-translate-y-2 hover:shadow-2xl transition duration-500 opacity-0 translate-y-10" :class="{'opacity-100 translate-y-0': show}" style="transition-delay: {{ $index * 120 }}ms;">
                    <div class="h-72 w-full overflow-hidden bg-slate-100">
                        @if(!empty($member->image) && file_exists(public_path($member->image)))
                            <img src="{{ asset($member->image) }}" class="h-full w-full object-cover group-hover:scale-105 transition duration-700" alt="{{ $member->name }}">
                        @else
                            <div class="h-full w-full flex items-center justify-center bg-purple-50 text-[#340C6F] font-black text-4xl">
                                {{ substr($member->name, 0, 1) }}
                            </div>
                        @endif
                    </div>
                    <div class="p-6 text-left">
                        <h3 class="text-xl font-bold text-slate-900">{{ $member->name }}</h3>
                        <p class="text-[#F1400C] text-xs font-extrabold uppercase tracking-wider mt-1">{{ $member->role }}</p>
                        @if(!empty($member->description))
                            <p class="text-sm text-slate-600 mt-3 leading-relaxed font-medium">{{ $member->description }}</p>
                        @endif
                    </div>
                </div>
            @empty
                <div class="sm:col-span-2 lg:col-span-3 text-center py-12 text-slate-400">
                    <i class="fa-solid fa-users text-4xl mb-3"></i>
                    <p class="text-base font-bold">No team members added yet.</p>
                </div>
            @endforelse
        </div>
    </section>

    <!-- FEATURED TEAM MEMBERS BANNER -->
    @if($featuredMembers->count() > 0)
        <section class="py-12 bg-slate-50 border-t border-slate-100 overflow-hidden" x-data="{ show: false }" x-intersect.once="show = true">
            <div class="max-w-7xl mx-auto px-6 text-center mb-8 transition duration-700 opacity-0 translate-y-6" :class="{'opacity-100 translate-y-0': show}">
                <h3 class="text-lg font-black text-slate-900 tracking-wider uppercase">Key Leaders & Advisors</h3>
            </div>
            <div class="max-w-7xl mx-auto px-6 flex flex-wrap justify-center gap-8">
                @foreach($featuredMembers as $index => $member)
                    <div class="text-center p-4 bg-white border border-slate-200/60 rounded-2xl shadow-sm hover:shadow-md transition duration-500 transform hover:-translate-y-1 w-40 opacity-0 translate-y-8" :class="{'opacity-100 translate-y-0': show}" style="transition-delay: {{ $index * 100 }}ms;">
                        @if(!empty($member->image) && file_exists(public_path($member->image)))
                            <img src="{{ asset($member->image) }}" class="w-20 h-20 mx-auto rounded-full object-cover border-2 border-[#340C6F]">
                        @else
                            <div class="w-20 h-20 mx-auto rounded-full bg-purple-100 text-[#340C6F] font-bold flex items-center justify-center text-xl border-2 border-[#340C6F]">
                                {{ substr($member->name, 0, 1) }}
                            </div>
                        @endif
                        <h4 class="mt-3 font-bold text-slate-900 text-sm truncate">{{ $member->name }}</h4>
                        <p class="text-xs text-[#F1400C] font-semibold truncate">{{ $member->role }}</p>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    <!-- IMPACT STATS SECTION -->
    <section class="py-20 bg-[#340C6F] text-white overflow-hidden" x-data="{ show: false }" x-intersect.once="show = true">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-2 md:grid-cols-4 text-center gap-8">
            <div class="transition duration-1000 opacity-0 translate-y-10" :class="{'opacity-100 translate-y-0': show}" style="transition-delay: 100ms;">
                <i class="fa-solid fa-graduation-cap text-4xl text-[#F1400C] mb-3"></i>
                <h3 class="text-4xl sm:text-5xl font-black">{{ $setting->stat_1_count ?? '10000+' }}</h3>
                <p class="text-purple-200 text-sm font-semibold mt-1">{{ $setting->stat_1_label ?? 'Students Impacted' }}</p>
            </div>
            <div class="transition duration-1000 opacity-0 translate-y-10" :class="{'opacity-100 translate-y-0': show}" style="transition-delay: 250ms;">
                <i class="fa-solid fa-trophy text-4xl text-[#F1400C] mb-3"></i>
                <h3 class="text-4xl sm:text-5xl font-black">{{ $setting->stat_2_count ?? '100+' }}</h3>
                <p class="text-purple-200 text-sm font-semibold mt-1">{{ $setting->stat_2_label ?? 'Competitions Hosted' }}</p>
            </div>
            <div class="transition duration-1000 opacity-0 translate-y-10" :class="{'opacity-100 translate-y-0': show}" style="transition-delay: 400ms;">
                <i class="fa-solid fa-school text-4xl text-[#F1400C] mb-3"></i>
                <h3 class="text-4xl sm:text-5xl font-black">{{ $setting->stat_3_count ?? '50+' }}</h3>
                <p class="text-purple-200 text-sm font-semibold mt-1">{{ $setting->stat_3_label ?? 'Partner Schools' }}</p>
            </div>
            <div class="transition duration-1000 opacity-0 translate-y-10" :class="{'opacity-100 translate-y-0': show}" style="transition-delay: 550ms;">
                <i class="fa-solid fa-location-dot text-4xl text-[#F1400C] mb-3"></i>
                <h3 class="text-4xl sm:text-5xl font-black">{{ $setting->stat_4_count ?? '15+' }}</h3>
                <p class="text-purple-200 text-sm font-semibold mt-1">{{ $setting->stat_4_label ?? 'Cities Reached' }}</p>
            </div>
        </div>
    </section>

    <!-- CALL TO ACTION -->
    <section class="py-20 bg-slate-100 text-center overflow-hidden" x-data="{ show: false }" x-intersect.once="show = true">
        <div class="max-w-4xl mx-auto px-6 transition duration-1000 opacity-0 translate-y-8" :class="{'opacity-100 translate-y-0': show}">
            <h2 class="text-3xl sm:text-5xl font-black text-slate-900 mb-4 tracking-tight">Ready To Showcase Your Talent?</h2>
            <p class="text-slate-600 text-base sm:text-lg mb-8 font-medium">Join thousands of students competing in Patna Nashariganj's biggest youth festival.</p>
            <a href="{{ url('/register') }}" class="inline-flex items-center justify-center gap-2 bg-[#F1400C] text-white px-8 py-3.5 rounded-2xl font-bold text-base whitespace-nowrap hover:bg-orange-600 shadow-xl shadow-[#F1400C]/25 transition transform hover:-translate-y-0.5">
                <span>Register Now</span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </section>
</x-app-layout>
