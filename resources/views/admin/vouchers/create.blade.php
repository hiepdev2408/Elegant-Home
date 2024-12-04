@extends('admin.layouts.master')

@section('title', 'Thêm mới voucher')

@section('menu-item-voucher', 'open')
@section('menu-sub-create-voucher', 'active')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Thêm Mới Voucher</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('vouchers.store') }}" method="POST">
            @csrf

            <!-- Mã Voucher -->
            <div class="mb-3">
                <label for="code" class="form-label">Mã Voucher:</label>
                <input type="text" class="form-control" id="code" name="code" required>
            </div>

            <!-- Loại Giảm Giá -->
            <div class="mb-3">
                <label for="discount_type" class="form-label">Loại Giảm Giá:</label>
                <select class="form-select" id="discount_type" name="discount_type" required onchange="toggleDiscountFields()">
                    <option value="">-- Chọn loại giảm giá --</option>
                    <option value="amount">Giảm Giá (Số tiền)</option>
                    <option value="percent">Giảm Giá (Phần trăm)</option>
                </select>
            </div>

            <!-- Giảm Giá (Số tiền) -->
            <div class="mb-3" id="discount_amount_group" style="display: none;">
                <label for="discount_amount" class="form-label">Giảm Giá (Số tiền):</label>
                <input type="number" class="form-control" id="discount_amount" name="discount_amount" step="0.01" min="0">
            </div>

            <!-- Giảm Giá (Phần trăm) -->
            <div class="mb-3" id="discount_percent_group" style="display: none;">
                <label for="discount_percent" class="form-label">Giảm Giá (Phần trăm):</label>
                <input type="number" class="form-control" id="discount_percent" name="discount_percent" step="0.01" min="0" max="100">
            </div>

            <!-- Ngày Bắt Đầu -->
            <div class="mb-3">
                <label for="start_date" class="form-label">Ngày Bắt Đầu:</label>
                <input type="date" class="form-control" id="start_date" name="start_date" required>
            </div>

            <!-- Ngày Kết Thúc -->
            <div class="mb-3">
                <label for="end_date" class="form-label">Ngày Kết Thúc:</label>
                <input type="date" class="form-control" id="end_date" name="end_date" required>
            </div>

            <!-- Giới Hạn Sử Dụng -->
            <div class="mb-3">
                <label for="usage_limit" class="form-label">Giới Hạn Sử Dụng:</label>
                <input type="number" class="form-control" id="usage_limit" name="usage_limit" min="0">
            </div>

            <!-- Chọn Sản Phẩm -->
            <div class="mb-4">
                <label for="products" class="form-label">Chọn Sản Phẩm Áp Dụng Voucher:</label>
                <select class="form-select" id="products" name="products[]" multiple>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Nút Gửi -->
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Tạo Voucher</button>
            </div>
        </form>
    </div>
@endsection

@section('script-libs')
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
    <script>
        function toggleDiscountFields() {
            const discountType = document.getElementById('discount_type').value;
            document.getElementById('discount_amount_group').style.display = discountType === 'amount' ? 'block' : 'none';
            document.getElementById('discount_percent_group').style.display = discountType === 'percent' ? 'block' : 'none';
        }

        $(document).ready(function() {
            $('#products').select2({
                placeholder: "Chọn sản phẩm",
                allowClear: true
            });
        });
    </script>
@endsection
