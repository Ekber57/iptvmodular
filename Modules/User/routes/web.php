<?php

use Illuminate\Support\Facades\Route;
use Modules\User\App\Http\Controllers\UserController;
use Modules\User\App\Services\BankDetailsService;

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
    Route::post('/usermodule/createbankinformation',[UserController::class,'storeBankDetail'])->name('bank_information');
    Route::get('/usermodule/createbankinformation', function (BankDetailsService $bankDetailsService) {
        return view('user::bankaccountinfo',["details" => $bankDetailsService->getDetail(Auth::user()->id)]);
    });
});

