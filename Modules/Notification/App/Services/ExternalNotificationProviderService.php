<?php 
namespace Modules\Notification\App\Services;
use Modules\Notification\Enums\NotificationProviderModules;
use Modules\Notification\Models\ExternalNotificationProvider;

class ExternalNotificationProviderService {
    public function changeProvider($userId, NotificationProviderModules $notificationProviderModules) {
        $provider = ExternalNotificationProvider::where("user_id",$userId)->first();
        switch($notificationProviderModules) {
            case $notificationProviderModules::Whatsaap:
                $provider->provider_name = 'whatsapp';
                break;
                
            case $notificationProviderModules::Telegram:
                $provider->provider_name = 'telegram';
                break;
            case $notificationProviderModules::Sms:
                $provider->provider_name = 'sms';
                break;
            default:
                $provider->provider_name = 'email';
        }
        $provider->save();
    }

    public function createDefaultServiceProvider($userId) {
        ExternalNotificationProvider::create([
            'user_id' => $userId,
            'provider_name' => 'email'
        ]);
    }

    public function getDefaultServiceProvider($userId)  {
        return ExternalNotificationProvider::where('user_id',$userId)->first()->provider_name;
    }

}

?>