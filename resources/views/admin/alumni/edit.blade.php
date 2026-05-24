@extends('layouts.admin')

@section('content')
<div>
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Edit Alumni</h1>
        <p class="text-gray-500 mt-1">Update information for {{ $alumni->name }}</p>
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
                <h2 class="text-xl font-bold text-white">Edit Alumni Information</h2>
            </div>
            <p class="text-blue-100 text-sm mt-1 ml-8">Update the alumni details</p>
        </div>

        <form action="{{ route('admin.alumni.update', $alumni->id) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Student ID</label>
                    <input type="text" value="{{ $alumni->student_id }}" 
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 bg-gray-100 text-gray-500" readonly disabled>
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Full Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" required value="{{ old('name', $alumni->name) }}" 
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#f5a623] focus:border-transparent">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Email <span class="text-red-500">*</span></label>
                    <input type="email" name="email" required value="{{ old('email', $alumni->email) }}" 
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#f5a623] focus:border-transparent">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Phone Number <span class="text-red-500">*</span></label>
                    <input type="text" name="phone" required value="{{ old('phone', $alumni->phone) }}" 
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#f5a623] focus:border-transparent">
                    @error('phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Degree Program <span class="text-red-500">*</span></label>
                    <select name="degree_program_id" required class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#f5a623] focus:border-transparent">
                        <option value="">Select Degree Program</option>
                        @foreach($degreePrograms as $program)
                            <option value="{{ $program->id }}" {{ old('degree_program_id', $alumni->degree_program_id) == $program->id ? 'selected' : '' }}>
                                {{ $program->program_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('degree_program_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Year Graduated <span class="text-red-500">*</span></label>
                    <select name="year_graduated" required class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#f5a623] focus:border-transparent">
                        <option value="">Select Year</option>
                        @for($year = date('Y'); $year >= date('Y') - 50; $year--)
                            <option value="{{ $year }}" {{ old('year_graduated', $alumni->year_graduated) == $year ? 'selected' : '' }}>{{ $year }}</option>
                        @endfor
                    </select>
                    @error('year_graduated')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Employment Status <span class="text-red-500">*</span></label>
                    <select name="employment_status" required class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#f5a623] focus:border-transparent">
                        <option value="">Select Status</option>
                        <option value="employed" {{ old('employment_status', $alumni->alumni->employment_status ?? '') == 'employed' ? 'selected' : '' }}>Employed</option>
                        <option value="unemployed" {{ old('employment_status', $alumni->alumni->employment_status ?? '') == 'unemployed' ? 'selected' : '' }}>Unemployed</option>
                        <option value="self-employed" {{ old('employment_status', $alumni->alumni->employment_status ?? '') == 'self-employed' ? 'selected' : '' }}>Self-Employed</option>
                        <option value="student" {{ old('employment_status', $alumni->alumni->employment_status ?? '') == 'student' ? 'selected' : '' }}>Student</option>
                    </select>
                    @error('employment_status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Current Employer</label>
                    <input type="text" name="current_employer" value="{{ old('current_employer', $alumni->alumni->current_employer ?? '') }}" 
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#f5a623] focus:border-transparent">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Job Title</label>
                    <input type="text" name="job_title" value="{{ old('job_title', $alumni->alumni->job_title ?? '') }}" 
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#f5a623] focus:border-transparent">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-gray-700 font-semibold mb-2">Address <span class="text-red-500">*</span></label>
                    <textarea name="address" rows="3" required class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#f5a623] focus:border-transparent">{{ old('address', $alumni->address) }}</textarea>
                    @error('address')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-8 pt-4 border-t border-gray-200">
                <a href="{{ route('admin.alumni.index') }}" class="px-5 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-xl transition">Cancel</a>
                <button type="submit" class="px-5 py-2 bg-[#f5a623] hover:bg-[#f4b84a] text-[#1a3c5e] rounded-xl transition font-semibold flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                    </svg>
                    Update Alumni
                </button>
            </div>
        </form>
    </div>
</div>
@endsection