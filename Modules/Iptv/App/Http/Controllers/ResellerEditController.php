<?php
namespace Modules\Iptv\App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Modules\Iptv\App\Actions\ResellerEditActions;

class ResellerEditController extends Controller{

    public function editReseller(ResellerEditActions $resellerEditActions,User $user) {
        return $resellerEditActions->editReseller($user);
    }
    public function storeReseller(ResellerEditActions $resellerEditActions) {
        return $resellerEditActions->storeReseller();
    }
    public function editSubreseller(ResellerEditActions $resellerEditActions,User $user) {
        return $resellerEditActions->editSubreseller($user);
    }
    public function storeSubreseller(ResellerEditActions $resellerEditActions) {
        return $resellerEditActions->storeSubreseller();
    }


}





?>