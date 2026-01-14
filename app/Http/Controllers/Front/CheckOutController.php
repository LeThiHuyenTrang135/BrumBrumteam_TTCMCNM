<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\Order\OrderServiceInterface;
use App\Services\OrderDetail\OrderDetailServiceInterface;
use App\Utilities\Constant;
use App\Utilities\VNPay;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderNotification;
use App\Models\Product;

class CheckOutController extends Controller
{
    private $orderService;
    private $orderDetailService;

    public function __construct(
        OrderServiceInterface $orderService,
        OrderDetailServiceInterface $orderDetailService
    ) {
        $this->orderService = $orderService;
        $this->orderDetailService = $orderDetailService;
    }

    public function index()
    {
        return view('front.checkout.index', [
            'carts' => Cart::content(),
            'total' => Cart::total(),
            'subtotal' => Cart::subtotal(),
        ]);
    }

    // ======================================================
    // TẠO ĐƠN HÀNG
    // ======================================================
    public function addOrder(Request $request)
    {
        $data = $request->except('amount');

        /**
         * SET STATUS BAN ĐẦU (THEO LOGIC ĐÃ CHỐT)
         * pay_later  → 2 (Đang xác nhận)
         * vnpay/stripe → 0 (Đang chờ xử lý)
         */
        if ($request->payment_type === Constant::PAYMENT_PAY_LATER) {
            $data['status'] = 2;
        } else {
            $data['status'] = 0;
        }

        // 1️⃣ TẠO ORDER
        $order = $this->orderService->create($data);

        // 2️⃣ TẠO ORDER DETAILS
        foreach (Cart::content() as $cart) {
            $this->orderDetailService->create([
                'order_id'   => $order->id,
                'product_id' => $cart->id,
                'qty'        => $cart->qty,
                'amount'     => $cart->price,
                'total'      => $cart->price * $cart->qty,
            ]);
        }

        // ==================================================
        // PAY LATER → 2 → (admin xử lý tiếp)
        // ==================================================
        if ($request->payment_type === Constant::PAYMENT_PAY_LATER) {

            $this->sendEmail($order, Cart::total(), Cart::subtotal());
            $this->decreaseProductQty($order);
            Cart::destroy();

            return redirect('checkout/result')
                ->with('notification', 'Success! You will pay on delivery.');
        }

        // ==================================================
        // VNPAY
        // ==================================================
        if ($request->payment_type === Constant::PAYMENT_ONLINE) {

            $usdTotal = (float) Cart::total(0, '', '');
            $rate = 29262;
            $vndTotal = (int) round($usdTotal * $rate);

            $vnpUrl = VNPay::vnpay_create_payment([
                'vnp_TxnRef'    => $order->id,
                'vnp_OrderInfo'=> 'Thanh toan don hang tai EShop',
                'vnp_Amount'   => $vndTotal * 100,
            ]);

            return redirect()->to($vnpUrl);
        }

        return back()->with('notification', 'Invalid payment method.');
    }

    // ======================================================
    // VNPAY CALLBACK
    // ======================================================
    public function vnPayCheck(Request $request)
    {
        $orderId = $request->get('vnp_TxnRef');
        $responseCode = $request->get('vnp_ResponseCode');

        $order = $this->orderService->find($orderId);
        if (!$order) {
            return redirect('checkout/result')
                ->with('notification', 'Order not found.');
        }

        /**
         * THANH TOÁN THÀNH CÔNG
         * 0 → 1 (Đang giao)
         */
        if ($responseCode === '00') {

            $order->status = 1;
            $order->save();

            $this->sendEmail($order, Cart::total(), Cart::subtotal());
            $this->decreaseProductQty($order);
            Cart::destroy();

            return redirect('checkout/result')
                ->with('notification', 'Payment Success! Paid via VNPAY.');
        }

        /**
         * THANH TOÁN THẤT BẠI
         * 0 → 4 (Đã hủy)
         */
        $order->status = 4;
        $order->save();

        return redirect('checkout/result')
            ->with('notification', 'Payment Failed! Order has been cancelled.');
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

    public function result()
    {
        return view('front.checkout.result', [
            'notification' => session('notification')
        ]);
    }

    private function sendEmail($order, $total, $subtotal)
    {
        Mail::to($order->email)
            ->send(new OrderNotification($order, $total, $subtotal));
    }
}
