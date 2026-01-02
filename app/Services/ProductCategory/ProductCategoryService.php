<?php

namespace App\Services\ProductCategory;

use App\Models\ProductCategory;

class ProductCategoryService implements ProductCategoryServiceInterface
{
    public function getAll()
    {
        return ProductCategory::all();
    }

    public function create(array $data)
    {
        return ProductCategory::create($data);
    }

    public function update(int $id, array $data)
    {
        $category = ProductCategory::findOrFail($id);
        $category->update($data);
        return $category;
    }

    public function delete(int $id)
    {
        $category = ProductCategory::findOrFail($id);
        $category->delete();
        return true;
    }

    public function find(int $id)
    {
        return ProductCategory::findOrFail($id);
    }
}
