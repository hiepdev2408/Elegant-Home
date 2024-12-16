<?php

namespace App\Http\Controllers\Client;

use App\Models\Sale;
use Carbon\Carbon;
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
use App\Models\Order;
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

        $productCategory = $products->take(8);

        $blogs = Blog::query()
            ->with('user')
            ->latest()
            ->take(10)
            ->get();

        $currentDate = Carbon::now();

        $sales = Sale::where('start_date', '<=', $currentDate)
            ->where('end_date', '>=', $currentDate)
            ->with('products')
            ->get();

        $productsOnSale = [];

        foreach ($sales as $sale) {
            foreach ($sale->products as $product) {
                if ($product->price_sale || $product->base_price) {
                    $finalPrice = $product->price_sale ?: $product->base_price;

                    if (isset($finalPrice) && $sale->discount_percentage > 0) {
                        $discountAmount = ($finalPrice * $sale->discount_percentage) / 100;
                        $finalPrice -= $discountAmount;
                    }

                    $productsOnSale[] = [
                        'id' => $product->id,
                        'name' => $product->name,
                        'slug' => $product->slug,
                        'price_sale' => $finalPrice,
                        'base_price' => $product->base_price,
                        'img_thumbnail' => $product->img_thumbnail,
                        'sale_end' => $sale->end_date,
                    ];
                }
            }
        }

        session(['productsOnSale' => $productsOnSale]);

        return view('client.home', compact('categories', 'products', 'blogs', 'sales', 'productCategory'));
    }

    public function detail($slug)
    {
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

        $categoryIds = $product->categories->pluck('id');

        // Lấy các sản phẩm liên quan (cùng danh mục)
        $relatedProducts = Product::whereHas('categories', function ($query) use ($categoryIds) {
            $query->whereIn('id', $categoryIds);
        })
            ->where('id', '!=', $product->id)
            ->distinct()
            ->limit(4)
            ->get();

        // Lấy các sản phẩm trong danh mục khác
        $otherCategoryProducts = Product::whereHas('categories', function ($query) use ($categoryIds) {
            $query->whereIn('id', $categoryIds);
        })
            ->where('id', '!=', $product->id)
            ->distinct()
            ->limit(4)
            ->get();

        $attributes = Attribute::with('values')->get();
        $product->increment('view');

        $finalPrice = null;
        $productsOnSale = session('productsOnSale', []);

        foreach ($productsOnSale as $saleProduct) {
            if ($saleProduct['id'] === $product->id) {
                $finalPrice = $saleProduct['price_sale'];
                break;
            }
        }

        return view('client.product.productDetails', compact('product', 'relatedProducts', 'otherCategoryProducts', 'attributes', 'finalPrice'));
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
        $totalCart = $userId ? CartDetail::query()->where('cart_id', function ($query) use ($userId) {
            $query->select('id')
                ->from('carts')
                ->where('user_id', $userId)
                ->limit(1);
        })->count() : 0;

        $view->with([
            'totalCart' => $totalCart
        ]);
    }
}
