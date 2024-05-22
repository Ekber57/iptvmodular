<?php

namespace Database\Seeders;

use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class Permissions extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(
            ['name' => 'create reseller'],

        );
        Permission::create(
            ['name' => 'create subreseller'],

        );
        Permission::create(
            ['name' => 'show all subresellers']
        );
        Permission::create(
            ['name' => 'create line']
        );
        $pass = Crypt::encrypt("admin123");
  
        $admin = User::create([
            "username" => "admin",
            "name" => "admin",
            "email" => "admin@brentvmail.com",
            "password" => $pass,
            "balance" => 1000000,
            "phone" => "055 000 00 00"
        ]);
        $admin->givePermissionTo("create reseller");
        $admin->givePermissionTo("create subreseller");
        $admin->givePermissionTo("create line");
    }
}
