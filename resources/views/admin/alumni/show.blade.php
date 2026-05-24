@extends('layouts.admin')

@section('content')
<div>
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center gap-3">
            @if($alumni->profile_picture)
                <img src="{{ asset('storage/' . $alumni->profile_picture) }}" alt="Profile" class="w-16 h-16 rounded-full object-cover border-4 border-[#f5a623]">
            @else
                <div class="w-16 h-16 rounded-full bg-gradient-to-r from-[#1a3c5e] to-[#2d5a7b] flex items-center justify-center">
                    <span class="text-white text-2xl font-bold">{{ substr($alumni->name, 0, 1) }}</span>
                </div>
            @endif
            <div>
                <h1 class="text-3xl font-bold text-gray-800">{{ $alumni->name }}</h1>
                <p class="text-gray-500 mt-1">Alumni Profile</p>
            </div>
        </div>
    </div>

    <!-- Profile Details Card -->
    <div class="bg-white rounded-2xl shadow-md overflow-hidden">
        <div class="bg-gradient-to-r from-[#1a3c5e] to-[#2d5a7b] px-6 py-4">
            <div class="flex items-center gap-2">
                <div class="bg-[#f5a623] rounded-lg p-1">
                    <svg class="w-5 h-5 text-[#1a3c5e]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-white">Alumni Details</h2>
            </div>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Personal Information -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 border-b-2 border-gray-200 pb-2 mb-4">Personal Information</h3>
                    <div class="space-y-3">
                        <div class="flex">
                            <div class="w-32 text-gray-500 font-medium">Student ID:</div>
                            <div class="text-gray-800">{{ $alumni->student_id }}</div>
                        </div>
                        <div class="flex">
                            <div class="w-32 text-gray-500 font-medium">Full Name:</div>
                            <div class="text-gray-800">{{ $alumni->name }}</div>
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

                <!-- Academic Information -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 border-b-2 border-gray-200 pb-2 mb-4">Academic Information</h3>
                    <div class="space-y-3">
                        <div class="flex">
                            <div class="w-32 text-gray-500 font-medium">Degree Program:</div>
                            <div class="text-gray-800">{{ $alumni->degreeProgram->program_name ?? 'N/A' }}</div>
                        </div>
                        <div class="flex">
                            <div class="w-32 text-gray-500 font-medium">Year Graduated:</div>
                            <div class="text-gray-800">{{ $alumni->year_graduated }}</div>
                        </div>
                    </div>

                    <h3 class="text-lg font-semibold text-gray-800 border-b-2 border-gray-200 pb-2 mb-4 mt-6">Employment Information</h3>
                    <div class="space-y-3">
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

            <div class="mt-8 pt-4 border-t border-gray-200 flex justify-end gap-3">
                <a href="{{ route('admin.alumni.edit', $alumni->id) }}" class="px-5 py-2 bg-[#f5a623] hover:bg-[#f4b84a] text-[#1a3c5e] rounded-xl transition font-semibold flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit Alumni
                </a>
                <a href="{{ route('admin.alumni.index') }}" class="px-5 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-xl transition">Close</a>
            </div>
        </div>
    </div>
</div>
@endsection