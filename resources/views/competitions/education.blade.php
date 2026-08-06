<x-app-layout>
    @php
    $competitionData = [
        [
            "title" => "Quiz Competition",
            "description" => "Test your knowledge, compete with talented students, and win exciting prizes and certificates.",
            "registrationStart" => "01 July 2026",
            "registrationEnd" => "31 July 2026",
            "eligibility" => "Students from Class 5th to 10th",
            "mode" => "Offline",
            "rewards" => "Certificates, Medals & Trophies"
        ],
        [
            "title" => "Drawing Competition",
            "description" => "Show your creativity and artistic skills through innovative drawings and artwork.",
            "registrationStart" => "05 July 2026",
            "registrationEnd" => "05 August 2026",
            "eligibility" => "Students from Class 1st to 8th",
            "mode" => "Offline",
            "rewards" => "Certificates & Art Awards"
        ],
        [
            "title" => "Essay Writing Competition",
            "description" => "Express your thoughts, ideas, and creativity through powerful writing.",
            "registrationStart" => "10 July 2026",
            "registrationEnd" => "10 August 2026",
            "eligibility" => "Students from Class 6th to 12th",
            "mode" => "Online & Offline",
            "rewards" => "Certificates & Cash Prizes"
        ],
        [
            "title" => "Creative Art Competition",
            "description" => "Participate in painting, sketching, craft and creative artwork activities.",
            "registrationStart" => "15 July 2026",
            "registrationEnd" => "15 August 2026",
            "eligibility" => "Students from Class 1st to 12th",
            "mode" => "Offline",
            "rewards" => "Certificates, Medals & Trophies"
        ]
    ];
    @endphp

    <div x-data="{
        competitions: {{ json_encode($competitionData) }},
        activeIndex: 0,
        get activeCompetition() {
            return this.competitions[this.activeIndex];
        }
    }">
        <div class="pt-24 sm:pt-28 pb-10 max-w-7xl mx-auto px-4">
            <div class="text-center mb-10">
                <h1 class="text-4xl font-bold text-gray-800">
                    Education Competitions
                </h1>
                <p class="text-gray-600 mt-2">
                    Participate in Quiz, Essay Writing, Drawing & Creative Art Competitions
                    to showcase your talent and knowledge.
                </p>
            </div>

            <div class="bg-gradient-to-r from-[#028CD4] to-blue-600 text-white p-8 rounded-2xl mb-8">
                <h2 class="text-3xl font-bold mb-3" x-text="activeCompetition.title"></h2>
                <p class="text-lg" x-text="activeCompetition.description"></p>
            </div>

            <div class="flex flex-wrap gap-4 justify-center mb-8">
                <template x-for="(competition, index) in competitions" :key="index">
                    <button
                        @click="activeIndex = index"
                        :class="activeIndex === index ? 'bg-[#028CD4] text-white' : 'bg-blue-50 border hover:bg-white'"
                        class="px-6 py-3 rounded-full font-semibold transition shadow-sm border border-gray-100"
                        x-text="competition.title">
                    </button>
                </template>
            </div>

            <div class="bg-yellow-50 border border-yellow-300 rounded-xl p-4 mb-6">
                <p class="text-center font-semibold text-gray-800">
                    📅 Registration Open:
                    <span class="text-[#028CD4]" x-text="activeCompetition.registrationStart"></span>
                    to
                    <span class="text-red-600" x-text="activeCompetition.registrationEnd"></span>
                </p>
            </div>

            <!-- Competition Details -->
            <div class="grid md:grid-cols-3 gap-6 mb-10">
                <div class="bg-white shadow-md rounded-xl p-5">
                    <h3 class="font-bold text-[#028CD4] mb-2">Eligibility</h3>
                    <p x-text="activeCompetition.eligibility"></p>
                </div>

                <div class="bg-white shadow-md rounded-xl p-5">
                    <h3 class="font-bold text-[#028CD4] mb-2">Mode</h3>
                    <p x-text="activeCompetition.mode"></p>
                </div>

                <div class="bg-white shadow-md rounded-xl p-5">
                    <h3 class="font-bold text-[#028CD4] mb-2">Rewards</h3>
                    <p x-text="activeCompetition.rewards"></p>
                </div>
            </div>

            <!-- Registration Form -->
            <div class="bg-white shadow-lg rounded-2xl p-8">
                <h3 class="text-2xl font-bold mb-6 text-center">
                    <span x-text="activeCompetition.title"></span> Registration
                </h3>

                <x-competitions-form />
            </div>
        </div>
    </div>
</x-app-layout>
