<form method="POST" action="{{ route('admin.seasons.update', $season->id) }}" class="space-y-5">
    @csrf
    @method('PUT')

    <div>
        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Season Name *</label>
        <input type="text" name="name" value="{{ old('name', $season->name) }}" required
            class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-[#340C6F] focus:ring-2 focus:ring-[#340C6F]/20 outline-none transition-all">
    </div>

    <!-- Modal Footer Controls -->
    <div class="flex items-center justify-end gap-3 border-t border-gray-100 pt-4 mt-2">
        <button type="button" @click="$dispatch('close-modal', 'edit-season-{{ $season->id }}')" 
            class="px-5 py-2.5 rounded-xl border border-gray-200 text-gray-600 hover:bg-gray-50 text-xs font-semibold transition-all">
            Cancel
        </button>
        <button type="submit" 
            class="px-6 py-2.5 rounded-xl bg-[#340C6F] hover:bg-purple-900 text-white font-bold text-xs shadow-md transition-all flex items-center gap-2">
            <i class="fa-solid fa-floppy-disk text-xs"></i>
            <span>Save Changes</span>
        </button>
    </div>
</form>
