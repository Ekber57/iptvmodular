<?php

namespace App\Listeners;

use App\Events\ManualPaymentRequestEvent;
use Modules\Auth\App\Services\UserService;
use Modules\Iptv\App\Services\ResellerService;
use Modules\Notification\App\Services\NotificationService;
use Modules\Notification\DTOS\NotificationDTO;

class SendNotificationWhenManualPaymentListener
{
    /**
     * Create the event listener.
     */
    // public $objec
    public function __construct(ManualPaymentRequestEvent $event)
    {    

    }

    /**
     * Handle the event.
     */
    public function handle(ManualPaymentRequestEvent $event): void
    {
        $event = $event->manualPayment;
        $notificationService = new NotificationService();
        $resellerService = new ResellerService();
        $userService = new UserService();
        $user = $userService->getUserById($event->user_id);
        $parentId = $resellerService->getParent($event->user_id);
        $notificationDTO = new NotificationDTO();
        $notificationDTO->userId = $parentId;
        $notificationDTO->title = 'yeni balans artirma';
        $notificationDTO->content = $user->name . ' adli istifadeci '.$event->amount.' azn balans artirdi. Zehmet olmasa yoxlayin';
        $notificationService->add($notificationDTO);
    }
}
