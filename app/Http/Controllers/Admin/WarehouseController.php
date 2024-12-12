<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\StockMovement;
use App\Models\User;
use App\Models\warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index()
    {
        $warehouses = warehouse::with('product', 'user')->get();
        return view('admin.warehouses.index', compact('warehouses'));
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
        $request->validate([
            'variant_id' => 'required',
            'user_id' => 'required',
            'quantity' => 'required',
            'wholesale_price' => 'required',
            'Total_import_price' => 'required',
            'note' => 'required',
            'type' => 'required'
        ]);

        $Data = $request->only('variant_id', 'user_id', 'quantity', 'wholesale_price', 'Total_import_price', 'note', 'type');

        StockMovement::create($Data);
        return redirect()->route('warehouses.index');
    }
    // public function show(string $id)
    // {
    //     $warehouse = Warehouse::findOrFail($id);
    //     $warehouse->load(['product', 'user']);
    //     return view('admin.warehouses.show', compact('warehouse'));
    // }
}
