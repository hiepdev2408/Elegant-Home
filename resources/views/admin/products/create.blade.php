@extends('admin.layouts.master')

@section('title')
    Thêm sản phẩm
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
            <span class="text-muted fw-light">Sản Phẩm /</span><span> Thêm mới sản phẩm</span>
        </h4>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form tạo sản phẩm -->
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="app-ecommerce">
                <!-- Add Product -->
                <div
                    class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
                    <div class="d-flex flex-column justify-content-center">
                        <h4 class="mb-1 mt-3">Thêm sản phẩm mới</h4>
                        <p>Sản phẩm được đặt trên cửa hàng của bạn</p>
                    </div>
                    <div class="d-flex align-content-center flex-wrap gap-3">
                        <button type="reset" class="btn btn-outline-primary">Nhập Lại</button>
                        <a href="{{ route('products.index') }}" class="btn btn-info">Quay Lại</a>
                        <button type="submit" class="btn btn-primary">
                            Xuất bản
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Thông tin sản phẩm</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="text" class="form-control" id="ecommerce-product-name"
                                        placeholder="Tên sản phẩm" name="name" />
                                    <label for="ecommerce-product-name">Tên sản phẩm</label>
                                </div>
                                <div hidden class="form-floating form-floating-outline mb-4">
                                    <input type="text" class="form-control" id="ecommerce-product-slug"
                                        placeholder="Tên sản phẩm" name="slug" />
                                    <label for="ecommerce-product-name">Tên sản phẩm</label>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Content
                                        <span class="text-muted">(Optional)</span></label>
                                    <textarea class="form-control" name="content" id="content"></textarea>
                                </div>
                                <div class="form-floating form-floating-outline mb-4">
                                    <textarea class="form-control" name="description" id="description" rows="2" placeholder="Mô tả ngắn"></textarea>
                                    <label for="ecommerce-product-description">Mô tả ngắn</label>
                                </div>
                                <div class="mb-4">
                                    <label for="img_thumbnail" class="form-label">Ảnh sản phẩm</label>
                                    <input type="file" class="form-control" name="img_thumbnail" id="img_thumbnail">
                                </div>
                                <div class="form-floating form-floating-outline mb-4">
                                    <textarea class="form-control" name="user_manual" id="user_manual" rows="2" placeholder="Hướng dẫn sử dụng"></textarea>
                                    <label for="ecommerce-product-user_manual">Hướng dẫn sử dụng</label>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Album ảnh</h5>
                            </div>
                            <div class="card-body">
                                <div class="row gy-3" id="gallery-container">
                                    <div id="gallery_1">
                                        <label for="gallery_input_1" class="form-label">Gallery 1</label>
                                        <input type="file" class="form-control" name="product_galleries[]"
                                            id="gallery_input_1">
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary mt-3" id="add-gallery"><i
                                        class="mdi mdi-plus me-0 me-sm-1"></i>Thêm</button>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title">Thuộc Tính</h5>
                                <p>Thêm mới thuộc tính giúp sản phẩm có nhiều lựa chọn, như kích cỡ hay màu sắc.</p>
                            </div>
                            <div class="card-body" style="margin-top: -25px">
                                <input type="checkbox" id="hasVariants" class="form-check-input">
                                <label class="form-check-label" for="hasVariants">Sản phẩm này có biến thể</label>

                                <!-- Biến thể sản phẩm (ẩn theo mặc định) -->
                                <div id="variantsSection" style="display: none;">
                                    <div id="variants" class="mb-4">
                                        <div class="variant">
                                            <h5 class="mt-3">Thuộc Tính 1</h5>
                                            <div class="form-floating form-floating-outline mb-4">
                                                <input type="text" id="variant_sku_0" name="variants[0][sku]"
                                                    placeholder="Mã biến thể" class="form-control">
                                                <label for="variant_sku_0">Mã biến thể</label>
                                            </div>

                                            <div class="form-floating form-floating-outline mb-4">
                                                <input type="number" id="variant_price_modifier_0"
                                                    name="variants[0][price_modifier]" class="form-control"
                                                    step="0.01" placeholder="Giá điều chỉnh">
                                                <label for="variant_price_modifier_0">Giá điều chỉnh</label>
                                            </div>

                                            <div class="form-floating form-floating-outline mb-4">
                                                <input type="number" id="variant_stock_0" name="variants[0][stock]"
                                                    class="form-control" placeholder="Số lượng tồn kho">
                                                <label for="variant_stock_0">Số lượng tồn kho</label>
                                            </div>
                                            <div class="form-floating form-floating-outline mb-4">
                                                <input type="file" id="variant_image_0" name="variants[0][image]"
                                                    class="form-control">
                                            </div>
                                            <!-- Thuộc tính của biến thể -->
                                            <div id="attributesSection_0 mb-4">
                                                @foreach ($attributes as $attribute)
                                                    <div class="form-floating form-floating-outline mt-4">
                                                        <select class="select2 form-select mt-4"
                                                            id="variant_attribute_{{ $attribute->id }}_0"
                                                            name="variants[0][attributes][{{ $attribute->id }}]"
                                                            class="form-control">
                                                            <option value="">Chọn {{ $attribute->name }}</option>
                                                            @foreach ($attribute->values as $value)
                                                                <option value="{{ $value->id }}">{{ $value->value }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <label
                                                            for="variant_attribute_{{ $attribute->id }}_0">{{ $attribute->name }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" id="add-variant" class="btn btn-primary "><i
                                            class="mdi mdi-plus me-0 me-sm-1"></i>Thêm Thuộc
                                        Tính</button>
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
                                                name="is_active" id="is_active" checked>
                                            <label class="form-check-label" for="is_active">Kích hoạt</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-check form-switch form-switch-success">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                name="is_good_deal" id="is_good_deal" checked>
                                            <label class="form-check-label" for="is_good_deal">Sản phẩm tốt</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                name="is_new" id="is_new" checked>
                                            <label class="form-check-label" for="is_new">Sản phẩm mới</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-check form-switch form-switch-danger">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                name="is_show_home" id="is_show_home" checked>
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
                                        placeholder="Giá sản phẩm" name="base_price" />
                                    <label for="ecommerce-product-base_price">Giá sản phẩm</label>
                                </div>
                                <div class="form-floating form-floating-outline ">
                                    <input type="text" class="form-control" id="ecommerce-product-base_price"
                                        placeholder="Giá sản phẩm" name="price_sale" />
                                    <label for="ecommerce-product-base_price">Giá giảm giá</label>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Tổ Chức</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-4 col ecommerce-select2-dropdown">
                                    <div class="form-floating form-floating-outline">
                                        <select id="vendor" class="select2 form-select"
                                            data-placeholder="Select Vendor">
                                            <option value="">Chọn nhà cung cấp</option>
                                            <option value="men-clothing">
                                                Men's Clothing
                                            </option>
                                            <option value="women-clothing">
                                                Women's-clothing
                                            </option>
                                            <option value="kid-clothing">
                                                Kid's-clothing
                                            </option>
                                        </select>
                                        <label for="vendor">Nhà cung cấp</label>
                                    </div>
                                </div>
                                <div class="form-floating form-floating-outline">
                                    <select name="categories[]" class="form-select" multiple>
                                        @foreach ($category as $id => $name)
                                            <option value="{{ $id }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="name" class="form-label">Danh mục</label>
                                </div>
                                <div class="mb-3 mt-4">
                                    <div class="form-floating form-floating-outline">
                                        <input id="ecommerce-product-tags" class="form-control h-auto"
                                            name="ecommerce-product-tags" value="Normal,Standard,Premium"
                                            aria-label="Product Tags" />
                                        <label for="ecommerce-product-tags">Tags</label>
                                    </div>
                                </div>
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
    <script>
        CKEDITOR.replace('content');
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let galleryCount = 1;

            const galleryContainer = document.getElementById('gallery-container');
            const addGalleryButton = document.getElementById('add-gallery');

            addGalleryButton.addEventListener('click', function() {
                galleryCount++;
                const newGalleryDiv = document.createElement('div');
                newGalleryDiv.classList.add('col-12');
                newGalleryDiv.id = `gallery_${galleryCount}`;
                newGalleryDiv.innerHTML = `
                <label for="gallery_input_${galleryCount}" class="form-label">Gallery ${galleryCount}</label>
                <input type="file" class="form-control" name="product_galleries[]" id="gallery_input_${galleryCount}">
            `;
                galleryContainer.appendChild(newGalleryDiv);
            });
        });
    </script>
    <script>
        // JSON cho dữ liệu thuộc tính và các giá trị của chúng
        const attributesData = @json($attributes);

        document.getElementById('hasVariants').addEventListener('change', function() {
            const variantsSection = document.getElementById('variantsSection');
            variantsSection.style.display = this.checked ? 'block' : 'none';
        });

        let variantIndex = 1;
        document.getElementById('add-variant').addEventListener('click', function() {
            let variantsDiv = document.getElementById('variants');
            let newVariantDiv = document.createElement('div');
            newVariantDiv.classList.add('variant');
            newVariantDiv.innerHTML = `
            <h5 class="mt-3">Thuộc Tính ${variantIndex + 1}</h5>
            <div class="form-floating form-floating-outline mb-4">
            <input type="text" id="variant_sku_${variantIndex}" name="variants[${variantIndex}][sku]" placeholder="Mã biến thể" class="form-control">
            <label for="variant_sku_${variantIndex}">Mã biến thể</label>
            </div>

            <div class="form-floating form-floating-outline mb-4">
            <input type="number" id="variant_price_modifier_${variantIndex}" name="variants[${variantIndex}][price_modifier]" class="form-control" step="0.01" placeholder="Giá điều chỉnh">
            <label for="variant_price_modifier_${variantIndex}">Giá điều chỉnh</label>
            </div>

            <div class="form-floating form-floating-outline mb-4">
            <input type="number" id="variant_stock_${variantIndex}" name="variants[${variantIndex}][stock]" class="form-control" placeholder="Số lượng tồn kho">
            <label for="variant_stock_${variantIndex}">Số lượng tồn kho</label>
            </div>

            <div class="form-floating form-floating-outline mb-4">
            <input type="file" id="variant_image_${variantIndex}" name="variants[${variantIndex}][image]" class="form-control">
            </div>
                ${generateAttributeFields(variantIndex)}
    `;
            variantsDiv.appendChild(newVariantDiv);
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
                <select id="variant_attribute_${attribute.id}_${index}" name="variants[${index}][attributes][${attribute.id}]" class="form-control">
                    ${optionsHTML}
                </select>
                <label for="variant_attribute_${attribute.id}_${index}">${attribute.name}</label>
            </div>
        `;
            });
            return fieldsHTML;
        }
    </script>
@endsection
