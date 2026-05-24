<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DegreeProgram;
use Illuminate\Http\Request;

class DegreeProgramController extends Controller
{
    public function index()
    {
        $programs = DegreeProgram::all();
        return view('admin.degree-programs', compact('programs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'program_code' => 'required|unique:degree_programs',
            'program_name' => 'required',
        ]);

        DegreeProgram::create($request->all());
        return redirect()->back()->with('success', 'Degree program added');
    }

    public function update(Request $request, $id)
    {
        $program = DegreeProgram::findOrFail($id);
        $program->update($request->all());
        return redirect()->back()->with('success', 'Degree program updated');
    }

    public function destroy($id)
    {
        $program = DegreeProgram::findOrFail($id);
        if ($program->users()->count() > 0) {
            return redirect()->back()->with('error', 'Cannot delete program with existing alumni');
        }
        $program->delete();
        return redirect()->back()->with('success', 'Degree program deleted');
    }
}