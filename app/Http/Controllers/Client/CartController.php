<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Product;
use App\Models\Variant;
use App\Models\VariantAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use function Laravel\Prompts\alert;

class CartController extends Controller
{
    public function addToCart(Request $request)
{
    // Lấy thông tin người dùng hiện tại (đảm bảo người dùng đã đăng nhập)
    $user = Auth::user();

    // Kiểm tra giỏ hàng của người dùng và tạo nếu chưa có
    $cart = Cart::firstOrCreate(['user_id' => $user->id]);

    // Lấy dữ liệu từ request
    $productId = $request->input('product_id');
    $variantAttributeIds = $request->input('variant_attributes.attribute_value_id'); // Array of attribute_value_ids
    $quantity = $request->input('quantity', 1);
    $totalAmount = $request->input('total_amount', 0);

    if (!empty($variantAttributeIds)) {
        // Đếm số lượng attribute_value_id được chọn
        $attributeCount = count($variantAttributeIds);

        // Tìm biến thể dựa trên attribute_value_id
        $variants = Variant::where('product_id', $productId)
            ->whereHas('attributes', function ($query) use ($variantAttributeIds) {
                $query->whereIn('attribute_value_id', $variantAttributeIds);
            })
            ->get();

        // Lọc lại các biến thể để đảm bảo tất cả attribute_value_id đều khớp
        $matchingVariant = null;
        foreach ($variants as $variant) {
            $variantAttributes = VariantAttribute::where('variant_id', $variant->id)
                ->pluck('attribute_value_id')
                ->toArray();

            // Kiểm tra xem các giá trị thuộc tính có khớp không
            if (count(array_intersect($variantAttributes, $variantAttributeIds)) === $attributeCount) {
                $matchingVariant = $variant;
                break;
            }
        }

        if (!$matchingVariant) {
            // Nếu không tìm thấy biến thể khớp hoàn toàn
            return back()->with('error', 'Sản phẩm không còn hàng đó vui lòng chọn sản phẩm khác!');
        }

        // Biến thể hợp lệ - kiểm tra xem nó đã có trong giỏ hàng hay chưa
        $cartDetail = CartDetail::where('cart_id', $cart->id)
            ->where('variant_id', $matchingVariant->id)
            ->first();

        $totalAmountVariant = $variant->price_modifier;

        if ($cartDetail) {
            // Nếu đã tồn tại, cập nhật số lượng và tổng tiền
            $cartDetail->quantity += $quantity;
            // dd($variant);
            $totalAmountVariant = $variant->price_modifier;
            $cartDetail->total_amount += $totalAmountVariant;
            $cartDetail->create();
        } else {
            // Nếu chưa tồn tại, thêm mới chi tiết giỏ hàng
            CartDetail::create([
                'cart_id' => $cart->id,
                'variant_id' => $matchingVariant->id,
                'quantity' => $quantity,
                'total_amount' => $totalAmountVariant,
            ]);
        }
    } else {
        // Trường hợp sản phẩm không có biến thể
        $cartDetail = CartDetail::where('cart_id', $cart->id)
            ->where('product_id', $productId)
            ->first();

        if ($cartDetail) {
            // Nếu đã tồn tại trong giỏ hàng, cập nhật số lượng và tổng tiền
            $cartDetail->quantity += $quantity;
            $cartDetail->total_amount += $totalAmount;
            $cartDetail->save();
        } else {
            // Nếu chưa tồn tại, thêm mới
            CartDetail::create([
                'cart_id' => $cart->id,
                'product_id' => $productId,
                'quantity' => $quantity,
                'total_amount' => $totalAmount,
            ]);
        }
    }

    return back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
}



    public function listCart()
    {
        $carts = CartDetail::with(['product', 'variant'])->get();

        return view('client.cart.listCart', compact('carts'));
    }
}
