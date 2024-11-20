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
    <h1>Thêm mới vouchers</h1>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form action="{{ route('vouchers.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="code">Mã Voucher:</label>
            <input type="text" class="form-control" id="code" name="code" required>
        </div>
        <div class="form-group">
            <label for="discount_amount">Giảm Giá (Số tiền):</label>
            <input type="number" class="form-control" id="discount_amount" name="discount_amount" step="0.01" min="0">
        </div>
        <div class="form-group">
            <label for="discount_percent">Giảm Giá (Phần trăm):</label>
            <input type="number" class="form-control" id="discount_percent" name="discount_percent" step="0.01" min="0" max="100">
        </div>
        <div class="form-group">
            <label for="start_date">Ngày Bắt Đầu:</label>
            <input type="date" class="form-control" id="start_date" name="start_date" required>
        </div>
        <div class="form-group">
            <label for="end_date">Ngày Kết Thúc:</label>
            <input type="date" class="form-control" id="end_date" name="end_date" required>
        </div>
        <div class="form-group">
            <label for="usage_limit">Giới Hạn Sử Dụng:</label>
            <input type="number" class="form-control" id="usage_limit" name="usage_limit" min="0">
        </div>
        
        <h3>Chọn Sản Phẩm Áp Dụng Voucher</h3>
        <div class="form-group">
            @foreach($products as $product)
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="product_{{ $product->id }}" name="products[]" value="{{ $product->id }}">
                    <label class="form-check-label" for="product_{{ $product->id }}">{{ $product->name }}</label>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Tạo Voucher</button>
    </form>
  
</div>
@endsection
@section('script-libs')
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection
