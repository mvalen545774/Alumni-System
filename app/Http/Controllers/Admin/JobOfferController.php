<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobOffer;
use Illuminate\Http\Request;

class JobOfferController extends Controller
{
    public function index()
    {
        $jobs = JobOffer::with('user')->latest()->paginate(10);
        return view('admin.job-offers.index', compact('jobs'));  // CHANGED: added .index
    }

    public function show($id)
    {
        $job = JobOffer::with('user')->findOrFail($id);
        return view('admin.job-offers.show', compact('job'));
    }

    public function edit($id)
    {
        $job = JobOffer::findOrFail($id);
        return view('admin.job-offers.edit', compact('job'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'job_title' => 'required',
            'company' => 'required',
            'location' => 'required',
            'description' => 'required',
        ]);

        JobOffer::create([
            'user_id' => auth()->id(),
            'job_title' => $request->job_title,
            'company' => $request->company,
            'location' => $request->location,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.job-offers.index')->with('success', 'Job offer posted');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'job_title' => 'required',
            'company' => 'required',
            'location' => 'required',
            'description' => 'required',
        ]);

        $job = JobOffer::findOrFail($id);
        $job->update($request->all());

        return redirect()->route('admin.job-offers.index')->with('success', 'Job offer updated successfully');
    }

    public function destroy($id)
    {
        $job = JobOffer::findOrFail($id);
        $job->delete();
        
        return redirect()->route('admin.job-offers.index')->with('success', 'Job offer deleted');
    }
}