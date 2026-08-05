<x-app-layout>
    @php
    $stats = [
        ["value" => "10000+", "label" => "Participants"],
        ["value" => "50+", "label" => "Schools"],
        ["value" => "20+", "label" => "Competitions"],
        ["value" => "100+", "label" => "Awards"],
    ];

    $categories = [
        [
            "title" => "Education Competitions",
            "desc" => "Quiz, Olympiad, essay writing, science challenge and academic activities for students.",
            "icon" => "fa-solid fa-graduation-cap"
        ],
        [
            "title" => "Sports Competitions",
            "desc" => "Indoor and outdoor sports events that promote discipline, teamwork and physical excellence.",
            "icon" => "fa-solid fa-trophy"
        ],
        [
            "title" => "Cultural Programs",
            "desc" => "Dance, singing, drama, poetry, speech and creative talent competitions.",
            "icon" => "fa-solid fa-music"
        ],
    ];

    $benefits = [
        [
            "title" => "Certificates & Recognition",
            "desc" => "Participants and winners receive official certificates and recognition for their achievements.",
            "icon" => "fa-solid fa-award"
        ],
        [
            "title" => "Confidence Building",
            "desc" => "Events help students improve stage confidence, communication and presentation skills.",
            "icon" => "fa-solid fa-sparkles"
        ],
        [
            "title" => "Skill Development",
            "desc" => "Students sharpen academic, creative, cultural and leadership skills through participation.",
            "icon" => "fa-solid fa-medal"
        ],
        [
            "title" => "Competitive Learning",
            "desc" => "Healthy competition motivates students to perform better and learn from peers.",
            "icon" => "fa-solid fa-trophy"
        ],
        [
            "title" => "Teamwork & Leadership",
            "desc" => "Group activities and event participation develop responsibility, discipline and teamwork.",
            "icon" => "fa-solid fa-users"
        ],
        [
            "title" => "Awards & Appreciation",
            "desc" => "Top performers receive prizes, awards and appreciation that inspire future growth.",
            "icon" => "fa-solid fa-award"
        ],
    ];

    $journey = [
        [
            "title" => "Registration Opens",
            "desc" => "Students can register online and choose their event category.",
        ],
        [
            "title" => "Confirmation & Preparation",
            "desc" => "Participants receive confirmation and event details for preparation.",
        ],
        [
            "title" => "Competition Day",
            "desc" => "Students participate, perform and showcase their talent with confidence.",
        ],
        [
            "title" => "Results & Recognition",
            "desc" => "Top performers are announced and certificates / awards are distributed.",
        ],
    ];

    $faqs = [
        [
            "q" => "Who can participate in these events?",
            "a" => "Students from Class 5th to 12th can participate depending on the event category and eligibility.",
        ],
        [
            "q" => "Will participants receive certificates?",
            "a" => "Yes, eligible participants and winners receive certificates and recognition based on participation and performance.",
        ],
        [
            "q" => "How can I register for an event?",
            "a" => "You can register online through the registration page available on the website.",
        ],
        [
            "q" => "Are these events only academic?",
            "a" => "No. We organize educational, sports, cultural, talent-search and creative competitions as well.",
        ],
    ];
    @endphp

    <!-- Hero Section -->
    <section class="relative flex h-[95vh] items-center justify-center overflow-hidden" x-data="{ show: false }" x-init="setTimeout(() => show = true, 100)">
        <video autoplay muted loop playsinline class="absolute h-full w-full object-cover">
            <source src="{{ asset('video/videoplayback (4).mp4') }}" type="video/mp4" />
        </video>

        <div class="absolute inset-0 bg-black/60"></div>

        <div class="relative z-10 px-6 text-center text-white">
            <h1 x-show="show" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 translate-y-24" x-transition:enter-end="opacity-100 translate-y-0" class="mb-4 text-5xl font-extrabold md:text-7xl">
                Our Events
            </h1>

            <p x-show="show" x-transition:enter="transition ease-out duration-700 delay-100" x-transition:enter-start="opacity-0 translate-x-24" x-transition:enter-end="opacity-100 translate-x-0" class="mx-auto max-w-3xl text-lg leading-8 md:text-xl">
                Discover exciting education, sports and cultural competitions designed for students from Class 5th to 12th, helping them showcase talent, build confidence and grow through healthy competition.
            </p>

            <div x-show="show" x-transition:enter="transition ease-out duration-700 delay-200" x-transition:enter-start="opacity-0 translate-y-24" x-transition:enter-end="opacity-100 translate-y-0" class="mt-8 flex flex-wrap items-center justify-center gap-4">
                <a href="{{ url('/register') }}" class="rounded-2xl bg-[#028CD4] px-7 py-3.5 font-semibold text-white shadow-lg transition hover:bg-[#0277b7]">
                    Register Now
                </a>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="bg-slate-50 py-16" x-data="{ show: false }" x-intersect.once="show = true">
        <div class="mx-auto max-w-7xl px-6">
            <div class="grid grid-cols-2 gap-6 md:grid-cols-4">
                @foreach($stats as $index => $item)
                    <div x-show="show" x-transition:enter="transition ease-out duration-700 delay-[{{ $index * 150 }}ms]" x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0" class="rounded-3xl bg-white p-6 text-center shadow-md transition hover:-translate-y-1 hover:shadow-xl">
                        <h3 class="text-4xl font-extrabold text-[#028CD4]">{{ $item['value'] }}</h3>
                        <p class="mt-2 text-slate-600">{{ $item['label'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @if(isset($featuredEvent) && $featuredEvent)
    <!-- Featured Event -->
    <section class="bg-white py-24" x-data="{ show: false }" x-intersect.once="show = true">
        <div class="mx-auto max-w-7xl px-6">
            <div class="grid items-center gap-10 md:grid-cols-2">
                <div x-show="show" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="overflow-hidden rounded-3xl shadow-2xl aspect-[4/3] bg-slate-100">
                    <img src="{{ str_starts_with($featuredEvent->image, 'http') ? $featuredEvent->image : asset($featuredEvent->image ?? 'images/NIKON Z 502317.JPG.jpeg') }}" alt="{{ $featuredEvent->title }}" class="h-full w-full object-cover" />
                </div>

                <div x-show="show" x-transition:enter="transition ease-out duration-700 delay-200" x-transition:enter-start="opacity-0 translate-x-12" x-transition:enter-end="opacity-100 translate-x-0">
                    <span class="inline-block rounded-full bg-blue-50 px-4 py-1.5 text-sm font-semibold text-blue-600">FEATURED EVENT</span>
                    <h2 class="mt-4 text-4xl font-extrabold leading-tight text-slate-900 md:text-5xl">{{ $featuredEvent->title }}</h2>
                    <p class="mt-6 text-lg font-light leading-8 text-gray-600">
                        {{ $featuredEvent->description }}
                    </p>
                    <div class="mt-8 flex flex-wrap gap-3">
                        <span class="rounded-full bg-purple-50 px-4 py-2 text-sm font-semibold text-[#340C6F] border border-purple-100">{{ $featuredEvent->category }}</span>
                        <span class="rounded-full bg-slate-100 px-4 py-2 text-sm font-medium text-slate-700"><i class="fa-solid fa-location-dot text-red-500 mr-1"></i> {{ $featuredEvent->location }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Event Categories -->
    <section class="bg-white py-20" x-data="{ show: false }" x-intersect.once="show = true">
        <div class="mx-auto max-w-7xl px-6">
            <h2 x-show="show" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0" class="mb-4 text-center text-4xl font-extrabold text-slate-900 md:text-5xl">Event Categories</h2>
            <p x-show="show" x-transition:enter="transition ease-out duration-700 delay-100" x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0" class="mx-auto mb-12 max-w-3xl text-center text-slate-600">We organize diverse competitions to help students explore their academic, athletic, creative and cultural potential.</p>

            <div class="grid gap-8 md:grid-cols-3">
                @foreach($categories as $index => $item)
                    <div x-show="show" x-transition:enter="transition ease-out duration-700 delay-[{{ $index * 150 }}ms]" x-transition:enter-start="opacity-0 translate-y-24" x-transition:enter-end="opacity-100 translate-y-0" class="rounded-3xl border border-slate-200 bg-slate-50 p-8 shadow-sm transition hover:-translate-y-2 hover:shadow-xl">
                        <div class="mb-5 inline-flex rounded-2xl bg-[#028CD4]/10 p-4 text-[#028CD4]">
                            <i class="{{ $item['icon'] }} text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900">{{ $item['title'] }}</h3>
                        <p class="mt-4 leading-7 text-slate-600">{{ $item['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Upcoming Events -->
    <section id="upcoming-events" class="bg-slate-50 py-20">
        <div class="mx-auto max-w-7xl px-6">
            <h2 class="mb-4 text-center text-4xl font-extrabold text-blue-600 md:text-5xl">Upcoming Events</h2>
            <p class="mx-auto mb-12 max-w-3xl text-center text-slate-600">Explore our upcoming competitions and choose the event that matches your passion, talent and ambition.</p>
            <x-events-section />
        </div>
    </section>

    <!-- Why Participate -->
    <section class="bg-white py-20" x-data="{ show: false }" x-intersect.once="show = true">
        <div class="mx-auto max-w-7xl px-6">
            <h2 x-show="show" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0" class="mb-4 text-center text-4xl font-extrabold text-slate-900 md:text-5xl">Why Participate?</h2>
            <p x-show="show" x-transition:enter="transition ease-out duration-700 delay-100" x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0" class="mx-auto mb-12 max-w-3xl text-center text-slate-600">Our events are designed not just as competitions, but as learning experiences that shape confidence, creativity and leadership.</p>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($benefits as $index => $item)
                    <div x-show="show" x-transition:enter="transition ease-out duration-700 delay-[{{ $index * 100 }}ms]" x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0" class="rounded-3xl hover:border-slate-200 hover:bg-slate-50 p-6 transition hover:-translate-y-1 hover:shadow-lg">
                        <div class="mb-4 inline-flex rounded-2xl bg-orange-50 p-3 text-[#F1400C]">
                            <i class="{{ $item['icon'] }} text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900">{{ $item['title'] }}</h3>
                        <p class="mt-3 leading-7 text-slate-600">{{ $item['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Event Journey -->
    <section class="bg-slate-50 py-24" x-data="{ show: false }" x-intersect.once="show = true">
        <div class="mx-auto max-w-5xl px-6">
            <h2 x-show="show" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0" class="mb-4 text-center text-4xl font-extrabold text-slate-900 md:text-5xl">Event Journey</h2>
            <p x-show="show" x-transition:enter="transition ease-out duration-700 delay-100" x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0" class="mx-auto mb-14 max-w-3xl text-center text-slate-600">From registration to results, every event follows a smooth process to ensure a great experience for students and organizers.</p>

            <div class="space-y-6">
                @foreach($journey as $index => $item)
                    <div x-show="show" x-transition:enter="transition ease-out duration-700 delay-[{{ $index * 150 }}ms]" x-transition:enter-start="opacity-0 translate-x-12" x-transition:enter-end="opacity-100 translate-x-0" class="flex gap-5 rounded bg-white p-6 shadow">
                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-blue-50 text-[#028CD4]">
                            <i class="fa-solid fa-calendar-days text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-slate-900">{{ $item['title'] }}</h3>
                            <p class="mt-2 leading-7 text-slate-600">{{ $item['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="bg-slate-50 py-20" x-data="{ show: false }" x-intersect.once="show = true">
        <div class="mx-auto max-w-4xl px-6">
            <h2 x-show="show" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0" class="mb-4 text-center text-4xl font-extrabold text-slate-900 md:text-5xl">Frequently Asked Questions</h2>
            <p x-show="show" x-transition:enter="transition ease-out duration-700 delay-100" x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0" class="mx-auto mb-12 max-w-3xl text-center text-slate-600">Common questions about eligibility, participation, certificates and registration process.</p>

            <div class="space-y-5">
                @foreach($faqs as $index => $item)
                    <div x-show="show" x-transition:enter="transition ease-out duration-700 delay-[{{ $index * 150 }}ms]" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="rounded-xl bg-white p-5 mt-10 shadow transition hover:shadow-md">
                        <div class="flex items-start gap-3">
                            <i class="fa-solid fa-circle-question mt-1 text-[#028CD4] text-xl"></i>
                            <div>
                                <h3 class="text-lg font-bold text-slate-900">{{ $item['q'] }}</h3>
                                <p class="mt-2 leading-7 text-slate-600">{{ $item['a'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Final CTA -->
    <section class="bg-[#028CD4] py-24 text-center text-white">
        <div class="mx-auto max-w-4xl px-6">
            <h2 class="text-4xl font-extrabold md:text-5xl">Ready To Participate?</h2>
            <p class="mx-auto mt-5 max-w-2xl text-lg leading-8 text-white/90">Join our upcoming competitions and showcase your talent, creativity and skills on a bigger platform.</p>
            <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
                <a href="{{ url('/register') }}" class="rounded-2xl bg-white px-8 py-4 font-semibold text-[#028CD4] shadow-lg transition hover:bg-slate-100">
                    Register Now
                </a>
            </div>
        </div>
    </section>
</x-app-layout>
