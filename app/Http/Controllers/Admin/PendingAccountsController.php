<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PendingAccountsController extends Controller
{
    public function index()
    {
        $pendingUsers = User::where('role', 'alumni')->where('status', 'pending')->get();
        return view('admin.pending-accounts', compact('pendingUsers'));
    }

    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->update(['status' => 'approved']);
        
        return redirect()->back()->with('success', 'Account approved successfully');
    }

    public function reject($id)
    {
        $user = User::findOrFail($id);
        $user->update(['status' => 'rejected']);
        
        return redirect()->back()->with('success', 'Account rejected');
    }
}