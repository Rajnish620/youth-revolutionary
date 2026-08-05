<form method="POST" action="{{ route('admin.groups.update', $group->id) }}" class="space-y-5" x-data="{
    selectedSeason: '{{ $group->event->season ?? '' }}',
    events: {{ Js::from($allEvents->map(fn($e) => ['id' => $e->id, 'title' => $e->title, 'category' => $e->category, 'season' => $e->season])) }},
    get filteredEvents() {
        if (!this.selectedSeason) return this.events;
        return this.events.filter(e => e.season === this.selectedSeason);
    }
}">
    @csrf
    @method('PUT')

    <div class="space-y-4">
        <!-- Season Selection (Filter) -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Select Season (Optional Filter)</label>
            <select x-model="selectedSeason"
                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-[#340C6F] outline-none transition-all">
                <option value="">All Seasons</option>
                @foreach($seasons as $s)
                    <option value="{{ $s->name }}">{{ $s->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Event -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Select Event *</label>
            <select name="event_id" required
                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-[#340C6F] outline-none transition-all">
                <template x-for="ev in filteredEvents" :key="ev.id">
                    <option :value="ev.id" :selected="ev.id == {{ $group->event_id }}" x-text="ev.title + ' (' + ev.category + ')'"></option>
                </template>
                <template x-if="filteredEvents.length === 0">
                    <option value="" disabled selected>No events found for this season</option>
                </template>
            </select>
        </div>

        <!-- Group Name -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Group Name *</label>
            <input type="text" name="group_name" value="{{ old('group_name', $group->group_name) }}" required
                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-[#340C6F] outline-none transition-all">
        </div>

        <!-- Included Classes -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Included Classes / Standard</label>
            <input type="text" name="class_range" value="{{ old('class_range', $group->class_range) }}"
                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-[#340C6F] outline-none transition-all">
        </div>

        <!-- Fee Amount -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Registration Fee (₹) (Optional)</label>
            <input type="number" step="0.01" name="fee" value="{{ old('fee', $group->fee) }}" placeholder="e.g. 100.00 or leave blank for free"
                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm font-bold text-gray-900 focus:bg-white focus:border-[#340C6F] outline-none transition-all">
            <p class="text-[11px] text-gray-400 mt-1">Fee charged for students registering in this class group tier</p>
        </div>

        <!-- Max Participants Limit -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Max Participant Capacity</label>
            <input type="number" name="max_participants" value="{{ old('max_participants', $group->max_participants) }}" placeholder="e.g. 100"
                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-[#340C6F] outline-none transition-all">
        </div>

        <!-- Roll Number Sequence Start -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Starting Roll Number Sequence</label>
            <input type="number" name="roll_sequence_start" value="{{ old('roll_sequence_start', $group->roll_sequence_start ?? 1000) }}" required placeholder="e.g. 1000"
                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm font-bold text-gray-900 focus:bg-white focus:border-[#340C6F] outline-none transition-all">
            <p class="text-[11px] text-gray-400 mt-1">Student roll numbers for this group will start from this number (e.g. 1001, 1002).</p>
        </div>
    </div>

    <!-- Modal Controls -->
    <div class="flex items-center justify-end gap-3 border-t border-gray-100 pt-4 mt-2">
        <button type="button" @click="$dispatch('close-modal', 'edit-group-{{ $group->id }}')" 
            class="px-5 py-2.5 rounded-xl border border-gray-200 text-gray-600 hover:bg-gray-50 text-xs font-semibold transition-all">
            Cancel
        </button>
        <button type="submit" 
            class="px-6 py-2.5 rounded-xl bg-[#340C6F] hover:bg-purple-900 text-white font-bold text-xs shadow-md transition-all flex items-center gap-2">
            <i class="fa-solid fa-pen-to-square text-xs"></i>
            <span>Update Group Tier</span>
        </button>
    </div>
</form>
