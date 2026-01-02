<?php

namespace App\Services\Product;

use App\Models\Product;

class ProductService implements ProductServiceInterface
{
    public function getAll()
    {
        return Product::all();
    }

    public function create(array $data)
    {
        return Product::create($data);
    }

    public function update(int $id, array $data)
    {
        $product = Product::findOrFail($id);
        $product->update($data);
        return $product;
    }

    public function delete(int $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return true;
    }

    public function find(int $id)
    {
        return Product::findOrFail($id);
    }
}
