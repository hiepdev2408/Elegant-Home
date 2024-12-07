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
        $totalAmount = $request->input('total_amount', 0);

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
                return back()->with('error', 'Sản phẩm không còn hàng đó vui lòng chọn sản phẩm khác!');
            }

            $cartDetail = CartDetail::where('cart_id', $cart->id)
                ->where('variant_id', $matchingVariant->id)
                ->first();

            $totalAmountVariant = $matchingVariant->price_modifier;

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
                    'total_amount' => $totalAmountVariant * $quantity,
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
                    'total_amount' => $totalAmount * $quantity,
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

    public function update(Request $request, string $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:0',
        ]);

        // Lấy chi tiết giỏ hàng
        $cartDetail = CartDetail::query()->with('cart', 'variant')->findOrFail($id);

        if (!$cartDetail) {
            return response()->json(['success' => false, 'message' => 'Giỏ hàng không tồn tại!'], 404);
        }

        // Kiểm tra số lượng tồn kho
        if ($request->quantity > $cartDetail->variant->stock) {
            return response()->json([
                'success' => false,
                'message' => 'Số lượng yêu cầu vượt quá tồn kho của sản phẩm.',
            ], 400);
        }

        // Xóa sản phẩm nếu số lượng <= 0
        if ($request->quantity <= 0) {
            $cartDetail->delete();

            // Kiểm tra nếu giỏ hàng không còn chi tiết nào
            if ($cartDetail->cart->cartDetails()->count() === 0) {
                $cartDetail->cart->delete();
                return back()->with(
                    'success',
                    'Tất cả sản phẩm đã bị xóa khỏi giỏ hàng!',
                );
            }
            $overallTotal = $cartDetail->cart->cartDetails->sum('total_amount');
            return response()->json([
                'success' => true,
                'message' => 'Sản phẩm đã được xóa khỏi giỏ hàng!',
                'cartDetailId' => $id,
                'overallTotalFormatted' => number_format($overallTotal, 0, ',', '.') . ' VNĐ',
            ], 200);
        }

        // Cập nhật số lượng và tổng tiền
        $cartDetail->quantity = $request->quantity;
        $cartDetail->total_amount = $request->quantity * ($cartDetail->variant->price_modifier ?? 0);
        $cartDetail->save();

        // Lấy tổng tiền giỏ hàng
        $overallTotal = $cartDetail->cart->cartDetails->sum('total_amount');

        return response()->json([
            'success' => true,
            'message' => 'Cập nhật số lượng thành công!',
            'cartDetail' => [
                'quantity' => $cartDetail->quantity,
            ],
            'totalAmountFormatted' => number_format($cartDetail->total_amount, 0, ',', '.') . ' VNĐ',
            'overallTotalFormatted' => number_format($overallTotal, 0, ',', '.') . ' VNĐ',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Lấy id chi tiết giỏ hàng
        $cartDetail = CartDetail::query()->with('cart')->find($id);
        // dd($cartDetail);
        if (!$cartDetail) {
            return back()->with('error', 'Giỏ hàng không tồn tại!');
        }
        $cartDetail->delete();
        $overallTotal = $cartDetail->cart->cartDetails->sum('total_amount');

        // Lấy id giỏ hàng
        $cart = $cartDetail->cart;
        // Kiểm tra xem giỏ hàng còn chi tiết nào không
        if ($cart->cartDetails->count() === 0) {
            $cart->delete();
            return back()->with('error', 'Tất cả sản phẩm đã bị xóa khỏi giỏ hàng!');
        }

        return response()->json([
            'success' => true,
            'message' =>
                'Xóa sản phẩm thành công!',
            'overallTotalFormatted' => number_format($overallTotal, 0, ',', '.') . ' VNĐ',
        ]);
        ;

    }
}
