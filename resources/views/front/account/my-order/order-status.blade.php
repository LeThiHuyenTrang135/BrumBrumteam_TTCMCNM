@php
    use App\Utilities\Constant;

    $status = (int) $order->status;
    $paymentType = $order->payment_type;

    // ❌ ĐÃ HỦY → không hiển thị progress
    if ($status === Constant::order_status_Cancel) {
        $steps = [];
        $progressPercent = 0;
    } else {

        // =========================
        // VNPAY / STRIPE
        // =========================
        if (in_array($paymentType, [
            Constant::PAYMENT_ONLINE,
            Constant::PAYMENT_STRIPE
        ])) {
            $steps = [
                Constant::order_status_Pending => [
                    'label' => 'Chờ thanh toán',
                    'icon'  => 'fa-credit-card'
                ],
                Constant::order_status_Paid => [
                    'label' => 'Đang giao',
                    'icon'  => 'fa-truck fa-flip-horizontal'
                ],
                Constant::order_status_Shipped => [
                    'label' => 'Đã giao',
                    'icon'  => 'fa-check-circle'
                ],
                Constant::order_status_Completed => [
                    'label' => 'Hoàn thành',
                    'icon'  => 'fa-star'
                ],
            ];
        }
        // =========================
        // PAY LATER
        // =========================
        else {
            $steps = [
                Constant::order_status_Confirming => [
                    'label' => 'Đang xác nhận',
                    'icon'  => 'fa-check-circle'
                ],
                Constant::order_status_Paid => [
                    'label' => 'Đang giao',
                    'icon'  => 'fa-truck fa-flip-horizontal'
                ],
                Constant::order_status_Shipped => [
                    'label' => 'Đã giao',
                    'icon'  => 'fa-check-circle'
                ],
                Constant::order_status_Completed => [
                    'label' => 'Hoàn thành',
                    'icon'  => 'fa-star'
                ],
            ];
        }

        // =========================
        // TÍNH PROGRESS %
        // =========================
 $totalSteps = count($steps);
$currentIndex = 0;

/*
|--------------------------------------------------------------------------
| XÁC ĐỊNH currentIndex
|--------------------------------------------------------------------------
*/
if (in_array($paymentType, [
    Constant::PAYMENT_ONLINE,
    Constant::PAYMENT_STRIPE
])) {
    // Flow tăng: 0 → 1 → 3 → 7
    $i = 0;
    foreach (array_keys($steps) as $stepStatus) {
        if ($status >= $stepStatus) {
            $currentIndex = $i;
        }
        $i++;
    }
} else {
    // Flow không tăng: 2 → 1 → 3 → 7
    $keys = array_keys($steps);
    $currentIndex = array_search($status, $keys);
    if ($currentIndex === false) {
        $currentIndex = 0;
    }
}

/*
|--------------------------------------------------------------------------
| TÍNH % ĐƯỜNG XANH (FIX TRIỆT ĐỂ)
|--------------------------------------------------------------------------
*/
if ($totalSteps <= 1) {
    $progressPercent = 0;
} else {
    $stepGap = 105 / ($totalSteps - 1);

    // Luôn chạm đúng tâm icon hiện tại
    $progressPercent = $currentIndex * $stepGap;

    // Fix: bước đầu vẫn phải có 1 đoạn xanh nhỏ
    if ($currentIndex === 0) {
        $progressPercent = $stepGap * 0.2;
    }

    // Fix: không vượt icon cuối
    $progressPercent = min($progressPercent, 100);
}

    }
@endphp

{{-- ========================= --}}
{{-- HIỂN THỊ --}}
{{-- ========================= --}}
@if ($status === Constant::order_status_Cancel)
    <div class="alert alert-danger text-center">
        <i class="fa fa-times-circle"></i> Đơn hàng đã bị hủy
    </div>
@else
    <div class="order-status-wrapper">
        <div class="order-status" style="--progress-width: {{ $progressPercent }}%;">
@foreach ($steps as $index => $data)
    @php
        $isActive = array_search($index, array_keys($steps)) <= $currentIndex;
    @endphp

    <div class="step {{ $isActive ? 'active' : '' }}">
        <div class="icon">
            <i class="fa {{ $data['icon'] }}"></i>
        </div>
        <p>{{ $data['label'] }}</p>
    </div>
@endforeach

        </div>
    </div>
@endif
