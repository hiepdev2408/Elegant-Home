<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Favourite;
use App\Models\Product;

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

        $categories = Category::query()->take(5)->has('products')->get();

        $products = Product::query()->with('categories')->latest('id')->take(10)->get();
        $blogs = Blog::with('user')->get();

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

    public function shop()
    {
        $categories = Category::with('children')->whereNull('parent_id')->get();

        return view('client.shops.listProduct', compact('categories'));
    }


    public function favorite($product_id)
    {
        $use_id = Auth::id();
        $data = [
            'product_id' => $product_id,
            'user_id' => $use_id,
        ];
        Favourite::create($data);

        return redirect()->back()->with('success', ' yêu thích sản phẩm thành công');
    }
    public function store(Request $request)
    {
        Comment::create([
            'comment' => $request->comment,
            'user_id' => Auth::user()->id,
            'product_id' => $request->product_id,
            'parent_id' => $request->parent_id ?? null,
        ]);

        return back();
    }

    public function search($id){
        $category = Category::findOrFail($id);

        $productCategory = $category->products()->get();

        return view('client.layouts.partials.filter', compact('category', 'productCategory'));
    }
}
