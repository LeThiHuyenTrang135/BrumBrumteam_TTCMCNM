<?php

namespace App\Services\Order;

interface OrderServiceInterface
{
    public function getAll();
    public function find(int $id);
    public function delete(int $id);
    public function updateStatus(int $id, int $status);
    public function getOrderByUserId($userId);
}
