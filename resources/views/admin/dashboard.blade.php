@extends('layouts.admin')

@section('title', 'Dashboard - Admin Panel')

@section('content')
<div class="space-y-8">

    <!-- Welcome Hero Banner -->
    <div class="relative overflow-hidden rounded-3xl bg-white border border-gray-200 p-8 shadow-sm">
        <!-- Background Pattern Decor -->
        <div class="absolute -right-10 -bottom-10 w-72 h-72 bg-orange-50 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute right-40 -top-10 w-60 h-60 bg-blue-50 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-orange-100 text-xs font-bold text-[#F1400C] mb-3">
                    <span class="w-2 h-2 rounded-full bg-[#F1400C] animate-ping"></span>
                    Admin Overview
                </div>
                <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">Welcome Back, {{ auth()->user()->name ?? 'Admin' }}! 👋</h1>
                <p class="text-gray-600 font-medium mt-2 text-sm max-w-xl">
                    Here's what's happening with Youth Revolutionary today. Track registrations, manage competitions, and review upcoming events.
                </p>
            </div>
            
            <div class="flex items-center gap-3">
                <button onclick="window.dispatchEvent(new CustomEvent('open-modal', {detail: 'add-event'}))" class="px-5 py-3 rounded-2xl bg-[#F1400C] hover:bg-orange-600 text-white font-bold text-sm shadow-lg shadow-[#F1400C]/30 transition-all flex items-center gap-2 cursor-pointer">
                    <i class="fa-solid fa-plus"></i>
                    <span>New Event / Competition</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Add Event Reusable Modal -->
    <x-modal name="add-event" title="Add New Event" maxWidth="2xl">
        @include('admin.modals.add-event')
    </x-modal>

    <!-- Analytics Stat Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Card 1 -->
        <div class="bg-white p-6 rounded-2xl border border-gray-200/80 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Registrations</span>
                <div class="w-10 h-10 rounded-xl bg-orange-100 text-[#F1400C] flex items-center justify-center font-bold">
                    <i class="fa-solid fa-user-plus text-base"></i>
                </div>
            </div>
            <div class="mt-4 flex items-baseline justify-between">
                <span class="text-3xl font-extrabold text-gray-900">{{ number_format($totalRegistrations) }}</span>
                <span class="text-xs font-semibold text-green-600 bg-green-50 px-2 py-1 rounded-md flex items-center gap-1">
                    <i class="fa-solid fa-arrow-trend-up"></i> Lifetime
                </span>
            </div>
            <p class="text-xs text-gray-500 mt-2">All student registrations</p>
        </div>

        <!-- Card 2 -->
        <div class="bg-white p-6 rounded-2xl border border-gray-200/80 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Active Competitions</span>
                <div class="w-10 h-10 rounded-xl bg-purple-100 text-[#340C6F] flex items-center justify-center font-bold">
                    <i class="fa-solid fa-trophy text-base"></i>
                </div>
            </div>
            <div class="mt-4 flex items-baseline justify-between">
                <span class="text-3xl font-extrabold text-gray-900">{{ number_format($activeCompetitions) }}</span>
                <span class="text-xs font-semibold text-blue-600 bg-blue-50 px-2 py-1 rounded-md">Live Now</span>
            </div>
            <p class="text-xs text-gray-500 mt-2">Ongoing events & exams</p>
        </div>

        <!-- Card 3 -->
        <div class="bg-white p-6 rounded-2xl border border-gray-200/80 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Upcoming Events</span>
                <div class="w-10 h-10 rounded-xl bg-blue-100 text-[#028CD4] flex items-center justify-center font-bold">
                    <i class="fa-solid fa-calendar-days text-base"></i>
                </div>
            </div>
            <div class="mt-4 flex items-baseline justify-between">
                <span class="text-3xl font-extrabold text-gray-900">{{ number_format($upcomingEvents) }}</span>
                <span class="text-xs font-semibold text-purple-600 bg-purple-50 px-2 py-1 rounded-md">Scheduled</span>
            </div>
            <p class="text-xs text-gray-500 mt-2">To be held in the future</p>
        </div>

        <!-- Card 4 -->
        <div class="bg-white p-6 rounded-2xl border border-gray-200/80 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Collections</span>
                <div class="w-10 h-10 rounded-xl bg-green-100 text-green-600 flex items-center justify-center font-bold">
                    <i class="fa-solid fa-indian-rupee-sign text-base"></i>
                </div>
            </div>
            <div class="mt-4 flex items-baseline justify-between">
                <span class="text-3xl font-extrabold text-gray-900">₹{{ number_format($totalCollections) }}</span>
                <span class="text-xs font-semibold text-green-600 bg-green-50 px-2 py-1 rounded-md flex items-center gap-1">
                    <i class="fa-solid fa-check"></i> Approved
                </span>
            </div>
            <p class="text-xs text-gray-500 mt-2">From successful registrations</p>
        </div>
    </div>

    <!-- Main Section: Recent Registrations & Quick Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Table: Recent Registrations (2 cols wide) -->
        <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-200/80 shadow-sm overflow-hidden flex flex-col">
            <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                <div>
                    <h3 class="font-bold text-lg text-gray-900">Recent Registrations</h3>
                    <p class="text-xs text-gray-500">Latest participant signups for competitions</p>
                </div>
                <a href="{{ route('admin.registrations.index') }}" class="text-xs font-bold text-[#028CD4] hover:underline">View All</a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/70 border-b border-gray-100 text-[11px] font-bold text-gray-400 uppercase tracking-wider">
                            <th class="py-3.5 px-6">Participant</th>
                            <th class="py-3.5 px-6">Competition</th>
                            <th class="py-3.5 px-6">Date</th>
                            <th class="py-3.5 px-6">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        @forelse($recentRegistrations as $registration)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="py-4 px-6 flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-purple-100 text-[#340C6F] font-bold flex items-center justify-center text-xs">
                                    {{ strtoupper(substr($registration->student_name, 0, 2)) }}
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-900">{{ $registration->student_name }}</div>
                                    <div class="text-xs text-gray-400">{{ $registration->mobile }}</div>
                                </div>
                            </td>
                            <td class="py-4 px-6 font-medium text-gray-700">{{ $registration->event->title ?? 'N/A' }}</td>
                            <td class="py-4 px-6 text-xs text-gray-500">{{ $registration->created_at->format('M d, Y h:i A') }}</td>
                            <td class="py-4 px-6">
                                @if($registration->payment_status === 'approved')
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">Confirmed</span>
                                @elseif($registration->payment_status === 'pending')
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">Pending</span>
                                @else
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">Rejected</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-8 text-center text-gray-500 text-sm">No recent registrations found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quick Actions & Status Panel (1 col wide) -->
        <div class="space-y-6">
            <!-- Quick Actions -->
            <div class="bg-white p-6 rounded-2xl border border-gray-200/80 shadow-sm">
                <h3 class="font-bold text-lg text-gray-900 mb-4">Quick Management</h3>
                <div class="space-y-3">
                    <button onclick="window.dispatchEvent(new CustomEvent('open-modal', {detail: 'add-event'}))" class="w-full p-3.5 rounded-xl border border-gray-200 hover:border-[#340C6F] hover:bg-purple-50/50 flex items-center gap-3 text-left transition-all group">
                        <div class="w-9 h-9 rounded-lg bg-purple-100 text-[#340C6F] flex items-center justify-center font-bold group-hover:bg-[#340C6F] group-hover:text-white transition-colors">
                            <i class="fa-solid fa-plus text-sm"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-sm text-gray-900">Add New Event</div>
                            <div class="text-xs text-gray-500">Create upcoming youth event</div>
                        </div>
                    </button>

                    <a href="{{ route('admin.registrations.index') }}" class="w-full p-3.5 rounded-xl border border-gray-200 hover:border-[#F1400C] hover:bg-orange-50/50 flex items-center gap-3 text-left transition-all group block">
                        <div class="w-9 h-9 rounded-lg bg-orange-100 text-[#F1400C] flex items-center justify-center font-bold group-hover:bg-[#F1400C] group-hover:text-white transition-colors">
                            <i class="fa-solid fa-file-export text-sm"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-sm text-gray-900">View Registrations</div>
                            <div class="text-xs text-gray-500">Manage all student signups</div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Server & App Status -->
            <div class="bg-gradient-to-br from-gray-900 to-brand-dark p-6 rounded-2xl text-white shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">System Status</span>
                    <span class="w-2.5 h-2.5 rounded-full bg-green-400 animate-pulse"></span>
                </div>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between items-center text-gray-300">
                        <span>Database Connection</span>
                        <span class="text-green-400 font-semibold text-xs">Healthy</span>
                    </div>
                    <div class="flex justify-between items-center text-gray-300">
                        <span>Environment</span>
                        <span class="text-blue-400 font-semibold text-xs">Docker (Sail)</span>
                    </div>
                    <div class="flex justify-between items-center text-gray-300">
                        <span>Laravel Version</span>
                        <span class="text-gray-400 text-xs">11.x</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
