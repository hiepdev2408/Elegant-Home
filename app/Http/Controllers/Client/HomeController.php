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
use Illuminate\View\View;

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

        $products = Product::latest('id')->take(10)->get();
        // $products =Product::query()->get();
        $blogs = Blog::with('user')->latest()->paginate(5);
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
            
        // dd($product->variants);
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
        return view('client.product.productDetails', compact('product', 'relatedProducts', 'attributes'));
    }


    public function shop()
    {
        $categories = Category::with('children')->whereNull('parent_id')->get();

        return view('client.shops.listProduct', compact('categories'));
    }

    //favourite
    public function favourite($id)
    {
        $use_id = Auth::id();
        $data = [
            'product_id' => $id,
            'user_id' => $use_id,
        ];

        $exists = Favourite::where('product_id', $id)->where('user_id', $use_id)->exists();
        if ($exists) {
            return redirect()->back()->with('error', 'Sản phẩm đã có trong danh sách yêu thích.');
        } else {
            Favourite::create($data);
            return redirect()->back()->with('success', ' yêu thích sản phẩm thành công');
        }
    }
    public function compose(View $view)
    {
        $user_id = Auth::id(); // lấy id user
        $favouritecount = Favourite::where('user_id', $user_id)->count();
        // dd($favouritecount);
        $view->with('favouritecount',  $favouritecount);
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

}
