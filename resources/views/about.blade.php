<x-app-layout>
    @php
    $teamMembers = [];
    $featuredMembers = [];
    @endphp

    <!-- HERO -->
    <section class="relative h-[70vh] flex items-center justify-center overflow-hidden" x-data="{ show: false }" x-init="setTimeout(() => show = true, 100)">
        <img src="{{ asset('images/NIKON Z 502317.JPG.jpeg') }}" alt="About Banner" class="absolute w-full h-full object-cover transition duration-1000 transform scale-110" :class="{'scale-100': show}">
        <div class="absolute inset-0 bg-black/65"></div>
        <div class="relative z-10 text-center text-white px-6 transition duration-1000 opacity-0 translate-y-10" :class="{'opacity-100 translate-y-0': show}" style="transition-delay: 300ms;">
            <h1 class="text-5xl md:text-7xl font-bold mb-4">About Us</h1>
            <p class="text-xl max-w-3xl mx-auto">Empowering Young Minds Through Education, Sports & Cultural Excellence.</p>
        </div>
    </section>

    <!-- ABOUT -->
    <section class="py-24 bg-white" x-data="{ show: false }" x-intersect.once="show = true">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-16 items-center">
            <div class="transition duration-1000 opacity-0 -translate-x-12" :class="{'opacity-100 translate-x-0': show}">
                <img src="{{ asset('images/WhatsApp Image 2026-06-24 at 12.37.06 PM.jpeg') }}" class="rounded-3xl shadow-xl" alt="About Image">
            </div>
            <div class="transition duration-1000 opacity-0 translate-x-12" :class="{'opacity-100 translate-x-0': show}">
                <h2 class="text-4xl font-bold mb-6">Youth Revolutionary</h2>
                <p class="text-gray-600 text-lg leading-8">
                    Youth Revolutionary is a student-focused organization...
                </p>
            </div>
        </div>
    </section>

    <!-- MISSION / VISION -->
    <section class="py-24 bg-gray-100" x-data="{ show: false }" x-intersect.once="show = true">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-8">
            <!-- Mission -->
            <div class="p-8 rounded-3xl hover:bg-white hover:shadow-md transition duration-1000 opacity-0 translate-y-10" :class="{'opacity-100 translate-y-0': show}">
                <i class="fa-solid fa-bullseye text-5xl text-blue-600 mb-4"></i>
                <h3 class="text-3xl font-bold mb-4">Our Mission</h3>
                <p class="text-gray-600">To provide students...</p>
            </div>
            <!-- Vision -->
            <div class="p-8 rounded-3xl hover:bg-white hover:shadow-md transition duration-1000 opacity-0 translate-y-10" :class="{'opacity-100 translate-y-0': show}" style="transition-delay: 200ms;">
                <i class="fa-solid fa-eye text-5xl text-blue-600 mb-4"></i>
                <h3 class="text-3xl font-bold mb-4">Our Vision</h3>
                <p class="text-gray-600">To become one of the leading youth organizations...</p>
            </div>
        </div>
    </section>

    <!-- TEAM -->
    <section class="py-24 bg-white" x-data="{ show: false }" x-intersect.once="show = true">
        <div class="max-w-7xl mx-auto px-6 text-center mb-14">
            <h2 class="text-5xl font-bold">Meet Our Team</h2>
        </div>
        <div class="max-w-7xl mx-auto px-6 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($teamMembers as $index => $member)
                <div class="group overflow-hidden rounded-3xl border-2 border-blue-100 bg-white hover:-translate-y-2 hover:shadow transition duration-700 opacity-0 translate-y-10" :class="{'opacity-100 translate-y-0': show}" style="transition-delay: {{ $index * 100 }}ms;">
                    <img src="{{ asset($member['image']) }}" class="h-72 w-full object-cover" alt="{{ $member['name'] }}">
                    <div class="p-6 text-left">
                        <h3 class="text-xl font-bold">{{ $member['name'] }}</h3>
                        <p class="text-blue-600 text-sm font-semibold">{{ $member['role'] }}</p>
                        <p class="text-sm text-gray-600 mt-3">{{ $member['description'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- FEATURED -->
    <section class="py-10">
        <div class="grid sm:grid-cols-3 md:grid-cols-6 gap-6 mx-10">
            @foreach($featuredMembers as $member)
                <div class="text-center p-2 border rounded-2xl transform transition hover:scale-105 hover:-translate-y-1">
                    <img src="{{ asset($member['image']) }}" class="w-24 h-24 mx-auto rounded-full object-cover">
                    <h3 class="mt-3 font-bold">{{ $member['name'] }}</h3>
                    <p class="text-sm text-blue-600">{{ $member['role'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <!-- STATS -->
    <section class="py-24 bg-blue-600 text-white" x-data="{ show: false }" x-intersect.once="show = true">
        <div class="max-w-7xl mx-auto grid md:grid-cols-4 text-center gap-8 transition duration-1000 opacity-0" :class="{'opacity-100': show}">
            @php
            $stats = [
                ['5000+', 'Students'],
                ['100+', 'Competitions'],
                ['50+', 'Schools'],
                ['15+', 'Cities']
            ];
            @endphp
            @foreach($stats as $stat)
                <div>
                    <i class="fa-solid fa-users text-4xl mb-3"></i>
                    <h3 class="text-4xl font-bold">{{ $stat[0] }}</h3>
                    <p>{{ $stat[1] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <!-- CTA -->
    <section class="py-24 bg-gray-100 text-center">
        <h2 class="text-5xl font-bold mb-6">Ready To Showcase Your Talent?</h2>
        <div class="mt-10">
            <a href="{{ url('/register') }}" class="bg-blue-600 text-white px-8 py-4 rounded-xl hover:bg-blue-700 transition">
                Register Now
            </a>
        </div>
    </section>
</x-app-layout>
