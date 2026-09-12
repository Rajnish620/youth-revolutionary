<x-app-layout>
    <div class="pt-28 pb-16 min-h-screen bg-gradient-to-b from-slate-50 via-white to-gray-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 space-y-12">
            
            <!-- Page Header -->
            <div class="text-center space-y-3 max-w-2xl mx-auto">
                <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full bg-purple-100 text-[#340C6F] font-extrabold text-xs uppercase tracking-wider">
                    <i class="fa-solid fa-award text-amber-500"></i> Examination Results Portal
                </span>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-gray-900 tracking-tight">
                    Check <span class="text-[#340C6F]">Result</span> & Download <span class="text-[#F1400C]">Certificate</span>
                </h1>
                <p class="text-sm sm:text-base text-gray-600">
                    Enter your Registration Number or Roll Number to check your competition marks, rank, and download your official Marksheet & Certificate.
                </p>
            </div>

            <!-- Search Card -->
            <div class="max-w-2xl mx-auto bg-white rounded-3xl p-6 sm:p-8 shadow-xl border border-gray-100">
                <form method="GET" action="{{ route('results.index') }}" class="space-y-4">
                    
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                            Roll Number or Registration No. <span class="text-[#F1400C]">*</span>
                        </label>
                        <div class="relative">
                            <i class="fa-solid fa-id-card absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <input type="text" name="query_string" value="{{ request('query_string') }}" required
                                placeholder="e.g. YR20261001 or YRREG0001"
                                class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl pl-11 pr-4 py-3.5 text-sm font-bold text-gray-900 focus:bg-white focus:border-[#340C6F] outline-none transition-all">
                        </div>
                        <p class="text-[11px] text-gray-400 mt-1.5">As printed on your Admit Card or registration receipt.</p>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                            Date of Birth (Optional Verification)
                        </label>
                        <div class="relative">
                            <i class="fa-solid fa-calendar-days absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <input type="date" name="dob" value="{{ request('dob') }}"
                                class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl pl-11 pr-4 py-3 text-sm font-semibold text-gray-800 focus:bg-white focus:border-[#340C6F] outline-none transition-all">
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-[#340C6F] to-purple-900 hover:from-purple-950 hover:to-[#340C6F] text-white py-4 rounded-2xl font-black text-sm uppercase tracking-wider shadow-lg shadow-purple-900/25 transition-all flex items-center justify-center gap-2 cursor-pointer">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <span>Search My Result</span>
                    </button>
                </form>

                @if(!empty($errorMessage))
                    <div class="mt-6 p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-700 text-xs sm:text-sm font-semibold flex items-center gap-3">
                        <i class="fa-solid fa-circle-exclamation text-lg shrink-0 text-rose-500"></i>
                        <div>{{ $errorMessage }}</div>
                    </div>
                @endif
            </div>

            <!-- Search Result Section (When Student Found) -->
            @if(!empty($searchedStudent))
                <div class="max-w-4xl mx-auto bg-white rounded-3xl p-6 sm:p-10 shadow-xl border border-gray-200 space-y-8 animate-fade-in">
                    
                    <!-- Candidate Banner & Profile -->
                    <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6 border-b border-gray-100 pb-8">
                        
                        <!-- Photo -->
                        <div class="w-28 h-32 rounded-2xl border-2 border-[#340C6F]/20 overflow-hidden bg-gray-100 shrink-0 shadow-md flex items-center justify-center">
                            @if($searchedStudent->photo && file_exists(public_path($searchedStudent->photo)))
                                <img src="{{ asset($searchedStudent->photo) }}" class="w-full h-full object-cover" alt="{{ $searchedStudent->student_name }}">
                            @else
                                <i class="fa-solid fa-user-graduate text-3xl text-gray-400"></i>
                            @endif
                        </div>

                        <!-- Info -->
                        <div class="flex-1 text-center sm:text-left space-y-2">
                            <div class="flex flex-wrap items-center justify-center sm:justify-start gap-2">
                                <span class="px-2.5 py-0.5 rounded-full bg-purple-100 text-[#340C6F] text-[11px] font-black font-mono">
                                    Roll: {{ $searchedStudent->roll_no }}
                                </span>
                                <span class="px-2.5 py-0.5 rounded-full bg-gray-100 text-gray-700 text-[11px] font-bold font-mono">
                                    Reg: {{ $searchedStudent->registration_no ?? 'N/A' }}
                                </span>
                                @if($searchedStudent->event)
                                    <span class="px-2.5 py-0.5 rounded-full bg-orange-100 text-[#F1400C] text-[11px] font-bold">
                                        {{ $searchedStudent->event->category ?? 'Event' }}
                                    </span>
                                @endif
                            </div>

                            <h2 class="text-2xl sm:text-3xl font-black text-gray-900 uppercase">
                                {{ $searchedStudent->student_name }}
                            </h2>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-1 text-xs text-gray-600">
                                <div><span class="font-bold text-gray-400">Father's Name:</span> {{ $searchedStudent->father_name ?? 'N/A' }}</div>
                                <div><span class="font-bold text-gray-400">Class & Tier:</span> {{ $searchedStudent->student_class }} ({{ $searchedStudent->group->group_name ?? 'General' }})</div>
                                <div><span class="font-bold text-gray-400">School/Institute:</span> {{ $searchedStudent->school_name ?? 'N/A' }}</div>
                                <div><span class="font-bold text-gray-400">Competition:</span> <strong class="text-[#340C6F]">{{ $searchedStudent->event->title ?? 'N/A' }}</strong></div>
                            </div>
                        </div>

                    </div>

                    <!-- Result Status & Action Cards -->
                    @php
                        $event = $searchedStudent->event;
                        $hasMarksPublished = $event && $event->show_marks && $searchedStudent->marks !== null;
                        $hasCertPublished = $event && $event->show_certificate && $searchedStudent->certificate_enabled;
                    @endphp

                    <!-- Situation A: Both or Either is Published -->
                    @if($hasMarksPublished || $hasCertPublished)
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            <!-- Marksheet Card -->
                            @if($hasMarksPublished)
                                <div class="bg-purple-50/50 border border-purple-200 rounded-2xl p-6 flex flex-col justify-between space-y-4">
                                    <div class="space-y-3">
                                        <div class="flex items-center justify-between">
                                            <span class="text-xs font-black uppercase tracking-wider text-[#340C6F] flex items-center gap-1.5">
                                                <i class="fa-solid fa-file-invoice text-blue-600"></i> Official Marksheet
                                            </span>
                                            @if($searchedStudent->qualification_status === 'Qualified')
                                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-black bg-emerald-100 text-emerald-800 border border-emerald-300">
                                                    QUALIFIED
                                                </span>
                                            @elseif($searchedStudent->qualification_status === 'Not Qualified')
                                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-black bg-rose-100 text-rose-800 border border-rose-300">
                                                    BELOW CUTOFF
                                                </span>
                                            @endif
                                        </div>

                                        <div class="bg-white p-4 rounded-xl border border-purple-100 grid grid-cols-3 gap-2 text-center">
                                            <div>
                                                <span class="block text-[10px] font-bold text-gray-400 uppercase">Score</span>
                                                <span class="text-lg font-black text-[#340C6F]">{{ $searchedStudent->marks }}</span>
                                            </div>
                                            <div>
                                                <span class="block text-[10px] font-bold text-gray-400 uppercase">Cutoff</span>
                                                <span class="text-lg font-black text-amber-600">{{ $event->cutoff_marks ?? 'N/A' }}</span>
                                            </div>
                                            <div>
                                                <span class="block text-[10px] font-bold text-gray-400 uppercase">Rank</span>
                                                <span class="text-lg font-black text-gray-800">{{ $searchedStudent->rank ?? '—' }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-2 pt-2">
                                        <a href="{{ route('marksheet.show', $searchedStudent->roll_no) }}" target="_blank"
                                           class="flex-1 text-center py-2.5 rounded-xl bg-[#340C6F] hover:bg-purple-900 text-white font-bold text-xs transition-all shadow-md">
                                            <i class="fa-solid fa-eye mr-1"></i> View Marksheet
                                        </a>
                                        <a href="{{ route('marksheet.download', $searchedStudent->roll_no) }}"
                                           class="px-3.5 py-2.5 rounded-xl bg-purple-100 hover:bg-purple-200 text-[#340C6F] font-bold text-xs transition-all flex items-center gap-1">
                                            <i class="fa-solid fa-download"></i> PDF
                                        </a>
                                    </div>
                                </div>
                            @endif

                            <!-- Certificate Card -->
                            @if($hasCertPublished)
                                <div class="bg-amber-50/50 border border-amber-200 rounded-2xl p-6 flex flex-col justify-between space-y-4">
                                    <div class="space-y-3">
                                        <div class="flex items-center justify-between">
                                            <span class="text-xs font-black uppercase tracking-wider text-amber-800 flex items-center gap-1.5">
                                                <i class="fa-solid fa-award text-amber-600"></i> Merit Certificate
                                            </span>
                                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-black bg-amber-100 text-amber-800 border border-amber-300">
                                                VERIFIED & ISSUED
                                            </span>
                                        </div>

                                        <p class="text-xs text-gray-600 leading-relaxed">
                                            Your digital Certificate of Achievement is ready. It features your official examination score, rank, and certified authority seals.
                                        </p>
                                    </div>

                                    <div class="flex items-center gap-2 pt-2">
                                        <a href="{{ route('certificate.show', $searchedStudent->roll_no) }}" target="_blank"
                                           class="flex-1 text-center py-2.5 rounded-xl bg-[#F1400C] hover:bg-orange-600 text-white font-bold text-xs transition-all shadow-md">
                                            <i class="fa-solid fa-eye mr-1"></i> View Certificate
                                        </a>
                                        <a href="{{ route('certificate.download', $searchedStudent->roll_no) }}"
                                           class="px-3.5 py-2.5 rounded-xl bg-orange-100 hover:bg-orange-200 text-[#F1400C] font-bold text-xs transition-all flex items-center gap-1">
                                            <i class="fa-solid fa-download"></i> PDF
                                        </a>
                                    </div>
                                </div>
                            @endif

                        </div>

                    @else
                        <!-- Situation B: Result not yet published by admin -->
                        <div class="bg-gray-50 border border-gray-200 rounded-2xl p-8 text-center space-y-3">
                            <div class="w-12 h-12 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center text-xl mx-auto">
                                <i class="fa-solid fa-clock"></i>
                            </div>
                            <h3 class="text-base font-extrabold text-gray-800">Result Awaiting Official Release</h3>
                            <p class="text-xs text-gray-500 max-w-md mx-auto leading-relaxed">
                                Marks and certificates for <strong class="text-gray-700">{{ $searchedStudent->event->title ?? 'this competition' }}</strong> are currently being compiled and reviewed by the evaluation committee. Once published by the admin, your scorecard and certificate will become accessible here.
                            </p>
                        </div>
                    @endif

                </div>
            @endif

            <!-- Help / Info Note -->
            <div class="max-w-4xl mx-auto bg-white rounded-3xl p-6 sm:p-8 border border-gray-100 shadow-sm grid grid-cols-1 sm:grid-cols-3 gap-6 text-center sm:text-left">
                <div class="space-y-1">
                    <div class="text-[#340C6F] text-lg font-bold flex items-center gap-2 justify-center sm:justify-start">
                        <i class="fa-solid fa-shield-halved"></i>
                        <span>Official Verification</span>
                    </div>
                    <p class="text-xs text-gray-500 leading-relaxed">All marksheets and certificates carry authorized controller signatures and unique verification IDs.</p>
                </div>
                <div class="space-y-1">
                    <div class="text-[#F1400C] text-lg font-bold flex items-center gap-2 justify-center sm:justify-start">
                        <i class="fa-solid fa-print"></i>
                        <span>Print Ready</span>
                    </div>
                    <p class="text-xs text-gray-500 leading-relaxed">Standard A4 sizing for instant color or grayscale printing for academic submissions and school portfolios.</p>
                </div>
                <div class="space-y-1">
                    <div class="text-blue-600 text-lg font-bold flex items-center gap-2 justify-center sm:justify-start">
                        <i class="fa-solid fa-headset"></i>
                        <span>Need Assistance?</span>
                    </div>
                    <p class="text-xs text-gray-500 leading-relaxed">If your details are missing or you require assistance, visit our <a href="{{ url('/contact') }}" class="text-[#340C6F] font-bold underline">Contact Page</a>.</p>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
