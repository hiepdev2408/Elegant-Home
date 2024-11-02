<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Blog;
use App\Models\Category;
use App\Models\favorite;
use App\Models\Product;
use App\Models\Variant;
use App\Models\VariantAttribute;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
<<<<<<< HEAD
        $categories = Category::with('products', 'children')->get();
        $products = Product::with('categories')->latest('id')->take(10)->get();
=======
        $categories = Category::with('products')->get();

        $products = Product::latest('id')->take(10)->get();
        // $products =Product::query()->get();
>>>>>>> 5afeb7f6b93fdc036edcec014d50d666f55a6e44
        $blogs = Blog::with('user')->get();
        // dd($products->toArray());

        return view('client.home', compact('categories', 'products', 'blogs'));
    }

    public function detail($slug)
    {
        // Lấy sản phẩm theo id và slug
        $product = Product::where([
            ['slug', $slug],
        ])
            ->with([
                'galleries',
                'categories',
                'variants.attributes' => function ($query) {
                    $query->with('attribute', 'attributeValue');
                }
            ])
            ->firstOrFail();
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

        // Lấy tất cả các thuộc tính để hiển thị
        $attributes = Attribute::with('values')->get();

        // Trả về view với thông tin sản phẩm và sản phẩm liên quan
        return view('client.products.productDetail', compact('product', 'relatedProducts', 'attributes'));
    }
<<<<<<< HEAD
    public function shop()
    {
        return view('client.shops.listProduct');
    }
    public function favorite($product_id)
    {
        $user_id = Auth::id();
        $favorite = Favorite::where('product_id', $product_id)
            ->where('user_id', $user_id)
            ->first();

        if ($favorite) {
            $favorite->delete();
            return redirect()->back()->with('success', 'Bỏ yêu thích sản phẩm thành công');
        }
=======


    public function shop()
    {
        $categories = Category::with('children')->whereNull('parent_id')->get();

        return view('client.shops.listProduct' , compact('categories'));
    }


    public function favorite($product_id)
    {
        $use_id = Auth::id();
        $data = [
            'product_id' => $product_id,
            'user_id' => $use_id,
        ];
        favorite::create($data);
            return redirect()->back()->with('success', ' yêu thích sản phẩm thành công');
>>>>>>> 5afeb7f6b93fdc036edcec014d50d666f55a6e44
    }

}
