<?php
namespace App\Http\Controllers\Webhook;


use App\Http\Controllers\Controller;
use App\Services\Order\OrderServiceInterface;
use App\Utilities\Constant;
use Illuminate\Http\Request;
use Stripe\Webhook;
use Stripe\Exception\SignatureVerificationException;
use Illuminate\Support\Facades\Log;


class StripeWebhookController extends Controller
{
    protected $orderService;

    public function __construct(OrderServiceInterface $orderService)
    {
        $this->orderService = $orderService;
    }

    public function handle(Request $request)
    {
           Log::info('Stripe webhook HIT', [
        'headers' => $request->headers->all(),
        'payload' => $request->getContent(),
    ]);

        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $endpointSecret = config('services.stripe.webhook_secret');

        // 1️⃣ Verify chữ ký Stripe
        try {
            $event = Webhook::constructEvent(
                $payload,
                $sigHeader,
                $endpointSecret
            );
                Log::info('Stripe webhook verified', [
        'type' => $event->type
    ]);


        } catch (\UnexpectedValueException $e) {
                Log::error('Stripe webhook invalid payload', [
        'error' => $e->getMessage()
    ]);

            // Payload không hợp lệ
            return response('Invalid payload', 400);
        } catch (SignatureVerificationException $e) {
               Log::error('Stripe webhook invalid signature', [
        'error' => $e->getMessage()
    ]);

            // Sai chữ ký
            return response('Invalid signature', 400);
        }

        // 2️⃣ Xử lý event thanh toán thành công
        if ($event->type === 'checkout.session.completed') {
            $session = $event->data->object;

                Log::info('Stripe checkout.session.completed', [
        'session_id' => $session->id,
        'metadata' => $session->metadata ?? null,
    ]);

            $orderId = $session->metadata->order_id ?? null;

            if ($orderId) {
                $order = $this->orderService->find($orderId);
                

                if ($order && $order->status !== Constant::order_status_Paid) {
                          Log::info('Order found - mark PAID', [
                'order_id' => $orderId,
                'old_status' => $order->status
            ]);
                    $order->status = Constant::order_status_Paid;
                    $order->save();
                }
            }
            Log::info('Stripe webhook called', ['type' => $event->type]);

        }
        if ($event->type === 'payment_intent.payment_failed') {

            $intent = $event->data->object;
            $orderId = $intent->metadata->order_id ?? null;
                Log::warning('Stripe payment failed', [
        'intent_id' => $intent->id,
        'metadata' => $intent->metadata ?? null,
    ]);

            if ($orderId) {
                $order = $this->orderService->find($orderId);

            if ($order && $order->status !== Constant::order_status_Paid) { //4
                $order->status = Constant::order_status_Cancel;
                $order->save();
            }

            }
        }
        if ($event->type === 'checkout.session.expired') {

            $session = $event->data->object;

                Log::warning('Stripe session expired', [
        'session_id' => $session->id,
        'metadata' => $session->metadata ?? null,
    ]);

    
            $orderId = $session->metadata->order_id ?? null;

            if ($orderId) {
                $order = $this->orderService->find($orderId);
            if ($order && $order->status !== Constant::order_status_Paid) {
                $order->status = Constant::order_status_Cancel;
                $order->save();
            }

            }
        }


        // 3️⃣ Trả về 200 cho Stripe
        return response('Webhook handled', 200);
    }
}
