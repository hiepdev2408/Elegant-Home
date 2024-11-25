@extends('client.layouts.master')
@section('title', 'Chi tiết đơn hàng')
@section('content')
    <div class="container mt-4">
        <h2 class="mb-4 text-center text-danger">Chi tiết đơn hàng #{{ $orderDetails->id }}</h2>

        <!-- Thông tin cơ bản đơn hàng -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Thông tin đơn hàng</h5>
                <span
                    class="badge
                    @switch($orderDetails->order->status_order)
                        @case('pending') bg-warning text-dark @break
                        @case('confirmed') bg-info text-white @break
                        @case('shipping') bg-primary @break
                        @case('delivered') bg-success @break
                        @case('canceled') bg-danger @break
                        @default bg-secondary
                    @endswitch">
                    @switch($orderDetails->order->status_order)
                        @case('pending')
                            Chờ xác nhận
                        @break

                        @case('confirmed')
                            Đã xác nhận
                        @break

                        @case('shipping')
                            Đang giao hàng
                        @break

                        @case('delivered')
                            Đã giao hàng
                        @break

                        @case('canceled')
                            Đã hủy
                        @break

                        @default
                            Không rõ
                    @endswitch
                </span>
            </div>
            <div class="card-body">
                <p><strong>Người nhận:</strong> {{ $orderDetails->order->user_name }}</p>
                <p><strong>Số điện thoại:</strong> {{ $orderDetails->order->user_phone }}</p>
                <p><strong>Địa chỉ:</strong> {{ $orderDetails->order->user_address }}</p>
                <p><strong>Ngày đặt hàng:</strong> {{ $orderDetails->order->created_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>

        <!-- Danh sách sản phẩm -->
        <div class="card shadow-sm">
            <div class="card-header bg-light">
                <h5 class="mb-0">Danh sách sản phẩm</h5>
            </div>
            <div class="card-body">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Hình ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderDetails->order->orderDetails as $key => $detail)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <img src="{{ Storage::url($detail->variant->image) }}"
                                        alt="{{ $detail->variant->product->name }}" class="img-fluid rounded shadow-sm"
                                        style="width: 80px; height: 80px;">
                                </td>
                                <td>{{ $detail->variant->product->name }}</td>
                                <td>{{ $detail->quantity }}</td>
                                <td>{{ number_format($detail->variant->product->price_sale, 0, ',', '.') }}₫</td>
                                <td>{{ number_format($detail->quantity * $detail->variant->product->price_sale, 0, ',', '.') }}₫</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tổng tiền -->
        <div class="card shadow-sm mt-4">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><strong>Tổng tiền:</strong></h5>
                <h4 class="text-danger">{{ number_format($orderDetails->order->total_amount, 0, ',', '.') }}₫</h4>
            </div>
        </div>

        <!-- Hành động -->
        <div class="mt-4 text-center">
            @if ($orderDetails->order->status_order === 'pending')
                <form action="{{ route('profile.order.cancel', $orderDetails->order->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-lg px-4">Hủy đơn hàng</button>
                </form>
            @elseif ($orderDetails->order->status_order === 'delivered')
                <a href=""
                    class="btn btn-success btn-lg px-4">Mua lại</a>
            @endif
        </div>
    </div>
@endsection
@section('style')
    <style>
        .card {
            border: none;
            border-radius: 10px;
        }

        .card-header {
            background-color: #f7f7f7;
            border-bottom: 2px solid #eee;
        }

        .table {
            border: 1px solid #ddd;
        }

        .table thead {
            background-color: #f9f9f9;
        }

        .table tbody tr:hover {
            background-color: #f2f2f2;
        }

        .img-fluid {
            object-fit: cover;
            border-radius: 10px;
        }

        .btn-lg {
            border-radius: 50px;
            font-size: 18px;
        }

        .text-danger {
            color: #e60023 !important;
        }

        h5 {
            font-weight: 600;
        }
    </style>
@endsection
