<?php
namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function shop()
    {
        $categories = Category::with('children')->where('is_active', 1)->get();

        $products = Product::query()->latest('id')->paginate(12);

        $productnew = Product::query()->latest('id')->take(3)->get();
        // dd($categories);

        return view('client.shops.shopProduct', compact(['categories', 'products', 'productnew']));
    }

    public function gird()
    {
        $products = Product::query()->latest('id')->paginate(8);

        $productnew = Product::query()->latest('id')->take(3)->get();

        return view('client.shops.gird', compact(['products', 'productnew']));

    }
    public function shopFilter(Request $request, $category_id = null)
{
    $categories = Category::with('children')->where('is_active', 1)->get();
    $productnew = Product::query()->latest('id')->take(3)->get();
    $products = Product::query();

    // Xử lý lọc sản phẩm
    if ($request->input('search')) {
        $request->validate([
            'search' => 'required|string|min:1'
        ], [
            'search.required' => 'Vui lòng nhập chữ',
            'search.string' => 'Vui lòng nhập chữ',
        ]);

        $products->where('name', 'like', '%' . $request->input('search') . '%');
    }

    // Xử lý lọc theo danh mục
    if ($category_id) {
        $products->whereHas('categories', function ($query) use ($category_id) {
            $query->where('category_id', $category_id);
        });
    }

    // Xử lý lọc theo giá
    if ($request->input('min_price') || $request->input('max_price')) {
        if ($request->input('min_price')) {
            $products->where('price_sale', '>=', $request->input('min_price'));    
        }
        if ($request->input('max_price')) {
            $products->where('price_sale', '<=', $request->input('max_price'));
        }
    }

    $products = $products->paginate(8);

    if ($request->ajax()) {
        return view('client.shops.partials.productfilter', compact('products')); // Trả về chỉ danh sách sản phẩm
    }

    return view('client.shops.shopProduct', compact('categories', 'products', 'productnew'));
}



}
