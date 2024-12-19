<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\ReturnOrder;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RefundController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function refund(string $id)
    {
        $order = Order::query()->findOrFail($id);
        // dd($order);
        return view('client.auth.smember.refund', compact('order'));
    }

    public function refundRequests(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'order_id' => 'required',
            'reason' => 'required',
            'total_amount' => 'required',
            'refund_on' => 'required',
            'note' => 'required',
            'email' => 'required',
        ], [
            'reason.required' => 'Vui lòng chọn lý do hoàn tiền',
            'total_amount.required' => 'Số tiền hoàn không hợp lệ',
            'refund_on.required' => 'Vui lòng nhập nơi nhận hoàn',
            'note.required' => 'Vui lòng nhập lý do chi tiết',
            'email.required' => 'Vui lòng nhập email',
        ]);
        $data['user_id'] = Auth::id();
        $order = Order::query()->findOrFail($data['order_id']);
        $order->update([
            'status_order' => 'return_request',
        ]);
        Shipping::create([
            'order_id' => $order->id,
            'name' => 'Yêu cầu trả hàng'
        ]);
        ReturnOrder::create($data);
        return redirect()->route('profile.order')->with('success', 'Yêu cầu trả hàng của bạn đã được gửi.');

    }
}
