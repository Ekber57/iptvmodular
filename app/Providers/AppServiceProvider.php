<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Interfaces\OtpInterface;
use Modules\Otp\App\InternalApi\OtpAPI;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(OtpInterface::class,OtpAPI::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
