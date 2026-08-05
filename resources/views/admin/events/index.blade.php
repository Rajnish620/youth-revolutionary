@extends('layouts.admin')

@section('title', 'Events Management - Admin Panel')

@section('content')
<div class="space-y-6">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Events Management</h1>
            <p class="text-xs text-gray-500 mt-1">Manage all upcoming, ongoing, and featured youth events</p>
        </div>
        <button onclick="window.dispatchEvent(new CustomEvent('open-modal', {detail: 'add-event'}))" class="px-5 py-2.5 rounded-xl bg-[#F1400C] hover:bg-orange-600 text-white font-bold text-sm shadow-lg shadow-[#F1400C]/30 transition-all flex items-center gap-2 self-start sm:self-auto cursor-pointer">
            <i class="fa-solid fa-plus text-xs"></i>
            <span>Add New Event</span>
        </button>
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
        <form method="GET" action="{{ route('admin.events.index') }}" class="flex flex-wrap items-center gap-3 w-full md:w-auto" id="filter-form">
            @if(request('search')) <input type="hidden" name="search" value="{{ request('search') }}"> @endif
            
            <select name="category" onchange="document.getElementById('filter-form').submit()" class="bg-gray-50 border border-gray-200 text-xs font-semibold text-gray-700 rounded-xl px-3 py-2 outline-none focus:border-[#340C6F] focus:ring-1 focus:ring-[#340C6F]/20">
                <option value="All">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->name }}" {{ request('category') == $cat->name ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>

            <select name="season" onchange="document.getElementById('filter-form').submit()" class="bg-gray-50 border border-gray-200 text-xs font-semibold text-gray-700 rounded-xl px-3 py-2 outline-none focus:border-[#340C6F] focus:ring-1 focus:ring-[#340C6F]/20">
                <option value="All">All Seasons</option>
                @foreach($seasons as $season)
                    <option value="{{ $season->name }}" {{ request('season') == $season->name ? 'selected' : '' }}>{{ $season->name }}</option>
                @endforeach
            </select>
        </form>

        <!-- Search Form -->
        <form method="GET" action="{{ route('admin.events.index') }}" class="relative w-full md:w-72">
            @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif
            @if(request('season')) <input type="hidden" name="season" value="{{ request('season') }}"> @endif
            
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search events..." 
                class="w-full bg-gray-100/80 text-xs pl-9 pr-4 py-2.5 rounded-xl border border-transparent focus:border-[#340C6F] focus:bg-white outline-none transition-all">
            <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-gray-400 text-xs"></i>
        </form>
    </div>

    <!-- Events Table -->
    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/70 border-b border-gray-100 text-[11px] font-bold text-gray-400 uppercase tracking-wider">
                        <th class="py-4 px-6">Event</th>
                        <th class="py-4 px-6">Category</th>
                        <th class="py-4 px-6">Location</th>
                        <th class="py-4 px-6">Date</th>
                        <th class="py-4 px-6">Status</th>
                        <th class="py-4 px-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse($events as $event)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <img src="{{ str_starts_with($event->image ?? '', 'http') ? $event->image : ($event->image ? asset('storage/' . $event->image) : asset('images/quize.jpg')) }}" 
                                         alt="Cover" class="w-12 h-12 rounded-xl object-cover border border-gray-200 bg-gray-50">
                                    <div>
                                        <div class="font-bold text-gray-900 line-clamp-1 flex items-center gap-1.5">
                                            <span>{{ $event->title }}</span>
                                            @if($event->is_featured)
                                                <span class="text-xs text-amber-500" title="Featured Event"><i class="fa-solid fa-star"></i></span>
                                            @endif
                                        </div>
                                        <div class="text-xs text-gray-400 truncate max-w-xs">{{ $event->description }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6 font-semibold text-xs text-gray-700">
                                <span class="px-2.5 py-1 rounded-lg bg-purple-50 text-[#340C6F] border border-purple-100">{{ $event->category }}</span>
                            </td>
                            <td class="py-4 px-6 text-xs text-gray-600 font-medium">
                                <i class="fa-solid fa-location-dot text-red-500 mr-1"></i> {{ $event->location }}
                            </td>
                            <td class="py-4 px-6 text-xs text-gray-500 font-medium">
                                @if($event->event_date)
                                    <span class="text-gray-900 font-bold"><i class="fa-regular fa-calendar-check text-emerald-600 mr-1"></i>{{ $event->event_date->format('M d, Y') }}</span>
                                @elseif($event->start_event_date)
                                    <span class="text-gray-900 font-bold">{{ $event->start_event_date->format('M d, Y') }}</span>
                                @else
                                    <span class="text-gray-400 font-normal">TBD</span>
                                @endif
                            </td>
                            <td class="py-4 px-6">
                                @if($event->status === 'upcoming')
                                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700 flex items-center gap-1.5 w-max">
                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span> Upcoming
                                    </span>
                                @elseif($event->status === 'ongoing')
                                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700 flex items-center gap-1.5 w-max">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span> Ongoing
                                    </span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-600 flex items-center gap-1.5 w-max">
                                        Completed
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.groups.index', ['event_id' => $event->id]) }}" class="px-2.5 py-1 rounded-lg bg-orange-50 hover:bg-orange-500 hover:text-white text-[#F1400C] text-xs font-bold transition-all border border-orange-200" title="Manage Class Groups & Fees">
                                        <i class="fa-solid fa-layer-group text-xs"></i> Groups
                                    </a>

                                    <button onclick="window.dispatchEvent(new CustomEvent('open-modal', {detail: 'edit-event-{{ $event->id }}'}))" 
                                       class="w-8 h-8 rounded-lg bg-gray-100 hover:bg-[#340C6F] hover:text-white text-gray-600 flex items-center justify-center transition-all cursor-pointer" title="Edit">
                                        <i class="fa-solid fa-pen-to-square text-xs"></i>
                                    </button>

                                    <!-- Edit Event Modal -->
                                    <x-modal name="edit-event-{{ $event->id }}" title="Edit Event" maxWidth="2xl">
                                        @include('admin.modals.edit-event', ['event' => $event])
                                    </x-modal>

                                    <form method="POST" action="{{ route('admin.events.destroy', $event->id) }}" onsubmit="return confirm('Delete this event?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-8 h-8 rounded-lg bg-gray-100 hover:bg-red-500 hover:text-white text-gray-600 flex items-center justify-center transition-all" title="Delete">
                                            <i class="fa-solid fa-trash text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-gray-400 text-sm">
                                No events found. Click "Add New Event" to create one.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($events->hasPages())
            <div class="p-4 border-t border-gray-100">
                {{ $events->links() }}
            </div>
        @endif
    </div>

    <!-- Add Event Modal Component -->
    <x-modal name="add-event" title="Add New Event" maxWidth="2xl">
        @include('admin.modals.add-event')
    </x-modal>

</div>
@endsection
