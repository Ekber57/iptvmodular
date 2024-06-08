<?php 
namespace Modules\Notification\ExternalNotificationAPis;
use Illuminate\Support\Facades\Log;
use Modules\Notification\DTOS\NotificationDTO;

class ExternalEmailNotificationAPI {
    public function sendNotification(NotificationDTO $notificationDTO) {
        Log::info(['message' => 'email sended via email external api']);
    }
}
?>