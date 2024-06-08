<?php 
namespace Modules\Notification\ExternalNotificationAPis;
use Modules\Notification\DTOS\NotificationDTO;
class ExternalTelegramNotificationAPI {
    public function sendNotification(NotificationDTO $notificationDTO) {
        Log::info(['message' => 'email sended via telegram external api']);
    }
}
?>