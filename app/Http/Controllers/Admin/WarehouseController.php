<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\StockMovement;
use App\Models\User;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class WarehouseController extends Controller
{
    public function index()
    {
        $history = StockMovement::query()->with('variant', 'user')->get();
        // dd($history);
        return view('admin.warehouses.index', compact('history'));
    }
    public function create()
    {
        $products = Product::with([
            'variants.attributes' => function ($query) {
                $query->with('attribute', 'attributeValue');
            }
        ])->get();
        $user = User::pluck('name', 'id')->all();
        return view('admin.warehouses.create', compact('products', 'user'));
    }

    public function export()
    {
        $products = Product::with([
            'variants.attributes' => function ($query) {
                $query->with('attribute', 'attributeValue');
            }
        ])->get();
        $user = User::pluck('name', 'id')->all();
        return view('admin.warehouses.export', compact('products', 'user'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        try {
            DB::transaction(function () use ($request) {
                $Data = $request->validate([
                    'variant_id' => 'required',
                    'user_id' => 'required',
                    'quantity' => 'required',
                    'wholesale_price' => 'required',
                    'Total_import_price' => 'required',
                    'Total_import_price_raw' => 'required',
                    'note' => 'required',
                    'type' => 'required'
                ]);
                $variant = Variant::query()->findOrFail($request->variant_id);
                if ($request->wholesale_price > $variant->price_modifier) {
                    throw new \Exception('Giá nhập phải thấp hơn giá bán');
                }

                $warehouses = StockMovement::create($Data);
                $variant = $warehouses->variant;
                $variant->update([
                    'stock' => $variant->stock + $request->quantity,
                    'wholesale_price' => $request->wholesale_price
                ]);

            }, 3);
            return redirect()->route('warehouses.index')->with('success', 'Nhập kho thành công!');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return back()->with('error', 'Có lỗi xảy ra khi nhập kho: ' . $th->getMessage());
        }

    }
    public function show(string $id)
    {
        $showHistory = StockMovement::findOrFail($id);
        $showHistory->load(['variant', 'user']);
        // dd($showHistory);
        return view('admin.warehouses.show', compact('showHistory'));
    }
}
