<form method="POST" action="{{ route('admin.groups.store') }}" class="space-y-5">
    @csrf

    <div class="space-y-4">
        <!-- Event -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Select Event *</label>
            <select name="event_id" required
                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-[#340C6F] outline-none transition-all">
                @foreach($events as $ev)
                    <option value="{{ $ev->id }}" {{ request('event_id') == $ev->id ? 'selected' : '' }}>{{ $ev->title }} ({{ $ev->category }})</option>
                @endforeach
            </select>
        </div>

        <!-- Group Name -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Group Name *</label>
            <input type="text" name="group_name" required placeholder="e.g. Group A (Class 5th & 6th)"
                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-[#340C6F] outline-none transition-all">
            <p class="text-[11px] text-gray-400 mt-1">Example: Group A, Group B, Senior Group, Junior Category, etc.</p>
        </div>

        <!-- Included Classes -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Included Classes / Standard</label>
            <input type="text" name="class_range" placeholder="e.g. Class 5th, 6th"
                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-[#340C6F] outline-none transition-all">
            <p class="text-[11px] text-gray-400 mt-1">Classes included in this group (e.g. Class 5th, 6th or 9th to 12th)</p>
        </div>

        <!-- Fee Amount -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Registration Fee (₹) *</label>
            <input type="number" step="0.01" name="fee" required placeholder="100.00"
                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm font-bold text-gray-900 focus:bg-white focus:border-[#340C6F] outline-none transition-all">
            <p class="text-[11px] text-gray-400 mt-1">Fee charged for students registering in this class group tier</p>
        </div>

        <!-- Max Participants Limit (Optional) -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Max Participant Capacity (Optional)</label>
            <input type="number" name="max_participants" placeholder="e.g. 100"
                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-[#340C6F] outline-none transition-all">
        </div>
    </div>

    <!-- Modal Controls -->
    <div class="flex items-center justify-end gap-3 border-t border-gray-100 pt-4 mt-2">
        <button type="button" @click="$dispatch('close-modal', 'add-group')" 
            class="px-5 py-2.5 rounded-xl border border-gray-200 text-gray-600 hover:bg-gray-50 text-xs font-semibold transition-all">
            Cancel
        </button>
        <button type="submit" 
            class="px-6 py-2.5 rounded-xl bg-[#F1400C] hover:bg-orange-600 text-white font-bold text-xs shadow-md shadow-[#F1400C]/20 transition-all flex items-center gap-2">
            <i class="fa-solid fa-plus text-xs"></i>
            <span>Create Class Group Tier</span>
        </button>
    </div>
</form>
