<form method="POST" action="{{ route('admin.events.update', $event->id) }}" class="space-y-5">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Title -->
        <div class="md:col-span-2">
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Event Title *</label>
            <input type="text" name="title" value="{{ old('title', $event->title) }}" required
                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-[#340C6F] focus:ring-2 focus:ring-[#340C6F]/20 outline-none transition-all">
        </div>

        <!-- Category -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Category *</label>
            <select name="category" required
                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-[#340C6F] focus:ring-2 focus:ring-[#340C6F]/20 outline-none transition-all">
                <option value="Education" {{ old('category', $event->category) == 'Education' ? 'selected' : '' }}>🎓 Education</option>
                <option value="Sports" {{ old('category', $event->category) == 'Sports' ? 'selected' : '' }}>⚽ Sports</option>
                <option value="Cultural" {{ old('category', $event->category) == 'Cultural' ? 'selected' : '' }}>🎭 Cultural</option>
                <option value="General" {{ old('category', $event->category) == 'General' ? 'selected' : '' }}>General</option>
            </select>
        </div>

        <!-- Status -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Status *</label>
            <select name="status" required
                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-[#340C6F] focus:ring-2 focus:ring-[#340C6F]/20 outline-none transition-all">
                <option value="upcoming" {{ old('status', $event->status) == 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                <option value="ongoing" {{ old('status', $event->status) == 'ongoing' ? 'selected' : '' }}>Ongoing / Live</option>
                <option value="completed" {{ old('status', $event->status) == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>

        <!-- Location -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Location *</label>
            <input type="text" name="location" value="{{ old('location', $event->location) }}" required
                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-[#340C6F] outline-none transition-all">
        </div>

        <!-- Event Date -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Event Date</label>
            <input type="date" name="event_date" value="{{ old('event_date', $event->event_date ? $event->event_date->format('Y-m-d') : '') }}"
                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-[#340C6F] outline-none transition-all">
        </div>

        <!-- Image URL -->
        <div class="md:col-span-2">
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Image URL / Path</label>
            <input type="text" name="image" value="{{ old('image', $event->image) }}"
                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-[#340C6F] outline-none transition-all">
        </div>

        <!-- Is Featured Checkbox -->
        <div class="md:col-span-2 flex items-center gap-2">
            <input type="checkbox" name="is_featured" id="is_featured_edit_{{ $event->id }}" value="1" {{ old('is_featured', $event->is_featured) ? 'checked' : '' }} class="rounded border-gray-300 text-[#F1400C] focus:ring-0">
            <label for="is_featured_edit_{{ $event->id }}" class="text-xs font-bold text-gray-700 cursor-pointer">Mark as Featured Event</label>
        </div>

        <!-- Description -->
        <div class="md:col-span-2">
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Description</label>
            <textarea name="description" rows="3"
                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-[#340C6F] outline-none transition-all">{{ old('description', $event->description) }}</textarea>
        </div>
    </div>

    <!-- Modal Controls -->
    <div class="flex items-center justify-end gap-3 border-t border-gray-100 pt-4 mt-2">
        <button type="button" @click="$dispatch('close-modal', 'edit-event-{{ $event->id }}')" 
            class="px-5 py-2.5 rounded-xl border border-gray-200 text-gray-600 hover:bg-gray-50 text-xs font-semibold transition-all">
            Cancel
        </button>
        <button type="submit" 
            class="px-6 py-2.5 rounded-xl bg-[#340C6F] hover:bg-purple-900 text-white font-bold text-xs shadow-md transition-all flex items-center gap-2">
            <i class="fa-solid fa-pen-to-square text-xs"></i>
            <span>Update Event</span>
        </button>
    </div>
</form>
