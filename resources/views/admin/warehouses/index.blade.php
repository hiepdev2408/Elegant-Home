@extends('admin.layouts.master')
@section('title')
    Lịch sử nhập kho
@endsection
@section('menu-item-product', 'open')

@section('menu-sub-warehouse', 'active')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4>
            <span class="text-muted fw-light">Kho hàng /</span> Lịch sử nhập kho
        </h4>
        <div class="card-header d-flex justify-content-end align-items-center mb-3">
            <a class="btn btn-info" href="{{ route('products.warehouses') }}">Quay
                lại</a>
        </div>
        <div class="card">
            <div class="card-body">
                <table id="example"
                    class=" text-center table table-bordered dt-responsive nowrap table-striped align-middle"
                    style="width:100%">
                    <thead class="border-top table-light">
                        <tr>
                            <th>STT</th>
                            <th>Tên sản phẩm</th>
                            <th>Người nhập</th>
                            <th>Số lượng </th>
                            <th>Giá nhập hàng</th>
                            <th>Tổng tiền </th>
                            <th>Ngày Nhập hàng</th>
                            <th>Hành động</th>

                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $index = 1;
                        @endphp
                        @foreach ($history as $item)
                            <tr>
                                <td>{{ $index++ }}</td>
                                <td>{{ $item->variant->product->name }} <br>
                                    @foreach ($item->variant->attributes as $attribute)
                                        @if (!$loop->first)
                                            /
                                        @endif
                                        {{ $attribute->attributeValue->value }}
                                    @endforeach
                                </td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ number_format($item->variant->wholesale_price, 0, ',', '.') }} VND</td>
                                <td>{{ number_format($item->Total_import_price, 0, ',', '.') }} VND</td>
                                <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <div class="d-flex justify-content-center">

                                        <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Show"
                                            class="btn btn-info btn-sm me-1"
                                            href="{{ route('warehouses.show', $item->id) }}">
                                            <i class="mdi mdi-eye"></i>
                                        </a>
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
@endsection

@section('script-libs')
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
