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

class OrderController extends Controller
{

    public function index()
    {
        $provinces = Province::pluck('name', 'code');

        $user = Auth::user();
        $cart = Cart::firstWhere('user_id', $user->id);

        $cartDetails = $cart ? CartDetail::where('cart_id', $cart->id)->get() : collect();
        $totalAmount = $cartDetails->sum('total_amount');

        return view('client.order.info', [
            'user' => $user,
            'cart' => $cart,
            'cartDetails' => $cartDetails,
            'totalAmount' => $totalAmount,
            'provinces' => $provinces,
        ]);
    }

    public function getDistrictsByProvince($provinceCode)
    {
        $districts = District::where('province_code', $provinceCode)->pluck('name', 'code');
        return response()->json($districts);
    }

    public function getWardsByDistrict($districtCode)
    {
        $wards = Ward::where('district_code', $districtCode)->pluck('name', 'code');
        return response()->json($wards);
    }

    public function applyVoucher(Request $request)
    {
        // Xác thực dữ liệu
        $request->validate([
            'voucher_code' => 'required|string',
            'total_amount' => 'required|numeric|min:0',
        ]);
    
        // Kiểm tra voucher
        $voucher = Vouchers::where('code', $request->voucher_code)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->first();
    
        if (!$voucher) {
            // Xóa tất cả thông tin liên quan đến voucher trong session
            session()->forget(['voucher_code', 'discount_amount', 'totalAmount']);
    
            return response()->json([
                'message' => 'Voucher không hợp lệ hoặc đã hết hạn.',
                'total' => number_format($request->total_amount, 0, ',', '.') . ' VNĐ'
            ], 400);
        }
        if ($voucher->used >= $voucher->quantity) {
            return response()->json([
                'message' => 'Voucher đã được sử dụng hết.',
                'total' => number_format($request->total_amount, 0, ',', '.') . ' VNĐ'
            ], 400);
        }
    
        // Kiểm tra giá trị tối thiểu
        if ($request->total_amount < $voucher->minimum_order_value) {
            return response()->json(['message' => 'Giá trị đơn hàng không đủ để áp dụng voucher.'], 400);
        }
    
        // Tính toán giảm giá
        $discount = ($voucher->discount_type === 'money')
            ? $voucher->discount_value
            : ($request->total_amount * $voucher->discount_value / 100);
    
        // Đảm bảo giảm giá không vượt quá tổng giá trị đơn hàng
        $discount = min($discount, $request->total_amount);
    
        session(['voucher_code' => $voucher->code, 'discount_amount' => $discount, 'totalAmount' => $request->total_amount - $discount]);

        $message = 'Voucher đã được áp dụng thành công.'.'<br>'.'';
        $message .= 'Bạn đã giảm được :' . number_format($discount, 0, ',', '.') . ' VNĐ.'.'<br>'.'';

        if ($voucher->discount_type === 'money') {
            $message .= ' Loại giảm giá: Tiền mặt ';
        } else {
            $message .= ' Loại giảm giá: Phần trăm- ' . $voucher->discount_value . '%';
        }
        return response()->json([
            'message' => $message,
            'total' => number_format($request->total_amount - $discount, 0, ',', '.') . ' VNĐ'
        ]);
    }

}

    
