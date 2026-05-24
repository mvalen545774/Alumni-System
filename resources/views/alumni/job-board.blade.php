@extends('layouts.alumni')

@section('content')
<div>
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Job Board</h1>
        <p class="text-gray-500 mt-1">Find and post job opportunities from fellow alumni</p>
    </div>

    <!-- Header with Post Button -->
    <div class="flex justify-end mb-6">
        <button onclick="document.getElementById('postJobModal').classList.remove('hidden')" class="bg-[#f5a623] hover:bg-[#f4b84a] text-[#1a3c5e] px-5 py-2 rounded-full transition shadow-sm flex items-center gap-2 font-semibold">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Post a Job
        </button>
    </div>

    <!-- Stats Summary -->
    @if($jobs->count() > 0)
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
        <div class="bg-gradient-to-r from-[#e8f4f8] to-[#d4eaf0] rounded-2xl p-4">
            <div class="text-2xl font-bold text-[#1a3c5e]">{{ $jobs->total() }}</div>
            <div class="text-sm text-gray-600">Total Jobs</div>
        </div>
        <div class="bg-gradient-to-r from-[#e8f4f8] to-[#d4eaf0] rounded-2xl p-4">
            <div class="text-2xl font-bold text-[#1a3c5e]">{{ $jobs->where('created_at', '>=', now()->subDays(7))->count() }}</div>
            <div class="text-sm text-gray-600">This Week</div>
        </div>
        <div class="bg-gradient-to-r from-[#e8f4f8] to-[#d4eaf0] rounded-2xl p-4">
            <div class="text-2xl font-bold text-[#1a3c5e]">{{ $jobs->unique('company')->count() }}</div>
            <div class="text-sm text-gray-600">Companies</div>
        </div>
    </div>
    @endif

    <!-- Jobs List -->
    <div class="space-y-4">
        @forelse($jobs as $job)
        <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-lg transition">
            <div class="p-5">
                <div class="flex flex-col sm:flex-row justify-between items-start gap-4">
                    <!-- Job Info -->
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-2">
                            <div class="bg-[#e8f4f8] rounded-lg p-2">
                                <svg class="w-5 h-5 text-[#1a3c5e]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800">{{ $job->job_title }}</h3>
                        </div>
                        
                        <div class="flex flex-wrap gap-4 mb-3">
                            <div class="flex items-center gap-1 text-gray-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                <span class="text-sm">{{ $job->company }}</span>
                            </div>
                            <div class="flex items-center gap-1 text-gray-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="text-sm">{{ $job->location }}</span>
                            </div>
                            <div class="flex items-center gap-1 text-gray-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-sm">Posted {{ $job->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-2 mb-3">
                            @if($job->user->profile_picture)
                            <img src="{{ asset('storage/' . $job->user->profile_picture) }}" alt="Profile" class="w-6 h-6 rounded-full object-cover">
                            @else
                            <div class="w-6 h-6 rounded-full bg-[#1a3c5e] flex items-center justify-center">
                                <span class="text-white text-xs font-bold">{{ substr($job->user->name, 0, 1) }}</span>
                            </div>
                            @endif
                            <span class="text-sm text-gray-500">Posted by: {{ $job->user->name }}</span>
                        </div>

                        <!-- Contact Email from Job Posting -->
                        <div class="flex items-center gap-2 mb-3 p-2 bg-green-50 rounded-xl">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-sm font-medium text-gray-700">Apply at:</span>
                            <a href="mailto:{{ $job->contact_email ?? $job->user->email }}" class="text-sm text-green-700 hover:underline font-medium">
                                {{ $job->contact_email ?? $job->user->email }}
                            </a>
                        </div>
                        
                        <p class="text-gray-600 mt-2">{{ Str::limit($job->description, 150) }}</p>
                        
                        <!-- View Full Description Button - FIXED -->
                        <button onclick="showFullDescription(
                            '{{ addslashes($job->job_title) }}', 
                            '{{ addslashes($job->company) }}', 
                            '{{ addslashes($job->location) }}', 
                            '{{ addslashes($job->user->name) }}', 
                            `{{ addslashes($job->description) }}`, 
                            '{{ $job->created_at->format('F d, Y') }}', 
                            '{{ $job->contact_email ?? $job->user->email }}'
                        )" class="mt-3 text-[#f5a623] hover:text-[#f4b84a] text-sm font-medium inline-flex items-center gap-1">
                            Read Full Description
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <!-- Actions -->
                    @if(auth()->id() == $job->user_id)
                    <div class="flex gap-2">
                        <a href="{{ route('alumni.job-board.edit', $job->id) }}" class="bg-[#1a3c5e] hover:bg-[#2d5a7b] text-white px-3 py-1.5 rounded-xl transition flex items-center gap-1 text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit
                        </a>
                        <form action="{{ route('alumni.job-board.destroy', $job->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this job?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-xl transition flex items-center gap-1 text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Delete
                            </button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white rounded-2xl shadow-md p-12 text-center">
            <div class="text-gray-400">
                <svg class="w-20 h-20 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                <p class="text-lg font-medium">No job postings yet</p>
                <p class="text-sm mt-1">Be the first to post a job opportunity!</p>
                <button onclick="document.getElementById('postJobModal').classList.remove('hidden')" class="mt-4 bg-[#f5a623] text-[#1a3c5e] px-5 py-2 rounded-full font-semibold hover:bg-[#f4b84a] transition inline-flex items-center gap-2">
                    Post a Job
                </button>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($jobs->hasPages())
    <div class="mt-6">
        {{ $jobs->links() }}
    </div>
    @endif

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
                    <h3 class="text-xl font-bold text-gray-800">Post a Job</h3>
                </div>
                <button onclick="document.getElementById('postJobModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600 text-2xl transition">&times;</button>
            </div>
            
            <form action="{{ route('alumni.job-board.store') }}" method="POST" class="p-5">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Job Title <span class="text-red-500">*</span></label>
                    <input type="text" name="job_title" required class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#f5a623] focus:border-transparent" placeholder="e.g., Senior Software Engineer">
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Company <span class="text-red-500">*</span></label>
                    <input type="text" name="company" required class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#f5a623] focus:border-transparent" placeholder="e.g., Google, Microsoft">
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Location <span class="text-red-500">*</span></label>
                    <input type="text" name="location" required class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#f5a623] focus:border-transparent" placeholder="e.g., Manila, Remote, Cebu">
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Contact Email <span class="text-red-500">*</span></label>
                    <input type="email" name="contact_email" required class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#f5a623] focus:border-transparent" placeholder="hr@company.com">
                    <p class="text-xs text-gray-400 mt-1">Where applicants should send their resumes</p>
                </div>
                
                <div class="mb-5">
                    <label class="block text-gray-700 font-semibold mb-2">Description <span class="text-red-500">*</span></label>
                    <textarea name="description" rows="5" required class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#f5a623] focus:border-transparent" placeholder="Describe the job responsibilities, requirements, and how to apply..."></textarea>
                    <p class="text-xs text-gray-400 mt-1">Include job requirements and application instructions.</p>
                </div>
                
                <div class="flex justify-end gap-3">
                    <button type="button" onclick="document.getElementById('postJobModal').classList.add('hidden')" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-xl transition">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-[#f5a623] hover:bg-[#f4b84a] text-[#1a3c5e] rounded-xl transition font-semibold flex items-center gap-2">
                        Post Job
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- View Full Description Modal - FIXED with correct ID -->
    <div id="viewJobModal" class="hidden fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center z-50 transition-all duration-300">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl mx-4 max-h-[90vh] overflow-y-auto">
            <div class="sticky top-0 bg-white z-10 flex justify-between items-center p-5 border-b">
                <div class="flex items-center gap-2">
                    <div class="bg-[#f5a623] rounded-lg p-2">
                        <svg class="w-5 h-5 text-[#1a3c5e]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 id="viewJobTitle" class="text-xl font-bold text-gray-800">Job Details</h3>
                </div>
                <button onclick="document.getElementById('viewJobModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600 text-2xl transition">&times;</button>
            </div>
            
            <div id="viewJobContent" class="p-6">
                <!-- Content will be inserted here -->
            </div>
            
            <div class="sticky bottom-0 bg-white p-5 border-t flex justify-end">
                <button onclick="document.getElementById('viewJobModal').classList.add('hidden')" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-xl transition">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    function showFullDescription(title, company, location, postedBy, description, date, email) {
        // Set the title
        document.getElementById('viewJobTitle').innerHTML = title;
        
        // Set the content
        document.getElementById('viewJobContent').innerHTML = `
            <div class="mb-6">
                <div class="flex flex-wrap gap-4 mb-4 pb-4 border-b">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        <span class="text-gray-700"><strong>Company:</strong> ${company}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span class="text-gray-700"><strong>Location:</strong> ${location}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span class="text-gray-700"><strong>Posted on:</strong> ${date}</span>
                    </div>
                </div>
                
                <div class="mb-4">
                    <div class="flex items-center gap-2 mb-3">
                        <div class="w-8 h-8 rounded-full bg-[#1a3c5e] flex items-center justify-center">
                            <span class="text-white text-sm font-bold">${postedBy.charAt(0)}</span>
                        </div>
                        <span class="text-gray-600"><strong>Posted by:</strong> ${postedBy}</span>
                    </div>
                    
                    <div class="flex items-center gap-2 mb-4 p-3 bg-green-50 rounded-xl">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <span class="text-sm font-medium text-gray-700">How to Apply:</span>
                        <span class="text-sm text-gray-600">Send your resume and cover letter to:</span>
                        <a href="mailto:${email}" class="text-sm text-green-700 hover:underline font-medium">${email}</a>
                    </div>
                </div>
                
                <div class="mt-4">
                    <h4 class="text-lg font-semibold text-gray-800 mb-3">Job Description</h4>
                    <div class="text-gray-700 whitespace-pre-wrap leading-relaxed bg-gray-50 p-4 rounded-xl">
                        ${description}
                    </div>
                </div>
            </div>
        `;
        
        // Show the modal
        document.getElementById('viewJobModal').classList.remove('hidden');
    }
</script>
@endsection