@extends('layouts.admin')

@section('title', 'Gallery Management - Admin Panel')

@section('content')
<!-- Include Caveat Font for Polaroid Captions -->
<link href="https://fonts.googleapis.com/css2?family=Caveat:wght@600;700&display=swap" rel="stylesheet">

<style>
    .admin-polaroid-wall {
        background-color: #f1f5f9;
        background-image: radial-gradient(#cbd5e1 1px, transparent 1px);
        background-size: 20px 20px;
    }

    .admin-polaroid-card {
        background: #ffffff;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.08), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .admin-polaroid-card:hover {
        transform: scale(1.04) rotate(0deg) !important;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.15);
        z-index: 20;
    }

    .polaroid-caption-admin {
        font-family: 'Caveat', cursive;
        font-size: 1.25rem;
        line-height: 1.2;
        color: #1e293b;
    }

    .push-pin-admin {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        position: absolute;
        top: 8px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 20;
        box-shadow: inset -2px -2px 3px rgba(0,0,0,0.3), inset 2px 2px 3px rgba(255,255,255,0.6), 0 2px 4px rgba(0,0,0,0.3);
    }
</style>

<div class="space-y-6">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Gallery Management</h1>
            <p class="text-xs text-gray-500 mt-1">Upload and manage event photos in Polaroid Pinboard style</p>
        </div>
        <button onclick="window.dispatchEvent(new CustomEvent('open-modal', {detail: 'add-gallery'}))" class="px-5 py-2.5 rounded-xl bg-[#F1400C] hover:bg-orange-600 text-white font-bold text-sm shadow-lg shadow-[#F1400C]/30 transition-all flex items-center gap-2 self-start sm:self-auto cursor-pointer">
            <i class="fa-solid fa-plus text-xs"></i>
            <span>Add Photo</span>
        </button>
    </div>

    <!-- Alert Flash Messages -->
    @if(session('success'))
        <div class="p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 text-sm font-semibold flex items-center gap-2">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Category Filter Bar -->
    <div class="bg-white p-4 rounded-2xl border border-gray-200/80 shadow-sm flex flex-col md:flex-row items-center justify-between gap-4">
        
        <form method="GET" action="{{ route('admin.gallery.index') }}" class="flex flex-wrap items-center gap-3 w-full md:w-auto">
            <!-- Season Filter Dropdown -->
            <select name="season_id" onchange="this.form.submit()" class="bg-gray-50 border border-gray-200 text-xs font-semibold text-gray-700 rounded-xl px-3 py-2 outline-none">
                <option value="All">All Photos</option>
                @foreach($seasons as $s)
                    <option value="{{ $s->id }}" {{ request('season_id') == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>
                @endforeach
            </select>
        </form>

        <!-- Search Form -->
        <form method="GET" action="{{ route('admin.gallery.index') }}" class="relative w-full md:w-72">
            @if(request('season_id'))
                <input type="hidden" name="season_id" value="{{ request('season_id') }}">
            @endif
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search title..." 
                class="w-full bg-gray-100/80 text-xs pl-9 pr-4 py-2.5 rounded-xl border border-transparent focus:border-[#340C6F] focus:bg-white outline-none transition-all">
            <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-gray-400 text-xs"></i>
        </form>
    </div>

    <!-- Admin Polaroid Wall Grid Display -->
    <div class="admin-polaroid-wall p-6 rounded-3xl border border-slate-200/80 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        @forelse($galleries as $index => $photo)
            @php
            $tilts = ['-rotate-2', 'rotate-2', '-rotate-1', 'rotate-1', 'rotate-0'];
            $pins = ['bg-red-500', 'bg-pink-500', 'bg-purple-500', 'bg-orange-500', 'bg-indigo-500'];
            $currentTilt = $tilts[$index % 5];
            $currentPin = $pins[$index % 5];
            @endphp
            
            <div class="admin-polaroid-card relative p-3 pb-5 rounded-sm {{ $currentTilt }} flex flex-col justify-between">
                <!-- Push Pin -->
                <div class="push-pin-admin {{ $currentPin }}"></div>

                <!-- Image -->
                <div class="relative overflow-hidden aspect-square bg-gray-100 rounded-sm border border-gray-200/60 shadow-inner mt-2">
                    <img src="{{ str_starts_with($photo->image, 'http') ? $photo->image : asset($photo->image) }}" 
                         alt="{{ $photo->title ?? 'Photo' }}" class="w-full h-full object-cover">
                </div>

                <!-- Caption & Action -->
                <div class="mt-3 text-center">
                    <h4 class="polaroid-caption-admin truncate px-1">{{ $photo->title ?? 'Untitled Photo' }}</h4>
                    
                    <div class="flex items-center justify-between border-t border-gray-100 pt-2 mt-2">
                        <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-gray-100 text-gray-700">{{ $photo->season->name ?? 'No Season' }}</span>
                        
                        <form method="POST" action="{{ route('admin.gallery.destroy', $photo->id) }}" onsubmit="return confirm('Delete this photo from gallery?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-7 h-7 rounded-lg bg-red-50 hover:bg-red-500 hover:text-white text-red-500 flex items-center justify-center transition-all" title="Delete Photo">
                                <i class="fa-solid fa-trash text-xs"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white p-12 rounded-2xl border border-gray-200/80 text-center text-gray-400">
                <i class="fa-solid fa-images text-4xl text-gray-[#340C6F] opacity-30 mb-3 block"></i>
                <p class="font-semibold text-sm">No photos found in gallery.</p>
                <p class="text-xs text-gray-400 mt-1">Click "Add Photo" above to upload photos dynamically in Polaroid style.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($galleries->hasPages())
        <div class="bg-white p-4 rounded-2xl border border-gray-200/80 shadow-sm">
            {{ $galleries->links() }}
        </div>
    @endif

    <!-- Add Gallery Modal Component -->
    <x-modal name="add-gallery" title="Add Photo to Gallery" maxWidth="lg">
        @include('admin.modals.add-gallery')
    </x-modal>

</div>
@endsection
