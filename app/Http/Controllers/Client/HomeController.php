<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Blog;
use App\Models\CartDetail;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Favourite;
use App\Models\Product;



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
        $categories = Category::query()
            ->whereHas('products')
            ->take(5)
            ->get(['id', 'name']);

        $products = Product::query()
            ->with('categories')
            ->latest('id')
            ->take(10)
            ->get();

        $blogs = Blog::query()
            ->with('user')
            ->latest()
            ->take(10)
            ->get();

        return view('client.home', compact('categories', 'products', 'blogs'));
    }


    public function detail($slug)
    {
        $totalCart = getCartItemCount();
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
        $product->increment('view');

        // Trả về view với thông tin sản phẩm và sản phẩm liên quan
        return view('client.product.productDetails', compact('product', 'relatedProducts', 'attributes', 'totalCart'));
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

    public function compose(View $view)
    {
        $userId = Auth::id();
        $favouritecount = $userId ? Favourite::where('user_id', $userId)->count() : 0;
        $totalCart = $userId ? CartDetail::query()->where('cart_id', function ($query) use ($userId) {
            $query->select('id')
                ->from('carts')
                ->where('user_id', $userId)
                ->limit(1);
        })->count() : 0;

        $view->with([
            'favouritecount' => $favouritecount,
            'totalCart' => $totalCart
        ]);
    }
}
