@extends('layouts.admin')

@section('content')
<div>
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Job Offers</h1>
        <p class="text-gray-500 mt-1">Manage job opportunities posted by administrators and alumni</p>
    </div>

    <!-- Header with Add Button -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div class="flex items-center gap-3">
            <div class="w-1 h-8 bg-[#f5a623] rounded-full"></div>
            <div>
                <p class="text-sm text-gray-500">Total Jobs</p>
                <p class="text-2xl font-bold text-[#1a3c5e]">{{ $jobs->total() }}</p>
            </div>
        </div>
        <button onclick="document.getElementById('postJobModal').classList.remove('hidden')" class="bg-[#f5a623] hover:bg-[#f4b84a] text-[#1a3c5e] px-5 py-2 rounded-full transition shadow-sm flex items-center gap-2 font-semibold">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Post Job Offer
        </button>
    </div>

    <!-- Stats Summary -->
    @if($jobs->count() > 0)
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
        <div class="bg-gradient-to-r from-[#e8f4f8] to-[#d4eaf0] rounded-2xl p-4">
            <div class="text-2xl font-bold text-[#1a3c5e]">{{ $jobs->total() }}</div>
            <div class="text-sm text-gray-600">Total Job Offers</div>
        </div>
        <div class="bg-gradient-to-r from-[#e8f4f8] to-[#d4eaf0] rounded-2xl p-4">
            <div class="text-2xl font-bold text-[#1a3c5e]">{{ $jobs->where('created_at', '>=', now()->subDays(7))->count() }}</div>
            <div class="text-sm text-gray-600">Posted This Week</div>
        </div>
        <div class="bg-gradient-to-r from-[#e8f4f8] to-[#d4eaf0] rounded-2xl p-4">
            <div class="text-2xl font-bold text-[#1a3c5e]">{{ $jobs->unique('company')->count() }}</div>
            <div class="text-sm text-gray-600">Companies Hiring</div>
        </div>
    </div>
    @endif

    <!-- Job Offers Table -->
    <div class="bg-white rounded-2xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gradient-to-r from-[#1a3c5e] to-[#2d5a7b] text-white">
                        <th class="px-6 py-4 text-left text-sm font-semibold">Job Title</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Company</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Location</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Posted By</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Date Posted</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jobs as $job)
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition duration-200">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 bg-[#e8f4f8] rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-[#1a3c5e]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <span class="font-medium text-gray-800">{{ $job->job_title }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-block bg-gray-100 text-gray-700 px-2 py-1 rounded-lg text-xs">{{ $job->company }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-1 text-gray-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                {{ $job->location }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-1">
                                <div class="w-6 h-6 bg-[#1a3c5e] rounded-full flex items-center justify-center">
                                    <span class="text-white text-xs font-semibold">{{ substr($job->user->name, 0, 1) }}</span>
                                </div>
                                <span class="text-sm text-gray-600">{{ $job->user->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-500 text-sm">{{ $job->created_at->format('M d, Y') }}</td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2">
                                <a href="{{ route('admin.job-offers.show', $job->id) }}" class="bg-[#f5a623] hover:bg-[#f4b84a] text-[#1a3c5e] px-3 py-1.5 rounded-xl transition flex items-center gap-1 text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    
                                </a>
                                <a href="{{ route('admin.job-offers.edit', $job->id) }}" class="bg-[#1a3c5e] hover:bg-[#2d5a7b] text-white px-3 py-1.5 rounded-xl transition flex items-center gap-1 text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    
                                </a>
                                <form action="{{ route('admin.job-offers.destroy', $job->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete {{ $job->job_title }}? This action cannot be undone.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-xl transition flex items-center gap-1 text-sm">
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
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="text-gray-400">
                                <svg class="w-20 h-20 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <p class="text-lg font-medium">No Job Offers Found</p>
                                <p class="text-sm mt-1">Click "Post Job Offer" to create your first job posting.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($jobs->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $jobs->links() }}
        </div>
        @endif
    </div>

    <!-- Post Job Modal -->
    <div id="postJobModal" class="hidden fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center z-50 transition-all duration-300">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg mx-4">
            <div class="flex justify-between items-center p-5 border-b">
                <div class="flex items-center gap-2">
                    <div class="bg-[#f5a623] rounded-lg p-2">
                        <svg class="w-5 h-5 text-[#1a3c5e]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">Post a Job Offer</h3>
                </div>
                <button onclick="document.getElementById('postJobModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600 text-2xl transition">&times;</button>
            </div>
            
            <form action="{{ route('admin.job-offers.store') }}" method="POST" class="p-5">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Job Title <span class="text-red-500">*</span></label>
                    <input type="text" name="job_title" required class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#f5a623] focus:border-transparent" placeholder="e.g., Senior Software Engineer">
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Company <span class="text-red-500">*</span></label>
                    <input type="text" name="company" required class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#f5a623] focus:border-transparent" placeholder="e.g., Google, Microsoft, Startup Inc.">
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Location <span class="text-red-500">*</span></label>
                    <input type="text" name="location" required class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#f5a623] focus:border-transparent" placeholder="e.g., Manila, Remote, Cebu">
                </div>
                
                <div class="mb-5">
                    <label class="block text-gray-700 font-semibold mb-2">Description <span class="text-red-500">*</span></label>
                    <textarea name="description" rows="5" required class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#f5a623] focus:border-transparent" placeholder="Describe the job responsibilities, requirements, and how to apply..."></textarea>
                </div>
                
                <div class="flex justify-end gap-3">
                    <button type="button" onclick="document.getElementById('postJobModal').classList.add('hidden')" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-xl transition">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-[#f5a623] hover:bg-[#f4b84a] text-[#1a3c5e] rounded-xl transition font-semibold flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Post Job
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Close modal when clicking outside
    window.onclick = function(event) {
        let modal = document.getElementById('postJobModal');
        if (event.target === modal) {
            modal.classList.add('hidden');
        }
    }
</script>
@endsection