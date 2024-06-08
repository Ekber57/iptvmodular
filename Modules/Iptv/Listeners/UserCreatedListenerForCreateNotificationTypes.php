<?php 
namespace Modules\Iptv\Listeners;
use Modules\Iptv\App\Actions\NotificationAction;
use Modules\Notification\App\Services\NotificationTypeService;
use Modules\User\Events\UserCreatedEvent;

class UserCreatedListenerForCreateNotificationTypes {
    protected $notificationTypeService;
    public function __construct(NotificationTypeService $notificationTypeService) {
        $this->notificationTypeService = $notificationTypeService;
    }
    public function handle(UserCreatedEvent $userCreatedEvent) {
        $notificationAction = new NotificationAction($this->notificationTypeService);
        $notificationAction->createNotifications($userCreatedEvent->newUser);
    }
}




?>