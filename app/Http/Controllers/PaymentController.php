<?php

namespace App\Http\Controllers;

use App\Events\CreateOrder;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Session;
use App\Models\Package;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PaymentController extends Controller
{
    function paymentSuccess(): View
    {
        return view('frontend.pages.payment-success');
    }

    function paymentCancel(): View
    {
        return view('frontend.pages.payment-cancel');
    }
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
            logger($response);
            return redirect()->route('payment.cancel')->withErrors(['error' => $response['error']['message']]);
        }
    }

    function paypalSuccess(Request $request): RedirectResponse
    {
        $config = $this->setPaypalConfig();

        $provider = new PaypalClient($config);
        $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request->token);


        if (isset($response['status']) && $response['status'] === 'COMPLETED') {
            $capture = $response['purchase_units'][0]['payments']['captures'][0];
            $paymentInfo = [
                'transaction_id' => $capture['id'],
                'payment_method' => 'Paypal',
                'paid_amount' => $capture['amount']['value'],
                'paid_currency' => $capture['amount']['currency_code'],
                'payment_status' => 'Completed'
            ];
            CreateOrder::dispatch($paymentInfo);
        }
        return redirect()->route('payment.success');
    }

    function paypalCancel(): RedirectResponse
    {
        return redirect()->route('payment.cancel');
    }
}
