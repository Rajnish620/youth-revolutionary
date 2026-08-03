@extends('layouts.admin')

@section('title', 'Competitions Management - Admin Panel')

@section('content')
<div class="space-y-6">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Competitions Management</h1>
            <p class="text-xs text-gray-500 mt-1">Manage and organize all youth competition programs across categories</p>
        </div>
        <button onclick="window.dispatchEvent(new CustomEvent('open-modal', {detail: 'create-competition'}))" class="px-5 py-2.5 rounded-xl bg-[#F1400C] hover:bg-orange-600 text-white font-bold text-sm shadow-lg shadow-[#F1400C]/30 transition-all flex items-center gap-2 self-start sm:self-auto cursor-pointer">
            <i class="fa-solid fa-plus text-xs"></i>
            <span>Add Competition</span>
        </button>
    </div>

    <!-- Alert Flash Messages -->
    @if(session('success'))
        <div class="p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 text-sm font-semibold flex items-center justify-between">
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-circle-check"></i>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <!-- Filters & Search Bar -->
    <div class="bg-white p-4 rounded-2xl border border-gray-200/80 shadow-sm flex flex-col md:flex-row items-center justify-between gap-4">
        <!-- Category Filters -->
        <div class="flex flex-wrap items-center gap-2 w-full md:w-auto">
            <a href="{{ route('admin.competitions.index') }}" 
                class="px-4 py-2 rounded-xl text-xs font-bold transition-all {{ !request('category') ? 'bg-[#340C6F] text-white shadow-md' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                All Categories
            </a>
            <a href="{{ route('admin.competitions.index', ['category' => 'education']) }}" 
                class="px-4 py-2 rounded-xl text-xs font-bold transition-all {{ request('category') == 'education' ? 'bg-[#340C6F] text-white shadow-md' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                🎓 Education
            </a>
            <a href="{{ route('admin.competitions.index', ['category' => 'sports']) }}" 
                class="px-4 py-2 rounded-xl text-xs font-bold transition-all {{ request('category') == 'sports' ? 'bg-[#340C6F] text-white shadow-md' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                ⚽ Sports
            </a>
            <a href="{{ route('admin.competitions.index', ['category' => 'cultural']) }}" 
                class="px-4 py-2 rounded-xl text-xs font-bold transition-all {{ request('category') == 'cultural' ? 'bg-[#340C6F] text-white shadow-md' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                🎭 Cultural
            </a>
        </div>

        <!-- Search Form -->
        <form method="GET" action="{{ route('admin.competitions.index') }}" class="relative w-full md:w-72">
            @if(request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search title..." 
                class="w-full bg-gray-100/80 text-xs pl-9 pr-4 py-2.5 rounded-xl border border-transparent focus:border-[#340C6F] focus:bg-white outline-none transition-all">
            <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-gray-400 text-xs"></i>
        </form>
    </div>

    <!-- Competitions Table -->
    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/70 border-b border-gray-100 text-[11px] font-bold text-gray-400 uppercase tracking-wider">
                        <th class="py-4 px-6">Competition</th>
                        <th class="py-4 px-6">Category</th>
                        <th class="py-4 px-6">Dates</th>
                        <th class="py-4 px-6">Fee</th>
                        <th class="py-4 px-6">Status</th>
                        <th class="py-4 px-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse($competitions as $competition)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $competition->image ?? 'https://images.unsplash.com/photo-1517649763962-0c623266010b?auto=format&fit=crop&q=80&w=200' }}" 
                                         alt="Cover" class="w-12 h-12 rounded-xl object-cover border border-gray-200">
                                    <div>
                                        <div class="font-bold text-gray-900 line-clamp-1">{{ $competition->title }}</div>
                                        <div class="text-xs text-gray-400 truncate max-w-xs">{{ $competition->description }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6 font-semibold capitalize text-xs text-gray-700">
                                @if($competition->category === 'education')
                                    <span class="px-2.5 py-1 rounded-lg bg-blue-50 text-blue-700 border border-blue-100">🎓 Education</span>
                                @elseif($competition->category === 'sports')
                                    <span class="px-2.5 py-1 rounded-lg bg-orange-50 text-orange-700 border border-orange-100">⚽ Sports</span>
                                @else
                                    <span class="px-2.5 py-1 rounded-lg bg-purple-50 text-purple-700 border border-purple-100">🎭 Cultural</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-xs text-gray-500">
                                {{ $competition->start_date ? $competition->start_date->format('M d, Y') : 'N/A' }} 
                                <span class="text-gray-400">to</span> 
                                {{ $competition->end_date ? $competition->end_date->format('M d, Y') : 'N/A' }}
                            </td>
                            <td class="py-4 px-6 font-bold text-xs text-gray-800">
                                {{ $competition->registration_fee > 0 ? '₹' . number_format($competition->registration_fee, 2) : 'Free' }}
                            </td>
                            <td class="py-4 px-6">
                                @if($competition->status === 'active')
                                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700 flex items-center gap-1.5 w-max">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span> Active
                                    </span>
                                @elseif($competition->status === 'upcoming')
                                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700 flex items-center gap-1.5 w-max">
                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span> Upcoming
                                    </span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-600 flex items-center gap-1.5 w-max">
                                        Completed
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button onclick="window.dispatchEvent(new CustomEvent('open-modal', {detail: 'edit-competition-{{ $competition->id }}'}))" 
                                       class="w-8 h-8 rounded-lg bg-gray-100 hover:bg-[#340C6F] hover:text-white text-gray-600 flex items-center justify-center transition-all cursor-pointer" title="Edit">
                                        <i class="fa-solid fa-pen-to-square text-xs"></i>
                                    </button>

                                    <!-- Edit Competition Modal -->
                                    <x-modal name="edit-competition-{{ $competition->id }}" title="Edit Competition" maxWidth="2xl">
                                        @include('admin.modals.edit-competition', ['competition' => $competition])
                                    </x-modal>
                                    <form method="POST" action="{{ route('admin.competitions.destroy', $competition->id) }}" onsubmit="return confirm('Are you sure you want to delete this competition?')">
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
                                No competitions found. Click "Add Competition" to create one.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($competitions->hasPages())
            <div class="p-4 border-t border-gray-100">
                {{ $competitions->links() }}
            </div>
        @endif
    </div>

    <!-- Add Competition Reusable Modal -->
    <x-modal name="create-competition" title="Add New Competition" maxWidth="2xl">
        @include('admin.modals.create-competition')
    </x-modal>

</div>
@endsection
