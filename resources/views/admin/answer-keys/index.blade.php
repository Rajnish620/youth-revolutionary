@extends('layouts.admin')

@section('title', 'Answer Keys Management - Admin Panel')

@section('content')
<div x-data="{
    showUploadModal: false,
    previewUrl: null,
    previewTitle: '',
    previewType: 'pdf',
    showPreviewModal: false,
    
    // Cascading data for upload modal
    allEvents: @js($events),
    seasonsList: @js($seasons),
    uploadSeason: '',
    uploadEventId: '',
    uploadGroupId: '',

    get uploadFilteredEvents() {
        if (!this.uploadSeason) return [];
        return this.allEvents.filter(e => e.season === this.uploadSeason);
    },

    get uploadFilteredGroups() {
        if (!this.uploadEventId) return [];
        const ev = this.allEvents.find(e => String(e.id) === String(this.uploadEventId));
        return ev && ev.groups ? ev.groups : [];
    },

    onUploadSeasonChange() {
        this.uploadEventId = '';
        this.uploadGroupId = '';
    },

    onUploadEventChange() {
        this.uploadGroupId = '';
    },

    openPreview(url, title, type) {
        this.previewUrl = url;
        this.previewTitle = title;
        this.previewType = type;
        this.showPreviewModal = true;
    }
}" class="space-y-6">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight flex items-center gap-2.5">
                <i class="fa-solid fa-file-circle-check text-[#340C6F]"></i>
                <span>Official Answer Keys</span>
            </h1>
            <p class="text-xs text-gray-500 mt-1">Upload and manage exam answer keys filtered by Season, Event, and Group tier.</p>
        </div>
        
        <button @click="showUploadModal = true" class="bg-[#340C6F] hover:bg-[#250850] text-white px-5 py-2.5 rounded-xl text-xs font-bold transition-all shadow-md hover:shadow-lg flex items-center gap-2 cursor-pointer">
            <i class="fa-solid fa-cloud-arrow-up"></i>
            <span>Upload New Answer Key</span>
        </button>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 text-sm font-semibold flex items-center gap-2">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif
    @if(isset($errors) && $errors->any())
        <div class="p-4 rounded-xl bg-red-50 border border-red-200 text-red-600 text-sm font-semibold">
            <div class="flex items-center gap-2 mb-1">
                <i class="fa-solid fa-circle-exclamation"></i>
                <span>Please correct the errors below:</span>
            </div>
            <ul class="list-disc list-inside text-xs font-normal pl-2 space-y-0.5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Cascading Filter Bar -->
    <div class="bg-white p-4 rounded-2xl border border-gray-200/80 shadow-sm flex flex-col lg:flex-row items-center justify-between gap-4">
        <form method="GET" action="{{ route('admin.answer-keys.index') }}" class="flex flex-wrap items-center gap-3 w-full lg:w-auto" id="filterForm">
            <!-- Season Filter -->
            <div class="flex items-center gap-1.5">
                <span class="text-xs font-bold text-gray-500"><i class="fa-regular fa-calendar text-[11px] mr-1"></i>Season:</span>
                <select name="season" onchange="document.getElementById('filterEventId').value='All'; document.getElementById('filterGroupId').value='All'; document.getElementById('filterForm').submit();" class="bg-gray-50 border border-gray-200 text-xs font-semibold text-gray-800 rounded-xl px-3 py-2 outline-none focus:border-[#340C6F] focus:bg-white transition-all">
                    <option value="All">All Seasons</option>
                    @foreach($seasons as $s)
                        <option value="{{ $s }}" {{ request('season') == $s ? 'selected' : '' }}>{{ $s }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Event Filter -->
            <div class="flex items-center gap-1.5">
                <span class="text-xs font-bold text-gray-500"><i class="fa-solid fa-trophy text-[11px] mr-1"></i>Event:</span>
                <select name="event_id" id="filterEventId" onchange="document.getElementById('filterGroupId').value='All'; document.getElementById('filterForm').submit();" class="bg-gray-50 border border-gray-200 text-xs font-semibold text-gray-800 rounded-xl px-3 py-2 outline-none focus:border-[#340C6F] focus:bg-white transition-all max-w-[200px]">
                    <option value="All">All Events</option>
                    @foreach($events as $e)
                        @if(!request('season') || request('season') == 'All' || $e->season == request('season'))
                            <option value="{{ $e->id }}" {{ request('event_id') == $e->id ? 'selected' : '' }}>{{ $e->title }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <!-- Group Filter -->
            <div class="flex items-center gap-1.5">
                <span class="text-xs font-bold text-gray-500"><i class="fa-solid fa-users text-[11px] mr-1"></i>Group:</span>
                <select name="event_group_id" id="filterGroupId" onchange="document.getElementById('filterForm').submit();" class="bg-gray-50 border border-gray-200 text-xs font-semibold text-gray-800 rounded-xl px-3 py-2 outline-none focus:border-[#340C6F] focus:bg-white transition-all max-w-[180px]">
                    <option value="All">All Groups</option>
                    @foreach($allGroups as $g)
                        @if(!request('event_id') || request('event_id') == 'All' || $g->event_id == request('event_id'))
                            <option value="{{ $g->id }}" {{ request('event_group_id') == $g->id ? 'selected' : '' }}>
                                {{ $g->group_name }} @if($g->class_range) ({{ $g->class_range }}) @endif
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>

            @if(request('season') && request('season') !== 'All' || request('event_id') && request('event_id') !== 'All' || request('event_group_id') && request('event_group_id') !== 'All' || request('search'))
                <a href="{{ route('admin.answer-keys.index') }}" class="text-xs font-semibold text-red-500 hover:text-red-700 underline px-2 py-1 flex items-center gap-1">
                    <i class="fa-solid fa-rotate-left"></i> Reset
                </a>
            @endif
        </form>

        <!-- Search box -->
        <form method="GET" action="{{ route('admin.answer-keys.index') }}" class="relative w-full lg:w-72">
            @if(request('season')) <input type="hidden" name="season" value="{{ request('season') }}"> @endif
            @if(request('event_id')) <input type="hidden" name="event_id" value="{{ request('event_id') }}"> @endif
            @if(request('event_group_id')) <input type="hidden" name="event_group_id" value="{{ request('event_group_id') }}"> @endif
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search title, event or group..." 
                class="w-full bg-gray-50 text-xs pl-9 pr-4 py-2.5 rounded-xl border border-gray-200 focus:border-[#340C6F] focus:bg-white outline-none transition-all">
            <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-gray-400 text-xs"></i>
        </form>
    </div>

    <!-- Answer Keys Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200/80 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-600 border-collapse">
                <thead class="bg-gray-50/80 text-gray-700 text-xs uppercase font-semibold border-b border-gray-200/80">
                    <tr>
                        <th class="px-5 py-3.5">Answer Key Title</th>
                        <th class="px-5 py-3.5">Season</th>
                        <th class="px-5 py-3.5">Event / Exam</th>
                        <th class="px-5 py-3.5">Target Group</th>
                        <th class="px-5 py-3.5 text-center">Status</th>
                        <th class="px-5 py-3.5 text-center">Preview</th>
                        <th class="px-5 py-3.5 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($answerKeys as $key)
                    @php
                        $ext = strtolower(pathinfo($key->file_path, PATHINFO_EXTENSION));
                        $isPdf = $ext === 'pdf';
                    @endphp
                    <tr class="hover:bg-purple-50/20 transition-colors">
                        <!-- Title & Date -->
                        <td class="px-5 py-4 font-medium text-gray-900">
                            <div class="font-bold text-gray-800 flex items-center gap-2">
                                <i class="fa-solid {{ $isPdf ? 'fa-file-pdf text-red-500' : 'fa-file-image text-blue-500' }}"></i>
                                <span>{{ $key->title }}</span>
                            </div>
                            <div class="text-[11px] text-gray-400 font-normal mt-0.5">
                                Uploaded: {{ $key->created_at->format('d M Y, h:i A') }}
                            </div>
                        </td>

                        <!-- Season -->
                        <td class="px-5 py-4">
                            @if($key->event && $key->event->season)
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-purple-50 text-[#340C6F] border border-purple-200">
                                    <i class="fa-regular fa-calendar text-[10px] mr-1.5"></i>
                                    {{ $key->event->season }}
                                </span>
                            @else
                                <span class="text-xs text-gray-400 italic">No season</span>
                            @endif
                        </td>

                        <!-- Event / Exam -->
                        <td class="px-5 py-4">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                                {{ $key->event->title ?? 'N/A' }}
                            </span>
                        </td>

                        <!-- Group -->
                        <td class="px-5 py-4">
                            @if($key->group)
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                    <i class="fa-solid fa-users text-[10px] mr-1.5"></i>
                                    {{ $key->group->group_name }}
                                    @if($key->group->class_range)
                                        <span class="text-[10px] text-amber-600 font-normal ml-1">({{ $key->group->class_range }})</span>
                                    @endif
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-gray-100 text-gray-600 border border-gray-200">
                                    <i class="fa-solid fa-globe text-[10px] mr-1.5 text-gray-400"></i>
                                    All Groups (Common)
                                </span>
                            @endif
                        </td>

                        <!-- Status Toggle -->
                        <td class="px-5 py-4 text-center">
                            <form action="{{ route('admin.answer-keys.toggle', $key->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold border transition-colors cursor-pointer {{ $key->is_active ? 'bg-green-50 text-green-700 border-green-200 hover:bg-red-50 hover:text-red-700 hover:border-red-200' : 'bg-gray-100 text-gray-600 border-gray-200 hover:bg-green-50 hover:text-green-700 hover:border-green-200' }}" title="Click to toggle status">
                                    @if($key->is_active)
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500 mr-1.5"></span> Active
                                    @else
                                        <span class="w-1.5 h-1.5 rounded-full bg-gray-400 mr-1.5"></span> Inactive
                                    @endif
                                </button>
                            </form>
                        </td>

                        <!-- Preview Button -->
                        <td class="px-5 py-4 text-center">
                            <button @click="openPreview('{{ asset($key->file_path) }}', '{{ addslashes($key->title) }}', '{{ $isPdf ? 'pdf' : 'image' }}')" 
                                type="button"
                                class="text-[#340C6F] hover:text-purple-900 transition-colors inline-flex items-center justify-center w-8 h-8 rounded-lg bg-purple-50 hover:bg-purple-100 cursor-pointer" 
                                title="View Answer Key Inline">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        </td>

                        <!-- Actions -->
                        <td class="px-5 py-4 text-center">
                            <form action="{{ route('admin.answer-keys.destroy', $key->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this answer key?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 transition-colors inline-flex items-center justify-center w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100 cursor-pointer" title="Delete Answer Key">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-5 py-12 text-center text-gray-500">
                            <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-300">
                                <i class="fa-solid fa-file-circle-question text-3xl"></i>
                            </div>
                            <p class="font-bold text-gray-700 mb-1">No Answer Keys Found</p>
                            <p class="text-xs text-gray-400 mb-4">No records match your selected season, event, or group filters.</p>
                            <button @click="showUploadModal = true" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-bold bg-[#340C6F] text-white hover:bg-purple-900 transition-colors">
                                <i class="fa-solid fa-plus text-xs"></i> Upload First Key
                            </button>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($answerKeys->hasPages())
            <div class="px-5 py-4 border-t border-gray-100 bg-gray-50/50">
                {{ $answerKeys->links() }}
            </div>
        @endif
    </div>

    <!-- Upload Modal with Dynamic Cascading Hierarchy: Season -> Event -> Group -->
    <div x-show="showUploadModal" 
        x-cloak 
        class="fixed inset-0 z-50 overflow-y-auto" 
        style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
            <div x-show="showUploadModal" @click="showUploadModal = false" class="fixed inset-0 transition-opacity bg-gray-900/60 backdrop-blur-xs"></div>

            <div x-show="showUploadModal" 
                class="relative inline-block w-full max-w-lg p-6 overflow-hidden text-left align-middle transition-all transform bg-white shadow-2xl rounded-2xl sm:my-8 border border-gray-100" 
                x-transition.scale.origin.bottom>
                
                <div class="flex items-center justify-between border-b border-gray-100 pb-4 mb-5">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                            <i class="fa-solid fa-cloud-arrow-up text-[#340C6F]"></i>
                            <span>Upload Official Answer Key</span>
                        </h3>
                        <p class="text-xs text-gray-400 mt-0.5">Select Season &rarr; Event &rarr; Target Group hierarchy</p>
                    </div>
                    <button @click="showUploadModal = false" class="text-gray-400 hover:text-gray-600 bg-gray-50 hover:bg-gray-100 rounded-full p-2 transition-colors cursor-pointer">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <form action="{{ route('admin.answer-keys.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="space-y-4">
                        <!-- Step 1: Select Season -->
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">
                                1. Select Season <span class="text-red-500">*</span>
                            </label>
                            <select x-model="uploadSeason" @change="onUploadSeasonChange()" name="season" required class="w-full rounded-xl border-gray-200 shadow-xs focus:border-[#340C6F] focus:ring-[#340C6F] text-xs p-3 border font-medium bg-gray-50/50">
                                <option value="">-- Choose Season First --</option>
                                <template x-for="s in seasonsList" :key="s">
                                    <option :value="s" x-text="s"></option>
                                </template>
                            </select>
                            <p class="text-[11px] text-gray-400 mt-1">First choose season to load corresponding events.</p>
                        </div>

                        <!-- Step 2: Select Event -->
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">
                                2. Select Event / Exam <span class="text-red-500">*</span>
                            </label>
                            <select x-model="uploadEventId" @change="onUploadEventChange()" name="event_id" required :disabled="!uploadSeason" class="w-full rounded-xl border-gray-200 shadow-xs focus:border-[#340C6F] focus:ring-[#340C6F] text-xs p-3 border font-medium bg-gray-50/50 disabled:bg-gray-100 disabled:text-gray-400 disabled:cursor-not-allowed">
                                <option value="">-- Choose Event --</option>
                                <template x-for="event in uploadFilteredEvents" :key="event.id">
                                    <option :value="event.id" x-text="event.title"></option>
                                </template>
                            </select>
                            <template x-if="uploadSeason && uploadFilteredEvents.length === 0">
                                <p class="text-[11px] text-amber-600 mt-1"><i class="fa-solid fa-triangle-exclamation mr-1"></i> No events found in this season.</p>
                            </template>
                        </div>

                        <!-- Step 3: Select Group -->
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">
                                3. Select Target Group (Class Tier)
                            </label>
                            <select x-model="uploadGroupId" name="event_group_id" :disabled="!uploadEventId" class="w-full rounded-xl border-gray-200 shadow-xs focus:border-[#340C6F] focus:ring-[#340C6F] text-xs p-3 border font-medium bg-gray-50/50 disabled:bg-gray-100 disabled:text-gray-400 disabled:cursor-not-allowed">
                                <option value="">-- All Groups (Common for Event) --</option>
                                <template x-for="grp in uploadFilteredGroups" :key="grp.id">
                                    <option :value="grp.id" x-text="grp.group_name + (grp.class_range ? ' (' + grp.class_range + ')' : '')"></option>
                                </template>
                            </select>
                            <p class="text-[11px] text-gray-400 mt-1">Select a specific group (e.g. Grp 5) or leave as "All Groups" for common key.</p>
                        </div>

                        <!-- Step 4: Title -->
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">
                                4. Answer Key Title <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="title" required placeholder="e.g., Season 1 - Quiz Competition Grp 5 Official Key" class="w-full rounded-xl border-gray-200 shadow-xs focus:border-[#340C6F] focus:ring-[#340C6F] text-xs p-3 border font-medium">
                        </div>
                        
                        <!-- Step 5: Upload File -->
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">
                                5. Upload File (PDF / Images) <span class="text-red-500">*</span>
                            </label>
                            <input type="file" name="file" required accept=".pdf,.jpg,.jpeg,.png" class="w-full text-xs text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-purple-50 file:text-[#340C6F] hover:file:bg-purple-100 transition-colors border border-gray-200 rounded-xl shadow-xs">
                            <p class="mt-1 text-[11px] text-gray-400">Supported: PDF (recommended), JPG, PNG. Max: 15MB.</p>
                        </div>

                        <!-- Active Switch -->
                        <div class="flex items-center pt-1">
                            <input type="checkbox" name="is_active" id="is_active" value="1" checked class="w-4 h-4 text-[#340C6F] bg-gray-100 border-gray-300 rounded-sm focus:ring-[#340C6F]">
                            <label for="is_active" class="ml-2 text-xs font-semibold text-gray-700">Make answer key active immediately</label>
                        </div>
                    </div>

                    <!-- Modal Actions -->
                    <div class="mt-6 flex justify-end gap-2.5 pt-4 border-t border-gray-100">
                        <button type="button" @click="showUploadModal = false" class="px-4 py-2.5 text-xs font-semibold text-gray-600 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors cursor-pointer">
                            Cancel
                        </button>
                        <button type="submit" class="px-5 py-2.5 text-xs font-bold text-white bg-[#340C6F] hover:bg-[#250850] rounded-xl shadow-md transition-colors cursor-pointer flex items-center gap-1.5">
                            <i class="fa-solid fa-cloud-arrow-up"></i>
                            <span>Upload Key</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- In-Dashboard Preview Modal (No URL redirection) -->
    <div x-show="showPreviewModal" 
        x-cloak 
        class="fixed inset-0 z-50 overflow-y-auto" 
        style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4 py-6 text-center sm:p-0">
            <div x-show="showPreviewModal" @click="showPreviewModal = false" class="fixed inset-0 transition-opacity bg-gray-900/70 backdrop-blur-xs"></div>

            <div x-show="showPreviewModal" 
                class="relative inline-block w-full max-w-4xl p-6 overflow-hidden text-left align-middle transition-all transform bg-white shadow-2xl rounded-2xl border border-gray-100 max-h-[90vh] flex flex-col">
                
                <div class="flex items-center justify-between border-b border-gray-100 pb-3 mb-4">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-file-lines text-[#340C6F] text-lg"></i>
                        <h3 class="text-base font-bold text-gray-900 truncate max-w-md" x-text="previewTitle"></h3>
                    </div>
                    <div class="flex items-center gap-2">
                        <a :href="previewUrl" download class="text-xs font-bold text-[#340C6F] hover:text-purple-900 px-3 py-1.5 bg-purple-50 hover:bg-purple-100 rounded-lg transition-colors flex items-center gap-1">
                            <i class="fa-solid fa-download"></i> Download
                        </a>
                        <button @click="showPreviewModal = false" class="text-gray-400 hover:text-gray-600 bg-gray-50 hover:bg-gray-100 rounded-full p-2 transition-colors cursor-pointer">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                </div>

                <div class="flex-1 overflow-y-auto bg-gray-100 rounded-xl p-3 flex justify-center items-center min-h-[500px]">
                    <template x-if="previewType === 'pdf'">
                        <iframe :src="previewUrl" class="w-full h-[650px] border-0 rounded-lg shadow-xs"></iframe>
                    </template>
                    <template x-if="previewType === 'image'">
                        <img :src="previewUrl" :alt="previewTitle" class="max-w-full max-h-[650px] object-contain rounded-lg shadow-sm">
                    </template>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
