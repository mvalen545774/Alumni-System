<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\JobOffer;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAlumni = User::where('role', 'alumni')->where('status', 'approved')->count();
        $pendingAccounts = User::where('role', 'alumni')->where('status', 'pending')->count();
        $totalJobs = JobOffer::count();
        
        return view('admin.dashboard', compact('totalAlumni', 'pendingAccounts', 'totalJobs'));
    }
}