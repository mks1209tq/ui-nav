<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/hr/pp/dashboard', function () {
        return view('apps.hr.passport.dashboard');
    })->middleware(['auth', 'verified'])->name('hr.passport.dashboard');







    
    Route::resource('passports', App\Http\Controllers\PassportController::class);














});

require __DIR__.'/auth.php';


Route::resource('applicants', App\Http\Controllers\ApplicantController::class);

// ... existing code ...






