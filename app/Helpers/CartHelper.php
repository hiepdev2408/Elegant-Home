<?php
use Illuminate\Support\Facades\Auth;

if (!function_exists('getCartItemCount')) {
    function getCartItemCount(): int
    {
        // Logic đếm số lượng trong giỏ hàng
        return \App\Models\CartDetail::query()
            ->where('cart_id', function ($query) {
                $query->select('id')
                    ->from('carts')
                    ->where('user_id', Auth::id())
                    ->limit(1);
            })
            ->count();
    }
}
