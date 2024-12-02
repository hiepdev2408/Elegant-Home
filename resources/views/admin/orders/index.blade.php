@extends('admin.layouts.master')
@section('content')
    <div class="container mt-4">
        <h2 class="mb-4 text-center text-primary">Quản lý đơn hàng</h2>

        <!-- Tìm kiếm và lọc -->
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <form action="{{ route('orders.index') }}" method="GET" class="row g-3">
                    <!-- Lọc theo ID đơn hàng -->
                    <div class="col-md-3">
                        <input type="text" name="order_id" class="form-control" placeholder="ID đơn hàng"
                            value="{{ request('order_id') }}">
                    </div>
                    <!-- Lọc theo tên khách hàng -->
                    <div class="col-md-3">
                        <input type="text" name="customer_name" class="form-control" placeholder="Tên khách hàng"
                            value="{{ request('customer_name') }}">
                    </div>
                    <!-- Lọc theo trạng thái -->
                    <div class="col-md-3">
                        <select name="status_order" class="form-select">
                            <option value="">-- Trạng thái --</option>
                            @foreach(['pending' => 'Chờ xác nhận', 'confirmed' => 'Đã xác nhận', 'shipping' => 'Chờ giao hàng',
                                      'delivered' => 'Đang giao hàng', 'completed' => 'Đã nhận hàng', 'canceled' => 'Đã hủy'] as $key => $label)
                                <option value="{{ $key }}" {{ request('status_order') == $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Nút tìm kiếm -->
                    <div class="col-md-3 d-grid">
                        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Hiển thị danh sách đơn hàng -->
        @if ($orders->isEmpty())
            <div class="alert alert-info text-center">Không tìm thấy đơn hàng nào.</div>
        @else
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Danh sách đơn hàng</h5>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Mã đơn hàng</th>
                                <th>Thông tin khách hàng</th>
                                <th>Thông tin sản phẩm</th>
                                <th>Ngày đặt</th>
                                <th>Trạng thái</th>
                                <th>Tổng tiền</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $key => $order)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>#{{ $order->id }}</td>
                                    <td>
                                        <ul class="list-unstyled">
                                            <li><strong>Tên:</strong> {{ $order->user_name }}</li>
                                            <li><strong>SĐT:</strong> {{ $order->user_phone }}</li>
                                            <li><strong>Địa chỉ:</strong> {{ $order->user_address_all }}</li>
                                        </ul>
                                    </td>
                                    <td>
                                        @foreach ($order->orderDetails as $details)
                                            <div class="product-details mb-3">
                                                <strong>Tên:</strong> {{ $details->variant->product->name }}<br>
                                                <strong>Giá:</strong> {{ number_format($details->variant->price_modifier, 0, ',', '.') }} VNĐ<br>
                                                <strong>Số lượng:</strong> {{ $details->quantity }}<br>
                                                <strong>Thuộc tính:</strong>
                                                <ul class="mb-0 list-unstyled">
                                                    @foreach ($details->variant->attributes as $attribute)
                                                        <li>{{ $attribute->attribute->name }}: {{ $attribute->attributeValue->value }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <hr>
                                        @endforeach
                                    </td>
                                    <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <span class="badge
                                            @switch($order->status_order)
                                                @case('pending') bg-warning text-dark @break
                                                @case('confirmed') bg-secondary text-white @break
                                                @case('shipping') bg-primary @break
                                                @case('delivered') bg-success @break
                                                @case('completed') bg-info @break
                                                @case('canceled') bg-danger @break
                                                @default bg-secondary
                                            @endswitch">
                                            {{ [
                                                'pending' => 'Chờ xác nhận',
                                                'confirmed' => 'Đã xác nhận',
                                                'shipping' => 'Chờ giao hàng',
                                                'delivered' => 'Đang giao hàng',
                                                'completed' => 'Đã nhận hàng',
                                                'canceled' => 'Đã hủy',
                                            ][$order->status_order] ?? 'Không rõ' }}
                                        </span>
                                    </td>
                                    <td>{{ number_format($order->total_amount, 0, ',', '.') }}₫</td>
                                    <td>
                                        @if ($order->status_order == 'pending')
                                            <form action="{{ route('orders.confirmed', $order->id) }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-primary" onclick="return confirm('Bạn có chắc chắn?')">Đã xác nhận</button>
                                            </form>
                                        @elseif ($order->status_order == 'confirmed')
                                        <form action="{{ route('orders.shipping', $order->id) }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-warning" onclick="return confirm('Bạn có chắc chắn?')">Chờ giao hàng</button>
                                        </form>
                                        @elseif ($order->status_order == 'shipping')
                                        <form action="{{ route('orders.delivered', $order->id) }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-success" onclick="return confirm('Bạn có chắc chắn?')">Đang giao hàng</button>
                                        </form>
                                        @elseif ($order->status_order == 'canceled')
                                        <form action="" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Xóa</button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        <!-- Phân trang -->
        <div class="mt-4">
            {{ $orders->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection

@section('style-libs')
    <style>
        .table-hover tbody tr:hover {
            background-color: #f9f9f9;
        }

        .card-header {
            border-bottom: 1px solid #ddd;
        }

        .badge {
            font-size: 0.9rem;
            padding: 0.4em 0.6em;
        }
    </style>
@endsection
