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
                        Xem chi tiết và quản lý đơn hàng.
                    </div>
                </div>
            </div>

            <div class="page-title-actions">
                <button type="button" class="btn-shadow btn-hover-shine mr-3 btn btn-primary disabled" disabled>
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="fa fa-plus fa-w-20"></i>
                    </span>
                    Tạo mới
                </button>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">

                <div class="card-header">
                    <form>
                        <div class="input-group">
                            <input type="search" name="search" id="search"
                                placeholder="Nhập họ tên hoặc email" class="form-control">
                            <span class="input-group-append">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-search"></i>&nbsp;
                                    Tìm kiếm
                                </button>
                            </span>
                        </div>
                    </form>
                </div>

                @if ($message = Session::get('notification'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ $message }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                <div class="table-responsive">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th>Tên khách hàng</th>
                                <th>Email</th>
                                <th class="text-center">Trạng thái</th>
                                <th class="text-center">Ngày tạo</th>
                                <th class="text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                            <tr>
                                <td class="text-center text-muted">#{{ $order->id }}</td>
                                <td>
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left flex2">
                                                <div class="widget-heading">{{ $order->first_name }} {{ $order->last_name }}</div>
                                                <div class="widget-subheading" style="color: #9db6c5;">
                                                    {{ $order->country }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $order->email }}</td>
                                <td class="text-center">
                                    <span class="badge {{ $order->statusLabelAttribute['badge'] }}">
                                        {{ $order->statusLabelAttribute['text'] }}
                                    </span>
                                </td>
                                <td class="text-center">{{ $order->created_at->format('d/m/Y') }}</td>
                                <td class="text-center">
                                    <a href="{{ route('order.show', $order->id) }}"
                                        class="btn btn-hover-shine btn-outline-primary border-0 btn-sm">
                                        Chi tiết
                                    </a>
                                    <form class="d-inline" action="{{ route('order.destroy', $order->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-hover-shine btn-outline-danger border-0 btn-sm"
                                            type="submit" data-toggle="tooltip" title="Xóa"
                                            data-placement="bottom"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?')">
                                            <span class="btn-icon-wrapper opacity-8">
                                                <i class="fa fa-trash fa-w-20"></i>
                                            </span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Không có đơn hàng nào</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-block card-footer">
                    <small class="m-0 text-muted">Tổng số đơn hàng: <strong>{{ count($orders) }}</strong></small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
