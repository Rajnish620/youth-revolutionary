<x-app-layout>
    <div x-data="{ activeTab: 'competition' }" style="background-color: #F8FAF7; color: #1A3320;" class="min-h-screen font-sans overflow-x-hidden">
        
        <!-- HERO SECTION (Explicit inline padding 260px guarantees clearance under navbar) -->
        <section style="padding-top: 260px; padding-bottom: 80px; background-color: #0D1A10; color: #ffffff;" class="relative px-6 overflow-hidden text-center shadow-inner">
          <!-- Animated Background Glow matching D:\yoga -->
          <div style="background-color: rgba(16, 185, 129, 0.15);" class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] rounded-full blur-[120px] pointer-events-none"></div>
          <div style="background-color: rgba(5, 150, 105, 0.15);" class="absolute -bottom-20 -right-20 w-96 h-96 rounded-full blur-[100px] pointer-events-none"></div>
          
          <div style="padding-top: 30px;" class="max-w-6xl mx-auto relative z-10 text-center">
            <!-- Sparkles Pill Badge -->
            <div style="background-color: rgba(16, 185, 129, 0.15); border-color: rgba(52, 211, 153, 0.3); color: #6ee7b7;" class="inline-flex items-center gap-3 px-4 py-1.5 rounded-full border backdrop-blur-md mb-8">
              <i class="fa-solid fa-sparkles text-emerald-400 text-xs"></i>
              <span class="text-[11px] font-bold tracking-[0.25em] uppercase">Official Terms, Rules, Privacy & Refund Policy</span>
            </div>

            <!-- Title with Serif & Italic Accent -->
            <h1 style="color: #ffffff;" class="text-4xl sm:text-6xl md:text-7xl font-serif mb-6 leading-[1.05] tracking-tight">
              Youth Revolutionary <br />
              <span style="color: #34d399;" class="italic font-normal">Terms & Policies</span>
            </h1>

            <p style="color: #d1fae5;" class="max-w-2xl mx-auto text-base sm:text-lg font-light leading-relaxed mb-8 opacity-90">
              Official policies governing competition rules, website terms, privacy practices, and refund/cancellation guidelines.
            </p>

            <!-- 4-TAB TOGGLE SWITCHER -->
            <div class="flex flex-wrap items-center justify-center gap-2.5 mb-8">
                <button 
                    @click="activeTab = 'competition'" 
                    :style="activeTab === 'competition' ? 'background-color: #10b981; color: #0D1A10;' : 'background-color: rgba(255,255,255,0.1); color: #ffffff; border-color: rgba(255,255,255,0.2);'" 
                    class="px-4 py-2.5 rounded-full font-bold text-xs uppercase tracking-wider transition-all duration-300 border shadow-lg cursor-pointer">
                    <i class="fa-solid fa-trophy mr-1.5"></i> Competition Terms (19)
                </button>
                <button 
                    @click="activeTab = 'website'" 
                    :style="activeTab === 'website' ? 'background-color: #10b981; color: #0D1A10;' : 'background-color: rgba(255,255,255,0.1); color: #ffffff; border-color: rgba(255,255,255,0.2);'" 
                    class="px-4 py-2.5 rounded-full font-bold text-xs uppercase tracking-wider transition-all duration-300 border shadow-lg cursor-pointer">
                    <i class="fa-solid fa-globe mr-1.5"></i> Website Terms (12)
                </button>
                <button 
                    @click="activeTab = 'privacy'" 
                    :style="activeTab === 'privacy' ? 'background-color: #10b981; color: #0D1A10;' : 'background-color: rgba(255,255,255,0.1); color: #ffffff; border-color: rgba(255,255,255,0.2);'" 
                    class="px-4 py-2.5 rounded-full font-bold text-xs uppercase tracking-wider transition-all duration-300 border shadow-lg cursor-pointer">
                    <i class="fa-solid fa-user-shield mr-1.5"></i> Privacy Policy (17)
                </button>
                <button 
                    @click="activeTab = 'refund'" 
                    :style="activeTab === 'refund' ? 'background-color: #10b981; color: #0D1A10;' : 'background-color: rgba(255,255,255,0.1); color: #ffffff; border-color: rgba(255,255,255,0.2);'" 
                    class="px-4 py-2.5 rounded-full font-bold text-xs uppercase tracking-wider transition-all duration-300 border shadow-lg cursor-pointer">
                    <i class="fa-solid fa-receipt mr-1.5"></i> Refund Policy (16)
                </button>
            </div>

            <!-- Metadata Pill -->
            <div style="background-color: rgba(6, 78, 59, 0.8); border-color: rgba(52, 211, 153, 0.3); color: #d1fae5;" class="inline-flex items-center gap-3 px-5 py-2.5 rounded-full border backdrop-blur-md text-xs sm:text-sm font-medium shadow-xl">
              <i class="fa-regular fa-calendar-check text-emerald-400"></i>
              <span>Last Updated: <strong style="color: #ffffff;">08/08/2026</strong></span>
            </div>
          </div>
        </section>

        <!-- MAIN CONTENT AREA -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">

            <!-- TAB 1: COMPETITION TERMS & CONDITIONS -->
            <div x-show="activeTab === 'competition'" x-transition.opacity>
                <!-- PREAMBLE NOTICE CARD -->
                <div style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border mb-10 relative overflow-hidden">
                    <div style="background-color: #059669;" class="absolute top-0 left-0 w-2 h-full"></div>
                    <div class="flex items-start gap-4 sm:gap-5">
                        <div style="background-color: #ecfdf5; color: #047857;" class="w-12 h-12 rounded-2xl flex-shrink-0 flex items-center justify-center text-xl shadow-inner">
                            <i class="fa-solid fa-circle-info"></i>
                        </div>
                        <div>
                            <span style="color: #059669;" class="text-xs font-bold uppercase tracking-[0.2em] block mb-1">Competition Terms & Agreement</span>
                            <h2 style="color: #1A3320;" class="text-xl sm:text-2xl font-serif mb-2">Participant & Guardian Acknowledgment</h2>
                            <p style="color: #4A6350;" class="leading-relaxed text-sm sm:text-base font-light">
                                These Competition Terms & Conditions (“Terms”) apply to all competitions, contests, auditions, events, and activities organized by <strong>Youth Revolutionary</strong> (“Youth Revolutionary”, “we”, “us”, or “organizer”). By registering for, attending, or participating in any competition, the participant and, where applicable, their parent/guardian agree to follow these Terms along with the specific rules announced for the respective competition.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- LAYOUT GRID: STICKY SIDEBAR + CONTENT CARDS -->
                <div class="grid lg:grid-cols-12 gap-8 items-start">

                    <!-- STICKY TABLE OF CONTENTS SIDEBAR -->
                    <aside style="background-color: #ffffff; border-color: #D8E2D5;" class="hidden lg:block lg:col-span-4 sticky top-32 rounded-[2rem] p-6 shadow-sm border max-h-[calc(100vh-9rem)] overflow-y-auto">
                        <h3 style="color: #1A3320;" class="text-sm font-extrabold uppercase tracking-wider mb-4 pb-3 border-b border-slate-100 flex items-center justify-between">
                            <span class="flex items-center gap-2">
                                <i class="fa-solid fa-list-ol text-emerald-600"></i> Competition Sections
                            </span>
                            <span style="background-color: #ecfdf5; color: #047857;" class="text-[10px] font-bold px-2 py-0.5 rounded-full">19 Sections</span>
                        </h3>

                        <nav style="color: #4A6350;" class="space-y-1 text-xs font-medium">
                            <a href="#comp-section-1" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">1</span>
                                <span class="truncate">Registration Rules</span>
                            </a>
                            <a href="#comp-section-2" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">2</span>
                                <span class="truncate">Eligibility & Age Criteria</span>
                            </a>
                            <a href="#comp-section-3" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">3</span>
                                <span class="truncate">Competition-Specific Rules</span>
                            </a>
                            <a href="#comp-section-4" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">4</span>
                                <span class="truncate">Reporting Time & Venue</span>
                            </a>
                            <a href="#comp-section-5" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">5</span>
                                <span class="truncate">Required Materials & Equipment</span>
                            </a>
                            <a href="#comp-section-6" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">6</span>
                                <span class="truncate">Audition & Selection Process</span>
                            </a>
                            <a href="#comp-section-7" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">7</span>
                                <span class="truncate">Judges' Decision</span>
                            </a>
                            <a href="#comp-section-8" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">8</span>
                                <span class="truncate">Scoring & Negative Marking</span>
                            </a>
                            <a href="#comp-section-9" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">9</span>
                                <span class="truncate">Discipline & Fair Play</span>
                            </a>
                            <a href="#comp-section-10" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">10</span>
                                <span class="truncate">Disqualification</span>
                            </a>
                            <a href="#comp-section-11" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">11</span>
                                <span class="truncate">Prizes, Certificates & Medals</span>
                            </a>
                            <a href="#comp-section-12" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">12</span>
                                <span class="truncate">Photo & Video Usage</span>
                            </a>
                            <a href="#comp-section-13" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">13</span>
                                <span class="truncate">Minor Participants & Consent</span>
                            </a>
                            <a href="#comp-section-14" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">14</span>
                                <span class="truncate">Sports Safety</span>
                            </a>
                            <a href="#comp-section-15" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">15</span>
                                <span class="truncate">Lost Personal Belongings</span>
                            </a>
                            <a href="#comp-section-16" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">16</span>
                                <span class="truncate">Date & Venue Changes</span>
                            </a>
                            <a href="#comp-section-17" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">17</span>
                                <span class="truncate">Fee & Refund Rules</span>
                            </a>
                            <a href="#comp-section-18" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">18</span>
                                <span class="truncate">Organizer's Rights</span>
                            </a>
                            <a href="#comp-section-19" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">19</span>
                                <span class="truncate">Acceptance of Rules</span>
                            </a>
                        </nav>
                    </aside>

                    <!-- MAIN SECTION CARDS -->
                    <main class="lg:col-span-8 space-y-8">

                        <!-- SECTION 1 -->
                        <div id="comp-section-1" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    1
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Competition Section 01</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">Registration Rules</h2>
                                </div>
                                <i class="fa-solid fa-clipboard-list text-2xl text-emerald-300"></i>
                            </div>
                            <ul style="color: #4A6350;" class="space-y-4 leading-relaxed font-light text-sm sm:text-base">
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Participants must complete registration through the official Youth Revolutionary website, registration form, or any other method specified by the organizers.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>All information provided during registration must be true, accurate, complete, and up to date. This may include the participant's name, date of birth, contact details, category, address, parent/guardian information, and other required details.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Participants must register using their own identity. False information, incorrect age, duplicate registrations, impersonation, or any attempt to obtain an unfair advantage may result in cancellation of registration and disqualification.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Participants should keep their Registration ID, Application Number, payment receipt, confirmation message, or other registration proof safely and present it when required.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Registration deadlines, participant limits, and selection procedures may vary for each competition. Youth Revolutionary may close registration early if the maximum number of participants is reached.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Registration does not automatically guarantee selection, qualification, or participation in a final round where an audition, screening, or eligibility verification is required.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Where a registration fee applies, payment must be made only through the official payment method provided by Youth Revolutionary.</span>
                                </li>
                            </ul>
                        </div>

                        <!-- SECTION 2 -->
                        <div id="comp-section-2" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    2
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Competition Section 02</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">Eligibility and Age Criteria</h2>
                                </div>
                                <i class="fa-solid fa-user-check text-2xl text-emerald-300"></i>
                            </div>
                            <ul style="color: #4A6350;" class="space-y-4 leading-relaxed font-light text-sm sm:text-base">
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Each competition may have specific eligibility requirements, including age, category, gender, educational level, team requirements, or other criteria.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Participants must register only in the category for which they are genuinely eligible. Age will be calculated according to the cut-off date or method specified for the particular competition.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Youth Revolutionary may verify age and category eligibility based on self-declared registration details, school/college IDs, or institution records where applicable.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>If a participant is found to be ineligible or has provided incorrect age or eligibility information, their participation, result, prize, medal, or certificate may be cancelled.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>For participants below 18 years of age, parent or legal guardian consent may be required.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Competition-specific eligibility conditions published on the registration page or official event notice will apply in addition to these general Terms.</span>
                                </li>
                            </ul>
                        </div>

                        <!-- SECTION 3 -->
                        <div id="comp-section-3" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    3
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Competition Section 03</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">Competition-Specific Rules</h2>
                                </div>
                                <i class="fa-solid fa-gavel text-2xl text-emerald-300"></i>
                            </div>
                            <ul style="color: #4A6350;" class="space-y-4 leading-relaxed font-light text-sm sm:text-base">
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Every competition may have its own rules regarding time limits, topics, questions, performance duration, equipment, materials, scoring, judging, qualifying criteria, and participation procedures.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Participants must carefully follow the rules applicable to their particular competition.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span><strong>Quiz Competitions:</strong> Rules may include the number of questions, four-option objective questions, OMR Sheet requirements, permitted pens, time limits, negative marking, and answer-marking instructions.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span><strong>Sports Competitions:</strong> Rules may include age categories, distance, timing, playing method, equipment, fouls, safety requirements, and winner determination.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span><strong>Cultural Competitions (Singing, Dance, Acting, Mimicry):</strong> Participants may have to follow specific requirements regarding performance duration, songs, music, instruments, costumes, props, and other materials.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span><strong>Arts Competitions (Painting, Essay Writing):</strong> The topic, language, word limit, time limit, paper, colors, stationery, and permitted materials may be specified separately.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Where an audition is required, only selected participants may proceed to the final competition.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Participants must follow all instructions given by organizers, judges, officials, referees, coordinators, and volunteers.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Violation of competition-specific rules may result in warning, deduction of marks, disqualification, or cancellation of results.</span>
                                </li>
                            </ul>
                        </div>

                        <!-- SECTION 4 -->
                        <div id="comp-section-4" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    4
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Competition Section 04</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">Reporting Time and Venue</h2>
                                </div>
                                <i class="fa-solid fa-clock text-2xl text-emerald-300"></i>
                            </div>
                            <ul style="color: #4A6350;" class="space-y-4 leading-relaxed font-light text-sm sm:text-base">
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>The official reporting time, competition time, and venue will be mentioned in the relevant competition details.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Participants should arrive before the reporting time to complete registration verification, attendance, briefing, warm-up, audition, or other required procedures.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Late arrival may result in refusal of entry or participation, particularly where the competition has already started or important instructions have been given.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Participants are responsible for arranging their own travel and reaching the venue on time.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Youth Revolutionary may change the reporting time, schedule, or venue due to weather, safety, administrative, technical, government, venue, or other unavoidable circumstances.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Participants should regularly check the official Youth Revolutionary website and official communication channels for updates.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Only official communications should be relied upon for changes to event schedules or venues.</span>
                                </li>
                            </ul>
                        </div>

                        <!-- SECTION 5 -->
                        <div id="comp-section-5" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    5
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Competition Section 05</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">Required Materials and Equipment</h2>
                                </div>
                                <i class="fa-solid fa-briefcase text-2xl text-emerald-300"></i>
                            </div>
                            <ul style="color: #4A6350;" class="space-y-4 leading-relaxed font-light text-sm sm:text-base">
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Participants must bring all materials, equipment, instruments, costumes, props, stationery, sportswear, or other items specifically required for their competition unless the organizers state that such items will be provided.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Participants must bring only permitted materials and equipment. Prohibited, unsafe, or unauthorized items may not be allowed.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>For Singing, Dance, Acting, and Mimicry, participants may need to bring their own music, instruments, costumes, props, or other performance materials.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>For Painting or Essay competitions, participants may be required to bring their own stationery, colors, brushes, pencils, or other permitted materials.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>For Sports competitions, participants may need suitable sportswear, footwear, and protective equipment.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>For Quiz competitions, participants must follow the specified stationery and OMR instructions. Where applicable, only black or blue ball pens may be permitted.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Participants are responsible for the safe custody of their personal materials and equipment.</span>
                                </li>
                            </ul>
                        </div>

                        <!-- SECTION 6 -->
                        <div id="comp-section-6" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    6
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Competition Section 06</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">Audition and Selection Process</h2>
                                </div>
                                <i class="fa-solid fa-star text-2xl text-emerald-300"></i>
                            </div>
                            <ul style="color: #4A6350;" class="space-y-4 leading-relaxed font-light text-sm sm:text-base">
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Some competitions may include an audition, screening, preliminary round, or selection process before the final competition.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Participants must attend the audition at the specified date, time, and venue and follow all instructions provided by the organizers and judges.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Auditions may evaluate talent, skill, creativity, presentation, technique, confidence, originality, or other criteria relevant to the competition.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>The number of participants selected for the final round may depend on available slots, performance quality, eligibility, and the applicable selection criteria.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Participation in an audition does not guarantee selection for the final competition.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Where announced, audition results may be declared immediately after the audition or communicated through official channels.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>False information, impersonation, unauthorized assistance, or attempts to influence the selection process may result in disqualification.</span>
                                </li>
                            </ul>
                        </div>

                        <!-- SECTION 7 -->
                        <div id="comp-section-7" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    7
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Competition Section 07</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">Judges' Decision</h2>
                                </div>
                                <i class="fa-solid fa-scale-balanced text-2xl text-emerald-300"></i>
                            </div>
                            <ul style="color: #4A6350;" class="space-y-4 leading-relaxed font-light text-sm sm:text-base">
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Competitions requiring evaluation will be judged by judges, officials, evaluators, or an authorized judging panel appointed or approved by Youth Revolutionary.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Judges may consider criteria such as accuracy, creativity, technique, presentation, originality, timing, performance quality, discipline, and adherence to competition rules, depending on the event.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Judges must not be improperly influenced through pressure, threats, gifts, personal recommendations, or other inappropriate means.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Unless a specific review or appeal procedure is announced, the decision of the judges/judging panel will be final for determining competition results.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>In case of a tie, the applicable tie-breaking procedure will be followed. Where no specific procedure has been announced, the judges or organizers may determine an appropriate method.</span>
                                </li>
                            </ul>
                        </div>

                        <!-- SECTION 8 -->
                        <div id="comp-section-8" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    8
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Competition Section 08</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">Scoring and Negative Marking</h2>
                                </div>
                                <i class="fa-solid fa-pen-to-square text-2xl text-emerald-300"></i>
                            </div>
                            <ul style="color: #4A6350;" class="space-y-4 leading-relaxed font-light text-sm sm:text-base">
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Each competition may have its own scoring system, marking scheme, qualifying marks, penalties, or tie-breaking rules.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>For quiz or written competitions, marks may be awarded for correct answers and deducted for incorrect answers where negative marking applies.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span><strong>Negative Marking Protocol:</strong> If 1/4 negative marking is specified, one-fourth of the marks assigned to an incorrect answer will be deducted from the participant's score.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Participants must carefully follow all OMR and answer-sheet instructions.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Where an OMR Sheet is used, participants must mark answers only in the prescribed manner and use the permitted pen. Incorrect, double, incomplete, overwritten, or improperly marked answers may be treated as invalid according to the applicable instructions.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>For performance-based competitions, scoring may consider creativity, technique, presentation, accuracy, timing, originality, and overall performance.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>For sports, scoring may be based on time, distance, points, goals, accuracy, finishing order, or other event-specific criteria.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>The scoring method applicable to each competition will be communicated through its official instructions.</span>
                                </li>
                            </ul>
                        </div>

                        <!-- SECTION 9 -->
                        <div id="comp-section-9" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    9
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Competition Section 09</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">Discipline and Fair Play</h2>
                                </div>
                                <i class="fa-solid fa-shield-halved text-2xl text-emerald-300"></i>
                            </div>
                            <ul style="color: #4A6350;" class="space-y-4 leading-relaxed font-light text-sm sm:text-base">
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>All participants must maintain discipline, honesty, respect, sportsmanship, and fair play throughout the event.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Participants must behave respectfully toward other participants, judges, organizers, volunteers, officials, parents, guardians, spectators, and venue staff.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #fffbebf5; color: #d97706;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-triangle-exclamation text-[10px]"></i>
                                    </div>
                                    <span><strong>Strictly Prohibited:</strong> Cheating or using unfair means; Unauthorized assistance; Using prohibited materials or devices; Impersonation or fraudulent registration; Attempting to influence judges; Threatening, abusing, harassing, or fighting with others; Disrupting another participant's performance; Damaging venue or competition property; Manipulating scores, results, or registrations; Violating safety or competition instructions.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Sports participants must demonstrate proper sportsmanship and avoid dangerous or intentionally harmful conduct.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Violation of these requirements may lead to warning, mark deduction, removal from the venue, disqualification, or other appropriate action.</span>
                                </li>
                            </ul>
                        </div>

                        <!-- SECTION 10 -->
                        <div id="comp-section-10" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    10
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Competition Section 10</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">Disqualification</h2>
                                </div>
                                <i class="fa-solid fa-ban text-2xl text-emerald-300"></i>
                            </div>
                            <ul style="color: #4A6350;" class="space-y-4 leading-relaxed font-light text-sm sm:text-base">
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #fff1f2; color: #e11d48;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-xmark text-[10px]"></i>
                                    </div>
                                    <span>Youth Revolutionary may disqualify a participant for violating these Terms, competition-specific rules, eligibility requirements, safety instructions, or official directions.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #fff1f2; color: #e11d48;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-xmark text-[10px]"></i>
                                    </div>
                                    <span>Disqualification may occur before, during, or after the competition if a violation is discovered.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #fff1f2; color: #e11d48;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-xmark text-[10px]"></i>
                                    </div>
                                    <span>Grounds for disqualification may include false information, incorrect age, cheating, impersonation, unauthorized assistance, prohibited materials, misconduct, rule violations, interference with other participants, or attempts to manipulate results.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #fff1f2; color: #e11d48;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-xmark text-[10px]"></i>
                                    </div>
                                    <span>A disqualified participant may lose their score, ranking, qualification, prize, medal, certificate, or other recognition.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #fff1f2; color: #e11d48;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-xmark text-[10px]"></i>
                                    </div>
                                    <span>If a violation is discovered after results are announced, Youth Revolutionary may cancel or amend the result and withdraw an award already provided.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #fff1f2; color: #e11d48;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-xmark text-[10px]"></i>
                                    </div>
                                    <span>Serious matters involving fraud, violence, threats, or unlawful activity may also be reported to appropriate authorities where required or legally permitted.</span>
                                </li>
                            </ul>
                        </div>

                        <!-- SECTION 11 -->
                        <div id="comp-section-11" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    11
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Competition Section 11</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">Prizes, Certificates and Medals</h2>
                                </div>
                                <i class="fa-solid fa-trophy text-2xl text-emerald-300"></i>
                            </div>
                            <ul style="color: #4A6350;" class="space-y-4 leading-relaxed font-light text-sm sm:text-base">
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Prizes, certificates, medals, trophies, or other awards will be distributed according to the structure announced for the relevant competition.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Awards may be provided to winners, runners-up, selected participants, or other categories as specified.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Participation certificates may be provided where announced and may be issued in physical or digital form.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Participants are responsible for providing correct information during registration for preparation of certificates and official records.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Youth Revolutionary may verify identity, age, registration, and eligibility before distributing awards.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>A participant who is disqualified or whose result is cancelled may lose entitlement to the related prize, medal, trophy, or certificate.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>In case of a tie, the applicable tie-breaking procedure will be followed.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Where prizes are sponsored or supplied by third parties, their availability and applicable conditions may depend on the relevant sponsor or supplier.</span>
                                </li>
                            </ul>
                        </div>

                        <!-- SECTION 12 -->
                        <div id="comp-section-12" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    12
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Competition Section 12</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">Photo and Video Usage</h2>
                                </div>
                                <i class="fa-solid fa-camera-retro text-2xl text-emerald-300"></i>
                            </div>
                            <ul style="color: #4A6350;" class="space-y-4 leading-relaxed font-light text-sm sm:text-base">
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Youth Revolutionary may photograph, video record, or otherwise document competitions, auditions, performances, award ceremonies, and related activities.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Event photographs and recordings may include participants, performances, group photographs, interviews, award ceremonies, and event highlights.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Subject to applicable law and required consent, such material may be used for legitimate organizational, informational, promotional, educational, archival, and communication purposes, including on the official website, social media, posters, event reports, and promotional materials.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>For participants below 18 years of age, parent/guardian consent may be obtained where required by applicable law.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Participants must not submit or use photographs, videos, music, artwork, or other copyrighted material belonging to another person without the necessary permission or rights.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Any genuine concern regarding identifiable photographs or recordings may be submitted through the official contact channel for review.</span>
                                </li>
                            </ul>
                        </div>

                        <!-- SECTION 13 -->
                        <div id="comp-section-13" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    13
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Competition Section 13</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">Minor Participants and Guardian Consent</h2>
                                </div>
                                <i class="fa-solid fa-hands-holding-child text-2xl text-emerald-300"></i>
                            </div>
                            <ul style="color: #4A6350;" class="space-y-4 leading-relaxed font-light text-sm sm:text-base">
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Participants below 18 years of age may participate in competitions where permitted by the applicable eligibility rules.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Youth Revolutionary may require parent or legal guardian consent before registration or participation.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Parents/guardians may be required to provide their name, relationship with the participant, contact information, emergency contact details, and consent.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Parents/guardians are responsible for ensuring that the information submitted for the minor is accurate and that the participant meets the applicable eligibility requirements.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Where required, the parent/guardian must review and accept the competition rules, safety requirements, media provisions, and other applicable conditions.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>For sports or physically demanding activities, additional consent or safety declarations may be required.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Youth Revolutionary may communicate important event information to the parent/guardian using the contact details provided during registration.</span>
                                </li>
                            </ul>
                        </div>

                        <!-- SECTION 14 -->
                        <div id="comp-section-14" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    14
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Competition Section 14</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">Sports Safety</h2>
                                </div>
                                <i class="fa-solid fa-heart-pulse text-2xl text-emerald-300"></i>
                            </div>
                            <ul style="color: #4A6350;" class="space-y-4 leading-relaxed font-light text-sm sm:text-base">
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Participants must follow all safety instructions given by organizers, judges, referees, officials, volunteers, and venue authorities.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Participants should take part only when they are physically capable of safely participating in the relevant activity.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Appropriate clothing, footwear, and protective equipment must be used where required.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Participants must not engage in reckless, violent, dangerous, or intentionally harmful conduct.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Participants should immediately inform an event official if they experience injury, pain, dizziness, breathing difficulty, weakness, or another physical problem.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>In case of injury or emergency, Youth Revolutionary or its authorized representatives may arrange reasonable first aid or emergency assistance and contact a parent/guardian where applicable.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Youth Revolutionary may postpone, modify, stop, or cancel a sports activity if weather, venue conditions, equipment problems, or other circumstances create a significant safety risk.</span>
                                </li>
                            </ul>
                        </div>

                        <!-- SECTION 15 -->
                        <div id="comp-section-15" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    15
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Competition Section 15</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">Lost or Damaged Personal Belongings</h2>
                                </div>
                                <i class="fa-solid fa-box-archive text-2xl text-emerald-300"></i>
                            </div>
                            <ul style="color: #4A6350;" class="space-y-4 leading-relaxed font-light text-sm sm:text-base">
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Participants are responsible for their personal belongings, including mobile phones, wallets, money, bags, clothing, footwear, watches, jewellery, instruments, sports equipment, electronic devices, and other items.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Participants should avoid bringing unnecessary valuable or irreplaceable items to the venue.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Unless an item has been formally accepted by an authorized Youth Revolutionary representative for safekeeping, participants remain responsible for its custody.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Youth Revolutionary will not ordinarily be responsible for loss, theft, misplacement, or accidental damage to personal belongings brought to the venue.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Lost items should be reported to the organizers as soon as possible. If an item is found, Youth Revolutionary may make reasonable efforts to return it to its rightful owner.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Participants must not take, damage, hide, or use another person's belongings without permission.</span>
                                </li>
                            </ul>
                        </div>

                        <!-- SECTION 16 -->
                        <div id="comp-section-16" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    16
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Competition Section 16</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">Event Date and Venue Changes</h2>
                                </div>
                                <i class="fa-solid fa-calendar-days text-2xl text-emerald-300"></i>
                            </div>
                            <ul style="color: #4A6350;" class="space-y-4 leading-relaxed font-light text-sm sm:text-base">
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Youth Revolutionary will make reasonable efforts to conduct competitions according to the announced schedule and venue.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>However, the date, time, reporting time, venue, format, or schedule may be changed, postponed, relocated, or cancelled due to weather, natural disasters, government orders, safety concerns, venue problems, technical issues, emergencies, public health situations, or other circumstances beyond reasonable control.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Participants will be informed of significant changes through available official communication channels.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Participants are responsible for checking official Youth Revolutionary communications before attending.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>If an event is postponed, the organizers may provide a revised date or other arrangement.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Refund eligibility in case of postponement, relocation, or cancellation will be determined according to the applicable Refund/Cancellation Policy and applicable law.</span>
                                </li>
                            </ul>
                        </div>

                        <!-- SECTION 17 -->
                        <div id="comp-section-17" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    17
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Competition Section 17</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">Registration Fee and Refund Rules</h2>
                                </div>
                                <i class="fa-solid fa-receipt text-2xl text-emerald-300"></i>
                            </div>
                            <ul style="color: #4A6350;" class="space-y-4 leading-relaxed font-light text-sm sm:text-base">
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Where a registration fee applies, the amount and payment method will be displayed on the relevant registration page or official event information.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Payments must be made only through official Youth Revolutionary payment channels.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Participants should retain their payment receipt, transaction ID, or confirmation as proof of payment.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Registration fees are generally non-refundable after successful registration, unless a refund is specifically provided under the applicable policy or required by law.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Refunds may be considered in situations such as permanent event cancellation by Youth Revolutionary, verified duplicate payment, payment received without successful registration due to an organizational/technical issue, or another situation specifically approved by the organizers.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Refunds will generally not be provided for participant absence, late arrival, personal reasons, travel problems, failure to qualify in an audition, disqualification, failure to bring required materials, or withdrawal after registration, unless otherwise specified.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Approved refunds may be processed through the original payment method and may take time depending on the payment provider or bank.</span>
                                </li>
                            </ul>
                        </div>

                        <!-- SECTION 18 -->
                        <div id="comp-section-18" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    18
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Competition Section 18</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">Organizer's Rights</h2>
                                </div>
                                <i class="fa-solid fa-user-shield text-2xl text-emerald-300"></i>
                            </div>
                            <ul style="color: #4A6350;" class="space-y-4 leading-relaxed font-light text-sm sm:text-base">
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Youth Revolutionary operates as a youth-led social initiative managed by an organizing committee.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Youth Revolutionary reserves the right to take reasonable steps necessary for the safe, fair, orderly, and proper conduct of competitions.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span><strong>Authority of Organizers:</strong> The organizers may verify participant identity and eligibility; accept or reject registrations; limit participant numbers; conduct auditions or selection rounds; appoint or replace judges and officials; establish scoring and tie-breaking procedures; change schedules or venues when necessary; postpone, modify, or cancel events where reasonably required; enforce discipline and safety rules; issue penalties or disqualify participants; correct verified administrative or scoring errors; cancel results obtained through fraud or rule violations; withdraw prizes, medals, or certificates where appropriate; restrict or remove persons from the venue for safety or disciplinary reasons; take appropriate action against cheating, fraud, misconduct, or other violations.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>For matters not specifically covered by these Terms, Youth Revolutionary may make reasonable decisions necessary to maintain fairness, safety, integrity, and smooth conduct of the competition, subject to applicable law.</span>
                                </li>
                            </ul>
                        </div>

                        <!-- SECTION 19 -->
                        <div id="comp-section-19" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    19
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Competition Section 19</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">Participant's Acceptance of Rules</h2>
                                </div>
                                <i class="fa-solid fa-file-signature text-2xl text-emerald-300"></i>
                            </div>
                            <ul style="color: #4A6350;" class="space-y-4 leading-relaxed font-light text-sm sm:text-base">
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>By registering for, attending, or participating in a Youth Revolutionary competition, the participant confirms that they have read, understood, and agreed to comply with these Competition Terms & Conditions and the specific rules applicable to their competition.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Participants agree to follow all requirements relating to registration, eligibility, reporting time, venue, materials, judging, scoring, discipline, fair play, safety, prizes, and other event procedures.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Participants are responsible for understanding the rules before participating. Failure to read or understand the rules does not ordinarily exempt a participant from complying with them.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>For minor participants, acceptance may also require confirmation and consent from a parent or legal guardian.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>If a participant does not agree with these Terms, they should not complete registration or participate in the relevant competition.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Registration and participation constitute acknowledgment and acceptance of these Competition Terms & Conditions, subject to all rights and protections available under applicable law.</span>
                                </li>
                            </ul>
                        </div>

                    </main>
                </div>
            </div>

            <!-- TAB 2: WEBSITE TERMS & CONDITIONS -->
            <div x-show="activeTab === 'website'" x-transition.opacity style="display: none;">
                <!-- PREAMBLE NOTICE CARD FOR WEBSITE TERMS -->
                <div style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border mb-10 relative overflow-hidden">
                    <div style="background-color: #059669;" class="absolute top-0 left-0 w-2 h-full"></div>
                    <div class="flex items-start gap-4 sm:gap-5">
                        <div style="background-color: #ecfdf5; color: #047857;" class="w-12 h-12 rounded-2xl flex-shrink-0 flex items-center justify-center text-xl shadow-inner">
                            <i class="fa-solid fa-globe"></i>
                        </div>
                        <div>
                            <span style="color: #059669;" class="text-xs font-bold uppercase tracking-[0.2em] block mb-1">Website Terms & Conditions</span>
                            <h2 style="color: #1A3320;" class="text-xl sm:text-2xl font-serif mb-2">Access & Usage Agreement</h2>
                            <p style="color: #4A6350;" class="leading-relaxed text-sm sm:text-base font-light">
                                These Website Terms & Conditions (“Terms”) govern your access to and use of the official Youth Revolutionary website (“Website”). By accessing, browsing, registering on, or using the Website, you acknowledge that you have read, understood, and agree to comply with these Terms and all applicable laws. If you do not agree with any part of these Terms, please discontinue use of the Website.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- LAYOUT GRID FOR WEBSITE TERMS -->
                <div class="grid lg:grid-cols-12 gap-8 items-start">

                    <!-- STICKY SIDEBAR FOR WEBSITE TERMS -->
                    <aside style="background-color: #ffffff; border-color: #D8E2D5;" class="hidden lg:block lg:col-span-4 sticky top-32 rounded-[2rem] p-6 shadow-sm border max-h-[calc(100vh-9rem)] overflow-y-auto">
                        <h3 style="color: #1A3320;" class="text-sm font-extrabold uppercase tracking-wider mb-4 pb-3 border-b border-slate-100 flex items-center justify-between">
                            <span class="flex items-center gap-2">
                                <i class="fa-solid fa-list-ol text-emerald-600"></i> Website Sections
                            </span>
                            <span style="background-color: #ecfdf5; color: #047857;" class="text-[10px] font-bold px-2 py-0.5 rounded-full">12 Sections</span>
                        </h3>

                        <nav style="color: #4A6350;" class="space-y-1 text-xs font-medium">
                            <a href="#web-section-1" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">1</span>
                                <span class="truncate">Website Usage Rules</span>
                            </a>
                            <a href="#web-section-2" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">2</span>
                                <span class="truncate">User Registration & Profile</span>
                            </a>
                            <a href="#web-section-3" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">3</span>
                                <span class="truncate">Content & Copyright</span>
                            </a>
                            <a href="#web-section-4" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">4</span>
                                <span class="truncate">Media & Logo Usage</span>
                            </a>
                            <a href="#web-section-5" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">5</span>
                                <span class="truncate">External Links</span>
                            </a>
                            <a href="#web-section-6" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">6</span>
                                <span class="truncate">Availability & Technical Issues</span>
                            </a>
                            <a href="#web-section-7" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">7</span>
                                <span class="truncate">Changes to Content</span>
                            </a>
                            <a href="#web-section-8" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">8</span>
                                <span class="truncate">Privacy & Data References</span>
                            </a>
                            <a href="#web-section-9" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">9</span>
                                <span class="truncate">Prohibited Activities</span>
                            </a>
                            <a href="#web-section-10" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">10</span>
                                <span class="truncate">Terms Modification</span>
                            </a>
                            <a href="#web-section-11" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">11</span>
                                <span class="truncate">Legal & Dispute Provisions</span>
                            </a>
                            <a href="#web-section-12" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">12</span>
                                <span class="truncate">Contact Information</span>
                            </a>
                        </nav>
                    </aside>

                    <!-- WEBSITE TERMS CONTENT CARDS -->
                    <main class="lg:col-span-8 space-y-8">

                        <!-- WEB SECTION 1 -->
                        <div id="web-section-1" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    1
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Website Section 01</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">Website Usage Rules</h2>
                                </div>
                                <i class="fa-solid fa-laptop-code text-2xl text-emerald-300"></i>
                            </div>
                            <ul style="color: #4A6350;" class="space-y-4 leading-relaxed font-light text-sm sm:text-base">
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>The Youth Revolutionary Website is intended to provide information about the organization, competitions, events, registrations, announcements, activities, results, and other related services.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Users may access and use the Website only for lawful and legitimate purposes.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #fffbebf5; color: #d97706;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-triangle-exclamation text-[10px]"></i>
                                    </div>
                                    <span><strong>Prohibited Actions:</strong> Users must not use the Website for unlawful purposes; attempt unauthorized access to systems; interfere with operation or security; introduce malware or viruses; bypass security; use unauthorized scraping bots; submit false information; impersonate others; harass or harm individuals; manipulate forms or results; or copy/distribute content commercially without permission.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Users are responsible for ensuring that their use of the Website complies with applicable laws and these Terms.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Youth Revolutionary may restrict, suspend, or terminate access to Website features where reasonably necessary due to misuse, security concerns, rule violations, or other legitimate reasons.</span>
                                </li>
                            </ul>
                        </div>

                        <!-- WEB SECTION 2 -->
                        <div id="web-section-2" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    2
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Website Section 02</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">User Registration and Account Information</h2>
                                </div>
                                <i class="fa-solid fa-address-card text-2xl text-emerald-300"></i>
                            </div>
                            <ul style="color: #4A6350;" class="space-y-4 leading-relaxed font-light text-sm sm:text-base">
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Certain Website features, including competition registration, may require users to provide personal information and create an account or registration profile.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Users must provide accurate, complete, and current information during registration and must update their information when reasonably necessary.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Details required may include full name, date of birth, mobile number, email address, address, category, parent/guardian information, age verification, and payment details where applicable.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Users must keep credentials confidential and notify Youth Revolutionary immediately if unauthorized account activity is suspected.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Youth Revolutionary may verify information and cancel or restrict accounts found to contain false, fraudulent, or invalid data.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>For users below 18 years of age, registration may require parent or legal guardian consent.</span>
                                </li>
                            </ul>
                        </div>

                        <!-- WEB SECTION 3 -->
                        <div id="web-section-3" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    3
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Website Section 03</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">Website Content and Copyright</h2>
                                </div>
                                <i class="fa-solid fa-copyright text-2xl text-emerald-300"></i>
                            </div>
                            <ul style="color: #4A6350;" class="space-y-4 leading-relaxed font-light text-sm sm:text-base">
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>All Website materials—including text, photos, graphics, logos, videos, audio, layouts, software, and documents—are owned by or licensed to Youth Revolutionary.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Users may view content for personal, non-commercial informational use only.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Content may not be copied, reproduced, modified, distributed, sold, or commercially exploited without prior written authorization.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>The Youth Revolutionary name and logo must not be used to suggest unauthorized sponsorship or endorsement.</span>
                                </li>
                            </ul>
                        </div>

                        <!-- WEB SECTION 4 -->
                        <div id="web-section-4" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    4
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Website Section 04</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">Use of Photos, Videos, Logos, etc.</h2>
                                </div>
                                <i class="fa-solid fa-photo-film text-2xl text-emerald-300"></i>
                            </div>
                            <ul style="color: #4A6350;" class="space-y-4 leading-relaxed font-light text-sm sm:text-base">
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Youth Revolutionary publishes event photos, videos, and media for promotional, informational, educational, and archival purposes.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Where legally required, consent is obtained via registration forms or guardian declarations.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Genuine concerns regarding identifiable photos or media can be submitted to official contact channels for review.</span>
                                </li>
                            </ul>
                        </div>

                        <!-- WEB SECTION 5 -->
                        <div id="web-section-5" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    5
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Website Section 05</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">External / Third-Party Links</h2>
                                </div>
                                <i class="fa-solid fa-up-right-from-square text-2xl text-emerald-300"></i>
                            </div>
                            <ul style="color: #4A6350;" class="space-y-4 leading-relaxed font-light text-sm sm:text-base">
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>The Website may link to third-party services, payment portals, or social media platforms for user convenience.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Youth Revolutionary does not own or control third-party sites and is not responsible for their availability, privacy practices, or content.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Users should review separate third-party terms before sharing personal details or making payments.</span>
                                </li>
                            </ul>
                        </div>

                        <!-- WEB SECTION 6 -->
                        <div id="web-section-6" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    6
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Website Section 06</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">Website Availability & Technical Issues</h2>
                                </div>
                                <i class="fa-solid fa-server text-2xl text-emerald-300"></i>
                            </div>
                            <ul style="color: #4A6350;" class="space-y-4 leading-relaxed font-light text-sm sm:text-base">
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Reasonable efforts are made to ensure continuous operation, but uninterrupted Website availability cannot be guaranteed.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Temporary unavailability may occur due to maintenance, server upgrades, power failures, or internet interruptions.</span>
                                </li>
                            </ul>
                        </div>

                        <!-- WEB SECTION 7 -->
                        <div id="web-section-7" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    7
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Website Section 07</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">Changes to Website Content</h2>
                                </div>
                                <i class="fa-solid fa-pen-ruler text-2xl text-emerald-300"></i>
                            </div>
                            <ul style="color: #4A6350;" class="space-y-4 leading-relaxed font-light text-sm sm:text-base">
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Youth Revolutionary reserves the right to update, modify, or replace Website content, schedules, and details at any time.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Users should verify important dates, rules, and announcements periodically on the official portal.</span>
                                </li>
                            </ul>
                        </div>

                        <!-- WEB SECTION 8 -->
                        <div id="web-section-8" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    8
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Website Section 08</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">Privacy and Data-Related References</h2>
                                </div>
                                <i class="fa-solid fa-user-lock text-2xl text-emerald-300"></i>
                            </div>
                            <ul style="color: #4A6350;" class="space-y-4 leading-relaxed font-light text-sm sm:text-base">
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Personal data collected (name, DOB, phone, email, registration records) is handled in accordance with the Privacy Policy and applicable Indian laws.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Users must provide accurate personal details and refrain from submitting sensitive info through unsecured channels.</span>
                                </li>
                            </ul>
                        </div>

                        <!-- WEB SECTION 9 -->
                        <div id="web-section-9" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    9
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Website Section 09</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">Prohibited Activities</h2>
                                </div>
                                <i class="fa-solid fa-user-slash text-2xl text-emerald-300"></i>
                            </div>
                            <ul style="color: #4A6350;" class="space-y-4 leading-relaxed font-light text-sm sm:text-base">
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #fff1f2; color: #e11d48;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-xmark text-[10px]"></i>
                                    </div>
                                    <span>Hacking, introducing malware, service disruption, fraudulent registrations, impersonation, scraping data, sending spam, and violating intellectual property are strictly forbidden.</span>
                                </li>
                            </ul>
                        </div>

                        <!-- WEB SECTION 10 -->
                        <div id="web-section-10" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    10
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Website Section 10</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">Website Terms Modification</h2>
                                </div>
                                <i class="fa-solid fa-file-pen text-2xl text-emerald-300"></i>
                            </div>
                            <ul style="color: #4A6350;" class="space-y-4 leading-relaxed font-light text-sm sm:text-base">
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Terms may be updated periodically to reflect service, security, or legal changes. Continued Website use constitutes acceptance of revised terms.</span>
                                </li>
                            </ul>
                        </div>

                        <!-- WEB SECTION 11 -->
                        <div id="web-section-11" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    11
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Website Section 11</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">Legal & Dispute-Related Provisions</h2>
                                </div>
                                <i class="fa-solid fa-scale-balanced text-2xl text-emerald-300"></i>
                            </div>
                            <ul style="color: #4A6350;" class="space-y-4 leading-relaxed font-light text-sm sm:text-base">
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Disputes should be submitted for good-faith resolution first. Governed by the applicable laws of India.</span>
                                </li>
                            </ul>
                        </div>

                        <!-- WEB SECTION 12 & OFFICIAL CONTACT DETAILS -->
                        <div id="web-section-12" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    12
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Website Section 12</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">Official Contact Information & Acceptance</h2>
                                </div>
                                <i class="fa-solid fa-headset text-2xl text-emerald-300"></i>
                            </div>

                            <p style="color: #4A6350;" class="mb-6 font-light leading-relaxed">
                                For inquiries, technical issues, registration assistance, or privacy concerns, please reach out through our verified contact channels:
                            </p>

                            <!-- OFFICIAL CONTACT CARD -->
                            <div style="background-color: #F8FAF7; border-color: #D8E2D5;" class="rounded-2xl p-6 border mb-6 grid sm:grid-cols-2 gap-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center">
                                        <i class="fa-solid fa-building"></i>
                                    </div>
                                    <div>
                                        <span class="text-[10px] uppercase tracking-wider text-slate-500 font-bold block">Organization</span>
                                        <span class="text-sm font-bold text-[#1A3320]">Youth Revolutionary</span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center">
                                        <i class="fa-solid fa-globe"></i>
                                    </div>
                                    <div>
                                        <span class="text-[10px] uppercase tracking-wider text-slate-500 font-bold block">Official Website</span>
                                        <a href="https://youthrevolutionary.com" target="_blank" class="text-sm font-bold text-emerald-700 hover:underline">youthrevolutionary.com</a>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center">
                                        <i class="fa-solid fa-envelope"></i>
                                    </div>
                                    <div>
                                        <span class="text-[10px] uppercase tracking-wider text-slate-500 font-bold block">Official Email</span>
                                        <a href="mailto:youthrevolutionarynasriganj@gmail.com" class="text-xs sm:text-sm font-bold text-emerald-700 hover:underline">youthrevolutionarynasriganj@gmail.com</a>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center">
                                        <i class="fa-solid fa-phone"></i>
                                    </div>
                                    <div>
                                        <span class="text-[10px] uppercase tracking-wider text-slate-500 font-bold block">Phone Number</span>
                                        <a href="tel:+918797835549" class="text-sm font-bold text-emerald-700 hover:underline">+91 8797835549</a>
                                    </div>
                                </div>
                                <div class="sm:col-span-2 flex items-center gap-3 pt-2 border-t border-slate-200/60">
                                    <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center flex-shrink-0">
                                        <i class="fa-solid fa-location-dot"></i>
                                    </div>
                                    <div>
                                        <span class="text-[10px] uppercase tracking-wider text-slate-500 font-bold block">Address</span>
                                        <span class="text-xs sm:text-sm font-bold text-[#1A3320]">Nasriganj, Rohtas (Bihar) 821310</span>
                                    </div>
                                </div>
                            </div>

                            <div style="background-color: #ecfdf5; border-color: #a7f3d0;" class="p-4 rounded-xl border text-xs sm:text-sm text-emerald-900 font-medium">
                                <strong>Acceptance of Website Terms:</strong> By accessing, browsing, registering on, or using the Youth Revolutionary Website, you acknowledge that you have read, understood, and agreed to these Website Terms & Conditions.
                            </div>
                        </div>

                    </main>
                </div>
            </div>

            <!-- TAB 3: PRIVACY POLICY -->
            <div x-show="activeTab === 'privacy'" x-transition.opacity style="display: none;">
                <!-- PREAMBLE NOTICE CARD FOR PRIVACY POLICY -->
                <div style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border mb-10 relative overflow-hidden">
                    <div style="background-color: #059669;" class="absolute top-0 left-0 w-2 h-full"></div>
                    <div class="flex items-start gap-4 sm:gap-5">
                        <div style="background-color: #ecfdf5; color: #047857;" class="w-12 h-12 rounded-2xl flex-shrink-0 flex items-center justify-center text-xl shadow-inner">
                            <i class="fa-solid fa-user-shield"></i>
                        </div>
                        <div>
                            <span style="color: #059669;" class="text-xs font-bold uppercase tracking-[0.2em] block mb-1">Privacy & Data Safeguards</span>
                            <h2 style="color: #1A3320;" class="text-xl sm:text-2xl font-serif mb-2">Youth Revolutionary Privacy Policy</h2>
                            <p style="color: #4A6350;" class="leading-relaxed text-sm sm:text-base font-light">
                                Youth Revolutionary (“Youth Revolutionary”, “we”, “us”, or “our”) respects your privacy and is committed to protecting the personal information of participants, parents/guardians, visitors, users, volunteers, and other individuals who interact with our website and activities. This Privacy Policy explains what information we collect, why we collect it, how we use and protect it, when it may be shared, and your rights under applicable law.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- LAYOUT GRID FOR PRIVACY POLICY -->
                <div class="grid lg:grid-cols-12 gap-8 items-start">

                    <!-- STICKY SIDEBAR FOR PRIVACY POLICY -->
                    <aside style="background-color: #ffffff; border-color: #D8E2D5;" class="hidden lg:block lg:col-span-4 sticky top-32 rounded-[2rem] p-6 shadow-sm border max-h-[calc(100vh-9rem)] overflow-y-auto">
                        <h3 style="color: #1A3320;" class="text-sm font-extrabold uppercase tracking-wider mb-4 pb-3 border-b border-slate-100 flex items-center justify-between">
                            <span class="flex items-center gap-2">
                                <i class="fa-solid fa-list-ol text-emerald-600"></i> Privacy Sections
                            </span>
                            <span style="background-color: #ecfdf5; color: #047857;" class="text-[10px] font-bold px-2 py-0.5 rounded-full">17 Sections</span>
                        </h3>

                        <nav style="color: #4A6350;" class="space-y-1 text-xs font-medium">
                            <a href="#priv-section-1" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">1</span>
                                <span class="truncate">Information We Collect</span>
                            </a>
                            <a href="#priv-section-2" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">2</span>
                                <span class="truncate">How We Use Your Information</span>
                            </a>
                            <a href="#priv-section-3" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">3</span>
                                <span class="truncate">Registration & Participant Data</span>
                            </a>
                            <a href="#priv-section-4" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">4</span>
                                <span class="truncate">Children & Minor Participants</span>
                            </a>
                            <a href="#priv-section-5" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">5</span>
                                <span class="truncate">Photos, Videos & Event Media</span>
                            </a>
                            <a href="#priv-section-6" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">6</span>
                                <span class="truncate">Cookies & Analytics</span>
                            </a>
                            <a href="#priv-section-7" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">7</span>
                                <span class="truncate">Third-Party Services</span>
                            </a>
                            <a href="#priv-section-8" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">8</span>
                                <span class="truncate">Payment Information Safeguards</span>
                            </a>
                            <a href="#priv-section-9" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">9</span>
                                <span class="truncate">Sharing of Information</span>
                            </a>
                            <a href="#priv-section-10" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">10</span>
                                <span class="truncate">Data Security Measures</span>
                            </a>
                            <a href="#priv-section-11" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">11</span>
                                <span class="truncate">Data Retention Policy</span>
                            </a>
                            <a href="#priv-section-12" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">12</span>
                                <span class="truncate">User Rights & Choices</span>
                            </a>
                            <a href="#priv-section-13" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">13</span>
                                <span class="truncate">Accuracy of Information</span>
                            </a>
                            <a href="#priv-section-14" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">14</span>
                                <span class="truncate">External Links Disclaimer</span>
                            </a>
                            <a href="#priv-section-15" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">15</span>
                                <span class="truncate">Policy Modifications</span>
                            </a>
                            <a href="#priv-section-16" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">16</span>
                                <span class="truncate">Identity & Privacy Contacts</span>
                            </a>
                            <a href="#priv-section-17" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">17</span>
                                <span class="truncate">Acceptance of Privacy Policy</span>
                            </a>
                        </nav>
                    </aside>

                    <!-- PRIVACY POLICY CONTENT CARDS -->
                    <main class="lg:col-span-8 space-y-8">

                        <!-- PRIV SECTION 1 -->
                        <div id="priv-section-1" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    1
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Privacy Section 01</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">Information We Collect</h2>
                                </div>
                                <i class="fa-solid fa-folder-open text-2xl text-emerald-300"></i>
                            </div>
                            
                            <div class="space-y-6">
                                <div>
                                    <h4 class="font-bold text-sm text-[#1A3320] mb-2 uppercase tracking-wide">Personal Information</h4>
                                    <p style="color: #4A6350;" class="text-sm leading-relaxed mb-3">When registering for competitions or contacting us, we may collect:</p>
                                    <ul style="color: #4A6350;" class="grid sm:grid-cols-2 gap-2 text-xs font-medium">
                                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-600"></i> Full Name</li>
                                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-600"></i> Date of birth / Age</li>
                                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-600"></i> Gender (for eligibility)</li>
                                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-600"></i> Mobile Number</li>
                                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-600"></i> Email Address</li>
                                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-600"></i> Address / Location</li>
                                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-600"></i> School / Institution</li>
                                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-600"></i> Category Info</li>
                                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-600"></i> Parent / Guardian Contact</li>
                                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-600"></i> Emergency Contact</li>
                                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-600"></i> Self-declared ID/Verification</li>
                                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-600"></i> Payment Details</li>
                                    </ul>
                                </div>

                                <div class="pt-4 border-t border-slate-100">
                                    <h4 class="font-bold text-sm text-[#1A3320] mb-2 uppercase tracking-wide">Competition, Media & Technical Data</h4>
                                    <p style="color: #4A6350;" class="text-sm leading-relaxed">
                                        We collect attendance, scores, rankings, photos, videos, event recordings, IP address, browser/device info, and site diagnostics to manage events and safeguard platform performance.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- PRIV SECTION 2 -->
                        <div id="priv-section-2" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    2
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Privacy Section 02</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">How We Use Your Information</h2>
                                </div>
                                <i class="fa-solid fa-sliders text-2xl text-emerald-300"></i>
                            </div>
                            <ul style="color: #4A6350;" class="space-y-4 leading-relaxed font-light text-sm sm:text-base">
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Processing registrations, verifying eligibility, managing auditions, selection rounds, scores, rankings, and certificates.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Communicating event dates, venues, instructions, and processing payments or eligible refunds.</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <div style="background-color: #ecfdf5; color: #059669;" class="mt-1 flex-none w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span>Publishing results, event highlights, and maintaining platform security against fraud or cheating.</span>
                                </li>
                            </ul>
                        </div>

                        <!-- PRIV SECTION 3 -->
                        <div id="priv-section-3" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    3
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Privacy Section 03</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">Competition Registration and Participant Data</h2>
                                </div>
                                <i class="fa-solid fa-id-card-clip text-2xl text-emerald-300"></i>
                            </div>
                            <p style="color: #4A6350;" class="leading-relaxed font-light text-sm sm:text-base">
                                Competition registration requires accurate information necessary to determine eligibility, conduct events, communicate with participants, and issue valid certificates. Providing false information may result in cancellation of participation.
                            </p>
                        </div>

                        <!-- PRIV SECTION 4 -->
                        <div id="priv-section-4" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    4
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Privacy Section 04</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">Children and Minor Participants</h2>
                                </div>
                                <i class="fa-solid fa-child text-2xl text-emerald-300"></i>
                            </div>
                            <p style="color: #4A6350;" class="leading-relaxed font-light text-sm sm:text-base">
                                For participants under 18 years of age, parent or legal guardian consent is obtained before collecting or publishing personal info and media. Parents/guardians are encouraged to review these provisions and contact us with any questions.
                            </p>
                        </div>

                        <!-- PRIV SECTION 5 -->
                        <div id="priv-section-5" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    5
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Privacy Section 05</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">Photos, Videos and Event Media</h2>
                                </div>
                                <i class="fa-solid fa-camera text-2xl text-emerald-300"></i>
                            </div>
                            <p style="color: #4A6350;" class="leading-relaxed font-light text-sm sm:text-base">
                                Event photographs and recordings may be published on our Website, social media, and event reports. Participants or guardians with genuine concerns regarding an identifiable photo may contact us for review and feasible removal.
                            </p>
                        </div>

                        <!-- PRIV SECTION 6 -->
                        <div id="priv-section-6" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    6
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Privacy Section 06</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">Cookies and Similar Technologies</h2>
                                </div>
                                <i class="fa-solid fa-cookie-bite text-2xl text-emerald-300"></i>
                            </div>
                            <p style="color: #4A6350;" class="leading-relaxed font-light text-sm sm:text-base">
                                We use essential cookies to maintain security, session state, preferences, and site analytics. Users may manage cookie settings through their web browser.
                            </p>
                        </div>

                        <!-- PRIV SECTION 7 -->
                        <div id="priv-section-7" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    7
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Privacy Section 07</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">Third-Party Services</h2>
                                </div>
                                <i class="fa-solid fa-handshake-angle text-2xl text-emerald-300"></i>
                            </div>
                            <p style="color: #4A6350;" class="leading-relaxed font-light text-sm sm:text-base">
                                We utilize trusted third-party providers for hosting, payment processing, form submissions, analytics, SMS/email alerts, and cloud storage under their respective privacy policies.
                            </p>
                        </div>

                        <!-- PRIV SECTION 8 -->
                        <div id="priv-section-8" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    8
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Privacy Section 08</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">Payment Information Security</h2>
                                </div>
                                <i class="fa-solid fa-shield-cat text-2xl text-emerald-300"></i>
                            </div>
                            <div style="background-color: #ecfdf5; border-color: #a7f3d0;" class="p-4 rounded-xl border text-xs sm:text-sm text-emerald-900 font-medium">
                                <strong>Strict Payment Policy:</strong> Payments are processed via encrypted payment gateways. Youth Revolutionary receives only transaction references (Status, Transaction ID, Amount) and <strong>never stores sensitive card details, UPI PINs, or banking passwords</strong>. We will never ask for confidential PINs or OTPs.
                            </div>
                        </div>

                        <!-- PRIV SECTION 9 -->
                        <div id="priv-section-9" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    9
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Privacy Section 09</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">Sharing of Information</h2>
                                </div>
                                <i class="fa-solid fa-share-nodes text-2xl text-emerald-300"></i>
                            </div>
                            <p style="color: #4A6350;" class="leading-relaxed font-light text-sm sm:text-base">
                                Personal data is shared strictly on a need-to-know basis with authorized coordinators, judges, service providers, or legal authorities. <strong>We NEVER sell participant personal information to third parties for commercial marketing purposes.</strong>
                            </p>
                        </div>

                        <!-- PRIV SECTION 10 -->
                        <div id="priv-section-10" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    10
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Privacy Section 10</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">Data Security</h2>
                                </div>
                                <i class="fa-solid fa-lock text-2xl text-emerald-300"></i>
                            </div>
                            <p style="color: #4A6350;" class="leading-relaxed font-light text-sm sm:text-base">
                                We implement administrative, technical, and physical safeguards to protect personal records. Users should maintain secure devices and report any suspected unauthorized access immediately.
                            </p>
                        </div>

                        <!-- PRIV SECTION 11 -->
                        <div id="priv-section-11" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    11
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Privacy Section 11</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">Data Retention</h2>
                                </div>
                                <i class="fa-solid fa-clock-rotate-left text-2xl text-emerald-300"></i>
                            </div>
                            <p style="color: #4A6350;" class="leading-relaxed font-light text-sm sm:text-base">
                                Personal data is retained only as long as necessary to fulfill event verification, certificate distribution, legal compliance, and organizational auditing, after which it is deleted or anonymized.
                            </p>
                        </div>

                        <!-- PRIV SECTION 12 -->
                        <div id="priv-section-12" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    12
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Privacy Section 12</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">User Rights and Choices</h2>
                                </div>
                                <i class="fa-solid fa-user-gear text-2xl text-emerald-300"></i>
                            </div>
                            <p style="color: #4A6350;" class="leading-relaxed font-light text-sm sm:text-base">
                                Subject to applicable law, users or authorized guardians may request access to personal records, correction of inaccuracies, or deletion/withdrawal of consent where applicable.
                            </p>
                        </div>

                        <!-- PRIV SECTION 13 -->
                        <div id="priv-section-13" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    13
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Privacy Section 13</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">Accuracy of Information</h2>
                                </div>
                                <i class="fa-solid fa-square-check text-2xl text-emerald-300"></i>
                            </div>
                            <p style="color: #4A6350;" class="leading-relaxed font-light text-sm sm:text-base">
                                Users are responsible for providing complete and accurate information. Incorrect details may lead to certificate errors, missed event alerts, or disqualification.
                            </p>
                        </div>

                        <!-- PRIV SECTION 14 -->
                        <div id="priv-section-14" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    14
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Privacy Section 14</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">External Links</h2>
                                </div>
                                <i class="fa-solid fa-link text-2xl text-emerald-300"></i>
                            </div>
                            <p style="color: #4A6350;" class="leading-relaxed font-light text-sm sm:text-base">
                                This Privacy Policy applies strictly to Youth Revolutionary services. External third-party sites linked from our portal are governed by their respective privacy statements.
                            </p>
                        </div>

                        <!-- PRIV SECTION 15 -->
                        <div id="priv-section-15" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    15
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Privacy Section 15</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">Changes to This Privacy Policy</h2>
                                </div>
                                <i class="fa-solid fa-arrows-rotate text-2xl text-emerald-300"></i>
                            </div>
                            <p style="color: #4A6350;" class="leading-relaxed font-light text-sm sm:text-base">
                                We reserve the right to update this policy to reflect operational or legal changes. Revised terms will be published on this page with an updated "Last Updated" date.
                            </p>
                        </div>

                        <!-- PRIV SECTION 16 & 17: CONTACT DETAILS & ACCEPTANCE -->
                        <div id="priv-section-16" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    16
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Privacy Section 16 & 17</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">Privacy Contact & Acceptance</h2>
                                </div>
                                <i class="fa-solid fa-file-contract text-2xl text-emerald-300"></i>
                            </div>

                            <p style="color: #4A6350;" class="mb-6 font-light leading-relaxed">
                                For any privacy requests, data correction queries, or complaints, please contact our privacy coordinator with your name, application ID, and issue details:
                            </p>

                            <!-- OFFICIAL PRIVACY CONTACT CARD -->
                            <div style="background-color: #F8FAF7; border-color: #D8E2D5;" class="rounded-2xl p-6 border mb-6 grid sm:grid-cols-2 gap-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center">
                                        <i class="fa-solid fa-building"></i>
                                    </div>
                                    <div>
                                        <span class="text-[10px] uppercase tracking-wider text-slate-500 font-bold block">Organization</span>
                                        <span class="text-sm font-bold text-[#1A3320]">Youth Revolutionary</span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center">
                                        <i class="fa-solid fa-globe"></i>
                                    </div>
                                    <div>
                                        <span class="text-[10px] uppercase tracking-wider text-slate-500 font-bold block">Official Website</span>
                                        <a href="https://youthrevolutionary.com" target="_blank" class="text-sm font-bold text-emerald-700 hover:underline">youthrevolutionary.com</a>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center">
                                        <i class="fa-solid fa-envelope"></i>
                                    </div>
                                    <div>
                                        <span class="text-[10px] uppercase tracking-wider text-slate-500 font-bold block">Official Email</span>
                                        <a href="mailto:youthrevolutionarynasriganj@gmail.com" class="text-xs sm:text-sm font-bold text-emerald-700 hover:underline">youthrevolutionarynasriganj@gmail.com</a>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center">
                                        <i class="fa-solid fa-phone"></i>
                                    </div>
                                    <div>
                                        <span class="text-[10px] uppercase tracking-wider text-slate-500 font-bold block">Phone Number</span>
                                        <a href="tel:+918797835549" class="text-sm font-bold text-emerald-700 hover:underline">+91 8797835549</a>
                                    </div>
                                </div>
                                <div class="sm:col-span-2 flex items-center gap-3 pt-2 border-t border-slate-200/60">
                                    <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center flex-shrink-0">
                                        <i class="fa-solid fa-location-dot"></i>
                                    </div>
                                    <div>
                                        <span class="text-[10px] uppercase tracking-wider text-slate-500 font-bold block">Address</span>
                                        <span class="text-xs sm:text-sm font-bold text-[#1A3320]">Nasriganj, Rohtas (Bihar) 821310</span>
                                    </div>
                                </div>
                            </div>

                            <div style="background-color: #ecfdf5; border-color: #a7f3d0;" class="p-4 rounded-xl border text-xs sm:text-sm text-emerald-900 font-medium">
                                <strong>Acceptance of This Privacy Policy:</strong> By using the Youth Revolutionary Website or submitting your information for any activity, you acknowledge that you have read and understood these privacy practices.
                            </div>
                        </div>

                    </main>
                </div>
            </div>

            <!-- TAB 4: REFUND & CANCELLATION POLICY -->
            <div x-show="activeTab === 'refund'" x-transition.opacity style="display: none;">
                <!-- PREAMBLE NOTICE CARD FOR REFUND POLICY -->
                <div style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border mb-10 relative overflow-hidden">
                    <div style="background-color: #059669;" class="absolute top-0 left-0 w-2 h-full"></div>
                    <div class="flex items-start gap-4 sm:gap-5">
                        <div style="background-color: #ecfdf5; color: #047857;" class="w-12 h-12 rounded-2xl flex-shrink-0 flex items-center justify-center text-xl shadow-inner">
                            <i class="fa-solid fa-receipt"></i>
                        </div>
                        <div>
                            <span style="color: #059669;" class="text-xs font-bold uppercase tracking-[0.2em] block mb-1">Financial Terms & Refund Rules</span>
                            <h2 style="color: #1A3320;" class="text-xl sm:text-2xl font-serif mb-2">Youth Revolutionary Refund & Cancellation Policy</h2>
                            <p style="color: #4A6350;" class="leading-relaxed text-sm sm:text-base font-light">
                                This Refund & Cancellation Policy applies to all registration fees, participation fees, application fees, audition fees, event fees, and other payments made for competitions, events, auditions, activities, and programs organized by <strong>Youth Revolutionary</strong> (“Youth Revolutionary”, “we”, “us”, or “our”). By completing a registration or making a payment, the participant confirms that they have read, understood, and accepted this policy.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- LAYOUT GRID FOR REFUND POLICY -->
                <div class="grid lg:grid-cols-12 gap-8 items-start">

                    <!-- STICKY SIDEBAR FOR REFUND POLICY -->
                    <aside style="background-color: #ffffff; border-color: #D8E2D5;" class="hidden lg:block lg:col-span-4 sticky top-32 rounded-[2rem] p-6 shadow-sm border max-h-[calc(100vh-9rem)] overflow-y-auto">
                        <h3 style="color: #1A3320;" class="text-sm font-extrabold uppercase tracking-wider mb-4 pb-3 border-b border-slate-100 flex items-center justify-between">
                            <span class="flex items-center gap-2">
                                <i class="fa-solid fa-list-ol text-emerald-600"></i> Refund Sections
                            </span>
                            <span style="background-color: #ecfdf5; color: #047857;" class="text-[10px] font-bold px-2 py-0.5 rounded-full">16 Sections</span>
                        </h3>

                        <nav style="color: #4A6350;" class="space-y-1 text-xs font-medium">
                            <a href="#ref-section-1" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">1</span>
                                <span class="truncate">Strict No-Refund Policy</span>
                            </a>
                            <a href="#ref-section-2" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">2</span>
                                <span class="truncate">Participant Cancellation</span>
                            </a>
                            <a href="#ref-section-3" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">3</span>
                                <span class="truncate">Absence & Late Arrival</span>
                            </a>
                            <a href="#ref-section-4" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">4</span>
                                <span class="truncate">Failure to Qualify</span>
                            </a>
                            <a href="#ref-section-5" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">5</span>
                                <span class="truncate">Disqualification Impact</span>
                            </a>
                            <a href="#ref-section-6" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">6</span>
                                <span class="truncate">Date/Venue Rescheduling</span>
                            </a>
                            <a href="#ref-section-7" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">7</span>
                                <span class="truncate">Event Cancellation Provisions</span>
                            </a>
                            <a href="#ref-section-8" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">8</span>
                                <span class="truncate">Duplicate/Accidental Payments</span>
                            </a>
                            <a href="#ref-section-9" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">9</span>
                                <span class="truncate">Failed Transactions</span>
                            </a>
                            <a href="#ref-section-10" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">10</span>
                                <span class="truncate">Gateway & Bank Charges</span>
                            </a>
                            <a href="#ref-section-11" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">11</span>
                                <span class="truncate">Non-Transferability</span>
                            </a>
                            <a href="#ref-section-12" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">12</span>
                                <span class="truncate">Personal Expense Exclusion</span>
                            </a>
                            <a href="#ref-section-13" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">13</span>
                                <span class="truncate">Awards & Placements</span>
                            </a>
                            <a href="#ref-section-14" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">14</span>
                                <span class="truncate">Refund Request Processing</span>
                            </a>
                            <a href="#ref-section-15" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">15</span>
                                <span class="truncate">Organizational Structure</span>
                            </a>
                            <a href="#ref-section-16" class="flex items-center gap-2.5 p-2 rounded-xl hover:text-emerald-700 hover:bg-emerald-50 transition">
                                <span style="background-color: #d1fae5; color: #065f46;" class="w-5 h-5 rounded-md flex items-center justify-center text-[10px] font-bold">16</span>
                                <span class="truncate">Official Payment Contacts</span>
                            </a>
                        </nav>
                    </aside>

                    <!-- REFUND POLICY CONTENT CARDS -->
                    <main class="lg:col-span-8 space-y-8">

                        <!-- REF SECTION 1 -->
                        <div id="ref-section-1" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    1
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Refund Section 01</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">Strict No-Refund Policy</h2>
                                </div>
                                <i class="fa-solid fa-ban font-bold text-2xl text-emerald-300"></i>
                            </div>
                            <p style="color: #4A6350;" class="leading-relaxed font-light text-sm sm:text-base mb-4">
                                All registration and participation fees paid to Youth Revolutionary are strictly non-refundable after successful payment. Once completed, amounts cannot be returned, transferred, adjusted, or credited to another competition or participant.
                            </p>
                            <div style="background-color: #F8FAF7; border-color: #D8E2D5;" class="p-4 rounded-xl border text-xs sm:text-sm text-slate-700 font-medium">
                                <strong>Verification Before Payment:</strong> Please carefully verify Participant Name, Category, Age Eligibility, Event Date/Venue, and Registration Fee before completing payment.
                            </div>
                        </div>

                        <!-- REF SECTION 2 -->
                        <div id="ref-section-2" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    2
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Refund Section 02</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">Participant Cancellation or Withdrawal</h2>
                                </div>
                                <i class="fa-solid fa-user-xmark text-2xl text-emerald-300"></i>
                            </div>
                            <p style="color: #4A6350;" class="leading-relaxed font-light text-sm sm:text-base">
                                No refund will be provided if a participant chooses not to take part due to personal reasons, travel difficulties, academic/work commitments, lack of preparation, illness, or family circumstances.
                            </p>
                        </div>

                        <!-- REF SECTION 3 -->
                        <div id="ref-section-3" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    3
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Refund Section 03</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">Absence and Late Arrival</h2>
                                </div>
                                <i class="fa-solid fa-clock-rotate-left text-2xl text-emerald-300"></i>
                            </div>
                            <p style="color: #4A6350;" class="leading-relaxed font-light text-sm sm:text-base">
                                No refund is provided for non-attendance, arriving after specified reporting times, or leaving the venue early before completing competition rounds.
                            </p>
                        </div>

                        <!-- REF SECTION 4 -->
                        <div id="ref-section-4" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    4
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Refund Section 04</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">Failure to Qualify or Selection</h2>
                                </div>
                                <i class="fa-solid fa-square-xmark text-2xl text-emerald-300"></i>
                            </div>
                            <p style="color: #4A6350;" class="leading-relaxed font-light text-sm sm:text-base">
                                Payment covers evaluation in auditions or preliminary rounds and does not guarantee qualification or placement. No refunds are issued for non-qualification.
                            </p>
                        </div>

                        <!-- REF SECTION 5 -->
                        <div id="ref-section-5" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    5
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Refund Section 05</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">Disqualification</h2>
                                </div>
                                <i class="fa-solid fa-gavel text-2xl text-emerald-300"></i>
                            </div>
                            <p style="color: #4A6350;" class="leading-relaxed font-light text-sm sm:text-base">
                                Disqualification resulting from cheating, false age declarations, impersonation, prohibited gear, or misconduct renders registration fees strictly non-refundable.
                            </p>
                        </div>

                        <!-- REF SECTION 6 & 7 -->
                        <div id="ref-section-6" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    6
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Refund Section 06 & 07</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">Date/Venue Rescheduling & Event Cancellation</h2>
                                </div>
                                <i class="fa-solid fa-calendar-xmark text-2xl text-emerald-300"></i>
                            </div>
                            <p style="color: #4A6350;" class="leading-relaxed font-light text-sm sm:text-base">
                                In case of date, time, or venue changes due to weather or administrative reasons, registrations remain valid for the rescheduled event. If an event is permanently cancelled, alternative participation options will be offered. Fees remain non-refundable except where mandated by law.
                            </p>
                        </div>

                        <!-- REF SECTION 8 & 9 -->
                        <div id="ref-section-8" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    8
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Refund Section 08 & 09</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">Duplicate, Failed or Accidental Payments</h2>
                                </div>
                                <i class="fa-solid fa-clone text-2xl text-emerald-300"></i>
                            </div>
                            <p style="color: #4A6350;" class="leading-relaxed font-light text-sm sm:text-base mb-4">
                                Verified technical duplicate payments can be submitted with Tx ID, Name, Mobile, Email, and Receipt screenshot for payment gateway verification and resolution. Failed transactions are automatically credited back by bank networks according to standard gateway timelines.
                            </p>
                        </div>

                        <!-- REF SECTION 10, 11, 12, 13 -->
                        <div id="ref-section-10" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    10
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Refund Section 10 - 13</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">Charges, Transferability & Personal Expenses</h2>
                                </div>
                                <i class="fa-solid fa-coins text-2xl text-emerald-300"></i>
                            </div>
                            <ul style="color: #4A6350;" class="space-y-3 leading-relaxed font-light text-sm sm:text-base">
                                <li class="flex items-start gap-3">
                                    <i class="fa-solid fa-check text-emerald-600 mt-1"></i>
                                    <span>Third-party payment gateway convenience charges or banking fees are non-refundable.</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <i class="fa-solid fa-check text-emerald-600 mt-1"></i>
                                    <span>Registrations are non-transferable and slot swapping is strictly prohibited.</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <i class="fa-solid fa-check text-emerald-600 mt-1"></i>
                                    <span>Youth Revolutionary does not reimburse personal travel, accommodation, food, costume, or instrument expenses.</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <i class="fa-solid fa-check text-emerald-600 mt-1"></i>
                                    <span>Non-receipt of an award or placement does not create entitlement to a refund.</span>
                                </li>
                            </ul>
                        </div>

                        <!-- REF SECTION 14, 15, 16: CONTACT & PROCEDURE -->
                        <div id="ref-section-14" style="background-color: #ffffff; border-color: #D8E2D5;" class="rounded-[2rem] p-6 sm:p-8 shadow-sm border hover:shadow-xl transition duration-300">
                            <div class="flex items-center gap-4 mb-6">
                                <div style="background-color: #ecfdf5; color: #047857; border-color: #d1fae5;" class="w-10 h-10 rounded-2xl font-serif text-lg font-bold flex items-center justify-center shadow-sm border">
                                    14
                                </div>
                                <div class="flex-1">
                                    <span style="color: #059669;" class="text-[10px] font-bold tracking-[0.2em] uppercase block">Refund Section 14 - 16</span>
                                    <h2 style="color: #1A3320;" class="text-2xl font-serif">Refund Request Procedure & Verified Contacts</h2>
                                </div>
                                <i class="fa-solid fa-[#F1400C] fa-headset text-2xl text-emerald-300"></i>
                            </div>

                            <p style="color: #4A6350;" class="mb-6 font-light leading-relaxed">
                                Legitimate duplicate transaction claims should be sent with full transaction proof (Tx ID, Application ID, Receipt) to our official contact team:
                            </p>

                            <!-- OFFICIAL REFUND CONTACT CARD -->
                            <div style="background-color: #F8FAF7; border-color: #D8E2D5;" class="rounded-2xl p-6 border mb-6 grid sm:grid-cols-2 gap-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center">
                                        <i class="fa-solid fa-building"></i>
                                    </div>
                                    <div>
                                        <span class="text-[10px] uppercase tracking-wider text-slate-500 font-bold block">Organization</span>
                                        <span class="text-sm font-bold text-[#1A3320]">Youth Revolutionary</span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center">
                                        <i class="fa-solid fa-globe"></i>
                                    </div>
                                    <div>
                                        <span class="text-[10px] uppercase tracking-wider text-slate-500 font-bold block">Official Website</span>
                                        <a href="https://youthrevolutionary.com" target="_blank" class="text-sm font-bold text-emerald-700 hover:underline">youthrevolutionary.com</a>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center">
                                        <i class="fa-solid fa-envelope"></i>
                                    </div>
                                    <div>
                                        <span class="text-[10px] uppercase tracking-wider text-slate-500 font-bold block">Official Email</span>
                                        <a href="mailto:youthrevolutionarynasriganj@gmail.com" class="text-xs sm:text-sm font-bold text-emerald-700 hover:underline">youthrevolutionarynasriganj@gmail.com</a>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center">
                                        <i class="fa-solid fa-phone"></i>
                                    </div>
                                    <div>
                                        <span class="text-[10px] uppercase tracking-wider text-slate-500 font-bold block">Phone Number</span>
                                        <a href="tel:+918797835549" class="text-sm font-bold text-emerald-700 hover:underline">+91 8797835549</a>
                                    </div>
                                </div>
                                <div class="sm:col-span-2 flex items-center gap-3 pt-2 border-t border-slate-200/60">
                                    <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center flex-shrink-0">
                                        <i class="fa-solid fa-location-dot"></i>
                                    </div>
                                    <div>
                                        <span class="text-[10px] uppercase tracking-wider text-slate-500 font-bold block">Address</span>
                                        <span class="text-xs sm:text-sm font-bold text-[#1A3320]">Nasriganj, Rohtas (Bihar) 821310</span>
                                    </div>
                                </div>
                            </div>

                            <div style="background-color: #ecfdf5; border-color: #a7f3d0;" class="p-4 rounded-xl border text-xs sm:text-sm text-emerald-900 font-medium">
                                <strong>Caution:</strong> Payments should only be made through the official Youth Revolutionary website or verified channels. We are not responsible for payments made to unauthorized individuals or third-party accounts.
                            </div>
                        </div>

                    </main>
                </div>
            </div>

            <!-- CTA STRIP (Matching D:\yoga CTAStrip style) -->
            <section style="background-color: #0D1A10; color: #ffffff;" class="py-20 px-6 text-center relative overflow-hidden rounded-[2.5rem] mt-16 shadow-2xl">
                <!-- Background Pulse Glow -->
                <div style="background-color: rgba(16, 185, 129, 0.15);" class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] rounded-full blur-[100px] pointer-events-none"></div>

                <div class="relative z-10 max-w-3xl mx-auto">
                    <!-- Pill Badge -->
                    <div style="background-color: rgba(16, 185, 129, 0.15); border-color: rgba(52, 211, 153, 0.3); color: #6ee7b7;" class="inline-flex items-center gap-3 px-4 py-1.5 rounded-full border backdrop-blur-md mb-6">
                        <i class="fa-solid fa-sparkles text-emerald-400 text-xs"></i>
                        <span class="text-[10px] font-bold tracking-[0.2em] uppercase">Ready to Compete?</span>
                    </div>

                    <h2 style="color: #ffffff;" class="text-3xl sm:text-5xl font-serif mb-6 leading-tight">
                        Begin Your Journey <br />
                        <span style="color: #34d399;" class="italic text-2xl sm:text-4xl">With Youth Revolutionary</span>
                    </h2>
                    
                    <p style="color: #d1fae5;" class="text-sm sm:text-base mb-8 font-light max-w-xl mx-auto leading-relaxed opacity-80">
                        Explore upcoming educational, sports, and cultural competitions, or get in touch with our event coordinators.
                    </p>

                    <div class="flex flex-wrap items-center justify-center gap-4">
                        <a href="{{ url('/register') }}" style="background-color: #10b981; color: #0D1A10;" class="px-8 py-4 rounded-full font-bold uppercase tracking-wider text-xs shadow-xl transition-transform duration-300 hover:scale-105 inline-flex items-center gap-2">
                            Register Now <i class="fa-solid fa-arrow-right text-xs"></i>
                        </a>
                        <a href="{{ url('/contact') }}" style="background-color: rgba(255, 255, 255, 0.1); border-color: rgba(255, 255, 255, 0.2); color: #ffffff;" class="px-8 py-4 rounded-full border font-bold uppercase tracking-wider text-xs transition duration-300 inline-flex items-center gap-2">
                            Contact Us <i class="fa-solid fa-envelope text-xs"></i>
                        </a>
                    </div>
                </div>
            </section>

        </div>
    </div>
</x-app-layout>
