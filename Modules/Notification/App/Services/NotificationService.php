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

    public function getNotifications($userId) {
        return  Notification::where("user_id",$userId)->orderBy('id', 'desc')->limit(10)->get();
    }
    public function readNotification($notificationId) {
        $notification = Notification::find($notificationId);
        $notification->status = 1;
        $notification->save();
        return $notification;
    }

    public function getAll($userId) {
        return  Notification::where("user_id",$userId)->orderBy('id', 'desc')->paginate(2);
    }
}
?>