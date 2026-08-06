@extends('layouts.admin')

@section('title', 'Admit Card Settings - System Settings')

@section('content')
<div class="space-y-6 max-w-5xl">
    
    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-black text-gray-800 tracking-tight">System Settings</h2>
            <p class="text-gray-500 text-sm mt-1">Configure Admit Card header titles, logo, and examination instructions.</p>
        </div>
    </div>

    <!-- Navigation Tabs -->
    <x-admin-settings-nav />

    <!-- Alert Message -->
    @if(session('success'))
    <div x-data="{ show: true }" x-show="show" class="bg-green-50 text-green-700 p-4 rounded-xl border border-green-200 flex items-start justify-between shadow-sm">
        <div class="flex items-center gap-3">
            <i class="fa-solid fa-circle-check text-lg"></i>
            <span class="font-semibold text-sm">{{ session('success') }}</span>
        </div>
        <button @click="show = false" class="text-green-500 hover:text-green-700 transition">
            <i class="fa-solid fa-times"></i>
        </button>
    </div>
    @endif

    <form action="{{ route('admin.settings.admit-card.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        
        <!-- Header & Branding Block -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
            <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center gap-2">
                <i class="fa-solid fa-heading text-[#340C6F]"></i> Admit Card Header & Branding
            </h3>
            
            <div class="grid sm:grid-cols-2 gap-6">
                <!-- Header Title -->
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Header Organization Title</label>
                    <input type="text" name="header_title" value="{{ old('header_title', $setting->header_title ?? 'YOUTH REVOLUTIONARY') }}" placeholder="e.g. YOUTH REVOLUTIONARY"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm font-semibold focus:bg-white focus:border-[#340C6F] focus:ring-2 focus:ring-[#340C6F]/20 outline-none transition-all">
                    <p class="text-[11px] text-gray-400 mt-1">Main heading displayed at top of printed Admit Card.</p>
                </div>

                <!-- Subtitle -->
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Header Subtitle</label>
                    <input type="text" name="header_subtitle" value="{{ old('header_subtitle', $setting->header_subtitle ?? 'A Unit of SWS') }}" placeholder="e.g. A Unit of SWS"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm font-semibold focus:bg-white focus:border-[#340C6F] focus:ring-2 focus:ring-[#340C6F]/20 outline-none transition-all">
                    <p class="text-[11px] text-gray-400 mt-1">Sub-heading printed under the main title.</p>
                </div>

                <!-- Logo Upload -->
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Admit Card Logo (Optional)</label>
                    <div class="flex items-center gap-6">
                        @if(!empty($setting->logo_path) && file_exists(public_path($setting->logo_path)))
                            <div class="w-16 h-16 rounded-xl border border-gray-200 p-1 flex items-center justify-center bg-gray-50 shrink-0">
                                <img src="{{ asset($setting->logo_path) }}" alt="Logo" class="max-h-full max-w-full object-contain rounded-lg">
                            </div>
                        @else
                            <div class="w-16 h-16 rounded-xl border border-gray-200 p-1 flex items-center justify-center bg-gray-50 shrink-0">
                                <img src="{{ asset('logo/logo.jpeg') }}" alt="Default Logo" class="max-h-full max-w-full object-contain rounded-lg">
                            </div>
                        @endif
                        <div class="flex-1">
                            <input type="file" name="logo" accept="image/*"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2 text-sm focus:bg-white outline-none">
                            <p class="text-[11px] text-gray-400 mt-1">Upload transparent PNG or JPG logo. If left blank, website default logo will be used.</p>
                        </div>
                    </div>
                </div>

                <!-- Signature Upload -->
                <div class="sm:col-span-2 border-t border-gray-100 pt-6">
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Authorized Signature Stamp / Image</label>
                    <div class="flex items-center gap-6">
                        @if(!empty($setting->signature_path) && file_exists(public_path($setting->signature_path)))
                            <div class="w-32 h-16 rounded-xl border border-gray-200 p-1 flex items-center justify-center bg-gray-50 shrink-0">
                                <img src="{{ asset($setting->signature_path) }}" alt="Authorized Signature" class="max-h-full max-w-full object-contain">
                            </div>
                        @else
                            <div class="w-32 h-16 rounded-xl border border-dashed border-gray-300 p-1 flex flex-col items-center justify-center bg-gray-50 shrink-0 text-gray-400 text-xs">
                                <i class="fa-solid fa-signature text-base mb-1"></i>
                                <span>No Signature</span>
                            </div>
                        @endif
                        <div class="flex-1">
                            <input type="file" name="signature" accept="image/*"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2 text-sm focus:bg-white outline-none">
                            <p class="text-[11px] text-gray-400 mt-1">Upload a clear PNG image of the authority signature/stamp. It will be printed above "Authorized Signature" on the Admit Card.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Instructions Block -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
            <h3 class="text-lg font-bold text-gray-800 mb-2 flex items-center gap-2">
                <i class="fa-solid fa-list-check text-[#340C6F]"></i> Important Examination Instructions
            </h3>
            <p class="text-xs text-gray-500 mb-6">These points will be printed at the bottom section of every student's Admit Card PDF based on their event category.</p>
            
            <div class="space-y-6">
                <!-- Default / Global Instructions -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Default Instructions (Fallback)</label>
                    <textarea name="instructions" rows="6" 
                        placeholder="Enter default instructions..."
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl p-4 text-sm font-medium focus:bg-white focus:border-[#340C6F] focus:ring-2 focus:ring-[#340C6F]/20 outline-none transition-all leading-relaxed">{{ old('instructions', $setting->instructions) }}</textarea>
                </div>

                <!-- Category Specific Instructions -->
                @if(isset($categories) && $categories->count() > 0)
                    <div class="pt-4 border-t border-gray-100">
                        <h4 class="text-md font-bold text-gray-700 mb-4">Category-Specific Instructions</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($categories as $category)
                                <div>
                                    <label class="block text-sm font-bold text-[#F1400C] mb-2">{{ $category->name }} Events</label>
                                    <textarea name="category_instructions[{{ $category->id }}]" rows="5" 
                                        placeholder="Enter instructions for {{ $category->name }} events..."
                                        class="w-full bg-orange-50/30 border border-orange-100 rounded-xl p-4 text-sm font-medium focus:bg-white focus:border-[#F1400C] focus:ring-2 focus:ring-[#F1400C]/20 outline-none transition-all leading-relaxed">{{ old('category_instructions.'.$category->id, $category->instructions) }}</textarea>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end pt-4 border-t border-gray-100">
            <button type="submit" class="bg-[#340C6F] hover:bg-[#250952] text-white px-8 py-3.5 rounded-xl font-bold text-sm shadow-lg shadow-[#340C6F]/20 transition-all duration-300 flex items-center gap-2 cursor-pointer">
                <i class="fa-solid fa-floppy-disk"></i>
                <span>Save Admit Card Settings</span>
            </button>
        </div>
    </form>
</div>
@endsection
