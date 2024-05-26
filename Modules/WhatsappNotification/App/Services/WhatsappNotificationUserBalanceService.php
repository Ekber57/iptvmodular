<?php 
namespace Modules\WhatsappNotification\App\Services;

use Modules\WhatsappNotification\DTOS\WhatsappNotificationUserBalanceDTO;
use Modules\WhatsappNotification\Models\WhatsappNotificationBalance;

class WhatsappNotificationUserBalanceService {
    public function addBalance(WhatsappNotificationUserBalanceDTO $whatsappNotificationUserBalanceDTO) {
        $user = WhatsappNotificationBalance::where('user_id',$whatsappNotificationUserBalanceDTO->userId)->first();
        $user->balance = $user->balance + $whatsappNotificationUserBalanceDTO->balance;
        $user->save();
    }

    public function getBalance($userId) {
        return  WhatsappNotificationBalance::where('user_id',$userId)->first()->balance;
    } 
}



?>