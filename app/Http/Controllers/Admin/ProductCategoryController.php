<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ProductCategory\ProductCategoryServiceInterface;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    protected ProductCategoryServiceInterface $categoryService;

    public function __construct(ProductCategoryServiceInterface $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $categories = $this->categoryService->all();
        return view('admin.product_category.index', compact('categories'));
    }

    public function show(ProductCategory $productCategory)
    {
        return view('admin.product_category.show', compact('productCategory'));
    }

    public function create()
    {
        return view('admin.product_category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $data = $request->all();

        $category = $this->categoryService->create($data);

        return redirect('admin/product-category/' . $category->id)->with('notification', 'Danh mục đã được tạo thành công!');
    }

    public function edit(ProductCategory $productCategory)
    {
        return view('admin.product_category.edit', compact('productCategory'));
    }

    public function update(Request $request, ProductCategory $productCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $data = $request->all();

        $productCategory->update($data);

        return redirect('admin/product-category/' . $productCategory->id)->with('notification', 'Danh mục đã được cập nhật thành công!');
    }

    public function destroy(ProductCategory $productCategory)
    {
        $productCategory->delete();
        return redirect('admin/product-category')->with('notification', 'Danh mục đã được xóa thành công!');
    }
}
