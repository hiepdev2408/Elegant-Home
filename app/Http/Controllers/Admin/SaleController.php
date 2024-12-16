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

    

    public function store(Request $request)
    {
        $request->validate([
            'discount_percentage' => 'required|numeric|min:0|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'products' => 'required|array', 
            'products.*' => 'exists:products,id',
        ]);
    
        // Lấy thời gian hiện tại ở UTC
        $currentDate = Carbon::now()->setTimezone('UTC');
    
        // Kiểm tra các sale đang hoạt động
        $activeSales = Sale::where('start_date', '<=', $currentDate)
            ->where('end_date', '>=', $currentDate)
            ->get();
    
        if ($activeSales->isNotEmpty()) {
            return redirect()->route('flashsales.index')->with('message', 'Vẫn còn chương trình khuyến mãi đang diễn ra.')->withInput();
        }
    
        // Tạo sale mới và chuyển đổi thời gian sang UTC
        $sale = Sale::create([
            'discount_percentage' => $request->discount_percentage,
            'start_date' => Carbon::parse($request->start_date)->setTimezone('UTC'), // Chuyển đổi sang UTC
            'end_date' => Carbon::parse($request->end_date)->setTimezone('UTC'), // Chuyển đổi sang UTC
        ]);
    
        // Gắn sản phẩm vào sale
        $sale->products()->attach($request->products); 
    
        return redirect()->route('flashsales.index')->with('success', 'Tạo thành công Sale.');
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
            ->where(function ($query) use ($request) {
                $query->where('start_date', '<=', $request->input('end_date'))
                    ->where('end_date', '>=', $request->input('start_date'));
            })
            ->get();

        if ($conflictingSales->isNotEmpty()) {

            return redirect()->route('sales.index')->with('message', 'Không thể cập nhật chương trình khuyến mãi vì có chương trình khác trùng ngày.')->withInput();
        }


        $sale->update($request->only(['discount_percentage', 'start_date', 'end_date']));
        $sale->products()->sync($request->product_id); // Cập nhật sản phẩm cho sale

        return redirect()->route('flashsales.index')->with('success', 'Cập nhật thành công');
    }

    // Xóa chương trình khuyến mãi
    public function destroy(Sale $sale)
    {
        try {
            $sale->products()->detach();

            $sale->forceDelete();

            return redirect()->route('flashsales.index')->with('success', 'Xóa thành công');
        } catch (\Exception $e) {

            return redirect()->route('flashsales.index')->with('error', 'Không thể xóa: ' . $e->getMessage());
        }
    }
}
