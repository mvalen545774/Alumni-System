@extends('layouts.admin')

@section('content')
<div>
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Pending Accounts</h1>
        <p class="text-gray-500 mt-1">Review and manage alumni registration requests</p>
    </div>

    <!-- Header with Badge -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div class="flex items-center gap-3">
            <div class="w-1 h-8 bg-[#f5a623] rounded-full"></div>
            <div>
                <p class="text-sm text-gray-500">Pending Review</p>
                <p class="text-2xl font-bold text-[#1a3c5e]">{{ $pendingUsers->count() }}</p>
            </div>
        </div>
        <div class="bg-[#f5a623]/20 border border-[#f5a623] rounded-full px-4 py-2">
            <span class="text-[#1a3c5e] font-semibold text-sm">{{ $pendingUsers->count() }} accounts waiting</span>
        </div>
    </div>

    <!-- Pending Accounts Table -->
    <div class="bg-white rounded-2xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gradient-to-r from-[#1a3c5e] to-[#2d5a7b] text-white">
                        <th class="px-6 py-4 text-left text-sm font-semibold">Name</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Email</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Student ID</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Degree Program</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Registration Date</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendingUsers as $user)
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition duration-200">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 bg-[#f5a623]/20 rounded-full flex items-center justify-center">
                                    <span class="text-[#1a3c5e] font-semibold text-sm">{{ substr($user->name, 0, 1) }}</span>
                                </div>
                                <span class="font-medium text-gray-800">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-600">{{ $user->email }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-block bg-gray-100 text-gray-700 px-2 py-1 rounded-lg text-xs font-mono">{{ $user->student_id }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-block bg-[#e8f4f8] text-[#1a3c5e] px-2 py-1 rounded-full text-xs">{{ $user->degreeProgram->program_name ?? 'N/A' }}</span>
                        </td>
                        <td class="px-6 py-4 text-gray-500 text-sm">{{ $user->created_at->format('M d, Y') }}</td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2">
                                <form action="{{ route('admin.pending.approve', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Approve {{ $user->name }}? They will be able to login immediately.')">
                                    @csrf
                                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-1.5 rounded-xl transition flex items-center gap-1 text-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        
                                    </button>
                                </form>
                                <form action="{{ route('admin.pending.reject', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Reject {{ $user->name }}? This action cannot be undone.')">
                                    @csrf
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-1.5 rounded-xl transition flex items-center gap-1 text-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="text-gray-400">
                                <svg class="w-20 h-20 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p class="text-lg font-medium">No Pending Accounts</p>
                                <p class="text-sm mt-1">All alumni accounts have been reviewed.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Info Card -->
    <div class="mt-6 bg-[#e8f4f8] border border-[#1a3c5e]/20 rounded-2xl p-4">
        <div class="flex items-start gap-3">
            <svg class="w-5 h-5 text-[#1a3c5e] mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <div>
                <p class="text-sm text-[#1a3c5e]">
                    <strong>Note:</strong> Approved alumni will be able to login immediately and access all alumni features including profile management, directory, and job board.
                </p>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    @if($pendingUsers->count() > 0)
    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white rounded-2xl shadow-sm p-4 text-center">
            <div class="text-2xl font-bold text-[#f5a623]">{{ $pendingUsers->count() }}</div>
            <div class="text-xs text-gray-500 uppercase">Pending Review</div>
        </div>
        <div class="bg-white rounded-2xl shadow-sm p-4 text-center">
            <div class="text-2xl font-bold text-[#f5a623]">{{ $pendingUsers->where('created_at', '>=', now()->subDays(7))->count() }}</div>
            <div class="text-xs text-gray-500 uppercase">Last 7 Days</div>
        </div>
        <div class="bg-white rounded-2xl shadow-sm p-4 text-center">
            <div class="text-2xl font-bold text-[#f5a623]">{{ $pendingUsers->groupBy('degree_program_id')->count() }}</div>
            <div class="text-xs text-gray-500 uppercase">Programs Represented</div>
        </div>
    </div>
    @endif
</div>
@endsection