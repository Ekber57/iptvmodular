<?php

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;
use Modules\User\App\Services\BankDetailsService;
use Modules\User\App\Http\Controllers\UserController;
use Modules\User\App\Http\Controllers\BankDetailController;

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

Route::middleware(['auth'])->group(function () {
    Route::post('/usermodule/createbankinformation',[BankDetailController::class,'storeBankDetail']);
    Route::get('/usermodule/createbankinformation', function (BankDetailsService $bankDetailsService) {
        return view('user::bankaccountinfo',["details" => $bankDetailsService->getDetail(Auth::user()->id)]);
    });

    Route::get('/usermodule/useredit',function() {
        $user =  Auth::user();
        $user->password = Crypt::decrypt($user->password);
        return view('user::useredit',['user' =>$user]);
    })->name('user_information');
    Route::post('/usermodule/useredit',[UserController::class,'storeUser']);
});

