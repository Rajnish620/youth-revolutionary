@extends('layouts.admin')

@section('title', 'Marks & Certificates - Admin Panel')

@section('content')
<div class="space-y-6" x-data="{ 
    activeTab: '{{ request('tab', 'events') }}',
    selectedSeason: '{{ request('season', 'All') }}'
}">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight flex items-center gap-2.5">
                <i class="fa-solid fa-award text-[#340C6F]"></i>
                <span>Marks & Certificate Management</span>
            </h1>
            <p class="text-xs text-gray-500 mt-1">
                Configure event-wise result publication (Marks/Certificates/Both), cutoff scores, marking schemes, and student marks roster.
            </p>
        </div>
        
        <!-- Navigation Tab Switchers -->
        <div class="inline-flex p-1 bg-gray-200/80 rounded-2xl border border-gray-300/60 shadow-inner">
            <button @click="activeTab = 'events'" 
                :class="activeTab === 'events' ? 'bg-[#340C6F] text-white shadow-md' : 'text-gray-700 hover:text-black'"
                class="px-4 py-2 rounded-xl text-xs font-bold transition-all flex items-center gap-2 cursor-pointer">
                <i class="fa-solid fa-sliders"></i>
                <span>1. Event Settings & Cutoffs</span>
            </button>
            <button @click="activeTab = 'students'" 
                :class="activeTab === 'students' ? 'bg-[#340C6F] text-white shadow-md' : 'text-gray-700 hover:text-black'"
                class="px-4 py-2 rounded-xl text-xs font-bold transition-all flex items-center gap-2 cursor-pointer">
                <i class="fa-solid fa-user-graduate"></i>
                <span>2. Student Marks & Results</span>
            </button>
        </div>
    </div>

    <!-- Summary KPI Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white p-4 rounded-2xl border border-gray-200/80 shadow-sm flex items-center gap-3.5">
            <div class="w-12 h-12 rounded-xl bg-purple-100 text-[#340C6F] flex items-center justify-center text-xl shrink-0">
                <i class="fa-solid fa-users"></i>
            </div>
            <div>
                <div class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Approved Students</div>
                <div class="text-xl font-extrabold text-gray-900">{{ number_format($totalApproved) }}</div>
            </div>
        </div>

        <div class="bg-white p-4 rounded-2xl border border-gray-200/80 shadow-sm flex items-center gap-3.5">
            <div class="w-12 h-12 rounded-xl bg-blue-100 text-[#028CD4] flex items-center justify-center text-xl shrink-0">
                <i class="fa-solid fa-file-invoice"></i>
            </div>
            <div>
                <div class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Marks Published</div>
                <div class="text-xl font-extrabold text-[#028CD4]">{{ $eventsWithMarks }} <span class="text-xs text-gray-400 font-semibold">Events</span></div>
            </div>
        </div>

        <div class="bg-white p-4 rounded-2xl border border-gray-200/80 shadow-sm flex items-center gap-3.5">
            <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center text-xl shrink-0">
                <i class="fa-solid fa-certificate"></i>
            </div>
            <div>
                <div class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Certs Published</div>
                <div class="text-xl font-extrabold text-amber-600">{{ $eventsWithCertificates }} <span class="text-xs text-gray-400 font-semibold">Events</span></div>
            </div>
        </div>

        <div class="bg-white p-4 rounded-2xl border border-gray-200/80 shadow-sm flex items-center gap-3.5">
            <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-xl shrink-0">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <div>
                <div class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Certificates Released</div>
                <div class="text-xl font-extrabold text-emerald-700">{{ number_format($totalCertsEnabled) }}</div>
            </div>
        </div>
    </div>

    <!-- Alert Flash Messages -->
    @if(session('success'))
        <div class="p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 text-sm font-semibold flex items-center gap-2 shadow-sm">
            <i class="fa-solid fa-circle-check text-base"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif
    @if(isset($errors) && $errors->any())
        <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-700 text-sm font-semibold space-y-1 shadow-sm">
            @foreach($errors->all() as $error)
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-circle-exclamation text-rose-500"></i>
                    <span>{{ $error }}</span>
                </div>
            @endforeach
        </div>
    @endif

    <!-- ========================================================================= -->
    <!-- TAB 1: EVENT RESULT & SCORING SETTINGS                                     -->
    <!-- ========================================================================= -->
    <div x-show="activeTab === 'events'" class="space-y-6" style="display: none;">
        
        <div class="bg-white p-6 rounded-2xl border border-gray-200/80 shadow-sm">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-gray-100 pb-5 mb-6">
                <div>
                    <h2 class="text-lg font-extrabold text-gray-900 flex items-center gap-2">
                        <i class="fa-solid fa-sliders text-[#340C6F]"></i>
                        <span>Event Publication & Scoring Configuration</span>
                    </h2>
                    <p class="text-xs text-gray-500 mt-1">
                        Choose which event shows Marks, which shows Certificate, or Both. Set specific cutoffs and question schemes.
                    </p>
                </div>

                <!-- Right Action Bar: Season Dropdown Filter + Total Count -->
                <div class="flex flex-wrap items-center gap-3 self-start md:self-auto">
                    @if(isset($seasons) && $seasons->count() > 0)
                        <div class="flex items-center gap-2 bg-purple-50/60 p-1.5 pl-3 rounded-2xl border border-purple-100/90 shadow-xs">
                            <span class="text-xs font-bold text-gray-600 flex items-center gap-1.5 shrink-0">
                                <i class="fa-solid fa-layer-group text-[#340C6F]"></i>
                                <span class="hidden sm:inline">Season:</span>
                            </span>
                            <div class="relative">
                                <select x-model="selectedSeason" 
                                    class="bg-white hover:bg-gray-50 text-xs font-extrabold text-[#340C6F] rounded-xl pl-3 pr-8 py-2 border border-purple-200/80 outline-none focus:border-[#340C6F] focus:ring-2 focus:ring-[#340C6F]/20 transition-all shadow-xs cursor-pointer appearance-none">
                                    <option value="All">All Seasons ({{ $events->count() }})</option>
                                    @foreach($seasons as $s)
                                        @php
                                            $sCount = $events->where('season', $s)->count();
                                        @endphp
                                        <option value="{{ $s }}">{{ $s }} ({{ $sCount }} {{ Str::plural('Event', $sCount) }})</option>
                                    @endforeach
                                </select>
                                <div class="absolute right-2.5 top-1/2 -translate-y-1/2 text-purple-400 pointer-events-none text-[10px]">
                                    <i class="fa-solid fa-chevron-down"></i>
                                </div>
                            </div>
                        </div>
                    @endif

                    <span class="px-3.5 py-2.5 bg-purple-50 text-[#340C6F] font-extrabold text-xs rounded-2xl border border-purple-200 inline-flex items-center gap-1.5 shadow-xs shrink-0">
                        <i class="fa-solid fa-calendar-check"></i> Total {{ $events->count() }} Events
                    </span>
                </div>
            </div>

            <!-- Active Season Filter Indicator Banner (when not 'All') -->
            <div x-show="selectedSeason !== 'All'" x-cloak class="flex items-center justify-between bg-purple-50/80 px-4 py-2.5 rounded-xl border border-purple-100 text-xs text-purple-950 font-semibold mb-6 shadow-xs" style="display: none;">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-[#340C6F] animate-pulse"></span>
                    <span>Filtered by Season: <strong class="text-[#340C6F]" x-text="selectedSeason"></strong></span>
                </div>
                <button type="button" @click="selectedSeason = 'All'" class="text-[#340C6F] hover:text-purple-900 hover:underline font-bold text-xs flex items-center gap-1 cursor-pointer">
                    <i class="fa-solid fa-xmark text-[11px]"></i> Clear Filter (Show All)
                </button>
            </div>

            <div class="space-y-6">
                @forelse($events as $event)
                    <div x-show="selectedSeason === 'All' || selectedSeason === '{{ addslashes($event->season ?? '') }}'"
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 transform -translate-y-1"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         data-season="{{ $event->season ?? '' }}"
                         class="bg-gray-50/70 border border-gray-200 rounded-2xl p-5 hover:border-[#340C6F]/40 transition-all">
                        
                        <!-- Event Header Row -->
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-gray-200/60 pb-4">
                            <div class="flex items-center gap-3.5">
                                @if($event->image && file_exists(public_path($event->image)))
                                    <img src="{{ asset($event->image) }}" class="w-12 h-12 rounded-xl object-cover border border-gray-200 shadow-sm" alt="Event">
                                @else
                                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#340C6F] to-purple-900 text-white flex items-center justify-center text-lg font-black shrink-0 shadow-sm">
                                        {{ substr($event->title, 0, 1) }}
                                    </div>
                                @endif
                                <div>
                                    <div class="flex flex-wrap items-center gap-2">
                                        <h3 class="text-base font-extrabold text-gray-900">{{ $event->title }}</h3>
                                        <span class="text-[10px] uppercase font-bold px-2 py-0.5 rounded bg-purple-100 text-[#340C6F]">{{ $event->category ?? 'General' }}</span>
                                        <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-gray-200 text-gray-700">{{ $event->season ?? 'Season 2026' }}</span>
                                    </div>
                                    <div class="flex items-center gap-4 text-xs text-gray-500 mt-1">
                                        <span><i class="fa-regular fa-calendar mr-1"></i>{{ $event->event_date ? $event->event_date->format('M d, Y') : 'Date N/A' }}</span>
                                        <span><i class="fa-solid fa-users mr-1"></i>{{ $event->approved_registrations_count }} Approved Students</span>
                                        <span><i class="fa-solid fa-pen-to-square mr-1"></i>{{ $event->marks_entered_count }} Marks Uploaded</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Current Status Pill -->
                            <div class="flex items-center gap-2">
                                @if($event->show_marks && $event->show_certificate)
                                    <span class="px-3 py-1 rounded-full text-xs font-black bg-emerald-100 text-emerald-800 border border-emerald-300 inline-flex items-center gap-1.5 shadow-sm">
                                        <i class="fa-solid fa-circle-check"></i> BOTH (Marks & Certs Active)
                                    </span>
                                @elseif($event->show_marks)
                                    <span class="px-3 py-1 rounded-full text-xs font-black bg-blue-100 text-blue-800 border border-blue-300 inline-flex items-center gap-1.5 shadow-sm">
                                        <i class="fa-solid fa-file-invoice"></i> MARKS ONLY ACTIVE
                                    </span>
                                @elseif($event->show_certificate)
                                    <span class="px-3 py-1 rounded-full text-xs font-black bg-amber-100 text-amber-800 border border-amber-300 inline-flex items-center gap-1.5 shadow-sm">
                                        <i class="fa-solid fa-award"></i> CERTIFICATE ONLY ACTIVE
                                    </span>
                                @else
                                    <span class="px-3 py-1 rounded-full text-xs font-black bg-gray-200 text-gray-600 inline-flex items-center gap-1.5">
                                        <i class="fa-solid fa-eye-slash"></i> HIDDEN (Not Published)
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Settings Form for this Event -->
                        <form method="POST" action="{{ route('admin.marks.event-settings', $event->id) }}"
                              x-data="{ evalType: '{{ $event->evaluation_type ?? 'marks' }}' }"
                              class="mt-4 space-y-4">
                            @csrf
                            
                            <!-- Toggles Row: Marksheet & Certificate -->
                            <div class="bg-white p-4 rounded-xl border border-gray-200 grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <!-- Show Marks Toggle -->
                                <label class="flex items-center justify-between p-3 rounded-xl border {{ $event->show_marks ? 'border-blue-300 bg-blue-50/40' : 'border-gray-200 bg-gray-50/50' }} cursor-pointer hover:border-blue-400 transition-all">
                                    <div class="pr-2">
                                        <div class="text-xs font-extrabold text-gray-800 flex items-center gap-1.5">
                                            <i class="fa-solid fa-file-invoice text-blue-600"></i> Show Marksheet / Result
                                        </div>
                                        <p class="text-[11px] text-gray-500 mt-0.5">Students can view & download their official Marksheet / Scorecard</p>
                                    </div>
                                    <input type="checkbox" name="show_marks" value="1" {{ $event->show_marks ? 'checked' : '' }}
                                        class="w-5 h-5 text-blue-600 rounded-md focus:ring-blue-500 cursor-pointer">
                                </label>

                                <!-- Show Certificate Toggle -->
                                <label class="flex items-center justify-between p-3 rounded-xl border {{ $event->show_certificate ? 'border-amber-300 bg-amber-50/40' : 'border-gray-200 bg-gray-50/50' }} cursor-pointer hover:border-amber-400 transition-all">
                                    <div class="pr-2">
                                        <div class="text-xs font-extrabold text-gray-800 flex items-center gap-1.5">
                                            <i class="fa-solid fa-award text-amber-600"></i> Show Certificates
                                        </div>
                                        <p class="text-[11px] text-gray-500 mt-0.5">Students can view & download their digital Certificate</p>
                                    </div>
                                    <input type="checkbox" name="show_certificate" value="1" {{ $event->show_certificate ? 'checked' : '' }}
                                        class="w-5 h-5 text-amber-600 rounded-md focus:ring-amber-500 cursor-pointer">
                                </label>
                            </div>

                            <!-- Evaluation Scheme Selector -->
                            <div class="bg-white p-4 rounded-xl border border-gray-200 space-y-2.5">
                                <label class="block text-xs font-black text-gray-800 uppercase tracking-wider">
                                    <i class="fa-solid fa-graduation-cap text-[#340C6F] mr-1"></i> Evaluation & Marksheet Scheme
                                </label>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <!-- Option 1: Numeric Marks (Quiz / Exam) -->
                                    <label class="flex items-start gap-3 p-3 rounded-xl border cursor-pointer transition-all"
                                           :class="evalType === 'marks' ? 'border-[#340C6F] bg-purple-50/60 shadow-xs ring-1 ring-[#340C6F]/30' : 'border-gray-200 hover:border-gray-300 bg-gray-50/30'">
                                        <input type="radio" name="evaluation_type" value="marks" x-model="evalType" class="mt-0.5 text-[#340C6F] focus:ring-[#340C6F]">
                                        <div>
                                            <div class="text-xs font-black text-gray-900 flex items-center gap-1.5">
                                                <i class="fa-solid fa-square-poll-vertical text-[#340C6F]"></i>
                                                <span>Numeric Marks Scheme (Quiz / Exam)</span>
                                            </div>
                                            <p class="text-[11px] text-gray-500 mt-0.5 leading-relaxed">
                                                Marksheet displays numeric scores, cutoff, questions, negative marking, and percentage.
                                            </p>
                                        </div>
                                    </label>

                                    <!-- Option 2: Qualified / Not Qualified (Cultural / Essay / Talent) -->
                                    <label class="flex items-start gap-3 p-3 rounded-xl border cursor-pointer transition-all"
                                           :class="evalType === 'qualify_only' ? 'border-emerald-600 bg-emerald-50/60 shadow-xs ring-1 ring-emerald-600/30' : 'border-gray-200 hover:border-gray-300 bg-gray-50/30'">
                                        <input type="radio" name="evaluation_type" value="qualify_only" x-model="evalType" class="mt-0.5 text-emerald-600 focus:ring-emerald-500">
                                        <div>
                                            <div class="text-xs font-black text-gray-900 flex items-center gap-1.5">
                                                <i class="fa-solid fa-clipboard-check text-emerald-600"></i>
                                                <span>Qualified / Not Qualified Scheme (Cultural / Essay)</span>
                                            </div>
                                            <p class="text-[11px] text-gray-500 mt-0.5 leading-relaxed">
                                                Marksheet displays official <strong>QUALIFIED</strong> / <strong>NOT QUALIFIED</strong> status badge without numeric marks.
                                            </p>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <!-- Numeric Scoring Inputs Grid (Visible only in 'marks' mode) -->
                            <div x-show="evalType === 'marks'" x-transition class="grid grid-cols-2 sm:grid-cols-5 gap-3">
                                <div>
                                    <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1">Total Questions</label>
                                    <input type="number" min="0" name="total_questions" value="{{ old('total_questions', $event->total_questions) }}" placeholder="e.g. 50"
                                        class="w-full bg-white border border-gray-200 rounded-xl px-3 py-2 text-xs font-bold text-gray-800 focus:border-[#340C6F] outline-none">
                                </div>

                                <div>
                                    <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1">Marks / Question</label>
                                    <input type="number" step="0.01" min="0" name="marks_per_question" value="{{ old('marks_per_question', $event->marks_per_question) }}" placeholder="e.g. 2.00"
                                        class="w-full bg-white border border-gray-200 rounded-xl px-3 py-2 text-xs font-bold text-gray-800 focus:border-[#340C6F] outline-none">
                                </div>

                                <div>
                                    <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1">Negative Marking</label>
                                    <input type="number" step="0.01" min="0" name="negative_marks" value="{{ old('negative_marks', $event->negative_marks ?? 0) }}" placeholder="e.g. 0.25"
                                        class="w-full bg-white border border-gray-200 rounded-xl px-3 py-2 text-xs font-bold text-gray-800 focus:border-[#340C6F] outline-none">
                                </div>

                                <div>
                                    <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1">Total Max Marks</label>
                                    <input type="number" step="0.01" min="0" name="total_marks" value="{{ old('total_marks', $event->total_marks ?? 100) }}" placeholder="e.g. 100"
                                        class="w-full bg-white border border-gray-200 rounded-xl px-3 py-2 text-xs font-bold text-gray-800 focus:border-[#340C6F] outline-none">
                                </div>

                                <div class="col-span-2 sm:col-span-1">
                                    <label class="block text-[10px] font-bold text-[#F1400C] uppercase tracking-wider mb-1">Passing Cutoff Score</label>
                                    <input type="number" step="0.01" min="0" name="cutoff_marks" value="{{ old('cutoff_marks', $event->cutoff_marks) }}" placeholder="e.g. 40.00"
                                        class="w-full bg-amber-50/60 border border-amber-300 rounded-xl px-3 py-2 text-xs font-black text-amber-900 focus:border-[#F1400C] outline-none">
                                </div>
                            </div>

                            <!-- Qualified Mode Notice Box (Visible in 'qualify_only' mode) -->
                            <div x-show="evalType === 'qualify_only'" x-transition class="p-3.5 rounded-xl bg-emerald-50/90 border border-emerald-200 text-xs text-emerald-950 flex items-start gap-3">
                                <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0 mt-0.5">
                                    <i class="fa-solid fa-clipboard-check text-base"></i>
                                </div>
                                <div>
                                    <div class="font-extrabold text-xs text-emerald-900">Qualified / Not Qualified Scheme Active for this Event</div>
                                    <p class="text-[11px] text-emerald-800 mt-0.5 leading-relaxed">
                                        Numeric marks and question counts are not required. In Tab 2 (Students), you will be able to toggle each student as <strong>Qualified</strong> or <strong>Not Qualified</strong> with 1-click. Marksheets will display the official qualification status without numbers.
                                    </p>
                                </div>
                            </div>

                            <!-- Marking Notes & Save Button -->
                            <div class="flex flex-col md:flex-row items-end gap-3 pt-1">
                                <div class="w-full">
                                    <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1">Evaluation Notes / Instructions for Marksheet</label>
                                    <input type="text" name="marking_scheme_notes" value="{{ old('marking_scheme_notes', $event->marking_scheme_notes) }}" placeholder="e.g. Passing cutoff is 40%. Each question carries 2 marks with no negative marking."
                                        class="w-full bg-white border border-gray-200 rounded-xl px-3 py-2 text-xs text-gray-700 focus:border-[#340C6F] outline-none">
                                </div>
                                <input type="hidden" name="season" :value="selectedSeason">
                                <button type="submit" class="px-5 py-2 rounded-xl bg-[#340C6F] hover:bg-purple-900 text-white font-bold text-xs shadow-md transition-all shrink-0 flex items-center gap-1.5 cursor-pointer">
                                    <i class="fa-solid fa-floppy-disk"></i>
                                    <span>Save Settings</span>
                                </button>
                            </div>

                        </form>

                    </div>
                @empty
                    <div class="py-12 text-center text-gray-400">
                        No events found in the database.
                    </div>
                @endforelse

                @if(isset($seasons) && $seasons->count() > 0)
                    <div x-show="selectedSeason !== 'All' && !({{ json_encode($seasons->toArray()) }}).includes(selectedSeason)" 
                         class="py-12 text-center text-gray-400 text-sm font-semibold" style="display: none;">
                        <i class="fa-solid fa-calendar-xmark text-2xl mb-2 text-gray-300 block"></i>
                        No events found for this season.
                    </div>
                @endif
            </div>
        </div>

    </div>

    <!-- ========================================================================= -->
    <!-- TAB 2: STUDENT MARKS ENTRY & RESULTS ROSTER                                -->
    <!-- ========================================================================= -->
    <div x-show="activeTab === 'students'" class="space-y-6">

        <!-- Filters and Bulk Controls -->
        <div class="bg-white p-4 sm:p-5 rounded-2xl border border-gray-200/80 shadow-sm space-y-4">
            
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                
                <!-- Search & Filters Form -->
                <form method="GET" action="{{ route('admin.marks.index') }}" class="flex flex-wrap items-center gap-3 w-full lg:w-auto">
                    <input type="hidden" name="tab" value="students">
                    
                    @if(isset($seasons) && $seasons->count() > 0)
                        <!-- Season Select -->
                        <select name="season" onchange="this.form.submit()" class="bg-gray-50 border border-gray-200 text-xs font-semibold text-gray-700 rounded-xl px-3 py-2.5 outline-none focus:border-[#340C6F]">
                            <option value="All">All Seasons</option>
                            @foreach($seasons as $s)
                                <option value="{{ $s }}" {{ request('season') == $s ? 'selected' : '' }}>{{ $s }}</option>
                            @endforeach
                        </select>
                    @endif

                    <!-- Event Select -->
                    <select name="event_id" onchange="this.form.submit()" class="bg-gray-50 border border-gray-200 text-xs font-semibold text-gray-700 rounded-xl px-3 py-2.5 outline-none focus:border-[#340C6F]">
                        <option value="All">All Events ({{ $events->count() }})</option>
                        @foreach($events as $e)
                            @if(!request('season') || request('season') === 'All' || $e->season === request('season'))
                                <option value="{{ $e->id }}" {{ request('event_id') == $e->id ? 'selected' : '' }}>
                                    {{ $e->title }} @if($e->season)({{ $e->season }})@endif
                                </option>
                            @endif
                        @endforeach
                    </select>

                    <!-- Status Filter -->
                    <select name="status_filter" onchange="this.form.submit()" class="bg-gray-50 border border-gray-200 text-xs font-semibold text-gray-700 rounded-xl px-3 py-2.5 outline-none focus:border-[#340C6F]">
                        <option value="">All Students</option>
                        <option value="with_marks" {{ request('status_filter') == 'with_marks' ? 'selected' : '' }}>With Marks/Status Entered</option>
                        <option value="without_marks" {{ request('status_filter') == 'without_marks' ? 'selected' : '' }}>Pending Evaluation</option>
                        <option value="qualified" {{ request('status_filter') == 'qualified' ? 'selected' : '' }}>Qualified Only</option>
                        <option value="not_qualified" {{ request('status_filter') == 'not_qualified' ? 'selected' : '' }}>Not Qualified Only</option>
                        <option value="cert_enabled" {{ request('status_filter') == 'cert_enabled' ? 'selected' : '' }}>Certificate Enabled</option>
                        <option value="cert_disabled" {{ request('status_filter') == 'cert_disabled' ? 'selected' : '' }}>Certificate Disabled</option>
                    </select>

                    <!-- Search Input -->
                    <div class="relative flex-1 sm:w-64">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Roll no, name, reg no..." 
                            class="w-full bg-gray-100/80 text-xs pl-9 pr-4 py-2.5 rounded-xl border border-transparent focus:border-[#340C6F] focus:bg-white outline-none transition-all">
                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-gray-400 text-xs"></i>
                    </div>

                    <button type="submit" class="px-4 py-2.5 rounded-xl bg-gray-800 hover:bg-black text-white text-xs font-bold transition-all shadow-sm">
                        Filter
                    </button>
                    @if(request('event_id') || request('search') || request('status_filter') || (request('season') && request('season') !== 'All'))
                        <a href="{{ route('admin.marks.index', ['tab' => 'students']) }}" class="px-3 py-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-600 text-xs font-bold transition-all">
                            Reset
                        </a>
                    @endif
                </form>

                <!-- Bulk Action Buttons -->
                <div class="flex flex-wrap items-center gap-2">
                    <!-- Bulk Qualification Actions -->
                    <form method="POST" action="{{ route('admin.marks.bulk-qualification') }}">
                        @csrf
                        <input type="hidden" name="season" value="{{ request('season') }}">
                        <input type="hidden" name="event_id" value="{{ request('event_id') }}">
                        <input type="hidden" name="status" value="qualified">
                        <button type="submit" onclick="return confirm('Mark all matching students in this selection as QUALIFIED?')" class="px-3 py-2 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs shadow-sm transition-all flex items-center gap-1.5 cursor-pointer" title="Mark selected students as Qualified">
                            <i class="fa-solid fa-check-double"></i>
                            <span>Mark All Qualified</span>
                        </button>
                    </form>

                    <form method="POST" action="{{ route('admin.marks.bulk-qualification') }}">
                        @csrf
                        <input type="hidden" name="season" value="{{ request('season') }}">
                        <input type="hidden" name="event_id" value="{{ request('event_id') }}">
                        <input type="hidden" name="status" value="not_qualified">
                        <button type="submit" onclick="return confirm('Mark all matching students in this selection as NOT QUALIFIED?')" class="px-3 py-2 rounded-xl bg-rose-700 hover:bg-rose-800 text-white font-bold text-xs shadow-sm transition-all flex items-center gap-1.5 cursor-pointer" title="Mark selected students as Not Qualified">
                            <i class="fa-solid fa-xmark"></i>
                            <span>Mark All Not Qualified</span>
                        </button>
                    </form>

                    <!-- Bulk Certificate Actions -->
                    <form method="POST" action="{{ route('admin.marks.bulk-certificate') }}">
                        @csrf
                        <input type="hidden" name="season" value="{{ request('season') }}">
                        <input type="hidden" name="event_id" value="{{ request('event_id') }}">
                        <input type="hidden" name="enable" value="1">
                        <button type="submit" onclick="return confirm('Enable certificates for all matching students in this event?')" class="px-3 py-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs shadow-sm transition-all flex items-center gap-1.5 cursor-pointer">
                            <i class="fa-solid fa-certificate"></i>
                            <span>Enable All Certs</span>
                        </button>
                    </form>

                    <form method="POST" action="{{ route('admin.marks.bulk-certificate') }}">
                        @csrf
                        <input type="hidden" name="season" value="{{ request('season') }}">
                        <input type="hidden" name="event_id" value="{{ request('event_id') }}">
                        <input type="hidden" name="enable" value="0">
                        <button type="submit" onclick="return confirm('Disable certificates for all matching students in this event?')" class="px-3 py-2 rounded-xl bg-slate-600 hover:bg-slate-700 text-white font-bold text-xs shadow-sm transition-all flex items-center gap-1.5 cursor-pointer">
                            <i class="fa-solid fa-ban"></i>
                            <span>Disable All Certs</span>
                        </button>
                    </form>
                </div>

            </div>

        </div>

        <!-- Student Roster Table -->
        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/80 border-b border-gray-200 text-[11px] font-bold text-gray-500 uppercase tracking-wider">
                            <th class="py-4 px-6">Student / Roll No</th>
                            <th class="py-4 px-4">Event & Scheme</th>
                            <th class="py-4 px-4">Marks / Evaluation</th>
                            <th class="py-4 px-4">Rank / Merit</th>
                            <th class="py-4 px-4">Result Status</th>
                            <th class="py-4 px-4">Certificate</th>
                            <th class="py-4 px-6 text-right">View / Preview</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-xs">
                        @forelse($registrations as $reg)
                            @php
                                $isQualify = ($reg->event && ($reg->event->evaluation_type ?? 'marks') === 'qualify_only');
                            @endphp
                            <tr class="hover:bg-gray-50/60 transition-colors">
                                
                                <!-- Student Meta -->
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full border border-gray-200 overflow-hidden bg-gray-100 shrink-0 flex items-center justify-center">
                                            @if($reg->photo && file_exists(public_path($reg->photo)))
                                                <img src="{{ asset($reg->photo) }}" class="w-full h-full object-cover" alt="Student">
                                            @else
                                                <i class="fa-solid fa-user text-gray-400 text-sm"></i>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="font-extrabold text-gray-900 text-xs flex items-center gap-1.5">
                                                <span>{{ $reg->student_name }}</span>
                                                <span class="font-mono text-[10px] px-1.5 py-0.5 rounded bg-purple-100 text-[#340C6F] font-black">{{ $reg->roll_no }}</span>
                                            </div>
                                            <div class="text-[11px] text-gray-400 mt-0.5">
                                                {{ $reg->student_class }} | {{ $reg->school_name ?? 'School N/A' }}
                                            </div>
                                            <div class="text-[10px] text-gray-400 font-mono">Reg: {{ $reg->registration_no ?? 'N/A' }}</div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Event & Cutoff Meta -->
                                <td class="py-4 px-4">
                                    <div class="font-bold text-gray-800 line-clamp-1">{{ $reg->event->title ?? 'N/A' }}</div>
                                    <div class="text-[11px] text-[#F1400C] font-semibold mt-0.5">{{ $reg->group->group_name ?? 'General Group' }}</div>
                                    @if($isQualify)
                                        <div class="text-[10px] text-emerald-700 font-black mt-1 inline-flex items-center gap-1 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200">
                                            <i class="fa-solid fa-clipboard-check"></i> Status-Only Event
                                        </div>
                                    @else
                                        <div class="text-[10px] text-gray-500 font-semibold mt-1">
                                            Cutoff: <span class="font-bold text-amber-700">{{ $reg->event && $reg->event->cutoff_marks !== null ? $reg->event->cutoff_marks : 'Not Set' }}</span>
                                        </div>
                                    @endif
                                </td>

                                <!-- Marks / Evaluation Column -->
                                <td class="py-4 px-4">
                                    @if($isQualify)
                                        <!-- 1-Click Toggle for Qualified / Not Qualified -->
                                        <form method="POST" action="{{ route('admin.marks.toggle-qualification', $reg->id) }}">
                                            @csrf
                                            @if($reg->is_qualified === true)
                                                <button type="submit" title="Click to change to NOT QUALIFIED" class="px-3 py-1.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-black text-xs shadow-xs transition-all flex items-center gap-1.5 cursor-pointer">
                                                    <i class="fa-solid fa-circle-check"></i>
                                                    <span>QUALIFIED</span>
                                                </button>
                                            @elseif($reg->is_qualified === false)
                                                <button type="submit" title="Click to change to QUALIFIED" class="px-3 py-1.5 rounded-xl bg-rose-600 hover:bg-rose-700 text-white font-black text-xs shadow-xs transition-all flex items-center gap-1.5 cursor-pointer">
                                                    <i class="fa-solid fa-circle-xmark"></i>
                                                    <span>NOT QUALIFIED</span>
                                                </button>
                                            @else
                                                <button type="submit" title="Click to mark QUALIFIED" class="px-3 py-1.5 rounded-xl bg-amber-50 hover:bg-amber-100 text-amber-900 border border-amber-300 font-bold text-xs shadow-xs transition-all flex items-center gap-1.5 cursor-pointer">
                                                    <i class="fa-solid fa-clock text-amber-600"></i>
                                                    <span>Set Status</span>
                                                </button>
                                            @endif
                                        </form>
                                    @else
                                        <!-- Inline Marks Edit Form -->
                                        <form id="form-marks-{{ $reg->id }}" method="POST" action="{{ route('admin.marks.update', $reg->id) }}">
                                            @csrf
                                            <div class="flex items-center gap-2">
                                                <input type="number" step="0.01" name="marks" value="{{ old('marks', $reg->marks) }}" placeholder="Marks"
                                                    class="w-20 bg-gray-50 border border-gray-200 rounded-lg px-2.5 py-1.5 text-xs font-black text-[#340C6F] focus:bg-white focus:border-[#340C6F] outline-none">
                                                <button type="submit" form="form-marks-{{ $reg->id }}" title="Save Marks & Rank"
                                                    class="w-8 h-8 rounded-lg bg-[#340C6F] hover:bg-purple-900 text-white flex items-center justify-center text-xs transition-all shadow-sm cursor-pointer shrink-0">
                                                    <i class="fa-solid fa-check"></i>
                                                </button>
                                            </div>
                                    @endif
                                </td>

                                <!-- Rank / Merit Column -->
                                <td class="py-4 px-4">
                                    @if($isQualify)
                                        <form method="POST" action="{{ route('admin.marks.update', $reg->id) }}" class="flex items-center gap-1">
                                            @csrf
                                            <input type="text" name="rank" value="{{ old('rank', $reg->rank) }}" placeholder="e.g. 1st / Merit"
                                                class="w-28 bg-gray-50 border border-gray-200 rounded-lg px-2.5 py-1.5 text-xs font-bold text-gray-800 focus:bg-white focus:border-[#340C6F] outline-none">
                                            <button type="submit" title="Save Rank" class="w-7 h-7 rounded-lg bg-gray-200 hover:bg-[#340C6F] hover:text-white text-gray-700 flex items-center justify-center text-[11px] transition-all cursor-pointer shrink-0">
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                        </form>
                                    @else
                                            <input type="text" name="rank" value="{{ old('rank', $reg->rank) }}" placeholder="e.g. 1st / Merit" form="form-marks-{{ $reg->id }}"
                                                class="w-28 bg-gray-50 border border-gray-200 rounded-lg px-2.5 py-1.5 text-xs font-bold text-gray-800 focus:bg-white focus:border-[#340C6F] outline-none">
                                        </form>
                                    @endif
                                </td>

                                <!-- Result Status Badge -->
                                <td class="py-4 px-4">
                                    @if($isQualify)
                                        @if($reg->is_qualified === true)
                                            <span class="px-2.5 py-1 rounded-full text-[10px] font-black bg-emerald-100 text-emerald-800 border border-emerald-300 inline-flex items-center gap-1">
                                                <i class="fa-solid fa-circle-check"></i> Qualified
                                            </span>
                                        @elseif($reg->is_qualified === false)
                                            <span class="px-2.5 py-1 rounded-full text-[10px] font-black bg-rose-100 text-rose-800 border border-rose-300 inline-flex items-center gap-1">
                                                <i class="fa-solid fa-circle-xmark"></i> Not Qualified
                                            </span>
                                        @else
                                            <span class="px-2.5 py-1 rounded-full text-[10px] font-semibold bg-gray-100 text-gray-500 inline-flex items-center gap-1">
                                                Pending
                                            </span>
                                        @endif
                                    @else
                                        @if($reg->qualification_status === 'Qualified')
                                            <span class="px-2.5 py-1 rounded-full text-[10px] font-black bg-emerald-100 text-emerald-800 border border-emerald-300 inline-flex items-center gap-1">
                                                <i class="fa-solid fa-circle-check"></i> Qualified
                                            </span>
                                        @elseif($reg->qualification_status === 'Not Qualified')
                                            <span class="px-2.5 py-1 rounded-full text-[10px] font-black bg-rose-100 text-rose-800 border border-rose-300 inline-flex items-center gap-1">
                                                <i class="fa-solid fa-circle-xmark"></i> Below Cutoff
                                            </span>
                                        @else
                                            <span class="px-2.5 py-1 rounded-full text-[10px] font-semibold bg-gray-100 text-gray-500 inline-flex items-center gap-1">
                                                Pending
                                            </span>
                                        @endif
                                    @endif
                                </td>

                                <!-- Certificate Toggle -->
                                <td class="py-4 px-4">
                                    <form method="POST" action="{{ route('admin.marks.toggle-certificate', $reg->id) }}">
                                        @csrf
                                        <button type="submit" class="px-2.5 py-1.5 rounded-lg text-[11px] font-black transition-all shadow-sm flex items-center gap-1.5 {{ $reg->certificate_enabled ? 'bg-emerald-50 text-emerald-700 border border-emerald-300 hover:bg-emerald-100' : 'bg-gray-100 text-gray-500 hover:bg-gray-200' }}">
                                            <i class="fa-solid {{ $reg->certificate_enabled ? 'fa-circle-check text-emerald-600' : 'fa-circle-xmark text-gray-400' }}"></i>
                                            <span>{{ $reg->certificate_enabled ? 'Active' : 'Disabled' }}</span>
                                        </button>
                                    </form>
                                </td>

                                <!-- Action Buttons: Marksheet & Certificate Previews -->
                                <td class="py-4 px-6 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <!-- Marksheet Preview -->
                                        <a href="{{ route('marksheet.show', $reg->roll_no) }}" target="_blank" 
                                           class="px-2.5 py-1.5 rounded-lg bg-blue-50 hover:bg-blue-600 hover:text-white text-[#028CD4] border border-blue-200 text-xs font-bold flex items-center gap-1 transition-all" 
                                           title="View Official Marksheet">
                                            <i class="fa-solid fa-file-invoice"></i>
                                            <span>Marksheet</span>
                                        </a>

                                        <!-- Certificate Preview -->
                                        <a href="{{ route('certificate.show', $reg->roll_no) }}" target="_blank" 
                                           class="px-2.5 py-1.5 rounded-lg bg-amber-50 hover:bg-amber-600 hover:text-white text-amber-700 border border-amber-200 text-xs font-bold flex items-center gap-1 transition-all" 
                                           title="View Digital Certificate">
                                            <i class="fa-solid fa-award"></i>
                                            <span>Cert</span>
                                        </a>
                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-12 text-center text-gray-400 text-sm">
                                    No approved student registrations found matching your query.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Bar -->
            @if($registrations->hasPages())
                <div class="p-4 border-t border-gray-100 bg-gray-50">
                    {{ $registrations->links() }}
                </div>
            @endif
        </div>

    </div>

</div>
@endsection
