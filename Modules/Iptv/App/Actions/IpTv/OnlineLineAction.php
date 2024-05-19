<?php
namespace App\Actions\IpTv;

use App\externalAPIs\IpTv\CustomAPI;
use App\Models\User;
use App\Services\IpTv\LineService;
use App\Services\IpTv\ResellerService;
use App\Services\IpTv\UserBindingService;
use Illuminate\Support\Facades\Auth;

class OnlineLineAction {
    protected $resellerService;
    protected $lineService;
    protected $userBindingService;
    protected $customAPI;
    public function __construct( CustomAPI $customAPI,  ResellerService $resellerService, LineService $lineService,UserBindingService $userBindingService)
    {
        $this->userBindingService = $userBindingService;
        $this->resellerService = $resellerService;
        $this->lineService = $lineService;
        $this->customAPI = $customAPI;
    }
    public function findLinesForReseller(User $user) {
        $owners = $this->resellerService->getSubresellers($user)->toArray();
        array_push($owners,$user->id);
        $lines = $this->lineService->getLinesForOnlain($owners);
        $remoteLineIds = [];
        foreach($lines as $line) {
            array_push($remoteLineIds,$this->userBindingService->getRemoteId($line->user_id));
        }
        return $remoteLineIds ;
        
    }

    public function getOnlineUsersFromXuiInterface() {
        $remoteLineIds =$this->findLinesForReseller(Auth::user());
        // ddd($remoteLineIds);
        return $this->customAPI->getOnlineLines($remoteLineIds);

    }
}




?>