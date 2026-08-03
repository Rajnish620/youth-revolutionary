@extends('layouts.admin')

@section('title', 'Edit Competition - Admin Panel')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Header Section -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Edit Competition</h1>
            <p class="text-xs text-gray-500 mt-1">Update details for competition: {{ $competition->title }}</p>
        </div>
        <a href="{{ route('admin.competitions.index') }}" class="px-4 py-2 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold text-xs transition-all flex items-center gap-2">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Back to List</span>
        </a>
    </div>

    <!-- Form Container -->
    <div class="bg-white p-8 rounded-2xl border border-gray-200/80 shadow-sm">
        <form method="POST" action="{{ route('admin.competitions.update', $competition->id) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Title -->
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Competition Title *</label>
                    <input type="text" name="title" value="{{ old('title', $competition->title) }}" required
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:border-[#340C6F] focus:ring-2 focus:ring-[#340C6F]/20 outline-none transition-all">
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category -->
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Category *</label>
                    <select name="category" required
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:border-[#340C6F] focus:ring-2 focus:ring-[#340C6F]/20 outline-none transition-all">
                        <option value="education" {{ old('category', $competition->category) == 'education' ? 'selected' : '' }}>🎓 Education</option>
                        <option value="sports" {{ old('category', $competition->category) == 'sports' ? 'selected' : '' }}>⚽ Sports</option>
                        <option value="cultural" {{ old('category', $competition->category) == 'cultural' ? 'selected' : '' }}>🎭 Cultural</option>
                    </select>
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Status *</label>
                    <select name="status" required
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:border-[#340C6F] focus:ring-2 focus:ring-[#340C6F]/20 outline-none transition-all">
                        <option value="upcoming" {{ old('status', $competition->status) == 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                        <option value="active" {{ old('status', $competition->status) == 'active' ? 'selected' : '' }}>Active / Live</option>
                        <option value="completed" {{ old('status', $competition->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>

                <!-- Start Date -->
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Start Date</label>
                    <input type="date" name="start_date" value="{{ old('start_date', $competition->start_date ? $competition->start_date->format('Y-m-d') : '') }}"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:border-[#340C6F] outline-none transition-all">
                </div>

                <!-- End Date -->
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">End Date</label>
                    <input type="date" name="end_date" value="{{ old('end_date', $competition->end_date ? $competition->end_date->format('Y-m-d') : '') }}"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:border-[#340C6F] outline-none transition-all">
                </div>

                <!-- Fee -->
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Registration Fee (₹) *</label>
                    <input type="number" step="0.01" name="registration_fee" value="{{ old('registration_fee', $competition->registration_fee) }}" required
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:border-[#340C6F] outline-none transition-all">
                </div>

                <!-- Image URL -->
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Image URL / Cover Path</label>
                    <input type="text" name="image" value="{{ old('image', $competition->image) }}"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:border-[#340C6F] outline-none transition-all">
                </div>

                <!-- Description -->
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Description</label>
                    <textarea name="description" rows="4"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:border-[#340C6F] outline-none transition-all">{{ old('description', $competition->description) }}</textarea>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-end gap-3 border-t border-gray-100 pt-6">
                <a href="{{ route('admin.competitions.index') }}" class="px-5 py-2.5 rounded-xl border border-gray-200 text-gray-600 hover:bg-gray-50 text-sm font-semibold transition-all">Cancel</a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#340C6F] hover:bg-purple-900 text-white font-bold text-sm shadow-md transition-all">Update Competition</button>
            </div>
        </form>
    </div>

</div>
@endsection
