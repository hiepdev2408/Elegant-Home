@extends('admin.layouts.master')
@section('title')
    Thêm mới voucher
@endsection
@section('menu-item-voucher')
    open
@endsection

@section('menu-sub-create-voucher')
    active
@endsection
@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Cập Nhật Voucher</h1>
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('vouchers.update', $voucher->id) }}" method="POST">
            @csrf
            @method('PUT')
        
            <!-- Mã Voucher -->
            <div class="mb-3">
                <label for="code" class="form-label">Mã Voucher:</label>
                <input type="text" class="form-control" id="code" name="code" value="{{ old('code', $voucher->code) }}" required>
            </div>
        
            <!-- Loại Giảm Giá -->
            <div class="mb-3">
                <label for="discount_type" class="form-label">Loại Giảm Giá:</label>
                <select class="form-select" id="discount_type" name="discount_type" required onchange="toggleDiscountFields()">
                    <option value="">-- Chọn loại giảm giá --</option>
                    <option value="money" {{ $voucher->discount_type == 'money' ? 'selected' : '' }}>Giảm Giá (Số tiền)</option>
                    <option value="percentage" {{ $voucher->discount_type == 'percentage' ? 'selected' : '' }}>Giảm Giá (Phần trăm)</option>
                </select>
            </div>
            
            <!-- Giảm Giá -->
            <div class="mb-3" id="discount_value_group" style="display: {{ $voucher->discount_type ? 'block' : 'none' }};">
                <label for="discount_value" class="form-label">Giảm Giá:</label>
                <input type="number" class="form-control" id="discount_value" name="discount_value" step="0.01" min="0" value="{{ old('discount_value', $voucher->discount_value) }}" required>
            </div>
        
            <!-- Giá trị đơn hàng tối thiểu -->
            <div class="mb-3">
                <label for="minimum_order_value" class="form-label">Giá trị đơn hàng tối thiểu:</label>
                <input type="number" class="form-control" id="minimum_order_value" name="minimum_order_value" step="0.01" min="0" value="{{ old('minimum_order_value', $voucher->minimum_order_value) }}" required>
            </div>
        
            <!-- Ngày Bắt Đầu -->
            <div class="mb-3">
                <label for="start_date" class="form-label">Ngày Bắt Đầu:</label>
                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ \Carbon\Carbon::parse($voucher->start_date)->format('Y-m-d') }}" required>
            </div>
        
            <!-- Ngày Kết Thúc -->
            <div class="mb-3">
                <label for="end_date" class="form-label">Ngày Kết Thúc:</label>
                <input type="date" class="form-control" id="end_date" name="end_date" value="{{ \Carbon\Carbon::parse($voucher->end_date)->format('Y-m-d') }}" required>
            </div>
        
            <!-- Giới Hạn Sử Dụng -->
            <div class="mb-3">
                <label for="quantity" class="form-label">Giới Hạn Sử Dụng:</label>
                <input type="number" class="form-control" id="quantity" name="quantity" min="0" value="{{ old('quantity', $voucher->quantity) }}" required>
            </div>
        
            <!-- Nút Gửi -->
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Cập Nhật Voucher</button>
            </div>
        </form>
    </div>

   
@endsection
@section('script-libs')
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('content');
    </script>
    <script>
  function toggleDiscountFields() {
    var discountType = document.getElementById('discount_type').value;
    var discountValueGroup = document.getElementById('discount_value_group');
    
    // Hiển thị hoặc ẩn trường giảm giá dựa trên loại giảm giá
    discountValueGroup.style.display = discountType ? 'block' : 'none';
}

// Gọi hàm khi trang được tải
document.addEventListener('DOMContentLoaded', function() {
    toggleDiscountFields(); // Để thiết lập trạng thái ban đầu
});

    </script>
  
@endsection
