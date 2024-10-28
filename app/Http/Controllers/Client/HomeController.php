<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::with('products')->get();

        $products = Product::latest()->take(10)->get();
        $blogs = Blog::with('user')->get();

        return view('client.home', compact('categories', 'products','blogs'));
    }
    public function detail($category_id, $id, $slug)
    {
        // Lấy sản phẩm theo ID và slug
        $product = Product::with(['galleries', 'productAttributes', 'categories'])
                          ->where('id', $id)
                          ->where('slug', $slug)
                          ->firstOrFail();

        // Lấy danh mục của sản phẩm hiện tại
        $categoryIds = $product->categories->pluck('id');

        // Lấy các sản phẩm có cùng danh mục (trừ sản phẩm hiện tại)
        $relatedProducts = Product::whereHas('categories', function ($query) use ($categoryIds) {
            $query->whereIn('id', $categoryIds);
        })
        ->where('id', '!=', $product->id)
        ->limit(4)
        ->get();
            // dd($relatedProducts);

        // Trả về view với thông tin sản phẩm và sản phẩm liên quan
        return view('client.products.productDetail', compact('product', 'relatedProducts'));
    }
}
