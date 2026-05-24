<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user()->load('degreeProgram', 'alumni');
        return view('alumni.profile', compact('user'));
    }

    public function edit()
    {
        $user = auth()->user()->load('degreeProgram', 'alumni');
        return view('alumni.edit-profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'phone' => 'required',
            'address' => 'required',
            'employment_status' => 'required',
            'current_employer' => 'nullable',
            'job_title' => 'nullable',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Delete old picture if exists
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
        }
        
        // Handle remove picture
        if ($request->has('remove_picture') && $request->remove_picture == 1) {
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
                $user->profile_picture = null;
            }
        }

        $user->update([
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        if ($user->alumni) {
            $user->alumni->update([
                'employment_status' => $request->employment_status,
                'current_employer' => $request->current_employer,
                'job_title' => $request->job_title,
            ]);
        } else {
            Alumni::create([
                'user_id' => $user->id,
                'employment_status' => $request->employment_status,
                'current_employer' => $request->current_employer,
                'job_title' => $request->job_title,
            ]);
        }
        
        $user->save();

        return redirect()->route('alumni.profile')->with('success', 'Profile updated successfully');
    }
}