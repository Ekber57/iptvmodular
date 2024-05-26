<?php
namespace Modules\Iptv\Listeners;

use Illuminate\Support\Facades\Auth;
use Modules\Iptv\App\Services\ResellerService;
use Modules\Iptv\Events\LineCreatedEvent;
use Modules\Auth\App\Services\UserService;
use Modules\Notification\DTOS\NotificationDTO;
use Modules\Notification\App\Services\NotificationService;

class LineCreatedListener
{
    protected $notificationService;
    protected $resellerService;
    protected $userService;
    public function __construct(NotificationService $notificationService, UserService $userService, ResellerService $resellerService)
    {
        $this->notificationService = $notificationService;
        $this->resellerService = $resellerService;
        $this->userService = $userService;
    }
    public function handle(LineCreatedEvent $event)
    {
        $currentUser = Auth::user();
        if ($currentUser->id != 1) {

            $line = $event->line;
            $lineDetail = $this->userService->getUserById($line->user_id);
            $owner = $this->userService->getUserById($line->owner_id);
            $parent = $this->resellerService->getParent($line->owner_id);
            $parent = $this->userService->getUserById($parent);
            $content =  'Sizin referaliniz ' . $owner->name . ' yeni '.$lineDetail->name.' adli istifadeci yaratdi';
            $notificationDTO = new NotificationDTO();
            $notificationDTO->userId = $parent->id;
            $notificationDTO->content = $content;
            $notificationDTO->title = 'Istifadeci yaradildi';
            $this->notificationService->add($notificationDTO);
        }

    }
}



?>