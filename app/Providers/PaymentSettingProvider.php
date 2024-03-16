<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\PaymentSettingsService;

class PaymentSettingProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(PaymentSettingsService::class, function () {
            return new PaymentSettingsService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $paymentSettingService = $this->app->make(PaymentSettingsService::class);
        $paymentSettingService->setGlobalSettings();
    }
}
