<x-app-layout>
    <div class="bg-gray-50 min-h-screen">
        <!-- Hero Section -->
        <section class="bg-gradient-to-r from-[#028CD4] to-blue-700 text-white py-24 pt-40">
            <div class="max-w-7xl mx-auto px-6 text-center">
                <i class="fa-solid fa-music text-[70px] mx-auto mb-6"></i>
                <h1 class="text-5xl md:text-6xl font-bold mb-6">Cultural Competitions</h1>
                <p class="max-w-3xl mx-auto text-xl text-blue-100">
                    Discover your creativity, showcase your artistic talent,
                    and celebrate culture through exciting competitions.
                </p>
            </div>
        </section>

        <!-- About -->
        <section class="max-w-7xl mx-auto px-6 py-20">
            <h2 class="text-4xl font-bold text-center mb-8">About Cultural Competitions</h2>
            <p class="max-w-4xl mx-auto text-center text-gray-600 leading-8">
                Cultural competitions encourage students to express themselves
                through art, music, dance, and creativity. These events help
                participants develop confidence, performance skills, and a
                deeper appreciation of culture and traditions.
            </p>
        </section>

        <!-- Activities -->
        <section class="max-w-7xl mx-auto px-6 pb-20">
            <h2 class="text-4xl font-bold text-center mb-12">Available Activities</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl transition hover:-translate-y-2">
                    <div class="text-5xl mb-4">💃</div>
                    <h3 class="text-2xl font-bold text-[#028CD4] mb-3">Dance Competition</h3>
                    <p class="text-gray-600">Show your rhythm, energy and stage performance skills.</p>
                </div>
                <div class="bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl transition hover:-translate-y-2">
                    <div class="text-5xl mb-4">🎤</div>
                    <h3 class="text-2xl font-bold text-[#028CD4] mb-3">Singing Competition</h3>
                    <p class="text-gray-600">Demonstrate your vocal talent and musical abilities.</p>
                </div>
                <div class="bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl transition hover:-translate-y-2">
                    <div class="text-5xl mb-4">🎨</div>
                    <h3 class="text-2xl font-bold text-[#028CD4] mb-3">Drawing Competition</h3>
                    <p class="text-gray-600">Express your imagination and creativity through art.</p>
                </div>
            </div>
        </section>

        <!-- Statistics -->
        <section class="max-w-7xl mx-auto px-6 py-10">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-2xl shadow-lg text-center">
                    <h3 class="text-4xl font-bold text-[#028CD4]">1000+</h3>
                    <p class="text-gray-600 mt-2">Participants</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-lg text-center">
                    <h3 class="text-4xl font-bold text-[#028CD4]">50+</h3>
                    <p class="text-gray-600 mt-2">Schools</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-lg text-center">
                    <h3 class="text-4xl font-bold text-[#028CD4]">25+</h3>
                    <p class="text-gray-600 mt-2">Events</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-lg text-center">
                    <h3 class="text-4xl font-bold text-[#028CD4]">150+</h3>
                    <p class="text-gray-600 mt-2">Awards</p>
                </div>
            </div>
        </section>

        <!-- Benefits -->
        <section class="bg-white py-20 mt-16">
            <div class="max-w-7xl mx-auto px-6">
                <h2 class="text-4xl font-bold text-center mb-12">Benefits of Participation</h2>
                <div class="grid md:grid-cols-4 gap-8">
                    <div class="text-center">
                        <i class="fa-solid fa-award text-[45px] text-[#028CD4] mx-auto"></i>
                        <h3 class="font-bold text-xl mt-4">Recognition</h3>
                        <p class="text-gray-600 mt-2">Win awards, trophies and certificates.</p>
                    </div>
                    <div class="text-center">
                        <i class="fa-solid fa-users text-[45px] text-[#028CD4] mx-auto"></i>
                        <h3 class="font-bold text-xl mt-4">Confidence</h3>
                        <p class="text-gray-600 mt-2">Improve stage presence and self-confidence.</p>
                    </div>
                    <div class="text-center">
                        <i class="fa-solid fa-wand-magic-sparkles text-[45px] text-[#028CD4] mx-auto"></i>
                        <h3 class="font-bold text-xl mt-4">Creativity</h3>
                        <p class="text-gray-600 mt-2">Explore and develop artistic talents.</p>
                    </div>
                    <div class="text-center">
                        <i class="fa-solid fa-music text-[45px] text-[#028CD4] mx-auto"></i>
                        <h3 class="font-bold text-xl mt-4">Expression</h3>
                        <p class="text-gray-600 mt-2">Showcase unique cultural and artistic skills.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Eligibility -->
        <section class="max-w-7xl mx-auto px-6 py-20">
            <div class="bg-white rounded-3xl shadow-lg p-10">
                <h2 class="text-3xl font-bold mb-6">Eligibility</h2>
                <ul class="space-y-3 text-gray-600">
                    <li>✔ Students from Class 1 to 12 can participate.</li>
                    <li>✔ Individual and Group participation allowed.</li>
                    <li>✔ Participants must follow competition guidelines.</li>
                    <li>✔ Original performances and artwork are encouraged.</li>
                </ul>
            </div>
        </section>

        <!-- CTA -->
        <section class="bg-gradient-to-r from-[#028CD4] to-blue-700 text-white py-20">
            <div class="max-w-4xl mx-auto text-center px-6">
                <h2 class="text-5xl font-bold mb-6">Showcase Your Talent</h2>
                <p class="text-lg mb-8">Participate in cultural competitions and let your creativity shine.</p>
                <a href="{{ url('/competitions/cultural') }}" class="inline-block bg-white text-[#028CD4] px-10 py-4 rounded-2xl font-bold hover:scale-105 transition">
                    Register Now
                </a>
            </div>
        </section>
    </div>
</x-app-layout>
