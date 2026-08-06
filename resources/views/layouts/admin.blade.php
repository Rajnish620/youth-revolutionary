<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - Youth Revolutionary')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            purple: '#7C3AED',
                            orange: '#8B5CF6',
                            blue: '#028CD4',
                            dark: '#1e1b4b',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* Custom Scrollbar for Sidebar */
        .sidebar-scroll::-webkit-scrollbar {
            width: 4px;
        }
        .sidebar-scroll::-webkit-scrollbar-track {
            background: transparent;
        }
        .sidebar-scroll::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }
        .sidebar-scroll::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased flex h-screen overflow-hidden" x-data="{ sidebarCollapsed: false, mobileSidebarOpen: false }">

    <!-- Mobile Overlay -->
    <div x-show="mobileSidebarOpen" 
         @click="mobileSidebarOpen = false"
         class="fixed inset-0 bg-black/50 z-30 lg:hidden"
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         style="display: none;">
    </div>

    <!-- Collapsible Sidebar -->
    <aside 
        :class="[
            sidebarCollapsed ? 'w-20' : 'w-64',
            mobileSidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'
        ]" 
        class="bg-brand-dark text-white flex flex-col justify-between flex-shrink-0 z-40 shadow-2xl absolute inset-y-0 left-0 lg:relative transition-transform duration-300 ease-in-out overflow-hidden"
    >
        <!-- Decorative Top Glow -->
        <div class="absolute top-0 left-0 w-full h-32 bg-gradient-to-b from-brand-orange/20 to-transparent pointer-events-none"></div>

        <div class="flex-1 overflow-y-auto overflow-x-hidden sidebar-scroll">
            <!-- Logo Section -->
            <div class="h-20 flex items-center px-4 border-b border-white/10 gap-3 justify-between sticky top-0 bg-brand-dark z-20">
                <div class="flex items-center gap-3 overflow-hidden">
                    <img src="{{ asset('logo/logo.jpeg') }}" alt="Logo" class="w-10 h-10 rounded-full border-2 border-brand-orange shadow-md shrink-0">
                    <div x-show="!sidebarCollapsed" x-transition.opacity class="truncate">
                        <span class="font-extrabold text-white text-base tracking-wider block leading-none">YOUTH</span>
                        <span class="font-extrabold text-brand-orange text-xs tracking-widest block leading-tight mt-0.5">REVOLUTIONARY</span>
                    </div>
                </div>

                <!-- Collapse Toggle Button inside Sidebar -->
                <button @click="sidebarCollapsed = !sidebarCollapsed" class="hidden lg:flex w-8 h-8 rounded-lg bg-white/10 hover:bg-white/20 text-gray-300 items-center justify-center transition-all shrink-0">
                    <i class="fa-solid text-xs" :class="sidebarCollapsed ? 'fa-chevron-right' : 'fa-chevron-left'"></i>
                </button>
            </div>

            <!-- Navigation Links -->
            <nav class="p-3 space-y-1.5">
                <div x-show="!sidebarCollapsed" class="text-[11px] font-bold text-gray-400 uppercase tracking-wider px-3 mb-2 transition-all">Main Menu</div>
                
                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}" 
                   title="Dashboard"
                   class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl font-semibold text-sm transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-brand-orange to-brand-purple text-white shadow-lg shadow-brand-orange/30' : 'text-gray-300 hover:text-white hover:bg-white/5' }}">
                    <i class="fa-solid fa-chart-pie text-lg shrink-0 w-6 text-center"></i>
                    <span x-show="!sidebarCollapsed" class="truncate">Dashboard</span>
                </a>

                <!-- Competitions -->
                {{-- 
                <a href="{{ route('admin.competitions.index') }}" 
                   title="Competitions"
                   class="flex items-center justify-between px-3.5 py-3 rounded-xl font-semibold text-sm transition-all duration-200 {{ request()->routeIs('admin.competitions.*') ? 'bg-gradient-to-r from-brand-orange to-brand-purple text-white shadow-lg shadow-brand-orange/30' : 'text-gray-300 hover:text-white hover:bg-white/5 group' }}">
                    <div class="flex items-center gap-3.5 truncate">
                        <i class="fa-solid fa-trophy text-lg shrink-0 w-6 text-center {{ request()->routeIs('admin.competitions.*') ? 'text-white' : 'text-gray-400 group-hover:text-brand-orange' }} transition-colors"></i>
                        <span x-show="!sidebarCollapsed" class="truncate">Competitions</span>
                    </div>
                    <i x-show="!sidebarCollapsed" class="fa-solid fa-chevron-right text-xs {{ request()->routeIs('admin.competitions.*') ? 'text-white' : 'text-gray-500 group-hover:translate-x-1' }} transition-transform"></i>
                </a>
                --}}

                <!-- Events -->
                <a href="{{ route('admin.events.index') }}" 
                   title="Events"
                   class="flex items-center justify-between px-3.5 py-3 rounded-xl font-semibold text-sm transition-all duration-200 {{ request()->routeIs('admin.events.*') ? 'bg-gradient-to-r from-brand-orange to-brand-purple text-white shadow-lg shadow-brand-orange/30' : 'text-gray-300 hover:text-white hover:bg-white/5 group' }}">
                    <div class="flex items-center gap-3.5 truncate">
                        <i class="fa-solid fa-calendar-check text-lg shrink-0 w-6 text-center {{ request()->routeIs('admin.events.*') ? 'text-white' : 'text-gray-400 group-hover:text-brand-orange' }} transition-colors"></i>
                        <span x-show="!sidebarCollapsed" class="truncate">Events</span>
                    </div>
                    <i x-show="!sidebarCollapsed" class="fa-solid fa-chevron-right text-xs {{ request()->routeIs('admin.events.*') ? 'text-white' : 'text-gray-500 group-hover:translate-x-1' }} transition-transform"></i>
                </a>

                <!-- Event Class Groups -->
                <a href="{{ route('admin.groups.index') }}" 
                   title="Event Class Groups"
                   class="flex items-center justify-between px-3.5 py-3 rounded-xl font-semibold text-sm transition-all duration-200 {{ request()->routeIs('admin.groups.*') ? 'bg-gradient-to-r from-brand-orange to-brand-purple text-white shadow-lg shadow-brand-orange/30' : 'text-gray-300 hover:text-white hover:bg-white/5 group' }}">
                    <div class="flex items-center gap-3.5 truncate">
                        <i class="fa-solid fa-layer-group text-lg shrink-0 w-6 text-center {{ request()->routeIs('admin.groups.*') ? 'text-white' : 'text-gray-400 group-hover:text-orange-400' }} transition-colors"></i>
                        <span x-show="!sidebarCollapsed" class="truncate">Event Class Groups</span>
                    </div>
                    <i x-show="!sidebarCollapsed" class="fa-solid fa-chevron-right text-xs {{ request()->routeIs('admin.groups.*') ? 'text-white' : 'text-gray-500 group-hover:translate-x-1' }} transition-transform"></i>
                </a>

                <!-- Categories -->
                <a href="{{ route('admin.categories.index') }}" 
                   title="Categories"
                   class="flex items-center justify-between px-3.5 py-3 rounded-xl font-semibold text-sm transition-all duration-200 {{ request()->routeIs('admin.categories.*') ? 'bg-gradient-to-r from-brand-orange to-brand-purple text-white shadow-lg shadow-brand-orange/30' : 'text-gray-300 hover:text-white hover:bg-white/5 group' }}">
                    <div class="flex items-center gap-3.5 truncate">
                        <i class="fa-solid fa-tags text-lg shrink-0 w-6 text-center {{ request()->routeIs('admin.categories.*') ? 'text-white' : 'text-gray-400 group-hover:text-green-400' }} transition-colors"></i>
                        <span x-show="!sidebarCollapsed" class="truncate">Categories</span>
                    </div>
                    <i x-show="!sidebarCollapsed" class="fa-solid fa-chevron-right text-xs {{ request()->routeIs('admin.categories.*') ? 'text-white' : 'text-gray-500 group-hover:translate-x-1' }} transition-transform"></i>
                </a>

                <!-- Seasons -->
                <a href="{{ route('admin.seasons.index') }}" 
                   title="Seasons"
                   class="flex items-center justify-between px-3.5 py-3 rounded-xl font-semibold text-sm transition-all duration-200 {{ request()->routeIs('admin.seasons.*') ? 'bg-gradient-to-r from-brand-orange to-brand-purple text-white shadow-lg shadow-brand-orange/30' : 'text-gray-300 hover:text-white hover:bg-white/5 group' }}">
                    <div class="flex items-center gap-3.5 truncate">
                        <i class="fa-solid fa-calendar text-lg shrink-0 w-6 text-center {{ request()->routeIs('admin.seasons.*') ? 'text-white' : 'text-gray-400 group-hover:text-blue-400' }} transition-colors"></i>
                        <span x-show="!sidebarCollapsed" class="truncate">Seasons</span>
                    </div>
                    <i x-show="!sidebarCollapsed" class="fa-solid fa-chevron-right text-xs {{ request()->routeIs('admin.seasons.*') ? 'text-white' : 'text-gray-500 group-hover:translate-x-1' }} transition-transform"></i>
                </a>

                <!-- Registrations -->
                <a href="{{ route('admin.registrations.index') }}" 
                   title="Registrations & Payments"
                   class="flex items-center justify-between px-3.5 py-3 rounded-xl font-semibold text-sm transition-all duration-200 {{ request()->routeIs('admin.registrations.*') ? 'bg-gradient-to-r from-brand-orange to-brand-purple text-white shadow-lg shadow-brand-orange/30' : 'text-gray-300 hover:text-white hover:bg-white/5 group' }}">
                    <div class="flex items-center gap-3.5 truncate">
                        <i class="fa-solid fa-users text-lg shrink-0 w-6 text-center {{ request()->routeIs('admin.registrations.*') ? 'text-white' : 'text-gray-400 group-hover:text-green-400' }} transition-colors"></i>
                        <span x-show="!sidebarCollapsed" class="truncate">Registrations</span>
                    </div>
                    <i x-show="!sidebarCollapsed" class="fa-solid fa-chevron-right text-xs {{ request()->routeIs('admin.registrations.*') ? 'text-white' : 'text-gray-500 group-hover:translate-x-1' }} transition-transform"></i>
                </a>

                <!-- Marks & Certificates -->
                <a href="{{ route('admin.marks.index') }}" 
                   title="Marks & Certificates"
                   class="flex items-center justify-between px-3.5 py-3 rounded-xl font-semibold text-sm transition-all duration-200 {{ request()->routeIs('admin.marks.*') ? 'bg-gradient-to-r from-brand-orange to-brand-purple text-white shadow-lg shadow-brand-orange/30' : 'text-gray-300 hover:text-white hover:bg-white/5 group' }}">
                    <div class="flex items-center gap-3.5 truncate">
                        <i class="fa-solid fa-award text-lg shrink-0 w-6 text-center {{ request()->routeIs('admin.marks.*') ? 'text-white' : 'text-gray-400 group-hover:text-amber-400' }} transition-colors"></i>
                        <span x-show="!sidebarCollapsed" class="truncate">Marks & Certificates</span>
                    </div>
                    <i x-show="!sidebarCollapsed" class="fa-solid fa-chevron-right text-xs {{ request()->routeIs('admin.marks.*') ? 'text-white' : 'text-gray-500 group-hover:translate-x-1' }} transition-transform"></i>
                </a>

                <!-- Gallery -->
                <a href="{{ route('admin.gallery.index') }}" 
                   title="Gallery"
                   class="flex items-center justify-between px-3.5 py-3 rounded-xl font-semibold text-sm transition-all duration-200 {{ request()->routeIs('admin.gallery.*') ? 'bg-gradient-to-r from-brand-orange to-brand-purple text-white shadow-lg shadow-brand-orange/30' : 'text-gray-300 hover:text-white hover:bg-white/5 group' }}">
                    <div class="flex items-center gap-3.5 truncate">
                        <i class="fa-solid fa-images text-lg shrink-0 w-6 text-center {{ request()->routeIs('admin.gallery.*') ? 'text-white' : 'text-gray-400 group-hover:text-purple-400' }} transition-colors"></i>
                        <span x-show="!sidebarCollapsed" class="truncate">Gallery</span>
                    </div>
                </a>

                <!-- Inquiries -->
                <a href="{{ route('admin.inquiries.index') }}" 
                   title="Contact Inquiries"
                   class="flex items-center justify-between px-3.5 py-3 rounded-xl font-semibold text-sm transition-all duration-200 {{ request()->routeIs('admin.inquiries.*') ? 'bg-gradient-to-r from-brand-orange to-brand-purple text-white shadow-lg shadow-brand-orange/30' : 'text-gray-300 hover:text-white hover:bg-white/5 group' }}">
                    <div class="flex items-center gap-3.5 truncate">
                        <i class="fa-solid fa-inbox text-lg shrink-0 w-6 text-center {{ request()->routeIs('admin.inquiries.*') ? 'text-white' : 'text-gray-400 group-hover:text-cyan-400' }} transition-colors"></i>
                        <span x-show="!sidebarCollapsed" class="truncate">Contact Inquiries</span>
                    </div>
                </a>

                <div x-show="!sidebarCollapsed" class="text-[11px] font-bold text-gray-400 uppercase tracking-wider px-3 pt-6 mb-2">System</div>

                <!-- Settings -->
                <a href="{{ route('admin.settings.contact.index') }}" 
                   title="Settings"
                   class="flex items-center justify-between px-3.5 py-3 rounded-xl font-semibold text-sm transition-all duration-200 {{ request()->routeIs('admin.settings.*') ? 'bg-gradient-to-r from-brand-orange to-brand-purple text-white shadow-lg shadow-brand-orange/30' : 'text-gray-300 hover:text-white hover:bg-white/5 group' }}">
                    <div class="flex items-center gap-3.5 truncate">
                        <i class="fa-solid fa-gear text-lg shrink-0 w-6 text-center {{ request()->routeIs('admin.settings.*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }} transition-colors"></i>
                        <span x-show="!sidebarCollapsed" class="truncate">Settings</span>
                    </div>
                    <i x-show="!sidebarCollapsed" class="fa-solid fa-chevron-right text-xs {{ request()->routeIs('admin.settings.*') ? 'text-white' : 'text-gray-500 group-hover:translate-x-1' }} transition-transform"></i>
                </a>
            </nav>
        </div>

        <!-- Admin Profile & Logout Footer -->
        <div class="p-3 border-t border-white/10 bg-black/20">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3 overflow-hidden">
                    <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-brand-orange to-brand-purple flex items-center justify-center font-bold text-white shadow-md shrink-0">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div x-show="!sidebarCollapsed" class="leading-tight truncate">
                        <div class="font-bold text-sm text-white truncate max-w-[110px]">{{ auth()->user()->name ?? 'Admin' }}</div>
                        <div class="text-xs text-gray-400 truncate max-w-[110px]">{{ auth()->user()->email ?? 'admin@sws.com' }}</div>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}" x-show="!sidebarCollapsed">
                    @csrf
                    <button type="submit" title="Logout" class="w-8 h-8 rounded-xl bg-white/10 hover:bg-red-500/80 hover:text-white text-gray-300 flex items-center justify-center transition-all duration-200 cursor-pointer">
                        <i class="fa-solid fa-right-from-bracket text-xs"></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden bg-gray-50/50">
        
        <!-- Header Navbar -->
        <header class="h-20 bg-white border-b border-gray-200/80 px-6 sm:px-8 flex items-center justify-between flex-shrink-0 z-10 shadow-sm">
            <!-- Sidebar Collapse Toggle Button on Header -->
            <div class="flex items-center gap-4">
                <!-- Desktop toggle -->
                <button @click="sidebarCollapsed = !sidebarCollapsed" 
                        class="hidden lg:flex w-10 h-10 rounded-xl bg-gray-100 text-gray-600 hover:bg-brand-purple/10 hover:text-brand-purple items-center justify-center transition-all cursor-pointer"
                        title="Toggle Minimize Sidebar">
                    <i class="fa-solid text-sm" :class="sidebarCollapsed ? 'fa-bars-staggered' : 'fa-bars'"></i>
                </button>
                <!-- Mobile toggle -->
                <button @click="mobileSidebarOpen = !mobileSidebarOpen" 
                        class="flex lg:hidden w-10 h-10 rounded-xl bg-gray-100 text-gray-600 hover:bg-brand-purple/10 hover:text-brand-purple items-center justify-center transition-all cursor-pointer"
                        title="Toggle Mobile Sidebar">
                    <i class="fa-solid text-sm fa-bars"></i>
                </button>

                <!-- Search Bar -->
                <div class="relative w-64 sm:w-80 hidden sm:block">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                    <input type="text" placeholder="Search events, users, entries..." 
                        class="w-full bg-gray-100/80 text-sm pl-11 pr-4 py-2 rounded-xl outline-none focus:bg-white focus:ring-2 focus:ring-brand-purple/20 focus:border-brand-purple border border-transparent transition-all">
                </div>
            </div>

            <!-- Right Controls -->
            <div class="flex items-center gap-4">
                <!-- Notifications -->
                <button class="w-10 h-10 rounded-xl bg-gray-100 text-gray-600 hover:bg-brand-purple/10 hover:text-brand-purple flex items-center justify-center relative transition-all">
                    <i class="fa-solid fa-bell"></i>
                    <span class="absolute top-2 right-2 w-2 h-2 rounded-full bg-brand-orange animate-ping"></span>
                    <span class="absolute top-2 right-2 w-2 h-2 rounded-full bg-brand-orange"></span>
                </button>

                <!-- Quick Visit Website -->
                <a href="{{ url('/') }}" target="_blank" class="hidden sm:flex items-center gap-2 px-4 py-2.5 rounded-xl bg-brand-purple/10 text-brand-purple hover:bg-brand-purple hover:text-white font-semibold text-xs transition-all duration-200">
                    <i class="fa-solid fa-globe"></i>
                    <span>Visit Site</span>
                </a>
            </div>
        </header>

        <!-- Main Dynamic Content -->
        <main class="flex-1 overflow-y-auto p-6 sm:p-8">
            @yield('content')
        </main>
    </div>

</body>
</html>
