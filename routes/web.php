<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LockScreen;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Dashboard route
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified','locked.screen'])->name('dashboard');

// Group routes that require authentication
Route::middleware('auth')->group(function () {
    // Lock screen routes
    Route::get('/lock-screen', function () {
        return view('auth.lockscreen');
    }) ->name('lock_screen');

    Route::post('lock-screen', [LockScreen::class, 'lockScreen'])->name('lock_screen');
    Route::post('unlock', [LockScreen::class, 'unlock'])->name('unlock');

    // Group routes that are protected by the lock screen middleware
    Route::middleware('locked.screen')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});

require __DIR__.'/auth.php';
