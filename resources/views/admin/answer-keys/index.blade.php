@extends('layouts.admin')

@section('title', 'Manage Answer Keys')

@section('content')
<div x-data="{ showModal: false }" class="p-4 lg:p-8 flex-1 overflow-y-auto">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Answer Keys</h1>
            <p class="text-sm text-gray-500 mt-1">Upload and manage official answer keys for exams.</p>
        </div>
        
        <button @click="showModal = true" class="bg-brand-purple hover:bg-brand-purple/90 text-white px-5 py-2.5 rounded-xl text-sm font-semibold transition-colors shadow-sm flex items-center">
            <i class="fa-solid fa-cloud-arrow-up mr-2"></i> Upload Answer Key
        </button>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-600 px-4 py-3 rounded-xl text-sm flex items-start">
            <i class="fa-solid fa-circle-check mt-0.5 mr-2"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif
    @if($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl text-sm flex items-start">
            <i class="fa-solid fa-circle-exclamation mt-0.5 mr-2"></i>
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Answer Keys Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-600">
                <thead class="bg-gray-50/80 text-gray-700 text-xs uppercase font-semibold">
                    <tr>
                        <th class="px-5 py-4 border-b border-gray-100">Title</th>
                        <th class="px-5 py-4 border-b border-gray-100">Event/Exam</th>
                        <th class="px-5 py-4 border-b border-gray-100 text-center">Status</th>
                        <th class="px-5 py-4 border-b border-gray-100 text-center">File</th>
                        <th class="px-5 py-4 border-b border-gray-100 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($answerKeys as $key)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-5 py-4 font-medium text-gray-900">
                            {{ $key->title }}
                            <div class="text-xs text-gray-400 font-normal mt-0.5">Uploaded {{ $key->created_at->format('d M Y') }}</div>
                        </td>
                        <td class="px-5 py-4">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                                {{ $key->event->title ?? 'N/A' }}
                            </span>
                        </td>
                        <td class="px-5 py-4 text-center">
                            <form action="{{ route('admin.answer-keys.toggle', $key->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium border transition-colors {{ $key->is_active ? 'bg-green-50 text-green-700 border-green-200 hover:bg-red-50 hover:text-red-700 hover:border-red-200' : 'bg-gray-100 text-gray-600 border-gray-200 hover:bg-green-50 hover:text-green-700 hover:border-green-200' }}" title="Click to toggle status">
                                    @if($key->is_active)
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500 mr-1.5"></span> Active
                                    @else
                                        <span class="w-1.5 h-1.5 rounded-full bg-gray-400 mr-1.5"></span> Inactive
                                    @endif
                                </button>
                            </form>
                        </td>
                        <td class="px-5 py-4 text-center">
                            <a href="{{ asset($key->file_path) }}" target="_blank" class="text-brand-purple hover:text-brand-dark transition-colors inline-flex items-center justify-center w-8 h-8 rounded-lg bg-purple-50 hover:bg-purple-100" title="View File">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                        </td>
                        <td class="px-5 py-4 text-center">
                            <form action="{{ route('admin.answer-keys.destroy', $key->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this answer key?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 transition-colors inline-flex items-center justify-center w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100" title="Delete">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-5 py-12 text-center text-gray-500">
                            <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-300">
                                <i class="fa-solid fa-file-circle-question text-2xl"></i>
                            </div>
                            <p class="font-medium text-gray-600 mb-1">No Answer Keys Uploaded</p>
                            <p class="text-sm">Click "Upload Answer Key" to add one.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Upload Modal -->
    <div x-show="showModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
            <div x-show="showModal" @click="showModal = false" class="fixed inset-0 transition-opacity bg-gray-900/50 backdrop-blur-sm"></div>

            <div x-show="showModal" class="relative inline-block w-full max-w-lg p-6 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl sm:my-8" x-transition.scale.origin.bottom>
                <div class="flex items-center justify-between border-b border-gray-100 pb-4 mb-5">
                    <h3 class="text-xl font-bold text-gray-900">Upload Answer Key</h3>
                    <button @click="showModal = false" class="text-gray-400 hover:text-gray-500 bg-gray-50 hover:bg-gray-100 rounded-full p-2 transition-colors">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <form action="{{ route('admin.answer-keys.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="space-y-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Select Event/Exam <span class="text-red-500">*</span></label>
                            <select name="event_id" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-brand-purple focus:ring-brand-purple text-sm p-2.5 border">
                                <option value="">-- Select Event --</option>
                                @foreach($events as $event)
                                    <option value="{{ $event->id }}">{{ $event->title }} ({{ $event->category }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Answer Key Title <span class="text-red-500">*</span></label>
                            <input type="text" name="title" required placeholder="e.g., Class 10 Arts Answer Key" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-brand-purple focus:ring-brand-purple text-sm p-2.5 border">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Upload File (PDF/Image) <span class="text-red-500">*</span></label>
                            <input type="file" name="file" required accept=".pdf,.jpg,.jpeg,.png" class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-brand-purple hover:file:bg-purple-100 transition-colors border border-gray-200 rounded-lg shadow-sm">
                            <p class="mt-1 text-xs text-gray-400">Max size: 10MB. Formats: PDF, JPG, PNG.</p>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" name="is_active" id="is_active" value="1" checked class="w-4 h-4 text-brand-purple bg-gray-100 border-gray-300 rounded focus:ring-brand-purple">
                            <label for="is_active" class="ml-2 text-sm font-medium text-gray-700">Make it active immediately</label>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end gap-3 pt-4 border-t border-gray-50">
                        <button type="button" @click="showModal = false" class="px-5 py-2.5 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 transition-colors">Cancel</button>
                        <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-brand-purple hover:bg-brand-purple/90 rounded-xl shadow-sm transition-colors">Upload Key</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
