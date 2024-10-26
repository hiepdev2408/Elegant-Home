@extends('admin.layouts.master')

@section('content')
<div class="container">
    <h2>Chỉnh sửa Sản Phẩm</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Thông tin sản phẩm -->
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="productName">Tên sản phẩm:</label>
                    <input type="text" id="productName" name="name" class="form-control" value="{{ $product->name }}">
                </div>

                <div class="form-group">
                    <label for="productSlug">Slug:</label>
                    <input type="text" id="productSlug" name="slug" class="form-control" value="{{ $product->slug }}" disabled>
                </div>

                <div class="form-group">
                    <label for="base_price">Giá sản phẩm:</label>
                    <input type="number" name="base_price" class="form-control" value="{{ $product->base_price }}" step="0.01">
                </div>

                <div class="form-group">
                    <label for="img_thumbnail">Ảnh thumbnail hiện tại:</label><br>
                    <img src="{{ asset('storage/' . $product->img_thumbnail) }}" alt="Thumbnail" width="100">
                    <input type="file" class="form-control mt-2" name="img_thumbnail" id="img_thumbnail">
                </div>

                <div class="form-group">
                    <label for="description">Mô tả:</label>
                    <textarea name="description" id="description" class="form-control" rows="4">{{ $product->description }}</textarea>
                </div>
            </div>

            <!-- Gallery của sản phẩm -->
            <div class="col-md-8">
                <h4>Gallery</h4>
                <div class="row" id="gallery-container">
                    @foreach($product->galleries as $index => $gallery)
                        <div class="col-md-4 mb-3" id="gallery_{{ $index }}">
                            <img src="{{ asset('storage/' . $gallery->img_path) }}" alt="Gallery Image" width="100">
                            <input type="file" name="product_galleries[{{ $gallery->id }}]" class="form-control mt-2">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Biến thể sản phẩm -->
        <h4 class="mt-5">Biến Thể Sản Phẩm</h4>
        <div id="variants">
            @foreach($product->variants as $variantIndex => $variant)
                <div class="variant mb-4" id="variant_{{ $variantIndex }}">
                    <h5>Biến Thể {{ $variantIndex + 1 }}</h5>

                    <div class="form-group">
                        <label for="variant_sku_{{ $variantIndex }}">Mã biến thể:</label>
                        <input type="text" name="variants[{{ $variant->id }}][sku]" class="form-control" value="{{ $variant->sku }}">
                    </div>

                    <div class="form-group">
                        <label for="variant_price_modifier_{{ $variantIndex }}">Giá điều chỉnh:</label>
                        <input type="number" name="variants[{{ $variant->id }}][price_modifier]" class="form-control" value="{{ $variant->price_modifier }}" step="0.01">
                    </div>

                    <div class="form-group">
                        <label for="variant_stock_{{ $variantIndex }}">Số lượng tồn kho:</label>
                        <input type="number" name="variants[{{ $variant->id }}][stock]" class="form-control" value="{{ $variant->stock }}">
                    </div>

                    <!-- Thuộc tính của biến thể -->
                    @foreach($attributes as $attribute)
                        <div class="form-group">
                            <label>{{ $attribute->name }}:</label>
                            <select name="variants[{{ $variant->id }}][attributes][{{ $attribute->id }}]" class="form-control">
                                <option value="">Chọn {{ $attribute->name }}</option>
                                @foreach($attribute->values as $value)
                                    <option value="{{ $value->id }}" {{ $variant->attributes->contains('id', $value->id) ? 'selected' : '' }}>{{ $value->value }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>

        <!-- Nút submit -->
        <button type="submit" class="btn btn-primary mt-3">Cập Nhật Sản Phẩm</button>
    </form>
</div>
@endsection
