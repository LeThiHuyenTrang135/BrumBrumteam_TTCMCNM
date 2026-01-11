<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('id', 'desc')->get();
        return view('admin.order.index', compact('orders'));
    }

public function confirm(Order $order)
{
    if ($order->status != 2) {
        return redirect()->back()
            ->with('error', 'Không thể xác nhận đơn hàng này!');
    }

    $order->update(['status' => 1]); 

    return redirect()->route('admin.order.index')
        ->with('notification', 'Đã xác nhận đơn hàng #' . $order->id);
}


    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.order.show', compact('order'));
    }

    public function destroy($id)
{
    $order = Order::findOrFail($id);

    $order->status = 4;
    $order->save();

    return redirect()->back()->with('notification', 'Đơn hàng đã được hủy.');
}

public function complete(Order $order)
{
    // Chỉ cho phép hoàn thành khi đơn đã giao
    if ($order->status != 3) {
        return redirect()->back()
            ->with('error', 'Chỉ đơn hàng đã giao mới được hoàn thành!');
    }

    $order->update([
        'status' => 7
    ]);

    return redirect()->route('admin.order.index')
        ->with('notification', 'Đơn hàng #' . $order->id . ' đã hoàn thành ✅');
}

public function delivered(Order $order)
{
    // Chỉ cho phép chuyển khi đang giao
    if ($order->status != 1) {
        return redirect()->back()
            ->with('error', 'Chỉ đơn hàng đang giao mới được chuyển sang đã giao!');
    }

    $order->update([
        'status' => 3   // Đã giao
    ]);

    return redirect()->route('admin.order.index')
        ->with('notification', 'Đơn hàng #' . $order->id . ' đã chuyển sang trạng thái ĐÃ GIAO ✅');
}



}
