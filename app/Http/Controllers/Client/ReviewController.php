<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);
        $co_mua = false;
        if (Auth::check()) {
            $co_mua = Order::where('user_id', Auth::id())
            ->where('status_order', 'completed') // Trạng thái hoàn thành
            ->exists();
        }
        if (!$co_mua) {
            return redirect()->back()->with('error', 'Bạn phải nhận hàng trước khi đánh giá.');
        }

        $thoat_danh_gia = Review::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($thoat_danh_gia) {
            return redirect()->back()->with('error', 'Bạn đã đánh giá sản phẩm này rồi.');
        }

        // Tạo đánh giá mới
        Review::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Đánh giá của bạn thành công.');
    }
}
