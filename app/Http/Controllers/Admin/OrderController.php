<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\ReturnOrder;
use App\Models\Shipping;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::query();
        if ($request->filled('order_id')) {
            $query->where('id', $request->order_id);
        }

        if ($request->filled('customer_name')) {
            $query->where('user_name', 'like', '%' . $request->customer_name . '%');
        }

        if ($request->filled('status_order')) {
            $query->where('status_order', $request->status_order);
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function detail($id)
    {
        $order = Order::query()->with(
            'orderDetails',
            'user'
        )->findOrFail($id);
        // dd($order);
        $events = Shipping::where('order_id', $id)->orderBy('created_at', 'DESC')->get();
        $rufund = ReturnOrder::where('order_id', $id)->first();
        // dd($events);
        return view('admin.orders.detail', compact('order', 'events', 'rufund'));
    }

    public function confirmed($id)
    {
        $order = Order::query()->findOrFail($id);
        if ($order->status_order !== 'canceled') {
            $order->update([
                'status_order' => 'confirmed',
            ]);
            Shipping::create([
                'order_id' => $order->id,
                'name' => 'Đơn hàng đã được xác nhận'
            ]);
        } else {
            return back()->with('error', 'Xác nhận đơn hàng thất bại!');
        }
        return back()->with('success', 'Đơn hàng đã được xác nhận!');
    }

    public function shipping($id)
    {
        $order = Order::findOrFail($id);

        if ($order->status_order === 'confirmed') {
            $order->update([
                'status_order' => 'shipping',
            ]);
            Shipping::create([
                'order_id' => $order->id,
                'name' => 'Chờ giao hàng'
            ]);
        } else {
            return back()->with('error', 'Cập nhật trạng thái thất bại!');
        }
        return back()->with('success', 'Cập nhật trạng thái chờ giao hàng!');
    }

    public function delivered($id)
    {
        $order = Order::findOrFail($id);

        if ($order->status_order === 'shipping') {
            $order->update([
                'status_order' => 'delivered',
            ]);
            Shipping::create([
                'order_id' => $order->id,
                'name' => 'Đang giao hàng'
            ]);
        } else {
            return back()->with('error', 'Cập nhật trạng thái thất bại!');
        }
        return back()->with('success', 'Cập nhật trạng thái đang giao hàng!');
    }
    public function return_request($id)
    {
        $order = Order::findOrFail($id);
        if ($order->status_order === 'return_request') {
            $order->update([
                'status_order' => 'return_approved',
            ]);
            Shipping::create([
                'order_id' => $order->id,
                'name' => 'Yêu cầu trả hàng được xác nhận'
            ]);
        } else {
            return back()->with('error', 'Cập nhật trạng thái thất bại!');
        }
        return back()->with('success', 'Cập nhật trạng thái trả hàng!');
    }
    public function returned_item_received($id)
    {
        $order = Order::findOrFail($id);
        if ($order->status_order === 'return_approved') {
            $order->update([
                'status_order' => 'returned_item_received',
            ]);
            Shipping::create([
                'order_id' => $order->id,
                'name' => 'Kiểm tra hàng hoàn'
            ]);
        } else {
            return back()->with('error', 'Cập nhật trạng thái thất bại!');
        }
        return back()->with('success', 'Cập nhật trạng thái kiểm tra hàng hoàn!');
    }
    public function refund_completed($id)
    {
        $order = Order::findOrFail($id);
        if ($order->status_order === 'returned_item_received') {
            $order->update([
                'status_order' => 'refund_completed',
            ]);
            Shipping::create([
                'order_id' => $order->id,
                'name' => 'Đã hoàn tiền'
            ]);

        } else {
            return back()->with('error', 'Hoàn tiền thất bại!');
        }
        return back()->with('success', 'Hoàn tiền thành công!');
    }
}
