<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\District;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Province;
use App\Models\User;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    const PATH_VIEW = 'client.auth.smember.';
    public function profile()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    public function order()
    {
        $orders = Order::query()->where('user_id', Auth::user()->id)->get();
        $countOrder = $orders->where('status_order', '!=', 'canceled')->count();

        return view('client.auth.smember.order', compact('orders', 'countOrder'));
    }

    public function showDetailOrder($id)
    {
        // Lấy thông tin chi tiết đơn hàng
        $orderDetails = OrderDetail::with(['order', 'variant', 'product'])
            ->whereHas('order', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->findOrFail($id);
        $cart = Cart::where('user_id', Auth::id())->first();

        return view('client.auth.smember.showDetailOrder', compact('orderDetails', 'cart'));
    }


    public function cancel(Request $request, $id)
    {
        $order = Order::query()->findOrFail($id);
        $order->update([
            'status_order' => 'canceled',
        ]);

        return back()->with('success', 'Đơn hàng đã hủy thành công!');
    }
    public function completed(Request $request, $id)
    {
        $order = Order::query()->findOrFail($id);
        $order->update([
            'status_order' => 'completed',
        ]);

        return back();
    }

    public function endow()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }
    public function info()
    {
        return view('client.auth.smember.info');
    }

    public function showProfile(){
        $user = Auth::user();
        $provinces = Province::pluck('name', 'code')->all();

        return view('client.auth.smember.showProfile', compact('user', 'provinces'));
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

    public function update(Request $request, $id)
    {
        dd($request->all());
    }
}
