<?php 
namespace Modules\WhatsappNotification\Listeners;
use Modules\Events\SendNotificationEvent;
use Modules\WhatsappNotification\App\Services\WhatsappNotificationUserBalanceService;
use Modules\WhatsappNotification\externalApis\WhatsappAPI;

class WhatsappNotificationSendListner {
    protected $whatsappNotificationUserBalanceService ;
    protected $whatsappAPI;
    public function __construct(WhatsappNotificationUserBalanceService $whatsappNotificationUserBalanceService,WhatsappAPI $whatsappAPI) {
        $this->whatsappNotificationUserBalanceService = $whatsappNotificationUserBalanceService;
        $this->whatsappAPI = $whatsappAPI;
    }
    public function handle(SendNotificationEvent $sendNotificationEvent) {
        $user = $sendNotificationEvent->user;
        $balance = $this->whatsappNotificationUserBalanceService->getBalance($user->id);
        if($balance > 0) {

            $this->whatsappAPI->sendMessage($sendNotificationEvent->content,$user->phone);
        }
    }
}
?>