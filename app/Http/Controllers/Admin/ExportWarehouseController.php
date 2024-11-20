<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\warehouse;
use App\Models\warehouseExport;
use Illuminate\Http\Request;

class ExportWarehouseController extends Controller
{
    public function index()
    {
        $warehouseExport = warehouseExport::with('warehouse', 'user')->get();

        return view('admin.exportwarehouses.index', compact('warehouseExport'));
    }
    public function create()
    {
        $products = warehouse::with('product')->get();
        $user = auth()->user(); //lấy người dùng hiện tại
        return view('admin.exportwarehouses.create', compact('products', 'user'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'quantity' => 'required',
            'Shipment_date' => 'required|date',
            'note' => 'nullable|string',
        ]);

        $warehouseExport = $request->only('warehouse_id', 'quantity', 'Shipment_date', 'note');
        $warehouseExport['user_id'] = auth()->user()->id; // Gán user_id từ người dùng hiện tại
        $warehouse = warehouse::findOrFail($request->warehouse_id);

        // Kiểm tra số lượng còn trong kho
        if ($request->quantity > $warehouse->quantity) {
            return back()->withErrors(['quantity' => 'Số lượng xuất không được lớn hơn số lượng hàng trong kho.'])->withInput();
        }

        warehouseExport::create($warehouseExport);
        //update số lượng hàng còn trong kho
        $warehouse->update([
            'quantity' => $warehouse->quantity - $request->quantity,
        ]);
        return redirect()->route('exportwarehouses.index')->with('success','Xuất đơn hàng thành công');
    }
    public function show(string $id){
          $warehouseExport=warehouseExport::with(['warehouse','user'])->findOrFail($id);
          return view('admin.exportwarehouses.show', compact('warehouseExport'));

    }
}
