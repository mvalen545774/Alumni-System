<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use App\Models\DegreeProgram;
use App\Models\Alumni;
class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $degreePrograms = DegreeProgram::all();
        return view('auth.register', compact('degreePrograms'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
        'name' => 'required|string|max:255',
        'student_id' => 'required|string|unique:users',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|confirmed|min:8',
        'degree_program_id' => 'required|exists:degree_programs,id',
        'year_graduated' => 'required',
        'phone' => 'required',
        'address' => 'required',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'student_id' => $request->student_id,
        'degree_program_id' => $request->degree_program_id,
        'year_graduated' => $request->year_graduated,
        'phone' => $request->phone,
        'address' => $request->address,
        'role' => 'alumni',
        'status' => 'pending',
    ]);

    // Don't log the user in automatically
    // Just redirect to login page with success message

    return redirect()->route('login')->with('success', 'Registration successful! Please wait for admin approval.');
    }
}
