<?php 
namespace Modules\Iptv\App\Actions;
use App\Models\User;
use Modules\Notification\DTOS\NotificationTypeDTO;
use Modules\Notification\App\Services\NotificationTypeService;

class NotificationAction {
    protected $notificationTypeService;
    public function __construct(NotificationTypeService $notificationTypeService) {
        $this->notificationTypeService = $notificationTypeService;
    }

    public function createNotifications(User $user) {
        $notifications = [];
        array_push($notifications,$this->createNotificationTypeDTO($user,"Send notification when line expired","iptv line"));
        array_push($notifications,$this->createNotificationTypeDTO($user,"Send notification when subreseller created","iptv create subreseller"));
        array_push($notifications,$this->createNotificationTypeDTO($user,"Send notification when reseller created","iptv create reseller"));
        $this->notificationTypeService->addType($notifications);
    }

    private function createNotificationTypeDTO(User $user, $definition,$permission) {
        $notification = new NotificationTypeDTO();
        $notification->userId = $user->id;
        $notification->definition = $definition;
        $notification->type = "Iptv";
        $notification->permission = $permission;
        return $notification;
    }
}


?>