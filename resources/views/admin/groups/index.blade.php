@extends('layouts.admin')

@section('title', 'Event Class Groups & Fees - Admin Panel')

@section('content')
<div class="space-y-6">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight flex items-center gap-2">
                <i class="fa-solid fa-layer-group text-[#F1400C]"></i>
                <span>Event Groups & Fee Tiers</span>
            </h1>
            <p class="text-xs text-gray-500 mt-1">Define class-wise groups (e.g. Group A: Class 5th & 6th) and custom registration fees for each event</p>
        </div>
        <button onclick="window.dispatchEvent(new CustomEvent('open-modal', {detail: 'add-group'}))" class="px-5 py-2.5 rounded-xl bg-[#F1400C] hover:bg-orange-600 text-white font-bold text-sm shadow-lg shadow-[#F1400C]/30 transition-all flex items-center gap-2 self-start sm:self-auto cursor-pointer">
            <i class="fa-solid fa-plus text-xs"></i>
            <span>Create New Class Group</span>
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
        <form method="GET" action="{{ route('admin.groups.index') }}" class="flex flex-wrap items-center gap-3 w-full md:w-auto">
            <select name="season" onchange="this.form.event_id.value='All'; this.form.submit()" class="bg-gray-50 border border-gray-200 text-xs font-semibold text-gray-700 rounded-xl px-3 py-2 outline-none">
                <option value="All">All Seasons</option>
                @foreach($seasons as $s)
                    <option value="{{ $s->name }}" {{ request('season') == $s->name ? 'selected' : '' }}>{{ $s->name }}</option>
                @endforeach
            </select>
            <select name="event_id" onchange="this.form.submit()" class="bg-gray-50 border border-gray-200 text-xs font-semibold text-gray-700 rounded-xl px-3 py-2 outline-none">
                <option value="All">All Events</option>
                @foreach($events as $e)
                    <option value="{{ $e->id }}" {{ request('event_id') == $e->id ? 'selected' : '' }}>{{ $e->title }}</option>
                @endforeach
            </select>
        </form>

        <form method="GET" action="{{ route('admin.groups.index') }}" class="relative w-full md:w-72">
            @if(request('season')) <input type="hidden" name="season" value="{{ request('season') }}"> @endif
            @if(request('event_id')) <input type="hidden" name="event_id" value="{{ request('event_id') }}"> @endif
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search group or class..." 
                class="w-full bg-gray-100/80 text-xs pl-9 pr-4 py-2.5 rounded-xl border border-transparent focus:border-[#340C6F] focus:bg-white outline-none transition-all">
            <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-gray-400 text-xs"></i>
        </form>
    </div>

    <!-- Groups Data Table -->
    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/70 border-b border-gray-100 text-[11px] font-bold text-gray-400 uppercase tracking-wider">
                        <th class="py-4 px-6">Event</th>
                        <th class="py-4 px-6">Group Name</th>
                        <th class="py-4 px-6">Included Classes</th>
                        <th class="py-4 px-6">Registration Fee</th>
                        <th class="py-4 px-6">Capacity</th>
                        <th class="py-4 px-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse($groups as $grp)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="py-4 px-6 font-extrabold text-xs text-[#340C6F]">
                                <i class="fa-solid fa-calendar-days text-[#340C6F] mr-1.5"></i>
                                {{ $grp->event->title ?? 'General Event' }}
                            </td>
                            <td class="py-4 px-6 font-extrabold text-sm text-gray-900">
                                <i class="fa-solid fa-users-rectangle text-purple-600 mr-1.5"></i>
                                {{ $grp->group_name }}
                            </td>
                            <td class="py-4 px-6 text-xs text-gray-600 font-semibold">
                                <span class="px-2.5 py-1 rounded-lg bg-orange-50 text-[#F1400C] border border-orange-100">
                                    <i class="fa-solid fa-graduation-cap mr-1"></i> {{ $grp->class_range ?? 'All Classes' }}
                                </span>
                            </td>
                            <td class="py-4 px-6 font-extrabold text-sm text-green-700">
                                ₹{{ number_format($grp->fee, 2) }}
                            </td>
                            <td class="py-4 px-6 text-xs text-gray-500 font-medium">
                                <i class="fa-solid fa-user-group text-gray-400 mr-1"></i>
                                {{ $grp->max_participants ? $grp->max_participants . ' Max Students' : 'Unlimited' }}
                            </td>
                            <td class="py-4 px-6 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button onclick="window.dispatchEvent(new CustomEvent('open-modal', {detail: 'edit-group-{{ $grp->id }}'}))" 
                                       class="w-8 h-8 rounded-lg bg-gray-100 hover:bg-[#340C6F] hover:text-white text-gray-600 flex items-center justify-center transition-all cursor-pointer" title="Edit Group">
                                        <i class="fa-solid fa-pen-to-square text-xs"></i>
                                    </button>

                                    <!-- Edit Group Modal -->
                                    <x-modal name="edit-group-{{ $grp->id }}" title="Edit Class Group Tier" maxWidth="lg">
                                        @include('admin.modals.edit-group', ['group' => $grp])
                                    </x-modal>

                                    <form method="POST" action="{{ route('admin.groups.destroy', $grp->id) }}" onsubmit="return confirm('Delete this group tier?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-8 h-8 rounded-lg bg-gray-100 hover:bg-red-500 hover:text-white text-gray-500 flex items-center justify-center transition-all" title="Delete Group">
                                            <i class="fa-solid fa-trash text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-gray-400 text-sm">
                                No event groups found. Click "Create New Class Group" to add class-wise fee tiers.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($groups->hasPages())
            <div class="p-4 border-t border-gray-100">
                {{ $groups->links() }}
            </div>
        @endif
    </div>

    <!-- Add Group Modal Component -->
    <x-modal name="add-group" title="Create Class Group & Fee Tier" maxWidth="lg">
        @include('admin.modals.add-group')
    </x-modal>

</div>
@endsection
