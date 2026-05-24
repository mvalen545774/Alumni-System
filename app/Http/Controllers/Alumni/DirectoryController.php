<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\DegreeProgram;
use Illuminate\Http\Request;

class DirectoryController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'alumni')
                     ->where('status', 'approved')
                     ->where('id', '!=', auth()->id());
        
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        if ($request->filled('degree_program')) {
            $query->where('degree_program_id', $request->degree_program);
        }
        
        $alumni = $query->with('degreeProgram', 'alumni')->paginate(12);
        $degreePrograms = DegreeProgram::all();
        
        return view('alumni.directory', compact('alumni', 'degreePrograms'));
    }

    public function show($id)
    {
        $alumni = User::with('degreeProgram', 'alumni')->findOrFail($id);
        return view('alumni.show-profile', compact('alumni'));
    }
}