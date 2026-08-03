@extends('layouts.admin')

@section('title', 'Dashboard - Admin Panel')

@section('content')
<div class="space-y-8">

    <!-- Welcome Hero Banner -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-[#340C6F] via-[#24084f] to-[#1A0638] p-8 text-white shadow-xl">
        <!-- Background Pattern Decor -->
        <div class="absolute -right-10 -bottom-10 w-72 h-72 bg-[#F1400C]/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute right-40 -top-10 w-60 h-60 bg-[#028CD4]/20 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 text-xs font-semibold text-orange-300 backdrop-blur-md mb-3 border border-white/10">
                    <span class="w-2 h-2 rounded-full bg-[#F1400C] animate-ping"></span>
                    Admin Overview
                </div>
                <h1 class="text-3xl font-extrabold tracking-tight">Welcome Back, {{ auth()->user()->name ?? 'Admin' }}! 👋</h1>
                <p class="text-purple-200 mt-2 text-sm max-w-xl">
                    Here's what's happening with Youth Revolutionary today. Track registrations, manage competitions, and review upcoming events.
                </p>
            </div>
            
            <div class="flex items-center gap-3">
                <button onclick="window.dispatchEvent(new CustomEvent('open-modal', {detail: 'create-competition'}))" class="px-5 py-3 rounded-2xl bg-[#F1400C] hover:bg-orange-600 text-white font-bold text-sm shadow-lg shadow-[#F1400C]/30 transition-all flex items-center gap-2 cursor-pointer">
                    <i class="fa-solid fa-plus"></i>
                    <span>New Competition</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Add Competition Reusable Modal -->
    <x-modal name="create-competition" title="Add New Competition" maxWidth="2xl">
        @include('admin.modals.create-competition')
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
                <span class="text-3xl font-extrabold text-gray-900">1,284</span>
                <span class="text-xs font-semibold text-green-600 bg-green-50 px-2 py-1 rounded-md flex items-center gap-1">
                    <i class="fa-solid fa-arrow-trend-up"></i> +12%
                </span>
            </div>
            <p class="text-xs text-gray-500 mt-2">Compared to last week</p>
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
                <span class="text-3xl font-extrabold text-gray-900">3</span>
                <span class="text-xs font-semibold text-blue-600 bg-blue-50 px-2 py-1 rounded-md">Live Now</span>
            </div>
            <p class="text-xs text-gray-500 mt-2">Education, Sports, Cultural</p>
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
                <span class="text-3xl font-extrabold text-gray-900">5</span>
                <span class="text-xs font-semibold text-purple-600 bg-purple-50 px-2 py-1 rounded-md">Scheduled</span>
            </div>
            <p class="text-xs text-gray-500 mt-2">Next event in 2 days</p>
        </div>

        <!-- Card 4 -->
        <div class="bg-white p-6 rounded-2xl border border-gray-200/80 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Page Views</span>
                <div class="w-10 h-10 rounded-xl bg-green-100 text-green-600 flex items-center justify-center font-bold">
                    <i class="fa-solid fa-eye text-base"></i>
                </div>
            </div>
            <div class="mt-4 flex items-baseline justify-between">
                <span class="text-3xl font-extrabold text-gray-900">45.2K</span>
                <span class="text-xs font-semibold text-green-600 bg-green-50 px-2 py-1 rounded-md flex items-center gap-1">
                    <i class="fa-solid fa-arrow-trend-up"></i> +18%
                </span>
            </div>
            <p class="text-xs text-gray-500 mt-2">Total visits this month</p>
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
                <button class="text-xs font-bold text-[#028CD4] hover:underline">View All</button>
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
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="py-4 px-6 flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-purple-100 text-[#340C6F] font-bold flex items-center justify-center text-xs">
                                    RS
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-900">Rahul Sharma</div>
                                    <div class="text-xs text-gray-400">rahul@gmail.com</div>
                                </div>
                            </td>
                            <td class="py-4 px-6 font-medium text-gray-700">Sports Meet 2026</td>
                            <td class="py-4 px-6 text-xs text-gray-500">Today, 02:45 PM</td>
                            <td class="py-4 px-6">
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">Confirmed</span>
                            </td>
                        </tr>

                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="py-4 px-6 flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-orange-100 text-[#F1400C] font-bold flex items-center justify-center text-xs">
                                    VP
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-900">Priya Verma</div>
                                    <div class="text-xs text-gray-400">priya@gmail.com</div>
                                </div>
                            </td>
                            <td class="py-4 px-6 font-medium text-gray-700">Cultural Fest</td>
                            <td class="py-4 px-6 text-xs text-gray-500">Today, 11:20 AM</td>
                            <td class="py-4 px-6">
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">Pending</span>
                            </td>
                        </tr>

                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="py-4 px-6 flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-blue-100 text-[#028CD4] font-bold flex items-center justify-center text-xs">
                                    AK
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-900">Amit Kumar</div>
                                    <div class="text-xs text-gray-400">amit@gmail.com</div>
                                </div>
                            </td>
                            <td class="py-4 px-6 font-medium text-gray-700">Education Quiz</td>
                            <td class="py-4 px-6 text-xs text-gray-500">Yesterday</td>
                            <td class="py-4 px-6">
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">Confirmed</span>
                            </td>
                        </tr>
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
                    <button class="w-full p-3.5 rounded-xl border border-gray-200 hover:border-[#340C6F] hover:bg-purple-50/50 flex items-center gap-3 text-left transition-all group">
                        <div class="w-9 h-9 rounded-lg bg-purple-100 text-[#340C6F] flex items-center justify-center font-bold group-hover:bg-[#340C6F] group-hover:text-white transition-colors">
                            <i class="fa-solid fa-plus text-sm"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-sm text-gray-900">Add New Event</div>
                            <div class="text-xs text-gray-500">Create upcoming youth event</div>
                        </div>
                    </button>

                    <button class="w-full p-3.5 rounded-xl border border-gray-200 hover:border-[#F1400C] hover:bg-orange-50/50 flex items-center gap-3 text-left transition-all group">
                        <div class="w-9 h-9 rounded-lg bg-orange-100 text-[#F1400C] flex items-center justify-center font-bold group-hover:bg-[#F1400C] group-hover:text-white transition-colors">
                            <i class="fa-solid fa-file-export text-sm"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-sm text-gray-900">Export Registrations</div>
                            <div class="text-xs text-gray-500">Download Excel/CSV report</div>
                        </div>
                    </button>
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
