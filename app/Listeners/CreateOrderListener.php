<?php

namespace App\Listeners;

use App\Events\CreateOrder;
use App\Models\Order;
use App\Models\Package;
use App\Models\Subscription;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class CreateOrderListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CreateOrder $event): void
    {
        $package = Package::find(Session::get('selected_package_id'));
        $order = new Order();
        $order->order_id = uniqid();
        $order->transaction_id = $event->paymentInfo['transaction_id'];
        $order->user_id = auth()->user()->id;
        $order->package_id = $package->id;
        $order->payment_method = $event->paymentInfo['payment_method'];
        $order->payment_status = $event->paymentInfo['payment_status'];
        $order->base_amount = $package->price;
        $order->base_currency = config('settings.site_default_currency');
        $order->paid_amount = $event->paymentInfo['paid_amount'];
        $order->paid_currency = $event->paymentInfo['paid_currency'];
        $order->payment_date = now();
        $order->save();


        Subscription::updateOrCreate(
            [
                'user_id' => auth()->user()->id,
            ],
            [
                'package_id' => $order->package_id,
                'order_id' => $order->id,
                'purchase_date' => $order->payment_date,
                'expiry_date' => $package->num_of_days == -1 ? null : Carbon::parse($order->payment_date)->addDays($package->num_of_days),
                'status' => 1,
            ]

        );

        Session::forget('selected_package_id');
    }
}
