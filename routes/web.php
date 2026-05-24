<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\AlumniController;
use App\Http\Controllers\Admin\PendingAccountsController;
use App\Http\Controllers\Admin\DegreeProgramController;
use App\Http\Controllers\Admin\JobOfferController as AdminJobOfferController;
use App\Http\Controllers\Alumni\DashboardController as AlumniDashboardController;
use App\Http\Controllers\Alumni\ProfileController as AlumniProfileController;
use App\Http\Controllers\Alumni\DirectoryController;
use App\Http\Controllers\Alumni\JobBoardController;

// Dashboard redirect after login
Route::get('/dashboard', function () {
    if (auth()->check()) {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('alumni.dashboard');
    }
    return redirect()->route('login');
})->middleware(['auth'])->name('dashboard');

// Guest routes
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Auth routes (Laravel Breeze)
require __DIR__.'/auth.php';

// Custom registration for alumni
Route::get('/register/alumni', function () {
    $degreePrograms = \App\Models\DegreeProgram::all();
    return view('auth.register', compact('degreePrograms'));
})->name('register.alumni');

// Protected routes
Route::middleware(['auth', 'approved'])->group(function () {
    
    // ADMIN ROUTES
    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('alumni', AlumniController::class);

        // Pending Accounts
        Route::get('/pending-accounts', [PendingAccountsController::class, 'index'])->name('pending-accounts');
        Route::post('/pending-accounts/{id}/approve', [PendingAccountsController::class, 'approve'])->name('pending.approve');
        Route::post('/pending-accounts/{id}/reject', [PendingAccountsController::class, 'reject'])->name('pending.reject');

        // Degree Programs
        Route::get('/degree-programs', [DegreeProgramController::class, 'index'])->name('degree-programs');
        Route::post('/degree-programs', [DegreeProgramController::class, 'store'])->name('degree-programs.store');
        Route::put('/degree-programs/{id}', [DegreeProgramController::class, 'update'])->name('degree-programs.update');
        Route::delete('/degree-programs/{id}', [DegreeProgramController::class, 'destroy'])->name('degree-programs.destroy');

        // Job Offers
        Route::get('/job-offers', [AdminJobOfferController::class, 'index'])->name('job-offers.index');
        Route::post('/job-offers', [AdminJobOfferController::class, 'store'])->name('job-offers.store');
        Route::get('/job-offers/{id}', [AdminJobOfferController::class, 'show'])->name('job-offers.show');
        Route::get('/job-offers/{id}/edit', [AdminJobOfferController::class, 'edit'])->name('job-offers.edit');
        Route::put('/job-offers/{id}', [AdminJobOfferController::class, 'update'])->name('job-offers.update');
        Route::delete('/job-offers/{id}', [AdminJobOfferController::class, 'destroy'])->name('job-offers.destroy');
    });
    
    // ALUMNI ROUTES
    Route::middleware(['alumni'])->prefix('alumni')->name('alumni.')->group(function () {
        Route::get('/dashboard', [AlumniDashboardController::class, 'index'])->name('dashboard');
        
        Route::get('/profile', [AlumniProfileController::class, 'index'])->name('profile');
        Route::get('/profile/edit', [AlumniProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile/update', [AlumniProfileController::class, 'update'])->name('profile.update');

        Route::get('/directory', [DirectoryController::class, 'index'])->name('directory');
        Route::get('/directory/{id}', [DirectoryController::class, 'show'])->name('directory.show');

        Route::get('/job-board', [JobBoardController::class, 'index'])->name('job-board');
        Route::post('/job-board', [JobBoardController::class, 'store'])->name('job-board.store');
        Route::get('/job-board/{id}/edit', [JobBoardController::class, 'edit'])->name('job-board.edit');
        Route::put('/job-board/{id}', [JobBoardController::class, 'update'])->name('job-board.update');
        Route::delete('/job-board/{id}', [JobBoardController::class, 'destroy'])->name('job-board.destroy');
    });
});