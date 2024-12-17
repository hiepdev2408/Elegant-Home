@extends('client.layouts.master')
@section('title')
    Lịch sử đơn hàng
@endsection
@section('content')
    <div class="container mt-5">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h3 class="text-center mb-4">Lịch sử đơn hàng của bạn</h3>
            <div class="card">
                <div class="card-body">
                    <table id="example"
                        class=" text-center table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Tên Khách Hàng</th>
                                <th>Ngày đặt</th>
                                <th>Trạng thái</th>
                                <th>Tổng tiền</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $item)
                                <tr>
                                    <td>ORDER{{ $item->id }}</td>
                                    <td>{{ $item->user_name }}</td>
                                    <td>{{ date('d/m/Y', strtotime($item->created_at)) }}</td>
                                    <td>
                                        <span
                                            class="badge
                                    @switch($item->status_order)
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
                                            ][$item->status_order] ?? 'Không rõ' }}
                                        </span>
                                    </td>
                                    <td> {{ number_format($item->total_amount, 0, ',', '.') }} VND</td>
                                    <td>
                                        <div class="d-flex align-content-center">
                                            <!-- Liên hệ admin -->
                                            @if (!in_array($item->status_order, ['canceled', 'return_request', 'return_approved', 'returned_item_received']))
                                                <form action="{{ route('chat.create', Auth::user()->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-outline-warning mx-2">Liên
                                                        Hệ
                                                        Admin</button>
                                                </form>
                                            @else
                                                <form action="{{ route('chat.create', Auth::user()->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-outline-warning mx-2">Liên
                                                        Hệ
                                                        Admin</button>
                                                </form>
                                            @endif
                                            <a href="#" class="btn btn-sm btn-outline-primary me-2"
                                                data-bs-toggle="modal" data-bs-target="#orderDetailModal"
                                                onclick="loadOrderDetail('{{ route('profile.order.showDetailOrder', $item->id) }}')">
                                                Xem chi tiết
                                            </a>

                                            @if ($item->status_order == 'pending')
                                                <form id="cancel-order-form-{{ $item->id }}"
                                                    action="{{ route('profile.order.cancel', $item->id) }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                </form>
                                                <button type="button" class="btn btn-sm btn-outline-danger ms-2"
                                                    onclick="confirmCancelOrder({{ $item->id }})">
                                                    Hủy đơn hàng
                                                </button>
                                            @endif

                                            @if ($item->status_order == 'delivered')
                                                <form action="{{ route('profile.order.completed', $item->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-outline-success">Đã
                                                        nhận
                                                        hàng</button>
                                                </form>
                                            @endif

                                            @if ($item->status_order == 'completed')
                                                <form id="return-form-{{ $item->id }}"
                                                    action="{{ route('profile.order.return_request', $item->id) }}"
                                                    method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                                <button class="btn btn-sm btn-outline-secondary"
                                                    onclick="confirmReturn({{ $item->id }})">Trả
                                                    hàng</button>
                                            @endif

                                            @if ($item->status_order == 'return_request')
                                                <span
                                                    class="badge text-black bg-warning d-flex justify-content-center align-items-center">Hãy
                                                    đợi thêm thông tin từ chúng
                                                    tôi</span>
                                            @endif

                                            @if ($item->status_order == 'return_approved')
                                                <span
                                                    class="badge text-black bg-info d-flex justify-content-center align-items-center">
                                                    Yêu cầu đã được chấp nhận
                                                </span>
                                            @endif

                                            @if ($item->status_order == 'returned_item_received')
                                                <span
                                                    class="badge text-black bg-info d-flex justify-content-center align-items-center">Đơn
                                                    hàng đã trở về nhà cung cấp</span>
                                            @endif

                                            @if ($item->status_order == 'refund_completed')
                                                <span
                                                    class="badge text-black bg-success d-flex justify-content-center align-items-center">Hoàn
                                                    tiền thành công</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="orderDetailModal" tabindex="-1" aria-labelledby="orderDetailModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="orderDetailModalLabel">Chi tiết đơn hàng</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Nội dung chi tiết đơn hàng sẽ được tải động -->
                        <p>Đang tải dữ liệu...</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style-libs')
    <style>
        #orderDetailModal .modal-dialog {
            max-width: 75%;
            /* Đặt chiều rộng tối đa của modal là 80% màn hình */
        }
    </style>
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection

@section('script-libs')
    <script>
        function loadOrderDetail(url) {
            const modalBody = document.querySelector('#orderDetailModal .modal-body');
            modalBody.innerHTML = '<p>Đang tải dữ liệu...</p>'; // Hiển thị trạng thái đang tải

            fetch(url)
                .then(response => response.text())
                .then(html => {
                    modalBody.innerHTML = html; // Đổ nội dung từ server vào modal
                })
                .catch(error => {
                    modalBody.innerHTML = '<p>Không thể tải dữ liệu.</p>';
                    console.error(error);
                });
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
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
    <style>
        .bg-purple {
            background-color: #6f42c1 !important;
        }

    .bg-orange {
        background-color: #fd7e14 !important;
    }
</style>
@endsection
