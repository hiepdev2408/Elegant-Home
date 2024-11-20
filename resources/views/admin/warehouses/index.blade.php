@extends('admin.layouts.master')
@section('title')
    Danh sách Nhập hàng
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
            <h5 class="card-title">Danh sách nhập hàng</h5>
            <a href="{{ route('warehouses.create') }}" class="btn btn-info">Thêm bài viết</a>
            <a href="" class="btn btn-primary" onclick="window.print()">Xuất phiếu nhập kho</a>
        </div>
        <div class="card-datatable table-responsive">
            <table class="datatables-users table">
                <thead class="border-top table-light">
                    <tr>
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Người nhập</th>
                        <th>Số lượng </th>
                        <th>Giá nhập hàng</th>
                        <th>Ngày Nhập hàng</th>
                        <th>Ngày sản xuất</th>
                        <th>Tổng tiền </th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    @php
                         $index=1;
                    @endphp
                    @foreach ($warehouses as $item)
                        <tr>
                            <td>{{ $index++ }}</td>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->price_import, 0, ',', '.') }} VND</td>
                            <td>{{ $item->date_import}}</td>
                            <td>{{ $item->Date_manufacture}}</td>
                            <td>{{ number_format($item->Total_amount, 0, ',', '.') }} VND</td>
                            <td>
                                <div class="d-flex justify-content-center">

                                    <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Show"
                                        class="btn btn-info btn-sm me-1" href="{{route('warehouses.show',$item->id)}}">
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
