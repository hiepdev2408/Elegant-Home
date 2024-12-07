<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Order;
use App\Models\Province;
use App\Models\Ward;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    const PATH_VIEW = 'client.auth.smember.';
    public function profile()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    public function policy()
    {
        return view('client.policy.policy');
    }

    public function order()
    {
        $orders = Order::query()->with('user', 'orderDetails')->where('user_id', Auth::user()->id)->latest('id')->get();
        $countOrder = $orders->where('status_order', '!=', 'canceled')->count();
        return view('client.auth.smember.order', compact('orders', 'countOrder'));
    }

    public function showDetailOrder($id)
    {
        $order = Order::query()->findOrFail($id);

        return view('client.auth.smember.showDetailOrder', compact('order'));
    }


    public function cancel(Request $request, $id)
    {
        // dd($request->all());
        $order = Order::query()->findOrFail($id);
        if ($order->status_order === 'pending') {
            $order->update([
                'status_order' => 'canceled',
            ]);
        } else {
            return back()->with('error', 'Hủy đơn hàng thất bại!');
        }
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
    public function return_request(Request $request, $id)
    {
        $order = Order::query()->findOrFail($id);
        $receivedDate = $order->updated_at;
        if (Carbon::parse($receivedDate)->addDays(7)->isPast()) {
            return back()->with('error', 'Đơn hàng đã quá thời hạn 7 ngày kể từ khi nhận hàng, không thể yêu cầu trả hàng.');
        } else {
            $order->update([
                'status_order' => 'return_request',
            ]);
        }
        return back()->with('success', 'Yêu cầu trả hàng của bạn đã được gửi.');
    }

    public function endow()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }
    public function info()
    {
        return view('client.auth.smember.info');
    }

    public function showProfile()
    {
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
