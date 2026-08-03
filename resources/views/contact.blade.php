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
                <div class="lg:col-span-3 bg-white rounded-2xl shadow-md p-8" x-data="{ show: false }" x-intersect.once="show = true">
                    <div x-show="show" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 -translate-x-12" x-transition:enter-end="opacity-100 translate-x-0" class="mb-6">
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
                        <div x-show="show" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 translate-x-12" x-transition:enter-end="opacity-100 translate-x-0" class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                            <h3 class="font-semibold text-lg mb-3">Contact Details</h3>
                            <ul class="text-gray-700 space-y-2">
                                <li><span class="font-medium">Phone:</span> <a href="tel:+918864012433" class="text-[#028CD4] ml-2">+91 8864012433</a></li>
                                <li><span class="font-medium">Email:</span> <a href="mailto:info@youthrevolutionary.com" class="text-[#028CD4] ml-2">info@youthrevolutionary.com</a></li>
                                <li><span class="font-medium">Address:</span> <span class="ml-2">Patna, NASRIGANJ</span></li>
                            </ul>
                        </div>

                        <div x-show="show" x-transition:enter="transition ease-out duration-700 delay-100" x-transition:enter-start="opacity-0 translate-x-12" x-transition:enter-end="opacity-100 translate-x-0" class="bg-amber-50 p-4 rounded-2xl shadow-sm border-l-4 border-amber-400">
                            <h4 class="font-semibold mb-3">Quick Actions</h4>
                            <div class="flex flex-col sm:flex-row gap-3">
                                <a href="tel:+919876543210" class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg bg-white text-[#0368A6] font-semibold shadow-sm">
                                    <i class="fa-solid fa-phone"></i> Call
                                </a>
                                <a href="mailto:info@youthrevolutionary.com" class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg bg-white text-[#0368A6] font-semibold shadow-sm">
                                    <i class="fa-solid fa-envelope"></i> Email
                                </a>
                                <a href="https://wa.me/918864012433" target="_blank" rel="noopener noreferrer" class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg bg-[#25D366] text-white font-semibold shadow-sm">
                                    <i class="fa-brands fa-whatsapp"></i> Whatsapp
                                </a>
                            </div>
                        </div>

                        <div x-show="show" x-transition:enter="transition ease-out duration-700 delay-200" x-transition:enter-start="opacity-0 translate-x-12" x-transition:enter-end="opacity-100 translate-x-0" class="bg-white rounded-2xl p-4 shadow-sm">
                            <h4 class="font-semibold mb-3">Follow Us</h4>
                            <div class="flex gap-3">
                                <a href="#" aria-label="Facebook" class="p-3 rounded-lg bg-white border border-gray-100 shadow-sm hover:scale-105 transition" target="_blank" rel="noopener noreferrer">
                                    <i class="fa-brands fa-facebook-f text-[#1877F2]"></i>
                                </a>
                                <a href="https://www.instagram.com/youthrevolutionarynasriganj?igsh=dXZzb2lpYXIzYWZ5" aria-label="Instagram" class="p-3 rounded-lg bg-white border border-gray-100 shadow-sm hover:scale-105 transition" target="_blank" rel="noopener noreferrer">
                                    <i class="fa-brands fa-instagram text-[#C13584]"></i>
                                </a>
                                <a href="https://youtube.com/@youthrevolutionary6914?si=cStQfkgHXTkbsNzO" aria-label="YouTube" class="p-3 rounded-lg bg-white border border-gray-100 shadow-sm hover:scale-105 transition" target="_blank" rel="noopener noreferrer">
                                    <i class="fa-brands fa-youtube text-[#FF0000]"></i>
                                </a>
                            </div>
                        </div>

                        <div x-show="show" x-transition:enter="transition ease-out duration-700 delay-300" x-transition:enter-start="opacity-0 translate-x-12" x-transition:enter-end="opacity-100 translate-x-0" class="bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm">
                            <div class="w-full h-56 md:h-64">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13742.422869504217!2d84.31943645036904!3d25.052886394862792!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x398d091675b59f13%3A0x3eef4953d224224f!2sNasriganj%2C%20Bihar%20821310!5e1!3m2!1sen!2sin!4v1782300158703!5m2!1sen!2sin" height="450" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin" class="w-full h-full"></iframe>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Floating WhatsApp -->
        <a href="https://wa.me/919876543210" aria-label="Chat on WhatsApp" target="_blank" rel="noopener noreferrer" class="fixed bottom-6 right-6 w-14 h-14 bg-green-500 rounded-full shadow-xl flex items-center justify-center text-white text-2xl hover:scale-110 transition animate-bounce">
            <i class="fa-brands fa-whatsapp"></i>
        </a>
    </section>
</x-app-layout>
