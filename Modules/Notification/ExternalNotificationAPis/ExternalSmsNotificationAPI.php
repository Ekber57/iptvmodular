<?php 
namespace Modules\Notification\ExternalNotificationAPis;
use Modules\Notification\DTOS\NotificationDTO;
class  ExternalSmsNotificationAPI {
    public function sendNotification(NotificationDTO $notificationDTO) {
        Log::info(['message' => 'email sended via sms external api']);
    }
}
?>