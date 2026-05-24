@extends('layouts.admin')

@section('content')
<div>
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
        <p class="text-gray-500 mt-1">Welcome back, {{ auth()->user()->name }}! Here's what's happening.</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-lg transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total Alumni</p>
                    <p class="text-3xl font-bold text-[#1a3c5e]">{{ $totalAlumni ?? 0 }}</p>
                </div>
                <div class="bg-[#e8f4f8] rounded-full p-3">
                    <svg class="w-6 h-6 text-[#1a3c5e]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-lg transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Pending Accounts</p>
                    <p class="text-3xl font-bold text-[#1a3c5e]">{{ $pendingAccounts ?? 0 }}</p>
                </div>
                <div class="bg-[#e8f4f8] rounded-full p-3">
                    <svg class="w-6 h-6 text-[#1a3c5e]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-lg transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Job Offers</p>
                    <p class="text-3xl font-bold text-[#1a3c5e]">{{ $totalJobs ?? 0 }}</p>
                </div>
                <div class="bg-[#e8f4f8] rounded-full p-3">
                    <svg class="w-6 h-6 text-[#1a3c5e]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-lg transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Degree Programs</p>
                    <p class="text-3xl font-bold text-[#1a3c5e]">{{ $totalPrograms ?? 0 }}</p>
                </div>
                <div class="bg-[#e8f4f8] rounded-full p-3">
                    <svg class="w-6 h-6 text-[#1a3c5e]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Monster Tip -->
    <div class="bg-[#f5a623]/10 border border-[#f5a623]/30 rounded-2xl p-4">
        <div class="flex items-start gap-3">
            <div class="text-2xl">👹</div>
            <div>
                <p class="text-sm text-[#1a3c5e]">
                    <strong>Monster Tip:</strong> Regularly check pending accounts to approve new alumni members. 
                    Keep alumni records updated to maintain an accurate directory.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection