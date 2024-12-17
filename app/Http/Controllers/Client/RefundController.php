<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

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
        dd($request->all());
    }
}
