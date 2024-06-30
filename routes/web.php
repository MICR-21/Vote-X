
<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\ElectionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;


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

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});



//admin route
Route::get('/admin',[HomeController::class,'index'])->name('admins');

//candidate route
Route::get('/candidate',[CandidateController::class,'index'])->name('candidates');


//contact Us

Route::get('/contact', function () {
    return view('contactUs');
})->name('contact');

Route::post('/contact', [ContactUsController::class, 'submit'])->name('contact.submit');

//election routes
Route::resource('elections', ElectionController::class);



Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
            ->name('logout');
});
// Include authentication routes
require __DIR__.'/auth.php';
