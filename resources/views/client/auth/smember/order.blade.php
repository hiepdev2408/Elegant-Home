@extends('client.layouts.master')
@section('title')
    Lịch sủ mua hàng
@endsection
@section('order', 'active')
@section('content')
    <div class="container mt-3 mb-5">
        <div class="row">
            @include('client.auth.layouts.master')
            <section class="col-9 ms-5">
                <div class="d-flex">
                    <div class="h-50 p-3 me-3" style="border: 1px solid red; border-radius: 50%">
                        <img src="https://cdn2.cellphones.com.vn/50x50,webp,q100/media/wysiwyg/Shipper_CPS3_1.png"
                            alt="" height="50px">
                    </div>
                    <div class="d-grid">
                        @if (Auth::check())
                            <h4>{{ Auth::user()->name }}</h4>
                            <span>{{ Auth::user()->phone }}</span>
                            <div class="d-flex">
                                <p class="badge text-bg-primary">SNULL</p>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row text-center mb-4 mt-2 box-shadows p-3 rounded-3">
                    <div class="col-6" style="border-right: 1px solid #000;">
                        <h5 class="mt-3">0</h5>
                        <p class="text-muted">Đơn hàng</p>
                    </div>
                    <div class="col-6">
                        <h5 class="mt-3">0đ</h5>
                        <p class="text-muted">Tổng tiền tích lũy</p>
                    </div>
                </div>
                <div class="d-flex gap-2" id="status-buttons">
                    <button class="btn btn-custom active">Tất cả</button>
                    <button class="btn btn-custom">Chờ xác nhận</button>
                    <button class="btn btn-custom">Đã xác nhận</button>
                    <button class="btn btn-custom">Đang vận chuyển</button>
                    <button class="btn btn-custom">Đã giao hàng</button>
                    <button class="btn btn-custom">Đã hủy</button>
                </div>
                @if (!empty($orderDetails))
                    <table class="table mt-3">
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
                                                <form action="{{ route('profile.order.cancel', $order->id) }}"
                                                    method="post" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm">Hủy đơn
                                                        hàng</button>
                                                </form>
                                            @elseif ($order->order->status_order === 'comfirmed')
                                                <a href="{{ route('profile.order.showDetailOrder', $order->id) }}"
                                                    class="d-block btn btn-primary btn-sm">Xem chi tiết</a>
                                            @elseif ($order->order->status_order === 'shipping')
                                                <a href="{{ route('profile.order.showDetailOrder', $order->id) }}"
                                                    class="d-block btn btn-primary btn-sm">Xem chi tiết</a>
                                                <form action="" method="post" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm">Đã nhận
                                                        hàng</button>
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
                @else
                    <div class="d-flex justify-content-center mt-5">
                        <div class="text-center">
                            <img src="https://static-smember.cellphones.com.vn/smember/_nuxt/img/empty.db6deab.svg"
                                width="200px">
                            <p>Không có đơn hàng nào thỏa mãn!</p>
                        </div>
                    </div>
                @endif
            </section>
        </div>
    </div>
@endsection
@section('script')
    <script>
        // Lấy danh sách tất cả các nút trong div
        const buttons = document.querySelectorAll('#status-buttons .btn-custom');

        // Lặp qua tất cả các nút và thêm sự kiện click
        buttons.forEach(button => {
            button.addEventListener('click', () => {
                // Xóa lớp active khỏi tất cả các nút
                buttons.forEach(btn => btn.classList.remove('active'));

                // Thêm lớp active vào nút được bấm
                button.classList.add('active');
            });
        });
    </script>
@endsection
