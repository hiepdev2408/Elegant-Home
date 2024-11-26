@extends('client.layouts.master')
@section('title')
    Order
@endsection
@section('content')
    <section class="checkout-section">
        <div class="auto-container my-5">
            <div class="row">
                <!-- Form Column -->
                <div class="form-column col-lg-8 col-md-12 col-sm-12">
                    <form action="{{ route('vnpay') }}" method="post" class="p-4 border rounded shadow">
                        @csrf
                        <h4 class="mb-4">Thông tin cá nhân</h4>
                        <!-- Shipping Form -->
                        <div class="shipping-form">
                            <!-- Row 1: Họ và Tên + Email -->
                            <div class="row">
                                <div class="col-md-6 mt-3">
                                    <label for="user_name" class="form-label">Họ và tên</label>
                                    <input type="text" name="user_name" class="form-control"
                                        value="{{ Auth::user()->name }}" placeholder="Vui lòng nhập họ và tên">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="user_email" class="form-label">Địa chỉ email</label>
                                    <input type="text" name="user_email" class="form-control"
                                        value="{{ Auth::user()->email }}" placeholder="Vui lòng nhập địa chỉ email">
                                </div>
                            </div>

                            <!-- Row 2: Số điện thoại + Thành phố / Tỉnh -->
                            <div class="row">
                                <div class="col-md-6 mt-3">
                                    <label for="user_phone" class="form-label">Số điện thoại</label>
                                    <input type="text" name="user_phone" class="form-control"
                                        value="{{ Auth::user()->phone }}" placeholder="Vui lòng nhập số điện thoại">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="user_address" class="form-label">Địa chỉ</label>
                                    <input type="text" name="user_address" class="form-control"
                                        value="{{ Auth::user()->address }}" placeholder="Vui lòng nhập địa chỉ">
                                </div>
                            </div>

                            <!-- Row 3: Địa chỉ chi tiết -->
                            <div class="col-12 mt-3">
                                <label for="user_address_all" class="form-label">Địa chỉ chi tiết</label>
                                @if (Auth::check() &&
                                        Auth::user()->ward &&
                                        Auth::user()->district &&
                                        Auth::user()->province &&
                                        Auth::user()->ward->name &&
                                        Auth::user()->district->name &&
                                        Auth::user()->province->name)
                                    <input type="text" name="user_address_all" class="form-control"
                                        value="{{ Auth::user()->ward->name . ', ' . Auth::user()->district->name . ', ' . Auth::user()->province->name }}"
                                        required>
                                @else
                                    <input type="text" name="user_address_all" class="form-control" value=""
                                        required>
                                @endif
                            </div>

                            <!-- Row 4: Ghi chú -->
                            <div class="col-12 mt-3">
                                <label for="user_note" class="form-label">Ghi chú</label>
                                <textarea name="user_note" id="" cols="30" rows="4" class="form-control"
                                    placeholder="Thêm ghi chú..."></textarea>
                            </div>
                        </div>

                        <!-- Phương thức thanh toán -->
                        <h4 class="mt-4">Phương thức thanh toán</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="radio" name="paymentMethod" id="paymentMomo">
                                    <label class="form-check-label" for="paymentMomo">Thanh toán MOMO</label>
                                </div>
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="radio" name="paymentMethod" id="paymentPaypal">
                                    <label class="form-check-label" for="paymentPaypal">Thanh toán PayPal</label>
                                </div>
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="radio" name="paymentMethod" id="paymentVnp">
                                    <label class="form-check-label" for="paymentVnp">Thanh toán VNP</label>
                                </div>
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="radio" name="paymentMethod" id="paymentQr">
                                    <label class="form-check-label" for="paymentQr">Thanh toán QR CODE</label>
                                </div>
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="radio" name="paymentMethod"
                                        id="paymentCashOnDelivery">
                                    <label class="form-check-label" for="paymentCashOnDelivery">Thanh toán khi nhận
                                        hàng</label>
                                </div>
                            </div>
                            <input type="hidden" name="is_ship_user_same_user" value="0">
                        </div>
                        <input type="hidden" name="total_amount" value="{{ session('totalAmount', $totalAmount) }}">
                        <button type="submit" name="redirect" class="btn btn-primary mt-4 w-100">Xác nhận thanh
                            toán</button>
                    </form>
                </div>

                <!-- Order Column -->
                <div class="order-column col-lg-4 col-md-12 col-sm-12 mt-4 mt-lg-0">
                    <div class="p-4 border rounded shadow">
                        <h4 class="mb-4">Tóm tắt đơn hàng</h4>
                        <!-- Order Box -->
                        <div class="order-box">
                            <ul class="list-group mb-3">
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Subtotal</span>
                                    <span>{{ number_format($totalAmount, 0, ',', '.') }} VNĐ</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Shipping Fee</span>
                                    <span>0 VNĐ</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between fw-bold">
                                    <span>Tổng cộng</span>
                                    <span
                                        id="totalAmount">{{ number_format(session('totalAmount', $totalAmount), 0, ',', '.') }}
                                        VNĐ</span>
                                </li>
                            </ul>

                            <!-- Voucher Box -->
                            <form id="voucherForm" class="d-flex">
                                @csrf

                                <input type="text" name="voucher_code" class="form-control me-2 form-control-sm "
                                    placeholder="Nhập mã giảm giá">
                                <button type="submit" class="btn btn-success btn-sm col-3">Áp dụng</button>
                            </form>
                            <div id="voucherMessage" class="mt-2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- End Checkout Section -->
@endsection

@section('script-libs')
    <script>
        function toggleReplyForm(commentId) {
            const replyForm = document.getElementById(`replyForm-${commentId}`);
            if (replyForm.style.display === "none") {
                replyForm.style.display = "block";
            } else {
                replyForm.style.display = "none";
            }
        }
    </script>
    <button id="scroll__top"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48"
                d="M112 244l144-144 144 144M256 120v292" />
        </svg></button>
    <script src="{{ asset('themes/client/assets/js/plugins/swiper-bundle.min.js') }}" defer="defer"></script>
    <script src="{{ asset('themes/client/assets/js/plugins/glightbox.min.js') }}" defer="defer"></script>

    <!-- Customscript js -->
    <script src="{{ asset('themes/client/assets/js/script.js') }}" defer="defer"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Khi chọn province, load danh sách district
            $('#province').on('change', function() {
                var provinceCode = $(this).val();
                if (provinceCode) {
                    $.ajax({
                        url: '/districts/' + provinceCode,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#district').empty().append(
                                '<option value="">Select District</option>');
                            $.each(data, function(code, name) {
                                $('#district').append('<option value="' + code + '">' +
                                    name + '</option>');
                            });
                            $('#district').prop('disabled', false);
                            $('#ward').empty().append('<option value="">Select Ward</option>');
                            $('#ward').prop('disabled', true);
                        }
                    });
                } else {
                    $('#district').empty().append('<option value="">Select District</option>');
                    $('#ward').empty().append('<option value="">Select Ward</option>');
                    $('#district, #ward').prop('disabled', true);
                }
            });

            // Khi chọn district, load danh sách ward
            $('#district').on('change', function() {
                var districtCode = $(this).val();
                if (districtCode) {
                    $.ajax({
                        url: '/wards/' + districtCode,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#ward').empty().append('<option value="">Select Ward</option>');
                            $.each(data, function(code, name) {
                                $('#ward').append('<option value="' + code + '">' +
                                    name + '</option>');
                            });
                            $('#ward').prop('disabled', false);
                        }
                    });
                } else {
                    $('#ward').empty().append('<option value="">Select Ward</option>');
                    $('#ward').prop('disabled', true);
                }
            });
        });
    </script>
    <!-- Thêm jQuery -->

    <script>
        $(document).ready(function() {
            $('#voucherForm').on('submit', function(event) {
                event.preventDefault(); // Ngăn chặn reload trang

                $.ajax({
                    url: '{{ route('order.applyVoucher') }}',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.success) {
                            $('#voucherMessage').html(
                                `<p class="alert alert-success">${response.message}</p>`);
                            // Cập nhật tổng giá trị
                            let newTotal = response.new_total; // Tổng mới từ phản hồi
                            $('#totalAmount').text(newTotal.toLocaleString('vi-VN') + ' VNĐ');
                        } else {
                            $('#voucherMessage').html(
                                `<p class="alert alert-danger">${response.message}</p>`);
                        }
                    },
                    error: function(xhr) {
                        $('#voucherMessage').html(
                            `<p class="alert alert-danger">Đã có lỗi xảy ra! Vui lòng thử lại.</p>`
                        );
                    }
                });
            });
        });
    </script>
@endsection
