@extends('admin.layout.master')

@section('body')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-note icon-gradient bg-happy-itmeo"></i>
                    </div>
                    <div>
                        Đơn hàng
                        <div class="page-title-subheading">Xem chi tiết và quản lý đơn hàng.</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notification -->
        @if ($message = Session::get('notification'))
            <div class="alert alert-success">{{ $message }}</div>
        @endif

        <div class="main-card mb-3 card">
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
                                <td class="text-center">#{{ $order->id }}</td>
                                <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                                <td>{{ $order->email }}</td>

                                <td class="text-center">
                                    <span class="badge {{ $order->statusLabel['badge'] }}">
                                        {{ $order->statusLabel['text'] }}
                                    </span>
                                </td>

                                <td class="text-center">
                                    {{ $order->created_at->format('d/m/Y') }}
                                </td>



                                <td class="text-center">

                                    {{-- Xác nhận --}}
                                    @if ($order->status == 2)
                                        <form action="{{ route('admin.order.confirm', $order->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-success"
                                                onclick="return confirm('Xác nhận đơn hàng này?')">
                                                Xác nhận
                                            </button>
                                        </form>
                                    @endif

                                    {{-- Đã giao --}}
                                    @if ($order->status == 1)
                                        <form action="{{ route('admin.order.delivered', $order->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-info"
                                                onclick="return confirm('Xác nhận đơn hàng đã giao?')">
                                                Đã giao
                                            </button>
                                        </form>
                                    @endif

                                    {{-- Hoàn thành --}}
                                    @if ($order->status == 3)
                                        <form action="{{ route('admin.order.complete', $order->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-warning"
                                                onclick="return confirm('Xác nhận hoàn thành đơn hàng này?')">
                                                Hoàn thành
                                            </button>
                                        </form>
                                    @elseif ($order->status == 7)
                                        <button class="btn btn-sm btn-secondary" disabled>
                                            Đã hoàn thành
                                        </button>
                                    @endif




                                    {{-- Chi tiết --}}
                                    <a href="{{ route('admin.order.show', $order->id) }}" class="btn btn-sm btn-primary">
                                        Chi tiết
                                    </a>

                                    {{-- Hủy đơn --}}
                                    @if ($order->status != 4)
                                        <form action="{{ route('admin.order.destroy', $order->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-sm btn-danger"
                                                onclick="return confirm('Bạn có chắc chắn muốn hủy đơn này?')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    @else
                                        <button class="btn btn-sm btn-danger" disabled
                                            style="opacity: 0.4; cursor: not-allowed;">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    @endif

                                </td>


                                </td>




                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Không có đơn hàng</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
