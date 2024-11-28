<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\District;
use App\Models\Province;
use App\Models\UserVoucher;
use App\Models\Variant;
use App\Models\Vouchers;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller {

    public function index() {
        $province = Province::query()->pluck( 'name', 'code' )->all();
        $totalCart = getCartItemCount();
        $user = Auth::user();
        $cart = Cart::where( 'user_id', $user->id )->first();
        $cartDetail = CartDetail::where( 'cart_id', $cart->id )->get();
        $totalAmount = $cartDetail->sum( 'total_amount' );

        return view('client.order.info', compact('user', 'cart', 'cartDetail', 'totalAmount', 'province'));
    }

    public function getDistrictsByProvince( $provinceCode ) {
        $districts = District::where( 'province_code', $provinceCode )->pluck( 'name', 'code' );
        return response()->json( $districts );
    }

    public function getWardsByDistrict( $districtCode ) {
        $wards = Ward::where( 'district_code', $districtCode )->pluck( 'name', 'code' );
        return response()->json( $wards );
    }

    public function applyVoucher( Request $request ) {
        $request->validate( [
            'voucher_code' => 'required|string|max:255',
        ] );

        // Lấy giỏ hàng của người dùng
        $cart = Cart::where( 'user_id', auth()->id() )->first();

        // Kiểm tra nếu giỏ hàng không tồn tại
        if ( !$cart ) {
            return response()->json( [ 'success' => false, 'message' => 'Giỏ hàng không tồn tại.' ] );
        }

        // Lấy chi tiết giỏ hàng
        $cartDetails = CartDetail::where( 'cart_id', $cart->id )->get();

        // Tính giá trị tổng ban đầu
        $currentTotalAmount = $this->calculateTotal( $cartDetails, null );
        session( [ 'original_total_amount' => $currentTotalAmount ] );

        // Lấy voucher từ cơ sở dữ liệu
        $voucher = Vouchers::where( 'code', $request->voucher_code )->first();

        // Kiểm tra tính hợp lệ của voucher
        if ( !$voucher || !$voucher->isValid() ) {
            session()->forget( 'totalAmount' );
            session( [ 'totalAmount' => $currentTotalAmount ] );
            return response()->json( [ 'success' => false, 'message' => 'Voucher không hợp lệ.' ] );
        }

        // Kiểm tra nếu voucher đã được sử dụng bởi tài khoản này chưa
        $usedVoucher = UserVoucher::where( 'user_id', auth()->id() )
        ->where( 'voucher_id', $voucher->id )
        ->first();

        if ( $usedVoucher ) {
            return response()->json( [ 'success' => false, 'message' => 'Bạn đã sử dụng voucher này rồi.' ] );
        }

        // Kiểm tra nếu không có chi tiết giỏ hàng nào
        if ( $cartDetails->isEmpty() ) {
            session( [ 'totalAmount' => $currentTotalAmount ] );
            return response()->json( [ 'success' => false, 'message' => 'Giỏ hàng không có sản phẩm.' ] );
        }

        $isValidForCart = false;
        $appliedProducts = [];

        foreach ( $cartDetails as $item ) {
            $variant = Variant::find( $item->variant_id );
            if ( $variant ) {
                $productId = $variant->product_id;

                // Kiểm tra xem voucher có áp dụng cho sản phẩm này không
                if ( $voucher->products()->where( 'products.id', $productId )->exists() ) {
                    $isValidForCart = true;
                    $appliedProducts[] = $productId;
                }
            }
        }

        if ( !$isValidForCart ) {
            session()->forget( 'totalAmount' );
            session( [ 'totalAmount' => $currentTotalAmount ] );
            return response()->json( [ 'success' => false, 'message' => 'Voucher không áp dụng cho sản phẩm trong giỏ hàng.' ] );
        }

        // Lưu voucher vào session
        session( [ 'voucher_code' => $voucher->code ] );

        // session()->push( 'used_vouchers', [
        //     'user_id' => Auth()->id(),
        //     'voucher_id' => $voucher->voucher_id,
        // ] );

        // Tính tổng số tiền với giảm giá
        $totalAmount = $this->calculateTotal( $cartDetails, $voucher );

        session( [ 'totalAmount' => $totalAmount] );

        return response()->json( [
            'success' => true,
            'message' => 'Voucher đã được áp dụng!',
            'new_total' => $totalAmount,
        ] );
    }
    protected function calculateTotal( $cartDetails, $voucher ) {
        $totalPriceWithVoucher = 0;
        $totalDiscount = 0;
        $totalPriceWithoutVoucher = 0;

        foreach ( $cartDetails as $item ) {
            if ( !$item->variant ) {
                continue;
                // Bỏ qua nếu không có variant
            }

            $product = $item->variant->product;

            if ( !$product ) {
                continue;
                // Bỏ qua nếu không có product
            }

            $itemTotal = $item->quantity * $item->variant->price_modifier;

            // Kiểm tra xem voucher có áp dụng cho sản phẩm này không
            if ( $voucher && $voucher->products()->where( 'products.id', $product->id )->exists() ) {
                // Tính toán giảm giá cho sản phẩm có voucher
                $discountAmount = 0;

                if ( $voucher->discount_amount ) {
                    $discountAmount = $voucher->discount_amount * $item->quantity;
                } elseif ( $voucher->discount_percent ) {
                    $discountAmount = $itemTotal * ( $voucher->discount_percent / 100 );
                }

                // Cộng dồn vào tổng tiền của sản phẩm có voucher
                $totalPriceWithVoucher += $itemTotal;
                $totalDiscount += $discountAmount;
            } else {
                // Cộng dồn vào tổng tiền của sản phẩm không có voucher
                $totalPriceWithoutVoucher += $itemTotal;
            }
        }

                    // Tính tổng tiền cuối cùng
                $totalWithDiscount = $totalPriceWithVoucher - $totalDiscount;

                // Đảm bảo tổng tiền không âm
                return max(0, $totalWithDiscount + $totalPriceWithoutVoucher);





      }
}
