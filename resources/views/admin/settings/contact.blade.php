@extends('layouts.admin')

@section('title', 'Contact Settings')

@section('content')
<div class="space-y-6 max-w-5xl">
    
    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-black text-gray-800">System Settings</h2>
            <p class="text-gray-500 text-sm mt-1">Manage general contact, payment gateway, and admit card configurations.</p>
        </div>
    </div>

    <!-- Navigation Tabs -->
    <x-admin-settings-nav />

    <!-- Alert -->
    @if(session('success'))
    <div x-data="{ show: true }" x-show="show" class="bg-green-50 text-green-700 p-4 rounded-xl border border-green-200 flex items-start justify-between mb-6 shadow-sm">
        <div class="flex items-center gap-3">
            <i class="fa-solid fa-check-circle text-lg"></i>
            <span class="font-semibold text-sm">{{ session('success') }}</span>
        </div>
        <button @click="show = false" class="text-green-500 hover:text-green-700 transition">
            <i class="fa-solid fa-times"></i>
        </button>
    </div>
    @endif

    <!-- Form -->
    <form action="{{ route('admin.settings.contact.update') }}" method="POST" class="space-y-8">
        @csrf
        
        <!-- Contact Information Block -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
            <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center gap-2">
                <i class="fa-solid fa-phone-flip text-orange-500"></i> Basic Contact Info
            </h3>
            
            <div class="grid sm:grid-cols-2 gap-6">
                <!-- Phone -->
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Phone Number</label>
                    <input type="text" name="phone" value="{{ old('phone', $setting->phone) }}" placeholder="+91 8864012433"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-brand-purple focus:ring-2 focus:ring-brand-purple/20 outline-none transition-all">
                </div>
                
                <!-- Email -->
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Email Address</label>
                    <input type="email" name="email" value="{{ old('email', $setting->email) }}" placeholder="info@youthrevolutionary.com"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-brand-purple focus:ring-2 focus:ring-brand-purple/20 outline-none transition-all">
                </div>
                
                <!-- WhatsApp -->
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">WhatsApp Number (For Link)</label>
                    <input type="text" name="whatsapp" value="{{ old('whatsapp', $setting->whatsapp) }}" placeholder="918864012433"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-brand-purple focus:ring-2 focus:ring-brand-purple/20 outline-none transition-all">
                    <p class="text-[11px] text-gray-400 mt-1">Include country code without '+', e.g., 919876543210</p>
                </div>
                
                <!-- Address -->
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Full Address</label>
                    <textarea name="address" rows="2" placeholder="Patna, NASRIGANJ"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-brand-purple focus:ring-2 focus:ring-brand-purple/20 outline-none transition-all">{{ old('address', $setting->address) }}</textarea>
                </div>
            </div>
        </div>

        <!-- Social Links Block -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
            <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center gap-2">
                <i class="fa-solid fa-hashtag text-purple-500"></i> Social Media Links
            </h3>
            
            <div class="grid sm:grid-cols-2 gap-6">
                <!-- Facebook -->
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Facebook Link</label>
                    <input type="url" name="facebook_link" value="{{ old('facebook_link', $setting->facebook_link) }}" placeholder="https://facebook.com/..."
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-brand-purple focus:ring-2 focus:ring-brand-purple/20 outline-none transition-all">
                </div>
                
                <!-- Instagram -->
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Instagram Link</label>
                    <input type="url" name="instagram_link" value="{{ old('instagram_link', $setting->instagram_link) }}" placeholder="https://instagram.com/..."
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-brand-purple focus:ring-2 focus:ring-brand-purple/20 outline-none transition-all">
                </div>
                
                <!-- YouTube -->
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">YouTube Link</label>
                    <input type="url" name="youtube_link" value="{{ old('youtube_link', $setting->youtube_link) }}" placeholder="https://youtube.com/..."
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-brand-purple focus:ring-2 focus:ring-brand-purple/20 outline-none transition-all">
                </div>
            </div>
        </div>

        <!-- Google Map Embed Block -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
            <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center gap-2">
                <i class="fa-solid fa-map-location-dot text-blue-500"></i> Google Map Embed URL
            </h3>
            
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Map `src` URL</label>
                <textarea name="map_embed_url" rows="3" placeholder="https://www.google.com/maps/embed?pb=..."
                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-brand-purple focus:ring-2 focus:ring-brand-purple/20 outline-none transition-all">{{ old('map_embed_url', $setting->map_embed_url) }}</textarea>
                <p class="text-xs text-gray-500 mt-2">
                    Go to Google Maps &rarr; Share &rarr; Embed a map &rarr; Copy the URL inside the <code>src="..."</code> attribute and paste it here.
                </p>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end mt-8">
            <button type="submit" class="bg-brand-orange hover:bg-orange-600 text-white font-bold py-3 px-8 rounded-xl shadow-lg shadow-orange-500/30 transition-all flex items-center gap-2">
                <i class="fa-solid fa-save"></i>
                Save Contact Settings
            </button>
        </div>

    </form>
</div>
@endsection
