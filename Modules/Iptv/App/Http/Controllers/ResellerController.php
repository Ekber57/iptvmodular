<?php
namespace Modules\Iptv\App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Iptv\externalAPIs\GroupsAPI;
use Modules\Iptv\App\Actions\PackageAction;
use Modules\Iptv\App\Actions\ResellerAction;
use Modules\Iptv\App\Services\ResellerService;
use Modules\Iptv\App\Http\Requests\ResellerCreateRequest;
use Modules\Iptv\App\Http\Requests\SubresellerCreateRequest;


class ResellerController extends Controller {
    public function createSubreseller(PackageAction $packageAction,ResellerService $resellerService) {
        return view("iptv::create_subreseller",["packages" => $packageAction->getResellerPackages(Auth::user())]);
    }
    public function createReseller(ResellerAction $resellerAction,ResellerService $resellerService,GroupsAPI $groupsAPI) {
        return view("iptv::create_reseller",["groups" => $groupsAPI->getGroups()]);
    }


    public function getResellers(ResellerAction $resellerAction) {
        $this->authorize("create reseller");

        return view("iptv::resellers",[
            "users" => $resellerAction->getResellers()
        ]);
    }

    public function getSubresellers(ResellerAction $resellerAction) {
        $this->authorize("create subreseller");
        return view("iptv::subresellers",[
            "users" => $resellerAction->getSubresellers()
        ]);
    }









    public function storeReseller(ResellerAction $resellerAction, ResellerCreateRequest $resellerCreateRequest) 
    {
        $this->authorize("create reseller");
        return $resellerAction->addReseller($resellerCreateRequest);
    }
    public function storeSubreseller(ResellerAction $resellerAction, SubresellerCreateRequest $subresellerCreateRequest) 
    {
        $this->authorize("create subreseller");
        return $resellerAction->addSubreseller($subresellerCreateRequest);
    }

    public function showPackages(PackageAction $packageAction) {
        return $packageAction->showPackages();
    }


    public function editPackages(Request $request,PackageAction $packageAction) {
        if(Auth::user()->hasPermissionTo("create subreseller")) {
            return $packageAction->createPackageForUser($request);
        }
        else {
            return $packageAction->createCustomPackage($request);
        }
       
    }
}


?> 