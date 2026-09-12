@extends('layouts.admin')

@section('title', 'Marks & Certificates - Admin Panel')

@section('content')
<div class="space-y-6" x-data="{ activeTab: '{{ request('tab', 'events') }}' }">

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
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-gray-100 pb-4 mb-6">
                <div>
                    <h2 class="text-lg font-extrabold text-gray-900">Event Publication & Scoring Configuration</h2>
                    <p class="text-xs text-gray-500 mt-0.5">
                        Choose which event shows Marks, which shows Certificate, or Both. Set specific cutoffs and question schemes.
                    </p>
                </div>
                <span class="px-3 py-1 bg-purple-50 text-[#340C6F] font-extrabold text-xs rounded-xl border border-purple-200 inline-flex items-center gap-1.5 self-start sm:self-auto">
                    <i class="fa-solid fa-calendar-check"></i> Total {{ $events->count() }} Events
                </span>
            </div>

            <div class="space-y-6">
                @forelse($events as $event)
                    <div class="bg-gray-50/70 border border-gray-200 rounded-2xl p-5 hover:border-[#340C6F]/40 transition-all">
                        
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
                        <form method="POST" action="{{ route('admin.marks.event-settings', $event->id) }}" class="mt-4 space-y-4">
                            @csrf
                            
                            <!-- Toggles Row -->
                            <div class="bg-white p-4 rounded-xl border border-gray-200 grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <!-- Show Marks Toggle -->
                                <label class="flex items-center justify-between p-3 rounded-xl border {{ $event->show_marks ? 'border-blue-300 bg-blue-50/40' : 'border-gray-200 bg-gray-50/50' }} cursor-pointer hover:border-blue-400 transition-all">
                                    <div class="pr-2">
                                        <div class="text-xs font-extrabold text-gray-800 flex items-center gap-1.5">
                                            <i class="fa-solid fa-file-invoice text-blue-600"></i> Show Marks / Marksheet
                                        </div>
                                        <p class="text-[11px] text-gray-500 mt-0.5">Students can view & download their official Marksheet</p>
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

                            <!-- Scoring Inputs Grid -->
                            <div class="grid grid-cols-2 sm:grid-cols-5 gap-3">
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

                            <!-- Marking Notes & Save Button -->
                            <div class="flex flex-col md:flex-row items-end gap-3 pt-1">
                                <div class="w-full">
                                    <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1">Evaluation Notes / Instructions for Marksheet</label>
                                    <input type="text" name="marking_scheme_notes" value="{{ old('marking_scheme_notes', $event->marking_scheme_notes) }}" placeholder="e.g. Passing cutoff is 40%. Each question carries 2 marks with no negative marking."
                                        class="w-full bg-white border border-gray-200 rounded-xl px-3 py-2 text-xs text-gray-700 focus:border-[#340C6F] outline-none">
                                </div>
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
                    
                    <!-- Event Select -->
                    <select name="event_id" onchange="this.form.submit()" class="bg-gray-50 border border-gray-200 text-xs font-semibold text-gray-700 rounded-xl px-3 py-2.5 outline-none focus:border-[#340C6F]">
                        <option value="All">All Events ({{ $events->count() }})</option>
                        @foreach($events as $e)
                            <option value="{{ $e->id }}" {{ request('event_id') == $e->id ? 'selected' : '' }}>{{ $e->title }}</option>
                        @endforeach
                    </select>

                    <!-- Status Filter -->
                    <select name="status_filter" onchange="this.form.submit()" class="bg-gray-50 border border-gray-200 text-xs font-semibold text-gray-700 rounded-xl px-3 py-2.5 outline-none focus:border-[#340C6F]">
                        <option value="">All Students</option>
                        <option value="with_marks" {{ request('status_filter') == 'with_marks' ? 'selected' : '' }}>With Marks Entered</option>
                        <option value="without_marks" {{ request('status_filter') == 'without_marks' ? 'selected' : '' }}>Pending Marks</option>
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
                    @if(request('event_id') || request('search') || request('status_filter'))
                        <a href="{{ route('admin.marks.index', ['tab' => 'students']) }}" class="px-3 py-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-600 text-xs font-bold transition-all">
                            Reset
                        </a>
                    @endif
                </form>

                <!-- Bulk Certificate Action Buttons -->
                <div class="flex flex-wrap items-center gap-2">
                    <form method="POST" action="{{ route('admin.marks.bulk-certificate') }}">
                        @csrf
                        <input type="hidden" name="event_id" value="{{ request('event_id') }}">
                        <input type="hidden" name="enable" value="1">
                        <button type="submit" onclick="return confirm('Enable certificates for all matching students in this event?')" class="px-3.5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-sm transition-all flex items-center gap-1.5 cursor-pointer">
                            <i class="fa-solid fa-certificate"></i>
                            <span>Enable All Certs</span>
                        </button>
                    </form>

                    <form method="POST" action="{{ route('admin.marks.bulk-certificate') }}">
                        @csrf
                        <input type="hidden" name="event_id" value="{{ request('event_id') }}">
                        <input type="hidden" name="enable" value="0">
                        <button type="submit" onclick="return confirm('Disable certificates for all matching students in this event?')" class="px-3.5 py-2 rounded-xl bg-slate-600 hover:bg-slate-700 text-white font-bold text-xs shadow-sm transition-all flex items-center gap-1.5 cursor-pointer">
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
                            <th class="py-4 px-4">Event & Cutoff</th>
                            <th class="py-4 px-4">Marks (Score)</th>
                            <th class="py-4 px-4">Rank / Merit</th>
                            <th class="py-4 px-4">Cutoff Status</th>
                            <th class="py-4 px-4">Certificate</th>
                            <th class="py-4 px-6 text-right">View / Preview</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-xs">
                        @forelse($registrations as $reg)
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
                                    <div class="text-[10px] text-gray-500 font-semibold mt-1">
                                        Cutoff: <span class="font-bold text-amber-700">{{ $reg->event && $reg->event->cutoff_marks !== null ? $reg->event->cutoff_marks : 'Not Set' }}</span>
                                    </div>
                                </td>

                                <!-- Inline Marks Edit Form -->
                                <td class="py-4 px-4">
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
                                </td>

                                <td class="py-4 px-4">
                                        <input type="text" name="rank" value="{{ old('rank', $reg->rank) }}" placeholder="e.g. 1st / Merit" form="form-marks-{{ $reg->id }}"
                                            class="w-28 bg-gray-50 border border-gray-200 rounded-lg px-2.5 py-1.5 text-xs font-bold text-gray-800 focus:bg-white focus:border-[#340C6F] outline-none">
                                    </form>
                                </td>

                                <!-- Qualification Status Badge -->
                                <td class="py-4 px-4">
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
