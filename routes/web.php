<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\ElectionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Main welcome route
Route::get('/', function () {
    return view('welcome');
});

// Lock screen routes
Route::get('lock_screen', [App\Http\Controllers\Auth\LockScreen::class, 'lockScreen'])->name('lock_screen');
Route::post('unlock', [App\Http\Controllers\Auth\LockScreen::class, 'unlock'])->name('unlock');

// Dashboard route
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Logout route
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Admin route
Route::get('/admin', [HomeController::class, 'index'])->name('admins');

// Candidate routes
Route:: resource('candidates', CandidateController::class);


// Contact Us routes
Route::get('/contact', function () {
    return view('contactUs');
})->name('contact');

Route::post('/contact', [ContactUsController::class, 'submit'])->name('contact.submit');

// Election routes
Route::resource('elections', ElectionController::class)->middleware('auth');

// Profile routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Include authentication routes
require __DIR__.'/auth.php';
