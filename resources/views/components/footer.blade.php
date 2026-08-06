@php
    $contactSetting = \App\Models\ContactSetting::getSettings();
@endphp
<footer class="bg-gray-900 text-gray-300">
    <div class="max-w-7xl mx-auto px-6 py-12">
        <div class="grid md:grid-cols-4 gap-10">
            <!-- About -->
            <div>
                <h2 class="text-2xl font-bold text-white mb-4">Youth Revolutionary</h2>
                <p class="text-sm leading-6">
                    A platform for students from Class 5th to 12th
                    to participate in Education, Sports and Cultural Competitions.
                </p>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-lg font-semibold text-white mb-4">Quick Links</h3>
                <ul>
                    <li><a href="{{ url('/') }}" class="hover:text-blue-400">Home</a></li>
                    <li><a href="{{ url('/about') }}" class="hover:text-blue-400">About</a></li>
                    <li><a href="{{ url('/events') }}" class="hover:text-blue-400">Events</a></li>
                    <li><a href="{{ url('/results') }}" class="hover:text-blue-400">Results</a></li>
                    <li><a href="{{ url('/gallery') }}" class="hover:text-blue-400">Gallery</a></li>
                </ul>
            </div>

            <!-- Competitions -->
            <div>
                <h3 class="text-lg font-semibold text-white mb-4">Competitions</h3>
                <ul class="space-y-2 flex flex-col">
                    <a href="{{ url('/competitions/education') }}" class="hover:text-blue-400">Education</a>
                    <a href="{{ url('/competitions/sports') }}" class="hover:text-blue-400">Sports</a>
                    <a href="{{ url('/competitions/cultural') }}" class="hover:text-blue-400">Cultural</a>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h3 class="text-lg font-semibold text-white mb-4">Contact Us</h3>
                <div class="space-y-3">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-phone w-4 text-center"></i>
                        <span>{{ $contactSetting->phone ?: '+91 XXXXX XXXXX' }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-envelope w-4 text-center"></i>
                        <span>{{ $contactSetting->email ?: 'info@youthrevolutionary.com' }}</span>
                    </div>
                    <div class="flex items-start gap-2">
                        <i class="fa-solid fa-location-dot w-4 text-center mt-1"></i>
                        <span>{{ $contactSetting->address ?: 'India' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Social Media & Copyright -->
        <hr class="border-t-gray-500 my-5" />
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <p>Copyright</p>
            <div class="text-center">
                <div class="flex justify-center gap-6 mt-4 md:mt-0 pt-2 border-gray-700">
                    <a href="{{ $contactSetting->facebook_link ?: '#' }}" class="hover:text-blue-400 text-xl" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="{{ $contactSetting->instagram_link ?: '#' }}" target="_blank" class="hover:text-pink-400 text-xl"><i class="fa-brands fa-instagram"></i></a>
                    <a href="{{ $contactSetting->youtube_link ?: '#' }}" class="hover:text-red-400 text-xl" target="_blank"><i class="fa-brands fa-youtube"></i></a>
                </div>
                <div class="mt-4 text-sm text-gray-400">
                    © {{ date('Y') }} Youth Revolutionary. All Rights Reserved.
                </div>
            </div>
            <a href="{{ url('/terms') }}" class="hover:text-blue-400">Terms & Conditions</a>
        </div>
    </div>
</footer>
