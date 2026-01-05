@extends('front.layout.master')

@section('title', 'My Order')

@section('body')

<!-- Breadcrumb section begin-->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a href="/"><i class="fa fa-home"></i> Home</a>
                    <span>My Order</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb section end-->

<!-- My Order section begin -->
<section class="shopping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <div class="cart-table">
                    <table>
                        <thead>
                            <tr>
                                <th>IMAGE</th>
                                <th>ID</th>
                                <th>PRODUCTS</th>
                                <th>TOTAL</th>
                                <th>DETAILS</th>
                            </tr>
                        </thead>

                        <tbody>

                            {{-- 🔥 Nếu chưa đăng nhập --}}
                            @guest
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    <h5 style="color:red;">Bạn phải đăng nhập để xem đơn hàng</h5>
                                    <a href="./account/login" class="btn btn-primary mt-3">
                                        Đăng nhập
                                    </a>
                                </td>
                            </tr>
                            @endguest

                            {{-- 🔥 Nếu đã đăng nhập --}}
                            @auth

                            {{-- Nếu không có đơn hàng --}}
                            @if ($orders->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    Bạn chưa có đơn hàng nào.
                                </td>
                            </tr>

                            {{-- Nếu có đơn hàng --}}
                            @else
                            @foreach ($orders as $order)

                            @php
                            $detail = $order->orderDetails->first();
                            $image = $detail && $detail->product && $detail->product->productImages->first()
                                    ? $detail->product->productImages->first()
                                    : null;

                            $total = $order->orderDetails->sum('total');
                            @endphp

                            <tr>
                                <td class="cart-pic first-row">
                                    <img style="height: 100px; padding-left: 70px;"
                                        src="{{ $image ? asset('front/img/products/' . $image->path) : asset('front/img/no-image.png') }}"
                                        alt="">
                                </td>

                                <td class="first-row">{{ $order->id }}</td>

                                <td class="cart-title first-row" style="padding-left: 180px;">
                                    <h5>
                                        {{ $detail ? $detail->product->name : 'No product' }}

                                        @if ($order->orderDetails->count() > 1)
                                        (and {{ $order->orderDetails->count() - 1 }} other products)
                                        @endif
                                    </h5>
                                </td>

                                <td class="total-price first-row">${{ number_format($total, 2) }}</td>

                                <td class="first-row">
                                    <a href="/account/my-order/{{ $order->id }}" class="btn">
                                        Details
                                    </a>
                                </td>
                            </tr>

                            @endforeach
                            @endif

                            @endauth

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- My Order section end -->

@endsection