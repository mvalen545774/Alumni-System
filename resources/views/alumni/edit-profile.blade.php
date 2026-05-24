@extends('layouts.alumni')

@section('content')
<div>
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center gap-4">
            @if(auth()->user()->profile_picture)
                <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="Profile" class="w-16 h-16 rounded-full object-cover border-4 border-[#f5a623]">
            @else
                <div class="w-16 h-16 rounded-full bg-gradient-to-r from-[#1a3c5e] to-[#2d5a7b] flex items-center justify-center">
                    <span class="text-white text-2xl font-bold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                </div>
            @endif
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Edit Profile</h1>
                <p class="text-gray-500 mt-1">Update your personal and professional information</p>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-md overflow-hidden">
        <div class="bg-gradient-to-r from-[#1a3c5e] to-[#2d5a7b] px-6 py-4">
            <div class="flex items-center gap-2">
                <div class="bg-[#f5a623] rounded-lg p-1">
                    <svg class="w-5 h-5 text-[#1a3c5e]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-white">Profile Information</h2>
            </div>
            <p class="text-blue-100 text-sm mt-1 ml-8">Update your details below</p>
        </div>

        <form action="{{ route('alumni.profile.update') }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            @method('PUT')

            <!-- Profile Picture Section -->
            <div class="mb-8 pb-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Profile Picture</h3>
                <div class="flex items-center gap-6 flex-wrap">
                    <!-- Current Profile Picture Preview -->
                    <div class="relative">
                        @if(auth()->user()->profile_picture)
                            <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="Profile" class="w-24 h-24 rounded-full object-cover border-4 border-[#f5a623]">
                        @else
                            <div class="w-24 h-24 rounded-full bg-gradient-to-r from-[#1a3c5e] to-[#2d5a7b] flex items-center justify-center border-4 border-[#f5a623]">
                                <span class="text-white text-3xl font-bold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Upload Controls -->
                    <div class="flex-1">
                        <label class="block text-gray-700 font-semibold mb-2">Upload New Picture</label>
                        <input type="file" name="profile_picture" accept="image/*" 
                            class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#e8f4f8] file:text-[#1a3c5e] hover:file:bg-[#d4eaf0]">
                        <p class="text-xs text-gray-400 mt-1">Recommended: Square image, at least 200x200px. Max 2MB.</p>
                        @error('profile_picture')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    @if(auth()->user()->profile_picture)
                    <div>
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" name="remove_picture" value="1" class="mr-2 w-4 h-4 text-red-500">
                            <span class="text-sm text-red-600">Remove current picture</span>
                        </label>
                    </div>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Full Name (read-only) -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Full Name</label>
                    <input type="text" value="{{ auth()->user()->name }}" class="w-full bg-gray-100 border border-gray-300 rounded-xl px-4 py-2 text-gray-500" readonly disabled>
                </div>

                <!-- Student ID (read-only) -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Student ID</label>
                    <input type="text" value="{{ auth()->user()->student_id }}" class="w-full bg-gray-100 border border-gray-300 rounded-xl px-4 py-2 text-gray-500" readonly disabled>
                </div>

                <!-- Email (read-only) -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Email Address</label>
                    <input type="email" value="{{ auth()->user()->email }}" class="w-full bg-gray-100 border border-gray-300 rounded-xl px-4 py-2 text-gray-500" readonly disabled>
                </div>

                <!-- Phone Number -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Phone Number <span class="text-red-500">*</span></label>
                    <input type="text" name="phone" required value="{{ old('phone', auth()->user()->phone) }}" 
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#f5a623] focus:border-transparent">
                    @error('phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Degree Program (read-only) -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Degree Program</label>
                    <input type="text" value="{{ auth()->user()->degreeProgram->program_name ?? 'N/A' }}" class="w-full bg-gray-100 border border-gray-300 rounded-xl px-4 py-2 text-gray-500" readonly disabled>
                </div>

                <!-- Year Graduated (read-only) -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Year Graduated</label>
                    <input type="text" value="{{ auth()->user()->year_graduated }}" class="w-full bg-gray-100 border border-gray-300 rounded-xl px-4 py-2 text-gray-500" readonly disabled>
                </div>

                <!-- Employment Status -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Employment Status <span class="text-red-500">*</span></label>
                    <select name="employment_status" required class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#f5a623] focus:border-transparent">
                        <option value="employed" {{ old('employment_status', auth()->user()->alumni->employment_status ?? '') == 'employed' ? 'selected' : '' }}>Employed</option>
                        <option value="unemployed" {{ old('employment_status', auth()->user()->alumni->employment_status ?? '') == 'unemployed' ? 'selected' : '' }}>Unemployed</option>
                        <option value="self-employed" {{ old('employment_status', auth()->user()->alumni->employment_status ?? '') == 'self-employed' ? 'selected' : '' }}>Self-Employed</option>
                        <option value="student" {{ old('employment_status', auth()->user()->alumni->employment_status ?? '') == 'student' ? 'selected' : '' }}>Student</option>
                    </select>
                    @error('employment_status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Current Employer -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Current Employer</label>
                    <input type="text" name="current_employer" value="{{ old('current_employer', auth()->user()->alumni->current_employer ?? '') }}" 
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#f5a623] focus:border-transparent"
                        placeholder="e.g., Google, Microsoft">
                </div>

                <!-- Job Title -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Job Title</label>
                    <input type="text" name="job_title" value="{{ old('job_title', auth()->user()->alumni->job_title ?? '') }}" 
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#f5a623] focus:border-transparent"
                        placeholder="e.g., Software Engineer">
                </div>
            </div>

            <!-- Address -->
            <div class="mt-6">
                <label class="block text-gray-700 font-semibold mb-2">Address <span class="text-red-500">*</span></label>
                <textarea name="address" rows="3" required 
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#f5a623] focus:border-transparent"
                    placeholder="Your complete address">{{ old('address', auth()->user()->address) }}</textarea>
                @error('address')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end gap-3 mt-8 pt-4 border-t border-gray-200">
                <a href="{{ route('alumni.profile') }}" class="px-5 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-xl transition">Cancel</a>
                <button type="submit" class="px-5 py-2 bg-[#f5a623] hover:bg-[#f4b84a] text-[#1a3c5e] rounded-xl transition font-semibold flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection