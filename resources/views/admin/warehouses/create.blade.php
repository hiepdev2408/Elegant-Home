@extends('admin.layouts.master')
@section('title')
    Thêm sản phẩm kho hàng
@endsection
@section('menu-item-product', 'open')

@section('menu-sub-warehouse', 'active')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Sản Phẩm /</span><span> Kho hàng</span>
        </h4>
        <!-- Form tạo sản phẩm -->
        <form action="{{ route('warehouses.store') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="app-ecommerce">
                <div
                    class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
                    <div class="d-flex flex-column justify-content-center">
                        <h4 class="mb-1 mt-3">Kho hàng</h4>
                        <p>Sản phẩm được đặt trên cửa hàng của bạn</p>
                    </div>
                    <div class="d-flex align-content-center flex-wrap gap-3">
                        <button type="reset" class="btn btn-outline-primary">Nhập Lại</button>
                        <a href="{{ route('products.warehouses') }}" class="btn btn-info">Quay Lại</a>
                        <button type="submit" class="btn btn-primary">
                            Tạo Phiếu
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Thông tin phiếu</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-4 col ecommerce-select2-dropdown">
                                    <div class="form-floating form-floating-outline w-100 me-3">
                                        <select id="product-org" class="select2 form-select"
                                            data-placeholder="-- Vui Lòng Chọn Sản Phẩm --" name="variant_id" required>
                                            <option value="">-- Vui Lòng Chọn Sản Phẩm --</option>
                                            @foreach ($products as $key => $product)
                                                @foreach ($product->variants as $variant)
                                                    <option value="{{ $variant->id }}">
                                                        {{ $variant->product->name }} <br>
                                                        @foreach ($variant->attributes as $attribute)
                                                            @if (!$loop->first)
                                                                /
                                                            @endif
                                                            {{ $attribute->attributeValue->value }}
                                                        @endforeach
                                                    </option>
                                                @endforeach
                                            @endforeach
                                        </select>
                                        <label for="product-org">Sản Phẩm</label>
                                    </div>
                                </div>
                                <div class="mb-4 col ecommerce-select2-dropdown">
                                    <div class="form-floating form-floating-outline w-100 me-3">
                                        <select id="user_id" class="select2 form-select"
                                            data-placeholder="-- Người Thực Hiện --" name="user_id" required>
                                            <option value="">-- Người Thực Hiện --</option>
                                            @foreach ($user as $id => $name)
                                                <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="user_id">Người Thực Hiện</label>
                                    </div>
                                </div>

                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="number" class="form-control" id="stock" name="quantity"
                                        placeholder="Số lượng" oninput="calculateTotal()">
                                    <label for="stock">Số Lượng</label>
                                </div>

                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="text" class="form-control" id="wholesale_price" name="wholesale_price"
                                        placeholder="Giá Nhập Hàng" oninput="calculateTotal()">
                                    <label for="wholesale_price">Giá Nhập Hàng</label>
                                </div>

                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="hidden" id="Total_import_price" name="Total_import_price">
                                    <input type="text" class="form-control" name="Total_import_price_raw"
                                        id="Total_import_price_raw" placeholder="Tổng giá nhập">
                                    <label for="Total_import_price">Tổng giá nhập</label>
                                </div>

                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="text" class="form-control" name="note" id="note"
                                        placeholder="Ghi Chú" value="Khác">
                                    <label for="note">Ghi Chú</label>
                                </div>

                                <input type="hidden" name="type" value="Nhập Hàng">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
@section('style-libs')
    <link rel="stylesheet" href="{{ asset('themes') }}/admin/vendor/libs/quill/typography.css" />
    <link rel="stylesheet" href="{{ asset('themes') }}/admin/vendor/libs/quill/katex.css" />
    <link rel="stylesheet" href="{{ asset('themes') }}/admin/vendor/libs/quill/editor.css" />
    <link rel="stylesheet" href="{{ asset('themes') }}/admin/vendor/libs/select2/select2.css" />
    <link rel="stylesheet" href="{{ asset('themes') }}/admin/vendor/libs/dropzone/dropzone.css" />
    <link rel="stylesheet" href="{{ asset('themes') }}/admin/vendor/libs/flatpickr/flatpickr.css" />
    <link rel="stylesheet" href="{{ asset('themes') }}/admin/vendor/libs/tagify/tagify.css" />
@endsection

@section('script-libs')
    <script src="{{ asset('themes') }}/admin/vendor/libs/quill/katex.js"></script>
    <script src="{{ asset('themes') }}/admin/vendor/libs/quill/quill.js"></script>
    <script src="{{ asset('themes') }}/admin/vendor/libs/select2/select2.js"></script>
    <script src="{{ asset('themes') }}/admin/vendor/libs/dropzone/dropzone.js"></script>
    <script src="{{ asset('themes') }}/admin/vendor/libs/jquery-repeater/jquery-repeater.js"></script>
    <script src="{{ asset('themes') }}/admin/vendor/libs/flatpickr/flatpickr.js"></script>
    <script src="{{ asset('themes') }}/admin/vendor/libs/tagify/tagify.js"></script>
    <script src="{{ asset('themes') }}/admin/js/app-ecommerce-product-add.js"></script>

    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script>
        function calculateTotal() {
            // Lấy giá trị số lượng từ input
            var quantity = parseFloat(document.getElementById('stock').value) || 0;
            // Lấy giá trị giá nhập từ input
            var purchasePrice = parseFloat(document.getElementById('wholesale_price').value) || 0;

            // Tính tổng giá nhập
            var totalPrice = quantity * purchasePrice;

            // Gán giá trị chưa định dạng vào hidden input
            document.getElementById('Total_import_price').value = totalPrice;

            // Định dạng tổng giá với dấu phân cách hàng nghìn
            var formattedTotalPrice = totalPrice.toLocaleString('vi-VN', {
                style: 'decimal',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            });

            // Gán giá trị định dạng vào input hiển thị
            document.getElementById('Total_import_price_raw').value = formattedTotalPrice;
        }
    </script>
@endsection
