<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\JobOffer;
use Illuminate\Http\Request;

class JobBoardController extends Controller
{
    public function index()
    {
        $jobs = JobOffer::with('user')->latest()->paginate(10);
        return view('alumni.job-board', compact('jobs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'job_title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'contact_email' => 'required|email|max:255',
        ]);

        JobOffer::create([
            'user_id' => auth()->id(),
            'job_title' => $request->job_title,
            'company' => $request->company,
            'location' => $request->location,
            'description' => $request->description,
            'contact_email' => $request->contact_email,
        ]);

        return redirect()->back()->with('success', 'Job posted successfully');
    }

    public function edit($id)
    {
        $job = JobOffer::where('user_id', auth()->id())->findOrFail($id);
        return view('alumni.edit-job', compact('job'));
    }

    public function update(Request $request, $id)
    {
        $job = JobOffer::where('user_id', auth()->id())->findOrFail($id);
        
        $request->validate([
            'job_title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'contact_email' => 'required|email|max:255',
        ]);

        $job->update([
            'job_title' => $request->job_title,
            'company' => $request->company,
            'location' => $request->location,
            'description' => $request->description,
            'contact_email' => $request->contact_email,
        ]);
        
        return redirect()->route('alumni.job-board')->with('success', 'Job updated successfully');
    }

    public function destroy($id)
    {
        $job = JobOffer::where('user_id', auth()->id())->findOrFail($id);
        $job->delete();
        
        return redirect()->back()->with('success', 'Job deleted successfully');
    }
}