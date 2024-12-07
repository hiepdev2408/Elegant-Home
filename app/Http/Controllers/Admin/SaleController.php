<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\Product;
use App\Traits\TraitCRUD;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with('products')->paginate(10); // Lấy danh sách với phân trang
        
        return view('admin.sales.index', compact('sales'));
    }

    // Hiển thị form tạo mới chương trình khuyến mãi
    public function create()
    {
        $products = Product::all(); // Lấy tất cả sản phẩm
        return view('admin.sales.create', compact('products'));
    }

    // Lưu chương trình khuyến mãi mới
    public function store(Request $request)
    {
        $request->validate([
            'discount_percentage' => 'required|numeric|min:0|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'products' => 'required|array', // Đảm bảo rằng products là mảng
            'products.*' => 'exists:products,id', // Kiểm tra từng ID sản phẩm
        ]);
    
        // Lấy ngày hiện tại
        $currentDate = Carbon::now();
    
        // Kiểm tra xem có chương trình khuyến mãi nào vẫn còn hiệu lực không
        $activeSales = Sale::where('start_date', '<=', $currentDate)
                           ->where('end_date', '>=', $currentDate)
                           ->get();
    
        if ($activeSales->isNotEmpty()) {
            // Nếu có chương trình khuyến mãi đang diễn ra
            return redirect()->route('sales.index')->with('message', 'Vẫn còn chương trình khuyến mãi đang diễn ra.')->withInput();
        }
    
        // Nếu không có chương trình khuyến mãi nào đang diễn ra, cho phép tạo mới
        $sale = Sale::create($request->only(['discount_percentage', 'start_date', 'end_date']));
        $sale->products()->attach($request->products); // Gán sản phẩm cho sale
   
        return redirect()->route('sales.index')->with('success', 'Tạo thành công Sale.');
        
    }

    public function show(Sale $sale)
    {
        $products = Product::all(); 
        return view('admin.sales.show', compact('sale', 'products'));
    }
    public function edit(Sale $sale)
    {
        $products = Product::all(); 
        return view('admin.sales.edit', compact('sale', 'products'));
    }

    // Cập nhật chương trình khuyến mãi
    public function update(Request $request, Sale $sale)
    {
        $request->validate([
            
            'discount_percentage' => 'required|numeric|min:0|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);
    
       
        $conflictingSales = Sale::where('id', '<>', $sale->id) 
                                 ->where(function($query) use ($request) {
                                     $query->where('start_date', '<=', $request->input('end_date'))
                                           ->where('end_date', '>=', $request->input('start_date'));
                                 })
                                 ->get();
    
        if ($conflictingSales->isNotEmpty()) {
            
            return redirect()->route('sales.index')->with('message', 'Không thể cập nhật chương trình khuyến mãi vì có chương trình khác trùng ngày.')->withInput();
        }
    
        
        $sale->update($request->only(['discount_percentage', 'start_date', 'end_date']));
        $sale->products()->sync($request->product_id); // Cập nhật sản phẩm cho sale
    // dd($request->all());
        return redirect()->route('sales.index')->with('success', 'Cập nhật thành công');
    }

    // Xóa chương trình khuyến mãi
    public function destroy(Sale $sale)
{
   
    
    try {
        // Xóa liên kết trong bảng trung gian
        $sale->products()->detach();
        
        // Xóa bản ghi vĩnh viễn
        $sale->forceDelete();
        
        
        return redirect()->route('sales.index')->with('success', 'Xóa thành công');
    } catch (\Exception $e) {
       
        return redirect()->route('sales.index')->with('error', 'Không thể xóa: ' . $e->getMessage());
    }
}
}
