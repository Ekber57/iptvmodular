<?php 
namespace Modules\Notification\App\Services;
use Modules\Notification\Models\ExternalNotificationServiceBalance;
class ExternalNotificationServiceBalanceService  {
    public function createEmptyNotificationServiceBalances($userId) {
        ExternalNotificationServiceBalance::insert([
            [
                'user_id' => $userId,
                'service_name' => 'sms',
                'balance' => 0,
                'status' => 1,
            ],
            [
                'user_id' => $userId,
                'service_name' => 'telegram',
                'balance' => 0,
                'status' => 1,
            ],
            [
                'user_id' => $userId,
                'service_name' => 'whatsapp',
                'balance' => 0,
                'status' => 1,
            ],

        ]);
    }

    public function getProviderBalance($userId,$provider) {
        return ExternalNotificationServiceBalance::where([ 
            'user_id' => $userId,
            'service_name' => $provider
        ])->first()->balance;
    }
}
?>