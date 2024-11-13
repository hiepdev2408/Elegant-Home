<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use function Laravel\Prompts\alert;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        // Tìm sản phẩm theo `product_id`
        $product = Product::findOrFail($request->input('product_id'));

        // Khởi tạo biến để lưu thông tin giỏ hàng
        $cartItem = [
            'product_id' => $product->id,
            'name' => $product->name,
            'quantity' => $request->input('quantity', 1),
            'price' => $request->input('total_amount'),
            'attributes' => [],
        ];

        // Kiểm tra nếu sản phẩm có biến thể
        if ($product->variants->count() > 0) {
            // Lấy các thuộc tính từ request
            $attributes = $request->except(['_token', 'product_id', 'quantity', 'total_amount']);

            // Tìm biến thể dựa trên thuộc tính đã chọn
            $variant = $product->variants()->whereHas('attributes', function ($query) use ($attributes) {
                foreach ($attributes as $attributeName => $attributeValue) {
                    $query->whereHas('attribute', function ($query) use ($attributeName) {
                        $query->where('name', $attributeName);
                    })->whereHas('attributeValue', function ($query) use ($attributeValue) {
                        $query->where('value', $attributeValue);
                    });
                }
            })->first();

            // Nếu không tìm thấy biến thể phù hợp, trả về lỗi
            if (!$variant) {
                return back()->with('error', 'Không tìm thấy biến thể phù hợp.');
            }

            // Cập nhật `cartItem` với thông tin biến thể
            $cartItem['variant_id'] = $variant->id;
            $cartItem['price'] = $variant->getFinalPriceAttribute(); // Lấy giá của biến thể nếu có
            foreach ($attributes as $attributeName => $attributeValue) {
                $cartItem['attributes'][$attributeName] = $attributeValue;
            }
        } else {
            // Nếu sản phẩm không có biến thể, dùng giá `base_price` hoặc `price_sale` của sản phẩm
            $cartItem['price'] = $product->price_sale ?? $product->base_price;
        }

        // Thêm sản phẩm vào session hoặc giỏ hàng
        session()->push('cart.items', $cartItem);

        return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng');

    }
}
