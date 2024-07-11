<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\ElectionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

//main route
Route::get('/',[HomeController::class,'home']);

//login with posty request to handle form in login
Route::post('/login',[AuthController::class,'AuthLogin']);
Route::get('/register',[AuthController::class,'createaccount']);
Route::post('/register', [AuthController::class, 'adduser']);


Route::get('/logout',[AuthController::class,'logout']);


//forgot password

Route::get('/forgotpassword', [AuthController::class, 'forgotpassword']);
Route::post('/forgotpassword', [AuthController::class, 'PostForgotPassword']);



//create middleswares to protect routes and access
//admin middle ware
//the new laravel11 middlewares are stores in bootstrap/app.php and not in the kernel

Route::middleware([AdminMiddleware::class])->group(function(){
    Route::get('admin/dashboard',[AuthController::class,'viewdashboard']);
    //get list of admins
    Route::get('/admin/admin/add',function(){
        return view('admin.admin.add');
    });
    Route::post('/admin/admin/add',[AdminController::class, 'addadmin']);
    //get list of admins
    Route::get('/admin/admin/list',[AdminController::class, 'adminlist']);
    //visit admin edit page
    Route::get('/admin/admin/edit/{id}',[AdminController::class, 'adminedit']);
    Route::post('admin/admin/edit/{id}', [AdminController::class, 'updateadmin']);
    Route::get('admin/admin/delete/{id}', [AdminController::class, 'deleteadmin']);



    //add candidate
    Route::get('/admin/candidate/list',[CandidateController::class,'candidatelist']);
    Route::get('/admin/candidate/add',[CandidateController::class,'addcandidateroute']);
    Route::post('/admin/candidate/add',[CandidateController::class,'addcandidate']);
    // Route::get('/admin/user/list',[UserController::class,'userlist']);
    Route::get('/admin/candidate/edit/{id}',[CandidateController::class, 'candidateedit']);
    Route::post('admin/candidate/edit/{id}', [CandidateController::class, 'updatecandidate']);
    Route::get('/admin/candidate/votes/{id}',[CandidateController::class, 'candidatevotes']);
    Route::get('admin/candidate/delete/{id}', [CandidateController::class, 'deletecandidate']);





    Route::get('/admin/elections/list',[ElectionController::class,'electionlist']);
    Route::get('/admin/elections/add',[ElectionController::class,'addelectionroute']);
    Route::post('/admin/elections/add',[ElectionController::class,'addelection']);
    // Route::get('/admin/user/list',[UserController::class,'userlist']);
    Route::get('admin/elections/edit/{id}', [ElectionController::class, 'electionedit']);
    Route::post('admin/elections/update/{id}', [ElectionController::class, 'updateelection']);
    Route::get('admin/elections/delete/{id}', [ElectionController::class, 'deleteelection']);

    //user routes
    Route::get('/admin/user/list',[UserController::class,'userlist']);
    Route::get('/admin/user/add',[UserController::class,'adduserroute']);
    Route::post('/admin/user/add',[UserController::class,'adduser']);
    // Route::get('/admin/user/list',[UserController::class,'userlist']);
    Route::get('/admin/user/edit/{id}',[UserController::class, 'useredit']);
    Route::post('admin/user/edit/{id}', [UserController::class, 'updateuser']);
    Route::get('admin/user/delete/{id}', [UserController::class, 'deleteuser']);
    Route::get('/admin/dashboard', [ElectionController::class, 'dashboard'])->name('admin.dashboard');


});

Route::middleware([UserMiddleware::class])->group(function(){
    Route::get('/user/dashboard',[AuthController::class,'userdashboard']);
    Route::get('/user/voting/vote/{id}',[UserController::class, 'uservote']);
    Route::post('/user/voting/vote/{id}',[UserController::class, 'vote']);
    Route::get('admin/candidate/list/{election_id}', [UserController::class, 'electionCandidates'])->name('candidate.list');

});
