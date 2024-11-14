<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{

    public function listCart()
    {
        return view('client.cart.listCart');
    }
    public function addToCart(Request $request)
    {
        // Lấy ID của sản phẩm từ request
        $productId = $request->input('product_id');

        dd($productId);

    }
}
