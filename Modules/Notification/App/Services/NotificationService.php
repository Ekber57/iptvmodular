<?php
namespace Modules\Notification\App\Services;
use Modules\Notification\DTOS\NotificationDTO;
use Notification;

class NotificationService {
    public function add(NotificationDTO $notificationDTO) {
        return Notification::create([
            'user_id' => $notificationDTO->userId,
            'title' => $notificationDTO->title,
            'content' => $notificationDTO->content,
            'status' => 0
        ]);
    }
}
?>