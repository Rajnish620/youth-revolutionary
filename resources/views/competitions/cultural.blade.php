<x-app-layout>
    @php
    $culturalData = [
        [
            "title" => "Dance Competition",
            "description" => "Show your talent through solo and group dance performances.",
            "registrationStart" => "01 July 2026",
            "registrationEnd" => "31 July 2026",
            "eligibility" => "Class 1st to 12th",
            "category" => "Solo & Group",
            "rewards" => "Trophies, Medals & Certificates"
        ],
        [
            "title" => "Singing Competition",
            "description" => "Express your musical talent and perform before a live audience.",
            "registrationStart" => "05 July 2026",
            "registrationEnd" => "05 August 2026",
            "eligibility" => "Class 1st to 12th",
            "category" => "Solo Singing",
            "rewards" => "Certificates & Cash Prizes"
        ],
        [
            "title" => "Drama Competition",
            "description" => "Participate in stage performances and showcase acting skills.",
            "registrationStart" => "10 July 2026",
            "registrationEnd" => "10 August 2026",
            "eligibility" => "Class 6th to 12th",
            "category" => "Group Performance",
            "rewards" => "Trophies & Certificates"
        ],
        [
            "title" => "Fancy Dress Competition",
            "description" => "Represent historical, social and cultural characters creatively.",
            "registrationStart" => "15 July 2026",
            "registrationEnd" => "15 August 2026",
            "eligibility" => "Class Nursery to 5th",
            "category" => "Individual",
            "rewards" => "Medals & Certificates"
        ]
    ];
    @endphp

    <div x-data="{
        cultural: {{ json_encode($culturalData) }},
        activeIndex: 0,
        get activeCultural() {
            return this.cultural[this.activeIndex];
        }
    }">
        <div class="mt-40 mb-10 max-w-7xl mx-auto px-4">
            <div class="text-center mb-10">
                <h1 class="text-4xl font-bold">
                    Cultural Competitions
                </h1>
                <p class="text-gray-600 mt-3">
                    Celebrate art, music, dance and drama with exciting cultural events.
                </p>
            </div>

            <!-- Cultural Buttons -->
            <div class="flex flex-wrap justify-center gap-4 mb-8">
                <template x-for="(event, index) in cultural" :key="index">
                    <button
                        @click="activeIndex = index"
                        :class="activeIndex === index ? 'bg-[#028CD4] text-white' : 'bg-blue-50 border hover:bg-white'"
                        class="px-6 py-3 rounded-full font-semibold transition shadow-sm border border-gray-100"
                        x-text="event.title">
                    </button>
                </template>
            </div>

            <!-- Banner -->
            <div class="bg-gradient-to-r from-purple-800 to-purple-500 text-white p-8 rounded-2xl mb-8">
                <h2 class="text-3xl font-bold mb-3" x-text="activeCultural.title"></h2>
                <p x-text="activeCultural.description"></p>
            </div>

            <!-- Dates -->
            <div class="bg-purple-50 border border-purple-200 p-4 rounded-xl mb-8">
                <p class="text-center font-semibold text-gray-800">
                    Registration Open:
                    <span class="text-purple-700 ml-2" x-text="activeCultural.registrationStart"></span>
                    to
                    <span class="text-red-600" x-text="activeCultural.registrationEnd"></span>
                </p>
            </div>

            <!-- Details -->
            <div class="grid md:grid-cols-3 gap-6 mb-10">
                <div class="bg-white shadow rounded-xl p-5">
                    <h3 class="font-bold text-purple-700">Eligibility</h3>
                    <p x-text="activeCultural.eligibility"></p>
                </div>

                <div class="bg-white shadow rounded-xl p-5">
                    <h3 class="font-bold text-purple-700">Category</h3>
                    <p x-text="activeCultural.category"></p>
                </div>

                <div class="bg-white shadow rounded-xl p-5">
                    <h3 class="font-bold text-purple-700">Rewards</h3>
                    <p x-text="activeCultural.rewards"></p>
                </div>
            </div>

            <!-- Registration Form -->
            <div class="bg-white shadow-lg rounded-2xl p-8">
                <h3 class="text-2xl font-bold mb-6 text-center">
                    <span x-text="activeCultural.title"></span> Registration
                </h3>

                <x-competitions-form />
            </div>
        </div>
    </div>
</x-app-layout>
