@extends('admin.layouts.master')
@section('title')
    Thêm danh mục
@endsection
@section('menu-item-categories')
    open
@endsection

@section('menu-sub-create-categories')
    active
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Danh Mục /</span><span> Thêm mới danh mục</span>
        </h4>
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf

            <div class="app-ecommerce">
                <!-- Add Product -->
                <div
                    class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
                    <div class="d-flex flex-column justify-content-center">
                        <h4 class="mb-1 mt-3">Thêm danh mục mới</h4>
                        <p>Danh mục được đặt trên cửa hàng của bạn</p>
                    </div>
                    <div class="d-flex align-content-center flex-wrap gap-3">
                        <button type="reset" class="btn btn-outline-primary">Nhập Lại</button>
                        <a href="{{ route('categories.index') }}" class="btn btn-info">Quay Lại</a>
                        <button type="submit" class="btn btn-primary">
                            Xuất bản
                        </button>
                    </div>
                </div>

                <div class="row">
                    <!-- First column-->
                    <div class="col-12 col-lg-8">
                        <!-- Product Information -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-tile mb-0">Thông tin danh mục</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-floating form-floating-outline mb-4">
                                    <select name="parent_id" id="parent_id" class="form-select">
                                        <option value="">Chọn danh mục cha (nếu có)</option>
                                        @foreach ($data as $parent)
                                            <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="ecommerce-product-name">Danh mục cha</label>
                                </div>
                                <div class="form-floating form-floating-outline">
                                    <input type="text" class="form-control" placeholder="Tên danh mục" name="name"
                                        id="name" value="{{ old('name') }}" />
                                    <label for="ecommerce-product-name">Tên danh mục</label>
                                    @error('name')
                                        <span class=" " style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- /Product Information -->
                    </div>
                    <div class="col-12 col-lg-4">
                        <!-- Product Information -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-tile mb-0">Trang Thái Danh Mục</h5>
                            </div>
                            <div class="card-body">
                                <label class="switch switch-success">
                                    <input type="hidden" name="is_active" value="0">
                                    <input type="checkbox" name="is_active" class="switch-input" value="1" checked />
                                    <span class="switch-toggle-slider">
                                        <span class="switch-on"></span>
                                        <span class="switch-off"></span>
                                    </span>
                                    <span class="switch-label">Kích Hoạt</span>
                                </label>
                            </div>
                        </div>
                        <!-- /Product Information -->
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script-libs')
    <script src="{{ asset('themes') }}/admin/js/app-ecommerce-product-add.js"></script>
@endsection
