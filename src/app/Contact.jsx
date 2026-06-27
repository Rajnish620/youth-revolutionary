import ContactForm from "../components/forms/ContactForm";

const Contact = () => {
    return (
        <section className="bg-gray-50 min-h-screen">

            {/* Hero */}
            <div className="bg-linear-to-r from-[#0368A6] to-[#028CD4] text-white py-20 ">
                <div className="max-w-7xl mx-auto px-6 text-center pt-20">
                    <h1 className="text-4xl md:text-5xl font-extrabold mb-3">Contact Us</h1>
                    <p className="text-lg md:text-xl text-white/90 max-w-2xl mx-auto">
                        We're here to help — send a message or reach out via phone or WhatsApp.
                    </p>
                </div>
            </div>

            {/* Content */}
            <div className="max-w-7xl mx-auto px-6 py-12">

                <div className="grid lg:grid-cols-5 gap-8 items-start">

                    {/* Form */}
                    <div className="lg:col-span-3 bg-white rounded-2xl shadow-md p-8">
                        <div className="mb-6">
                            <h2 className="text-2xl md:text-3xl font-bold text-gray-800">Send Message</h2>
                            <p className="text-sm text-gray-500">Fill the form and we'll get back to you within 1-2 business days.</p>
                        </div>
                        <ContactForm />
                    </div>

                    {/* Contact Info */}
                    <div className="lg:col-span-2">
                        <div className="space-y-6">
                            <div className="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                                <h3 className="font-semibold text-lg mb-3">Contact Details</h3>
                                <ul className="text-gray-700 space-y-2">
                                    <li><span className="font-medium">Phone:</span> <a href="tel:+918864012433" className="text-[#028CD4] ml-2">+91 8864012433</a></li>
                                    <li><span className="font-medium">Email:</span> <a href="mailto:info@youthrevolutionary.com" className="text-[#028CD4] ml-2">info@youthrevolutionary.com</a></li>
                                    <li><span className="font-medium">Address:</span> <span className="ml-2">  patna ,NASRIGANJ </span></li>
                                </ul>
                            </div>

                            <div className="bg-amber-50 p-4 rounded-2xl shadow-sm border-l-4 border-amber-400">
                                <h4 className="font-semibold mb-3">Quick Actions</h4>
                                <div className="flex flex-col sm:flex-row gap-3">
                                    <a href="tel:+919876543210" className="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg bg-white text-[#0368A6] font-semibold shadow-sm">
                                        <i class="fa-solid fa-phone"></i> Call
                                    </a>
                                    <a href="mailto:info@youthrevolutionary.com" className="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg bg-white text-[#0368A6] font-semibold shadow-sm">
                                       <i class="fa-solid fa-envelope"></i> Email
                                    </a>
                                    <a href="https://wa.me/918864012433" target="_blank" rel="noopener noreferrer" className="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg bg-[#25D366] text-white font-semibold shadow-sm">
                                       <i class="fa-brands fa-whatsapp"></i> Whatsapp
                                    </a>
                                </div>
                            </div>

                            <div className="bg-white rounded-2xl p-4 shadow-sm">
                                <h4 className="font-semibold mb-3">Follow Us</h4>
                                <div className="flex gap-3">
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
                            </div>

                            {/* Map (kept inside right column so it stacks under info on mobile) */}
                            <div className="bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm">
                                <div className="w-full h-56 md:h-64">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13742.422869504217!2d84.31943645036904!3d25.052886394862792!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x398d091675b59f13%3A0x3eef4953d224224f!2sNasriganj%2C%20Bihar%20821310!5e1!3m2!1sen!2sin!4v1782300158703!5m2!1sen!2sin" height="450" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin" className="w-full h-full"></iframe>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>

            {/* Floating WhatsApp (accessible) */}
            <a href="https://wa.me/919876543210" aria-label="Chat on WhatsApp" target="_blank" rel="noopener noreferrer" className="fixed bottom-6 right-6 w-14 h-14 bg-green-500 rounded-full shadow-xl flex items-center justify-center text-white text-2xl hover:scale-110 transition animate-bounce">
                <i class="fa-brands fa-whatsapp"></i>
            </a>

        </section>
    );
};

export default Contact;