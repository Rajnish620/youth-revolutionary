@extends('layouts.admin')

@section('title', 'Student Registrations - Admin Panel')

@section('content')
<div class="space-y-6">

    <!-- Header Section & Print Action Buttons -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Student Registrations & Payments</h1>
            <p class="text-xs text-gray-500 mt-1">Review student registrations, verify payment screenshots, and generate event day printouts</p>
        </div>
        <div class="flex flex-wrap items-center gap-2 sm:gap-3">
            <!-- Bulk Admit Card Permission Controls (Approved Only) -->
            <form method="POST" action="{{ route('admin.registrations.bulk-admit-card') }}" onsubmit="return confirm('Kya aap sabhi Approved students ko Admit Card download allow karna chahte hain?')">
                @csrf
                <input type="hidden" name="season" value="{{ request('season') }}">
                <input type="hidden" name="event_id" value="{{ request('event_id') }}">
                <input type="hidden" name="group_id" value="{{ request('group_id') }}">
                <input type="hidden" name="search" value="{{ request('search') }}">
                <input type="hidden" name="enable" value="1">
                <button type="submit" class="px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-md transition-all flex items-center gap-2 cursor-pointer" title="Sabhi Approved students ke liye admit card allow karein">
                    <i class="fa-solid fa-id-card-clip text-sm"></i>
                    <span>All Allow (Admit Cards)</span>
                </button>
            </form>

            <form method="POST" action="{{ route('admin.registrations.bulk-admit-card') }}" onsubmit="return confirm('Kya aap sabhi Approved students ke Admit Card download ko disable (lock) karna chahte hain?')">
                @csrf
                <input type="hidden" name="season" value="{{ request('season') }}">
                <input type="hidden" name="event_id" value="{{ request('event_id') }}">
                <input type="hidden" name="group_id" value="{{ request('group_id') }}">
                <input type="hidden" name="search" value="{{ request('search') }}">
                <input type="hidden" name="enable" value="0">
                <button type="submit" class="px-3.5 py-2.5 rounded-xl bg-gray-600 hover:bg-gray-700 text-white font-bold text-xs shadow-md transition-all flex items-center gap-2 cursor-pointer" title="Sabhi students ke liye admit card download lock karein">
                    <i class="fa-solid fa-lock text-xs"></i>
                    <span>All Disallow</span>
                </button>
            </form>

            <div class="h-6 w-px bg-gray-300 hidden lg:block mx-1"></div>

            <a href="{{ route('admin.registrations.roll-numbers', ['event_id' => request('event_id'), 'group_id' => request('group_id')]) }}" target="_blank" 
                class="px-3.5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-800 text-white font-bold text-xs shadow-md transition-all flex items-center gap-2">
                <i class="fa-solid fa-list-ol text-xs"></i>
                <span>Roll Numbers</span>
            </a>
            <a href="{{ route('admin.registrations.signature-sheet', ['event_id' => request('event_id'), 'group_id' => request('group_id')]) }}" target="_blank" 
                class="px-3.5 py-2.5 rounded-xl bg-[#340C6F] hover:bg-purple-900 text-white font-bold text-xs shadow-md transition-all flex items-center gap-2">
                <i class="fa-solid fa-print text-xs"></i>
                <span>Attendance</span>
            </a>
            <a href="{{ route('admin.registrations.desk-slips', ['event_id' => request('event_id'), 'group_id' => request('group_id')]) }}" target="_blank" 
                class="px-3.5 py-2.5 rounded-xl bg-[#F1400C] hover:bg-orange-600 text-white font-bold text-xs shadow-md transition-all flex items-center gap-2">
                <i class="fa-solid fa-ticket text-xs"></i>
                <span>Desk Slips</span>
            </a>
        </div>
    </div>

    <!-- Alert Flash Messages -->
    @if(session('success'))
        <div class="p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 text-sm font-semibold flex items-center gap-2">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Filters Bar -->
    <div class="bg-white p-4 rounded-2xl border border-gray-200/80 shadow-sm flex flex-col md:flex-row items-center justify-between gap-4">
        <form method="GET" action="{{ route('admin.registrations.index') }}" class="flex flex-wrap items-center gap-3 w-full md:w-auto">
            <!-- Season Filter -->
            <select name="season" onchange="this.form.event_id.value='All'; this.form.submit()" class="bg-gray-50 border border-gray-200 text-xs font-semibold text-gray-700 rounded-xl px-3 py-2 outline-none">
                <option value="All">All Seasons</option>
                @foreach($seasons as $s)
                    <option value="{{ $s->name }}" {{ request('season') == $s->name ? 'selected' : '' }}>{{ $s->name }}</option>
                @endforeach
            </select>

            <!-- Event Filter -->
            <select name="event_id" onchange="this.form.submit()" class="bg-gray-50 border border-gray-200 text-xs font-semibold text-gray-700 rounded-xl px-3 py-2 outline-none">
                <option value="All">All Events</option>
                @foreach($events as $e)
                    <option value="{{ $e->id }}" {{ request('event_id') == $e->id ? 'selected' : '' }}>{{ $e->title }}</option>
                @endforeach
            </select>

            <!-- Group Filter -->
            @if(request('event_id') && request('event_id') !== 'All')
            <select name="group_id" onchange="this.form.submit()" class="bg-gray-50 border border-gray-200 text-xs font-semibold text-gray-700 rounded-xl px-3 py-2 outline-none max-w-[200px] truncate">
                <option value="All">All Groups</option>
                @foreach($groups as $g)
                    <option value="{{ $g->id }}" {{ request('group_id') == $g->id ? 'selected' : '' }}>{{ $g->group_name }} ({{ $g->registrations_count }} students)</option>
                @endforeach
            </select>
            @endif

            <!-- Status Filter -->
            <select name="status" onchange="this.form.submit()" class="bg-gray-50 border border-gray-200 text-xs font-semibold text-gray-700 rounded-xl px-3 py-2 outline-none">
                <option value="All">All Payment Statuses</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>✅ Approved</option>
                <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>❌ Rejected</option>
            </select>
        </form>

        <!-- Search Form -->
        <form method="GET" action="{{ route('admin.registrations.index') }}" class="relative w-full md:w-72">
            @if(request('season')) <input type="hidden" name="season" value="{{ request('season') }}"> @endif
            @if(request('event_id')) <input type="hidden" name="event_id" value="{{ request('event_id') }}"> @endif
            @if(request('group_id')) <input type="hidden" name="group_id" value="{{ request('group_id') }}"> @endif
            @if(request('status')) <input type="hidden" name="status" value="{{ request('status') }}"> @endif
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name, roll no, school..."  
                class="w-full bg-gray-100/80 text-xs pl-9 pr-4 py-2.5 rounded-xl border border-transparent focus:border-[#340C6F] focus:bg-white outline-none transition-all">
            <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-gray-400 text-xs"></i>
        </form>
    </div>

    <!-- Student Registrations Data Table -->
    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm overflow-hidden" x-data="{ activeSS: null, activeStudent: null }">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/70 border-b border-gray-100 text-[11px] font-bold text-gray-400 uppercase tracking-wider">
                        <th class="py-4 px-6">Roll No / Student</th>
                        <th class="py-4 px-6">Event & Group</th>
                        <th class="py-4 px-6">Class / School</th>
                        <th class="py-4 px-6">Fee Paid</th>
                        <th class="py-4 px-6">Payment SS</th>
                        <th class="py-4 px-6">Status</th>
                        <th class="py-4 px-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse($registrations as $reg)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <img src="{{ str_starts_with($reg->photo, 'http') ? $reg->photo : asset($reg->photo ?? 'images/quize.jpg') }}" 
                                         alt="Student" class="w-10 h-10 rounded-full object-cover border border-gray-200">
                                    <div>
                                        <div class="font-extrabold text-gray-900 flex flex-wrap items-center gap-2">
                                            <span>{{ $reg->student_name }}</span>
                                            <span class="text-[10px] font-mono font-bold px-2 py-0.5 rounded bg-purple-100 text-[#340C6F]" title="Roll Number">{{ $reg->roll_no }}</span>
                                            @if($reg->registration_no)
                                                <span class="text-[10px] font-mono font-bold px-2 py-0.5 rounded bg-indigo-100 text-indigo-700" title="Registration Number">{{ $reg->registration_no }}</span>
                                            @endif
                                        </div>
                                        <div class="text-xs text-gray-400">Mob: {{ $reg->mobile }} | Father: {{ $reg->father_name ?? 'N/A' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <div class="font-bold text-xs text-gray-800 line-clamp-1">{{ $reg->event->title ?? 'N/A' }}</div>
                                <div class="text-[11px] text-[#F1400C] font-semibold mt-0.5">{{ $reg->group->group_name ?? 'General Group' }}</div>
                            </td>
                            <td class="py-4 px-6 text-xs text-gray-600">
                                <div class="font-semibold text-gray-800">{{ $reg->student_class }}</div>
                                <div class="text-gray-400 truncate max-w-xs">{{ $reg->school_name ?? 'Private' }}</div>
                            </td>
                            <td class="py-4 px-6 text-xs font-bold text-gray-900">
                                ₹{{ number_format($reg->fee_paid, 2) }}
                            </td>
                            <td class="py-4 px-6">
                                @if($reg->payment_screenshot)
                                    <button @click="activeSS = '{{ str_starts_with($reg->payment_screenshot, 'http') ? $reg->payment_screenshot : asset($reg->payment_screenshot) }}'"
                                        class="px-3 py-1 rounded-lg bg-blue-50 hover:bg-blue-100 text-blue-600 text-xs font-semibold border border-blue-200 transition-all flex items-center gap-1">
                                        <i class="fa-solid fa-image text-xs"></i> View SS
                                    </button>
                                @else
                                    <span class="text-xs text-gray-400 italic">No SS</span>
                                @endif
                            </td>
                            <td class="py-4 px-6">
                                @if($reg->payment_status === 'approved')
                                    <div class="space-y-1">
                                        <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700 flex items-center gap-1.5 w-max">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Approved
                                        </span>
                                        @if($reg->is_admit_card_allowed)
                                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-blue-50 text-blue-700 border border-blue-200 flex items-center gap-1 w-max">
                                                <i class="fa-solid fa-id-card text-[9px]"></i> Admit Card Allowed
                                            </span>
                                        @else
                                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-gray-100 text-gray-500 border border-gray-200 flex items-center gap-1 w-max">
                                                <i class="fa-solid fa-lock text-[9px]"></i> Admit Card Locked
                                            </span>
                                        @endif
                                    </div>
                                @elseif($reg->payment_status === 'pending')
                                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-700 flex items-center gap-1.5 w-max animate-pulse">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Pending
                                    </span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700 flex items-center gap-1.5 w-max">
                                        Rejected
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button @click='activeStudent = {{ json_encode([
                                        "roll_no" => $reg->roll_no,
                                        "registration_no" => $reg->registration_no,
                                        "transaction_id" => $reg->transaction_id ?? "N/A",
                                        "student_name" => $reg->student_name,
                                        "dob" => $reg->dob ? \Carbon\Carbon::parse($reg->dob)->format("d M Y") : "N/A",
                                        "father_name" => $reg->father_name ?? "N/A",
                                        "school_name" => $reg->school_name ?? "N/A",
                                        "student_class" => $reg->student_class,
                                        "mobile" => $reg->mobile,
                                        "fee_paid" => $reg->fee_paid,
                                        "event_title" => $reg->event->title ?? "N/A",
                                        "group_name" => $reg->group->group_name ?? "General Group",
                                        "payment_status" => $reg->payment_status,
                                        "photo" => str_starts_with($reg->photo, "http") ? $reg->photo : asset($reg->photo ?? "images/quize.jpg")
                                    ], JSON_HEX_APOS | JSON_HEX_QUOT) }}' class="w-8 h-8 rounded-lg bg-gray-100 hover:bg-blue-500 hover:text-white text-gray-500 flex items-center justify-center transition-all" title="View Details">
                                        <i class="fa-solid fa-eye text-xs"></i>
                                    </button>

                                    @if($reg->payment_status !== 'approved')
                                        <form method="POST" action="{{ route('admin.registrations.approve', $reg->id) }}">
                                            @csrf
                                            <button type="submit" class="px-3 py-1 rounded-lg bg-green-500 hover:bg-green-600 text-white text-xs font-bold transition-all shadow-sm flex items-center gap-1" title="Approve Payment">
                                                <i class="fa-solid fa-check text-xs"></i> Approve
                                            </button>
                                        </form>
                                    @else
                                        <form method="POST" action="{{ route('admin.registrations.toggle-admit-card', $reg->id) }}">
                                            @csrf
                                            @if($reg->is_admit_card_allowed)
                                                <button type="submit" class="px-3 py-1 rounded-lg bg-red-100 hover:bg-red-200 text-red-700 text-xs font-bold transition-all shadow-sm flex items-center gap-1" title="Disable Admit Card">
                                                    <i class="fa-solid fa-lock text-xs"></i> Disallow
                                                </button>
                                            @else
                                                <button type="submit" class="px-3 py-1 rounded-lg bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold transition-all shadow-sm flex items-center gap-1" title="Allow Admit Card">
                                                    <i class="fa-solid fa-id-card text-xs"></i> Allow
                                                </button>
                                            @endif
                                        </form>
                                    @endif

                                    @if($reg->payment_status !== 'rejected')
                                        <form method="POST" action="{{ route('admin.registrations.reject', $reg->id) }}">
                                            @csrf
                                            <button type="submit" class="px-2 py-1 rounded-lg bg-gray-100 hover:bg-red-50 text-red-600 hover:text-red-700 text-xs font-semibold transition-all" title="Reject Payment">
                                                Reject
                                            </button>
                                        </form>
                                    @endif

                                    <form method="POST" action="{{ route('admin.registrations.destroy', $reg->id) }}" onsubmit="return confirm('Delete this student registration?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-8 h-8 rounded-lg bg-gray-100 hover:bg-red-500 hover:text-white text-gray-500 flex items-center justify-center transition-all" title="Delete Registration">
                                            <i class="fa-solid fa-trash text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-gray-400 text-sm">
                                No student registrations found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Payment Screenshot Preview Modal -->
        <div x-show="activeSS !== null" style="display: none;" 
            class="fixed inset-0 z-50 bg-black/80 backdrop-blur-sm flex items-center justify-center p-4">
            <div @click.away="activeSS = null" class="bg-white p-4 rounded-3xl max-w-md w-full relative">
                <button @click="activeSS = null" class="absolute top-3 right-3 w-8 h-8 rounded-full bg-gray-100 text-gray-600 flex items-center justify-center hover:bg-gray-200">
                    <i class="fa-solid fa-xmark"></i>
                </button>
                <h3 class="font-extrabold text-base text-gray-900 mb-3">Payment Screenshot</h3>
                <img :src="activeSS" class="w-full max-h-[70vh] object-contain rounded-2xl border border-gray-200" />
            </div>
        </div>

        <!-- Student Details Modal -->
        <div x-show="activeStudent !== null" style="display: none;" 
            class="fixed inset-0 z-50 bg-black/80 backdrop-blur-sm flex items-center justify-center p-4">
            <div @click.away="activeStudent = null" class="bg-white p-6 rounded-3xl max-w-lg w-full relative shadow-2xl">
                <button @click="activeStudent = null" class="absolute top-4 right-4 w-8 h-8 rounded-full bg-gray-100 text-gray-600 flex items-center justify-center hover:bg-gray-200 transition-colors">
                    <i class="fa-solid fa-xmark"></i>
                </button>
                
                <div class="flex items-center gap-4 mb-6">
                    <img :src="activeStudent?.photo" alt="Student" class="w-16 h-16 rounded-full object-cover border-2 border-[#340C6F]">
                    <div>
                        <h3 class="font-extrabold text-xl text-gray-900" x-text="activeStudent?.student_name"></h3>
                        <div class="flex flex-wrap gap-2 mt-1">
                            <span class="text-xs font-mono font-bold px-2.5 py-1 rounded-md bg-purple-100 text-[#340C6F]" x-text="activeStudent?.roll_no" title="Roll Number"></span>
                            <template x-if="activeStudent?.registration_no">
                                <span class="text-xs font-mono font-bold px-2.5 py-1 rounded-md bg-indigo-100 text-indigo-700" x-text="activeStudent?.registration_no" title="Registration Number"></span>
                            </template>
                        </div>
                    </div>
                </div>
                
                <div class="space-y-4 text-sm">
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                        <div class="bg-gray-50 p-3 rounded-xl border border-gray-100">
                            <div class="text-xs text-gray-400 font-semibold mb-1">Father's Name</div>
                            <div class="font-bold text-gray-800" x-text="activeStudent?.father_name"></div>
                        </div>
                        <div class="bg-gray-50 p-3 rounded-xl border border-gray-100">
                            <div class="text-xs text-gray-400 font-semibold mb-1">DOB</div>
                            <div class="font-bold text-gray-800" x-text="activeStudent?.dob"></div>
                        </div>
                        <div class="bg-gray-50 p-3 rounded-xl border border-gray-100">
                            <div class="text-xs text-gray-400 font-semibold mb-1">Mobile No</div>
                            <div class="font-bold text-gray-800" x-text="activeStudent?.mobile"></div>
                        </div>
                        <div class="bg-gray-50 p-3 rounded-xl border border-gray-100 sm:col-span-3">
                            <div class="text-xs text-gray-400 font-semibold mb-1">Transaction ID / UTR</div>
                            <div class="font-mono text-sm font-bold text-indigo-700 bg-indigo-50 px-2 py-1 rounded inline-block" x-text="activeStudent?.transaction_id"></div>
                        </div>
                        <div class="bg-gray-50 p-3 rounded-xl border border-gray-100">
                            <div class="text-xs text-gray-400 font-semibold mb-1">Class</div>
                            <div class="font-bold text-gray-800" x-text="activeStudent?.student_class"></div>
                        </div>
                        <div class="bg-gray-50 p-3 rounded-xl border border-gray-100">
                            <div class="text-xs text-gray-400 font-semibold mb-1">School</div>
                            <div class="font-bold text-gray-800 line-clamp-2" x-text="activeStudent?.school_name"></div>
                        </div>
                    </div>
                    
                    <div class="bg-[#340C6F]/5 p-4 rounded-xl border border-[#340C6F]/10">
                        <div class="flex justify-between items-center mb-2">
                            <div class="text-xs text-[#340C6F] font-bold">Event Details</div>
                            <div class="text-xs font-bold" :class="activeStudent?.payment_status === 'approved' ? 'text-green-600' : (activeStudent?.payment_status === 'pending' ? 'text-amber-600' : 'text-red-600')">
                                Status: <span class="capitalize" x-text="activeStudent?.payment_status"></span>
                            </div>
                        </div>
                        <div class="font-bold text-gray-900" x-text="activeStudent?.event_title"></div>
                        <div class="flex justify-between mt-1 text-sm">
                            <div class="text-[#F1400C] font-semibold" x-text="activeStudent?.group_name"></div>
                            <div class="font-bold text-gray-900">Fee: ₹<span x-text="activeStudent?.fee_paid"></span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        @if($registrations->hasPages())
            <div class="p-4 border-t border-gray-100">
                {{ $registrations->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
