<?php
namespace Modules\Iptv\App\Actions;
use Modules\Iptv\externalAPIs\UserAPi;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Modules\Auth\App\DTOS\UserDTO;
use Modules\Iptv\DTOS\ResellerDTO;
use Illuminate\Support\Facades\Auth;
use Modules\Iptv\DTOS\UserBindingDTO;
use Modules\Auth\App\Services\UserService;
use Modules\Iptv\externalAPIs\PackagesAPI;
use Modules\Iptv\App\Services\PackageService;
use Modules\Iptv\App\Services\CashbackService;
use Modules\Iptv\App\Services\ResellerService;
use Modules\Iptv\App\Services\UserBindingService;
use Modules\Iptv\App\Http\Requests\ResellerCreateRequest;
use Modules\Iptv\App\Http\Requests\SubresellerCreateRequest;
use Modules\User\Events\UserCreatedEvent;

class ResellerAction {
    protected $userService;
    protected $packageService;
    protected $packagesAPI;
    protected $resellerService;
    protected $userAPI;
    protected $userAction;
    protected $userBindingService;
    protected $packageAction;
    protected $cashbackService;

    public function __construct(
        CashbackService $cashbackService,
        PackageAction $packageAction,
       UserAction $userAction,
        UserBindingService $userBindingService,
        UserAPi $userAPI,  PackageService $packageService, ResellerService $resellerService, UserService $userService,PackagesAPI $packagesAPI)
    {
        $this->cashbackService =  $cashbackService;
        $this->userAction = $userAction;
        $this->userService = $userService;
        $this->resellerService = $resellerService;
        $this->packageAction = $packageAction;
        $this->packagesAPI = $packagesAPI;
        $this->packageService = $packageService;
        $this->userAPI = $userAPI;
        $this->userBindingService = $userBindingService;

    }




    public function getSubresellers() {
        $subresellers =  $this->resellerService->getSubresellers(Auth::user())->values()->toArray();
        return $this->userService->getUsersById($subresellers);
    }
    public function getResellers() {
        $resellers =  $this->resellerService->getResellers()->pluck("user_id")->toArray();

        return $this->userService->getUsersById($resellers);
    }

public function addSubreseller(SubresellerCreateRequest $subresellerCreateRequest) {
    DB::beginTransaction();
    try {
        $userDTO = new UserDTO();
        $userDTO->name = $subresellerCreateRequest->name;
        $userDTO->email = $subresellerCreateRequest->mail;
        $userDTO->phone = $subresellerCreateRequest->phone;
        $userDTO->username = $subresellerCreateRequest->username;
        $userDTO->password = $subresellerCreateRequest->password;
        $userDTO->balance = $subresellerCreateRequest->balance;
        $user = $this->userService->addUser($userDTO);
        $user->givePermissionTo("iptv create line");
        $resellerDTO = new ResellerDTO();
        $parent = Auth::user();
        $this->decreaseParentBalance($parent,$subresellerCreateRequest->balance);
        $remote_id = $this->userAction->addUser()["id"];
        $userBindingDTO = new UserBindingDTO();
        $userBindingDTO->localId = $user->id;
        $userBindingDTO->remoteId = $remote_id;
        $this->userBindingService->addBinding($userBindingDTO);
        $resellerDTO->parent = $parent->id;
        $resellerDTO->child = $user->id;
        $reseller = $this->resellerService->addSubreseller($resellerDTO);
        $parent = $this->userService->getUserById( $this->resellerService->getParent(Auth::user()->id));
        $this->packageAction->createPackageForUser($subresellerCreateRequest,$user);
        event(new UserCreatedEvent($user,Auth::user(),$parent));
        DB::commit();
        $data = ['message' => 'Subreseller yardildi'];
        // Flash the data to the session
        session()->flash('data', $data);
        // Redirect to another route
        return redirect()->route('create_subreseller');
    }
     catch (Exception $e){
        DB::rollBack();
        throw $e;
    }

}



    public function addReseller(ResellerCreateRequest $request) {

        DB::beginTransaction();
        try {
            $userDTO = new UserDTO();
            $userDTO->name = $request->name;
            $userDTO->email = $request->mail;
            $userDTO->phone = $request->phone;
            $userDTO->username = $request->username;
            $userDTO->password = $request->password;
            $userDTO->balance = $request->balance;
            $user = $this->userService->addUser($userDTO);
            $user->givePermissionTo("iptv create subreseller");
            $user->givePermissionTo("iptv create line");
            $user->givePermissionTo("iptv create subreseller");
            
            $this->cashbackService->createPurse($user);
            $resellerDTO = new ResellerDTO();
            $parent = Auth::user();
            $this->decreaseParentBalance($parent,$request->balance);
            $resellerDTO->parent = $parent->id;
            $resellerDTO->child = $user->id;
            $remote_user = $this->userAction->addUser();
            $userBindingDTO = new UserBindingDTO();
            $userBindingDTO->localId = $user->id;
            $userBindingDTO->remoteId = $remote_user["id"];
            $resellerDTO->groupId = $request->group_id;
            $this->userBindingService->addBinding($userBindingDTO);
            $reseller = $this->resellerService->addReseller($resellerDTO);
            event(new UserCreatedEvent($user,null,null,false));
            DB::commit();
            $data = ['message' => 'Reseller yardildi'];

            // Flash the data to the session
            session()->flash('data', $data);
        
            // Redirect to another route
            return redirect()->route('create_reseller');
        }
         catch (Exception $e){
            DB::rollBack();
            throw $e;
        }
   
    }
    private function decreaseParentBalance(User $user,$amount) {
        $user = Auth::user();
        $this->userService->decreaseParentBalance($user,$amount);
    }

    public function editGroup(User $user) {
        $group = request()->group_id;
        $this->resellerService->editGroup($user,$group);
        // $this->packageAction->c
    }



}



?>