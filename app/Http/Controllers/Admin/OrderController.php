<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\Order\OrderServiceInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected OrderServiceInterface $orderService;

    public function __construct(OrderServiceInterface $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    {
        $orders = $this->orderService->getAll();
        return view('admin.order.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order = $this->orderService->find($order->id);
        return view('admin.order.show', compact('order'));
    }

    public function destroy(Order $order)
    {
        $this->orderService->delete($order->id);
        return redirect('admin/order')->with('notification', 'Đơn hàng đã được xóa thành công!');
    }
}
