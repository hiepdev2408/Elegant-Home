<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Variant;
use App\Models\Vouchers;
use App\Models\UserVoucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller {
    public function checkout( Request $request ) {
        try {
            DB::transaction( function() use ( $request ) {
                $user = Auth::user();

                // Lấy cart của người dùng này
                $cart = Cart::query()->where( 'user_id', $user->id )->first();
                if ( !$cart ) {
                    throw new \Exception( 'Giỏ hàng không tồn tại.' );
                }

                // Lấy ra tổng giá trị của đơn hàng
                $totalAmount = $request->total_amount;

                // Thực hiện tạo đơn hàng
                $order = Order::query()->create( [
                    'user_id' => $user->id,
                    'user_name' => $request->user_name,
                    'user_email' => $request->user_email,
                    'user_phone' => $request->user_phone,
                    'user_address' => $request->user_address,
                    'user_address_all' => $request->user_address_all,
                    'user_content' => $request->user_note ?? '',
                    'is_ship_user_same_user' => $request->is_ship_user_same_user,
                    'total_amount' => $totalAmount,
                ] );

                // Sử lý bảng orderDetails
                foreach ( $cart->cartDetails as $cartDetails ) {
                    OrderDetail::query()->create( [
                        'order_id' => $order->id,
                        'product_id' => $cartDetails->product_id,
                        'variant_id' => $cartDetails->variant_id,
                        'quantity' => $cartDetails->quantity,
                        'total_amount' => $cartDetails->total_amount,
                    ] );

                    $cartDetails->delete();

                    $variant = Variant::query()->find( $cartDetails->variant_id );
                    if ( $variant ) {
                        // Kiểm tra số lượng tồn kho
                        if ( $variant->stock >= $cartDetails->quantity ) {
                            $variant->stock -= $cartDetails->quantity;
                            $variant->save();
                        } else {
                            throw new \Exception( 'Số lượng sản phẩm không đủ.' );
                        }
                    }
                }

                $voucherCode = session( 'voucher_code' );
                if ($voucherCode) {
                    $voucher = Vouchers::where('code', $voucherCode)->first();
                    if ($voucher) {
                        // Lưu voucher vào database
                        UserVoucher::create( [
                            'user_id' => auth()->id(),
                            'voucher_id' => $voucher->id,
                        ] );

                        // Tăng số lượt sử dụng của voucher
                        $voucher->increment( 'used_count' );
                    }
                }

              
                $cart->delete();

                session()->forget( [ 'voucher_code', 'discount_amount', 'totalAmount' ] );
            }
            , 1 );
            // dd( $request->userVoucher );

            return redirect()->route( 'defaultView' )->with( 'success', 'Đơn hàng của bạn đã được đặt thành công!' );
        } catch ( \Exception $exception ) {
            // Ghi lỗi vào log
            \Log::error( $exception->getMessage() );

            return back()->with( 'error', 'Có lỗi xảy ra, vui lòng thử lại.' );
        }
    }

    public function defaultView() {
        $totalCart = getCartItemCount();
        return view( 'client.payment_method.default', compact( 'totalCart' ) );
    }
}
