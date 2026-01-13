<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'brand']);
        
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        $products = $query->latest()->get();
        
        return view('admin.product.index', compact('products'));
    }

    public function show(Product $product)
    {
        $product->load(['category', 'images']);
        return view('admin.product.show', compact('product'));
    }

    public function create()
    {
        $categories = ProductCategory::all();
        return view('admin.product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'qty' => 'required|integer|min:0',
            'weight' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'product_category_id' => 'required|exists:product_categories,id',
            'featured' => 'nullable|boolean',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'images.*.required' => 'Vui lòng chọn ít nhất 1 ảnh sản phẩm',
            'images.*.image' => 'File phải là ảnh',
            'images.*.mimes' => 'Ảnh phải có định dạng: jpeg, png, jpg, gif',
            'images.*.max' => 'Kích thước ảnh không được vượt quá 2MB'
        ]);

        try {
            DB::beginTransaction();

            $data = $request->only([
                'name', 'price', 'qty', 'weight', 'description', 
                'content', 'product_category_id', 'featured'
            ]);
            
            $data['sku'] = null;
            $data['discount'] = null;
            $data['tag'] = null;
            $data['brand_id'] = null;
            $data['featured'] = $request->has('featured') ? 1 : 0;

            $product = Product::create($data);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $filename = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();
                    $path = $image->store('products', 'public');

                    ProductImage::create([
                        'product_id' => $product->id,
                        'path' => $path
]);

                }
            }

            DB::commit();

            return redirect()->route('admin.product.show', $product->id)
                ->with('notification', 'Sản phẩm đã được tạo thành công!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function edit(Product $product)
    {
        $product->load('images');
        $categories = ProductCategory::all();
        return view('admin.product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'qty' => 'required|integer|min:0',
            'weight' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'product_category_id' => 'required|exists:product_categories,id',
            'featured' => 'nullable|boolean',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            DB::beginTransaction();

            $data = $request->only([
                'name', 'price', 'qty', 'discount', 'weight', 'description', 
                'content', 'product_category_id'
            ]);
            
            $data['featured'] = $request->has('featured') ? 1 : 0;

            $product->update($data);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $image->store('products', 'public');
                    
                    ProductImage::create([
                        'product_id' => $product->id,
                        'path' => $path
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('admin.product.show', $product->id)
                ->with('notification', 'Sản phẩm đã được cập nhật thành công!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function destroy(Product $product)
    {
        try {
            DB::beginTransaction();

            foreach ($product->images as $image) {
                Storage::disk('public')->delete($image->path);
            }

            $product->images()->delete();

            $product->delete();

            DB::commit();

            return redirect()->route('admin.product.index')
                ->with('notification', 'Sản phẩm đã được xóa thành công!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function deleteImage($imageId)
    {
        try {
            $image = ProductImage::findOrFail($imageId);
            
            Storage::disk('public')->delete($image->path);
            
            $image->delete();

            return response()->json([
                'success' => true,
                'message' => 'Ảnh đã được xóa thành công!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }
}