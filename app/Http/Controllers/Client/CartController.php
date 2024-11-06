<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use function Laravel\Prompts\alert;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::query()->with('cartDetails.variant')->where('user_id', 1)->get();
        return view('Client.cart.listCart', compact('carts'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        try {
            // $user = Auth::user();

            // Tạo giỏ hàng mới nếu chưa có, hoặc lấy giỏ hàng hiện tại của user
            $variant_id = 8;
            $cart = Cart::firstOrCreate(['user_id' => 1]);

            // Kiểm tra xem sản phẩm với variant_id có tồn tại trong giỏ hàng hay không
            $cartItem = $cart->cartDetails()
                ->where('variant_id', $variant_id)
                ->first();

            if ($cartItem) {
                // Nếu sản phẩm với variant_id đã tồn tại trong giỏ hàng, cộng thêm số lượng
                $cartItem->quantity += $request->quantity;
                $cartItem->total_amount += $request->total_amount * $request->quantity;
                $cartItem->save();
            } else {
                // Nếu sản phẩm chưa tồn tại, tạo mới cart item
                $cartItem = $cart->cartDetails()->create([
                    'product_id' => $request->product_id,
                    'variant_id' => 8,
                    'quantity' => $request->quantity,
                    'total_amount' => $request->total_amount * $request->quantity,
                ]);
            }
            return back();

        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // dd($request->all());
        $cartItem = CartDetail::find($request->cart_id);
        if (!$cartItem) {
            echo '<script>alert("Sản phẩm không tồn tại");</script>';
        }

        // Cập nhật số lượng và tổng giá của sản phẩm trong giỏ hàng
        $cartItem->quantity = $request->quantity;
        $cartItem->total_amount = $request->price_sale * $cartItem->quantity;
        $cartItem->save();

        return back();
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cart = CartDetail::query()->find($id);
        $cart->delete();
        return back();
    }
}
