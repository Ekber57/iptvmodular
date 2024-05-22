<?php
namespace Modules\Iptv\App\Actions;

use Modules\Iptv\DTOS\UserDTO;
use Illuminate\Support\Facades\Auth;
use Modules\Iptv\externalAPIs\UserAPi;
use Modules\Iptv\App\Services\UserBindingService;

class UserAction {
    protected $userAPi;
    protected $userBindingService;
    public function __construct(UserAPi $userAPi,UserBindingService $userBindingService)
    {
        $this->userAPi = $userAPi;   
        $this->userBindingService = $userBindingService;
    }

    public function addUser() {
        $userDTO = new UserDTO();
        $userDTO->username = request()->username;
        $userDTO->password = request()->password;

        $userDTO->credits = request()->balance;
        if(request()->group_id) {
            $userDTO->groupId = request()->group_id;
            $userDTO->ownerId  = 1;
        }
        else {
            $userDTO->groupId = 3;
            $userDTO->ownerId  =  $this->userBindingService->getRemoteId(Auth::user()->id);
        }

        return $this->userAPi->addUser($userDTO)["data"];
    }
}



?>