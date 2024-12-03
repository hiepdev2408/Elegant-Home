@extends('client.layouts.master')
@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">Lịch sử đơn hàng của bạn</h2>
        @foreach ($orders as $order)
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
                                <span>{{ number_format($item->total_amount, 0, ',', '.') }} VND</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="card-footer text-right d-inline-flex">


                    @if ($order->status_order != 'canceled')
                        <form action="{{ route('chat.create', Auth::user()->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-warning">Liên Hệ Admin</button>
                        </form>
                    @endif

                    <a href="" class="btn btn-sm btn-outline-primary">Xem chi tiết</a>
                    {{-- <a href="">{{$order->productVariant->id}}</a> --}}

                    @if (
                        $order->status_order != 'comfirmed' &&
                            $order->status_order != 'shipping' &&
                            $order->status_order != 'delivered' &&
                            $order->status_order != 'canceled' &&
                            $order->status_order != 'completed')
                        <form action="{{ route('profile.order.cancel', $order->id) }}" method="POST"
                            style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này không?')">Hủy đơn
                                hàng</button>
                        </form>
                    @elseif($order->status_order == 'comfirmed')
                        <span class="badge badge-secondary">Đơn hàng đã xác nhận</span>
                    @elseif($order->status_order == 'shipping')
                        <span class="badge badge-secondary">Đơn hàng đang trong quá trình vận chuyển</span>
                    @elseif($order->status_order == 'delivered')
                        <form action="{{ route('profile.order.completed', $order->id) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-success">Đã nhận hàng</button>
                        </form>
                    @elseif($order->status_order == 'completed')
                        Null
                    @elseif($order->status_order == 'canceled')
                        <a href="" class="btn btn-sm btn-outline-danger">Mua
                            lại</a>
                    @endif
                </div>

            </div>
        @endforeach

        @if ($orders->isEmpty())
            <div class="alert alert-info text-center">
                Bạn chưa có đơn hàng nào.
            </div>
        @endif
    </div>
@endsection
