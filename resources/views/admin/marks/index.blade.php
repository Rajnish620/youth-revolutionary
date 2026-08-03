@extends('layouts.admin')

@section('title', 'Marks & Certificates - Admin Panel')

@section('content')
<div class="space-y-6">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Marks & Certificate Management</h1>
            <p class="text-xs text-gray-500 mt-1">Enter student exam marks, assign ranks/positions, and selectively enable digital certificates</p>
        </div>
        
        <!-- Bulk Certificate Enable / Disable -->
        <div class="flex flex-wrap items-center gap-2">
            <form method="POST" action="{{ route('admin.marks.bulk-certificate') }}">
                @csrf
                <input type="hidden" name="event_id" value="{{ request('event_id') }}">
                <input type="hidden" name="enable" value="1">
                <button type="submit" class="px-4 py-2.5 rounded-xl bg-green-600 hover:bg-green-700 text-white font-bold text-xs shadow-md transition-all flex items-center gap-1.5 cursor-pointer">
                    <i class="fa-solid fa-certificate"></i> Enable All Certificates
                </button>
            </form>

            <form method="POST" action="{{ route('admin.marks.bulk-certificate') }}">
                @csrf
                <input type="hidden" name="event_id" value="{{ request('event_id') }}">
                <input type="hidden" name="enable" value="0">
                <button type="submit" class="px-4 py-2.5 rounded-xl bg-gray-600 hover:bg-gray-700 text-white font-bold text-xs shadow-md transition-all flex items-center gap-1.5 cursor-pointer">
                    <i class="fa-solid fa-[#F1400C]"></i> Disable All Certificates
                </button>
            </form>
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
        <form method="GET" action="{{ route('admin.marks.index') }}" class="flex flex-wrap items-center gap-3 w-full md:w-auto">
            <select name="event_id" onchange="this.form.submit()" class="bg-gray-50 border border-gray-200 text-xs font-semibold text-gray-700 rounded-xl px-3 py-2 outline-none">
                <option value="All">All Events</option>
                @foreach($events as $e)
                    <option value="{{ $e->id }}" {{ request('event_id') == $e->id ? 'selected' : '' }}>{{ $e->title }}</option>
                @endforeach
            </select>
        </form>

        <form method="GET" action="{{ route('admin.marks.index') }}" class="relative w-full md:w-72">
            @if(request('event_id')) <input type="hidden" name="event_id" value="{{ request('event_id') }}"> @endif
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search roll no or student..." 
                class="w-full bg-gray-100/80 text-xs pl-9 pr-4 py-2.5 rounded-xl border border-transparent focus:border-[#340C6F] focus:bg-white outline-none transition-all">
            <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-gray-400 text-xs"></i>
        </form>
    </div>

    <!-- Marks Data Table -->
    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/70 border-b border-gray-100 text-[11px] font-bold text-gray-400 uppercase tracking-wider">
                        <th class="py-4 px-6">Roll No / Student</th>
                        <th class="py-4 px-6">Event & Group</th>
                        <th class="py-4 px-6">Marks (Score)</th>
                        <th class="py-4 px-6">Rank / Position</th>
                        <th class="py-4 px-6">Certificate Setting</th>
                        <th class="py-4 px-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse($registrations as $reg)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="py-4 px-6">
                                <div class="font-extrabold text-gray-900 flex items-center gap-2">
                                    <span>{{ $reg->student_name }}</span>
                                    <span class="text-[10px] font-mono font-bold px-2 py-0.5 rounded bg-purple-100 text-[#340C6F]">{{ $reg->roll_no }}</span>
                                </div>
                                <div class="text-xs text-gray-400">{{ $reg->student_class }} | {{ $reg->school_name ?? 'N/A' }}</div>
                            </td>
                            <td class="py-4 px-6">
                                <div class="font-bold text-xs text-gray-800 line-clamp-1">{{ $reg->event->title ?? 'N/A' }}</div>
                                <div class="text-[11px] text-[#F1400C] font-semibold mt-0.5">{{ $reg->group->group_name ?? 'General Group' }}</div>
                            </td>

                            <!-- Form inline edit marks -->
                            <form method="POST" action="{{ route('admin.marks.update', $reg->id) }}">
                                @csrf
                                <td class="py-4 px-6">
                                    <input type="number" step="0.01" name="marks" value="{{ old('marks', $reg->marks) }}" placeholder="e.g. 94.5"
                                        class="w-24 bg-gray-50 border border-gray-200 rounded-lg px-2.5 py-1.5 text-xs font-bold text-gray-900 focus:bg-white focus:border-[#340C6F] outline-none">
                                </td>
                                <td class="py-4 px-6">
                                    <input type="text" name="rank" value="{{ old('rank', $reg->rank) }}" placeholder="e.g. 1st Position / Merit"
                                        class="w-36 bg-gray-50 border border-gray-200 rounded-lg px-2.5 py-1.5 text-xs font-bold text-gray-900 focus:bg-white focus:border-[#340C6F] outline-none">
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-2">
                                        <button type="submit" class="px-3 py-1.5 rounded-lg bg-[#340C6F] hover:bg-purple-900 text-white text-xs font-bold transition-all shadow-sm">
                                            Save Marks
                                        </button>
                            </form>

                            <!-- Separate Certificate Toggle Form -->
                            <td class="py-4 px-6">
                                @if($reg->certificate_enabled)
                                    <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-green-100 text-green-700 inline-flex items-center gap-1">
                                        <i class="fa-solid fa-circle-check"></i> Enabled
                                    </span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-gray-100 text-gray-500 inline-flex items-center gap-1">
                                        <i class="fa-solid fa-circle-xmark"></i> Disabled
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <!-- Toggle Certificate -->
                                    <form method="POST" action="{{ route('admin.marks.toggle-certificate', $reg->id) }}">
                                        @csrf
                                        <button type="submit" class="px-3 py-1.5 rounded-lg text-xs font-bold transition-all shadow-sm {{ $reg->certificate_enabled ? 'bg-amber-50 text-amber-700 border border-amber-200 hover:bg-amber-100' : 'bg-green-500 text-white hover:bg-green-600' }}">
                                            {{ $reg->certificate_enabled ? 'Disable' : 'Enable Cert' }}
                                        </button>
                                    </form>

                                    <!-- View Certificate -->
                                    <a href="{{ route('certificate.show', $reg->roll_no) }}" target="_blank" 
                                       class="w-8 h-8 rounded-lg bg-gray-100 hover:bg-[#F1400C] hover:text-white text-gray-600 flex items-center justify-center transition-all" title="View Certificate">
                                        <i class="fa-solid fa-award text-xs"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-gray-400 text-sm">
                                No approved student registrations found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($registrations->hasPages())
            <div class="p-4 border-t border-gray-100">
                {{ $registrations->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
