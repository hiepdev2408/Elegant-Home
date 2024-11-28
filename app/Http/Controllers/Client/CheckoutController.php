<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        try {
            $user = Auth::user();
            $cart = Cart::query()->where('user_id', $user->id)->first();

            foreach ($cart->cartDetails as $cartDetails) {
                $variant = Variant::query()->find($cartDetails->variant_id);
                if ($variant && $variant->stock < $cartDetails->quantity) {
                    $cartDetails->delete();

                    return back()->with(
                        'error',
                        "Sản phẩm {$variant->product->name} đã hết hàng và đã bị xóa khỏi giỏ hàng."
                    );
                }
            }

            DB::transaction(function () use ($cart, $request, $user) {

                $order = Order::query()->create([
                    'user_id' => $user->id,
                    'user_name' => $request->user_name,
                    'user_email' => $request->user_email,
                    'user_phone' => $request->user_phone,
                    'user_address' => $request->user_address,
                    'user_address_all' => $request->user_address_all,
                    'user_content' => $request->user_note ?? '',
                    'is_ship_user_same_user' => $request->is_ship_user_same_user,
                    'total_amount' => $request->total_amount,
                ]);

                foreach ($cart->cartDetails as $cartDetails) {
                    OrderDetail::query()->create([
                        'order_id' => $order->id,
                        'product_id' => $cartDetails->product_id,
                        'variant_id' => $cartDetails->variant_id,
                        'quantity' => $cartDetails->quantity,
                        'total_amount' => $cartDetails->total_amount,
                    ]);

                    $variant = Variant::query()->find($cartDetails->variant_id);
                    if ($variant) {
                        $variant->stock -= $cartDetails->quantity;
                        $variant->save();
                    }
                    $cartDetails->delete();
                }
                $cart->delete();

                session()->forget(['voucher_code', 'discount_amount', 'totalAmount']);
            }, 1);

            return redirect()->route('defaultView')->with('success', 'Đơn hàng của bạn đã được đặt thành công!');
        } catch (\Exception $exception) {
            return back()->with('error', 'Đã xảy ra lỗi khi đặt hàng: ' . $exception->getMessage());
        }
    }

    public function defaultView()
    {
        $totalCart = getCartItemCount();
        return view('client.order.checkout.default', compact('totalCart'));
    }
}
