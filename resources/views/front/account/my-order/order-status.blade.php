@php
    use App\Utilities\Constant;

    if (in_array($order->payment_type, [
        Constant::PAYMENT_ONLINE,
        Constant::PAYMENT_STRIPE
    ])) {
        // VNPay / Stripe
        $steps = [
            Constant::order_status_ReceiveOrders => ['label' => 'Đã đặt hàng', 'icon' => 'fa-shopping-cart'],
            Constant::order_status_Paid          => ['label' => 'Đã thanh toán', 'icon' => 'fa-credit-card'],
            Constant::order_status_Processing    => ['label' => 'Đang xử lý', 'icon' => 'fa-cogs'],
            Constant::order_status_Shipping      => ['label' => 'Đang giao', 'icon' => 'fa-truck fa-flip-horizontal'],
            Constant::order_status_Finish        => ['label' => 'Hoàn thành', 'icon' => 'fa-star'],
        ];
    } else {
        // Pay later (COD)
        $steps = [
            Constant::order_status_ReceiveOrders => ['label' => 'Đã đặt hàng', 'icon' => 'fa-shopping-cart'],
            Constant::order_status_Confirmed     => ['label' => 'Đã xác nhận', 'icon' => 'fa-check-circle'],
            Constant::order_status_Processing    => ['label' => 'Đang xử lý', 'icon' => 'fa-cogs'],
            Constant::order_status_Shipping      => ['label' => 'Đang giao', 'icon' => 'fa-truck fa-flip-horizontal'],
            Constant::order_status_Finish        => ['label' => 'Hoàn thành', 'icon' => 'fa-star'],
        ];
    }

    // TÍNH PROGRESS %
    $totalSteps = count($steps);
    $currentIndex = 0;
    $i = 0;
    foreach ($steps as $step => $data) {
        if ($order->status >= $step) {
            $currentIndex = $i;
        }
        $i++;
    }
    $stepWidth = 100 / $totalSteps;

    $progressPercent = ($currentIndex * $stepWidth) + ($stepWidth / 2);

    $progressPercent = min($progressPercent, 100);

@endphp

<div class="order-status-wrapper">
    <div class="order-status" style="--progress-width: {{ $progressPercent }}%;">
        @foreach ($steps as $step => $data)
            <div class="step {{ $order->status >= $step ? 'active' : '' }}">
                <div class="icon">
                    <i class="fa {{ $data['icon'] }}"></i>
                </div>
                <p>{{ $data['label'] }}</p>
            </div>
        @endforeach
    </div>
</div>
