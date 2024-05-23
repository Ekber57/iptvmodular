<?php
namespace Modules\Notification\App\Services;
use Modules\Notification\Models\Notification;
use Modules\Notification\DTOS\NotificationDTO;

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