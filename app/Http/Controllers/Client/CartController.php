<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use function Laravel\Prompts\alert;

class CartController extends Controller
{

    public function getVariantId(Request $request)
    {
        $productId = $request->input('product_id');
        $attributes = $request->input('attributes');

        // Tìm `variant_id` dựa trên `product_id` và các `attribute` đã chọn
        $variant = Variant::where('product_id', $productId)
            ->whereHas('attributes', function ($query) use ($attributes) {
                foreach ($attributes as $attributeId) {
                    $query->where('attribute_value_id', $attributeId);
                }
            })
            ->first();

        if ($variant) {
            return response()->json(['variant_id' => $variant->id]);
        }

        return response()->json(['variant_id' => null]);
    }
    public function addToCart(Request $request)
    {
        // Xác định user và giỏ hàng hiện tại
        $user = Auth::user();
        $cart = $user->carts()->firstOrCreate(['user_id' => $user->id]);

        // Lấy thông tin từ request
        $productId = $request->input('product_id');
        $variantId = $request->input('variant_id');
        $quantity = $request->input('quantity', 1); // Mặc định là 1 nếu không có giá trị

    }
}
