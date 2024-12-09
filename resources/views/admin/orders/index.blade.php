@extends('admin.layouts.master')
@section('title')
    Quản lý đơn hàng
@endsection
@section('menu-item-order', 'active')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4>
            <span class="text-muted fw-light">Đơn hàng /</span> Danh sách đơn hàng
        </h4>
        @if (session()->has('success'))
            <div class="alert alert-success fw-bold">
                {{ session()->get('success') }}
            </div>
        @endif
        <div class="card-header d-flex justify-content-end align-items-center mb-3">
            <form action="{{ route('orders.index') }}" method="GET" class="row g-3">
                <!-- Lọc theo ID đơn hàng -->

                <div class="col-md-3">
                    <input type="text" name="order_id" class="form-control" placeholder="ID đơn hàng"
                        value="{{ request('order_id') }}">
                </div>
                <div class="col-md-3">
                    <input type="text" name="customer_name" class="form-control" placeholder="Tên khách hàng"
                        value="{{ request('customer_name') }}">
                </div>
                <!-- Lọc theo trạng thái -->
                <div class="col-md-3">
                    <select name="status_order" class="form-select">
                        <option value="">-- Trạng thái --</option>
                        @foreach (['pending' => 'Chờ xác nhận', 'confirmed' => 'Xác nhận', 'shipping' => 'Chờ giao hàng', 'delivered' => 'Đang giao hàng', 'completed' => 'Đã nhận hàng', 'canceled' => 'Đã hủy', 'return_request' => 'Yêu cầu trả hàng', 'return_approved' => 'Chấp nhận trả hàng', 'returned_item_received' => 'Đã nhận được hàng trả lại', 'refund_completed' => 'Hoàn tiền thành công'] as $key => $label)
                            <option value="{{ $key }}" {{ request('status_order') == $key ? 'selected' : '' }}>
                                {{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 d-grid">
                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                </div>
            </form>
        </div>
        <div class="card">
            <div class="card-body">
                <table id="example"
                    class=" text-center table table-bordered dt-responsive nowrap table-striped align-middle"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th>Mã đơn hàng</th>
                            <th>Tên khách hàng</th>
                            <th>Ngày đặt</th>
                            <th>Thanh Toán</th>
                            <th>Trạng thái</th>
                            <th>Tổng tiền</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $key => $order)
                            <tr>
                                <td>ORDER{{ $order->id }}</td>
                                <td>{{ $order->user_name }}</td>
                                <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <span
                                        class="badge
                                        @switch($order->status_payment)
                                            @case('pending') bg-warning text-dark @break
                                            @case('unpaid') bg-secondary text-white @break
                                            @case('Paid') bg-success @break
                                            @default bg-secondary
                                        @endswitch">
                                        {{ [
                                            'pending' => 'Chờ xác nhận',
                                            'unpaid' => 'Chưa Thanh Toán',
                                            'Paid' => 'Đã Thanh Toán',
                                        ][$order->status_payment] ?? 'Không rõ' }}
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="badge
                                            @switch($order->status_order)
                                                @case('pending') bg-warning text-dark @break
                                                @case('confirmed') bg-secondary text-white @break
                                                @case('shipping') bg-primary @break
                                                @case('delivered') bg-success @break
                                                @case('completed') bg-info @break
                                                @case('canceled') bg-danger @break
                                                @case('return_request') bg-danger @break
                                                @case('return_approved') bg-danger @break
                                                @case('returned_item_received') bg-danger @break
                                                @case('refund_completed') bg-danger @break
                                                @default bg-secondary
                                            @endswitch">
                                        {{ [
                                            'pending' => 'Chờ xác nhận',
                                            'confirmed' => 'Xác nhận',
                                            'shipping' => 'Chờ giao hàng',
                                            'delivered' => 'Đang giao hàng',
                                            'completed' => 'Đã nhận hàng',
                                            'canceled' => 'Đã hủy',
                                            'return_request' => 'Yêu cầu trả hàng',
                                            'return_approved' => 'Chấp nhận trả hàng',
                                            'returned_item_received' => 'Đã nhận được hàng trả lại',
                                            'refund_completed' => 'Hoàn tiền thành công',
                                        ][$order->status_order] ?? 'Không rõ' }}
                                    </span>
                                </td>
                                <td>{{ number_format($order->total_amount, 0, ',', '.') }} VNĐ</td>
                                <td>
                                    <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Xem Chi Tiết"
                                        class="btn btn-info btn-sm me-1" href="{{ route('attributes.edit', $order->id) }}">
                                        <i class="mdi mdi-eye"></i>
                                    </a>
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
            order: []
        });
    </script>
@endsection

{{-- @section('content')
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
                    <div class="col-md-3">
                        <input type="text" name="customer_name" class="form-control" placeholder="Tên khách hàng"
                            value="{{ request('customer_name') }}">
                    </div>
                    <!-- Lọc theo trạng thái -->
                    <div class="col-md-3">
                        <select name="status_order" class="form-select">
                            <option value="">-- Trạng thái --</option>
                            @foreach (['pending' => 'Chờ xác nhận', 'confirmed' => 'Xác nhận', 'shipping' => 'Chờ giao hàng', 'delivered' => 'Đang giao hàng', 'completed' => 'Đã nhận hàng', 'canceled' => 'Đã hủy', 'return_request' => 'Yêu cầu trả hàng', 'return_approved' => 'Chấp nhận trả hàng', 'returned_item_received' => 'Đã nhận được hàng trả lại', 'refund_completed' => 'Hoàn tiền thành công'] as $key => $label)
                                <option value="{{ $key }}"
                                    {{ request('status_order') == $key ? 'selected' : '' }}>
                                    {{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 d-grid">
                        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                    </div>
                </form>
            </div>
        </div>

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
                                            @if ($details->product)
                                                <div class="product-details mb-3">
                                                    <strong>Tên:</strong> {{ $details->product->name }}<br>
                                                    <strong>Giá:</strong>
                                                    @if ($details->product->price_sale == '')
                                                        {{ number_format($details->product->base_price, 0, ',', '.') }}
                                                        VNĐ<br>
                                                    @else
                                                        {{ number_format($details->product->price_sale, 0, ',', '.') }}
                                                        VNĐ<br>
                                                    @endif
                                                    <strong>Số lượng:</strong> {{ $details->quantity }}<br>
                                                </div>
                                            @else
                                                <div class="product-details mb-3">
                                                    <strong>Tên:</strong> {{ $details->variant->product->name }}<br>
                                                    <strong>Giá:</strong>
                                                    {{ number_format($details->variant->price_modifier, 0, ',', '.') }}
                                                    VNĐ<br>
                                                    <strong>Số lượng:</strong> {{ $details->quantity }}<br>
                                                    <strong>Thuộc tính:</strong>
                                                    <ul class="mb-0 list-unstyled">
                                                        @foreach ($details->variant->attributes as $attribute)
                                                            <li>{{ $attribute->attribute->name }}:
                                                                {{ $attribute->attributeValue->value }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                            <hr>
                                        @endforeach
                                    </td>
                                    <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <span
                                            class="badge
                                            @switch($order->status_order)
                                                @case('pending') bg-warning text-dark @break
                                                @case('confirmed') bg-secondary text-white @break
                                                @case('shipping') bg-primary @break
                                                @case('delivered') bg-success @break
                                                @case('completed') bg-info @break
                                                @case('canceled') bg-danger @break
                                                @case('return_request') bg-danger @break
                                                @case('return_approved') bg-danger @break
                                                @case('returned_item_received') bg-danger @break
                                                @case('refund_completed') bg-danger @break
                                                @default bg-secondary
                                            @endswitch">
                                            {{ [
                                                'pending' => 'Chờ xác nhận',
                                                'confirmed' => 'Xác nhận',
                                                'shipping' => 'Chờ giao hàng',
                                                'delivered' => 'Đang giao hàng',
                                                'completed' => 'Đã nhận hàng',
                                                'canceled' => 'Đã hủy',
                                                'return_request' => 'Yêu cầu trả hàng',
                                                'return_approved' => 'Chấp nhận trả hàng',
                                                'returned_item_received' => 'Đã nhận được hàng trả lại',
                                                'refund_completed' => 'Hoàn tiền thành công',
                                            ][$order->status_order] ?? 'Không rõ' }}
                                        </span>
                                    </td>
                                    <td>{{ number_format($order->total_amount, 0, ',', '.') }}₫</td>
                                    <td>
                                        @if ($order->status_order == 'pending')
                                            <form action="{{ route('orders.confirmed', $order->id) }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-primary"
                                                    onclick="return confirm('Bạn có chắc chắn?')">Xác nhận</button>
                                            </form>
                                        @elseif ($order->status_order == 'confirmed')
                                            <form action="{{ route('orders.shipping', $order->id) }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-warning"
                                                    onclick="return confirm('Bạn có chắc chắn?')">Chờ giao hàng</button>
                                            </form>
                                        @elseif ($order->status_order == 'shipping')
                                            <form action="{{ route('orders.delivered', $order->id) }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-success"
                                                    onclick="return confirm('Bạn có chắc chắn?')">Đang giao hàng</button>
                                            </form>
                                        @elseif ($order->status_order == 'canceled')
                                            <form action="" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Xóa</button>
                                            </form>
                                        @elseif ($order->status_order == 'return_request')
                                            <form action="{{ route('orders.return_request', $order->id) }}"
                                                method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Xác nhận</button>
                                            </form>
                                        @elseif ($order->status_order == 'return_approved')
                                            <form action="{{ route('orders.returned_item_received', $order->id) }}"
                                                method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Đã nhận được hàng</button>
                                            </form>
                                        @elseif ($order->status_order == 'returned_item_received')
                                            <form action="{{ route('orders.refund_completed', $order->id) }}"
                                                method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Hoàn tiền</button>
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
        <div class="mt-4">
            {{ $orders->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection --}}
