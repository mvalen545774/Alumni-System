<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\JobOffer;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Calculate profile completion
        $completion = 0;
        if ($user->phone) $completion += 25;
        if ($user->address) $completion += 25;
        if ($user->alumni && $user->alumni->employment_status) $completion += 25;
        if ($user->alumni && $user->alumni->current_employer) $completion += 25;
        
        $profileCompletion = $completion;
        
        // Get recent job postings for the feed (last 5)
        $recentJobs = JobOffer::with('user')->latest()->take(5)->get();
        
        return view('alumni.dashboard', compact('user', 'profileCompletion', 'recentJobs'));
    }
}