<?php

use Illuminate\Support\Facades\Route;
use Modules\Notification\App\Services\NotificationService;
use Modules\Notification\Models\Notification;
use Modules\Notification\App\Http\Controllers\NotificationController;

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
    Route::resource('notification', NotificationController::class)->names('notification');
});

Route::get('/notifications',function(NotificationService $notificationService) {
    return view('notification::notificationlist',['notifications' => $notificationService->getAll(Auth::user()->id)]);
});

Route::get('/read_notification/{notification}',function(Notification $notification){
    $notification->status = 1;
    $notification->save();
    return view("notification::readnotification",["notification" => $notification]);
});