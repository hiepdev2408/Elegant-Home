@extends('admin.layouts.master')
@section('title')
    Thêm mới sản phẩm
@endsection
@section('menu-item-product')
    open
@endsection

@section('menu-sub-create-product')
    active
@endsection

@section('content')
    <div class="container">
        <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Thông tin</h4>
                        </div><!-- end card header -->
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
            <div class="row mt-5" style="height: 300px; overflow: scroll">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Gallary</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="row gy-4">
                                    <div>
                                        <label for="gallery_1" class="form-label">Galleries</label>
                                        <input type="file" class="form-control" name="product_galleries[]"
                                            id="gallery_1">
                                    </div>
                                    <div>
                                        <label for="gallery_2" class="form-label">Galleries 2</label>
                                        <input type="file" class="form-control" name="product_galleries[]"
                                            id="gallery_2">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>

            <div class="col-12">
                <h3 class="mt-5">Biến thể</h3>
                <div id="variant-container">
                    <!-- Nhóm biến thể đầu tiên -->
                    <div class="variant-group" data-variant="0">
                        <div class="row variant-row">
                            <div class="col">
                                <label for="">Thuộc tính</label>
                                <select name="product_attribute[attribute_id][0][]" class="form-control">
                                    @foreach ($attribute as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="">Giá trị</label>
                                <input type="text" name="product_attribute[value][0][]" class="form-control">
                            </div>
                        </div>

                        <!-- Nút thêm cặp thuộc tính-giá trị cho biến thể này -->
                        <button type="button" class="btn btn-secondary mt-2 add-attribute">Thêm thuộc tính</button>
                        <div class="row">
                            <div class="col-md-2 mt-3">
                                <label for="">SKU</label>
                                <input type="text" name="group[0][SKU]" value="{{ strtoupper(Str::random(8)) }}"
                                    class="form-control" required>
                            </div>

                            <div class="col-md-2 mt-3">
                                <label for="">Số lượng</label>
                                <input type="text" name="group[0][stock]" class="form-control" required>
                            </div>

                            <div class="col-md-2 mt-3">
                                <label for="">Giá bán</label>
                                <input type="text" name="group[0][price]" class="form-control" required>
                            </div>

                            <div class="col-md-2 mt-3">
                                <label for="">Giá sale</label>
                                <input type="text" name="group[0][price_sale]" class="form-control">
                            </div>

                            <div class="col-md-4 mt-3">
                                <label for="">Image Variant</label>
                                <input type="file" name="group[0][img_variant]" class="form-control">
                            </div>
                        </div>

                        <hr class="text-danger">
                    </div>
                </div>

                <!-- Nút thêm biến thể -->
                <button type="button" class="btn btn-primary mt-3" id="add-variant">Thêm biến thể</button>
            </div>

            <button class="btn btn-success mt-3">Thêm mới</button>
        </form>
    </div>
@endsection

@section('script-libs')
    <script>
        let variantCount = 0;

        // Thêm biến thể mới
        document.getElementById('add-variant').addEventListener('click', function() {
            variantCount++;
            const container = document.getElementById('variant-container');

            // Tạo hàng mới cho biến thể
            const newRow = document.createElement('div');
            newRow.classList.add('variant-group');
            newRow.setAttribute('data-variant', variantCount);
            newRow.innerHTML = `
            <div class="row variant-row">
                <div class="col">
                    <label for="">Thuộc tính</label>
                    <select name="product_attribute[attribute_id][${variantCount}][]" class="form-control">
                        @foreach ($attribute as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label for="">Giá trị</label>
                    <input type="text" name="product_attribute[value][${variantCount}][]" class="form-control">
                </div>
            </div>

            <button type="button" class="btn btn-secondary mt-2 add-attribute">Thêm thuộc tính</button>
            <div class="row">
                <div class="col-md-2 mt-3">
                    <label for="">SKU</label>
                    <input type="text" name="group[${variantCount}][SKU]" value="{{ strtoupper(Str::random(8)) }}" class="form-control" required>
                </div>

                <div class="col-md-2 mt-3">
                    <label for="">Số lượng</label>
                    <input type="text" name="group[${variantCount}][stock]" class="form-control" required>
                </div>

                <div class="col-md-2 mt-3">
                    <label for="">Giá bán</label>
                    <input type="text" name="group[${variantCount}][price]" class="form-control" required>
                </div>

                <div class="col-md-2 mt-3">
                    <label for="">Giá sale</label>
                    <input type="text" name="group[${variantCount}][price_sale]" class="form-control">
                </div>

                <div class="col-md-4 mt-3">
                    <label for="">Image Variant</label>
                    <input type="file" name="group[${variantCount}][img_variant]" class="form-control">
                </div>
            </div>
            <hr class="text-danger">
        `;

            container.appendChild(newRow);
        });

        // Thêm thuộc tính mới vào biến thể
        document.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('add-attribute')) {
                const variantGroup = e.target.closest('.variant-group');
                const variantIndex = variantGroup.getAttribute('data-variant');

                const newAttributeRow = document.createElement('div');
                newAttributeRow.classList.add('row', 'variant-row', 'mt-2');
                newAttributeRow.innerHTML = `
                <div class="col">
                    <label>Thuộc tính</label>
                    <select name="product_attribute[attribute_id][${variantIndex}][]" class="form-control">
                        @foreach ($attribute as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label>Giá trị</label>
                    <input type="text" name="product_attribute[value][${variantIndex}][]" class="form-control">
                </div>

            `;

                variantGroup.insertBefore(newAttributeRow, e.target);
            }
        });


        // Hiển thị slug
        document.getElementById('productName').addEventListener('input', function() {
            const name = this.value;

            // Hàm chuyển đổi ký tự tiếng Việt
            const slugify = (text) => {
                const specialCharsMap = {
                    'à': 'a',
                    'á': 'a',
                    'ả': 'a',
                    'ã': 'a',
                    'ạ': 'a',
                    'ầ': 'a',
                    'ấ': 'a',
                    'ẩ': 'a',
                    'ẫ': 'a',
                    'ậ': 'a',
                    'è': 'e',
                    'é': 'e',
                    'ẻ': 'e',
                    'ẽ': 'e',
                    'ẹ': 'e',
                    'ề': 'e',
                    'ế': 'e',
                    'ể': 'e',
                    'ễ': 'e',
                    'ệ': 'e',
                    'ì': 'i',
                    'í': 'i',
                    'ỉ': 'i',
                    'ĩ': 'i',
                    'ị': 'i',
                    'ò': 'o',
                    'ó': 'o',
                    'ỏ': 'o',
                    'õ': 'o',
                    'ọ': 'o',
                    'ồ': 'o',
                    'ố': 'o',
                    'ổ': 'o',
                    'ỗ': 'o',
                    'ộ': 'o',
                    'ù': 'u',
                    'ú': 'u',
                    'ủ': 'u',
                    'ũ': 'u',
                    'ụ': 'u',
                    'ừ': 'u',
                    'ứ': 'u',
                    'ử': 'u',
                    'ữ': 'u',
                    'ự': 'u',
                    'ỳ': 'y',
                    'ý': 'y',
                    'ỷ': 'y',
                    'ỹ': 'y',
                    'ỵ': 'y',
                    'Đ': 'D',
                    'đ': 'd'
                };

                // Thay thế các ký tự đặc biệt
                text = text.replace(/[àáảãạầấẩẫậèéẻẽẹềếểễệìíỉĩịòóỏõọồốổỗộùúủũụừứửữựỳýỷỹỵĐđ]/g, (char) =>
                    specialCharsMap[char] || char);

                return text
                    .toLowerCase() // Chuyển về chữ thường
                    .replace(/\s+/g, '-') // Thay thế khoảng trắng bằng dấu '-'
                    .replace(/[^\w\-]+/g, '') // Xóa ký tự không hợp lệ
                    .replace(/\-\-+/g, '-') // Xóa dấu '-' trùng lặp
                    .replace(/^-+/, '') // Xóa dấu '-' ở đầu
                    .replace(/-+$/, ''); // Xóa dấu '-' ở cuối
            };

            const slug = slugify(name);
            document.getElementById('productSlug').value = slug;
        });
    </script>
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection
