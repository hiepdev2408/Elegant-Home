<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TopSellController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $type = $request->input('type', 'day');
        $date = $request->input('date', Carbon::today()->format('Y-m-d'));
        // Xử lý thống kê
        switch($type) {
            case 'month':
                $topProduct = OrderDetail::with('product')
                    ->select('product_id', DB::raw('SUM(quantity) as tong_so_luong'))
                    ->whereYear('created_at', Carbon::parse($date)->year)
                    ->whereMonth('created_at', Carbon::parse($date)->month)
                    ->groupBy('product_id')
                    ->orderBy('tong_so_luong', 'desc')
                    ->take(10)
                    ->get();
                break;
            case 'year':
                $topProduct = OrderDetail::with('product')
                    ->select('product_id', DB::raw('SUM(quantity) as tong_so_luong'))
                    ->whereYear('created_at', Carbon::parse($date)->year)
                    ->groupBy('product_id')
                    ->orderBy('tong_so_luong', 'desc')
                    ->take(10)
                    ->get();
                break;
            default:
                $topProduct = OrderDetail::with('product')
                    ->select('product_id', DB::raw('SUM(quantity) as tong_so_luong'))
                    ->whereDate('created_at', Carbon::parse($date)->format('Y-m-d'))
                    ->groupBy('product_id')
                    ->orderBy('tong_so_luong', 'desc')
                    ->take(10)
                    ->get();
                break;
        }

        return view('admin.top_sell.index', compact('topProduct', 'type', 'date'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
