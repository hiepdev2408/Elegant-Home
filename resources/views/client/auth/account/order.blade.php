@extends('client.layouts.master')
@section('order', 'active')
@section('content')
    <div class="container">
        @if (session()->has('success'))
            <div class="alert alert-success fw-bold">
                {{ session()->get('success') }}
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger fw-bold">
                {{ session()->get('error') }}
            </div>
        @endif
        <div class="row">
            @include('client.auth.layouts.master')
            <section class="col-9">
                <div class="container mt-4">
                    <div class="order-status-bar">
                        <button class="status-btn active" data-status="all">Tất cả</button>
                        <button class="status-btn" data-status="pending">Chờ xác nhận</button>
                        <button class="status-btn" data-status="confirmed">Đã xác nhận</button>
                        <button class="status-btn" data-status="shipping">Đang vận chuyển</button>
                        <button class="status-btn" data-status="delivered">Đã giao hàng</button>
                        <button class="status-btn" data-status="canceled">Đã hủy</button>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Hình ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                            <th>Trạng thái</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="order-list">
                        @foreach ($orderDetails as $key => $order)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <img src="{{ Storage::url($order->variant->image) }}" alt="product"
                                        class="img-thumbnail">
                                </td>
                                <td class="product-name">{{ $order->variant->product->name }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ number_format($order->total_amount, '0', '0', ',') }} VNĐ</td>
                                <td>
                                    @if ($order->order->status_order == 'pending')
                                        <p>Chờ xác nhận</p>
                                    @elseif ($order->order->status_order == 'comfirmed')
                                        <p>Đã xác nhận</p>
                                    @elseif ($order->order->status_order == 'shipping')
                                        <p>Đang giao hàng</p>
                                    @elseif ($order->order->status_order == 'delivered')
                                        <p>Đã giao hàng</p>
                                    @else
                                        <p>Đơn hàng đã hủy</p>
                                    @endif
                                </td>
                                <td>
                                <td>
                                    <div class="order-actions">
                                        @if ($order->order->status_order === 'pending')
                                            <a href="{{ route('profile.order.showDetailOrder', $order->id) }}"
                                                class="d-block btn btn-primary btn-sm">Xem chi tiết</a>
                                            <form action="{{ route('profile.order.cancel', $order->id) }}" method="post"
                                                class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm">Hủy đơn hàng</button>
                                            </form>
                                        @elseif ($order->order->status_order === 'comfirmed')
                                            <a href="{{ route('profile.order.showDetailOrder', $order->id) }}"
                                                class="d-block btn btn-primary btn-sm">Xem chi tiết</a>
                                        @elseif ($order->order->status_order === 'shipping')
                                            <a href="{{ route('profile.order.showDetailOrder', $order->id) }}"
                                                class="d-block btn btn-primary btn-sm">Xem chi tiết</a>
                                            <form action="" method="post" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">Đã nhận hàng</button>
                                            </form>
                                        @elseif ($order->order->status_order === 'delivered')
                                            <a href="{{ route('profile.order.showDetailOrder', $order->id) }}"
                                                class="d-block btn btn-primary btn-sm">Xem chi tiết</a>
                                            <form action="" method="post" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">Mua lại</button>
                                            </form>
                                        @elseif ($order->order->status_order === 'canceled')
                                            <form action="" method="post" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">Mua lại</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>
        </div>
    </div>
@endsection

@section('style')
    <style>
        /* Giao diện thanh trạng thái giống Shopee */
        .order-status-bar {
            display: flex;
            justify-content: space-around;
            align-items: center;
            background-color: #fff;
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }

        .status-btn {
            flex-grow: 1;
            border: none;
            background: none;
            font-size: 14px;
            font-weight: 500;
            color: #666;
            padding: 10px;
            transition: all 0.3s ease-in-out;
        }

        .status-btn.active {
            color: #fff;
            background-color: #d9534f;
            border-radius: 20px;
            font-weight: 600;
        }

        .status-btn:hover {
            color: #d9534f;
        }

        /* Table styling */
        .table {
            margin-top: 20px;
        }

        .table img {
            width: 50px;
            height: 50px;
            object-fit: cover;
        }

        .table td {
            vertical-align: middle;
        }
    </style>
@endsection
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.status-btn');
            const orderList = document.getElementById('order-list');

            // Hàm tải dữ liệu đơn hàng
            function loadOrders(status) {
                fetch(`/orders?status=${status}`)
                    .then(response => response.json())
                    .then(data => {
                        let content = '';
                        if (data.length === 0) {
                            content = `
                                <tr>
                                    <td colspan="5" class="text-center">Không có đơn hàng nào.</td>
                                </tr>
                            `;
                        } else {
                            data.forEach((order, index) => {
                                content += `
                                    <tr>
                                        <td>${index + 1}</td>
                                        <td><img src="${order.image}" alt="Hình sản phẩm"></td>
                                        <td>${order.product_name}</td>
                                        <td>${order.quantity}</td>
                                        <td>${order.total_price.toLocaleString()}₫</td>
                                    </tr>
                                `;
                            });
                        }
                        orderList.innerHTML = content;
                    })
                    .catch(error => console.error('Error:', error));
            }

            // Xử lý sự kiện khi nhấn vào các nút trạng thái
            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    buttons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                    const status = this.getAttribute('data-status');
                    loadOrders(status);
                });
            });

            // Tải dữ liệu ban đầu
            loadOrders('all');
        });
    </script>
@endsection
