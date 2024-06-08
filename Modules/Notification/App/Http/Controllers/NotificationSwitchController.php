<?php 
namespace Modules\Notification\App\Http\Controllers;

use App\Mail\SendMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Modules\Notification\App\Actions\NotificationSwitchAction;
use Modules\Notification\App\Providers\NotificationServiceProvider;
use Modules\Notification\App\Services\ExternalNotificationProviderService;
use Modules\Notification\App\Services\NotificationTypeService;

class NotificationSwitchController {
    public function showNotifications(NotificationTypeService $notificationTypeService,ExternalNotificationProviderService $externalNotificationProviderService) {
        // try {
        //     //code...
        //     Mail::to("ekberquliyev57@gmail.com")->send(new SendMail());
        // } catch (\Throwable $th) {
        //     throw $th;
        // }
        $defaultProvider = $externalNotificationProviderService->getDefaultServiceProvider(Auth::user()->id);
        return view('notification::notification_switch',[
            'notifications' => $notificationTypeService->getNotificationParametrs(Auth::user()),
            'defaultProvider' => $defaultProvider
        ]); 
    }
    public function saveNotificationParametrs(NotificationSwitchAction $notificationSwitchAction) {
        $notificationSwitchAction->saveNotificationParametrs();
        return redirect()->route('showNotificationSettings');
    }


}


?>