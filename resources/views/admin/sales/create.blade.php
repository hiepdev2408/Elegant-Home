@extends('admin.layouts.master')
@section('title')
    Thêm mới sale
@endsection
@section('menu-item-sale')
    open
@endsection

@section('menu-sub-create-sale')
    active
@endsection
@section('content')
<div class="container mt-5">
    <h1>Thêm mới Sale</h1>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('sales.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="discount_percentage">Giảm Giá (Phần trăm):</label>
            <input type="number" class="form-control" id="discount_percentage" name="discount_percentage" step="0.01" min="0" max="100" required>
        </div>
        <div class="form-group">
            <label for="start_date">Ngày Bắt Đầu:</label>
            <input type="date" class="form-control" id="start_date" name="start_date" required>
        </div>
        <div class="form-group">
            <label for="end_date">Ngày Kết Thúc:</label>
            <input type="date" class="form-control" id="end_date" name="end_date" required>
        </div>
        
        <h3>Chọn Sản Phẩm Áp Dụng Sale</h3>
        <div class="form-group">
           
            <div class="scrollable-product-list" style="max-height: 300px; overflow-y: auto; border: 1px solid #ccc; padding: 10px; margin-top: 10px;">
                @foreach($products as $product)
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input product-checkbox" id="product_{{ $product->id }}" name="products[]" value="{{ $product->id }}">
                        <label class="form-check-label" for="product_{{ $product->id }}">{{ $product->name }}</label>
                    </div>
                @endforeach
                <button type="button" class="btn btn-secondary" id="select-all">Chọn Tất Cả</button>
            </div>
        </div><br>

        <button type="submit" class="btn btn-primary">Tạo Sale</button>
    </form>
</div>

@endsection
@section('script-libs')
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('content');
    </script>
    

    <script>
        document.getElementById('select-all').addEventListener('click', function() {
            const checkboxes = document.querySelectorAll('.product-checkbox');
            const allChecked = Array.from(checkboxes).every(checkbox => checkbox.checked);
    
            checkboxes.forEach(checkbox => {
                checkbox.checked = !allChecked; // Nếu tất cả đã được chọn, bỏ chọn, ngược lại thì chọn tất cả
            });
        });
    </script>
@endsection
