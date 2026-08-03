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
        <div class="flex flex-wrap items-center gap-3">
            <a href="{{ route('admin.registrations.signature-sheet', ['event_id' => request('event_id')]) }}" target="_blank" 
                class="px-4 py-2.5 rounded-xl bg-[#340C6F] hover:bg-purple-900 text-white font-bold text-xs shadow-md transition-all flex items-center gap-2">
                <i class="fa-solid fa-print text-xs"></i>
                <span>Print Attendance Sheet</span>
            </a>
            <a href="{{ route('admin.registrations.desk-slips', ['event_id' => request('event_id')]) }}" target="_blank" 
                class="px-4 py-2.5 rounded-xl bg-[#F1400C] hover:bg-orange-600 text-white font-bold text-xs shadow-md transition-all flex items-center gap-2">
                <i class="fa-solid fa-ticket text-xs"></i>
                <span>Print Desk Slips</span>
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
            <!-- Event Filter -->
            <select name="event_id" onchange="this.form.submit()" class="bg-gray-50 border border-gray-200 text-xs font-semibold text-gray-700 rounded-xl px-3 py-2 outline-none">
                <option value="All">All Events</option>
                @foreach($events as $e)
                    <option value="{{ $e->id }}" {{ request('event_id') == $e->id ? 'selected' : '' }}>{{ $e->title }}</option>
                @endforeach
            </select>

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
            @if(request('event_id')) <input type="hidden" name="event_id" value="{{ request('event_id') }}"> @endif
            @if(request('status')) <input type="hidden" name="status" value="{{ request('status') }}"> @endif
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name, roll no, school..." 
                class="w-full bg-gray-100/80 text-xs pl-9 pr-4 py-2.5 rounded-xl border border-transparent focus:border-[#340C6F] focus:bg-white outline-none transition-all">
            <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-gray-400 text-xs"></i>
        </form>
    </div>

    <!-- Student Registrations Data Table -->
    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm overflow-hidden" x-data="{ activeSS: null }">
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
                                        <div class="font-extrabold text-gray-900 flex items-center gap-2">
                                            <span>{{ $reg->student_name }}</span>
                                            <span class="text-[10px] font-mono font-bold px-2 py-0.5 rounded bg-purple-100 text-[#340C6F]">{{ $reg->roll_no }}</span>
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
                                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700 flex items-center gap-1.5 w-max">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Approved
                                    </span>
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
                                    @if($reg->payment_status !== 'approved')
                                        <form method="POST" action="{{ route('admin.registrations.approve', $reg->id) }}">
                                            @csrf
                                            <button type="submit" class="px-3 py-1 rounded-lg bg-green-500 hover:bg-green-600 text-white text-xs font-bold transition-all shadow-sm flex items-center gap-1" title="Approve Payment">
                                                <i class="fa-solid fa-check text-xs"></i> Approve
                                            </button>
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
            <div class="bg-white p-4 rounded-3xl max-w-md w-full relative">
                <button @click="activeSS = null" class="absolute top-3 right-3 w-8 h-8 rounded-full bg-gray-100 text-gray-600 flex items-center justify-center hover:bg-gray-200">
                    <i class="fa-solid fa-xmark"></i>
                </button>
                <h3 class="font-extrabold text-base text-gray-900 mb-3">Payment Screenshot</h3>
                <img :src="activeSS" class="w-full max-h-[70vh] object-contain rounded-2xl border border-gray-200" />
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
