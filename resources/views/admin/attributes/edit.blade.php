@extends('admin.layouts.master')
@section('title')
    Thêm thuộc tính
@endsection
@section('menu-item-attribute')
    open
@endsection

@section('menu-sub-create-attribute')
    active
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Thuộc Tính /</span><span> {{ $dataID->name }}</span>
        </h4>
        <form action="{{ route('attributes.update', $dataID->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="app-ecommerce">
                <!-- Add Product -->
                <div
                    class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
                    <div class="d-flex flex-column justify-content-center">
                        <h4 class="mb-1 mt-3">Chỉnh sửa thuộc tính</h4>
                        <p>Thuộc tính được đặt trên cửa hàng của bạn</p>
                    </div>
                    <div class="d-flex align-content-center flex-wrap gap-3">
                        <button type="reset" class="btn btn-outline-primary">Nhập Lại</button>
                        <a href="{{ route('attributes.index') }}" class="btn btn-info">Quay Lại</a>
                        <button type="submit" class="btn btn-primary">
                            Xuất bản
                        </button>
                    </div>
                </div>

                <div class="row">
                    <!-- First column-->
                    <div class="col-12 col-lg-12">
                        <!-- Product Information -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-tile mb-0">Thông tin thuộc tính</h5>
                            </div>

                            <div class="card-body">
                                {{-- <span style="margin-left: 900px; color: red">* Trường này bắt buộc nhập</span> --}}
                                <div class="form-floating form-floating-outline">

                                    <input type="text" class="form-control" placeholder="Tên thuộc tính" name="name"
                                        id="name" value="{{ $dataID->name }}" />
                                    <label for="ecommerce-product-name">Tên thuộc tính</label>
                                    @error('name')
                                        <span class=" " style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script-libs')
    <script src="{{ asset('themes') }}/admin/js/app-ecommerce-product-add.js"></script>
@endsection
