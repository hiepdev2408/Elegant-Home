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
    // Hiển thị danh sách tất cả các voucher
    public function index()
    {
        $vouchers = Vouchers::with('products')->get();
        return view('admin.vouchers.index', compact('vouchers'));
    }

    // Hiển thị form để tạo voucher mới
    public function create()
    {
        $products = Product::all();
        return view('admin.vouchers.create', compact('products'));
    }

    // Lưu voucher mới vào cơ sở dữ liệu
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|unique:vouchers,code',
            'discount_amount' => 'nullable|numeric|min:0',
            'discount_percent' => 'nullable|numeric|min:0|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'usage_limit' => 'nullable|integer|min:0',
            'products' => 'required|array', 
            'products.*' => 'exists:products,id', // Kiểm tra sự tồn tại của các sản phẩm
        ]);
    
        $voucher = Vouchers::create($request->all());
    
        // Gắn các sản phẩm vào voucher qua bảng product_voucher
        $voucher->products()->attach($request->products);
    
        return redirect()->route('vouchers.index')->with('success', 'Voucher created successfully.');
    }

    // Hiển thị chi tiết một voucher
    public function show($id)
    {
        $voucher = Vouchers::findOrFail($id);
        return view('admin.vouchers.show', compact('voucher'));
    }

    // Hiển thị form để chỉnh sửa một voucher
    public function edit($id)
    {
        $products = Product::all();
        $voucher = Vouchers::findOrFail($id);
        return view('admin.vouchers.edit', compact('voucher','products'));
    }

    // Cập nhật thông tin voucher
    public function update(Request $request, $id)
    {
       // Xác thực dữ liệu đầu vào
       $request->validate([
        'code' => 'required|string|max:255',
        'discount_amount' => 'nullable|numeric|min:0',
        'discount_percent' => 'nullable|numeric|min:0|max:100',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'usage_limit' => 'nullable|integer|min:0',
        'products' => 'array', // Có thể không chọn sản phẩm
        'products.*' => 'exists:products,id', // Kiểm tra từng ID sản phẩm
    ]);

    // Tìm voucher theo ID
    $voucher = Vouchers::findOrFail($id);

    // Cập nhật thông tin voucher
    $voucher->update($request->only(['code', 'discount_amount', 'discount_percent', 'start_date', 'end_date', 'usage_limit']));

    // Cập nhật sản phẩm áp dụng voucher
    $voucher->products()->sync($request->input('products', [])); // Gán lại sản phẩm

    // Chuyển hướng về trang danh sách với thông báo thành công
    return redirect()->route('vouchers.index')->with('success', 'Voucher đã được cập nhật thành công!');
}
    

    // Xóa một voucher
    public function destroy($id)
    {
        $voucher = Vouchers::findOrFail($id);
        $voucher->delete();
        return redirect()->route('vouchers.index')->with('success', 'Voucher deleted successfully.');
    }
}
