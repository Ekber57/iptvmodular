<?php
namespace Modules\Iptv\App\Services;

use Modules\Iptv\Models\UserBinding;
use Modules\Iptv\DTOS\UserBindingDTO;

class UserBindingService {
    public function addBinding(UserBindingDTO $userBindingDTO) {
        return UserBinding::create([
            'remote_id' => $userBindingDTO->remoteId,
            'local_id' => $userBindingDTO->localId,
         ]);
        }

    public function getRemoteId($localId) {
        return UserBinding::where("local_id","=",$localId)->first()->remote_id;
    }
}





?>