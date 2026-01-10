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
        $carts = Cart::content();
        $total = Cart::total();
        $subtotal = Cart::subtotal();

        return view('front.checkout.index', compact('carts', 'total', 'subtotal'));
    }


    public function addOrder(Request $request)
    {

        $data = $request->except('amount');

        if ($request->payment_type === Constant::PAYMENT_PAY_LATER) {
            $data['status'] = Constant::order_status_ReceiveOrders; // = 1
        } else {
            // online / stripe
            $data['status'] = Constant::order_status_Unconfirmed; // = 2
        }
                $order = $this->orderService->create($data);


        // 2) TẠO CHI TIẾT ĐƠN HÀNG (order_details)
        // ======================================================================
        $carts = Cart::content();

        foreach ($carts as $cart) {
            $data = [
                'order_id'   => $order->id,
                'product_id' => $cart->id,
                'qty'        => $cart->qty,
                'amount'     => $cart->price,
                'total'      => $cart->price * $cart->qty,
            ];

            $this->orderDetailService->create($data);
        }


        // 3) PAY LATER → xóa giỏ → chuyển trang result
        // ======================================================================
        if ($request->payment_type === 'pay_later') {

            //gui mail
            $total = Cart::total();
            $subtotal = Cart::subtotal();
            $this->sendEmail($order, $total, $subtotal);

            Cart::destroy();

            return redirect('checkout/result')
                ->with('notification', 'Success! You will pay on delivery. Please check your email.');
        }

        // 4) ONLINE PAYMENT
        // ======================================================================
        if ($request->payment_type === 'online_payment') {
            //01 lấy URL thanh toán VNPay
            $usdTotal = (float) Cart::total(0, '', '');
            $rate = 29262;
            $vndTotal = (int) round($usdTotal * $rate);
            $vnpAmount = $vndTotal * 100;

            $data_url = VNPay::vnpay_create_payment([
                'vnp_TxnRef' => $order->id,
                'vnp_OrderInfo' => 'Thanh toan don hang tai EShop',
                'vnp_Amount' => $vnpAmount,

            ]);

            //02 Chuyển hướng sang VNPay
            return redirect()->to($data_url);
        }
    }

    public function vnPayCheck(Request $request)
    {
        $vnp_ResponseCode = $request->get('vnp_ResponseCode');
        $orderId = $request->get('vnp_TxnRef');

        $order = $this->orderService->find($orderId);
        if (!$order) {
            return redirect('checkout/result')
                ->with('notification', 'Order not found.');
        }

        if ($vnp_ResponseCode === '00') {
            $order->status = Constant::order_status_Paid;
            $order->save();

            $total = Cart::total();
            $subtotal = Cart::subtotal();

            $this->sendEmail($order, $total, $subtotal);
            Cart::destroy();

            return redirect('checkout/result')
                ->with('notification', 'Payment Success! Has paid via VNPAY.');
        }
        $order->status = Constant::order_status_Cancel; // = 0
        $order->save();

        return redirect('checkout/result')
            ->with('notification', 'Payment Failed! Order is pending.');
    }


    public function result()
    {   
        $notification = session('notification');
        return view('front.checkout.result', compact('notification'));    
    }

    private function sendEmail($order, $total, $subtotal)
    {
        $email_to = $order->email;

        Mail::to($order->email)
            ->send(new OrderNotification(
                $order,
                $total,
                $subtotal
            ));
    }
}
