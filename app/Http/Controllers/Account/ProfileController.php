<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    const PATH_VIEW = 'client.auth.smember.';
    public function profile()
    {
        $user = Auth::user();
        return view(self::PATH_VIEW . __FUNCTION__, compact('user'));
    }

    public function order()
    {
<<<<<<< HEAD
        $totalCart = getCartItemCount();
        $orders = Order::query()->where('user_id', Auth::user()->id)->get();
        $orderDetails = OrderDetail::query()
            ->whereIn('order_id', $orders->pluck('id')->toArray())
            ->paginate(5);

        return view('client.auth.account.order', compact('totalCart', 'orderDetails'));
    }

    public function showDetailOrder($id)
    {
        // Tổng số lượng sản phẩm trong giỏ hàng
        $totalCart = getCartItemCount();

        // Lấy thông tin chi tiết đơn hàng
        $orderDetails = OrderDetail::with(['order', 'variant', 'product'])
            ->whereHas('order', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->findOrFail($id);

        $cart = Cart::where('user_id', Auth::id())->first();

        return view('client.auth.account.showDetailOrder', compact('totalCart', 'orderDetails', 'cart'));
    }


    public function cancel(Request $request, $id)
    {
        $orderDetails = OrderDetail::findOrFail($id);
        // dd($orderDetails);
        try {
            DB::transaction(function () use ($request, $orderDetails) {
                $orderDetails->order()->update([
                    'status_order' => 'canceled',
                ]);
            });

            return back()->with('success', 'Hủy đơn hàng thành công!');
        } catch (\Throwable $th) {
            //throw $th;
        }
=======
        return view(self::PATH_VIEW . __FUNCTION__);
>>>>>>> cfd09edf8d2ed8539bea57ca6c3ee303ea165442
    }

    public function endow()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }
    public function info()
    {
        return view('client.auth.smember.info');
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $user = User::findOrFail($id);

        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users,email,'.$id,
        //     'phone' => 'nullable|string|max:15',
        //     'address' => 'nullable|string|max:255',
        //     'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        // ]);

        $auth = $request->except('avatar');

        $currentAvatar = 'user/' . $request->avatar;

        if ($request->hasFile('avatar')) {
            $auth['avatar'] = Storage::put('user', $request->file('avatar'));
        }
        $user->update($auth);

        if ($currentAvatar && Storage::exists($currentAvatar)) {
            Storage::delete($currentAvatar);
        }
        return redirect()->back()->with('success', 'Thông tin đã được cập nhật!');
    }
}
