@extends('layouts.alumni')

@section('content')
<div>
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center gap-4">
            @if($alumni->profile_picture)
                <img src="{{ asset('storage/' . $alumni->profile_picture) }}" alt="Profile" class="w-20 h-20 rounded-full object-cover border-4 border-[#f5a623] shadow-md">
            @else
                <div class="w-20 h-20 rounded-full bg-gradient-to-r from-[#1a3c5e] to-[#2d5a7b] flex items-center justify-center border-4 border-[#f5a623]">
                    <span class="text-white text-3xl font-bold">{{ substr($alumni->name, 0, 1) }}</span>
                </div>
            @endif
            <div>
                <h1 class="text-3xl font-bold text-gray-800">{{ $alumni->name }}</h1>
                <p class="text-gray-500 mt-1">{{ $alumni->degreeProgram->program_name ?? 'N/A' }} • Class of {{ $alumni->year_graduated }}</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Personal Information -->
        <div class="bg-white rounded-2xl shadow-md overflow-hidden">
            <div class="bg-gradient-to-r from-[#1a3c5e] to-[#2d5a7b] px-6 py-4">
                <div class="flex items-center gap-2">
                    <div class="bg-[#f5a623] rounded-lg p-1">
                        <svg class="w-5 h-5 text-[#1a3c5e]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h2 class="text-lg font-bold text-white">Personal Information</h2>
                </div>
            </div>
            <div class="p-6 space-y-3">
                <div class="flex">
                    <div class="w-32 text-gray-500 font-medium">Student ID:</div>
                    <div class="text-gray-800">{{ $alumni->student_id }}</div>
                </div>
                <div class="flex">
                    <div class="w-32 text-gray-500 font-medium">Email:</div>
                    <div class="text-gray-800">{{ $alumni->email }}</div>
                </div>
                <div class="flex">
                    <div class="w-32 text-gray-500 font-medium">Phone:</div>
                    <div class="text-gray-800">{{ $alumni->phone }}</div>
                </div>
                <div class="flex">
                    <div class="w-32 text-gray-500 font-medium">Address:</div>
                    <div class="text-gray-800">{{ $alumni->address }}</div>
                </div>
            </div>
        </div>

        <!-- Academic & Employment Information -->
        <div class="space-y-6">
            <!-- Academic Information -->
            <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                <div class="bg-gradient-to-r from-[#1a3c5e] to-[#2d5a7b] px-6 py-4">
                    <div class="flex items-center gap-2">
                        <div class="bg-[#f5a623] rounded-lg p-1">
                            <svg class="w-5 h-5 text-[#1a3c5e]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <h2 class="text-lg font-bold text-white">Academic Information</h2>
                    </div>
                </div>
                <div class="p-6 space-y-3">
                    <div class="flex">
                        <div class="w-32 text-gray-500 font-medium">Degree Program:</div>
                        <div class="text-gray-800">{{ $alumni->degreeProgram->program_name ?? 'N/A' }}</div>
                    </div>
                    <div class="flex">
                        <div class="w-32 text-gray-500 font-medium">Year Graduated:</div>
                        <div class="text-gray-800">{{ $alumni->year_graduated }}</div>
                    </div>
                </div>
            </div>

            <!-- Employment Information -->
            <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                <div class="bg-gradient-to-r from-[#1a3c5e] to-[#2d5a7b] px-6 py-4">
                    <div class="flex items-center gap-2">
                        <div class="bg-[#f5a623] rounded-lg p-1">
                            <svg class="w-5 h-5 text-[#1a3c5e]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h2 class="text-lg font-bold text-white">Employment Information</h2>
                    </div>
                </div>
                <div class="p-6 space-y-3">
                    <div class="flex">
                        <div class="w-32 text-gray-500 font-medium">Employment Status:</div>
                        <div class="text-gray-800">
                            @php
                                $status = $alumni->alumni->employment_status ?? 'N/A';
                                $badgeClass = match($status) {
                                    'employed' => 'bg-green-100 text-green-700',
                                    'unemployed' => 'bg-red-100 text-red-700',
                                    'self-employed' => 'bg-blue-100 text-blue-700',
                                    'student' => 'bg-yellow-100 text-yellow-700',
                                    default => 'bg-gray-100 text-gray-700'
                                };
                            @endphp
                            <span class="inline-block {{ $badgeClass }} px-2 py-1 rounded-full text-xs font-semibold">
                                {{ ucfirst($status) }}
                            </span>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="w-32 text-gray-500 font-medium">Current Employer:</div>
                        <div class="text-gray-800">{{ $alumni->alumni->current_employer ?? 'N/A' }}</div>
                    </div>
                    <div class="flex">
                        <div class="w-32 text-gray-500 font-medium">Job Title:</div>
                        <div class="text-gray-800">{{ $alumni->alumni->job_title ?? 'N/A' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Connect Message -->
    <div class="mt-6 bg-[#f5a623]/10 border border-[#f5a623]/30 rounded-2xl p-4">
        <div class="flex items-start gap-3">
            <div class="text-2xl">👹</div>
            <div>
                <p class="text-sm text-[#1a3c5e]">
                    <strong>Connect with {{ $alumni->name }}:</strong> You can reach out to fellow alumni through their provided contact information. Building your network helps everyone grow!
                </p>
            </div>
        </div>
    </div>

    <!-- Back Button -->
    <div class="mt-6 flex justify-end">
        <a href="{{ route('alumni.directory') }}" class="inline-flex items-center gap-2 px-5 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-xl transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Directory
        </a>
    </div>
</div>
@endsection