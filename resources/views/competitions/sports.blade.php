<x-app-layout>
    @php
    $sportsData = [
        [
            "title" => "Cricket Tournament",
            "description" => "Show your cricket skills and compete with talented teams.",
            "registrationStart" => "01 July 2026",
            "registrationEnd" => "31 July 2026",
            "eligibility" => "Class 6th to 12th",
            "mode" => "Offline",
            "rewards" => "Trophy, Medals & Certificates"
        ],
        [
            "title" => "Football Championship",
            "description" => "Participate in exciting football matches and represent your school.",
            "registrationStart" => "05 July 2026",
            "registrationEnd" => "05 August 2026",
            "eligibility" => "Class 6th to 12th",
            "mode" => "Offline",
            "rewards" => "Trophy & Certificates"
        ],
        [
            "title" => "Kabaddi Competition",
            "description" => "Demonstrate strength, teamwork and strategy in Kabaddi.",
            "registrationStart" => "10 July 2026",
            "registrationEnd" => "10 August 2026",
            "eligibility" => "Class 5th to 12th",
            "mode" => "Offline",
            "rewards" => "Medals & Certificates"
        ],
        [
            "title" => "Athletics Meet",
            "description" => "Compete in running, jumping and track field events.",
            "registrationStart" => "15 July 2026",
            "registrationEnd" => "15 August 2026",
            "eligibility" => "Class 1st to 12th",
            "mode" => "Offline",
            "rewards" => "Gold, Silver & Bronze Medals"
        ]
    ];
    @endphp

    <div x-data="{
        sports: {{ json_encode($sportsData) }},
        activeIndex: 0,
        get activeSport() {
            return this.sports[this.activeIndex];
        }
    }">
        <div class="pt-24 sm:pt-28 pb-10 max-w-7xl mx-auto px-4">
            <div class="text-center mb-10">
                <h1 class="text-4xl font-bold">
                    Sports Competitions
                </h1>
                <p class="text-gray-600 mt-3">
                    Participate in various sports events and showcase
                    your talent.
                </p>
            </div>

            <!-- Sports Buttons -->
            <div class="flex flex-wrap justify-center gap-4 mb-8">
                <template x-for="(sport, index) in sports" :key="index">
                    <button
                        @click="activeIndex = index"
                        :class="activeIndex === index ? 'bg-[#028CD4] text-white' : 'bg-blue-50 border hover:bg-white'"
                        class="px-6 py-3 rounded-full font-semibold transition shadow-sm border border-gray-100"
                        x-text="sport.title">
                    </button>
                </template>
            </div>

            <!-- Banner -->
            <div class="bg-gradient-to-r from-green-800 to-green-500 text-white p-8 rounded-2xl mb-8">
                <h2 class="text-3xl font-bold mb-3" x-text="activeSport.title"></h2>
                <p x-text="activeSport.description"></p>
            </div>

            <!-- Dates -->
            <div class="bg-green-50 border border-green-200 p-4 rounded-xl mb-8">
                <p class="text-center font-semibold">
                    Registration Open:
                    <span class="text-green-700 ml-2" x-text="activeSport.registrationStart"></span>
                    to
                    <span class="text-red-600" x-text="activeSport.registrationEnd"></span>
                </p>
            </div>

            <!-- Details -->
            <div class="grid md:grid-cols-3 gap-6 mb-10">
                <div class="bg-white shadow rounded-xl p-5">
                    <h3 class="font-bold text-green-700">Eligibility</h3>
                    <p x-text="activeSport.eligibility"></p>
                </div>

                <div class="bg-white shadow rounded-xl p-5">
                    <h3 class="font-bold text-green-700">Mode</h3>
                    <p x-text="activeSport.mode"></p>
                </div>

                <div class="bg-white shadow rounded-xl p-5">
                    <h3 class="font-bold text-green-700">Rewards</h3>
                    <p x-text="activeSport.rewards"></p>
                </div>
            </div>

            <!-- Registration Form -->
            <div class="bg-white shadow-lg rounded-2xl p-8">
                <h3 class="text-2xl font-bold mb-6 text-center">
                    <span x-text="activeSport.title"></span> Registration
                </h3>

                <x-competitions-form />
            </div>
        </div>
    </div>
</x-app-layout>
