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
        $categories = Category::with('products')->get();

        $products = Product::latest('id')->take(10)->get();
        $blogs = Blog::with('user')->get();

        return view('client.home', compact('categories', 'products', 'blogs'));
    }
<<<<<<< HEAD
<<<<<<< HEAD
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
=======
=======
>>>>>>> 5bc21ef6767b1c4707158208e9f3880cb8bb3147
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
<<<<<<< HEAD
>>>>>>> 37920c276ff585df749aa6335af895fcedc888f9

=======
>>>>>>> 5bc21ef6767b1c4707158208e9f3880cb8bb3147
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


  public function shop(){
    return view('client.shops.listProduct');
}
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 5bc21ef6767b1c4707158208e9f3880cb8bb3147
public function favorite( $product_id){
$user_id=Auth::id();
$favorite = Favorite::where('product_id', $product_id)
->where('user_id', $user_id)
->first();

if ($favorite) {
    $favorite->delete();
    return redirect()->back()->with('success', 'Bỏ yêu thích sản phẩm thành công');
}
}

<<<<<<< HEAD
=======
>>>>>>> 37920c276ff585df749aa6335af895fcedc888f9
=======
>>>>>>> 5bc21ef6767b1c4707158208e9f3880cb8bb3147
}
