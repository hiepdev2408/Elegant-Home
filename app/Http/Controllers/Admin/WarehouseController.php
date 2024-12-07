<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use App\Models\warehouse;
use Carbon\Carbon;
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
    public function store(Request $request)
    {
        dd($request->all());
        $request->validate([
            'quantity' => 'required',
            'price_import' => 'required',
            'Total_amount' => 'required',
        ]);
        $warehouseData = $request->only('product_id', 'quantity', 'price_import', 'date_import', 'Date_manufacture', 'Total_amount');
        $warehouseData['user_id'] = auth()->user()->id;

        warehouse::create($warehouseData);
        return redirect()->route('warehouses.index');
    }
    public function show(string $id)
    {
        $warehouse = Warehouse::findOrFail($id);
        $warehouse->load(['product', 'user']);
        return view('admin.warehouses.show', compact('warehouse'));
    }
}
