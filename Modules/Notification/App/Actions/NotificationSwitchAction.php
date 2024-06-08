<?php 
namespace Modules\Notification\App\Actions;
use Illuminate\Support\Facades\Auth;
use Modules\Notification\App\Services\ExternalNotificationProviderService;
use Modules\Notification\App\Services\NotificationTypeService;
use Modules\Notification\Enums\NotificationProviderModules;

class NotificationSwitchAction {
    protected $notificationTypeService;
    protected $externalNotificationProviderService;
    public function __construct(NotificationTypeService $notificationTypeService,ExternalNotificationProviderService $externalNotificationProviderService) {
        $this->notificationTypeService = $notificationTypeService;
        $this->externalNotificationProviderService = $externalNotificationProviderService;
    }
    public function saveNotificationParametrs() {
        $default_provider = NotificationProviderModules::Email;
        switch(request()->default_provider) {
            case 'sms':
                $default_provider = NotificationProviderModules::Sms;
                break;
            
            case 'telegram':
                $default_provider = NotificationProviderModules::Telegram;
                break;
            
            case 'whatsapp':
                $default_provider = NotificationProviderModules::Whatsaap;
                break;
        }
        $this->externalNotificationProviderService->changeProvider(Auth::user()->id,$default_provider);
        $this->notificationTypeService->changeStatus(Auth::user()->id,request()->notification_ids);
    
    }
}
?>