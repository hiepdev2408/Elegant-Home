@extends('admin.layouts.master')

@section('title')
    Cập nhật sản phẩm
@endsection

@section('menu-item-product')
    open
@endsection

@section('menu-sub-create-product')
    active
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Sản phẩm /</span><span> Cập nhật sản phẩm</span>
    </h4>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form cập nhật sản phẩm -->
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="app-ecommerce">
            <!-- Tiêu đề -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
                <div class="d-flex flex-column justify-content-center">
                    <h4 class="mb-1 mt-3">Cập nhật sản phẩm</h4>
                    <p>Sản phẩm được đặt trên cửa hàng của bạn</p>
                </div>
                <div class="d-flex align-content-center flex-wrap gap-3">
                    <button type="reset" class="btn btn-outline-primary">Nhập Lại</button>
                    <a href="{{ route('products.index') }}" class="btn btn-info">Quay Lại</a>
                    <button type="submit" class="btn btn-primary">
                        Cập nhật
                    </button>
                </div>
            </div>

            <!-- Thông tin sản phẩm -->
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Thông tin sản phẩm</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-floating form-floating-outline mb-4">
                                <input type="text" class="form-control" id="ecommerce-product-name"
                                    placeholder="Tên sản phẩm" name="name" value="{{ $product->name }}" />
                                <label for="ecommerce-product-name">Tên sản phẩm</label>
                                @if ($errors->has('name'))
                                    <div class="text-danger">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>
                            <div hidden class="form-floating form-floating-outline mb-4">
                                <input type="text" class="form-control" id="ecommerce-product-slug"
                                    placeholder="Tên sản phẩm" name="slug" />

                            </div>
                            <div class="mb-4">
                                <label class="form-label">Content
                                    <span class="text-muted">(Optional)</span></label>
                                <textarea class="form-control" name="content" id="content">{{ $product->content }}</textarea>
                                @if ($errors->has('content'))
                                    <div class="text-danger">
                                        {{ $errors->first('content') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-floating form-floating-outline mb-4">
                                <textarea class="form-control" name="description" id="description" rows="2" placeholder="Mô tả ngắn">{{ $product->description }}</textarea>
                                <label for="ecommerce-product-description">Mô tả ngắn</label>
                                @if ($errors->has('description'))
                                    <div class="text-danger">
                                        {{ $errors->first('description') }}
                                    </div>
                                @endif
                            </div>
                            <div class="mb-4">
                                <label for="img_thumbnail" class="form-label">Ảnh sản phẩm</label>
                                <input type="file" class="form-control" name="img_thumbnail" id="img_thumbnail"
                                    value="{{ old('img_thumbnail') }}">
                                    @if ($product->img_thumbnail)
                                        <img src="{{ Storage::url($product->img_thumbnail) }}" width="100px" alt="">
                                    @endif
                                @if ($errors->has('img_thumbnail'))
                                    <div class="text-danger">
                                        {{ $errors->first('img_thumbnail') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-floating form-floating-outline mb-4">
                                <textarea class="form-control" name="user_manual" id="user_manual" rows="2" placeholder="Hướng dẫn sử dụng">{{ $product->user_manual }}</textarea>
                                <label for="ecommerce-product-user_manual">Hướng dẫn sử dụng</label>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title">Album ảnh</h5>
                        </div>
                        <div class="card-body">
                            <div id="gallery-container" class="row gy-3">
                                @foreach ($product->galleries as $gallery)
                                    <div id="gallery_{{ $loop->iteration }}" class="col-12">
                                        <label for="gallery_input_{{ $loop->iteration }}" class="form-label">Gallery {{ $loop->iteration }}</label>
                                        <input type="file" class="form-control" name="product_galleries[{{ $gallery->id }}]" id="gallery_input_{{ $loop->iteration }}">
                                        @if ($gallery->img_path)
                                            <img src="{{ Storage::url($gallery->img_path) }}" width="100px" alt="Gallery Image">
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-primary mt-3" id="add-gallery">
                                <i class="mdi mdi-plus me-0 me-sm-1"></i> Thêm ảnh
                            </button>
                        </div>
                    </div>

                    <!-- Biến thể -->
                    <div class="card mb-4 ">
                        <div class="card-header">
                            <h5 class="card-title">Biến Thể</h5>
                            <p>Thêm mới thuộc tính giúp sản phẩm có nhiều lựa chọn, như kích cỡ hay màu sắc.</p>
                        </div>
                        <div class="card-body">
                            <input type="checkbox" id="hasVariants" class="form-check-input" @if ($product->variants && $product->variants->count() > 0) checked @endif>
                            <label class="form-check-label" for="hasVariants">Sản phẩm này có biến thể</label>

                            <div id="variantsSection" @if (!$product->variants || $product->variants->count() === 0) style="display: none;" @endif>
                                <div id="variants" class="mb-4">
                                    @foreach ($product->variants as $variantIndex => $variant)
                                        <div class="variant mb-4 mt-4" id="variant_{{ $variantIndex }}">
                                            <h5>Biến Thể {{ $variantIndex + 1 }}</h5>
                                            <div class="form-floating form-floating-outline mb-4">
                                                <input type="text" name="variants[{{ $variant->id }}][sku]" class="form-control" placeholder="Mã biến thể" value="{{ $variant->sku }}">
                                                <label for="variant_sku_{{ $variantIndex }}">Mã biến thể</label>
                                            </div>
                                            <div class="form-floating form-floating-outline mb-4">
                                                <input type="number" name="variants[{{ $variant->id }}][price_modifier]" class="form-control" step="0.01" placeholder="Giá điều chỉnh" value="{{ $variant->price_modifier }}">
                                                <label for="variant_price_modifier_{{ $variantIndex }}">Giá điều chỉnh</label>
                                            </div>
                                            <div class="form-floating form-floating-outline mb-4">
                                                <input type="number" name="variants[{{ $variant->id }}][stock]" class="form-control" placeholder="Số lượng tồn kho" value="{{ $variant->stock }}">
                                                <label for="variant_stock_{{ $variantIndex }}">Số lượng tồn kho</label>
                                            </div>
                                            <div class="form-floating form-floating-outline mb-4">
                                                <input type="file" name="variants[{{ $variant->id }}][image]" class="form-control">
                                                @if ($variant->image)
                                                    <img src="{{ Storage::url($variant->image) }}" alt="Variant Image" width="100px">
                                                @endif
                                            </div>
                                            @foreach ($attributes as $attribute)
                                                <div class="form-floating form-floating-outline mb-4">
                                                    <select name="variants[{{ $variant->id }}][attributes][{{ $attribute->id }}]" class="form-control">
                                                        <option value="">Chọn {{ $attribute->name }}</option>
                                                        @foreach ($attribute->values as $value)
                                                            <option value="{{ $value->id }}" @selected($variant->attributes->contains('attribute_value_id', $value->id))>
                                                                {{ $value->value }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <label>{{ $attribute->name }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" id="add-variant" class="btn btn-primary">
                                    <i class="mdi mdi-plus me-0 me-sm-1"></i> Thêm Biến Thể
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Trạng Thái</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col">
                                    <div class="form-check form-switch form-switch-secondary">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            name="is_active"
                                            @checked($product->is_active)
                                            id="is_active">
                                        <label class="form-check-label" for="is_active">Kích hoạt</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-check form-switch form-switch-success">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            name="is_good_deal"
                                            @checked($product->is_good_deal)
                                            id="is_good_deal" checked>
                                        <label class="form-check-label" for="is_good_deal">Sản phẩm tốt</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            name="is_new"
                                            @checked($product->is_new)
                                            id="is_new" checked>
                                        <label class="form-check-label" for="is_new">Sản phẩm mới</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-check form-switch form-switch-danger">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            name="is_show_home"
                                            @checked($product->is_show_home)
                                            id="is_show_home" checked>
                                        <label class="form-check-label" for="is_show_home">Hiện thị Home</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Giá Cả</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-floating form-floating-outline mb-4">
                                <input type="text" class="form-control" id="ecommerce-product-base_price"
                                    placeholder="Giá sản phẩm" name="base_price" value="{{ $product->base_price }}" />
                                <label for="ecommerce-product-base_price">Giá sản phẩm</label>
                                @if ($errors->has('base_price'))
                                    <div class="text-danger">
                                        {{ $errors->first('base_price') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-floating form-floating-outline ">
                                <input type="text" class="form-control" id="ecommerce-product-base_price"
                                    placeholder="Giá sản phẩm" name="price_sale" value="{{ $product->price_sale }}" />
                                <label for="ecommerce-product-base_price">Giá giảm giá</label>
                                @if ($errors->has('price_sale'))
                                    <div class="text-danger">
                                        {{ $errors->first('price_sale') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Mã sản phẩm</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-floating form-floating-outline mb-4">
                                <input type="text" class="form-control" id="ecommerce-product-base_price"
                                    placeholder="Mã sản phẩm" name="sku" value="{{ $product->sku }}" />
                                <label for="ecommerce-product-base_price">Mã sản phẩm</label>
                                @if ($errors->has('sku'))
                                    <div class="text-danger">
                                        {{ $errors->first('sku') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Tổ Chức</h5>
                        </div>
                        <div class="card-body">

                            <div class="form-floating form-floating-outline">
                                <select name="categories[]" class="form-select" style="min-height: 100px" multiple>
                                    @foreach ($category as $id => $name)
                                        <option
                                        @selected(in_array($id, $categoryProduct))
                                        value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                                <label for="name" class="form-label">Danh mục</label>
                                @if ($errors->has('categories'))
                                    <div class="text-danger">
                                        {{ $errors->first('categories') }}
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- JavaScript -->
<script>
    const attributesData = @json($attributes);
    let galleryIndex = {{ count($product->galleries) }};
    let variantIndex = {{ $product->variants ? $product->variants->count() : 0 }};

    // Thêm ảnh mới
    document.getElementById('add-gallery').addEventListener('click', function () {
        const galleryContainer = document.getElementById('gallery-container');
        const newGallery = `
            <div id="gallery_${galleryIndex}" class="col-12">
                <label for="gallery_input_${galleryIndex}" class="form-label">Gallery ${galleryIndex + 1}</label>
                <input type="file" class="form-control" name="product_galleries[new_${galleryIndex}]" id="gallery_input_${galleryIndex}">
            </div>
        `;
        galleryContainer.insertAdjacentHTML('beforeend', newGallery);
        galleryIndex++;
    });

    // Hiển thị biến thể
    document.getElementById('hasVariants').addEventListener('change', function () {
        const variantsSection = document.getElementById('variantsSection');
        variantsSection.style.display = this.checked ? 'block' : 'none';
    });

    // Thêm biến thể mới
    document.getElementById('add-variant').addEventListener('click', function () {
        const variantsDiv = document.getElementById('variants');
        const newVariant = `
            <div class="variant mb-4" id="variant_${variantIndex}">
                <h5>Biến Thể ${variantIndex + 1}</h5>
                <div class="form-floating form-floating-outline mb-4">
                    <input type="text" name="variants[new_${variantIndex + 1}][sku]" class="form-control" placeholder="Mã biến thể">
                    <label>Mã biến thể</label>
                </div>
                <div class="form-floating form-floating-outline mb-4">
                    <input type="number" name="variants[new_${variantIndex + 1}][price_modifier]" class="form-control" step="0.01" placeholder="Giá điều chỉnh">
                    <label>Giá điều chỉnh</label>
                </div>
                <div class="form-floating form-floating-outline mb-4">
                    <input type="number" name="variants[new_${variantIndex + 1}][stock]" class="form-control" placeholder="Số lượng tồn kho">
                    <label>Số lượng tồn kho</label>
                </div>
                <div class="form-floating form-floating-outline mb-4">
                    <input type="file" name="variants[new_${variantIndex + 1}][image]" class="form-control">
                </div>
                ${generateAttributeFields(variantIndex + 1)}
            </div>
        `;
        variantsDiv.insertAdjacentHTML('beforeend', newVariant);
        variantIndex++;
    });

    function generateAttributeFields(index) {
        let fieldsHTML = '';
        attributesData.forEach(attribute => {
            let optionsHTML = `<option value="">Chọn ${attribute.name}</option>`;
            attribute.values.forEach(value => {
                optionsHTML += `<option value="${value.id}">${value.value}</option>`;
            });
            fieldsHTML += `
                <div class="form-floating form-floating-outline mb-4">
                    <select name="variants[new_${index}][attributes][${attribute.id}]" class="form-control">
                        ${optionsHTML}
                    </select>
                    <label>${attribute.name}</label>
                </div>
            `;
        });
        return fieldsHTML;
    }
</script>
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

    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#content'))
            .then(editor => {
                editor.ui.view.editable.element.style.height = '200px'; // Tăng chiều cao ở đây
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
