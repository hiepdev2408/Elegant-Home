@extends('client.layouts.master')
@section('title')
    Giỏ Hàng
@endsection

@section('content')
    @if ($carts)
        <section class="page-title">
            <div class="auto-container">
                <h2>Giỏ hàng</h2>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ route('home') }}">Trang chủ</a></li>
                    <li>Trang</li>
                    <li>Giỏ hàng</li>
                </ul>
            </div>
        </section>
        <section class="shoping-cart-section">
            <div class="auto-container">
                <div class="row clearfix">

                    <!-- Cart Column -->

                    <div id="cart-items" class="cart-column col-lg-8 col-md-12 col-sm-12">
                        <div class="inner-column">
                            <!--Cart Outer-->
                            <div class="cart-outer">
                                <div class="table-outer">
                                    <table class="cart-table">
                                        <thead class="cart-header">
                                            <tr>
                                                <th class="prod-column">Sản phẩm</th>
                                                <th>&nbsp;</th>
                                                <th>Giá Tiền</th>
                                                <th>Số Lượng</th>
                                                <th>Tổng</th>
                                            </tr>
                                        </thead>
                                        @php
                                            $totalAmount = 0;
                                        @endphp
                                        @foreach ($carts as $cart)
                                            @if ($cart->variant)
                                                <tbody id="cart-item-{{ $cart->id }}">
                                                    <tr>
                                                        <td colspan="2" class="prod-column">
                                                            <div class="column-box">
                                                                <figure class="prod-thumb">
                                                                    <form class="delete-cart-form"
                                                                        data-id="{{ $cart->id }}"
                                                                        action="{{ route('destroy', $cart->id) }}"
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
                                                                <h6 class="prod-title"></h6>
                                                                <div class="prod-text">
                                                                    {{ Str::limit($cart->variant->product->name, 30) }} <br>
                                                                    Quantity :
                                                                    <span
                                                                        id="quantity-{{ $cart->id }}">{{ $cart->quantity }}</span>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td class="price">
                                                            @php
                                                                $productsOnSale = session('productsOnSale', []);
                                                                $saleProduct = collect($productsOnSale)->firstWhere(
                                                                    'id',
                                                                    $cart->variant->product->id,
                                                                );
                                                                $price =
                                                                    $saleProduct['price_sale'] ??
                                                                    $cart->variant->price_modifier;
                                                            @endphp
                                                            {{ number_format($price, 0, ',', '.') }}
                                                            VNĐ
                                                        </td>
                                                        <!-- Quantity Box -->
                                                        <td class="quantity-box">
                                                            <form class="update-cart-form" data-id="{{ $cart->id }}"
                                                                action="{{ route('cart.update', $cart->id) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="item-quantity">
                                                                    <input id="quantity-{{ $cart->id }}"
                                                                        class="qty-spinner" type="text"
                                                                        value="{{ $cart->quantity }}" name="quantity"
                                                                        readonly>
                                                                </div>
                                                                <input type="hidden" name="price_modifier"
                                                                    value="{{ $cart->variant->price_modifier }}">
                                                            </form>
                                                        </td>

                                                        <td id="total-amount-{{ $cart->id }}">
                                                            @php
                                                                $money = $cart->total_amount;
                                                                $totalAmount += $money;
                                                            @endphp
                                                            {{ number_format($money, 0, ',', '.') }}VNĐ
                                                        </td>
                                                </tbody>
                                            @elseif ($cart->product)
                                                <tbody id="cart-item-{{ $cart->id }}">
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
                                                            @php
                                                                $productsOnSale = session('productsOnSale', []);
                                                                $saleProduct = collect($productsOnSale)->firstWhere(
                                                                    'id',
                                                                    $cart->product->id,
                                                                );
                                                                if ($cart->product->price_sale) {
                                                                    $price =
                                                                        $saleProduct['price_sale'] ??
                                                                        $cart->product->price_sale;
                                                                } else {
                                                                    $price =
                                                                        $saleProduct['price_sale'] ??
                                                                        $cart->product->base_price;
                                                                }
                                                            @endphp
                                                            {{ number_format($price, 0, ',', '.') }}
                                                            VNĐ
                                                        </td>
                                                        <!-- Quantity Box -->
                                                        <td class="quantity-box">
                                                            <form action="{{ route('cart.update', $cart->cart_id) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="item-quantity">
                                                                    <input class="qty-spinner" type="text"
                                                                        value="{{ $cart->quantity }}" name="quantity"
                                                                        readonly>
                                                                </div>
                                                                @if ($cart->product->price_sale)
                                                                    <input type="hidden" name="price_sale"
                                                                        value="{{ $cart->product->price_sale }}">
                                                                @else
                                                                    <input type="hidden" name="price_sale"
                                                                        value="{{ $cart->product->price_sale }}">
                                                                @endif
                                                            </form>
                                                        </td>

                                                        <td id="total-amount-{{ $cart->id }}">
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
                    <div id="cart-itemss" class="total-column col-lg-4 col-md-12 col-sm-12">
                        <div class="inner-column">

                            <!-- Cart Total Outer -->
                            <div class="cart-total-outer">
                                <!-- Title Box -->
                                <div class="title-box">
                                    <h6>Tổng số giỏ hàng</h6>
                                </div>

                                <div class="cart-total-box">
                                    <ul class="cart-totals">
                                        <li>Tạm Tính: <span
                                                id="overall-total">{{ number_format($totalAmount, 0, ',', '.') }}
                                                VNĐ</span>
                                        </li>
                                        <br>
                                        <li>Tổng phụ: <span
                                                id="overall-totals">{{ number_format($totalAmount, 0, ',', '.') }}
                                                VNĐ</span></li>
                                    </ul>
                                    <div class="check-box">
                                        <input type="checkbox" name="remember-password" id="type-1">
                                        <label for="type-1">Thuế được tính khi thanh toán</label>
                                    </div>
                                    <!-- Buttons Box -->
                                    <div class="buttons-box">
                                        <a href="{{ route('order') }}" class="theme-btn proceed-btn">
                                            Tiến hành thanh toán
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
        <div class="empty-cart-box text-center mt-5" id="empty-cart">
            <img class="mb-4 mt-4" src="https://static-smember.cellphones.com.vn/smember/_nuxt/img/empty.db6deab.svg"
                alt="Empty Cart" width="300px">
            <h4 class="text-secondary" style="font-size: 18px; font-weight: 600;">Giỏ hàng trống</h4>
            <p style="font-size: 14px; color: #888;">Giỏ hàng của bạn đang trống.
                Hãy chọn thêm sản phẩm để mua sắm nhé</p>
            <a href="{{ route('home') }}" class="btn btn-danger mb-5">
                Quay Lại Trang Chủ
            </a>
        </div>
    @endif
    <!-- End Shoping Cart Section -->

    <!-- Gallery Section -->
    <section class="gallery-section">
        <div class="outer-container">
            <div class="instagram-carousel owl-carousel owl-theme">

                <!-- Insta Gallery -->
                <div class="insta-gallery">
                    <img src="{{ asset('themes/clients/images/gallery/1.jpg') }}" alt="" />
                    <div class="overlay-box">
                        <div class="overlay-inner">
                            <a class="lightbox-image icon flaticon-instagram"
                                href="{{ asset('themes/clients/images/gallery/1.jpg') }}"></a>
                        </div>
                    </div>
                </div>

                <!-- Insta Gallery -->
                <div class="insta-gallery">
                    <img src="{{ asset('themes/clients/images/gallery/2.jpg') }}" alt="" />
                    <div class="overlay-box">
                        <div class="overlay-inner">
                            <a class="lightbox-image icon flaticon-instagram"
                                href="{{ asset('themes/clients/images/gallery/1.jpg') }}"></a>
                        </div>
                    </div>
                </div>

                <!-- Insta Gallery -->
                <div class="insta-gallery">
                    <img src="{{ asset('themes/clients/images/gallery/3.jpg') }}" alt="" />
                    <div class="overlay-box">
                        <div class="overlay-inner">
                            <a class="lightbox-image icon flaticon-instagram"
                                href="{{ asset('themes/clients/images/gallery/3.jpg') }}"></a>
                        </div>
                    </div>
                </div>

                <!-- Insta Gallery -->
                <div class="insta-gallery">
                    <img src="{{ asset('themes/clients/images/gallery/4.jpg') }}" alt="" />
                    <div class="overlay-box">
                        <div class="overlay-inner">
                            <a class="lightbox-image icon flaticon-instagram"
                                href="{{ asset('themes/clients/images/gallery/4.jpg') }}"></a>
                        </div>
                    </div>
                </div>

                <!-- Insta Gallery -->
                <div class="insta-gallery">
                    <img src="{{ asset('themes/clients/images/gallery/5.jpg') }}" alt="" />
                    <div class="overlay-box">
                        <div class="overlay-inner">
                            <a class="lightbox-image icon flaticon-instagram"
                                href="{{ asset('themes/clients/images/gallery/5.jpg') }}"></a>
                        </div>
                    </div>
                </div>

                <!-- Insta Gallery -->
                <div class="insta-gallery">
                    <img src="{{ asset('themes/clients/images/gallery/6.jpg') }}" alt="" />
                    <div class="overlay-box">
                        <div class="overlay-inner">
                            <a class="lightbox-image icon flaticon-instagram"
                                href="{{ asset('themes/clients/images/gallery/6.jpg') }}"></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('script-libs')
    <script>
        $('.update-cart-form').submit(function(event) {
            event.preventDefault(); // Ngừng reload trang

            var form = $(this);
            var cartId = form.data('id');
            var actionUrl = form.attr('action');
            var formData = form.serialize();

            $.ajax({
                url: actionUrl,
                type: 'POST', // Phương thức
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), // CSRF Token
                },
                success: function(response) {
                    if (response.success) {
                        // Hiển thị thông báo thành công
                        notyf.success(response.message);

                        // Kiểm tra nếu số lượng dưới 0 sẽ xóa
                        if (response.cartDetailId) {
                            // Xóa dòng sản phẩm trong bảng
                            $(`#cart-item-${response.cartDetailId}`).remove();
                        }

                        // Cập nhật số lượng và tổng tiền
                        $(`#quantity-${cartId}`).text(response.cartDetail.quantity);
                        $(`#total-amount-${cartId}`).text(response.totalAmountFormatted);

                        // Cập nhật tổng tiền nếu cần
                        if (response.overallTotalFormatted) {
                            $('#overall-total').text(response.overallTotalFormatted);
                            $('#overall-totals').text(response.overallTotalFormatted);
                        }
                    } else {
                        // Hiển thị thông báo lỗi
                        notyf.error(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    // Hiển thị thông báo lỗi
                    notyf.error('Có lỗi xảy ra khi kết nối đến server!');
                }
            });
        });
    </script>

    <script>
        $('.delete-cart-form').submit(function(event) {
            event.preventDefault(); // Ngừng reload trang
            var form = $(this);
            var cartId = form.data('id');

            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: form.serialize(),
                success: function(response) {
                    notyf.success(response.message);
                    // Nếu xóa thành công, xóa dòng sản phẩm khỏi bảng
                    form.closest('tr').remove();

                    // Cập nhật tổng tiền nếu cần
                    if (response.overallTotalFormatted) {
                        $('#overall-total').text(response.overallTotalFormatted);
                        $('#overall-totals').text(response.overallTotalFormatted);
                    }
                },
                error: function(xhr, status, error) {
                    alert('Có lỗi xảy ra khi xóa sản phẩm');
                }
            });
        });
    </script>
@endsection
