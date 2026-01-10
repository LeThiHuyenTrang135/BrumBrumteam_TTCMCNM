<?php

namespace App\Services\Order;
use App\Repositories\Order\OrderRepositoryInterface;

use App\Models\Order;

class OrderService implements OrderServiceInterface
{
    public $repository;
    public function __construct(OrderRepositoryInterface $OrderRepository)
    {
        $this->repository = $OrderRepository;
    }
    public function getAll()
    {
        return Order::with('user', 'orderDetails')->latest()->get();
    }
    public function create(array $data)
{
    return Order::create($data);
}

    public function find(int $id)
    {
        return Order::with('user', 'orderDetails.product')->findOrFail($id);
    }

    public function delete(int $id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return true;
    }

    public function updateStatus(int $id, int $status)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => $status]);
        return $order;
    }

    public function getOrderByUserId($userId)
    {
        return $this->repository->getOrderByUserId($userId);
    }
}
