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
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderNotification;
use App\Models\Product;


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

    public function success(Request $request)
    {
        // 1. Lấy Order ID từ URL
        $orderId = $request->get('order_id');
        $order = $this->orderService->find($orderId);

        // Kiểm tra nếu đơn hàng tồn tại và chưa được xử lý (tránh F5 trừ kho 2 lần)
        if ($order && $order->status == Constant::order_status_Pending) {

            // 2. Cập nhật trạng thái -> Đã thanh toán/Đang giao (1)
            $order->status = Constant::order_status_Paid;
            $order->save();

            $this->sendEmail($order, Cart::total(), Cart::subtotal());
            $this->decreaseProductQty($order);

            Cart::destroy();

            return redirect('checkout/result')
                ->with('notification', 'Payment Success via Stripe! Thank you for your order.');
        }

        return redirect('checkout/result')
            ->with('notification', 'Payment processed or Invalid Order.');
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

    private function decreaseProductQty($order)
    {
        foreach ($order->orderDetails as $detail) {
            $product = Product::find($detail->product_id);
            if ($product) {
                $product->qty -= $detail->qty;
                $product->save();
            }
        }
    }

    private function sendEmail($order, $total, $subtotal)
    {
        Mail::to($order->email)
            ->send(new OrderNotification($order, $total, $subtotal));
    }
}
