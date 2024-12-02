<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
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

    public function confirmed($id){
        $order = Order::findOrFail($id);

        $order->update([
            'status_order' => 'confirmed',
        ]);

        return back();
    }
    public function shipping($id){
        $order = Order::findOrFail($id);

        $order->update([
            'status_order' => 'shipping',
        ]);

        return back();
    }
    public function delivered($id){
        $order = Order::findOrFail($id);

        $order->update([
            'status_order' => 'delivered',
        ]);

        return back();
    }
}
