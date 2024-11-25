    @extends('admin.layouts.master')
    @section('title')
        Danh sách Xuất hàng
    @endsection

    @section('menu-item-post')
        open
    @endsection

    @section('menu-sub-index-post')
        active
    @endsection

    @section('content')
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Danh sách xuất hàng</h5>
                <a href="{{ route('exportwarehouses.create') }}" class="btn btn-info">Thêm bài viết</a>
                <a href="" class="btn btn-primary" onclick="window.print()">Xuất phiếu nhập kho</a>
            </div>
            <div class="card-datatable table-responsive">
                <table class="datatables-users table">
                    <thead class="border-top table-light">
                        <tr>
                            <th>STT</th>
                            <th>Tên sản phẩm</th>
                            <th>Người xuất hàng</th>
                            <th>Số lượng trong kho</th>
                            <th>Số lượng xuất kho</th>
                            <th>Ngày xuất kho</th>
                            <th>Ghi chú</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $index=1;
                        @endphp
                        @foreach ($warehouseExport as $item)
                            <tr>
                                <td>{{ $index++ }}</td>
                                <td>{{ $item->warehouse->product->name}}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->warehouse->quantity }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->Shipment_date}}</td>
                                <td>{{ $item->note}}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Show"
                                            class="btn btn-info btn-sm me-1" href="{{route('exportwarehouses.show',$item->id)}}">
                                            <i class="mdi mdi-eye"></i>
                                        </a>
                                    </div>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endsection
