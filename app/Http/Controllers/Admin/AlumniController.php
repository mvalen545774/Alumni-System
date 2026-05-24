<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\DegreeProgram;
use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AlumniController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'alumni')->where('status', 'approved');
        
        if ($request->filled('degree_program')) {
            $query->where('degree_program_id', $request->degree_program);
        }
        
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        $alumni = $query->with('degreeProgram', 'alumni')->paginate(10);
        $degreePrograms = DegreeProgram::all();
        
        return view('admin.alumni.index', compact('alumni', 'degreePrograms'));
    }

    public function create()
    {
        $degreePrograms = DegreeProgram::all();
        return view('admin.alumni.create', compact('degreePrograms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|unique:users',
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'degree_program_id' => 'required',
            'year_graduated' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'employment_status' => 'required',
            'current_employer' => 'nullable',
            'job_title' => 'nullable',
        ]);

        $user = User::create([
            'student_id' => $request->student_id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('password123'),
            'role' => 'alumni',
            'status' => 'approved',
            'degree_program_id' => $request->degree_program_id,
            'year_graduated' => $request->year_graduated,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        Alumni::create([
            'user_id' => $user->id,
            'employment_status' => $request->employment_status,
            'current_employer' => $request->current_employer,
            'job_title' => $request->job_title,
        ]);

        return redirect()->route('admin.alumni.index')->with('success', 'Alumni added successfully');
    }

    public function edit($id)
    {
        $alumni = User::with('alumni')->findOrFail($id);
        $degreePrograms = DegreeProgram::all();
        return view('admin.alumni.edit', compact('alumni', 'degreePrograms'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'degree_program_id' => 'required',
            'year_graduated' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'degree_program_id' => $request->degree_program_id,
            'year_graduated' => $request->year_graduated,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        if ($user->alumni) {
            $user->alumni->update([
                'employment_status' => $request->employment_status,
                'current_employer' => $request->current_employer,
                'job_title' => $request->job_title,
            ]);
        }

        return redirect()->route('admin.alumni.index')->with('success', 'Alumni updated successfully');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        
        return redirect()->route('admin.alumni.index')->with('success', 'Alumni deleted successfully');
    }

    // ADD THIS METHOD FOR VIEWING ALUMNI
    public function show($id)
    {
        $alumni = User::with('degreeProgram', 'alumni')->findOrFail($id);
        return view('admin.alumni.show', compact('alumni'));
    }
}