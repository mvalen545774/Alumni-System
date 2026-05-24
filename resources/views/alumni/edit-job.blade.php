@extends('layouts.alumni')

@section('content')
<div>
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Edit Job Posting</h1>
        <p class="text-gray-500 mt-1">Update your job opportunity details</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-md overflow-hidden">
        <div class="bg-gradient-to-r from-[#1a3c5e] to-[#2d5a7b] px-6 py-4">
            <div class="flex items-center gap-2">
                <div class="bg-[#f5a623] rounded-lg p-1">
                    <svg class="w-5 h-5 text-[#1a3c5e]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-white">Edit Job Details</h2>
            </div>
            <p class="text-blue-100 text-sm mt-1 ml-8">Update the information below</p>
        </div>

        <form action="{{ route('alumni.job-board.update', $job->id) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Job Title <span class="text-red-500">*</span></label>
                    <input type="text" name="job_title" required value="{{ old('job_title', $job->job_title) }}" 
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#f5a623] focus:border-transparent">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Company <span class="text-red-500">*</span></label>
                    <input type="text" name="company" required value="{{ old('company', $job->company) }}" 
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#f5a623] focus:border-transparent">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Location <span class="text-red-500">*</span></label>
                    <input type="text" name="location" required value="{{ old('location', $job->location) }}" 
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#f5a623] focus:border-transparent"
                        placeholder="e.g., Manila, Remote, Cebu">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Contact Email <span class="text-red-500">*</span></label>
                    <input type="email" name="contact_email" required value="{{ old('contact_email', $job->contact_email) }}" 
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#f5a623] focus:border-transparent"
                        placeholder="hr@company.com">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Posted Date</label>
                    <div class="w-full bg-gray-100 border border-gray-300 rounded-xl px-4 py-2 text-gray-500">
                        {{ $job->created_at->format('F d, Y') }}
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <label class="block text-gray-700 font-semibold mb-2">Description <span class="text-red-500">*</span></label>
                <textarea name="description" rows="8" required 
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#f5a623] focus:border-transparent"
                    placeholder="Describe the job responsibilities, requirements, and how to apply...">{{ old('description', $job->description) }}</textarea>
                <p class="text-xs text-gray-400 mt-1">Include job requirements, responsibilities, and application instructions.</p>
            </div>

            <div class="flex justify-end gap-3 mt-8 pt-4 border-t border-gray-200">
                <a href="{{ route('alumni.job-board') }}" class="px-5 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-xl transition">Cancel</a>
                <button type="submit" class="px-5 py-2 bg-[#f5a623] hover:bg-[#f4b84a] text-[#1a3c5e] rounded-xl transition font-semibold flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                    </svg>
                    Update Job
                </button>
            </div>
        </form>
    </div>
</div>
@endsection