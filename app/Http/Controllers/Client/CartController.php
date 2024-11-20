<?php

namespace App\Http\Controllers\Client;

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
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use function Laravel\Prompts\alert;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return back()->with('error', 'Vui lòng đăng nhập để tiếp tục.');
        }

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



    public function listCart()
    {
        $carts = CartDetail::with(['product', 'variant'])->get();

        return view('client.cart.listCart', compact('carts'));
    }

    public function updateCartQuantity(Request $request){

        // Lấy thông tin giỏ hàng
        $cartDetail = CartDetail::findOrFail($request->cart_id);

        // Cập nhật số lượng và tổng tiền
        $cartDetail->quantity = $request->quantity;
        $cartDetail->total_amount = $cartDetail->quantity * $cartDetail->variant->price_modifier;
        $cartDetail->save();

        return response()->json([
            'success' => true,
            'message' => 'Cập nhật số lượng thành công!',
            'subTotal' => number_format($cartDetail->total_amount, 0, ',', '.'),
            'quantity' => $cartDetail->quantity,
        ]);
    }
    public function applyVoucher(Request $request)
    {
        $request->validate([
            'voucher_code' => 'required|string|max:255',
        ]);

        // Lấy giỏ hàng của người dùng
        $cart = Cart::where('user_id', auth()->id())->first();

        // Kiểm tra nếu giỏ hàng không tồn tại
        if (!$cart) {
            return back()->withErrors(['voucher_code' => 'Giỏ hàng không tồn tại.']);
        }

        // Lấy chi tiết giỏ hàng
        $cartDetails = CartDetail::where('cart_id', $cart->id)->get();

        // Tính giá trị tổng ban đầu
        $currentTotalAmount = $this->calculateTotal($cartDetails, null);
        session(['original_total_amount' => $currentTotalAmount]); // Lưu giá trị ban đầu

        // Lấy voucher từ cơ sở dữ liệu
        $voucher = Vouchers::where('code', $request->voucher_code)->first();

        // Kiểm tra tính hợp lệ của voucher
        if (!$voucher || !$voucher->isValid()) {
            session()->forget('totalAmount'); // Xóa session
            session(['totalAmount' => $currentTotalAmount]); // Khôi phục giá trị cũ
            return redirect()->route('listCart')->withErrors(['voucher_code' => 'Voucher không hợp lệ.']);
        }

        // Kiểm tra nếu voucher đã được sử dụng bởi tài khoản này chưa
        $usedVoucher = UserVoucher::where('user_id', auth()->id())
            ->where('voucher_id', $voucher->id)
            ->first();

            if ($usedVoucher) {
                return redirect()->route('listCart')->withErrors(['voucher_code' => 'Bạn đã sử dụng voucher này rồi.']);
            }


        // Kiểm tra nếu không có chi tiết giỏ hàng nào
        if ($cartDetails->isEmpty()) {
            session(['totalAmount' => $currentTotalAmount]);
            return redirect()->route('listCart')->withErrors(['voucher_code' => 'Giỏ hàng không có sản phẩm.']);
        }

        $isValidForCart = false;
        $appliedProducts = [];

        foreach ($cartDetails as $item) {
            $variant = Variant::find($item->variant_id);
            if ($variant) {
                $productId = $variant->product_id;

                // Kiểm tra xem voucher có áp dụng cho sản phẩm này không
                if ($voucher->products()->where('products.id', $productId)->exists()) {
                    $isValidForCart = true;
                    $appliedProducts[] = $productId; // Thêm sản phẩm đã áp dụng voucher vào mảng
                }
            }
        }

        if (!$isValidForCart) {
            session()->forget('totalAmount');
            session(['totalAmount' => $currentTotalAmount]);
            return redirect()->route('listCart')->withErrors(['voucher_code' => 'Voucher không áp dụng cho sản phẩm trong giỏ hàng.']);
        }

        // Lưu voucher vào session
        session(['voucher_code' => $voucher->code]);

        // Tăng số lượt sử dụng của voucher
        $voucher->increment('used_count');

        // Lưu thông tin voucher đã sử dụng vào bảng UsedVouchers
        UserVoucher::create([
            'user_id' => auth()->id(),
            'voucher_id' => $voucher->id,
        ]);

        // Tính tổng số tiền với giảm giá
        $totalAmount = $this->calculateTotal($cartDetails, $voucher);
        session(['totalAmount' => $totalAmount]); // Lưu tổng vào session

        return redirect()->route('listCart')->with('success', 'Voucher đã được áp dụng!');
    }

protected function calculateTotal($cartDetails, $voucher)
{
    $totalPriceWithVoucher = 0;
    $totalDiscount = 0;
    $totalPriceWithoutVoucher = 0;

    foreach ($cartDetails as $item) {
        if (!$item->variant) {
            continue; // Bỏ qua nếu không có variant
        }

        $product = $item->variant->product;

        if (!$product) {
            continue; // Bỏ qua nếu không có product
        }

        $itemTotal = $item->quantity * $item->variant->price_modifier;

        // Kiểm tra xem voucher có áp dụng cho sản phẩm này không
        if ($voucher && $voucher->products()->where('products.id', $product->id)->exists()) {
            // Tính toán giảm giá cho sản phẩm có voucher
            $discountAmount = 0;

            if ($voucher->discount_amount) {
                $discountAmount = $voucher->discount_amount * $item->quantity;
            } elseif ($voucher->discount_percent) {
                $discountAmount = $itemTotal * ($voucher->discount_percent / 100);
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

