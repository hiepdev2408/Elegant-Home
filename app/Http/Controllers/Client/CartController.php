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
        $variantAttributeIds = $request->input('variant_attributes.attribute_value_id', []); // Mặc định là mảng rỗng
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
                if ($matchingVariant->stock < $quantity) {
                    return back()->with('error', 'Số lượng yêu cầu vượt quá số lượng tồn kho của sản phẩm.');
                }
                $cartDetail->quantity += $quantity;
                $cartDetail->total_amount += $totalAmountVariant * $quantity;
                $cartDetail->save();
            } else {
                CartDetail::create([
                    'cart_id' => $cart->id,
                    'variant_id' => $matchingVariant->id,
                    'quantity' => $quantity,
                    'total_amount' => $totalAmountVariant * $quantity,
                ]);
            }
        } else {
            $product = Product::find($productId);

            // if ($product->variants()->stock < $quantity) {
            //     return back()->with('error', 'Số lượng yêu cầu vượt quá số lượng tồn kho của sản phẩm.');
            // }


            $cartDetail = CartDetail::where('cart_id', $cart->id)
                ->where('product_id', $productId)
                ->first();

            if ($cartDetail) {
                $cartDetail->quantity += $quantity;
                $cartDetail->total_amount += $totalAmount;
                $cartDetail->save();
            } else {
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

    public function update(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'cart_id' => 'required',
            'quantity' => 'required',
        ]);

        $cartDetail = CartDetail::where('cart_id', $request->cart_id)->first();
        if ($cartDetail) {
            $cartDetail->quantity = $request->quantity;
            $cartDetail->total_amount = $request->quantity * $request->price_modifier;
            $cartDetail->save();
            return back()->with('success', 'Cập nhật thành công!');
        }

        return response()->json(['success' => false, 'message' => 'Có lỗi xảy ra!'], 500);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cart = Cart::query()->with('cartDetails')->find($id);

        if ($cart) {
            $cart->cartDetails()->delete();
            $cart->delete();
        } else {
            return back()->with('error', 'Giỏ hàng không tồn tại!');
        }
        return back();

    }
}
