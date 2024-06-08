<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use ReflectionMethod;
use Illuminate\Database\Seeder;
use Database\Seeders\Perissions;
use Nwidart\Modules\Facades\Module;
use Illuminate\Support\Facades\Crypt;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $pass = Crypt::encrypt("admin123");
  
        $admin = User::create([
            "username" => "admin",
            "name" => "admin",
            "email" => "admin@brentvmail.com",
            "password" => $pass,
            "balance" => 1000000,
            "phone" => "055 000 00 00"
        ]);
        foreach (Module::all() as $module) {
            $moduleName = $module->getName();
            $seederClass = "Modules\\".$moduleName."\\Database\\Seeders\\".$moduleName."DatabaseSeeder";
            $reflector = new \ReflectionClass($seederClass);
            $instance = $reflector->newInstance();
            $instance->run();
        }
    }
}
