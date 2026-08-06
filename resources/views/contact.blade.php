<x-app-layout>
    <section class="bg-gray-50 min-h-screen">
        <!-- Hero -->
        <div class="bg-linear-to-r from-[#0368A6] to-[#028CD4] text-white py-20">
            <div class="max-w-7xl mx-auto px-6 text-center pt-20" x-data="{ show: false }" x-init="setTimeout(() => show = true, 100)">
                <h1 x-show="show" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0" class="text-4xl md:text-5xl font-extrabold mb-3">Contact Us</h1>
                <p x-show="show" x-transition:enter="transition ease-out duration-700 delay-100" x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0" class="text-lg md:text-xl text-white/90 max-w-2xl mx-auto">
                    We're here to help — send a message or reach out via phone or WhatsApp.
                </p>
            </div>
        </div>

        <!-- Content -->
        <div class="max-w-7xl mx-auto px-6 py-12">
            <div class="grid lg:grid-cols-5 gap-8 items-start">
                
                <!-- Form -->
                <div class="lg:col-span-3 bg-white rounded-2xl shadow-md p-6 sm:p-8" x-data="{ show: false }" x-intersect.once="show = true">
                    <div x-show="show" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 translate-y-8 sm:-translate-x-12 sm:translate-y-0" x-transition:enter-end="opacity-100 translate-x-0 translate-y-0" class="mb-6">
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Send Message</h2>
                        <p class="text-sm text-gray-500">Fill the form and we'll get back to you within 1-2 business days.</p>
                    </div>

                    <!-- ContactForm Component Inline -->
                    <div x-data="{ 
                            name: '', email: '', message: '', 
                            errors: {},
                            validate() {
                                this.errors = {};
                                if (!this.name) this.errors.name = 'Name is required';
                                if (!this.email) {
                                    this.errors.email = 'Email is required';
                                } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.email)) {
                                    this.errors.email = 'Invalid Email';
                                }
                                if (!this.message) {
                                    this.errors.message = 'Message is required';
                                } else if (this.message.length < 10) {
                                    this.errors.message = 'Minimum 10 characters required';
                                }
                                return Object.keys(this.errors).length === 0;
                            },
                            submit() {
                                if (this.validate()) {
                                    console.log({ name: this.name, email: this.email, message: this.message });
                                    alert('Message Sent Successfully!');
                                    this.name = ''; this.email = ''; this.message = '';
                                }
                            }
                        }" 
                        x-show="show" x-transition:enter="transition ease-out duration-700 delay-100" x-transition:enter-start="opacity-0 -translate-x-12" x-transition:enter-end="opacity-100 translate-x-0"
                        class="bg-white">
                        
                        <form @submit.prevent="submit" class="space-y-5">
                            <div>
                                <input type="text" placeholder="Full Name" x-model="name" class="w-full border-2 border-gray-200 p-4 rounded-xl focus:border-[#028CD4] outline-none">
                                <p x-show="errors.name" x-text="errors.name" class="text-red-500 mt-1"></p>
                            </div>
                            <div>
                                <input type="email" placeholder="Email Address" x-model="email" class="w-full border-2 border-gray-200 p-4 rounded-xl focus:border-[#028CD4] outline-none">
                                <p x-show="errors.email" x-text="errors.email" class="text-red-500 mt-1"></p>
                            </div>
                            <div>
                                <textarea rows="5" placeholder="Your Message" x-model="message" class="w-full border-2 border-gray-200 p-4 rounded-xl focus:border-[#028CD4] outline-none"></textarea>
                                <p x-show="errors.message" x-text="errors.message" class="text-red-500 mt-1"></p>
                            </div>
                            <button type="submit" class="w-full bg-[#028CD4] hover:bg-[#0177b4] text-white py-4 rounded-xl font-semibold transition">
                                Send Message
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="lg:col-span-2" x-data="{ show: false }" x-intersect.once="show = true">
                    <div class="space-y-6">
                        <div x-show="show" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 translate-y-8 sm:translate-x-12 sm:translate-y-0" x-transition:enter-end="opacity-100 translate-x-0 translate-y-0" class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                            <h3 class="font-semibold text-lg mb-3">Contact Details</h3>
                            <ul class="text-gray-700 space-y-2">
                                <li><span class="font-medium">Phone:</span> <a href="tel:{{ str_replace(' ', '', $contactSetting->phone) }}" class="text-[#028CD4] ml-2">{{ $contactSetting->phone }}</a></li>
                                <li><span class="font-medium">Email:</span> <a href="mailto:{{ $contactSetting->email }}" class="text-[#028CD4] ml-2">{{ $contactSetting->email }}</a></li>
                                <li><span class="font-medium">Address:</span> <span class="ml-2">{{ $contactSetting->address }}</span></li>
                            </ul>
                        </div>

                        <div x-show="show" x-transition:enter="transition ease-out duration-700 delay-100" x-transition:enter-start="opacity-0 translate-x-12" x-transition:enter-end="opacity-100 translate-x-0" class="bg-amber-50 p-4 rounded-2xl shadow-sm border-l-4 border-amber-400">
                            <h4 class="font-semibold mb-3">Quick Actions</h4>
                            <div class="flex flex-col sm:flex-row gap-3">
                                <a href="tel:{{ str_replace(' ', '', $contactSetting->phone) }}" class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg bg-white text-[#0368A6] font-semibold shadow-sm">
                                    <i class="fa-solid fa-phone"></i> Call
                                </a>
                                <a href="mailto:{{ $contactSetting->email }}" class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg bg-white text-[#0368A6] font-semibold shadow-sm">
                                    <i class="fa-solid fa-envelope"></i> Email
                                </a>
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contactSetting->whatsapp) }}" target="_blank" rel="noopener noreferrer" class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg bg-[#25D366] text-white font-semibold shadow-sm">
                                    <i class="fa-brands fa-whatsapp"></i> Whatsapp
                                </a>
                            </div>
                        </div>

                        <div x-show="show" x-transition:enter="transition ease-out duration-700 delay-200" x-transition:enter-start="opacity-0 translate-x-12" x-transition:enter-end="opacity-100 translate-x-0" class="bg-white rounded-2xl p-4 shadow-sm">
                            <h4 class="font-semibold mb-3">Follow Us</h4>
                            <div class="flex gap-3">
                                <a href="{{ $contactSetting->facebook_link }}" aria-label="Facebook" class="p-3 rounded-lg bg-white border border-gray-100 shadow-sm hover:scale-105 transition" target="_blank" rel="noopener noreferrer">
                                    <i class="fa-brands fa-facebook-f text-[#1877F2]"></i>
                                </a>
                                <a href="{{ $contactSetting->instagram_link }}" aria-label="Instagram" class="p-3 rounded-lg bg-white border border-gray-100 shadow-sm hover:scale-105 transition" target="_blank" rel="noopener noreferrer">
                                    <i class="fa-brands fa-instagram text-[#C13584]"></i>
                                </a>
                                <a href="{{ $contactSetting->youtube_link }}" aria-label="YouTube" class="p-3 rounded-lg bg-white border border-gray-100 shadow-sm hover:scale-105 transition" target="_blank" rel="noopener noreferrer">
                                    <i class="fa-brands fa-youtube text-[#FF0000]"></i>
                                </a>
                            </div>
                        </div>

                        <div x-show="show" x-transition:enter="transition ease-out duration-700 delay-300" x-transition:enter-start="opacity-0 translate-x-12" x-transition:enter-end="opacity-100 translate-x-0" class="bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm">
                            <div class="w-full h-56 md:h-64">
                                @if($contactSetting->map_embed_url)
                                    @php
                                        $mapUrl = $contactSetting->map_embed_url;
                                        // 1. If they pasted the full iframe code
                                        if (\Illuminate\Support\Str::contains($mapUrl, '<iframe')) {
                                            preg_match('/src="([^"]+)"/', $mapUrl, $match);
                                            $mapUrl = $match[1] ?? $mapUrl;
                                        } 
                                        // 2. If they pasted a standard /place/ link from the browser bar
                                        elseif (\Illuminate\Support\Str::contains($mapUrl, '/place/')) {
                                            preg_match('/\/place\/([^\/]+)/', $mapUrl, $match);
                                            if (isset($match[1])) {
                                                $mapUrl = 'https://maps.google.com/maps?q=' . $match[1] . '&output=embed';
                                            }
                                        }
                                    @endphp
                                    <iframe src="{{ $mapUrl }}" height="450" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin" class="w-full h-full"></iframe>
                                @else
                                    <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-400">Map not configured</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Floating WhatsApp -->
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contactSetting->whatsapp) }}" aria-label="Chat on WhatsApp" target="_blank" rel="noopener noreferrer" class="fixed bottom-6 right-6 w-14 h-14 bg-green-500 rounded-full shadow-xl flex items-center justify-center text-white text-2xl hover:scale-110 transition animate-bounce">
            <i class="fa-brands fa-whatsapp"></i>
        </a>
    </section>
</x-app-layout>
