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
                @if ($carts)
                    <div class="cart-column col-lg-8 col-md-12 col-sm-12">
                        <div class="inner-column">

                            <!--Cart Outer-->
                            <div class="cart-outer">
                                <div class="table-outer">
                                    <table class="cart-table">
                                        <thead class="cart-header">
                                            <tr>
                                                <th class="prod-column">Product</th>
                                                <th>&nbsp;</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        @php
                                            $totalAmount = 0;
                                        @endphp
                                        @foreach ($carts as $cart)
                                            @if ($cart->variant)
                                                <tbody>
                                                    <tr>
                                                        <td colspan="2" class="prod-column">
                                                            <div class="column-box">
                                                                <figure class="prod-thumb">
                                                                    <form action="" method="post">
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
                                                                <h6 class="prod-title"></h6>
                                                                <div class="prod-text">Tên sản phẩm :
                                                                    {{ Str::limit($cart->variant->product->name, 10) }} <br>
                                                                    Quantity :
                                                                    {{ $cart->quantity }}</div>
                                                            </div>
                                                        </td>

                                                        <td class="price">
                                                            {{ number_format($cart->variant->price_modifier, 0, ',', '.') }}
                                                            VNĐ
                                                        </td>
                                                        <!-- Quantity Box -->
                                                        <td class="quantity-box">
                                                            <form action="{{ route('updateCartQuantity') }}" method="post">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="item-quantity">
                                                                    <input class="qty-spinner" type="text"
                                                                        value="{{ $cart->quantity }}" name="quantity"
                                                                        readonly>
                                                                </div>
                                                                <input type="hidden" name="cart_id"
                                                                    value="{{ $cart->id }}">
                                                                <input type="hidden" name="price_sale"
                                                                    value="{{ $cart->variant->product->price_sale }}">
                                                            </form>
                                                        </td>

                                                        <td>
                                                            @php
                                                                $money = $cart->total_amount;
                                                                $totalAmount += $money;
                                                            @endphp
                                                            {{ number_format($money, 0, ',', '.') }}VNĐ
                                                        </td>
                                                </tbody>
                                            @elseif ($cart->product)
                                                <tbody>
                                                    <tr>
                                                        <td colspan="2" class="prod-column">
                                                            <div class="column-box">
                                                                <figure class="prod-thumb">
                                                                    <form action="" method="post">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                            class="cross-icon flaticon-cancel-1">
                                                                        </button>
                                                                    </form>
                                                                    <a href="#"><img
                                                                            src="{{ Storage::url($cart->product->img_thumbnail) }}"
                                                                            alt=""></a>
                                                                </figure>
                                                                <h6 class="prod-title"></h6>
                                                                <div class="prod-text">Tên sản phẩm :
                                                                    {{ Str::limit($cart->product->name) }} <br> Quantity :
                                                                    {{ $cart->quantity }}</div>
                                                            </div>
                                                        </td>

                                                        <td class="price">
                                                            {{ number_format($cart->product->price_sale, 0, ',', '.') }}
                                                            VNĐ
                                                        </td>
                                                        <!-- Quantity Box -->
                                                        <td class="quantity-box">
                                                            <form action="{{ route('updateCartQuantity') }}"
                                                                method="post">
                                                                @csrf
                                                                @method('PATCH')
                                                                <div class="item-quantity">
                                                                    <input class="qty-spinner" type="text"
                                                                        value="{{ $cart->quantity }}" name="quantity"
                                                                        readonly>
                                                                </div>
                                                                <input type="hidden" name="cart_id"
                                                                    value="{{ $cart->id }}">
                                                                <input type="hidden" name="price_sale"
                                                                    value="{{ $cart->product->price_sale }}">
                                                            </form>
                                                        </td>

                                                        <td>
                                                            @php
                                                                $money = $cart->total_amount;
                                                                $totalAmount += $money;
                                                            @endphp
                                                            {{ number_format($money, 0, ',', '.') }}VNĐ
                                                        </td>
                                                </tbody>
                                            @endif
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
                                        <li>Subtotals : <span>{{ number_format($totalAmount, 0, ',', '.') }} VNĐ</span>
                                        </li>
                                        <br>
                                        <li>Totals : <span>{{ number_format($totalAmount, 0, ',', '.') }} VNĐ</span></li>
                                    </ul>
                                    <div class="check-box">
                                        <input type="checkbox" name="remember-password" id="type-1">
                                        <label for="type-1">Shipping & taxes calculated at checkout</label>
                                    </div>
                                    <!-- Buttons Box -->
                                    <div class="buttons-box">
                                        <a href="{{ route('order') }}" class="theme-btn proceed-btn">
                                            Proceed To Checkout
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="empty-cart-box text-center">
                        <img class="mb-4 mt-4"
                            src="https://static-smember.cellphones.com.vn/smember/_nuxt/img/empty.db6deab.svg"
                            alt="Empty Cart" width="300px">
                        <h4 class="text-secondary" style="font-size: 18px; font-weight: 600;">Giỏ hàng trống</h4>
                        <p style="font-size: 14px; color: #888;">Giỏ hàng của bạn đang trống.
                            Hãy chọn thêm sản phẩm để mua sắm nhé</p>
                        <a href="{{ route('home') }}" class="btn btn-danger mb-5">
                            Quay Lại Trang Chủ
                        </a>
                    </div>
                @endif

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
        function updateCartQuantity(inputElement) {
            const cartId = inputElement.getAttribute('data-cart-id');
            const quantity = inputElement.value;

            // Kiểm tra dữ liệu
            if (quantity <= 0) {
                alert('Số lượng phải lớn hơn 0!');
                return;
            }

            // Gửi yêu cầu AJAX
            fetch("{{ route('updateCartQuantity') }}", {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        cart_id: cartId,
                        quantity: quantity
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Cập nhật giao diện
                        const subTotalElement = document.querySelector(`#sub-total-${cartId}`);
                        subTotalElement.textContent = `${data.subTotal} VNĐ`;

                        alert(data.message);
                    } else {
                        alert('Có lỗi xảy ra khi cập nhật số lượng!');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Không thể cập nhật số lượng.');
                });
        }
    </script>
@endsection
