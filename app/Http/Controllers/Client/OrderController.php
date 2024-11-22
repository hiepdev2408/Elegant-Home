<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use App\Models\UserVoucher;
use App\Models\Variant;
use App\Models\VariantAttribute;
use App\Models\Vouchers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use View;
use function Laravel\Prompts\alert;

class OrderController extends Controller
 {

    public function index() {
        $user = Auth::user();
        $cart = Cart::where( 'user_id', $user->id )->first();
        $cartDetail = CartDetail::where( 'cart_id', $cart->id )->get();
        $totalAmount = $cartDetail->sum( 'total_amount' );
        return view( 'client.checkout.order', compact( 'user', 'cart', 'cartDetail', 'totalAmount' ) );
    }

    public function checkout(Request $request) {
        // Xác thực dữ liệu đầu vào
        // $request->validate([
        //     'current_address' => 'required|string|max:255',
        // ]);
    
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();
    
        // Kiểm tra nếu giỏ hàng không tồn tại
        if (!$cart) {
            return redirect()->back()->withErrors(['msg' => 'Giỏ hàng không tồn tại.']);
        }
    
        $cartDetail = CartDetail::where('cart_id', $cart->id)->get();
        if ($cartDetail->isEmpty()) {
            return redirect()->back()->withErrors(['msg' => 'Giỏ hàng trống.']);
        }
    
        $totalAmount = session('totalAmount', 0);
    
        // Tạo đơn hàng
        $order = Order::create([
            'user_id' => $user->id,
            'name_person' => $user->name,
            'email_person' => $user->email,
            'phone_person' => $user->phone,
            'address_person' => $user->address,
            // 'current_address' => $request->current_address, // Đảm bảo thêm trường này
            'total_amount' => $totalAmount,
        ]);
    
        // Xử lý chi tiết đơn hàng
        foreach ($cartDetail as $item) {
            $product = Product::find($item->product_id);
            $variant = Variant::find($item->variant_id);
    
            // Chỉ lưu chi tiết nếu có ít nhất một trong hai trường
            if ($product || $variant) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $product ? $product->id : null,
                    'variant' => $variant ? $variant->id : null,
                    'quantity' => $item->quantity,
                    'total_amount' => $totalAmount,
                ]);
            } else {
                \Log::warning('Product or variant is missing for cart item: ' . $item->id);
            }
        }
    
        // Xóa từng chi tiết giỏ hàng
        foreach ($cartDetail as $item) {
            $item->delete();
        }
    
        // Xóa giỏ hàng
        $cart->delete();
    
        // Xóa thông tin trong session
        session()->forget(['voucher_code', 'totalAmount']);
    
        return redirect()->route('index.Order')->with('success', 'Tiến hành thanh toán');
    }

    public function applyVoucher( Request $request )
 {
        $request->validate( [
            'voucher_code' => 'required|string|max:255',
        ] );

        // Lấy giỏ hàng của người dùng
        $cart = Cart::where( 'user_id', auth()->id() )->first();

        // Kiểm tra nếu giỏ hàng không tồn tại
        if ( !$cart ) {
            return back()->withErrors( [ 'voucher_code' => 'Giỏ hàng không tồn tại.' ] );
        }

        // Lấy chi tiết giỏ hàng
        $cartDetails = CartDetail::where( 'cart_id', $cart->id )->get();

        // Tính giá trị tổng ban đầu
        $currentTotalAmount = $this->calculateTotal( $cartDetails, null );
        session( [ 'original_total_amount' => $currentTotalAmount ] );
        // Lưu giá trị ban đầu

        // Lấy voucher từ cơ sở dữ liệu
        $voucher = Vouchers::where( 'code', $request->voucher_code )->first();

        // Kiểm tra tính hợp lệ của voucher
        if ( !$voucher || !$voucher->isValid() ) {
            session()->forget( 'totalAmount' );
            // Xóa session
            session( [ 'totalAmount' => $currentTotalAmount ] );
            // Khôi phục giá trị cũ
            return redirect()->route( 'index.Order' )->withErrors( [ 'voucher_code' => 'Voucher không hợp lệ.' ] );
        }

        // Kiểm tra nếu voucher đã được sử dụng bởi tài khoản này chưa
        $usedVoucher = UserVoucher::where( 'user_id', auth()->id() )
        ->where( 'voucher_id', $voucher->id )
        ->first();

        if ( $usedVoucher ) {
            return redirect()->route( 'index.Order' )->withErrors( [ 'voucher_code' => 'Bạn đã sử dụng voucher này rồi.' ] );
        }

        // Kiểm tra nếu không có chi tiết giỏ hàng nào
        if ( $cartDetails->isEmpty() ) {
            session( [ 'totalAmount' => $currentTotalAmount ] );
            return redirect()->route( 'index.Order' )->withErrors( [ 'voucher_code' => 'Giỏ hàng không có sản phẩm.' ] );
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
                    // Thêm sản phẩm đã áp dụng voucher vào mảng
                }
            }
        }

        if ( !$isValidForCart ) {
            session()->forget( 'totalAmount' );
            session( [ 'totalAmount' => $currentTotalAmount ] );
            return redirect()->route( 'index.Order' )->withErrors( [ 'voucher_code' => 'Voucher không áp dụng cho sản phẩm trong giỏ hàng.' ] );
        }

        // Lưu voucher vào session
        session( [ 'voucher_code' => $voucher->code ] );

        // Tăng số lượt sử dụng của voucher
        $voucher->increment( 'used_count' );

        // Lưu thông tin voucher đã sử dụng vào bảng UsedVouchers
        UserVoucher::create( [
            'user_id' => auth()->id(),
            'voucher_id' => $voucher->id,
        ] );

        // Tính tổng số tiền với giảm giá
        $totalAmount = $this->calculateTotal( $cartDetails, $voucher );
        session( [ 'totalAmount' => $totalAmount ] );
        // Lưu tổng vào session
        // dd( $request->all() );

        return redirect()->route( 'index.Order' )->with( 'success', 'Voucher đã được áp dụng!' );
    }

    protected function calculateTotal( $cartDetails, $voucher )
 {
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
        return max( 0, $totalWithDiscount + $totalPriceWithoutVoucher );
    }

}

