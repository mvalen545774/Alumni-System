@extends('layouts.admin')

@section('content')
<div>
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Degree Programs</h1>
        <p class="text-gray-500 mt-1">Manage academic programs offered by Monsters University</p>
    </div>

    <!-- Header with Add Button -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div class="flex items-center gap-3">
            <div class="w-1 h-8 bg-[#f5a623] rounded-full"></div>
            <div>
                <p class="text-sm text-gray-500">Total Programs</p>
                <p class="text-2xl font-bold text-[#1a3c5e]">{{ $programs->count() }}</p>
            </div>
        </div>
        <button onclick="document.getElementById('addProgramModal').classList.remove('hidden')" class="bg-[#f5a623] hover:bg-[#f4b84a] text-[#1a3c5e] px-5 py-2 rounded-full transition shadow-sm flex items-center gap-2 font-semibold">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Add Degree Program
        </button>
    </div>

    <!-- Programs Table -->
    <div class="bg-white rounded-2xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gradient-to-r from-[#1a3c5e] to-[#2d5a7b] text-white">
                        <th class="px-6 py-4 text-left text-sm font-semibold">Program Code</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Program Name</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Total Alumni</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($programs as $program)
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition duration-200">
                        <td class="px-6 py-4">
                            <span class="inline-block bg-[#e8f4f8] text-[#1a3c5e] px-3 py-1 rounded-full text-sm font-semibold">{{ $program->program_code }}</span>
                        </td>
                        <td class="px-6 py-4 text-gray-700">{{ $program->program_name }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-block bg-gray-100 text-gray-600 px-2 py-1 rounded-lg text-xs">
                                {{ $program->users()->where('role', 'alumni')->count() }} alumni
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2">
                                <button onclick='openEditModal({{ $program->id }}, "{{ $program->program_code }}", "{{ addslashes($program->program_name) }}")' class="bg-[#f5a623] hover:bg-[#f4b84a] text-[#1a3c5e] px-3 py-1.5 rounded-xl transition flex items-center gap-1 text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    
                                </button>
                                <form action="{{ route('admin.degree-programs.destroy', $program->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete {{ $program->program_name }}? Any alumni linked to this program will be affected.')">
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
                        <td colspan="4" class="px-6 py-12 text-center">
                            <div class="text-gray-400">
                                <svg class="w-20 h-20 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                                <p class="text-lg font-medium">No Degree Programs Found</p>
                                <p class="text-sm mt-1">Click "Add Degree Program" to create your first program.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Program Modal -->
    <div id="addProgramModal" class="hidden fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center z-50 transition-all duration-300">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4">
            <div class="flex justify-between items-center p-5 border-b">
                <div class="flex items-center gap-2">
                    <div class="bg-[#f5a623] rounded-lg p-2">
                        <svg class="w-5 h-5 text-[#1a3c5e]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">Add Degree Program</h3>
                </div>
                <button onclick="document.getElementById('addProgramModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600 text-2xl transition">&times;</button>
            </div>
            <form action="{{ route('admin.degree-programs.store') }}" method="POST" class="p-5">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Program Code</label>
                    <input type="text" name="program_code" required class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#f5a623] focus:border-transparent" placeholder="e.g., BSIT">
                </div>
                <div class="mb-5">
                    <label class="block text-gray-700 font-semibold mb-2">Program Name</label>
                    <input type="text" name="program_name" required class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#f5a623] focus:border-transparent" placeholder="e.g., Bachelor of Science in Information Technology">
                </div>
                <div class="flex justify-end gap-3">
                    <button type="button" onclick="document.getElementById('addProgramModal').classList.add('hidden')" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-xl transition">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-[#f5a623] hover:bg-[#f4b84a] text-[#1a3c5e] rounded-xl transition font-semibold">Save Program</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Program Modal -->
    <div id="editProgramModal" class="hidden fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center z-50 transition-all duration-300">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4">
            <div class="flex justify-between items-center p-5 border-b">
                <div class="flex items-center gap-2">
                    <div class="bg-[#f5a623] rounded-lg p-2">
                        <svg class="w-5 h-5 text-[#1a3c5e]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">Edit Degree Program</h3>
                </div>
                <button onclick="document.getElementById('editProgramModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600 text-2xl transition">&times;</button>
            </div>
            <form id="editProgramForm" method="POST" class="p-5">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Program Code</label>
                    <input type="text" name="program_code" id="edit_program_code" required class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#f5a623] focus:border-transparent">
                </div>
                <div class="mb-5">
                    <label class="block text-gray-700 font-semibold mb-2">Program Name</label>
                    <input type="text" name="program_name" id="edit_program_name" required class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#f5a623] focus:border-transparent">
                </div>
                <div class="flex justify-end gap-3">
                    <button type="button" onclick="document.getElementById('editProgramModal').classList.add('hidden')" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-xl transition">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-[#f5a623] hover:bg-[#f4b84a] text-[#1a3c5e] rounded-xl transition font-semibold">Update Program</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openEditModal(id, code, name) {
        document.getElementById('edit_program_code').value = code;
        document.getElementById('edit_program_name').value = name;
        document.getElementById('editProgramForm').action = '/admin/degree-programs/' + id;
        document.getElementById('editProgramModal').classList.remove('hidden');
    }

    // Close modals when clicking outside
    window.onclick = function(event) {
        let addModal = document.getElementById('addProgramModal');
        let editModal = document.getElementById('editProgramModal');
        if (event.target === addModal) {
            addModal.classList.add('hidden');
        }
        if (event.target === editModal) {
            editModal.classList.add('hidden');
        }
    }
</script>
@endsection