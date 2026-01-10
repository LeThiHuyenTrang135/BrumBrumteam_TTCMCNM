@extends('front.layout.master')

@section('title', 'Cart')

@section('body')

<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a href="./"><i class="fa fa-home"></i> Home</a>
                    <a href="./shop"><i class="fa fa-shop"></i> Shop</a>
                    <span>Shopping Cart</span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="shopping-cart spad">
    <div class="container">
        <div class="row">

        @if(Cart::count() > 0)
            <div class="col-lg-12">
                <div class="cart-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th class="p-name">Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>
                                    <i onclick="confirm('Are you sure to delete all carts') === true ? destroyCart() : ''" 
                                     style="cursor: pointer;" class="ti-close"></i>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carts as $cart)
                            <tr data-rowid="{{ $cart->rowId }}">
                                <td class="cart-pic first-row">
                                    <img class="product-big-img" src="{{ asset('storage/' . $cart->options->images) }}"
                                    alt="">
                                </td>
                                <td class="cart-title">
                                    <h5>{{ $cart->name }}</h5>
                                </td>
                                <td class="p-price first-row">${{ number_format($cart->price, 2) }}</td>
                                <td class="qua-col first-row">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input type="text" value="{{ $cart->qty }}" data-rowid="{{ $cart->rowId }}">
                                        </div>
                                    </div>
                                </td>
                                <td class="total-price first-row">${{ number_format($cart->price * $cart->qty, 2) }}</td>
                                <td class="close-td first-row">
                                    <i onclick="removeCart('{{ $cart->rowId }}')" class="ti-close" style="cursor: pointer;"></i>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="cart-buttons">

                        </div>
                        <div class="discount-coupon">

                        </div>
                    </div>
                    <div class="col-lg-4 offset-lg-4">
                        <div class="proceed-checkout">
                            <ul>
                                <li class="subtotal">Subtotal <span>${{ $subtotal }}</span></li>
                                <li class="cart-total">Total <span>${{ $total }}</span></li>
                            </ul>
                            <a href="./checkout" class="proceed-btn">PROCEED TO CHECK OUT</a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="col-lg-12">
                <div class="text-center">
                    <img src="front/img/cart-empty.png" alt="" style="height: 200px;">
                    <h4 class="mt-4">Giỏ hàng trống!</h4>
                    <a href="./shop" class="primary-btn mt-3">Mua sắm ngay</a>
                </div>
            </div>
        @endif

        </div>
    </div>
</div>
<!-- <script>
    // 1. Hàm xóa sản phẩm
    function removeCart(rowId) {
        if (confirm('Bạn có chắc muốn xóa sản phẩm này?')) {
            $.ajax({
                type: "GET",
                url: "{{ route('cart.delete') }}",
                data: { rowId: rowId },
                success: function (response) {
                    location.reload();
                },
                error: function (response) {
                    alert('Xóa thất bại! Vui lòng thử lại.');
                    console.log(response);
                }
            });
        }
    }

    // $(document).off('click', '.qtybtn');

    function destroyCart() {
        if (confirm('Bạn có chắc muốn xóa toàn bộ giỏ hàng?')) {
            location.href = "{{ route('cart.destroy') }}";
        }
    }

    $(document).on('click', '.qtybtn', function () {
        var $button = $(this);
        var $input = $button.parent().find('input');
        var rowId = $input.attr('data-rowId');
        var currentVal = parseFloat($input.val());
        var newVal = currentVal;
        if ($button.hasClass('inc')) {
            newVal = currentVal + 1;
        } else {
            if (currentVal > 1) {
                newVal = currentVal - 1;
            } else {
                newVal = 1;
            }
        }

        $input.val(newVal);

        $.ajax({
            type: "GET",
            url: "{{ route('cart.update') }}",
            data: { 
                rowId: rowId, 
                qty: newVal 
            },
            success: function (response) {
                if (response.status) {
                    $('tr[data-rowId="' + rowId + '"] .total-price').text('$' + response.itemSubtotal);
                    $('.subtotal span').text('$' + response.subtotal);
                    $('.cart-total span').text('$' + response.total);
                    $('#cart-count').text(response.count);
                    $('#cart-total').text('$' + response.total);
                }
            },
            error: function (response) {
                alert('Có lỗi xảy ra khi cập nhật!');
                console.log(response);
            }
        });
    });
</script> -->

@endsection