<?php
namespace Modules\Notification\App\Actions;
use Modules\Notification\App\Services\NotificationService;
use Modules\Notification\DTOS\NotificationDTO;
class NotificationAction {
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }
    public function add(NotificationDTO $notificationDTO) {
        $this->notificationService->add($notificationDTO);
    }
}


?>