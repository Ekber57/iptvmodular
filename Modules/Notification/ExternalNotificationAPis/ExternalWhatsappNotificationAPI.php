<?php 
namespace Modules\Notification\ExternalNotificationAPis;
use Modules\Notification\DTOS\NotificationDTO;
class ExternalWhatsappNotificationAPI {
    public function sendNotification(NotificationDTO $notificationDTO) {
        Log::info(['message' => 'email sended via whatsaopp external api']);
    }
}