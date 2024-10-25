@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <h2>Thêm Sản Phẩm Nội Thất</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form tạo sản phẩm -->
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Thông tin</h4>
                        </div><!-- end card header -->
                        {{-- @dd($attributes) --}}
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="row gy-4">
                                    <div class="col-md-4">
                                        <div class="mt-3">
                                            <label for="">Tên sản phẩm</label>
                                            <input type="text" id="productName" name="name" class="form-control">
                                        </div>
                                        <div class="mt-3">
                                            <label for="">Slug</label>
                                            <input type="text" id="productSlug" name="slug" class="form-control"
                                                disabled>
                                        </div>

                                        <div class="mt-3">
                                            <label for="name" class="form-label">Danh mục</label>
                                            <select name="categories[]" class="form-control" multiple>
                                                @foreach ($category as $id => $name)
                                                    <option value="{{ $id }}">{{ $name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mt-3">
                                            <label for="">Giá sản phẩm</label>
                                            <input type="text" name="base_price" class="form-control">
                                        </div>
                                        <div class="mt-3">
                                            <label for="img_thumbnail" class="form-label">Img thumbnail</label>
                                            <input type="file" class="form-control" name="img_thumbnail"
                                                id="img_thumbnail">
                                        </div>

                                    </div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-check form-switch form-switch-secondary">
                                                    <input class="form-check-input" type="checkbox" role="switch"
                                                        name="is_active" id="is_active" checked>
                                                    <label class="form-check-label" for="is_active">Is Active</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-check form-switch form-switch-success">
                                                    <input class="form-check-input" type="checkbox" role="switch"
                                                        name="is_good_deal" id="is_good_deal" checked>
                                                    <label class="form-check-label" for="is_good_deal">Is good deal</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" role="switch"
                                                        name="is_new" id="is_new" checked>
                                                    <label class="form-check-label" for="is_new">Is new</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-check form-switch form-switch-danger">
                                                    <input class="form-check-input" type="checkbox" role="switch"
                                                        name="is_show_home" id="is_show_home" checked>
                                                    <label class="form-check-label" for="is_show_home">Is show home</label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="mt-3">
                                                <label for="description" class="form-label">Description</label>
                                                <textarea class="form-control" name="description" id="description" rows="2"></textarea>
                                            </div>
                                            <div class="mt-3">
                                                <label for="user_manual" class="form-label">User manual</label>
                                                <textarea class="form-control" name="user_manual" id="user_manual" rows="2"></textarea>
                                            </div>
                                            {{-- Hướng dẫn sử dụng --}}
                                            <div class="mt-3">
                                                <label for="content" class="form-label">Content</label>
                                                <textarea class="form-control" name="content" id="content"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Gallery</h4>
                        </div>
                        <div class="card-body">
                            <div class="row gy-4" id="gallery-container">
                                <div class="col-12" id="gallery_1">
                                    <label for="gallery_input_1" class="form-label">Gallery 1</label>
                                    <input type="file" class="form-control" name="product_galleries[]"
                                        id="gallery_input_1">
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary mt-3" id="add-gallery">Thêm Gallery</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Toggle thêm biến thể -->
            <div class="form-group form-check">
                <input type="checkbox" id="hasVariants" class="form-check-input">
                <label class="form-check-label" for="hasVariants">Sản phẩm này có biến thể</label>
            </div>

            <!-- Biến thể sản phẩm (ẩn theo mặc định) -->
            <div id="variantsSection" style="display: none;">
                <h4>Biến Thể Sản Phẩm</h4>
                <div id="variants">
                    <div class="variant">
                        <h5>Biến Thể 1</h5>
                        <div class="form-group">
                            <label for="variant_sku_0">Mã biến thể:</label>
                            <input type="text" id="variant_sku_0" name="variants[0][sku]" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="variant_price_modifier_0">Giá điều chỉnh:</label>
                            <input type="number" id="variant_price_modifier_0" name="variants[0][price_modifier]"
                                class="form-control" step="0.01">
                        </div>

                        <div class="form-group">
                            <label for="variant_stock_0">Số lượng tồn kho:</label>
                            <input type="number" id="variant_stock_0" name="variants[0][stock]" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="variant_image_0">Ảnh biến thể:</label>
                            <input type="file" id="variant_image_0" name="variants[0][image]" class="form-control">
                        </div>
                        <!-- Thuộc tính của biến thể -->
                        <div id="attributesSection_0">

                            @foreach ($attributes as $attribute)
                                <div class="form-group">
                                    <label for="variant_attribute_{{ $attribute->id }}_0">{{ $attribute->name }}:</label>
                                    <select id="variant_attribute_{{ $attribute->id }}_0"
                                        name="variants[0][attributes][{{ $attribute->id }}]" class="form-control">
                                        <option value="">Chọn {{ $attribute->name }}</option>
                                        @foreach ($attribute->values as $value)
                                            <option value="{{ $value->id }}">{{ $value->value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <button type="button" id="add-variant" class="btn btn-secondary">Thêm Biến Thể</button>
            </div>

            <!-- Nút submit -->
            <button type="submit" class="btn btn-primary">Lưu Sản Phẩm</button>
        </form>
    </div>
@endsection
@section('script-libs')
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
                <h5>Biến Thể ${variantIndex + 1}</h5>
                <div class="form-group">
                    <label for="variant_name_${variantIndex}">Mã sản phẩm:</label>
                    <input type="text" id="variant_sku_${variantIndex}" name="variants[${variantIndex}][sku]" class="form-control">
                </div>
                <div class="form-group">
                    <label for="variant_price_modifier_${variantIndex}">Giá điều chỉnh:</label>
                    <input type="number" id="variant_price_modifier_${variantIndex}" name="variants[${variantIndex}][price_modifier]" class="form-control" step="0.01">
                </div>
                <div class="form-group">
                    <label for="variant_stock_${variantIndex}">Số lượng tồn kho:</label>
                    <input type="number" id="variant_stock_${variantIndex}" name="variants[${variantIndex}][stock]" class="form-control">
                </div>
                <div class="form-group">
                    <label for="variant_image_${variantIndex}">Ảnh biến thể:</label>
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
                let optionsHTML = '<option value="">Chọn ' + attribute.name + '</option>';
                attribute.values.forEach(value => {
                    optionsHTML += `<option value="${value.id}">${value.value}</option>`;
                });

                fieldsHTML += `
            <div class="form-group">
                <label for="variant_attribute_${attribute.id}_${index}">${attribute.name}:</label>
                <select id="variant_attribute_${attribute.id}_${index}" name="variants[${index}][attributes][${attribute.id}]" class="form-control">
                    ${optionsHTML}
                </select>
            </div>
        `;
            });
            return fieldsHTML;
        }
    </script>
@endsection
