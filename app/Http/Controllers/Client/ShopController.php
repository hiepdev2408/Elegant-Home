<?php
namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
 {
    public function shop() {

        $totalCart = getCartItemCount();
        $categories = Category::with('children')->whereNull('parent_id')->get();

        $products = Product::query()->latest('id')->paginate(12);

        $productnew = Product::query()->latest('id')->take(3)->get();

        return view('client.shops.shopProduct', compact(['categories','products', 'productnew', 'totalCart']));
    }

    public function gird() {
        $totalCart = getCartItemCount();
        $products = Product::query()->latest('id')->paginate(8);

        $productnew = Product::query()->latest('id')->take(3)->get();

        return view('client.shops.gird', compact(['products', 'productnew','totalCart']));

    }


    public function shopFilter(Request $request, $category_id = null)
    {
        $totalCart = getCartItemCount();
        $categories = Category::with('children')->whereNull('parent_id')->get();

        $productnew = Product::query()->latest('id')->take(3)->get();
        //khởi tạo product
        $products = Product::query();

        if ($request->input('search')) {
            $request->validate([
                'search' => 'required|string|min:1'
            ],
        [
            'search.string' => 'Vui lòng nhập chữ',
        ]);

            $products->where('name', 'like', '%' . $request->input('search') . '%');
        }

        if ($category_id) {
            $products->whereHas('categories', function ($query) use ($category_id) {
                $query->where('category_id', $category_id);
            });
        }

        if($request->input('min_price') || $request->input('max_price')){
            if($request->input('min_price')){
                $products->where('price_sale','>=',  $request->input('min_price'));
            }
            if($request->input('max_price')){
                $products->where('price_sale','<=',  $request->input('max_price'));
            }

        }
        $products = $products->paginate(8);

        return view('client.shops.shopProduct', compact('categories', 'products','productnew', 'totalCart'));
    }
}
