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

// Lock screen routes
Route::get('/lock-screen', function () {
    return view('auth.lockscreen');
})->name('lock_screen');

// Routes that require authentication and screen lock check
Route::middleware(['auth', 'locked.screen'])->group(function () {
    // Dashboard route
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('verified')->name('dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Unlock route
    Route::post('unlock', [LockScreen::class, 'unlock'])->name('unlock');
});

// Lock screen action route
Route::post('lock-screen', [LockScreen::class, 'lockScreen'])->name('lock_screen');

// Logout route
Route::post('/logout', [LockScreen::class, 'logout'])->name('logout');

require __DIR__.'/auth.php';
