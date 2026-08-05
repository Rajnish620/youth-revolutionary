<form method="POST" action="{{ route('admin.categories.store') }}" class="space-y-5">
    @csrf

    <div>
        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Category Name *</label>
        <input type="text" name="name" required placeholder="e.g. Sports, Education"
            class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-[#340C6F] focus:ring-2 focus:ring-[#340C6F]/20 outline-none transition-all">
    </div>

    <!-- Modal Footer Controls -->
    <div class="flex items-center justify-end gap-3 border-t border-gray-100 pt-4 mt-2">
        <button type="button" @click="$dispatch('close-modal', 'create-category')" 
            class="px-5 py-2.5 rounded-xl border border-gray-200 text-gray-600 hover:bg-gray-50 text-xs font-semibold transition-all">
            Cancel
        </button>
        <button type="submit" 
            class="px-6 py-2.5 rounded-xl bg-[#F1400C] hover:bg-orange-600 text-white font-bold text-xs shadow-md shadow-[#F1400C]/20 transition-all flex items-center gap-2">
            <i class="fa-solid fa-plus text-xs"></i>
            <span>Create Category</span>
        </button>
    </div>
</form>
