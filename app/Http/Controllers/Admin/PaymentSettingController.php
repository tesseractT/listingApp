<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\PaymentSetting;
use App\Services\PaymentSettingsService;

class PaymentSettingController extends Controller
{
    function index()
    {
        return view('admin.payment-setting.index');
    }

    function paypalSetting(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'paypal_status' => ['required', 'in:active,inactive'],
            'paypal_mode' => ['required', 'in:sandbox,live'],
            'paypal_country' => ['required', 'string'],
            'paypal_currency' => ['required', 'string'],
            'paypal_currency_rate' => ['required', 'numeric'],
            'paypal_client_id' => ['required', 'string'],
            'paypal_secret_key' => ['required', 'string'],
            'paypal_app_key' => ['required', 'string'],
        ]);

        foreach ($validatedData as $key => $value) {

            PaymentSetting::updateOrCreate([
                'key' => $key,
                'value' => $value,
            ]);
        }

        $paymentSettingService = app()->make(PaymentSettingsService::class);
        $paymentSettingService->clearCachedSettings();

        return redirect()->back()->with('success', 'Paypal setting updated successfully');
    }
}
