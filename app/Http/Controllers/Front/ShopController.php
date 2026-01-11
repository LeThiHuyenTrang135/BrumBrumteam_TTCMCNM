<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Product\ProductServiceInterface;
use App\Services\ProductComment\ProductCommentServiceInterface;
use App\Services\ProductCategory\ProductCategoryServiceInterface;
use App\Services\Brand\BrandServiceInterface;

class ShopController extends Controller
{
    private $productService;
    private $productCommentService;
    private $productCategoryService;
    private $brandService;

    public function __construct(
        ProductServiceInterface $productService,
        ProductCommentServiceInterface $productCommentService,
        ProductCategoryServiceInterface $productCategoryService,
        BrandServiceInterface $brandService
    ) {
        $this->productService = $productService;
        $this->productCommentService = $productCommentService;
        $this->productCategoryService = $productCategoryService;
        $this->brandService = $brandService;
    }

    public function show($id)
    {
        $categories = $this->productCategoryService->all();
        $brands = $this->brandService->all();
        $product = $this->productService->find($id);
        $relatedProducts = $this->productService->getRelatedProducts($product);

        return view('front.shop.show', compact('product', 'relatedProducts', 'categories', 'brands'));
    }

    public function postComment(Request $request, $id)
    {
        $data = $request->except('_token');
        $data['product_id'] = $id;
        $data['user_id'] = Auth::check() ? Auth::id() : null;

        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email',
            'messages' => 'required',
            'rating' => 'required|integer|min:1|max:5',

        ]);

        $this->productCommentService->create($data);

        return redirect()->back()->with('success', 'Comment added!');
    }
    public function index(Request $request)
    {
        $categories = $this->productCategoryService->all();
        $brands = $this->brandService->all();

        $products = $this->productService->getProductOnIndex($request);

        return view('front.shop.index', compact('products', 'categories', 'brands'));
    }

    public function category($categoryName, Request $request)
    {
        $categories = $this->productCategoryService->all();
        $brands = $this->brandService->all();

        $products = $this->productService->getProductsByCategory($categoryName, $request);

        return view('front.shop.index', compact('products', 'categories', 'brands'));
    }
}
