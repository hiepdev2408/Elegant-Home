<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Shipping;
use App\Models\UserVoucher;
use App\Models\Variant;
use App\Models\Vouchers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function vnpay(Request $request)
    {
        // Kiểm tra xác thực
        $user = Auth::id();
        if (!$user) {
            return response()->json(['error' => 'Người dùng chưa được xác thực'], 401);
        }
        // Lấy giỏ hàng
        $cart = Cart::with('cartDetails')->where('user_id', $user)->first();
        if (!$cart) {
            return response()->json(['error' => 'Không tìm thấy giỏ hàng'], 404);
        }
        // Lấy danh sách variant ID từ giỏ hàng
        $variantIds = $cart->cartDetails->pluck('variant_id')->toArray();
        $productIds = $cart->cartDetails->pluck('product_id')->toArray();

        // Lấy thông tin các variant hoặc sản phẩm liên quan
        if ($variantIds) {
            // Nếu có variant_id
            $variants = Variant::whereIn('id', $variantIds)->get()->keyBy('id');
        }

        if ($productIds) {
            // Nếu không có variant_id
            $variants = Variant::whereIn('id', $productIds)->get()->keyBy('id');
        }
        // dd($variants);

        // Kiểm tra tồn kho và xử lý
        foreach ($cart->cartDetails as $cartDetail) {
            $item = $variants->get($cartDetail->variant_id) ?? $variants->get($cartDetail->product_id);
            // Nếu không tìm thấy sản phẩm (variant hoặc product) hoặc tồn kho không đủ
            if (!$item || $item->stock < $cartDetail->quantity) {
                $cartDetail->delete(); // Xóa chi tiết giỏ hàng hiện tại

                // Kiểm tra nếu giỏ hàng không còn sản phẩm nào thì xóa giỏ hàng
                if ($cart->cartDetails()->count() === 0) {
                    $cart->delete(); // Xóa giỏ hàng
                }

                return redirect()->route('home')->with('alert', 'Sản phẩm không đủ tồn kho!');
            }
        }

        // Lấy tổng tiền từ session
        $totalAmount = $request->total_amount;
        // dd($totalAmount);
        if ($totalAmount <= 0) {
            return response()->json(['error' => 'Tổng số tiền không hợp lệ'], 400);
        }

        // Lưu voucher ID nếu có
        $voucherCode = session('voucher_code');
        $voucherId = null;

        if ($voucherCode) {
            $voucher = Vouchers::where('code', $voucherCode)
                ->where('end_date', '>=', now())
                ->first();

            if ($voucher && $voucher->used < $voucher->quantity) {
                $voucherId = $voucher->id; // Lưu voucher_id
            }
        }

        // Tạo đơn hàng mới
        try {
            $order = Order::create([
                'user_id' => $user,
                'user_name' => $request->user_name,
                'user_email' => $request->user_email,
                'user_phone' => $request->user_phone,
                'user_address' => $request->user_address,
                'user_address_all' => $request->user_address_all ?? '',
                'user_content' => $request->user_note ?? '',
                'is_ship_user_same_user' => $request->is_ship_user_same_user,
                'total_amount' => $totalAmount,
                'vouchers_id' => $voucherId, // Lưu voucher_id vào đơn hàng
            ]);
        } catch (\Exception $e) {
            Log::error('Lỗi khi tạo đơn hàng: ' . $e->getMessage());
            return response()->json(['error' => 'Lỗi khi tạo đơn hàng'], 500);
        }

        // Lưu chi tiết đơn hàng
        foreach ($cart->cartDetails as $cartDetails) {
            try {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $cartDetails->product_id,
                    'variant_id' => $cartDetails->variant_id,
                    'quantity' => $cartDetails->quantity,
                    'total_amount' => $cartDetails->total_amount,
                ]);
            } catch (\Exception $e) {
                Log::error('Lỗi khi tạo chi tiết đơn hàng: ' . $e->getMessage());
            }
        }

        // Trạng Thái đơn hàng
        try {
            Shipping::create([
                'order_id' => $order->id,
                'name' => 'Đơn hàng của bạn đã được đặt thành công'
            ]);
        } catch (\Exception $e) {
            Log::error('Lỗi khi tạo đơn hàng: ' . $e->getMessage());
        }

        // Tạo URL thanh toán VNPAY
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('vnpayReturn');
        $vnp_TmnCode = "5ATNWBPG"; // Mã website tại VNPAY
        $vnp_HashSecret = "09AIHOKAJ8PFFWLKALU26G698T5A2T59"; // Chuỗi bí mật

        $vnp_TxnRef = $order->id; // Sử dụng ID đơn hàng làm TxnRef
        $vnp_OrderInfo = 'Thanh toán hóa đơn';
        $vnp_OrderType = 'order_type';
        $vnp_Amount = $totalAmount * 100; // Chuyển đổi sang đồng
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $request->ip();

        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => now()->format('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        ];

        if (!empty($vnp_BankCode)) {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
            $hashdata .= ($hashdata ? '&' : '') . urlencode($key) . "=" . urlencode($value);
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (!empty($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        // Xóa session sau khi thanh toán
        session()->forget(['voucher_code', 'discount_amount', 'totalAmount']);

        // Chuyển hướng người dùng đến trang thanh toán VNPAY
        return redirect()->away($vnp_Url);
    }

    public function vnpayReturn(Request $request)
    {
        $vnp_HashSecret = "09AIHOKAJ8PFFWLKALU26G698T5A2T59"; // Chuỗi bí mật từ VNPAY
        $vnp_TxnRef = $request->vnp_TxnRef;
        $vnp_SecureHash = $request->vnp_SecureHash;

        // Kiểm tra thông tin trả về từ VNPAY
        $vnp_Params = $request->except('vnp_SecureHash'); // Lấy tất cả các tham số trả về từ VNPAY
        ksort($vnp_Params);

        $hashData = "";
        foreach ($vnp_Params as $key => $value) {
            $hashData .= urlencode($key) . "=" . urlencode($value) . "&";
        }

        $secureHash = hash_hmac('sha512', rtrim($hashData, "&"), $vnp_HashSecret);

        // Kiểm tra nếu mã hash hợp lệ và thanh toán thành công
        if ($secureHash === $vnp_SecureHash && $request->vnp_ResponseCode == '00') {
            // Thanh toán thành công
            // Xóa giỏ hàng

            $cart = Cart::where('user_id', Auth::id())->first();

            foreach ($cart->cartDetails as $cartDetail) {
                $variant = Variant::find($cartDetail->variant_id);
                if ($variant) {
                    $variant->decrement('stock', $cartDetail->quantity);
                }
            }

            if ($cart) {
                foreach ($cart->cartDetails as $cartDetails) {
                    $cartDetails->delete(); // Xóa chi tiết giỏ hàng
                }
                $cart->delete(); // Xóa giỏ hàng
            }

            // Cập nhật trạng thái đơn hàng
            $order = Order::find($vnp_TxnRef);
            if ($order) {
                $order->status_payment = 'Paid'; // Chuyển trạng thái thanh toán nếu thành công
                $order->save();
            }
            return redirect()->route('thank');
        } else if ($secureHash === $vnp_SecureHash && $request->vnp_ResponseCode == '24') {
            $order = Order::find($vnp_TxnRef);
            if ($order) {
                foreach ($order->orderDetails as $orderDetails) {
                    $orderDetails->delete(); // Xóa chi tiết đơn hàng
                }
                $order->delete(); // Xóa đơn hàng
            }
            return redirect()->route('error');
        } else {
            dd(1);
        }
    }

    public function momo(Request $request)
    {
        // dd($request->total_amount);
        try {
            $endpoint = "https://test-payment.momo.vn/gw_payment/transactionProcessor";
            $partnerCode = "MOMOBKUN20180529";
            $accessKey = "klm05TvNBzhg7h7j";
            $serectkey = "at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa";
            $orderInfo = "Thanh toán qua MoMo";
            $amount = $request->total_amount;
            $orderId = (string) rand(1000, 9999);
            $returnUrl = route('thank');
            $notifyUrl = route('notify');
            $bankCode = $request->input('bankCode', 'SML');

            $requestId = time() . "";
            $requestType = "captureMoMoWallet";
            $extraData = "";

            // Tạo chuỗi dữ liệu để ký
            $rawHash = "partnerCode=$partnerCode&accessKey=$accessKey&requestId=$requestId&amount=$amount&orderId=$orderId&orderInfo=$orderInfo&returnUrl=$returnUrl&notifyUrl=$notifyUrl&extraData=$extraData";

            $signature = hash_hmac("sha256", $rawHash, $serectkey);

            $data = [
                'partnerCode' => $partnerCode,
                'accessKey' => $accessKey,
                'requestId' => $requestId,
                'amount' => $amount,
                'orderId' => $orderId,
                'orderInfo' => $orderInfo,
                'returnUrl' => $returnUrl,
                'bankCode' => $bankCode,
                'notifyUrl' => $notifyUrl,
                'extraData' => $extraData,
                'requestType' => $requestType,
                'signature' => $signature,
            ];

            // Gửi yêu cầu tới API MoMo
            $result = $this->execPostRequest($endpoint, json_encode($data));
            $jsonResult = json_decode($result, true);

            if (isset($jsonResult['payUrl'])) {
                return redirect()->away($jsonResult['payUrl']); // Chuyển hướng đến URL thanh toán
            }
            return back()->with('error', 'Có lỗi xảy ra trong quá trình xử lý thanh toán.');
        } catch (\Throwable $th) {
            Log::error('MoMo payment error: ' . $th->getMessage());
            return back()->with('error', 'Payment processing failed. Please try again.');
        }
    }

    // Hàm hỗ trợ gửi yêu cầu POST
    private function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    public function notify(Request $request)
    {
    }

    public function cod(Request $request)
    {
        // dd($request->all());
        try {
            $user = Auth::user();
            $cart = Cart::query()->where('user_id', $user->id)->first();

            // Kiểm tra giỏ hàng
            if (!$cart || $cart->cartDetails->isEmpty()) {
                return redirect()->route('home')->with('error', 'Giỏ hàng của bạn đang trống.');
            }

            // Kiểm tra hàng tồn kho
            $variants = Variant::whereIn('id', $cart->cartDetails->pluck('variant_id'))->get();
            $outOfStockProducts = [];

            foreach ($cart->cartDetails as $cartDetails) {
                $variant = $variants->where('id', $cartDetails->variant_id)->first();
                if ($variant && $variant->stock < $cartDetails->quantity) {
                    $outOfStockProducts[] = $variant->product->name;
                    $cartDetails->delete(); // Xóa sản phẩm hết hàng khỏi giỏ
                }
            }

            if (!empty($outOfStockProducts)) {
                return redirect()->route('home')->with(
                    'error',
                    "Các sản phẩm sau đã hết hàng và đã bị xóa khỏi giỏ hàng: " . implode(', ', $outOfStockProducts) . "."
                );
            }

            $totalAmount = session('totalAmount') ?? $request->total_amount;
            // dd($totalAmount);

            DB::transaction(function () use ($cart, $request, $user, $totalAmount) {
                $voucherCode = session('voucher_code');
                $voucher = null;

                if ($voucherCode) {
                    $voucher = Vouchers::where('code', $voucherCode)
                        ->where('end_date', '>=', now())
                        ->first();
                }

                // Tạo đơn hàng
                $order = Order::create([
                    'user_id' => $user->id,
                    'user_name' => $request->user_name,
                    'user_email' => $request->user_email,
                    'user_phone' => $request->user_phone,
                    'user_address' => $request->user_address,
                    'user_address_all' => $request->user_address_all ?? '',
                    'user_content' => $request->user_note ?? '',
                    'is_ship_user_same_user' => $request->is_ship_user_same_user,
                    'total_amount' => $totalAmount, // Sử dụng tổng tiền từ session
                    'vouchers_id' => $voucher ? $voucher->id : null,
                ]);


                // Thêm chi tiết đơn hàng
                $orderDetails = $cart->cartDetails->map(function ($cartDetail) use ($order) {
                    return [
                        'order_id' => $order->id,
                        'product_id' => $cartDetail->product_id,
                        'variant_id' => $cartDetail->variant_id,
                        'quantity' => $cartDetail->quantity,
                        'total_amount' => $cartDetail->total_amount,
                    ];
                });

                OrderDetail::insert($orderDetails->toArray());

                // Cập nhật hàng tồn kho
                foreach ($cart->cartDetails as $cartDetail) {
                    $variant = Variant::find($cartDetail->variant_id);
                    if ($variant) {
                        $variant->decrement('stock', $cartDetail->quantity);
                    }
                }

                // Xử lý voucher
                if ($voucher) {
                    UserVoucher::create([
                        'user_id' => $user->id,
                        'voucher_id' => $voucher->id,
                    ]);
                    $voucher->increment('used');
                } else {
                    session()->forget('voucher_code'); // Xóa voucher không hợp lệ
                }

                // Xóa giỏ hàng
                $cart->cartDetails()->delete();
                $cart->delete();

                // Xóa session
                session()->forget(['totalAmount', 'voucher_code', 'discount_amount']);
            });

            return redirect()->route('thank')->with('success', 'Đơn hàng của bạn đã được đặt thành công!');
        } catch (\Exception $exception) {
            Log::error('Đặt hàng COD thất bại.', [
                'error' => $exception->getMessage(),
                'user_id' => $user->id ?? null,
                'cart_id' => $cart->id ?? null,
            ]);

            return redirect()->route('home')->with('error', 'Có lỗi xảy ra, vui lòng thử lại.');
        }
    }


    public function thank()
    {
        return view('client.order.checkout.thank');
    }

    public function error()
    {
        return view('client.order.checkout.error');
    }
}
