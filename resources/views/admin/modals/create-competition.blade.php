<form method="POST" action="{{ route('admin.competitions.store') }}" class="space-y-5">
    @csrf

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Title -->
        <div class="md:col-span-2">
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Competition Title *</label>
            <input type="text" name="title" required placeholder="e.g. National Quiz Championship 2026"
                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-[#340C6F] focus:ring-2 focus:ring-[#340C6F]/20 outline-none transition-all">
        </div>

        <!-- Category -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Category *</label>
            <select name="category" required
                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-[#340C6F] focus:ring-2 focus:ring-[#340C6F]/20 outline-none transition-all">
                <option value="education">🎓 Education</option>
                <option value="sports">⚽ Sports</option>
                <option value="cultural">🎭 Cultural</option>
            </select>
        </div>

        <!-- Status -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Status *</label>
            <select name="status" required
                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-[#340C6F] focus:ring-2 focus:ring-[#340C6F]/20 outline-none transition-all">
                <option value="upcoming">Upcoming</option>
                <option value="active">Active / Live</option>
                <option value="completed">Completed</option>
            </select>
        </div>

        <!-- Start Date -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Start Date</label>
            <input type="date" name="start_date"
                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-[#340C6F] outline-none transition-all">
        </div>

        <!-- End Date -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">End Date</label>
            <input type="date" name="end_date"
                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-[#340C6F] outline-none transition-all">
        </div>

        <!-- Fee -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Registration Fee (₹) *</label>
            <input type="number" step="0.01" name="registration_fee" value="0.00" required
                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-[#340C6F] outline-none transition-all">
        </div>

        <!-- Image URL -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Image URL / Cover</label>
            <input type="text" name="image" placeholder="https://..."
                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-[#340C6F] outline-none transition-all">
        </div>

        <!-- Description -->
        <div class="md:col-span-2">
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Description</label>
            <textarea name="description" rows="3" placeholder="Enter competition rules or description..."
                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-[#340C6F] outline-none transition-all"></textarea>
        </div>
    </div>

    <!-- Modal Footer Controls -->
    <div class="flex items-center justify-end gap-3 border-t border-gray-100 pt-4 mt-2">
        <button type="button" @click="$dispatch('close-modal', 'create-competition')" 
            class="px-5 py-2.5 rounded-xl border border-gray-200 text-gray-600 hover:bg-gray-50 text-xs font-semibold transition-all">
            Cancel
        </button>
        <button type="submit" 
            class="px-6 py-2.5 rounded-xl bg-[#F1400C] hover:bg-orange-600 text-white font-bold text-xs shadow-md shadow-[#F1400C]/20 transition-all flex items-center gap-2">
            <i class="fa-solid fa-plus text-xs"></i>
            <span>Create Competition</span>
        </button>
    </div>
</form>
