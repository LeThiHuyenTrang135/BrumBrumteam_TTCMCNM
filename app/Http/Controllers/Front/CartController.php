<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function index()
    {
        return view('front.shop.cart', [
            'carts'    => Cart::content(),
            'subtotal' => Cart::subtotal(2, '.', ''),
            'total'    => Cart::total(2, '.', ''),
        ]);
    }

public function add(Request $request)
{
    if (!$request->ajax()) {
        return response()->json(['status' => false], 400);
    }

    $product = Product::findOrFail($request->product_id);

    $cartItem = Cart::add([
        'id' => $product->id,
        'name' => $product->name,
        'qty' => (int) ($request->qty ?? 1),
        'price' => $product->discount ?? $product->price,
        'weight' => $product->weight ?? 0,
        'options' => [
            'images' => $product->productImages->first()->path ?? '',
            'size' => $request->size ?? '',
            'color' => $request->color ?? '',
        ],
    ]);

    $count = Cart::count();
    $subtotal = (float) Cart::subtotal(2, '.', '');
    $total = (float) Cart::total(2, '.', '');

    return response()->json([
        'status' => true,
        'message' => 'Đã thêm thành công!',

        // ✅ key chuẩn (dùng cho main.js)
        'count' => $count,
        'subtotal' => $subtotal,
        'total' => $total,
        'cart' => [
            'rowId' => $cartItem->rowId,
            'name' => $cartItem->name,
            'qty' => (int) $cartItem->qty,
            'price' => (float) $cartItem->price,
            'image' => $cartItem->options->images ?? '',
        ],

        // ✅ key tương thích code cũ trong master.blade.php
        'total_qty' => $count,
        'total_price' => number_format($total, 2, '.', ''),
        'cart_content' => Cart::content(),
    ]);
}

    public function update(Request $request)
    {
        Cart::update($request->rowId, (int)$request->qty);
        $cart = Cart::get($request->rowId);

        return response()->json([
            'status' => true,
            'cart' => [
                'rowId' => $cart->rowId,
                'qty' => $cart->qty,
                'price' => $cart->price,
                'lineTotal' => number_format($cart->price * $cart->qty, 2),
            ],
            'count' => Cart::count(),
            'subtotal' => Cart::subtotal(2, '.', ''),
            'total' => Cart::total(2, '.', ''),
        ]);
    }

    public function delete(Request $request)
    {
        Cart::remove($request->rowId);

        return response()->json([
            'status' => true,
            'count' => Cart::count(),
            'subtotal' => Cart::subtotal(2, '.', ''),
            'total' => Cart::total(2, '.', ''),
        ]);
    }

    public function destroy()
    {
        Cart::destroy();

        return response()->json([
            'status' => true,
            'count' => 0,
            'subtotal' => '0.00',
            'total' => '0.00',
        ]);
    }
}
