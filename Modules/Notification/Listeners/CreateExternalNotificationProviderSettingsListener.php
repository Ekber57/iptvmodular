<?php 
namespace Modules\Notification\Listeners;
use Modules\Notification\App\Services\ExternalNotificationProviderService;
use Modules\Notification\App\Services\ExternalNotificationServiceBalanceService;
use Modules\Notification\App\Services\NotificationTypeService;
use Modules\User\Events\UserCreatedEvent;

class  CreateExternalNotificationProviderSettingsListener {

    protected $externalNotificationProviderService;
    protected $externalNotificationServiceBalanceService;
    protected $notificationTypeService;
    public function __construct(ExternalNotificationProviderService $externalNotificationProviderService,
    NotificationTypeService $notificationTypeService,    
    ExternalNotificationServiceBalanceService $externalNotificationServiceBalanceService) {
        $this->notificationTypeService = $notificationTypeService;
        $this->externalNotificationProviderService = $externalNotificationProviderService;
        $this->externalNotificationServiceBalanceService = $externalNotificationServiceBalanceService;
    }

    public function handle(UserCreatedEvent $userCreatedEvent) {
        $user  =  $userCreatedEvent->newUser ;
        $this->externalNotificationProviderService->createDefaultServiceProvider($user->id);
        $this->externalNotificationServiceBalanceService->createEmptyNotificationServiceBalances($user->id);
       
    }


  
}


?>