<?php
namespace Modules\Notification\Listeners;

use Modules\Events\SendNotificationEvent;
use Modules\Notification\App\Services\ExternalNotificationProviderService;
use Modules\Notification\App\Services\ExternalNotificationServiceBalanceService;
use Modules\Notification\DTOS\NotificationDTO;
use Modules\Notification\App\Services\NotificationService;
use Modules\Notification\ExternalNotificationAPis\ExternalEmailNotificationAPI;
use Modules\Notification\ExternalNotificationAPis\ExternalSmsNotificationAPI;
use Modules\Notification\ExternalNotificationAPis\ExternalTelegramNotificationAPI;
use Modules\Notification\ExternalNotificationAPis\ExternalWhatsappNotificationAPI;

class SendLocalNotificationListener
{
    protected $notificationService;
    protected $externalNotificationServiceBalanceService;
    protected $externalNotificationProviderService;
    protected $externalSmsNotificationAPI;
    protected $externalTelegramNotificationAPI;

    protected $externalWhatsappNotificationAPI;
    protected $externalEmailNotificationAPI;

    public function __construct(
        NotificationService $notificationService,
        ExternalNotificationProviderService $externalNotificationProviderService,
        ExternalNotificationServiceBalanceService $externalNotificationServiceBalanceService,
        ExternalWhatsappNotificationAPI $externalWhatsappNotificationAPI,
        ExternalSmsNotificationAPI $externalSmsNotificationAPI,
        ExternalTelegramNotificationAPI $externalTelegramNotificationAPI,
        ExternalEmailNotificationAPI $externalEmailNotificationAPI
    ) {
        $this->externalNotificationProviderService = $externalNotificationProviderService;
        $this->externalNotificationServiceBalanceService = $externalNotificationServiceBalanceService;
        $this->notificationService = $notificationService;
        $this->externalEmailNotificationAPI = $externalEmailNotificationAPI;
        $this->externalSmsNotificationAPI = $externalSmsNotificationAPI;
        $this->externalWhatsappNotificationAPI = $externalWhatsappNotificationAPI;
        $this->externalTelegramNotificationAPI = $externalTelegramNotificationAPI;
    }
    public function handle(SendNotificationEvent $sendNotificationEvent)
    {
        $notificationDTO = new NotificationDTO();
        $notificationDTO->userId = $sendNotificationEvent->user->id;
        $notificationDTO->title = $sendNotificationEvent->title;
        $notificationDTO->content = $sendNotificationEvent->content;
        $this->notificationService->add($notificationDTO);
        $this->checkProviderBalanceAndSendNotification($notificationDTO);


    }
    protected function checkProviderBalanceAndSendNotification(NotificationDTO $notificationDTO)
    {
        $userExternalNotificationProvider = $this->externalNotificationProviderService->getDefaultServiceProvider($notificationDTO->userId);

        $providerBalance = $this->externalNotificationServiceBalanceService->getProviderBalance($notificationDTO->userId, $userExternalNotificationProvider);

        if ($userExternalNotificationProvider == 'email' || $providerBalance == 0) {
            $this->externalEmailNotificationAPI->sendNotification($notificationDTO);
            return null;
        } else {
            switch ($userExternalNotificationProvider) {
                case 'whatsapp':
                    $this->externalWhatsappNotificationAPI->sendNotification($notificationDTO);
                    break;
                case 'telegram':
                    $this->externalTelegramNotificationAPI->sendNotification($notificationDTO);
                    break;
                case 'sms':
                    $this->externalSmsNotificationAPI->sendNotification($notificationDTO);
                    break;
                default:
                    $this->externalEmailNotificationAPI->sendNotification($notificationDTO);
                    break;
            }
        }
    }
}

?>