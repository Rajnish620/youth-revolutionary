@extends('layouts.admin')

@section('title', 'Payment & QR Code Settings - Admin Panel')

@section('content')
<div class="max-w-4xl space-y-6">

    <!-- Header Section -->
    <div>
        <h1 class="text-2xl font-black text-gray-800 tracking-tight">System Settings</h1>
        <p class="text-gray-500 text-sm mt-1">Configure UPI ID and upload Payment QR Code displayed to students during event registration</p>
    </div>

    <!-- Navigation Tabs -->
    <x-admin-settings-nav />

    <!-- Alert Flash Messages -->
    @if(session('success'))
        <div class="p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 text-sm font-semibold flex items-center gap-2">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Form Container -->
    <div class="bg-white p-6 sm:p-8 rounded-3xl border border-gray-200/80 shadow-sm space-y-6">
        <form method="POST" action="{{ route('admin.settings.payment.update') }}" class="space-y-6" enctype="multipart/form-data">
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

                <!-- QR Code Image Upload -->
                <div class="md:col-span-2">
                    <x-image-upload name="qr_code_image" label="Payment QR Code Image" :existing="$setting->qr_code_image" />
                    <p class="text-[11px] text-gray-400 mt-1">Upload the QR Code image that students will scan on the registration page to make their event fee payment.</p>
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
