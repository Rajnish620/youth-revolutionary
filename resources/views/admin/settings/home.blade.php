@extends('layouts.admin')

@section('title', 'Home Page Settings')
@section('header', 'Home Page Settings')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
    
    @if(session('success'))
        <div class="mb-4 bg-green-50 text-green-700 p-4 rounded border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.settings.home.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="border p-4 rounded-lg bg-gray-50 md:col-span-3">
                <h3 class="font-bold text-lg mb-4 border-b pb-2">Site Favicon</h3>
                <div class="mb-4 flex items-center gap-4">
                    @if($setting->favicon)
                        <div class="w-16 h-16 bg-white border border-gray-200 rounded p-1 flex items-center justify-center shrink-0">
                            <img src="{{ asset($setting->favicon) }}" alt="Favicon" class="max-w-full max-h-full">
                        </div>
                    @endif
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Upload New Favicon (.ico, .png, .jpg)</label>
                        <input type="file" name="favicon" accept=".ico,.png,.jpg,.jpeg" class="w-full border-gray-300 rounded-md shadow-sm">
                        <p class="text-xs text-gray-500 mt-1">Recommended size: 32x32 or 64x64 pixels.</p>
                    </div>
                </div>
            </div>

            <!-- Polaroid 1 -->
            <div class="border p-4 rounded-lg bg-gray-50">
                <h3 class="font-bold text-lg mb-4 border-b pb-2">Polaroid 1 (Top Left)</h3>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                    @if($setting->polaroid_1_image)
                        <div class="mb-2">
                            <img src="{{ asset($setting->polaroid_1_image) }}" class="h-32 object-cover border rounded">
                        </div>
                    @endif
                    <input type="file" name="polaroid_1_image" class="w-full border-gray-300 rounded-md shadow-sm">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Text (Quote)</label>
                    <input type="text" name="polaroid_1_text" value="{{ old('polaroid_1_text', $setting->polaroid_1_text) }}" class="w-full border-gray-300 rounded-md shadow-sm">
                </div>
            </div>

            <!-- Polaroid 2 -->
            <div class="border p-4 rounded-lg bg-gray-50">
                <h3 class="font-bold text-lg mb-4 border-b pb-2">Polaroid 2 (Middle Right)</h3>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                    @if($setting->polaroid_2_image)
                        <div class="mb-2">
                            <img src="{{ asset($setting->polaroid_2_image) }}" class="h-32 object-cover border rounded">
                        </div>
                    @endif
                    <input type="file" name="polaroid_2_image" class="w-full border-gray-300 rounded-md shadow-sm">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Text (Quote)</label>
                    <input type="text" name="polaroid_2_text" value="{{ old('polaroid_2_text', $setting->polaroid_2_text) }}" class="w-full border-gray-300 rounded-md shadow-sm">
                </div>
            </div>

            <!-- Polaroid 3 -->
            <div class="border p-4 rounded-lg bg-gray-50">
                <h3 class="font-bold text-lg mb-4 border-b pb-2">Polaroid 3 (Bottom Left)</h3>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                    @if($setting->polaroid_3_image)
                        <div class="mb-2">
                            <img src="{{ asset($setting->polaroid_3_image) }}" class="h-32 object-cover border rounded">
                        </div>
                    @endif
                    <input type="file" name="polaroid_3_image" class="w-full border-gray-300 rounded-md shadow-sm">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Text (Quote)</label>
                    <input type="text" name="polaroid_3_text" value="{{ old('polaroid_3_text', $setting->polaroid_3_text) }}" class="w-full border-gray-300 rounded-md shadow-sm">
                </div>
            </div>

        </div>

        <div class="border p-4 rounded-lg bg-gray-50 mb-8">
            <h3 class="font-bold text-lg mb-4 border-b pb-2">Middle Banner (Between "What you can do" and "Nextgen")</h3>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Upload Banner Image</label>
                @if($setting->middle_banner_image)
                    <div class="mb-2">
                        <img src="{{ asset($setting->middle_banner_image) }}" class="max-h-48 object-cover border rounded">
                    </div>
                @endif
                <input type="file" name="middle_banner_image" class="w-full border-gray-300 rounded-md shadow-sm">
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded shadow hover:bg-blue-700">Save Settings</button>
        </div>
    </form>
</div>
@endsection
