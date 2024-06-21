<?php

use App\Http\Controllers\ProfileController;
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

Route::post('/profile/update-picture', [UserController::class, 'updateProfilePicture'])->name('profile.update.picture');

Route::get('/', function () {
    return view('welcome');
});

//lock screen 
Route::get('lock_screen', [App\Http\Controllers\Auth\LockScreen::class, 'lockScreen'])-> name('lock_screen');
Route::post('unlock',[App\Http\Controllers\Auth\LockScreen::class,'unlock'])->name('unlock');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');


require __DIR__.'/auth.php';
