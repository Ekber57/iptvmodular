<?php 
namespace Modules\WhatsappNotification\Listeners;
use Modules\WhatsappNotification\App\Services\WhatsappNotificationUserBalanceService;
use Modules\WhatsappNotification\Events\SendWhatsappNotificationEvent;
use Modules\WhatsappNotification\externalApis\WhatsappAPI;

class WhatsappNotificationSendListner {
    protected $whatsappNotificationUserBalanceService ;
    protected $whatsappAPI;
    public function __construct(WhatsappNotificationUserBalanceService $whatsappNotificationUserBalanceService,WhatsappAPI $whatsappAPI) {
        $this->whatsappNotificationUserBalanceService = $whatsappNotificationUserBalanceService;
        $this->whatsappAPI = $whatsappAPI;
    }
    public function handle(SendWhatsappNotificationEvent $sendWhatsappNotificationEvent) {
        $dto = $sendWhatsappNotificationEvent->whatsappNotificationDTO;
        $balance = $this->whatsappNotificationUserBalanceService->getBalance($dto->userId);
        if($balance > 0) {
            $this->whatsappAPI->sendMessage($dto);
        }
    }
}
?>