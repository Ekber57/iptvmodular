<?php

namespace Modules\Notification\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Modules\Notification\App\Services\ExternalNotificationProviderService;
use Modules\Notification\App\Services\ExternalNotificationServiceBalanceService;

class NotificationDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $externalNotificationServiceBalanceService = new ExternalNotificationServiceBalanceService();
        $externalNotificationProviderService = new ExternalNotificationProviderService();
        $externalNotificationServiceBalanceService->createEmptyNotificationServiceBalances(1);
        $externalNotificationProviderService->createDefaultServiceProvider(1);
    }
}
