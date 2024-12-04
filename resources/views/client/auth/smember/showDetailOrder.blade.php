@extends('client.layouts.master')
@section('title', 'Chi tiết đơn hàng')
@section('content')
    <div class="container mt-5">
        <div class="mt-3">
            <h4 class="text-center">Chi tiết đơn hàng #{{ $order->id }}</h4>
        </div>
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-white text-dark d-flex justify-content-between">
                <span>Đơn hàng #{{ $order->id }}</span>
                <span>{{ date('d/m/Y', $order->order_date) }}</span>
            </div>
            <div class="card-body">
                <p><strong>Tổng tiền:</strong> {{ number_format($order->total_amount, 0, ',', '.') }} VND</p>
                <p><strong>Trạng thái:</strong>
                    @if ($order->status_order == 'pending')
                        <span class="badge bg-info">Chờ xác nhận</span>
                    @elseif ($order->status_order == 'comfirmed')
                        <span class="badge bg-success">Đã xác nhận</span>
                    @elseif ($order->status_order == 'shipping')
                        <span class="badge bg-warning">Chờ giao hàng</span>
                    @elseif ($order->status_order == 'delivered')
                        <span class="badge bg-primary">Đã giao hàng</span>
                    @elseif ($order->status_order == 'completed')
                        <span class="badge bg-primary">Đã nhận hàng</span>
                    @elseif ($order->status_order == 'canceled')
                        <span class="badge bg-danger">Đơn hàng đã hủy</span>
                    @endif
                </p>
                <h5 class="mt-3">Chi tiết sản phẩm:</h5>
                <ul class="list-group">
                    @foreach ($order->orderDetails as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>({{ $item->quantity }}x) - {{ $item->variant->product->name }} </span>
                            <span>
                                <img src="{{ Storage::url($item->variant->product->img_thumbnail) }}" width="150px" alt="">
                                {{ number_format($item->total_amount, 0, ',', '.') }} VND</span>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="card-footer text-left">
                <a href="{{ route('profile.order') }}" class="btn btn-sm btn-outline-warning float-end me-3">Quay lại</a>
            </div>

        </div>
    </div>
@endsection
