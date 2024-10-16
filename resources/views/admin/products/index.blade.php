@extends('admin.layouts.master')
<<<<<<< HEAD
=======

@section('title')
    Danh sách sản phẩm
@endsection

@section('menu-item-product')
    open
@endsection

@section('menu-sub-index-product')
    active
@endsection

>>>>>>> 07f76b3bbae28867416dd541f777f9ba7e194c29
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4>
            <span class="text-muted fw-light">Quản lý loại tin /</span> Danh sách
        </h4>
        @if (session()->has('success'))
            <div class="alert alert-success fw-bold">
                {{ session()->get('success') }}
            </div>
        @endif
        <div class="card-header d-flex justify-content-end align-items-center mb-3">
            <a class="btn btn-primary" href="{{ route('products.create') }}"><i class="mdi mdi-plus me-0 me-sm-1"></i>Thêm sản
                phẩm</a>
        </div>
        <div class="card">
            <div class="card-body">
                <table id="example"
                    class=" text-center table table-bordered dt-responsive nowrap table-striped align-middle"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên sản phẩm</th>
                            <th>Danh mục</th>
                            <th>Hình ảnh chính</th>
                            <th>Thuộc tính</th>
                            <th>Biến thể</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>
                                    @foreach ($product->categories as $category)
                                        <span class="badge badge-primary">{{ $category->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @if ($product->img_thumbnail)
                                        <img src="{{ Storage::url($product->img_thumbnail) }}" alt="{{ $product->name }}"
                                            style="width: 100px;">
                                    @else
                                        <span>Chưa có hình</span>
                                    @endif
                                </td>
                                <td>
                                    @foreach ($product->productAttributes->groupBy('attribute_id') as $attributeGroup)
                                        @foreach ($attributeGroup as $attribute)
                                            <div class="product-attribute-item">
                                                <span class="attribute-name">{{ $attribute->attribute->name }}:</span>
                                                @if ($attribute->attribute->name == 'Màu sắc')
                                                    <span class="color-indicator"
                                                        style="background: {{ $attribute->value }};"></span>
                                                @else
                                                    <span class="attribute-value">{{ $attribute->value }}</span>
                                                @endif
                                            </div>
                                        @endforeach
                                    @endforeach
                                </td>
                                <td>
                                    @if ($product->productAttributes->isNotEmpty())
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Giá trị</th>
                                                    <th>SKU</th>
                                                    <th>Tồn kho</th>
                                                    <th>Giá</th>
                                                    <th>Giá khuyến mãi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($product->productAttributes as $value => $attributes)
                                                    <tr>
                                                        <td>{{ $value }}</td>
                                                        <td>{{ $attributes->group->SKU ?? 'N/A' }}</td>
                                                        <td>{{ $attributes->group->stock ?? 'N/A' }}</td>
                                                        <td>{{ number_format($attributes->group->price ?? 0, 0, ',', '.') }}
                                                            VNĐ</td>
                                                        <td>{{ number_format($attributes->group->price_sale ?? 0, 0, ',', '.') }}
                                                            VNĐ</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <span class="text-muted">Không có biến thể</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Chỉnh
                                        sửa</a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('style-libs')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <style>
        .product-attribute-item {
            display: flex;
            align-items: center;
            margin: 5px 0;
            justify-content: space-between;
            /* Căn giữa các phần tử */
        }

        .color-indicator {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 1px solid #ccc;
            margin-left: 10px;
            /* Khoảng cách giữa tên thuộc tính và màu sắc */
        }
    </style>
@endsection

@section('script-libs')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script>
        new DataTable("#example", {
            order: [
                [0, 'desc']
            ]
        });
    </script>
@endsection
