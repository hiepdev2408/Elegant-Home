<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Order;
use App\Models\Province;
use App\Models\Shipping;
use App\Models\User;
use App\Models\Ward;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        $events = Shipping::where('order_id', $id)->orderBy('created_at', 'DESC')->get();
        return view('client.auth.smember.showDetailOrder', compact('order', 'events'));
    }


    public function cancel(Request $request, $id)
    {
        // dd($request->all());
        $order = Order::query()->findOrFail($id);
        if ($order->status_order === 'pending') {
            $order->update([
                'status_order' => 'canceled',
            ]);
            Shipping::create([
                'order_id' => $order->id,
                'name' => 'Đơn hàng đã bị hủy',
                'note' => 'Khách hàng đã hủy đơn hàng'
            ]);
        } else {
            return back()->with('error', 'Hủy đơn hàng thất bại!');
        }
        return back()->with('success', 'Đơn hàng đã hủy thành công!');
    }

    public function admin_cancel(Request $request, $id)
    {

        try {
            $request->validate([
                'note' => 'required'
            ], [
                'note.required' => 'Vui lòng nhập thông tin hoàn tiền'
            ]);

            $order = Order::query()->findOrFail($id);
            if ($order->status_order === 'admin_canceled') {
                $order->update([
                    'status_order' => 'sent_information',
                ]);
                // dd($order);
                Shipping::create([
                    'order_id' => $order->id,
                    'name' => 'Thông tin hoàn tiền',
                    'note' => $request->note
                ]);
            } else {
                return back()->with('error', 'Gửi thông tin hoàn tiền thất bại!');
            }
            return back()->with('success', 'Gửi thông tin hoàn tiền thành công!');
        } catch (\Throwable $th) {
            return back()->with('error', 'Gửi thông tin hoàn tiền thất bại!');
        }

    }
    public function completed(Request $request, $id)
    {
        $order = Order::query()->findOrFail($id);
        if ($order->status_order === 'delivered') {
            $order->update([
                'status_order' => 'completed',
                'status_payment' => 'Paid'
            ]);
            Shipping::create([
                'order_id' => $order->id,
                'name' => 'Giao hàng thành công',
                'note' => 'Khách hàng đã nhận được hàng'
            ]);
        } else {
            return back()->with('error', 'Cập nhật trạng thái thất bại!');
        }
        return back()->with('success', 'Cập nhật trạng thái đã nhận hàng!');
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
            Shipping::create([
                'order_id' => $order->id,
                'name' => 'Yêu cầu trả hàng',
                'note' => 'Yêu cầu trả hàng / hoàn tiền'
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

    public function showProfile(Request $request, $id)
    {
        $user = User::findOrFail($id); // Lấy thông tin người dùng

        // Lấy danh sách tỉnh, quận, xã/phường
        $provinces = Province::all()->pluck('name', 'code');
        $districts = District::where('province_code', $user->province_id)->pluck('full_name', 'code');
        $wards = Ward::where('district_code', $user->district_id)->pluck('name', 'code');

        return view('client.auth.smember.showProfile', compact('user', 'provinces', 'districts', 'wards'));
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
        // Lấy người dùng theo ID
        $user = User::findOrFail($id);

        // Xác thực dữ liệu
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Quy tắc xác thực cho ảnh
        ]);

        // Cập nhật thông tin người dùng
        $user->name = $request->name;
        $user->email = $request->email;

        // Xử lý file ảnh đại diện nếu có
        if ($request->hasFile('avatar')) {
            // Xóa ảnh cũ nếu có
            if ($user->avatar) {
                Storage::delete($user->avatar); // Xóa file cũ
            }
            // Lưu ảnh mới
            $user->avatar = $request->file('avatar')->store('avatars', 'public');
        }

        // Lưu thay đổi
        $user->save();

        // Chuyển hướng về trang thông tin người dùng
        return redirect()->route('profile.info', ['id' => $user->id])
            ->with('success', 'Thông tin đã được cập nhật.');
    }
}
