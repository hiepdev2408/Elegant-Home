<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Product;
use App\Models\Variant;
use App\Models\VariantAttribute;

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

        return view('client.home', compact('categories', 'products', 'blogs'));
    }
    public function detail($category_id, $id)
    {
        // Lấy sản phẩm theo ID 
        $product = Product::with(['galleries', 'categories', 'variants.attributes' =>
                          function ($query){
                            $query->with('attribute', 'attributeValue');
                          }])
                          ->where('id', $id)
                          ->firstOrFail();
        $attributes = Attribute::with( 'values')->get();
        // dd($product->galleries);

        // Lấy danh mục của sản phẩm hiện tại
        $categoryIds = $product->categories->pluck('id');
        // Lấy các sản phẩm có cùng danh mục (trừ sản phẩm hiện tại)
        $relatedProducts = Product::whereHas('categories', function ($query) use ($categoryIds) {
            $query->whereIn('id', $categoryIds);
        })
        ->where('id', '!=', $product->id)
        ->distinct()
        ->limit(4)
        ->get();
            // dd($relatedProducts);

        // Trả về view với thông tin sản phẩm và sản phẩm liên quan
        return view('client.products.productDetail', compact('product', 'relatedProducts','attributes'));
    }

  public function shop(){
    return view('client.shops.listProduct');
}
}