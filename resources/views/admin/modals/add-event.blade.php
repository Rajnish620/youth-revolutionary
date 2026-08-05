<form method="POST" action="{{ route('admin.events.store') }}" class="space-y-5" enctype="multipart/form-data">
    @csrf

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Title -->
        <div class="md:col-span-2">
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Event Title *</label>
            <input type="text" name="title" required placeholder="e.g. Talent Search Festival Nashariganj"
                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-[#340C6F] focus:ring-2 focus:ring-[#340C6F]/20 outline-none transition-all">
        </div>

        <!-- Category -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Category *</label>
            <select name="category" required
                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-[#340C6F] focus:ring-2 focus:ring-[#340C6F]/20 outline-none transition-all">
                @foreach($categories as $cat)
                    <option value="{{ $cat->name }}">{{ current(explode(' ', $cat->name)) == 'Education' ? '🎓 ' : (current(explode(' ', $cat->name)) == 'Sports' ? '⚽ ' : (current(explode(' ', $cat->name)) == 'Cultural' ? '🎭 ' : '')) }}{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Season -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Season</label>
            <select name="season"
                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-[#340C6F] focus:ring-2 focus:ring-[#340C6F]/20 outline-none transition-all">
                <option value="">Select Season (Optional)</option>
                @foreach($seasons as $season)
                    <option value="{{ $season->name }}">{{ $season->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Status -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Status *</label>
            <select name="status" required
                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-[#340C6F] focus:ring-2 focus:ring-[#340C6F]/20 outline-none transition-all">
                <option value="upcoming">Upcoming</option>
                <option value="ongoing">Ongoing / Live</option>
                <option value="completed">Completed</option>
            </select>
        </div>

        <!-- Location -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Location *</label>
            <input type="text" name="location" value="Patna Nashariganj" required placeholder="e.g. Patna Nashariganj"
                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-[#340C6F] outline-none transition-all">
        </div>

        <!-- Event Date -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Event / Exam Date</label>
            <input type="date" name="event_date"
                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-[#340C6F] outline-none transition-all">
        </div>

        <!-- Reporting Time -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Reporting Time</label>
            <input type="text" name="reporting_time" placeholder="e.g. 09:00 AM"
                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-[#340C6F] outline-none transition-all">
        </div>

        <!-- Exam Timing (From - To) -->
        <div class="md:col-span-2">
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Exam Timing</label>
            <input type="text" name="exam_time" placeholder="e.g. 10:00 AM - 12:00 PM"
                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-[#340C6F] outline-none transition-all">
            <p class="text-[11px] text-gray-400 mt-1">This timing and reporting time will be printed directly on candidate Admit Cards.</p>
        </div>

        <!-- Image Upload -->
        <div class="md:col-span-2">
            <x-image-upload name="image" label="Event Cover Image" />
        </div>

        <!-- Is Featured Checkbox -->
        <div class="md:col-span-2 flex items-center gap-2">
            <input type="checkbox" name="is_featured" id="is_featured_add" value="1" class="rounded border-gray-300 text-[#F1400C] focus:ring-0">
            <label for="is_featured_add" class="text-xs font-bold text-gray-700 cursor-pointer">Mark as Featured Event (Shown on homepage & events hero banner)</label>
        </div>

        <!-- Description -->
        <div class="md:col-span-2">
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Description</label>
            <textarea name="description" rows="3" placeholder="Enter event details..."
                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-[#340C6F] outline-none transition-all"></textarea>
        </div>
    </div>

    <!-- Modal Controls -->
    <div class="flex items-center justify-end gap-3 border-t border-gray-100 pt-4 mt-2">
        <button type="button" @click="$dispatch('close-modal', 'add-event')" 
            class="px-5 py-2.5 rounded-xl border border-gray-200 text-gray-600 hover:bg-gray-50 text-xs font-semibold transition-all">
            Cancel
        </button>
        <button type="submit" 
            class="px-6 py-2.5 rounded-xl bg-[#F1400C] hover:bg-orange-600 text-white font-bold text-xs shadow-md shadow-[#F1400C]/20 transition-all flex items-center gap-2">
            <i class="fa-solid fa-plus text-xs"></i>
            <span>Create Event</span>
        </button>
    </div>
</form>
