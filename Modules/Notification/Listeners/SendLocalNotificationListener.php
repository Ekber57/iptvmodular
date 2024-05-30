<?php 
namespace Modules\Notification\Listeners;
use Modules\Events\SendNotificationEvent;
use Modules\Notification\DTOS\NotificationDTO;
use Modules\Notification\App\Services\NotificationService;

class SendLocalNotificationListener {
    protected $notificationService;
    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }
    public function handle(SendNotificationEvent $sendNotificationEvent) {
        $notificationDTO = new NotificationDTO();
        $notificationDTO->userId = $sendNotificationEvent->user->id;
        $notificationDTO->title = $sendNotificationEvent->title;
        $notificationDTO->content = $sendNotificationEvent->content;
        $this->notificationService->add($notificationDTO);
    }
}

?>