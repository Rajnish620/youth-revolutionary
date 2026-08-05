@extends('layouts.admin')

@section('title', 'Inquiries & Messages')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-black text-gray-800">Inquiries</h2>
            <p class="text-gray-500 text-sm mt-1">Manage contact messages from students.</p>
        </div>
    </div>

    @if(session('success'))
    <div x-data="{ show: true }" x-show="show" class="bg-green-50 text-green-700 p-4 rounded-xl border border-green-200 flex items-start justify-between">
        <div class="flex items-center gap-3">
            <i class="fa-solid fa-check-circle text-lg"></i>
            <span class="font-semibold text-sm">{{ session('success') }}</span>
        </div>
        <button @click="show = false" class="text-green-500 hover:text-green-700 transition">
            <i class="fa-solid fa-times"></i>
        </button>
    </div>
    @endif

    <!-- Messages List -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100 text-xs uppercase tracking-wider text-gray-500 font-bold">
                        <th class="p-4">Sender</th>
                        <th class="p-4">Message</th>
                        <th class="p-4">Date</th>
                        <th class="p-4 text-center">Status</th>
                        <th class="p-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($messages as $message)
                    <tr class="hover:bg-gray-50/50 transition-colors {{ !$message->status ? 'bg-blue-50/30' : '' }}">
                        <td class="p-4 align-top">
                            <div class="font-bold text-gray-800">{{ $message->name }}</div>
                            <a href="mailto:{{ $message->email }}" class="text-xs text-brand-orange hover:underline">{{ $message->email }}</a>
                        </td>
                        <td class="p-4 align-top max-w-md">
                            <p class="text-sm text-gray-600 line-clamp-3" title="{{ $message->message }}">
                                {{ $message->message }}
                            </p>
                        </td>
                        <td class="p-4 align-top text-sm text-gray-500">
                            {{ $message->created_at->format('d M, Y') }}<br>
                            <span class="text-xs">{{ $message->created_at->format('h:i A') }}</span>
                        </td>
                        <td class="p-4 align-top text-center">
                            @if($message->status)
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-bold bg-green-100 text-green-700">
                                    <i class="fa-solid fa-check"></i> Read
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-bold bg-blue-100 text-blue-700">
                                    <i class="fa-solid fa-envelope"></i> Unread
                                </span>
                            @endif
                        </td>
                        <td class="p-4 align-top text-right space-x-2 whitespace-nowrap" x-data="{ showModal: false }">
                            <!-- View Button -->
                            <button @click="showModal = true" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gray-100 text-gray-600 hover:bg-brand-purple hover:text-white transition-colors" title="View Full Message">
                                <i class="fa-solid fa-eye text-sm"></i>
                            </button>

                            @if(!$message->status)
                            <form action="{{ route('admin.inquiries.mark-read', $message) }}" method="POST" class="inline-block">
                                @csrf
                                <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition-colors" title="Mark as Read">
                                    <i class="fa-solid fa-check-double text-sm"></i>
                                </button>
                            </form>
                            @endif

                            <form action="{{ route('admin.inquiries.destroy', $message) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this message?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition-colors" title="Delete">
                                    <i class="fa-solid fa-trash text-sm"></i>
                                </button>
                            </form>

                            <!-- View Modal -->
                            <div x-show="showModal" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                    <div x-show="showModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-500/75 transition-opacity" @click="showModal = false" aria-hidden="true"></div>

                                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                                    <div x-show="showModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
                                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                            <div class="sm:flex sm:items-start">
                                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                                    <h3 class="text-lg leading-6 font-bold text-gray-900" id="modal-title">
                                                        Message from {{ $message->name }}
                                                    </h3>
                                                    <div class="mt-1 text-sm text-gray-500 flex justify-between">
                                                        <a href="mailto:{{ $message->email }}" class="text-brand-orange hover:underline">{{ $message->email }}</a>
                                                        <span>{{ $message->created_at->format('d M, Y h:i A') }}</span>
                                                    </div>
                                                    <div class="mt-4 text-sm text-gray-700 bg-gray-50 p-4 rounded-xl border border-gray-100 whitespace-pre-wrap text-left">{{ $message->message }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse rounded-b-2xl">
                                            <button type="button" @click="showModal = false" class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-4 py-2 bg-gray-800 text-base font-medium text-white hover:bg-gray-900 sm:ml-3 sm:w-auto sm:text-sm">
                                                Close
                                            </button>
                                            @if(!$message->status)
                                                <form action="{{ route('admin.inquiries.mark-read', $message) }}" method="POST" class="w-full sm:w-auto">
                                                    @csrf
                                                    <button type="submit" class="mt-3 w-full inline-flex justify-center rounded-xl border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:w-auto sm:text-sm">
                                                        Mark as Read
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-gray-400">
                            <div class="flex flex-col items-center justify-center">
                                <i class="fa-solid fa-inbox text-4xl mb-3 text-gray-300"></i>
                                <p>No contact messages yet.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($messages->hasPages())
        <div class="p-4 border-t border-gray-100">
            {{ $messages->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
