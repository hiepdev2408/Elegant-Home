@extends('admin.layouts.master')
@section('title')
    Chi tiết nhập kho
@endsection
@section('menu-item-product', 'open')
@section('menu-sub-warehouse', 'active')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Kho hàng /</span><span> Chi tiết nhập kho</span>
        </h4>
        <div class="app-ecommerce">
            <!-- Add Product -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
                <div class="d-flex flex-column justify-content-center">
                    <h4 class="mb-1 mt-3">Chi tiết nhập kho</h4>
                    <p>Sản phẩm được đặt trên cửa hàng của bạn</p>
                </div>
                <div class="d-flex align-content-center flex-wrap gap-3">
                    <a href="{{ route('warehouses.index') }}" class="btn btn-info">Quay Lại</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Thông tin sản phẩm</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-floating form-floating-outline mb-2">
                                <input type="text" class="form-control" id="ecommerce-product-name"
                                    placeholder="Tên sản phẩm" name="name"
                                    value="{{ $showHistory->variant->product->name }} ({{ $showHistory->quantity }})"
                                    disabled />
                                <label for="ecommerce-product-name">Tên sản phẩm</label>
                            </div>
                            <div class="form-floating form-floating-outline mb-2">
                                @foreach ($showHistory->variant->attributes as $attribute)
                                    @if (!$loop->first)
                                        <br>
                                    @endif
                                    {{ $attribute->attribute->name }}:
                                    {{ $attribute->attributeValue->value }}.
                                @endforeach
                            </div>
                            <div class="mb-4">
                                <img class="rounded-2" src="{{ Storage::url($showHistory->variant->image) }}"
                                    width="100px">
                            </div>
                            <div class="form-floating form-floating-outline mb-4">
                                <input type="text" class="form-control" id="ecommerce-product-name"
                                    placeholder="Tên sản phẩm" name="name" value="{{ $showHistory->user->name }}"
                                    disabled />
                                <label for="ecommerce-product-name">Người nhập</label>
                            </div>
                            <div class="form-floating form-floating-outline mb-4">
                                <textarea class="form-control" cols="30" rows="2" disabled>{{ $showHistory->note }}</textarea>
                                <label for="ecommerce-product-name">Ghi chú</label>
                            </div>
                            <div class="form-floating form-floating-outline mb-2">
                                <input class="form-control d-flex"
                                    value="{{ date('d/m/Y', strtotime($showHistory->created_at)) }} | {{ $showHistory->created_at->setTimezone('Asia/Ho_Chi_Minh')->format('h:i A') }}"
                                    disabled>
                                <label for="ecommerce-product-name">Ngày nhập</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Giá Cả</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-floating form-floating-outline mb-4">
                                <input type="text" class="form-control"
                                    value="{{ number_format($showHistory->variant->wholesale_price, 0, ',', '.') }} VND"
                                    disabled />
                                <label for="ecommerce-product-base_price">Giá nhập</label>
                            </div>
                            @if ($showHistory->variant->attributes->isEmpty())
                                <div class="form-floating form-floating-outline ">
                                    @if ($showHistory->variant->product->price_sale == '')
                                        <input type="text" class="form-control"
                                            value="{{ number_format($showHistory->variant->product->base_price, 0, ',', '.') }} VND"
                                            disabled />
                                    @else
                                        <input type="text" class="form-control"
                                            value="{{ number_format($showHistory->variant->product->price_sale, 0, ',', '.') }} VND"
                                            disabled />
                                    @endif
                                    <label for="ecommerce-product-base_price">Giá bán ra</label>
                                </div>
                            @else
                                <div class="form-floating form-floating-outline ">
                                    <input type="text" class="form-control"
                                        value="{{ number_format($showHistory->variant->price_modifier, 0, ',', '.') }} VND"
                                        disabled />
                                    <label for="ecommerce-product-base_price">Giá bán ra</label>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Tổng giá nhập</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-floating form-floating-outline mb-4">
                                <input type="text" class="form-control"
                                    value="{{ number_format($showHistory->Total_import_price, 0, ',', '.') }} VND"
                                    disabled />
                                <label for="ecommerce-product-base_price">Tổng giá nhập</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
