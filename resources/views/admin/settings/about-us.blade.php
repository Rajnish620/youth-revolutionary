@extends('layouts.admin')

@section('title', 'About Us Settings - System Settings')

@section('content')
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-black text-slate-900 tracking-tight">System Settings</h1>
                <p class="text-xs font-semibold text-slate-500 mt-1">Manage website content, background images, mission, vision, statistics, and team members.</p>
            </div>
        </div>

        <!-- Sub Navigation Tabs -->
        <x-admin-settings-nav />

        <!-- Alerts -->
        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-5 py-4 rounded-2xl flex items-center gap-3 text-sm font-semibold shadow-sm">
                <i class="fa-solid fa-circle-check text-emerald-600 text-base"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="bg-rose-50 border border-rose-200 text-rose-800 px-5 py-4 rounded-2xl text-sm font-semibold shadow-sm space-y-1">
                <div class="flex items-center gap-2 font-bold">
                    <i class="fa-solid fa-triangle-exclamation text-rose-600"></i>
                    <span>Please fix the following errors:</span>
                </div>
                <ul class="list-disc list-inside text-xs text-rose-700 pl-4">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- About Us Main Content Form -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-gray-100 shadow-xl shadow-gray-100/50">
            <div class="flex items-center justify-between border-b border-gray-100 pb-5 mb-6">
                <div>
                    <h2 class="text-lg font-black text-slate-900 flex items-center gap-2">
                        <i class="fa-solid fa-circle-info text-[#340C6F]"></i>
                        <span>About Us Page Content & Background Banner</span>
                    </h2>
                    <p class="text-xs text-gray-500 mt-0.5">Customize Hero Banner, Who We Are section, Mission, Vision, and Impact Counters.</p>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.settings.about-us.update') }}" enctype="multipart/form-data" class="space-y-8">
                @csrf

                <!-- Section 1: Hero Banner -->
                <div class="space-y-4">
                    <h3 class="text-xs font-black uppercase tracking-wider text-[#340C6F] bg-purple-50 px-3 py-1.5 rounded-lg w-max">1. Hero Header & Background Image</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Hero Title *</label>
                            <input type="text" name="hero_title" value="{{ old('hero_title', $setting->hero_title) }}" required
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm font-semibold focus:bg-white focus:border-[#340C6F] outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Hero Subtitle</label>
                            <input type="text" name="hero_subtitle" value="{{ old('hero_subtitle', $setting->hero_subtitle) }}"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm font-semibold focus:bg-white focus:border-[#340C6F] outline-none">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Hero Background Image</label>
                            <div class="flex items-center gap-6">
                                @if(!empty($setting->hero_bg_image) && file_exists(public_path($setting->hero_bg_image)))
                                    <div class="w-36 h-20 rounded-xl border border-gray-200 p-1 bg-gray-50 shrink-0 overflow-hidden">
                                        <img src="{{ asset($setting->hero_bg_image) }}" class="w-full h-full object-cover rounded-lg" alt="Hero BG">
                                    </div>
                                @else
                                    <div class="w-36 h-20 rounded-xl border border-dashed border-gray-300 p-1 flex flex-col items-center justify-center bg-gray-50 text-gray-400 text-xs shrink-0">
                                        <i class="fa-solid fa-image text-base mb-1"></i>
                                        <span>Default Banner</span>
                                    </div>
                                @endif
                                <div class="flex-1">
                                    <input type="file" name="hero_bg_image" accept="image/*"
                                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2 text-sm focus:bg-white outline-none">
                                    <p class="text-[11px] text-gray-400 mt-1">Upload high-resolution background image for the About Us top hero section.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Who We Are -->
                <div class="space-y-4 border-t border-gray-100 pt-6">
                    <h3 class="text-xs font-black uppercase tracking-wider text-[#340C6F] bg-purple-50 px-3 py-1.5 rounded-lg w-max">2. Who We Are Section</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Section Title *</label>
                            <input type="text" name="who_we_are_title" value="{{ old('who_we_are_title', $setting->who_we_are_title) }}" required
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm font-semibold focus:bg-white focus:border-[#340C6F] outline-none">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Description Detail *</label>
                            <textarea name="who_we_are_description" rows="4"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl p-4 text-sm font-medium focus:bg-white focus:border-[#340C6F] outline-none">{{ old('who_we_are_description', $setting->who_we_are_description) }}</textarea>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Who We Are Side Image</label>
                            <div class="flex items-center gap-6">
                                @if(!empty($setting->who_we_are_image) && file_exists(public_path($setting->who_we_are_image)))
                                    <div class="w-24 h-24 rounded-xl border border-gray-200 p-1 bg-gray-50 shrink-0 overflow-hidden">
                                        <img src="{{ asset($setting->who_we_are_image) }}" class="w-full h-full object-cover rounded-lg" alt="Who We Are Image">
                                    </div>
                                @else
                                    <div class="w-24 h-24 rounded-xl border border-dashed border-gray-300 p-1 flex flex-col items-center justify-center bg-gray-50 text-gray-400 text-xs shrink-0">
                                        <i class="fa-solid fa-users text-base mb-1"></i>
                                        <span>Default Photo</span>
                                    </div>
                                @endif
                                <div class="flex-1">
                                    <input type="file" name="who_we_are_image" accept="image/*"
                                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2 text-sm focus:bg-white outline-none">
                                    <p class="text-[11px] text-gray-400 mt-1">Upload high quality image representing your organization.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 3: Mission & Vision -->
                <div class="space-y-4 border-t border-gray-100 pt-6">
                    <h3 class="text-xs font-black uppercase tracking-wider text-[#340C6F] bg-purple-50 px-3 py-1.5 rounded-lg w-max">3. Mission & Vision</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Mission Title *</label>
                            <input type="text" name="mission_title" value="{{ old('mission_title', $setting->mission_title) }}" required
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm font-semibold focus:bg-white focus:border-[#340C6F] outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Vision Title *</label>
                            <input type="text" name="vision_title" value="{{ old('vision_title', $setting->vision_title) }}" required
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm font-semibold focus:bg-white focus:border-[#340C6F] outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Mission Detail</label>
                            <textarea name="mission_description" rows="3"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl p-4 text-sm font-medium focus:bg-white focus:border-[#340C6F] outline-none">{{ old('mission_description', $setting->mission_description) }}</textarea>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Vision Detail</label>
                            <textarea name="vision_description" rows="3"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl p-4 text-sm font-medium focus:bg-white focus:border-[#340C6F] outline-none">{{ old('vision_description', $setting->vision_description) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Section 4: Statistics Counters -->
                <div class="space-y-4 border-t border-gray-100 pt-6">
                    <h3 class="text-xs font-black uppercase tracking-wider text-[#340C6F] bg-purple-50 px-3 py-1.5 rounded-lg w-max">4. Impact Statistics Counters</h3>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Stat 1 Count</label>
                            <input type="text" name="stat_1_count" value="{{ old('stat_1_count', $setting->stat_1_count) }}" placeholder="10000+"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2 text-sm font-bold text-gray-900 focus:bg-white focus:border-[#340C6F] outline-none">
                            <input type="text" name="stat_1_label" value="{{ old('stat_1_label', $setting->stat_1_label) }}" placeholder="Students"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2 text-xs font-medium text-gray-600 mt-2 focus:bg-white focus:border-[#340C6F] outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Stat 2 Count</label>
                            <input type="text" name="stat_2_count" value="{{ old('stat_2_count', $setting->stat_2_count) }}" placeholder="100+"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2 text-sm font-bold text-gray-900 focus:bg-white focus:border-[#340C6F] outline-none">
                            <input type="text" name="stat_2_label" value="{{ old('stat_2_label', $setting->stat_2_label) }}" placeholder="Competitions"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2 text-xs font-medium text-gray-600 mt-2 focus:bg-white focus:border-[#340C6F] outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Stat 3 Count</label>
                            <input type="text" name="stat_3_count" value="{{ old('stat_3_count', $setting->stat_3_count) }}" placeholder="50+"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2 text-sm font-bold text-gray-900 focus:bg-white focus:border-[#340C6F] outline-none">
                            <input type="text" name="stat_3_label" value="{{ old('stat_3_label', $setting->stat_3_label) }}" placeholder="Schools"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2 text-xs font-medium text-gray-600 mt-2 focus:bg-white focus:border-[#340C6F] outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Stat 4 Count</label>
                            <input type="text" name="stat_4_count" value="{{ old('stat_4_count', $setting->stat_4_count) }}" placeholder="15+"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2 text-sm font-bold text-gray-900 focus:bg-white focus:border-[#340C6F] outline-none">
                            <input type="text" name="stat_4_label" value="{{ old('stat_4_label', $setting->stat_4_label) }}" placeholder="Cities"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2 text-xs font-medium text-gray-600 mt-2 focus:bg-white focus:border-[#340C6F] outline-none">
                        </div>
                    </div>
                </div>

                <div class="flex justify-end pt-4 border-t border-gray-100">
                    <button type="submit" 
                        class="px-8 py-3.5 bg-[#340C6F] hover:bg-[#250952] text-white font-bold text-sm rounded-xl shadow-lg shadow-[#340C6F]/20 transition-all flex items-center gap-2">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span>Save About Us Settings</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Meet Our Team Management Section -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-gray-100 shadow-xl shadow-gray-100/50">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-gray-100 pb-5 mb-6">
                <div>
                    <h2 class="text-lg font-black text-slate-900 flex items-center gap-2">
                        <i class="fa-solid fa-users-gear text-[#F1400C]"></i>
                        <span>Meet Our Team Management</span>
                    </h2>
                    <p class="text-xs text-gray-500 mt-0.5">Add, edit, or remove team members displayed on the About Us page.</p>
                </div>
                <button @click="$dispatch('open-modal', 'add-team-member')"
                    class="px-5 py-2.5 bg-[#F1400C] hover:bg-orange-600 text-white font-bold text-xs rounded-xl shadow-md shadow-[#F1400C]/20 transition-all flex items-center gap-2 w-max">
                    <i class="fa-solid fa-plus"></i>
                    <span>Add Team Member</span>
                </button>
            </div>

            <!-- Team Members Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($teamMembers as $member)
                    <div class="border border-gray-200 rounded-2xl p-5 flex flex-col justify-between hover:shadow-md transition-all bg-gray-50/50">
                        <div>
                            <div class="flex items-center gap-4 mb-3">
                                @if(!empty($member->image) && file_exists(public_path($member->image)))
                                    <img src="{{ asset($member->image) }}" class="w-14 h-14 rounded-full object-cover border-2 border-[#340C6F]" alt="{{ $member->name }}">
                                @else
                                    <div class="w-14 h-14 rounded-full bg-purple-100 text-[#340C6F] font-bold flex items-center justify-center text-lg border-2 border-[#340C6F]">
                                        {{ substr($member->name, 0, 1) }}
                                    </div>
                                @endif
                                <div>
                                    <h4 class="font-bold text-slate-900 text-sm">{{ $member->name }}</h4>
                                    <span class="text-xs font-semibold text-[#F1400C]">{{ $member->role }}</span>
                                    @if($member->is_featured)
                                        <span class="block text-[10px] text-amber-600 font-bold mt-0.5"><i class="fa-solid fa-star text-amber-500"></i> Featured Member</span>
                                    @endif
                                </div>
                            </div>
                            @if(!empty($member->description))
                                <p class="text-xs text-gray-600 line-clamp-3 mb-3">{{ $member->description }}</p>
                            @endif
                        </div>

                        <div class="flex items-center justify-end gap-2 border-t border-gray-200/60 pt-3 mt-2">
                            <button @click="$dispatch('open-modal', 'edit-team-member-{{ $member->id }}')" 
                                class="px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-bold rounded-lg transition-all flex items-center gap-1">
                                <i class="fa-solid fa-pen-to-square"></i> Edit
                            </button>
                            <form method="POST" action="{{ route('admin.settings.about-us.team.destroy', $member->id) }}" onsubmit="return confirm('Are you sure you want to delete this team member?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-600 text-xs font-bold rounded-lg transition-all flex items-center gap-1">
                                    <i class="fa-solid fa-trash-can"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Modal: Edit Team Member -->
                    <x-modal name="edit-team-member-{{ $member->id }}" title="Edit Team Member" maxWidth="lg">
                        <form method="POST" action="{{ route('admin.settings.about-us.team.update', $member->id) }}" enctype="multipart/form-data" class="space-y-4">
                            @csrf
                            @method('PUT')
                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Name *</label>
                                <input type="text" name="name" value="{{ old('name', $member->name) }}" required
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm font-semibold outline-none focus:bg-white focus:border-[#340C6F]">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Role / Position *</label>
                                <input type="text" name="role" value="{{ old('role', $member->role) }}" required placeholder="e.g. Founder & Director"
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm font-semibold outline-none focus:bg-white focus:border-[#340C6F]">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Photo</label>
                                <div class="flex items-center gap-4">
                                    @if(!empty($member->image) && file_exists(public_path($member->image)))
                                        <img src="{{ asset($member->image) }}" class="w-12 h-12 rounded-full object-cover" alt="Member Photo">
                                    @endif
                                    <input type="file" name="image" accept="image/*"
                                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2 text-xs outline-none">
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Short Bio / Description</label>
                                <textarea name="description" rows="3"
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl p-3 text-sm font-medium outline-none focus:bg-white focus:border-[#340C6F]">{{ old('description', $member->description) }}</textarea>
                            </div>

                            <div class="flex items-center gap-2">
                                <input type="checkbox" name="is_featured" id="edit_featured_{{ $member->id }}" value="1" {{ old('is_featured', $member->is_featured) ? 'checked' : '' }} class="rounded border-gray-300 text-[#F1400C]">
                                <label for="edit_featured_{{ $member->id }}" class="text-xs font-bold text-gray-700 cursor-pointer">Mark as Featured Member</label>
                            </div>

                            <div class="flex items-center justify-end gap-3 border-t border-gray-100 pt-4">
                                <button type="button" @click="$dispatch('close-modal', 'edit-team-member-{{ $member->id }}')" class="px-5 py-2.5 rounded-xl border border-gray-200 text-gray-600 text-xs font-bold">Cancel</button>
                                <button type="submit" class="px-6 py-2.5 bg-[#340C6F] text-white text-xs font-bold rounded-xl shadow-md">Update Member</button>
                            </div>
                        </form>
                    </x-modal>
                @empty
                    <div class="md:col-span-3 text-center py-12 bg-gray-50 rounded-2xl border border-dashed border-gray-200">
                        <i class="fa-solid fa-users-slash text-3xl text-gray-300 mb-2"></i>
                        <p class="text-sm font-bold text-gray-600">No team members added yet.</p>
                        <p class="text-xs text-gray-400 mt-1">Click 'Add Team Member' button above to create team profiles.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Key Leaders & Advisors Management Section -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-gray-100 shadow-xl shadow-gray-100/50">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-gray-100 pb-5 mb-6">
                <div>
                    <h2 class="text-lg font-black text-slate-900 flex items-center gap-2">
                        <i class="fa-solid fa-users-gear text-[#0ea5e9]"></i>
                        <span>Key Leaders & Advisors Management</span>
                    </h2>
                    <p class="text-xs text-gray-500 mt-0.5">Add, edit, or remove advisors displayed on the About Us page.</p>
                </div>
                <button @click="$dispatch('open-modal', 'add-advisor')"
                    class="px-5 py-2.5 bg-[#0ea5e9] hover:bg-sky-600 text-white font-bold text-xs rounded-xl shadow-md shadow-[#0ea5e9]/20 transition-all flex items-center gap-2 w-max">
                    <i class="fa-solid fa-plus"></i>
                    <span>Add Advisor</span>
                </button>
            </div>

            <!-- Advisors Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($advisors as $member)
                    <div class="border border-gray-200 rounded-2xl p-5 flex flex-col justify-between hover:shadow-md transition-all bg-gray-50/50">
                        <div>
                            <div class="flex items-center gap-4 mb-3">
                                @if(!empty($member->image) && file_exists(public_path($member->image)))
                                    <img src="{{ asset($member->image) }}" class="w-14 h-14 rounded-full object-cover border-2 border-[#340C6F]" alt="{{ $member->name }}">
                                @else
                                    <div class="w-14 h-14 rounded-full bg-purple-100 text-[#340C6F] font-bold flex items-center justify-center text-lg border-2 border-[#340C6F]">
                                        {{ substr($member->name, 0, 1) }}
                                    </div>
                                @endif
                                <div>
                                    <h4 class="font-bold text-slate-900 text-sm">{{ $member->name }}</h4>
                                    <span class="text-xs font-semibold text-[#0ea5e9]">{{ $member->role }}</span>
                                    @if($member->is_featured)
                                        <span class="block text-[10px] text-sky-600 font-bold mt-0.5"><i class="fa-solid fa-star text-sky-500"></i> Featured Member</span>
                                    @endif
                                </div>
                            </div>
                            @if(!empty($member->description))
                                <p class="text-xs text-gray-600 line-clamp-3 mb-3">{{ $member->description }}</p>
                            @endif
                        </div>

                        <div class="flex items-center justify-end gap-2 border-t border-gray-200/60 pt-3 mt-2">
                            <button @click="$dispatch('open-modal', 'edit-advisor-{{ $member->id }}')" 
                                class="px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-bold rounded-lg transition-all flex items-center gap-1">
                                <i class="fa-solid fa-pen-to-square"></i> Edit
                            </button>
                            <form method="POST" action="{{ route('admin.settings.about-us.team.destroy', $member->id) }}" onsubmit="return confirm('Are you sure you want to delete this advisor?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-600 text-xs font-bold rounded-lg transition-all flex items-center gap-1">
                                    <i class="fa-solid fa-trash-can"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Modal: Edit Advisor -->
                    <x-modal name="edit-advisor-{{ $member->id }}" title="Edit Advisor" maxWidth="lg">
                        <form method="POST" action="{{ route('admin.settings.about-us.team.update', $member->id) }}" enctype="multipart/form-data" class="space-y-4">
                            @csrf
                            @method('PUT')
                            <input type='hidden' name='type' value='advisor'>
                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Name *</label>
                                <input type="text" name="name" value="{{ old('name', $member->name) }}" required
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm font-semibold outline-none focus:bg-white focus:border-[#340C6F]">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Role / Position *</label>
                                <input type="text" name="role" value="{{ old('role', $member->role) }}" required placeholder="e.g. Founder & Director"
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm font-semibold outline-none focus:bg-white focus:border-[#340C6F]">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Photo</label>
                                <div class="flex items-center gap-4">
                                    @if(!empty($member->image) && file_exists(public_path($member->image)))
                                        <img src="{{ asset($member->image) }}" class="w-12 h-12 rounded-full object-cover" alt="Member Photo">
                                    @endif
                                    <input type="file" name="image" accept="image/*"
                                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2 text-xs outline-none">
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Short Bio / Description</label>
                                <textarea name="description" rows="3"
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl p-3 text-sm font-medium outline-none focus:bg-white focus:border-[#340C6F]">{{ old('description', $member->description) }}</textarea>
                            </div>

                            <div class="flex items-center gap-2">
                                <input type="checkbox" name="is_featured" id="edit_featured_{{ $member->id }}" value="1" {{ old('is_featured', $member->is_featured) ? 'checked' : '' }} class="rounded border-gray-300 text-[#0ea5e9]">
                                <label for="edit_featured_{{ $member->id }}" class="text-xs font-bold text-gray-700 cursor-pointer">Mark as Featured Member</label>
                            </div>

                            <div class="flex items-center justify-end gap-3 border-t border-gray-100 pt-4">
                                <button type="button" @click="$dispatch('close-modal', 'edit-advisor-{{ $member->id }}')" class="px-5 py-2.5 rounded-xl border border-gray-200 text-gray-600 text-xs font-bold">Cancel</button>
                                <button type="submit" class="px-6 py-2.5 bg-[#340C6F] text-white text-xs font-bold rounded-xl shadow-md">Update Member</button>
                            </div>
                        </form>
                    </x-modal>
                @empty
                    <div class="md:col-span-3 text-center py-12 bg-gray-50 rounded-2xl border border-dashed border-gray-200">
                        <i class="fa-solid fa-users-slash text-3xl text-gray-300 mb-2"></i>
                        <p class="text-sm font-bold text-gray-600">No advisors added yet.</p>
                        <p class="text-xs text-gray-400 mt-1">Click 'Add Advisor' button above to create team profiles.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Modal: Add Advisor -->

        <!-- Modal: Add Team Member -->
        <x-modal name="add-team-member" title="Add New Team Member" maxWidth="lg">
            <form method="POST" action="{{ route('admin.settings.about-us.team.store') }}" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Name *</label>
                    <input type="text" name="name" required placeholder="e.g. Rahul Sharma"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm font-semibold outline-none focus:bg-white focus:border-[#340C6F]">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Role / Position *</label>
                    <input type="text" name="role" required placeholder="e.g. Founder & Director"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm font-semibold outline-none focus:bg-white focus:border-[#340C6F]">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Photo</label>
                    <input type="file" name="image" accept="image/*"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2 text-xs outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Short Bio / Description</label>
                    <textarea name="description" rows="3" placeholder="Brief details about role and background..."
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl p-3 text-sm font-medium outline-none focus:bg-white focus:border-[#340C6F]"></textarea>
                </div>

                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_featured" id="add_featured" value="1" class="rounded border-gray-300 text-[#F1400C]">
                    <label for="add_featured" class="text-xs font-bold text-gray-700 cursor-pointer">Mark as Featured Member</label>
                </div>

                <div class="flex items-center justify-end gap-3 border-t border-gray-100 pt-4">
                    <button type="button" @click="$dispatch('close-modal', 'add-team-member')" class="px-5 py-2.5 rounded-xl border border-gray-200 text-gray-600 text-xs font-bold">Cancel</button>
                    <button type="submit" class="px-6 py-2.5 bg-[#F1400C] text-white text-xs font-bold rounded-xl shadow-md">Add Team Member</button>
                </div>
            </form>
        </x-modal>

        <!-- Modal: Add Advisor -->
        <x-modal name="add-advisor" title="Add New Advisor" maxWidth="lg">
            <form method="POST" action="{{ route('admin.settings.about-us.team.store') }}" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <input type='hidden' name='type' value='advisor'>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Name *</label>
                    <input type="text" name="name" required placeholder="e.g. Rahul Sharma"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm font-semibold outline-none focus:bg-white focus:border-[#340C6F]">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Role / Position *</label>
                    <input type="text" name="role" required placeholder="e.g. Founder & Director"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm font-semibold outline-none focus:bg-white focus:border-[#340C6F]">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Photo</label>
                    <input type="file" name="image" accept="image/*"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2 text-xs outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Short Bio / Description</label>
                    <textarea name="description" rows="3" placeholder="Brief details about role and background..."
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl p-3 text-sm font-medium outline-none focus:bg-white focus:border-[#340C6F]"></textarea>
                </div>

                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_featured" id="add_adv_featured" value="1" class="rounded border-gray-300 text-[#F1400C]">
                    <label for="add_adv_featured" class="text-xs font-bold text-gray-700 cursor-pointer">Mark as Featured Member</label>
                </div>

                <div class="flex items-center justify-end gap-3 border-t border-gray-100 pt-4">
                    <button type="button" @click="$dispatch('close-modal', 'add-advisor')" class="px-5 py-2.5 rounded-xl border border-gray-200 text-gray-600 text-xs font-bold">Cancel</button>
                    <button type="submit" class="px-6 py-2.5 bg-[#0ea5e9] text-white text-xs font-bold rounded-xl shadow-md">Add Advisor</button>
                </div>
            </form>
        </x-modal>
    </div>
@endsection
