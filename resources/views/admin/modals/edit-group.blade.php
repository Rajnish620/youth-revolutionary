<form method="POST" action="{{ route('admin.groups.update', $group->id) }}" class="space-y-5">
    @csrf
    @method('PUT')

    <div class="space-y-4">
        <!-- Event -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Select Event *</label>
            <select name="event_id" required
                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-[#340C6F] outline-none transition-all">
                @foreach($events as $ev)
                    <option value="{{ $ev->id }}" {{ old('event_id', $group->event_id) == $ev->id ? 'selected' : '' }}>{{ $ev->title }}</option>
                @endforeach
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
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Registration Fee (₹) *</label>
            <input type="number" step="0.01" name="fee" value="{{ old('fee', $group->fee) }}" required
                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm font-bold text-gray-900 focus:bg-white focus:border-[#340C6F] outline-none transition-all">
        </div>

        <!-- Max Participants Limit -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Max Participant Capacity</label>
            <input type="number" name="max_participants" value="{{ old('max_participants', $group->max_participants) }}"
                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-[#340C6F] outline-none transition-all">
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
