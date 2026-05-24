@extends('layouts.admin')

@section('content')
<div>
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Alumni Directory</h1>
        <p class="text-gray-500 mt-1">Manage and view all registered Monsters</p>
    </div>

    <!-- Header with Add Button -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div class="flex items-center gap-3">
            <div class="w-1 h-8 bg-[#f5a623] rounded-full"></div>
            <div>
                <p class="text-sm text-gray-500">Total Alumni</p>
                <p class="text-2xl font-bold text-[#1a3c5e]">{{ $alumni->total() }}</p>
            </div>
        </div>
        <a href="{{ route('admin.alumni.create') }}" class="bg-[#f5a623] hover:bg-[#f4b84a] text-[#1a3c5e] px-5 py-2 rounded-full transition shadow-sm flex items-center gap-2 font-semibold">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Add Alumni
        </a>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-2xl shadow-md p-4 mb-6">
        <form method="GET" class="flex flex-col sm:flex-row gap-3">
            <div class="flex-1">
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input type="text" name="search" placeholder="Search by name..." value="{{ request('search') }}" class="w-full pl-10 pr-3 py-2 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#f5a623] focus:border-transparent">
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                    </svg>
                    Filter
                </button>
                @if(request('search') || request('degree_program'))
                    <a href="{{ route('admin.alumni.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2 rounded-xl transition">Clear</a>
                @endif
            </div>
        </form>
    </div>

    <!-- Alumni Table -->
    <div class="bg-white rounded-2xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gradient-to-r from-[#1a3c5e] to-[#2d5a7b] text-white">
                        <th class="px-6 py-4 text-left text-sm font-semibold">Photo</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Student ID</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Name</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Degree Program</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Year Graduated</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Employment</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($alumni as $alumnus)
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition duration-200">
                        <td class="px-6 py-4">
                            @if($alumnus->profile_picture)
                                <img src="{{ asset('storage/' . $alumnus->profile_picture) }}" alt="Profile" class="w-10 h-10 rounded-full object-cover border-2 border-[#f5a623]">
                            @else
                                <div class="w-10 h-10 rounded-full bg-gradient-to-r from-[#1a3c5e] to-[#2d5a7b] flex items-center justify-center">
                                    <span class="text-white text-sm font-bold">{{ substr($alumnus->name, 0, 1) }}</span>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-block bg-gray-100 text-gray-700 px-2 py-1 rounded-lg text-sm font-mono">{{ $alumnus->student_id }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="font-medium text-gray-800 text-base">{{ $alumnus->name }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-block bg-[#e8f4f8] text-[#1a3c5e] px-3 py-1.5 rounded-full text-sm font-medium">{{ $alumnus->degreeProgram->program_name ?? 'N/A' }}</span>
                        </td>
                        <td class="px-6 py-4 text-gray-700 text-base">{{ $alumnus->year_graduated }}</td>
                        <td class="px-6 py-4">
                            @php
                                $status = $alumnus->alumni->employment_status ?? 'N/A';
                                $badgeClass = match($status) {
                                    'employed' => 'bg-green-100 text-green-700',
                                    'unemployed' => 'bg-red-100 text-red-700',
                                    'self-employed' => 'bg-blue-100 text-blue-700',
                                    'student' => 'bg-yellow-100 text-yellow-700',
                                    default => 'bg-gray-100 text-gray-700'
                                };
                            @endphp
                            <span class="inline-block {{ $badgeClass }} px-3 py-1.5 rounded-full text-sm font-semibold">
                                {{ ucfirst($status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2">
                                <a href="{{ route('admin.alumni.show', $alumnus->id) }}" class="bg-[#f5a623] hover:bg-[#f4b84a] text-[#1a3c5e] px-3 py-2 rounded-xl transition flex items-center gap-1 text-sm font-medium">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    
                                </a>
                                <a href="{{ route('admin.alumni.edit', $alumnus->id) }}" class="bg-[#1a3c5e] hover:bg-[#2d5a7b] text-white px-3 py-2 rounded-xl transition flex items-center gap-1 text-sm font-medium">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    
                                </a>
                                <form action="{{ route('admin.alumni.destroy', $alumnus->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete {{ $alumnus->name }}? This action cannot be undone.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-xl transition flex items-center gap-1 text-sm font-medium">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">
                            <div class="text-gray-400">
                                <svg class="w-20 h-20 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                <p class="text-lg font-medium">No Alumni Found</p>
                                <p class="text-sm mt-1">Click "Add Alumni" to add your first monster graduate.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($alumni->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $alumni->links() }}
        </div>
        @endif
    </div>
</div>
@endsection