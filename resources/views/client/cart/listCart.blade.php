@extends('client.layouts.master')
@section('title')
    Giỏ Hàng
@endsection

@section('content')
    <!-- Shoping Cart Section -->
    <section class="shoping-cart-section">
        <div class="auto-container">
            <div class="row clearfix">

                <!-- Cart Column -->
                <div class="cart-column col-lg-8 col-md-12 col-sm-12">
                    <div class="inner-column">

                        <!--Cart Outer-->
                        <div class="cart-outer">
                            <div class="table-outer">
                                <table class="cart-table">
                                    <thead class="cart-header">
                                        <tr>
                                            <th class="prod-column">product</th>
                                            <th>&nbsp;</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>

                                    @foreach ($carts as $item)
                                        @foreach ($item->cartDetails as $cart)
                                            <tbody>
                                                <tr>
                                                    <td colspan="2" class="prod-column">
                                                        <div class="column-box">
                                                            <figure class="prod-thumb">
                                                                <form action="{{ route('destroy', $cart->id) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="cross-icon flaticon-cancel-1">
                                                                    </button>
                                                                </form>
                                                                <a href="#"><img
                                                                        src="{{ Storage::url($cart->variant->image) }}"
                                                                        alt=""></a>
                                                            </figure>
                                                            <h6 class="prod-title">{{ $cart->variant->product->name }}</h6>
                                                            <div class="prod-text">Color : Brown <br> Quantity :
                                                                {{ $cart->quantity }}</div>
                                                        </div>
                                                    </td>

                                                    <td class="price">
                                                        {{ number_format($cart->variant->product->price_sale, 0, ',', '.') }}
                                                    </td>
                                                    <!-- Quantity Box -->
                                                    <td class="quantity-box">
                                                        <div class="item-quantity">
                                                            <button class="qty-btn minus"
                                                                data-id="{{ $cart->id }}"></button>
                                                            <input class="qty-spinner" type="text"
                                                                value="{{ $cart->quantity }}" name="quantity" readonly>
                                                            <button class="qty-btn plus"
                                                                data-id="{{ $cart->id }}"></button>
                                                        </div>
                                                    </td>

                                                    <td class="sub-total">
                                                        {{ number_format($cart->total_amount, 0, ',', '.') }}</td>
                                                </tr>
                                            </tbody>
                                        @endforeach
                                    @endforeach

                                </table>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Total Column -->
                <div class="total-column col-lg-4 col-md-12 col-sm-12">
                    <div class="inner-column">

                        <!-- Cart Total Outer -->
                        <div class="cart-total-outer">
                            <!-- Title Box -->
                            <div class="title-box">
                                <h6>Cart Totals</h6>
                            </div>
                            <div class="cart-total-box">
                                <ul class="cart-totals">
                                    <li>Subtotals : <span>
                                            {{ number_format($cart->total_amount, 0, ',', '.') }} VNĐ</span></li>
                                    <li>Totals : <span>{{ number_format($cart->total_amount, 0, ',', '.') }} VNĐ</span>
                                    </li>
                                </ul>
                                <div class="check-box">
                                    <input type="checkbox" name="remember-password" id="type-1">
                                    <label for="type-1">Shipping & taxes calculated at checkout</label>
                                </div>
                                <!-- Buttons Box -->
                                <div class="buttons-box">
                                    <a href="contact.html" class="theme-btn proceed-btn">
                                        Procced To Cheackout
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Shipping Total Outer -->
                        <div class="shipping-outer">
                            <!-- Title Box -->
                            <div class="title-box">
                                <h6>Calculate Shipping</h6>
                            </div>
                            <div class="cart-shipping-box">
                                <ul class="shipping-list">
                                    <li>Bangladesh</li>
                                    <li>Mirpur Dohs Dhaka-1200</li>
                                    <li>Postal Code</li>
                                </ul>
                                <!-- Buttons Box -->
                                <div class="buttons-box">
                                    <a href="contact.html" class="theme-btn btn-style-one">
                                        Calculate Shiping
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- End Shoping Cart Section -->

    <!-- Gallery Section -->
    <section class="gallery-section">
        <div class="outer-container">
            <div class="instagram-carousel owl-carousel owl-theme">

                <!-- Insta Gallery -->
                <div class="insta-gallery">
                    <img src="images/gallery/1.jpg" alt="" />
                    <div class="overlay-box">
                        <div class="overlay-inner">
                            <a class="lightbox-image icon flaticon-instagram" href="images/gallery/1.jpg"></a>
                        </div>
                    </div>
                </div>

                <!-- Insta Gallery -->
                <div class="insta-gallery">
                    <img src="images/gallery/2.jpg" alt="" />
                    <div class="overlay-box">
                        <div class="overlay-inner">
                            <a class="lightbox-image icon flaticon-instagram" href="images/gallery/1.jpg"></a>
                        </div>
                    </div>
                </div>

                <!-- Insta Gallery -->
                <div class="insta-gallery">
                    <img src="images/gallery/3.jpg" alt="" />
                    <div class="overlay-box">
                        <div class="overlay-inner">
                            <a class="lightbox-image icon flaticon-instagram" href="images/gallery/3.jpg"></a>
                        </div>
                    </div>
                </div>

                <!-- Insta Gallery -->
                <div class="insta-gallery">
                    <img src="images/gallery/4.jpg" alt="" />
                    <div class="overlay-box">
                        <div class="overlay-inner">
                            <a class="lightbox-image icon flaticon-instagram" href="images/gallery/4.jpg"></a>
                        </div>
                    </div>
                </div>

                <!-- Insta Gallery -->
                <div class="insta-gallery">
                    <img src="images/gallery/5.jpg" alt="" />
                    <div class="overlay-box">
                        <div class="overlay-inner">
                            <a class="lightbox-image icon flaticon-instagram" href="images/gallery/5.jpg"></a>
                        </div>
                    </div>
                </div>

                <!-- Insta Gallery -->
                <div class="insta-gallery">
                    <img src="images/gallery/6.jpg" alt="" />
                    <div class="overlay-box">
                        <div class="overlay-inner">
                            <a class="lightbox-image icon flaticon-instagram" href="images/gallery/6.jpg"></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('script-libs')
    <script>
        $(document).ready(function() {
            $('.qty-btn').click(function() {
                // Lấy ID giỏ hàng từ data-id của nút
                var cartId = $(this).data('id');
                // Lấy số lượng hiện tại
                var $input = $(this).siblings('.qty-spinner');
                var currentQuantity = parseInt($input.val());

                // Kiểm tra nút nào được nhấn và cập nhật số lượng
                if ($(this).hasClass('plus')) {
                    currentQuantity += 1; // Tăng số lượng
                } else if ($(this).hasClass('minus') && currentQuantity > 1) {
                    currentQuantity -= 1; // Giảm số lượng, tránh giảm dưới 1
                }

                // Cập nhật số lượng trong ô input
                $input.val(currentQuantity);

                // Gửi yêu cầu AJAX để cập nhật số lượng trong giỏ hàng
                $.ajax({
                    url: '/cart/update', // Đường dẫn đến route xử lý cập nhật giỏ hàng
                    type: 'POST',
                    data: {
                        cart_id: cartId,
                        quantity: currentQuantity,
                        _token: '{{ csrf_token() }}' // Đảm bảo có CSRF token
                    },
                    success: function(response) {
                        // Xử lý thành công nếu cần
                        console.log('Cập nhật thành công!', response);
                    },
                    error: function(xhr) {
                        // Xử lý lỗi nếu cần
                        console.error('Có lỗi xảy ra!', xhr);
                    }
                });
            });
        });
    </script>
@endsection
