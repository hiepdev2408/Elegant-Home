@extends('admin.layouts.master')
@section('title')
    Thêm mới sale
@endsection
@section('menu-item-voucher')
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

        <form action="{{ route('flashsales.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="discount_percentage">Giảm Giá (Phần trăm):</label>
                <input type="number" class="form-control mt-3" id="discount_percentage" name="discount_percentage" step="0.01"
                    min="0" max="100" required>
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
                <!-- Thanh tìm kiếm -->
                <input type="text" id="search-input" class="form-control" placeholder="Tìm kiếm sản phẩm theo tên..."
                    style="margin-bottom: 10px;">

                <!-- Danh sách sản phẩm -->
                <div class="scrollable-product-list"
                    style="max-height: 300px; overflow-y: auto; border: 1px solid #ccc; padding: 10px; margin-top: 10px;">
                    @foreach ($products as $product)
                        <div class="form-check product-item">
                            <input type="checkbox" class="form-check-input product-checkbox"
                                id="product_{{ $product->id }}" name="products[]" value="{{ $product->id }}">
                            <label class="form-check-label" for="product_{{ $product->id }}">{{ $product->name }}</label>
                        </div>
                    @endforeach
                </div>
                <button type="button" class="btn btn-secondary mt-2" id="select-all">Chọn Tất Cả</button>
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
                checkbox.checked = !
                allChecked;
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search-input');
            const productItems = document.querySelectorAll('.product-item');

            searchInput.addEventListener('keyup', function() {
                const query = searchInput.value.toLowerCase();

                productItems.forEach(item => {
                    const productName = item.querySelector('.form-check-label').textContent
                        .toLowerCase();
                    if (productName.includes(query)) {
                        item.style.display = '';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });

            const selectAllBtn = document.getElementById('select-all');
            selectAllBtn.addEventListener('click', function() {
                const checkboxes = document.querySelectorAll('.product-checkbox');
                checkboxes.forEach(checkbox => checkbox.checked = true);
            });
        });
    </script>
@endsection
