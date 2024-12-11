<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Vouchers;
use App\Traits\TraitCRUD;
use Illuminate\Http\Request;

class VouchersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vouchers = Vouchers::all();
        return view('admin.vouchers.index', compact('vouchers'));
    }

    public function create()
    {
        return view('admin.vouchers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|unique:vouchers,code',
            'discount_value' => 'required|numeric|min:0',
            'discount_type' => 'required|in:money,percentage',
            'quantity' => 'required|integer|min:1',
            'minimum_order_value' => 'nullable|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'used' => 'nullable|integer|min:0',
        ]);

        Vouchers::create($request->all());

        return redirect()->route('vouchers.index')->with('success', 'Thêm mới thành công.');
    }

    public function show($id)
    {
        $voucher = Vouchers::findOrFail($id);
        return view('admin.vouchers.show', compact('voucher'));
    }

    public function edit($id)
    {
        $voucher = Vouchers::findOrFail($id);
        return view('admin.vouchers.edit', compact('voucher'));
    }

    public function update(Request $request, $id)
    {
    
        $request->validate([
            'code' => 'required|string|max:255|unique:vouchers,code,' . $id,
            'discount_value' => 'required|numeric|min:0',
            'discount_type' => 'required|in:money,percentage',
            'quantity' => 'required|integer|min:1',
            'minimum_order_value' => 'nullable|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'used' => 'nullable|integer|min:0',
        ]);
    
        $voucher = Vouchers::findOrFail($id);
        
        $voucher->update($request->only([
            'code',
            'discount_value',
            'discount_type',
            'quantity',
            'minimum_order_value',
            'start_date',
            'end_date',
            'used'
        ]));
    
        return redirect()->route('vouchers.index')->with('success', 'Cập nhật voucher thành công!');
    }

    
    public function destroy($id)
    {
        $voucher = Vouchers::findOrFail($id);
        $voucher->delete();

        return redirect()->route('vouchers.index')->with('success', 'Xóa thành công.');
    }
}
