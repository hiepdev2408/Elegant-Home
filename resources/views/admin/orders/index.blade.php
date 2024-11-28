@extends('admin.layouts.master')
@section('content')
    <div class="container mt-4">
        <h2 class="mb-4 text-center text-primary">Quản lý đơn hàng</h2>

        <!-- Tìm kiếm và lọc -->
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <form action="{{ route('orders.index') }}" method="GET" class="row g-3">
                    <div class="col-md-3">
                        <input type="text" name="order_id" class="form-control" placeholder="ID đơn hàng"
                            value="{{ request('order_id') }}">
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="customer_name" class="form-control" placeholder="Tên khách hàng"
                            value="{{ request('customer_name') }}">
                    </div>
                    <div class="col-md-3">
                        <select name="status_order" class="form-select">
                            <option value="">-- Trạng thái --</option>
                            <option value="pending" {{ request('status_order') == 'pending' ? 'selected' : '' }}>Chờ xác
                                nhận</option>
                            <option value="confirmed" {{ request('status_order') == 'confirmed' ? 'selected' : '' }}>Đã xác
                                nhận</option>
                            <option value="shipping" {{ request('status_order') == 'shipping' ? 'selected' : '' }}>Đang giao
                            </option>
                            <option value="delivered" {{ request('status_order') == 'delivered' ? 'selected' : '' }}>Đã giao
                            </option>
                            <option value="canceled" {{ request('status_order') == 'canceled' ? 'selected' : '' }}>Đã hủy
                            </option>
                        </select>
                    </div>
                    <div class="col-md-3 d-grid">
                        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Danh sách đơn hàng -->
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
                            <th>Khách hàng</th>
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
                                <td>{{ $order->user_name }}</td>
                                <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <span
                                        class="badge
                                    @switch($order->status_order)
                                        @case('pending') bg-warning text-dark @break
                                        @case('confirmed') bg-info text-white @break
                                        @case('shipping') bg-primary @break
                                        @case('delivered') bg-success @break
                                        @case('canceled') bg-danger @break
                                        @default bg-secondary
                                    @endswitch">
                                        @switch($order->status_order)
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
                                </td>
                                <td>{{ number_format($order->total_amount, 0, ',', '.') }}₫</td>
                                <td>
                                    <a href="" class="btn btn-sm btn-primary">Chi tiết</a>
                                    <form action="" method="POST" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Bạn có chắc muốn xóa đơn hàng này?')">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

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

        .btn-sm {
            font-size: 0.85rem;
            padding: 0.3rem 0.7rem;
        }
    </style>
@endsection
