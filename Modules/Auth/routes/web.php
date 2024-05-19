<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\App\Http\Controllers\AuthController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([], function () {
    Route::get("/dashboard",function(){
        // ddd(Auth::user());
    });
    // AUTH ROUTES START
    Route::get("/logout", [AuthController::class, "logout"])->name("logout");
    Route::post("/signup", [AuthController::class, "register"])->name("register");
    Route::post("/signin", [AuthController::class, "login"])->name("signin");
    Route::get('/signup', function () {
        return view("auth::signup");
    });
    Route::get('/signin', function () {
        return view("auth::signin");
    });

    Route::get("/passreset",[AuthController::class,"passwordReset"])->name("passwordReset");
    Route::post("/passreset",[AuthController::class,"storePassword"])->name('storePassword');
    Route::get("/passwordforget",[AuthController::class,"forgetPassword"])->name('forgetPassword');
    Route::post("/recoverpassword",[AuthController::class,"recoverPassword"])->name("recoverPassword");

});
