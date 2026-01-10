<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\Order\OrderServiceInterface;
use App\Utilities\Constant;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Checkout\Session;


class StripeController extends Controller
{
    protected $orderService;

    public function __construct(OrderServiceInterface $orderService)
    {
        $this->orderService = $orderService;
    }

    public function checkout(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $order = $this->orderService->create([
            'user_id' => Auth::id(),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'company_name' => $request->company_name,
            'country' => $request->country,
            'street_address' => $request->street_address,
            'postcode_zip' => $request->postcode_zip,
            'town_city' => $request->town_city,
            'phone' => $request->phone,
            'email' => $request->email,
            'payment_type' => Constant::PAYMENT_STRIPE,
            'status' => Constant::order_status_Pending,
        ]);

        foreach (Cart::content() as $item) {
            $order->orderDetails()->create([
                'product_id' => $item->id,
                'qty' => $item->qty,
                'amount' => $item->price,
                'total' => $item->price * $item->qty,
            ]);
        }

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Order #' . $order->id,
                    ],
                    'unit_amount' => (int) (Cart::total(0, '', '') * 100),
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'metadata' => [
                'order_id' => $order->id,
            ],
            'success_url' => route('stripe.success', ['order_id' => $order->id]),
            'cancel_url'  => route('stripe.cancel',  ['order_id' => $order->id]),
        ]);

        return redirect()->away($session->url);
    }

    public function success()
    {
        Cart::destroy();

        return redirect('checkout/result')
            ->with('notification', 'Payment Success! Please wait for confirmation.');
    }

    public function cancel(Request $request)
    {
        $orderId = $request->get('order_id');

        if ($orderId) {
            $order = $this->orderService->find($orderId);
            if ($order && $order->status === Constant::order_status_Pending) {
                $order->status = Constant::order_status_Cancel;
                $order->save();
            }
        }

        return redirect('checkout/result')
            ->with('notification', 'Payment Failed! Order is canceled.');
    }
}
