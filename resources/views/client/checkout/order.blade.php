@extends('client.layouts.master')
@section('title')
    Order
@endsection
@section('content')
    <section class="page-title">
        <div class="auto-container">
            <h2>Shop Page</h2>
            <ul class="bread-crumb clearfix">
                <li><a href="index.html">Home</a></li>
                <li>Pages</li>
                <li>Checkout</li>
            </ul>
        </div>
    </section>
    <!-- Checkout Section -->
    <section class="checkout-section">
        <div class="auto-container">
            <form action="{{ route('checkout') }}" method="post">
                @csrf
                <div class="row clearfix">

                    <!-- Form Column -->
                    <div class="form-column col-lg-8 col-md-12 col-sm-12">
                        <div class="inner-column">
                            <h4>Thông tin cá nhân</h4>
                            <!-- Shipping Form -->
                            <div class="shipping-form ">
                                <div class="col-9 mt-2">
                                    <label for="">Họ và tên</label>
                                    <input type="text" name="name" class="form-control mt-2"
                                        value="{{ Auth::user()->name }}" placeholder="Vui lòng nhập họ và tên">
                                </div>
                                <div class="col-9 mt-3">
                                    <label for="">Địa chỉ email</label>
                                    <input type="text" name="email" class="form-control mt-2"
                                        value="{{ Auth::user()->email }}" placeholder="Vui lòng nhập địa chỉ email">
                                </div>
                                <div class="col-9 mt-3">
                                    <label for="">Số điện thoại</label>
                                    <input type="text" name="phone" class="form-control mt-2"
                                        value="{{ Auth::user()->phone }}" placeholder="Vui lòng nhập số điện thoại">
                                </div>
                                <div class="col-9 mt-3">
                                    <label for="province">Thành phố / Tỉnh</label>
                                    <select name="province_id" id="province" class="form-control">
                                        <option value="">Chọn thành phố</option>
                                        @foreach ($province as $code => $name)
                                            <option value="{{ $code }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-9 mt-3">
                                    <label for="district">Quận / Huyện</label>
                                    <select name="district_id" id="district" class="form-control">
                                        <option value="">Chọn quận</option>
                                    </select>
                                </div>

                                <div class="col-9 mt-3">
                                    <label for="ward">Phường / Xã</label>
                                    <select name="ward_id" id="ward" class="form-control">
                                        <option value="">Chọn phường</option>
                                    </select>
                                </div>
                                <div class="col-9 mt-3">
                                    <label for="">Địa chỉ cụ thể</label>
                                    <input type="text" name="address" class="form-control mt-2"
                                        value="{{ Auth::user()->address }}" placeholder="Vui lòng nhập địa chỉ">
                                </div>
                            </div>
                            <h4 class="mt-3">Phương thức thanh toán</h4>
                            <div class="col-9">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="paymentMethod" id="paymentMomo">
                                    <label class="form-check-label" for="paymentMomo">Thanh toán MOMO</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="paymentMethod" id="paymentPaypal">
                                    <label class="form-check-label" for="paymentPaypal">Thanh toán PayPal</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="paymentMethod" id="paymentVnp">
                                    <label class="form-check-label" for="paymentVnp">Thanh toán VNP</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="paymentMethod" id="paymentQr">
                                    <label class="form-check-label" for="paymentQr">Thanh toán QR CODE</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="paymentMethod"
                                        id="paymentCashOnDelivery">
                                    <label class="form-check-label" for="paymentCashOnDelivery">Thanh toán khi nhận hàng</label>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Order Column -->
                    <div class="order-column col-lg-4 col-md-12 col-sm-12">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif


                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="inner-column">
                            <h4>Order Summery</h4>
                            <!-- Order Box -->
                            <div class="order-box">
                                <ul class="order-totals">
                                    <li>Subtotal<span>{{ number_format($totalAmount, 0, ',', '.') }} VNĐ</span></li>
                                    <li>Shipping Fee<span>0VNĐ</span></li>
                                </ul>

                                <!-- Voucher Box -->
                                <div class="voucher-box">
                                    <form method="post" action="{{ route('order.applyVoucher') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" name="voucher_code" value=""
                                                placeholder="Enter voucher Code">
                                            <button type="submit" class="theme-btn apply-btn">Apply code</button>
                                        </div>
                                    </form>
                                </div>

                                <!-- Order Total -->
                                <div class="order-total">Total
                                    <span>{{ number_format(session('totalAmount', $totalAmount), 0, ',', '.') }} VNĐ</span>
                                </div>

                                <div class="button-box">
                                    <input type="hidden" name="total_amount" value="{{ $totalAmount }}">
                                    <button type="submit" class="theme-btn pay-btn">Proceed to pay</button>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </form>
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
@endsection
