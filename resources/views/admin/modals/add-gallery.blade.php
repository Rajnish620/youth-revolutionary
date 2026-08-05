<form method="POST" action="{{ route('admin.gallery.store') }}" class="space-y-5" enctype="multipart/form-data">
    @csrf

    <div class="space-y-4">
        <!-- Title -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Photo Title / Event Name</label>
            <input type="text" name="title" placeholder="e.g. Quiz Competition Winners"
                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-[#340C6F] focus:ring-2 focus:ring-[#340C6F]/20 outline-none transition-all">
        </div>

        <!-- Season Select -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Gallery Season *</label>
            <select name="season_id" required class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-[#340C6F] focus:ring-2 focus:ring-[#340C6F]/20 outline-none transition-all">
                <option value="">-- Select Season --</option>
                @if(isset($seasons))
                    @foreach($seasons as $s)
                        <option value="{{ $s->id }}">{{ $s->name }}</option>
                    @endforeach
                @endif
            </select>
        </div>

        <!-- Image Upload -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Photo *</label>
            <x-image-upload name="image" />
        </div>

        <!-- Description -->
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Description (Optional)</label>
            <textarea name="description" rows="3" placeholder="Brief caption or description of the photo..."
                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-[#340C6F] outline-none transition-all"></textarea>
        </div>
    </div>

    <!-- Modal Controls -->
    <div class="flex items-center justify-end gap-3 border-t border-gray-100 pt-4 mt-2">
        <button type="button" @click="$dispatch('close-modal', 'add-gallery')" 
            class="px-5 py-2.5 rounded-xl border border-gray-200 text-gray-600 hover:bg-gray-50 text-xs font-semibold transition-all">
            Cancel
        </button>
        <button type="submit" 
            class="px-6 py-2.5 rounded-xl bg-[#F1400C] hover:bg-orange-600 text-white font-bold text-xs shadow-md shadow-[#F1400C]/20 transition-all flex items-center gap-2">
            <i class="fa-solid fa-cloud-arrow-up text-xs"></i>
            <span>Upload to Gallery</span>
        </button>
    </div>
</form>
