<x-app-layout>
    <div class="bg-gray-50 min-h-screen">
        <!-- Hero Section -->
        <section class="bg-gradient-to-r from-[#028CD4] to-blue-700 text-white pt-28 pb-16">
            <div class="max-w-7xl mx-auto px-6 text-center">
                <i class="fa-solid fa-trophy text-[70px] mx-auto mb-6"></i>
                <h1 class="text-5xl md:text-6xl font-bold mb-6">Sports Competitions</h1>
                <p class="max-w-3xl mx-auto text-xl text-blue-100">
                    Showcase your athletic skills, teamwork, discipline and
                    sportsmanship through exciting sports competitions.
                </p>
            </div>
        </section>

        <!-- About -->
        <section class="max-w-7xl mx-auto px-6 py-20">
            <h2 class="text-4xl font-bold text-center mb-8">About Sports Competitions</h2>
            <p class="max-w-4xl mx-auto text-center text-gray-600 leading-8">
                Sports competitions provide students with opportunities to
                improve physical fitness, leadership qualities, teamwork and
                confidence. Participants compete in various indoor and outdoor
                sports while learning discipline and fair play.
            </p>
        </section>

        <!-- Sports Categories -->
        <section class="max-w-7xl mx-auto px-6 pb-20">
            <h2 class="text-4xl font-bold text-center mb-12">Available Sports</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl transition hover:-translate-y-2">
                    <div class="text-5xl mb-4">🏏</div>
                    <h3 class="text-2xl font-bold text-[#028CD4] mb-3">Cricket</h3>
                    <p class="text-gray-600">Demonstrate batting, bowling and fielding skills in competitive matches.</p>
                </div>
                <div class="bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl transition hover:-translate-y-2 relative overflow-hidden group">
                    <div class="flex justify-between items-start">
                        <div class="text-5xl mb-4 group-hover:scale-110 transition-transform">🤼</div>
                        <img src="{{ asset('images/kabaddi-match.png') }}" alt="Kabaddi Match" class="w-16 h-16 rounded-full object-cover border-4 border-gray-50 shadow-md transform group-hover:rotate-6 transition-transform">
                    </div>
                    <h3 class="text-2xl font-bold text-[#028CD4] mb-3">Kabaddi</h3>
                    <p class="text-gray-600">Show strength, strategy and teamwork in exciting kabaddi events.</p>
                </div>
                <div class="bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl transition hover:-translate-y-2">
                    <div class="text-5xl mb-4">♟️</div>
                    <h3 class="text-2xl font-bold text-[#028CD4] mb-3">Chess</h3>
                    <p class="text-gray-600">Test your intelligence and strategic thinking abilities.</p>
                </div>
            </div>
        </section>

        <!-- Stats -->
        <section class="max-w-7xl mx-auto px-6 py-10">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-2xl shadow-lg text-center">
                    <h3 class="text-4xl font-bold text-[#028CD4]">500+</h3>
                    <p class="text-gray-600 mt-2">Players</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-lg text-center">
                    <h3 class="text-4xl font-bold text-[#028CD4]">30+</h3>
                    <p class="text-gray-600 mt-2">Schools</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-lg text-center">
                    <h3 class="text-4xl font-bold text-[#028CD4]">15+</h3>
                    <p class="text-gray-600 mt-2">Events</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-lg text-center">
                    <h3 class="text-4xl font-bold text-[#028CD4]">100+</h3>
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
                        <i class="fa-solid fa-trophy text-[45px] text-[#028CD4] mx-auto"></i>
                        <h3 class="font-bold text-xl mt-4">Recognition</h3>
                        <p class="text-gray-600 mt-2">Win trophies, medals and certificates.</p>
                    </div>
                    <div class="text-center">
                        <i class="fa-solid fa-users text-[45px] text-[#028CD4] mx-auto"></i>
                        <h3 class="font-bold text-xl mt-4">Teamwork</h3>
                        <p class="text-gray-600 mt-2">Build collaboration and leadership skills.</p>
                    </div>
                    <div class="text-center">
                        <i class="fa-solid fa-bullseye text-[45px] text-[#028CD4] mx-auto"></i>
                        <h3 class="font-bold text-xl mt-4">Discipline</h3>
                        <p class="text-gray-600 mt-2">Improve focus and commitment.</p>
                    </div>
                    <div class="text-center">
                        <i class="fa-solid fa-medal text-[45px] text-[#028CD4] mx-auto"></i>
                        <h3 class="font-bold text-xl mt-4">Fitness</h3>
                        <p class="text-gray-600 mt-2">Enhance physical and mental well-being.</p>
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
                    <li>✔ Individual and Team participation allowed.</li>
                    <li>✔ School registration may be required.</li>
                    <li>✔ Participants must follow sports rules and regulations.</li>
                </ul>
            </div>
        </section>

        <!-- CTA -->
        <section class="bg-gradient-to-r from-[#028CD4] to-blue-700 text-white py-20">
            <div class="max-w-4xl mx-auto text-center px-6">
                <h2 class="text-5xl font-bold mb-6">Ready to Compete?</h2>
                <p class="text-lg mb-8">Join our sports competitions and showcase your talent.</p>
                <a href="{{ url('/competitions/sports') }}" class="inline-block bg-white text-[#028CD4] px-10 py-4 rounded-2xl font-bold hover:scale-105 transition">
                    Register Now
                </a>
            </div>
        </section>
    </div>
</x-app-layout>
