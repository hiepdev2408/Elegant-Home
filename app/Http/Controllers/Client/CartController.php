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

        // Kiểm tra sản phẩm có tồn tại hay không
        $product = Product::find($productId);
        if (!$product) {
            return response()->json(['message' => 'Sản phẩm không tồn tại.'], 404);
        }

        // Nếu có variant_id, nghĩa là đây là sản phẩm có biến thể
        if ($variantId) {
            $variant = Variant::where('product_id', $productId)->find($variantId);
            if (!$variant) {
                return response()->json(['message' => 'Biến thể sản phẩm không tồn tại.'], 404);
            }

            // Kiểm tra nếu biến thể đã có trong giỏ hàng thì cập nhật số lượng
            $cartDetail = $cart->cartDetails()->where('variant_id', $variantId)->first();
            if ($cartDetail) {
                $cartDetail->quantity += $quantity;
                $cartDetail->total_amount = $cartDetail->quantity * $variant->getFinalPriceAttribute();
                $cartDetail->save();
            } else {
                // Tạo mới nếu biến thể chưa có trong giỏ hàng
                $cart->cartDetails()->create([
                    'variant_id' => $variantId,
                    'quantity' => $quantity,
                    'total_amount' => $quantity * $variant->getFinalPriceAttribute(),
                ]);
            }
        } else {
            // Nếu không có variant_id, thêm sản phẩm không biến thể vào giỏ hàng
            $cartDetail = $cart->cartDetails()->where('product_id', $productId)->first();
            if ($cartDetail) {
                $cartDetail->quantity += $quantity;
                $cartDetail->total_amount = $cartDetail->quantity * $product->price_sale;
                $cartDetail->save();
            } else {
                // Tạo mới nếu sản phẩm chưa có trong giỏ hàng
                $cart->cartDetails()->create([
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'total_amount' => $quantity * $product->price_sale,
                ]);
            }
        }

        return response()->json(['message' => 'Đã thêm sản phẩm vào giỏ hàng thành công.']);
    }
}
