<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Session;
use App\Models\Package;

class PaymentController extends Controller
{
    function payableAmount(): int
    {
        $packadeId = Session::get('selected_package_id');
        $package = Package::findOrFail($packadeId);
        return $package->price;
    }

    function setPaypalConfig(): array
    {
        return [
            'mode'    => config('payment.paypal_mode'), // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
            'sandbox' => [
                'client_id'         => config('payment.paypal_client_id'),
                'client_secret'     => config('payment.paypal_secret_key'),
                'app_id'            => 'APP-80W284485P519543T',
            ],
            'live' => [
                'client_id'         => config('payment.paypal_client_id'),
                'client_secret'     => config('payment.paypal_secret_key'),
                'app_id'            => config('payment.paypal_app_key'),
            ],

            'payment_action' => env('PAYPAL_PAYMENT_ACTION', 'Sale'), // Can only be 'Sale', 'Authorization' or 'Order'
            'currency'       => config('payment.paypal_currency'), // https://developer.paypal.com/docs/classic/api/currency_codes/
            'notify_url'     => env('PAYPAL_NOTIFY_URL', ''), // Change this accordingly for your application.
            'locale'         => env('PAYPAL_LOCALE', 'en_US'), // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
            'validate_ssl'   => env('PAYPAL_VALIDATE_SSL', true), // Validate SSL when creating api client.
        ];
    }
    function payWithPaypal()
    {
        $config = $this->setPaypalConfig();

        $provider = new PaypalClient($config);
        $provider->getAccessToken();

        $totalPayableAmount = round($this->payableAmount() * config('payment.paypal_currency_rate'));

        $response = $provider->createOrder([
            'intent' => 'CAPTURE',
            'application_context' => [
                'return_url' => route('paypal.success'),
                'cancel_url' => route('paypal.cancel'),
                'brand_name' => config('app.name'),
                'locale' => 'en-US',
            ],
            'purchase_units' => [
                [
                    'amount' => [
                        'value' => $totalPayableAmount,
                        'currency_code' => config('payment.paypal_currency'),
                    ],
                ],
            ],
        ]);
        if (isset($response['id']) && $response['id'] != '') {
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        } else {
            return redirect()->route('paypal.cancel')->with('error', 'Something went wrong');
        }
    }

    function paypalSuccess(Request $request)
    {
        $config = $this->setPaypalConfig();

        $provider = new PaypalClient($config);
        $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request->token);

        dd($response);
    }

    function paypalCancel()
    {
    }
}
