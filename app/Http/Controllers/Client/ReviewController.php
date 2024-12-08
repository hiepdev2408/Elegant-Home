<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    //
    public function show($id)
    {
        $product = Product::with(['reviews'])->findOrFail($id);
        $hasPurchased = false;

        if (Auth::check()) {
            $hasPurchased = Order::where('user_id', Auth::id())
                ->where('status', 'completed') // Kiểm tra nếu đơn hàng đã hoàn thành
                ->whereHas('orderItems', function ($query) use ($id) {
                    $query->where('product_id', $id);
                })->exists();
        }

        return view('products.show', compact('product', 'hasPurchased'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|between:1,5',
            'comment' => 'nullable|string|max:255',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Đánh giá đã được gửi.');
    }
}
