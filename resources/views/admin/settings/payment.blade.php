@extends('layouts.admin')

@section('title', 'Payment & QR Code Settings - Admin Panel')

@section('content')
<div class="max-w-4xl space-y-6">

    <!-- Header Section -->
    <div>
        <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Payment QR & UPI Settings</h1>
        <p class="text-xs text-gray-500 mt-1">Configure UPI ID and upload Payment QR Code displayed to students during event registration</p>
    </div>

    <!-- Alert Flash Messages -->
    @if(session('success'))
        <div class="p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 text-sm font-semibold flex items-center gap-2">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Form Container -->
    <div class="bg-white p-6 sm:p-8 rounded-3xl border border-gray-200/80 shadow-sm space-y-6">
        <form method="POST" action="{{ route('admin.settings.payment.update') }}" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- UPI ID -->
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">UPI ID (VPA) *</label>
                    <input type="text" name="upi_id" value="{{ old('upi_id', $setting->upi_id) }}" required placeholder="e.g. sws@upi"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm font-bold text-gray-900 focus:bg-white focus:border-[#340C6F] outline-none transition-all">
                    <p class="text-[11px] text-gray-400 mt-1">Enter your organization UPI ID for direct payments</p>
                </div>

                <!-- Account Holder -->
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Account Holder Name *</label>
                    <input type="text" name="account_holder" value="{{ old('account_holder', $setting->account_holder) }}" required placeholder="e.g. Youth Revolutionary"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm font-bold text-gray-900 focus:bg-white focus:border-[#340C6F] outline-none transition-all">
                </div>

                <!-- QR Code Image URL -->
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Payment QR Code Image URL / Path *</label>
                    <input type="text" name="qr_code_image" value="{{ old('qr_code_image', $setting->qr_code_image) }}" required placeholder="images/qr_code.png or https://..."
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm font-semibold text-gray-900 focus:bg-white focus:border-[#340C6F] outline-none transition-all">
                    <p class="text-[11px] text-gray-400 mt-1">Provide full URL or relative path from public folder for QR image</p>
                </div>

                <!-- QR Code Preview Box -->
                <div class="md:col-span-2 bg-gray-50 p-4 rounded-2xl border border-gray-200 flex flex-col sm:flex-row items-center gap-4">
                    <img src="{{ str_starts_with($setting->qr_code_image, 'http') ? $setting->qr_code_image : asset($setting->qr_code_image ?? 'images/quize.jpg') }}" 
                         alt="QR Preview" class="w-32 h-32 object-contain rounded-xl bg-white p-2 border border-gray-300 shadow-sm">
                    <div>
                        <div class="font-extrabold text-sm text-gray-900">Current QR Code Preview</div>
                        <div class="text-xs text-gray-500 mt-1">This is the exact QR code students will scan on the registration page to make their event fee payment.</div>
                    </div>
                </div>

                <!-- Instructions -->
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Student Payment Instructions</label>
                    <textarea name="instructions" rows="3" placeholder="Enter instructions shown to students..."
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-900 focus:bg-white focus:border-[#340C6F] outline-none transition-all">{{ old('instructions', $setting->instructions) }}</textarea>
                </div>
            </div>

            <!-- Save Button -->
            <div class="flex items-center justify-end border-t border-gray-100 pt-4">
                <button type="submit" 
                    class="px-8 py-3 rounded-xl bg-[#F1400C] hover:bg-orange-600 text-white font-bold text-sm shadow-lg shadow-[#F1400C]/30 transition-all flex items-center gap-2 cursor-pointer">
                    <i class="fa-solid fa-floppy-disk text-sm"></i>
                    <span>Save Payment Settings</span>
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
