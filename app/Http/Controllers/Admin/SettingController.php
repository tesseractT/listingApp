<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Services\SettingsService;
use App\Models\Setting;
use Artisan;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:settings index');
    }
    function index(): View
    {
        return view('admin.setting.index');
    }

    function updateGeneralSetting(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'site_name' => ['required', 'string', 'max:255'],
            'site_email' => ['required', 'string', 'email', 'max:255'],
            'site_phone' => ['required', 'max:255'],
            'site_default_currency' => ['required', 'max:3'],
            'site_currency_icon' => ['required'],
            'site_currency_position' => ['required', 'in:left,right'],
            'site_timezone' => ['required', 'max:255'],
        ]);

        foreach ($validatedData as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        $settingsService = app()->make(SettingsService::class);
        $settingsService->clearCachedSettings();

        Artisan::call('config:cache');

        return back()->with('success', 'General settings updated successfully');
    }

    function updatePusherSetting(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'pusher_app_id' => ['required'],
            'pusher_app_key' => ['required'],
            'pusher_secret_key' => ['required'],
            'pusher_cluster' => ['required'],
        ]);

        foreach ($validatedData as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        $settingsService = app()->make(SettingsService::class);
        $settingsService->clearCachedSettings();

        Artisan::call('config:cache');

        return back()->with('success', 'Pusher settings updated successfully');
    }
}
