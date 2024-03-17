<?php

namespace App\Http\Controllers;

use App\Events\CreateOrder;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Session;
use App\Models\Package;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use Razorpay\Api\Api as RazorpayApi;

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

    /** Stripe Payment */

    function payWithStripe(): RedirectResponse
    {
        // Set your secret key. Remember to switch to your live secret key in production.
        $package = Package::findOrFail(Session::get('selected_package_id'));
        Stripe::setApiKey(config('payment.stripe_secret_key'));
        $totalPayableAmount = round(($this->payableAmount() * config('payment.stripe_currency_rate'))) * 100;

        $response = StripeSession::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => config('payment.stripe_currency'),
                        'product_data' => [
                            'name' => 'Payment for ' . config('app.name') . ' ' .  $package->name . ' ' . 'Subscription',
                        ],
                        'unit_amount' => $totalPayableAmount,
                    ],
                    'quantity' => 1,
                ]
            ],
            'mode' => 'payment',
            'success_url' => route('stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('stripe.cancel'),
        ]);

        return redirect()->away($response->url);
    }

    function stripeSuccess(Request $request): RedirectResponse
    {
        $sessionId = $request->session_id;

        //set your secret key
        Stripe::setApiKey(config('payment.stripe_secret_key'));

        $response = StripeSession::retrieve($sessionId);

        if ($response->payment_status === 'paid') {
            $paymentInfo = [
                'transaction_id' => $response->payment_intent,
                'payment_method' => 'Stripe',
                'paid_amount' => $response->amount_total / 100,
                'paid_currency' => $response->currency,
                'payment_status' => 'Completed'
            ];
            CreateOrder::dispatch($paymentInfo);
            return redirect()->route('payment.success');
        } else {
            return redirect()->route('payment.cancel');
        }
    }

    function stripeCancel(): RedirectResponse
    {
        return redirect()->route('payment.cancel');
    }

    /** Razorpay Payment */

    function razorPayRedirect(): View
    {

        $package = Package::findOrFail(Session::get('selected_package_id'));
        return view('frontend.pages.razorpay-redirect', compact('package'));
    }

    function payWithRazorpay(Request $request)
    {
        $api = new RazorpayApi(config('payment.razorpay_key'), config('payment.razorpay_secret_key'));

        if ($request->has('razorpay_payment_id') &&  $request->filled('razorpay_payment_id')) {
            $packageId = session()->get('selected_package_id');
            $package = Package::find($packageId);

            $totalPayableAmount = $package->price * config('payment.razorpay_currency_rate') * 100;

            try {
                $response = $api->payment
                    ->fetch($request->razorpay_payment_id)
                    ->capture(array('amount' => $totalPayableAmount));
            } catch (\Exception $e) {
                logger($e);
                return redirect()->route('payment.cancel')->withErrors(['error' => $e->getMessage()]);
            }

            if ($response->status === 'captured') {
                $paymentInfo = [
                    'transaction_id' => $response->id,
                    'payment_method' => 'Razorpay',
                    'paid_amount' => $response->amount / 100,
                    'paid_currency' => $response->currency,
                    'payment_status' => 'Completed'
                ];
                CreateOrder::dispatch($paymentInfo);
                return redirect()->route('payment.success');
            }
        }
    }
}
