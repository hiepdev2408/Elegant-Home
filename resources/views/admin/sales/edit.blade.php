@extends('admin.layouts.master')
@section('title')
   Cập nhật sale
@endsection
@section('menu-item-sale')
    open
@endsection

@section('menu-sub-create-sale')
    active
@endsection
@section('content')
<div class="container mt-5">
    <h1>Cập Nhật Sale</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('flashsales.update', $sale->id) }}" method="POST">
        @csrf
        @method('PUT')
    
        <div class="form-group">
            <label for="discount_percent">Giảm Giá (Phần trăm):</label>
            <input type="number" class="form-control" id="discount_percent" name="discount_percentage" value="{{ old('discount_percentage', $sale->discount_percentage) }}" step="0.01" min="0" max="100" required>
            @error('discount_percentage')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    
        <div class="form-group">
            <label for="start_date">Ngày Bắt Đầu:</label>
            <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date', \Carbon\Carbon::parse($sale->start_date)->format('Y-m-d')) }}" required>
            @error('start_date')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    
        <div class="form-group">
            <label for="end_date">Ngày Kết Thúc:</label>
            <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date', \Carbon\Carbon::parse($sale->end_date)->format('Y-m-d')) }}" required>
            @error('end_date')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    <br>
        <h3>Chọn Sản Phẩm Áp Dụng Sales</h3>
        <div class="form-group">
            @foreach($products as $product)
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="product_{{ $product->id }}" name="product_id[]" value="{{ $product->id }}"
                        {{ $sale->products->contains($product->id) ? 'checked' : '' }}>
                    <label class="form-check-label" for="product_{{ $product->id }}">{{ $product->name }}</label>
                </div>
            @endforeach
        </div>
    
        <button type="submit" class="btn btn-primary">Cập Nhật </button>
    </form>
</div>
@endsection
@section('script-libs')
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection
