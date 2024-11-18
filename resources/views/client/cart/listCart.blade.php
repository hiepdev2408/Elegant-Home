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
                                            <th class="prod-column">Product</th>
                                            <th>&nbsp;</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>

                                    @foreach ($carts as $cart)
                                            <tbody>
                                                <tr>
                                                    <td colspan="2" class="prod-column">
                                                        <div class="column-box">
                                                            <figure class="prod-thumb">
                                                                <form action=""
                                                                    method="post">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="cross-icon flaticon-cancel-1">
                                                                    </button>
                                                                </form>
                                                                {{-- <a href="#"><img
                                                                        src="{{ Storage::url($cart->variant->image) }}"
                                                                        alt=""></a> --}}
                                                            </figure>
                                                            <h6 class="prod-title"></h6>
                                                            <div class="prod-text">Color : Brown <br> Quantity :
                                                                {{ $cart->quantity }}</div>
                                                        </div>
                                                    </td>

                                                    <td class="price">
                                                    </td>
                                                    <!-- Quantity Box -->
                                                    <td class="quantity-box">
                                                        {{-- <form action="{{ route('cart.update', $cart->id) }}" method="post">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="item-quantity">
                                                                <input class="qty-spinner" type="text"
                                                                    value="{{ $cart->quantity }}" name="quantity" readonly>
                                                            </div>
                                                            <input type="hidden" name="cart_id"
                                                                value="{{ $cart->id }}">
                                                            <input type="hidden" name="price_sale"
                                                                value="{{ $cart->variant->product->price_sale }}">
                                                        </form> --}}
                                                    </td>

                                                    <td class="sub-total">
                                                        {{ number_format($cart->total_amount, 0, ',', '.') }}</td>
                                                </tr>
                                            </tbody>
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
@endsection
