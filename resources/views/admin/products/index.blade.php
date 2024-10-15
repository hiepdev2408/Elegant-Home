@extends('admin.layouts.master')
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
                            <th>Thông tin sản phẩm</th>
                            <th>Image</th>
                            <th></th>
                            <th>Active</th>
                            <th>Biến thể</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key => $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>
                                    @if ($product->img_thumbnail)
                                        <img class="rounded-2" src="{{ Storage::url($product->img_thumbnail) }}"
                                            width="50px" height="50px">
                                    @endif
                                </td>
                                <td>
                                    <li>{!! $product->is_active
                                        ? '<span class="badge bg-success">YES</span>'
                                        : '<span class="badge bg-danger">NO</span>' !!}</li>
                                    <li>{!! $product->is_good_deal
                                        ? '<span class="badge bg-success">YES</span>'
                                        : '<span class="badge bg-danger">NO</span>' !!}</li>
                                    <li>{!! $product->is_new ? '<span class="badge bg-success">YES</span>' : '<span class="badge bg-danger">NO</span>' !!}</li>
                                    <li>{!! $product->is_show_home
                                        ? '<span class="badge bg-success">YES</span>'
                                        : '<span class="badge bg-danger">NO</span>' !!}</li>
                                </td>
                                <td>
                                    @php
                                        $displayedSKUs = [];
                                    @endphp

                                    <ul class="product-attributes">
                                        @foreach ($product->productAttributes as $productAttribute)
                                            <li class="product-attribute-item">
                                                <span
                                                    class="attribute-name">{{ $productAttribute->attribute->name }}:</span>
                                                @if ($productAttribute->attribute->name == 'Màu sắc')
                                                    <div class="color-indicator"
                                                        style="background: {{ $productAttribute->value }}; display: inline-block; width: 20px; height: 20px; margin-left: 5px;">
                                                    </div>
                                                @else
                                                    <span class="attribute-value">{{ $productAttribute->value }}</span>
                                                @endif

                                                <div class="combinations">
                                                    @foreach ($productAttribute->combinations as $combination)
                                                        @if (!in_array($combination->group->SKU, $displayedSKUs))
                                                            <div class="variant-info">
                                                                <p><strong>SKU:</strong> {{ $combination->group->SKU }}</p>
                                                                <p><strong>Giá:</strong> {{ $combination->group->price }}
                                                                </p>
                                                                <p><strong>Giá sale:</strong>
                                                                    {{ $combination->group->price_sale }}</p>
                                                                <p><strong>Tồn kho:</strong>
                                                                    {{ $combination->group->stock }}</p>
                                                            </div>
                                                            @php
                                                                // Thêm SKU vào danh sách đã hiển thị
                                                                $displayedSKUs[] = $combination->group->SKU;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Show"
                                            class="btn btn-info btn-sm me-2"
                                            href="{{ route('products.show', $product->id) }}"><i
                                                class="mdi mdi-eye"></i></a>
                                        <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Update"
                                            class="btn btn-warning btn-sm me-2"
                                            href="{{ route('products.edit', $product->id) }}"><i
                                                class="mdi mdi-pencil"></i></a>

                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-title="Delete" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Bạn có muốn xóa không')">
                                                <i class="mdi mdi-delete-circle"></i></button>

                                        </form>
                                    </div>
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
        }

        .attribute-name {
            font-weight: bold;
            /* Làm đậm tên thuộc tính */
            margin-right: 10px;
            /* Khoảng cách giữa tên thuộc tính và giá trị */
        }

        .color-indicator {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            border: 1px solid #ccc;
            /* Thêm viền nhẹ cho hình tròn */
            margin-left: 5px;
            /* Khoảng cách giữa giá trị và hình tròn */
        }

        .attribute-value {
            font-style: italic;
            /* Chế độ nghiêng cho giá trị không phải màu */
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
