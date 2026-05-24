@extends('layouts.alumni')

@section('content')
<div>
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Alumni Directory</h1>
        <p class="text-gray-500 mt-1">Connect with fellow Monsters University graduates</p>
    </div>

    <!-- Search & Filter -->
    <div class="bg-white rounded-2xl shadow-md p-4 mb-6">
        <form method="GET" class="flex flex-col sm:flex-row gap-3">
            <div class="flex-1">
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input type="text" name="search" placeholder="Search by name..." value="{{ request('search') }}" 
                        class="w-full pl-10 pr-3 py-2 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#f5a623] focus:border-transparent">
                </div>
            </div>
            <div class="flex-1">
                <select name="degree_program" class="w-full px-3 py-2 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#f5a623] focus:border-transparent">
                    <option value="">All Degree Programs</option>
                    @foreach($degreePrograms as $program)
                        <option value="{{ $program->id }}" {{ request('degree_program') == $program->id ? 'selected' : '' }}>
                            {{ $program->program_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="bg-[#1a3c5e] hover:bg-[#2d5a7b] text-white px-5 py-2 rounded-xl transition flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Search
                </button>
                @if(request('search') || request('degree_program'))
                    <a href="{{ route('alumni.directory') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2 rounded-xl transition">Clear</a>
                @endif
            </div>
        </form>
    </div>

    <!-- Results Count -->
    <div class="mb-4">
        <p class="text-sm text-gray-500">Showing {{ $alumni->firstItem() ?? 0 }} to {{ $alumni->lastItem() ?? 0 }} of {{ $alumni->total() }} alumni</p>
    </div>

    <!-- Alumni Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($alumni as $alumnus)
        <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-lg transition transform hover:-translate-y-1">
            <!-- Card Header with Profile Picture -->
            <div class="bg-gradient-to-r from-[#1a3c5e] to-[#2d5a7b] px-4 py-4">
                <div class="flex items-center gap-3">
                    @if($alumnus->profile_picture)
                        <img src="{{ asset('storage/' . $alumnus->profile_picture) }}" alt="Profile" class="w-14 h-14 rounded-full object-cover border-2 border-[#f5a623]">
                    @else
                        <div class="w-14 h-14 rounded-full bg-[#f5a623] flex items-center justify-center">
                            <span class="text-[#1a3c5e] font-bold text-xl">{{ substr($alumnus->name, 0, 1) }}</span>
                        </div>
                    @endif
                    <div>
                        <h3 class="text-lg font-bold text-white">{{ $alumnus->name }}</h3>
                        <p class="text-blue-200 text-xs">{{ $alumnus->degreeProgram->program_name ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Card Body -->
            <div class="p-4">
                <div class="space-y-2">
                    <div class="flex items-center gap-2 text-gray-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span class="text-sm">Graduated: {{ $alumnus->year_graduated }}</span>
                    </div>
                    <div class="flex items-center gap-2 text-gray-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <span class="text-sm">
                            @php
                                $status = $alumnus->alumni->employment_status ?? 'Not set';
                                $employer = $alumnus->alumni->current_employer ?? '';
                            @endphp
                            {{ ucfirst($status) }}
                            @if($employer)
                                at {{ $employer }}
                            @endif
                        </span>
                    </div>
                </div>
                <div class="mt-4 pt-3 border-t border-gray-100">
                    <a href="{{ route('alumni.directory.show', $alumnus->id) }}" class="inline-flex items-center gap-2 text-[#f5a623] hover:text-[#f4b84a] font-medium text-sm">
                        View Profile
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12">
            <div class="text-gray-400">
                <svg class="w-20 h-20 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <p class="text-lg font-medium">No alumni found</p>
                <p class="text-sm mt-1">Try adjusting your search or filter criteria</p>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $alumni->links() }}
    </div>
</div>
@endsection