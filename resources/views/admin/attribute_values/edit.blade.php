@extends('admin.layouts.master')

@section('title')
    Chỉnh sửa thuộc tính
@endsection

@section('menu-item-attribute', 'open')
@section('menu-sub-attribute-value', 'active')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Thuộc Tính /</span> Chỉnh sửa thuộc tính
        </h4>

        <div class="app-ecommerce">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
                <div class="d-flex flex-column justify-content-center">
                    <h4 class="mb-1 mt-3">Chỉnh sửa thuộc tính</h4>
                    <p>Cập nhật thông tin của thuộc tính</p>
                </div>
                <div class="d-flex align-content-center flex-wrap gap-3">
                    <a href="{{ route('attribute_values.index') }}" class="btn btn-info">Quay Lại</a>
                    <button type="submit" form="edit-attribute-value-form" class="btn btn-primary">
                        Cập nhật
                    </button>
                </div>
            </div>

            <form id="edit-attribute-value-form" action="{{ route('attribute_values.update', $attributeValue->id) }}"
                method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-12 col-lg-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-tile mb-0">Thông tin thuộc tính</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-floating form-floating-outline">
                                    <select class="form-control" name="attribute_id" id="attribute_id">
                                        <option value="">Chọn một thuộc tính</option>
                                        @foreach ($attributes as $id => $name)
                                            <option @selected($id == $attributeValue->attribute_id) value="{{ $id }}">
                                                {{ $name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="attribute_id">Thuộc tính</label>
                                    @error('attribute_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-floating form-floating-outline">
                                    <input type="text" class="form-control" placeholder="Giá trị" name="value"
                                        id="value" value="{{ $attributeValue->value }}">
                                    <label for="value">Giá trị</label>
                                    @error('value')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script-libs')
    <script src="{{ asset('themes') }}/admin/js/app-ecommerce-product-add.js"></script>
@endsection
