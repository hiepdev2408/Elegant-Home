<?php

namespace App\Http\Controllers\Client;

use App\Helpers\CartHelper;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Product;
use App\Models\UserVoucher;
use App\Models\Variant;
use App\Models\VariantAttribute;
use App\Models\Vouchers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $user = Auth::user();
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);
    
        $productId = $request->input('product_id');
        $variantAttributeIds = $request->input('variant_attributes.attribute_value_id', []);
        $quantity = $request->input('quantity', 1);
        $totalAmount = $request->input('total_amount', 0); // Lấy tổng từ yêu cầu
    
        if (!empty($variantAttributeIds)) {
            $attributeCount = count($variantAttributeIds);
            $variants = Variant::where('product_id', $productId)
                ->whereHas('attributes', function ($query) use ($variantAttributeIds) {
                    $query->whereIn('attribute_value_id', $variantAttributeIds);
                })
                ->get();
    
            $matchingVariant = null;
            foreach ($variants as $variant) {
                $variantAttributes = VariantAttribute::where('variant_id', $variant->id)
                    ->pluck('attribute_value_id')
                    ->toArray();
    
                if (count(array_intersect($variantAttributes, $variantAttributeIds)) === $attributeCount) {
                    $matchingVariant = $variant;
                    break;
                }
            }
    
            if (!$matchingVariant) {
                return back()->with('error', 'Sản phẩm không còn hàng đó, vui lòng chọn sản phẩm khác!');
            }
    
            $cartDetail = CartDetail::where('cart_id', $cart->id)
                ->where('variant_id', $matchingVariant->id)
                ->first();
    
            // Sử dụng giá cuối cùng từ yêu cầu
            if ($cartDetail) {
                $newQuantity = $cartDetail->quantity + $quantity;
                if ($matchingVariant->stock < $newQuantity) {
                    return back()->with('error', 'Số lượng yêu cầu vượt quá số lượng tồn kho của sản phẩm.');
                }

                $cartDetail->quantity = $newQuantity;
                $cartDetail->total_amount += $totalAmountVariant * $quantity;
                $cartDetail->save();
            } else {
                if ($matchingVariant->stock < $quantity) {
                    return back()->with('error', 'Số lượng yêu cầu vượt quá số lượng tồn kho của sản phẩm.');
                }

                CartDetail::create([
                    'cart_id' => $cart->id,
                    'variant_id' => $matchingVariant->id,
                    'quantity' => $quantity,
                    'total_amount' => $totalAmount * $quantity, // Lưu tổng amount từ yêu cầu
                ]);
            }
        } else {
            $product = Product::find($productId);

            $cartDetail = CartDetail::where('cart_id', $cart->id)
                ->where('product_id', $productId)
                ->first();
    
            if ($cartDetail) {
                $newQuantity = $cartDetail->quantity + $quantity;
                if ($product->stock < $newQuantity) {
                    return back()->with('error', 'Số lượng yêu cầu vượt quá số lượng tồn kho của sản phẩm.');
                }

                $cartDetail->quantity = $newQuantity;
                $cartDetail->total_amount += $totalAmount;
                $cartDetail->save();
            } else {
                if ($product->stock < $quantity) {
                    return back()->with('error', 'Số lượng yêu cầu vượt quá số lượng tồn kho của sản phẩm.');
                }

                CartDetail::create([
                    'cart_id' => $cart->id,
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'total_amount' => $totalAmount * $quantity, // Lưu tổng amount từ yêu cầu
                ]);
            }
        }
    
        return back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
    }


    public function cart()
    {
        $cart = Cart::where('user_id', Auth::user()->id)->first();
        $carts = $cart ? $cart->cartDetails()->with(['product', 'variant'])->get() : [];

        return view('client.cart.listCart', compact('carts'));
    }

    public function update(Request $request)
    {
        $cartDetail = CartDetail::findOrFail($request->cart_id);
    
        // Lấy giá từ session
        $productsOnSale = session('productsOnSale', []);
        $finalPrice = null;
    
        foreach ($productsOnSale as $saleProduct) {
            if ($saleProduct['id'] === $cartDetail->product->id) {
                $finalPrice = $saleProduct['price_sale'];
                break;
            }
        }
    
        // Nếu không tìm thấy giá khuyến mãi, sử dụng giá mặc định
        if (!$finalPrice) {
            $finalPrice = $cartDetail->variant ? $cartDetail->variant->price_modifier : $cartDetail->product->price_sale;
        }
    
        // Cập nhật số lượng và tổng tiền
        $cartDetail->quantity = $request->quantity;
        $cartDetail->total_amount = $cartDetail->quantity * $finalPrice; // Sử dụng giá cuối cùng
        $cartDetail->save();
    
        return response()->json([
            'success' => true,
            'message' => 'Cập nhật số lượng thành công!',
            'subTotal' => number_format($cartDetail->total_amount, 0, ',', '.'),
            'quantity' => $cartDetail->quantity,
        ]);

    }
}
