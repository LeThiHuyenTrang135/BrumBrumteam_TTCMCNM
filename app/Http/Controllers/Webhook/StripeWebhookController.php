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

        // 1) Verify chữ ký Stripe
        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $endpointSecret);

            Log::info('Stripe webhook verified', [
                'type' => $event->type
            ]);
        } catch (\UnexpectedValueException $e) {
            Log::error('Stripe webhook invalid payload', [
                'error' => $e->getMessage()
            ]);
            return response('Invalid payload', 400);
        } catch (SignatureVerificationException $e) {
            Log::error('Stripe webhook invalid signature', [
                'error' => $e->getMessage()
            ]);
            return response('Invalid signature', 400);
        }

        // 2) Xử lý event
        if ($event->type === 'checkout.session.completed') {

            $session = $event->data->object;

            Log::info('Stripe checkout.session.completed', [
                'session_id' => $session->id,
                'metadata' => $session->metadata ?? null,
            ]);

            $orderId = $session->metadata->order_id ?? null;

            if ($orderId) {
                $order = $this->orderService->find($orderId);

                // ✅ Chỉ set PAID khi đang PENDING (0 → 1)
                if ($order && (int)$order->status === Constant::order_status_Pending) {
                    Log::info('Order found - mark PAID', [
                        'order_id' => $orderId,
                        'old_status' => $order->status
                    ]);

                    $order->status = Constant::order_status_Paid; // = 1
                    $order->save();
                }
            }

        } elseif ($event->type === 'payment_intent.payment_failed') {

            $intent = $event->data->object;

            Log::warning('Stripe payment failed', [
                'intent_id' => $intent->id,
                'metadata' => $intent->metadata ?? null,
            ]);

            $orderId = $intent->metadata->order_id ?? null;

            if ($orderId) {
                $order = $this->orderService->find($orderId);

                // ✅ Chỉ cancel khi đang PENDING (0 → 4)
                if ($order && (int)$order->status === Constant::order_status_Pending) {
                    $order->status = Constant::order_status_Cancel; // = 4
                    $order->save();
                }
            }

        } elseif ($event->type === 'checkout.session.expired') {

            $session = $event->data->object;

            Log::warning('Stripe session expired', [
                'session_id' => $session->id,
                'metadata' => $session->metadata ?? null,
            ]);

            $orderId = $session->metadata->order_id ?? null;

            if ($orderId) {
                $order = $this->orderService->find($orderId);

                // ✅ Chỉ cancel khi đang PENDING (0 → 4)
                if ($order && (int)$order->status === Constant::order_status_Pending) {
                    $order->status = Constant::order_status_Cancel; // = 4
                    $order->save();
                }
            }
        }

        // 3) Trả về 200 cho Stripe
        return response('Webhook handled', 200);
    }
}
