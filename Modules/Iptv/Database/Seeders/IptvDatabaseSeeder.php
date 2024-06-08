<?php

namespace Modules\Iptv\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Modules\Iptv\App\Actions\NotificationAction;
use Modules\Notification\App\Services\NotificationTypeService;
use Spatie\Permission\Models\Permission;

class IptvDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(
            ['name' => 'iptv create reseller'],

        );
        Permission::create(
            ['name' => 'iptv create subreseller'],

        );
        Permission::create(
            ['name' => 'iptv show all subresellers']
        );
        Permission::create(
            ['name' => 'iptv line']
        );
        Permission::create(
            ['name' => 'iptv create line']
        );

        $admin = User::find(1);
        $admin->givePermissionTo("iptv create reseller");
        $admin->givePermissionTo("iptv create subreseller");
        $admin->givePermissionTo("iptv create line");
        $admin->givePermissionTo("iptv line");
        $s = (new NotificationTypeService());
        $notificationAction = new NotificationAction($s);
        $notificationAction->createNotifications($admin);

    }
}
