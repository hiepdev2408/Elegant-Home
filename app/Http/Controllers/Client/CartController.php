<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
            $cart = Cart::firstOrCreate(['user_id' => 1]);
            $cartItem = $cart->cartDetails()->create([
                'cart_id' => $cart->id,
                'product_id' => $request->product_id,
                'variant_id' => 8,
                'quantity' => $request->quantity,
                'total_amount' => $request->total_amount * $request->quantity
            ]);
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
        $request->validate([
            'cart_id' => 'required|exists:carts,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cartDetail = CartDetail::where('cart_id', $request->cart_id)->first();

        if ($cartDetail) {
            $cartDetail->quantity = $request->quantity;
            $cartDetail->save();
            return response()->json(['success' => true, 'message' => 'Cập nhật thành công!']);
        }

        return response()->json(['success' => false, 'message' => 'Có lỗi xảy ra!'], 500);
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
