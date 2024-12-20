@extends('admin.layouts.master')

@section('title')
    Quản lý kho
@endsection
@section('menu-item-product')
    open
@endsection

@section('menu-sub-warehouse')
    active
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4>
            <span class="text-muted fw-light">Sản Phẩm /</span> Kho hàng
        </h4>

        <div class="card-header d-flex justify-content-end align-items-center mb-3 gap-3">
            <a class="btn btn-primary" href="{{ route('warehouses.create') }}"><i class="mdi mdi-plus me-0 me-sm-1"></i>Nhập
                Kho</a>
            <a class="btn btn-warning" href="{{ route('warehouses.index') }}"><i class="mdi mdi-plus me-0 me-sm-1"></i>Lịch
                sử</a>
            <a class="btn btn-info" href="{{ route('products.index') }}">Xem sản phẩm</a>
        </div>
        <div class="card">
            <div class="card-body">
                <table id="example"
                    class=" text-center table table-bordered dt-responsive nowrap table-striped align-middle"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Mã</th>
                            <th>Giá</th>
                            <th>Ảnh</th>
                            <th>Số Lượng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key => $product)
                            @foreach ($product->variants as $variant)
                                <tr>
                                    <td>{{ $variant->product->name }} <br>
                                        @foreach ($variant->attributes as $attribute)
                                            @if (!$loop->first)
                                                /
                                            @endif
                                            {{ $attribute->attributeValue->value }}
                                        @endforeach
                                    </td>
                                    <td>{{ $variant->sku }}</td>
                                    <td>{{ $variant->price_modifier }}</td>
                                    <td>
                                        <img class="rounded-3" src="{{ Storage::url($variant->image) }}" alt="No Image"
                                            height="30px">
                                    </td>
                                    <td>{{ $variant->stock }}</td>
                                </tr>
                            @endforeach
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
