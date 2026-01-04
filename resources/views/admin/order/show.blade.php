@extends('admin.layout.master')

@section('body')
<!-- Main -->
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-note icon-gradient bg-happy-itmeo"></i>
                </div>
                <div>
                    Đơn hàng
                    <div class="page-title-subheading">
                        #{{ $order->id }} - {{ $order->first_name }} {{ $order->last_name }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
        <li class="nav-item delete">
            <form action="{{ route('admin.order.destroy', $order->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button class="nav-link btn" type="submit"
                    onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?')">
                    <span class="btn-icon-wrapper pr-2 opacity-8">
                        <i class="fa fa-trash fa-w-20"></i>
                    </span>
                    <span>Xóa</span>
                </button>
            </form>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.order.index') }}" class="nav-link">
                <span class="btn-icon-wrapper pr-2 opacity-8">
                    <i class="fa fa-arrow-left fa-w-20"></i>
                </span>
                <span>Quay lại</span>
            </a>
        </li>
    </ul>

    <div class="row">
        <div class="col-md-8">
            <div class="main-card mb-3 card">
                <div class="card-header">
                    Thông tin đơn hàng
                </div>
                <div class="card-body display_data">
                    <div class="position-relative row form-group">
                        <label class="col-md-4 text-md-right col-form-label">Mã đơn hàng</label>
                        <div class="col-md-8">
                            <p><strong>#{{ $order->id }}</strong></p>
                        </div>
                    </div>

                    <div class="position-relative row form-group">
                        <label class="col-md-4 text-md-right col-form-label">Trạng thái</label>
                        <div class="col-md-8">
                            <p>
                                <span class="badge {{ $order->statusLabelAttribute['badge'] }}">
                                    {{ $order->statusLabelAttribute['text'] }}
                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="position-relative row form-group">
                        <label class="col-md-4 text-md-right col-form-label">Tên khách hàng</label>
                        <div class="col-md-8">
                            <p>{{ $order->first_name }} {{ $order->last_name }}</p>
                        </div>
                    </div>

                    <div class="position-relative row form-group">
                        <label class="col-md-4 text-md-right col-form-label">Email</label>
                        <div class="col-md-8">
                            <p>{{ $order->email }}</p>
                        </div>
                    </div>

                    <div class="position-relative row form-group">
                        <label class="col-md-4 text-md-right col-form-label">Số điện thoại</label>
                        <div class="col-md-8">
                            <p>{{ $order->phone }}</p>
                        </div>
                    </div>

                    <div class="position-relative row form-group">
                        <label class="col-md-4 text-md-right col-form-label">Công ty</label>
                        <div class="col-md-8">
                            <p>{{ $order->company_name ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="position-relative row form-group">
                        <label class="col-md-4 text-md-right col-form-label">Quốc gia</label>
                        <div class="col-md-8">
                            <p>{{ $order->country }}</p>
                        </div>
                    </div>

                    <div class="position-relative row form-group">
                        <label class="col-md-4 text-md-right col-form-label">Địa chỉ</label>
                        <div class="col-md-8">
                            <p>{{ $order->street_address }}</p>
                        </div>
                    </div>

                    <div class="position-relative row form-group">
                        <label class="col-md-4 text-md-right col-form-label">Thành phố</label>
                        <div class="col-md-8">
                            <p>{{ $order->town_city }}</p>
                        </div>
                    </div>

                    <div class="position-relative row form-group">
                        <label class="col-md-4 text-md-right col-form-label">Mã bưu điện</label>
                        <div class="col-md-8">
                            <p>{{ $order->postcode_zip }}</p>
                        </div>
                    </div>

                    <div class="position-relative row form-group">
                        <label class="col-md-4 text-md-right col-form-label">Loại thanh toán</label>
                        <div class="col-md-8">
                            <p>{{ $order->payment_type }}</p>
                        </div>
                    </div>

                    <div class="position-relative row form-group">
                        <label class="col-md-4 text-md-right col-form-label">Ngày tạo</label>
                        <div class="col-md-8">
                            <p>{{ $order->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="position-relative row form-group">
                        <label class="col-md-4 text-md-right col-form-label">Cập nhật</label>
                        <div class="col-md-8">
                            <p>{{ $order->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="main-card mb-3 card">
                <div class="card-header">
                    Chi tiết sản phẩm
                </div>
                <div class="card-body">
                    @forelse($order->orderDetails as $detail)
                    <div class="mb-3 pb-3" style="border-bottom: 1px solid #f0f0f0;">
                        <div class="d-flex justify-content-between">
                            <strong>{{ $detail->product->name ?? 'Sản phẩm bị xóa' }}</strong>
                            <span class="text-muted">x{{ $detail->qty }}</span>
                        </div>
                        <div class="text-primary mt-2">
                            {{ number_format($detail->amount, 0, ',', '.') }}đ
                        </div>
                        <div class="text-success mt-1">
                            Tổng: {{ number_format($detail->total, 0, ',', '.') }}đ
                        </div>
                    </div>
                    @empty
                    <p class="text-muted">Không có sản phẩm nào</p>
                    @endforelse

                    @if($order->orderDetails->count() > 0)
                    <div class="pt-3" style="border-top: 2px solid #f0f0f0;">
                        <div class="d-flex justify-content-between">
                            <strong>Tổng cộng:</strong>
                            <strong class="text-success">
                                {{ number_format($order->orderDetails->sum('total'), 0, ',', '.') }}đ
                            </strong>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
