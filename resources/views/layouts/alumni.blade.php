<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monsters University - Alumni Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
        .sidebar {
            transition: all 0.3s ease;
        }
        .sidebar-item {
            transition: all 0.2s ease;
        }
        .sidebar-item:hover {
            transform: translateX(5px);
        }
    </style>
</head>
<body class="bg-gray-50">

<div class="flex h-screen overflow-hidden">
    <!-- Sidebar -->
    <aside class="sidebar w-72 bg-gradient-to-b from-[#1a3c5e] to-[#2d5a7b] shadow-xl flex-shrink-0 overflow-y-auto">
        <div class="p-6">
            <!-- Logo -->
            <div class="flex items-center gap-3 mb-8 pb-4 border-b border-blue-300/30">
                <div class="bg-[#f5f7fa] rounded-lg p-2">
                    <img src="{{ asset('images/logo.jpg') }}" alt="Monsters University logo featuring a blue and gold crest for the alumni system landing page" class="w-8 h-8 object-contain">
                </div>
                <div>
                    <h1 class="text-white font-bold text-xl">Monsters</h1>
                    <p class="text-blue-200 text-xs">Alumni Portal</p>
                </div>
            </div>

            <!-- Alumni Info -->
            <div class="flex items-center gap-3 mb-8 p-3 bg-white/10 rounded-xl">
                @if(auth()->user()->profile_picture)
                    <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="Profile" class="w-10 h-10 rounded-full object-cover bg-[#f5f7fa]">
                @else
                    <div class="w-10 h-10 rounded-full bg-[#f5a623] flex items-center justify-center">
                        <span class="text-[#1a3c5e] font-bold text-lg">{{ substr(auth()->user()->name, 0, 1) }}</span>
                    </div>
                @endif
                <div>
                    <p class="text-white text-sm font-medium">{{ auth()->user()->name }}</p>
                    <p class="text-blue-200 text-xs">Alumni Member</p>
                </div>
            </div>

            <!-- Navigation Menu -->
            <nav class="space-y-2">
                <a href="{{ route('alumni.dashboard') }}" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-xl text-white hover:bg-white/10 transition {{ request()->routeIs('alumni.dashboard') ? 'bg-white/20' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('alumni.profile') }}" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-xl text-white hover:bg-white/10 transition {{ request()->routeIs('alumni.profile') ? 'bg-white/20' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span>My Profile</span>
                </a>

                <a href="{{ route('alumni.directory') }}" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-xl text-white hover:bg-white/10 transition {{ request()->routeIs('alumni.directory') ? 'bg-white/20' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span>Alumni Directory</span>
                </a>

                <a href="{{ route('alumni.job-board') }}" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-xl text-white hover:bg-white/10 transition {{ request()->routeIs('alumni.job-board') ? 'bg-white/20' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    <span>Job Board</span>
                </a>
            </nav>

            <!-- Footer Menu -->
            <div class="mt-8 pt-4 border-t border-blue-300/30">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="sidebar-item w-full flex items-center gap-3 px-4 py-3 rounded-xl text-white hover:bg-red-500/20 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto">
        <div class="py-6 px-8">
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded-r-lg shadow-sm mb-6">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded-r-lg shadow-sm mb-6">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            @yield('content')
        </div>
    </main>
</div>
</body>
</html>