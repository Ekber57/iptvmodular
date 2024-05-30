<?php 
namespace Modules\WhatsappNotification\Listeners;

use Modules\User\Events\UserCreatedEvent;
use Modules\WhatsappNotification\App\Services\WhatsappNotificationUserBalanceService; 
class UserCreatedListenerForCreateWhastappBalance {
    protected $whatsappNotificationUserBalanceService;
    public function __construct(WhatsappNotificationUserBalanceService $whatsappNotificationUserBalanceService) {
        $this->whatsappNotificationUserBalanceService = $whatsappNotificationUserBalanceService;
    }
    public function handle(UserCreatedEvent $userCreatedEvent) {

        $this->whatsappNotificationUserBalanceService->createPurse($userCreatedEvent->newUser->id);
    }
}


?>