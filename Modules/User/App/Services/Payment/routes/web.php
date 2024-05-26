<?php



use App\Models\User;
use Illuminate\Support\Facades\Route;
use Modules\User\App\Services\BankDetailsService;
use Modules\Payment\App\Http\Controllers\PaymentController;
use Modules\Payment\App\Http\Controllers\ManualPaymentController;

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
    // Route::resource('payment', PaymentController::class)->names('payment');
    Route::get("/manualpayment/{user}", function (User $user, BankDetailsService $bankDetailsService) {
        if ($user->hasPermissionTo('create line')) {
            $currentUser = Auth::user();
            if ($currentUser->id == $user->id) {
                // return redirect("/");
            }
            return view("payment::paymentpage", ['bankdetails' => $bankDetailsService->getDetail($user->id), 'customer' => $currentUser]);
        } else {
            return redirect("/");
        }



    })->name('manual_payment');
    Route::post('/make_manual_payment', [ManualPaymentController::class, "makePayment"]);

});
