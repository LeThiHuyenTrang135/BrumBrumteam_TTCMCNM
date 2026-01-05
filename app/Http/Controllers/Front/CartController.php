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
        $carts = Cart::content();
        $total = Cart::total();
        $subtotal = Cart::subtotal();

        return view('front.shop.cart', compact('carts', 'total', 'subtotal'));
    }

    public function add(Request $request)
    {
        if ($request->ajax()) {
            $product = Product::find($request->product_id);

            Cart::add([
                'id' => $product->id,
                'name' => $product->name,
                'qty' => $request->qty ?? 1,
                'price' => $product->discount ?? $product->price,
                'weight' => $product->weight ?? 0,
                'options' => [
                    'images' => $product->productImages->first()->path ?? '',
                    'size' => $request->size ?? '',
                    'color' => $request->color ?? '',
                ],
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Đã thêm thành công!',
                'total_qty' => Cart::count(),
                'total_price' => Cart::total(),
                'cart_content' => Cart::content(),
            ]);
        }
        return back();
    }

    public function delete(Request $request)
    {
        if ($request->ajax()) {
            Cart::remove($request->rowId);

            return response()->json([
                'status' => true,
                'message' => 'Xóa thành công!',
                'total' => Cart::total(),
                'subtotal' => Cart::subtotal(),
                'count' => Cart::count(),
            ]);
        }
        return back();
    }
    public function destroy()
    {
        Cart::destroy();
        return back();
    }

    public function update(Request $request)
    {
        if ($request->ajax()) {
            Cart::update($request->rowId, $request->qty);
            $cartItem = Cart::get($request->rowId);
            $itemSubtotal = $cartItem->price * $cartItem->qty;

            return response()->json([
                'status' => true,
                'itemSubtotal' => number_format($itemSubtotal, 2),
                'total' => Cart::total(),
                'subtotal' => Cart::subtotal(),
                'count' => Cart::count(),
            ]);
        }
    }
}