@extends('client.layouts.master')
@section('title')
    Lịch sử đơn hàng
@endsection
@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">Lịch sử đơn hàng của bạn</h2>

        @foreach ($orders as $order)
            <div class="card mb-4 shadow-sm">
                <!-- Header: Thông tin đơn hàng -->
                <div class="card-header bg-white text-dark d-flex justify-content-between">
                    <span>Đơn hàng #{{ $order->id }}</span>
                    <span>{{ date('d/m/Y', strtotime($order->order_date)) }}</span>
                </div>

                <!-- Body: Chi tiết đơn hàng -->
                <div class="card-body">
                    <p><strong>Tổng tiền:</strong> {{ number_format($order->total_amount, 0, ',', '.') }} VND</p>
                    <p><strong>Trạng thái:</strong>
                        <span
                            class="badge
                            @switch($order->status_order)
                                @case('pending') bg-secondary text-dark @break
                                @case('confirmed') bg-success text-white @break
                                @case('shipping') bg-warning text-dark @break
                                @case('delivered') bg-info text-white @break
                                @case('completed') bg-purple text-white @break
                                @case('canceled') bg-danger text-white @break
                                @case('return_request') bg-orange text-dark @break
                                @case('return_approved') bg-secondary text-white @break
                                @case('returned_item_received') bg-info text-white @break
                                @case('refund_completed') bg-success text-white @break
                                @default bg-dark text-white
                            @endswitch">
                            {{ [
                                'pending' => 'Chờ xác nhận',
                                'confirmed' => 'Đã xác nhận',
                                'shipping' => 'Chờ giao hàng',
                                'delivered' => 'Đang giao hàng',
                                'completed' => 'Đã nhận hàng',
                                'canceled' => 'Đơn hàng đã hủy',
                                'return_request' => 'Yêu cầu trả hàng',
                                'return_approved' => 'Yêu cầu được chấp nhận',
                                'returned_item_received' => 'Đã nhận hàng trả lại',
                                'refund_completed' => 'Hoàn tiền thành công',
                            ][$order->status_order] ?? 'Không rõ' }}
                        </span>
                    </p>

                    <!-- Sản phẩm trong đơn hàng -->
                    <h5 class="mt-3">Chi tiết sản phẩm:</h5>
                    <ul class="list-group">
                        @foreach ($order->orderDetails as $item)
                            @if ($item->product)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>({{ $item->quantity }}x) - {{ $item->product->name }}</span>
                                    <span>{{ number_format($item->total_amount, 0, ',', '.') }} VND</span>
                                </li>
                            @else
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>({{ $item->quantity }}x) - {{ $item->variant->product->name }}</span>
                                    <span>{{ number_format($item->total_amount, 0, ',', '.') }} VND</span>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>

                <div class="card-footer text-end d-inline-flex">
                    <!-- Liên hệ admin -->
                    @if (!in_array($order->status_order, ['canceled', 'return_request', 'return_approved', 'returned_item_received']))
                        <form action="{{ route('chat.create', Auth::user()->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-warning mx-2">Liên Hệ Admin</button>
                        </form>
                    @endif

                    <a href="{{ route('profile.order.showDetailOrder', $order->id) }}"
                        class="btn btn-sm btn-outline-primary mx-2">Xem chi tiết</a>
                    @if ($order->status_order == 'pending')
                        <form id="cancel-order-form-{{ $order->id }}"
                            action="{{ route('profile.order.cancel', $order->id) }}" method="POST" style="display: none;">
                            {{-- <input type="text" name="status_order" value="pending"> --}}
                            @csrf
                        </form>
                        <button type="button" class="btn btn-sm btn-outline-danger ms-2"
                            onclick="confirmCancelOrder({{ $order->id }})">
                            Hủy đơn hàng
                        </button>
                    @endif

                    @if ($order->status_order == 'delivered')
                        <form action="{{ route('profile.order.completed', $order->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-success">Đã nhận hàng</button>
                        </form>
                    @endif

                    @if ($order->status_order == 'completed')
                        <form id="return-form-{{ $order->id }}"
                            action="{{ route('profile.order.return_request', $order->id) }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>
                        <button class="btn btn-sm btn-outline-secondary" onclick="confirmReturn({{ $order->id }})">Trả
                            hàng</button>
                    @endif

                    @if ($order->status_order == 'return_request')
                        <span class="badge text-black bg-warning">Hãy đợi thêm thông tin từ chúng tôi</span>
                    @endif

                    @if ($order->status_order == 'return_approved')
                        <span class="badge text-black bg-info">Yêu cầu đã được chấp nhận</span>
                    @endif

                    @if ($order->status_order == 'returned_item_received')
                        <span class="badge text-black bg-info">Đơn hàng đã trở về nhà cung cấp</span>
                    @endif

                    @if ($order->status_order == 'refund_completed')
                        <span class="badge text-black bg-success">Hoàn tiền thành công</span>
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

@section('script-libs')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmReturn(orderId) {
            Swal.fire({
                title: 'Bạn có chắc chắn muốn trả hàng?',
                text: "Hành động này sẽ không thể hoàn tác!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Có, tôi muốn trả hàng!',
                cancelButtonText: 'Hủy',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`return-form-${orderId}`).submit();
                }
            });
        }

        function confirmCancelOrder(orderId) {
            Swal.fire({
                title: 'Hủy đơn hàng?',
                text: "Hành động này sẽ dừng tiến trình của đơn hàng. Bạn có chắc chắn?",
                icon: 'error',
                showCancelButton: true,
                confirmButtonText: 'Đồng ý hủy',
                cancelButtonText: 'Không, giữ lại',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`cancel-order-form-${orderId}`).submit();
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire({
                        title: 'Hủy bỏ!',
                        text: 'Đơn hàng vẫn được giữ lại.',
                        icon: 'info',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            });
        }
    </script>
@endsection

@section('style-libs')
    <style>
        .bg-purple {
            background-color: #6f42c1 !important;
        }

        .bg-orange {
            background-color: #fd7e14 !important;
        }
    </style>
@endsection
