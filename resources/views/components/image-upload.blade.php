@props(['name', 'label' => 'Image', 'existing' => null, 'maxSize' => 5])

@php
    $inputId = $name . '_upload_' . uniqid();
    $initialUrl = '';
    if ($existing) {
        if (str_starts_with($existing, 'http')) {
            $initialUrl = $existing;
        } elseif (str_starts_with($existing, 'storage/') || str_starts_with($existing, 'images/')) {
            $initialUrl = asset($existing);
        } else {
            $initialUrl = asset('storage/' . $existing);
        }
    }
@endphp

<div x-data="imageUploadComponent('{{ $initialUrl }}', {{ $maxSize }})" class="w-full relative">
    <div class="flex justify-between items-end mb-1.5">
        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider">{{ $label }}</label>
        <button type="button" x-show="imageUrl" @click.prevent="removeImage" class="text-red-500 hover:text-red-700 text-[10px] uppercase font-bold flex items-center gap-1 transition-colors" style="display: none;">
            <i class="fa-solid fa-trash-can"></i> Remove
        </button>
    </div>
    
    <div class="relative w-full group">
        <label for="{{ $inputId }}" class="flex flex-col items-center justify-center w-full h-40 border-2 border-gray-300 border-dashed rounded-2xl cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors overflow-hidden relative">
            
            <!-- Default Placeholder (Shows when no image is selected) -->
            <div x-show="!imageUrl" class="flex flex-col items-center justify-center pt-5 pb-6">
                <i class="fa-solid fa-cloud-arrow-up text-3xl text-gray-400 mb-2 group-hover:text-[#340C6F] transition-colors"></i>
                <p class="mb-1 text-sm text-gray-500"><span class="font-semibold text-[#340C6F]">Click to upload</span> or drag and drop</p>
                <p class="text-xs text-gray-400">PNG, JPG, GIF up to {{ $maxSize }}MB</p>
            </div>
            
            <!-- Image Preview Container -->
            <div x-show="imageUrl" class="absolute inset-0 w-full h-full" style="display: none;">
                <img :src="imageUrl" class="w-full h-full object-cover object-center" alt="Preview">
                
                <!-- Overlay for changing image -->
                <div class="absolute inset-0 bg-black/40 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity backdrop-blur-[2px]">
                    <i class="fa-solid fa-camera text-2xl text-white mb-1"></i>
                    <span class="text-white text-sm font-semibold shadow-sm">Change Image</span>
                </div>
            </div>
            
            <input id="{{ $inputId }}" name="{{ $name }}" type="file" accept="image/*" class="hidden" @change="fileChosen">
        </label>
        
        <!-- Hidden input to keep track of existing image if no new file is uploaded (useful for updates) -->
        @if($existing)
            <input type="hidden" name="existing_{{ $name }}" value="{{ $existing }}">
        @endif
        
        <!-- Hidden input for remove flag -->
        <input type="hidden" name="remove_{{ $name }}" :value="isRemoved ? '1' : '0'">
        
        <!-- Error Message (Optional alpine bound) -->
        <p x-show="error" x-text="error" class="mt-2 text-xs text-red-500 font-semibold" style="display: none;"></p>
    </div>
</div>

@once
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('imageUploadComponent', (initialImageUrl, maxSizeMB) => ({
            imageUrl: initialImageUrl,
            error: null,
            isRemoved: false,
            removeImage() {
                this.imageUrl = null;
                this.isRemoved = true;
                document.getElementById('{{ $inputId }}').value = '';
            },
            fileChosen(event) {
                const file = event.target.files[0];
                this.error = null;
                this.isRemoved = false;
                
                if (!file) return;
                
                // Validate file size
                if (file.size > maxSizeMB * 1024 * 1024) {
                    this.error = `File size must be less than ${maxSizeMB}MB.`;
                    event.target.value = ''; // Reset input
                    return;
                }
                
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.imageUrl = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }))
    });
</script>
@endonce
