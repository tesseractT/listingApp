<?php

namespace App\Providers;

use App\Services\SettingsService;
use Illuminate\Support\ServiceProvider;

class SettingsProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(SettingsService::class, function () {
            return new SettingsService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $settingService = $this->app->make(SettingsService::class);
        $settingService->setGlobalSettings();
    }
}
