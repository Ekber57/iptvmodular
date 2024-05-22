<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Modules\Iptv\App\Actions\LineAction;
use Modules\Iptv\App\Services\LineService;
use Modules\Iptv\externalAPIs\PackagesAPI;
use Modules\Iptv\App\Actions\OnlineLineAction;
use Modules\Iptv\App\Services\ResellerService;
use Modules\Iptv\App\Services\UserBindingService;
use Modules\Iptv\App\Http\Controllers\IptvController;
use Modules\Iptv\App\Http\Controllers\LineController;
use Modules\Iptv\App\Http\Controllers\ResellerController;
use Modules\Iptv\App\Http\Controllers\ResellerEditController;

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
    Route::resource('iptv', IptvController::class)->names('iptv');
    
// Route::get("/",function() {
//     (new OnlineLineAction(new ResellerService(),new LineService(),new UserBindingService()))->findLinesForReseller();
//     // return (new BouquetAction(new BouquetService(), new BouquetsAPI()))->sync();
//     });
    
    
    
    
    // Route::get("/dashboard",[DashboardController::class,"index"]);
    Route::get("/dashboard",function(OnlineLineAction $onlineLineAction,LineAction $lineAction, LineService $lineService) {
    $user = Auth::user();
    $lineAction->getWillExpiredLines();
        if($user->hasPermissionTo("create line")) {
            // print_r($onlineLineAction->getOnlineUsersFromXuiInterface());
            return view("iptv::resellerdashboard",[
                "connections_count" => count($onlineLineAction->getOnlineUsersFromXuiInterface()),
                "lines" => $lineAction->getWillExpiredLines()
            ]);
        }
        else {
            return view("linedashboard",[
                "user" => $user,
                "line" => $lineService->getLine($user)
        ]);
        }
        // if(!Auth::check()) {
        //     return redirect()->route('sign_in');
        // }
        // $user = $user;
        // $line = Line::where('username',$user->username)->first();
        // return  view("dashboard",[
        //     "line" => $line,
        //     "user" => $user,
        //     "packages" => (new PackagesAPI())->getPackages(),
        //     "connections"=> (new CustomAPI())->getOnlineLines(array(6715))
    
        // ]);
    });
    
    
    
    
    Route::get('/reseller/lines',[LineController::class,"show"]);
    Route::get('/reseller/lines/create',[LineController::class,"create"])->name("create_line");
    Route::post('/reseller/lines/store',[LineController::class,"store"]);
    Route::get('/reseller/packages/show',[ResellerController::class,"showPackages"]);
    Route::post('/reseller/packages/edit',[ResellerController::class,"editPackages"]);
    
    // Users 
    
    
    
    
    Route::get("/users",function () {
        return (new UserAction())->showUsers();
    });
    



    Route::get("/profile",function(User $user){
        $currentUser  = Auth::user();
            return view("iptv::profile",["user" => $currentUser]);
    });
    

    
    // Route::get("/profile/{user}",function(User $user){
    //     $currentUser  = Auth::user();
    //     if($currentUser->hasPermissionTo("create line")) {
    //         return view("iptv::profile",["user" => $curr]);
    //     }
    //     else if($user->id == $currentUser->user) {

    //     }
    //     else {
    //         return redirect()->route("signin");
    //     }
    // });
    
    // reseller
    
    Route::get('/reseller/create',[ResellerController::class,"createReseller"])->name("create_reseller");
    Route::get('/subreseller/create',[ResellerController::class,"createSubreseller"])->name("create_subreseller");
    Route::post('/reseller/create',[ResellerController::class,"storeReseller"]);
    Route::post('/subreseller/create',[ResellerController::class,"storeSubreseller"]);
    Route::get('/reseller/get_subresellers',[ResellerController::class,"getSubresellers"])->name("subresellerlist");
    Route::get('/reseller/get_resellers',[ResellerController::class,"getResellers"])->name("resellerlist");
    // Route::get('/system/user/edit/{user}',[AuthController::class,"editUser"])->name("edit_user");
    // Route::post('/system/user/edit',[AuthController::class,"storeUser"])->name("store_user");
    
    
    Route::get("reseller/edit/{user}",[ResellerEditController::class,"editReseller"]);
    Route::post("reseller/edit",[ResellerEditController::class,"storeReseller"]);
    
    Route::get("subreseller/edit/{user}",[ResellerEditController::class,"editSubreseller"]);
    Route::post("subreseller/edit",[ResellerEditController::class,"storeSubreseller"]);
    
    
    
    
    
    
    
    
    
    
    
    Route::get("package_list",function(){
    return view("packagelist",["packages" => (new PackagesAPI())->getPackages()]);
    });
    
    
    
    
    
    
    Route::get("/read_messages",function() {
        return view("readmessage");
    });
    
    
    Route::get("/messages",function() {
        return view("messages");
    });
    
});
