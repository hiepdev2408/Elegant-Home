@extends('client.layouts.master')

@section('title')
    Trang chủ
@endsection

@section('content')
    @if (session('alert'))
        <script>
            Swal.fire({
                icon: 'error', // or 'success', 'warning', 'info', etc.
                title: 'Oops...',
                text: 'Product is out of stock',
            });
        </script>
    @endif
    <section class="main-slider">
        <div class="main-slider-carousel owl-carousel owl-theme">

            <!-- Slide One -->
            <div class="slide">
                <!-- Ct Dot Animated -->
                <div class="ct-dot-animated">
                    <div class="ct-dot-container">
                        <div class="ct-dot-item">
                            <span></span>
                        </div>
                        <div class="ct-dot-item">
                            <span></span>
                        </div>
                        <div class="ct-dot-item">
                            <span></span>
                        </div>
                    </div>
                </div>
                <!-- End Ct Dot Animated -->
                <div class="image-layer"
                    style="background-image: url({{ asset('themes/clients/images/main-slider/image-1.jpg') }})">
                </div>
                <div class="auto-container">

                    <!-- Content Column -->
                    <div class="content-box">
                        <div class="box-inner">
                            <div class="vector-icon"
                                style="background-image: url({{ asset('themes/clients/images/main-slider/vector-1.png') }})">
                            </div>
                            <div class="vector-icon-two"
                                style="background-image: url({{ asset('themes/clients/images/main-slider/vector-2.png') }})">
                            </div>
                            <div class="vector-icon-three"
                                style="background-image: url({{ asset('themes/clients/images/main-slider/vector-3.png') }})">
                            </div>
                            <div class="sale-box">
                                SALE
                                <span>30<i>% OFF</i></span>
                            </div>
                            <div class="title">2022 Bộ sưu tập</div>
                            <h1>Nội thất <br> Bộ sưu tập</h1>
                            <div class="price">Bắt đầu từ <span>500.000 VNĐ</span></div>
                            <a href="{{ route('shop') }}" class="shop-now">Mua ngay</a>
                            <a href="{{ route('shop') }}" class="arrival-box">Hàng mới về</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="slide">
                <div class="ct-dot-animated">
                    <div class="ct-dot-container">
                        <div class="ct-dot-item">
                            <span></span>
                        </div>
                        <div class="ct-dot-item">
                            <span></span>
                        </div>
                        <div class="ct-dot-item">
                            <span></span>
                        </div>
                    </div>
                </div>
                <div class="image-layer"
                    style="background-image: url({{ asset('themes/clients/images/main-slider/image-1.jpg') }})">
                </div>
                <div class="auto-container">
                    <div class="content-box">
                        <div class="box-inner">
                            <div class="vector-icon"
                                style="background-image: url({{ asset('themes/clients/images/main-slider/vector-1.png') }})">
                            </div>
                            <div class="vector-icon-two"
                                style="background-image: url({{ asset('themes/clients/images/main-slider/vector-2.png') }})">
                            </div>
                            <div class="vector-icon-three"
                                style="background-image: url({{ asset('themes/clients/images/main-slider/vector-3.png') }})">
                            </div>
                            <div class="sale-box">
                                SALE
                                <span>30<i>% OFF</i></span>
                            </div>
                            <div class="title">2024 Bộ sưu tập</div>
                            <h1>Furniture <br> Bộ sưu tập</h1>
                            <div class="price">Bắt đầu từ <span>500.000 VNĐ</span></div>
                            <a href="{{ route('shop') }}" class="shop-now">Mua sắm ngay</a>
                            <a href="{{ route('shop') }}" class="arrival-box">Hàng mới về</a>
                        </div>
                    </div>

                </div>
            </div>
            <div class="slide">
                <div class="ct-dot-animated">
                    <div class="ct-dot-container">
                        <div class="ct-dot-item">
                            <span></span>
                        </div>
                        <div class="ct-dot-item">
                            <span></span>
                        </div>
                        <div class="ct-dot-item">
                            <span></span>
                        </div>
                    </div>
                </div>
                <div class="image-layer"
                    style="background-image: url({{ asset('themes/clients/images/main-slider/image-1.jpg') }})">
                </div>
                <div class="auto-container">
                    <div class="content-box">
                        <div class="box-inner">
                            <div class="vector-icon"
                                style="background-image: url({{ asset('themes/clients/images/main-slider/vector-1.png') }})">
                            </div>
                            <div class="vector-icon-two"
                                style="background-image: url({{ asset('themes/clients/images/main-slider/vector-2.png') }})">
                            </div>
                            <div class="vector-icon-three"
                                style="background-image: url({{ asset('themes/clients/images/main-slider/vector-3.png') }})">
                            </div>
                            <div class="sale-box">
                                SALE
                                <span>30<i>% OFF</i></span>
                            </div>
                            <div class="title">2024 Bộ sưu tập</div>
                            <h1>Nội thất <br> Bộ sưu tập</h1>
                            <div class="price">Bắt đầu từ <span>500.000 VNĐ</span></div>
                            <a href="shop-detail.html" class="shop-now">Mua sắm ngay</a>
                            <a href="shop.html" class="arrival-box">Hàng mới về</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hover-box">
            <div class="dott"></div>
            <div class="hover-content">
                <div class="rating">
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="light fa fa-star"></span>
                    <span class="light fa fa-star"></span>
                </div>
                <div class="hover-title">Màu sắc của nhựa chậu</div>
                <div class="hover-price">$ - <span>$30.00</span></div>
            </div>
        </div>
        <div class="hover-box style-two">
            <div class="dott"></div>
            <div class="hover-content">
                <div class="rating">
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="light fa fa-star"></span>
                    <span class="light fa fa-star"></span>
                </div>
                <div class="hover-title">Pot Plastics Color</div>
                <div class="hover-price">$28.52 - <span>$30.00</span></div>
            </div>
        </div>

    </section>

    <!-- Dịch vụ -->
    <section class="featured-section">
        <div class="vector-layer" style="background-image: url({{ asset('themes/clients/images/icons/vector-1.png') }})">
        </div>
        <div class="vector-layer-two"
            style="background-image: url({{ asset('themes/clients/images/icons/feature.png') }})"></div>
        <div class="auto-container">
            <div class="inner-container">
                <div class="row clearfix">

                    <div class="feature-block col-xl-3 col-lg-6 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <div class="content">
                                <div class="icon flaticon-fast"></div>
                                <strong>Miễn phí vận chuyển</strong>
                                <div class="text">Miễn phí vận chuyển với những đơn hàng trên 1 triệu đồng</div>
                            </div>
                        </div>
                    </div>

                    <div class="feature-block col-xl-3 col-lg-6 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <div class="content">
                                <div class="icon flaticon-padlock"></div>
                                <strong>Thanh toán an toàn</strong>
                                <div class="text">Đã nhận được 100% thanh toán an toàn</div>
                            </div>
                        </div>
                    </div>

                    <div class="feature-block col-xl-3 col-lg-6 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <div class="content">
                                <div class="icon flaticon-headphones-1"></div>
                                <strong>Hỗ trợ 24/7</strong>
                                <div class="text">Hỗ trợ chất lượng cao 24/7</div>
                            </div>
                        </div>
                    </div>

                    <div class="feature-block col-xl-3 col-lg-6 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <div class="content">
                                <div class="icon flaticon-wallet"></div>
                                <strong>Hoàn tiền 100%</strong>
                                <div class="text">Hoàn tiền cho khách hàng</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Load product -->
    <section class="products-section">
        <div class="auto-container">
            <!-- Sec Title -->
            <div class="sec-title">
                <h4><span>Phổ biến</span> Sản phẩm dành cho bạn!</h4>
            </div>
            <div class="four-item-carousel owl-carousel owl-theme">
                @foreach ($products as $product)
                    @if ($product->is_show_home == 1)
                        <div class="shop-item shadow rounded border">
                            <div class="inner-box">
                                <div class="image">
                                    <a href="{{ route('productDetail', ['slug' => $product->slug]) }}">
                                        @if ($product->img_thumbnail)
                                            <img src="{{ Storage::url($product->img_thumbnail) }}" alt="" />
                                        @endif
                                    </a>
                                    @if (Auth::check())
                                        <a href="{{ route('favourite', $product->id) }}"><span
                                                class="tag flaticon-heart"></span></a>
                                    @endif
                                </div>

                                <div class="lower-content p-3">
                                    <div class="rating">
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="light fa fa-star"></span>
                                    </div>
                                    <h6><a
                                            href="{{ route('productDetail', ['slug' => $product->slug]) }}">{{ Str::limit($product->name, 30) }}</a>
                                    </h6>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="price">
                                            @if ($product->price_sale == '')
                                                <span
                                                    class="new-price">{{ number_format($product->base_price ?? 0, 0, ',', '.') }}VNĐ</span>
                                            @else
                                                <span
                                                    class="old-price">{{ number_format($product->base_price ?? 0, 0, ',', '.') }}VNĐ</span>
                                                <span
                                                    class="new-price">{{ number_format($product->price_sale ?? 0, 0, ',', '.') }}VNĐ</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>

    {{-- Product sale --}}
    <section class="products-section">
        <div class="auto-container">
            <!-- Sec Title -->
            <div class="sec-title">
                @if ($sales->isNotEmpty())
                    @foreach ($sales as $sale)
                        <h4><span>Khuyến mãi:</span> {{ number_format($sale->discount_percentage, 0, ',', '.') }}%</h4>
                        <div class="sale-timer" id="sale-timer-{{ $sale->id }}">
                            <p><strong>Thời Gian:</strong> Từ {{ \Carbon\Carbon::parse($sale->start_date)->setTimezone('Asia/Ho_Chi_Minh')->format('d-m-Y H:i') }} đến {{ \Carbon\Carbon::parse($sale->end_date)->setTimezone('Asia/Ho_Chi_Minh')->format('d-m-Y H:i') }}</p>
                            <p>Thời gian còn lại: <span id="countdown-{{ $sale->id }}"></span></p>
                        </div>
                    @endforeach
                @else
                    <h4>Không có chương trình khuyến mãi nào đang diễn ra.</h4>
                @endif
            </div>

            <div class="row">
                @php
                    $productsOnSale = session('productsOnSale', []);
                @endphp
                @if (!empty($productsOnSale))
                    @foreach ($productsOnSale as $product)
                        <div class="col-md-3 col-sm-6 product-item" id="product-{{ $product['id'] }}">
                            <div class="shop-item shadow rounded border">
                                <div class="inner-box">
                                    <div class="image">
                                        <a href="{{ route('productDetail', ['slug' => $product['slug']]) }}">
                                            @if ($product['img_thumbnail'])
                                                <img src="{{ Storage::url($product['img_thumbnail']) }}"
                                                    alt="{{ $product['name'] }}" class="img-fluid" />
                                            @endif
                                        </a>
                                        @if (Auth::check())
                                            <a href="{{ route('favourite', $product['id']) }}">
                                                <span class="tag flaticon-heart"></span>
                                            </a>
                                        @endif
                                        <div class="cart-box text-center">
                                            <a class="cart" href="#">Add to Cart</a>
                                        </div>
                                    </div>
                                    <div class="lower-content p-3">
                                        <div class="rating">
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="light fa fa-star"></span>
                                        </div>
                                        <h6>
                                            <a href="{{ route('productDetail', ['slug' => $product['slug']]) }}">
                                                {{ Str::limit($product['name'], 30) }}
                                            </a>
                                        </h6>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="price">
                                                @php
                                                    $finalPrice =
                                                        !is_null($product['price_sale']) && $product['price_sale'] > 0
                                                            ? $product['price_sale']
                                                            : $product['base_price'];
                                                @endphp

                                                <div class="price">
                                                    @if (!is_null($product['price_sale']) && $product['price_sale'] > 0)
                                                        <span
                                                            class="old-price">{{ number_format($product['base_price'], 0, ',', '.') }}
                                                            VNĐ</span>
                                                    @endif
                                                    <span class="new-price">{{ number_format($finalPrice, 0, ',', '.') }}
                                                        VNĐ</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @foreach ($sales as $sale)
                            @if ($sale->products->contains($product['id']))
                                <!-- Kiểm tra sản phẩm có trong chương trình khuyến mãi -->
                                <script>
                                    // Lấy thời gian kết thúc từ backend
                                    var endDate = new Date("{{ \Carbon\Carbon::parse($sale->end_date)->toDateTimeString() }}").getTime();

                                    // Cập nhật bộ đếm ngược mỗi giây
                                    var countdownFunction = setInterval(function() {
                                        var now = new Date().getTime();
                                        var distance = endDate - now;

                                        // Nếu thời gian kết thúc, ẩn sản phẩm
                                        if (distance < 0) {
                                            clearInterval(countdownFunction);
                                            document.getElementById("countdown-{{ $sale->id }}").innerHTML = "Khuyến mãi đã kết thúc";
                                            document.getElementById("product-{{ $product['id'] }}").style.display = "none";
                                        } else {
                                            // Tính toán thời gian còn lại
                                            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                                            // Hiển thị thời gian còn lại
                                            document.getElementById("countdown-{{ $sale->id }}").innerHTML = days + " ngày " + hours +
                                                " giờ " +
                                                minutes + " phút " + seconds + " giây ";
                                        }
                                    }, 1000);
                                </script>
                            @endif
                        @endforeach
                    @endforeach
                @else
                    <p>Không có sản phẩm nào đang giảm giá.</p>
                @endif
            </div>
        </div>
    </section>

    <!-- Brand Slide -->
    <section class="brand-section">
        <div class="outer-container">
            <div class="animation_mode">
                <h1>Design. <span>Brand</span>. <strong>Quality</strong></h1>
                <img src="{{ asset('themes/clients/images/icons/icon-1.png') }}" alt="" />
                <img src="{{ asset('themes/clients/images/icons/feature.png') }}" alt="" />
                <img src="{{ asset('themes/clients/images/icons/icon-2.png') }}" alt="" />
                <h1>Design. <span>Brand</span>. <strong>Quality</strong></h1>
                <img src="{{ asset('themes/clients/images/icons/icon-1.png') }}" alt="" />
                <img src="{{ asset('themes/clients/images/icons/feature.png') }}" alt="" />
                <img src="{{ asset('themes/clients/images/icons/icon-2.png') }}" alt="" />
                <h1>Design. <span>Brand</span>. <strong>Quality</strong></h1>
                <img src="{{ asset('themes/clients/images/icons/icon-1.png') }}" alt="" />
                <img src="{{ asset('themes/clients/images/icons/feature.png') }}" alt="" />
                <img src="{{ asset('themes/clients/images/icons/icon-2.png') }}" alt="" />
                <h1>Design. <span>Brand</span>. <strong>Quality</strong></h1>
                <img src="{{ asset('themes/clients/images/icons/icon-1.png') }}" alt="" />
                <img src="{{ asset('themes/clients/images/icons/feature.png') }}" alt="" />
                <img src="{{ asset('themes/clients/images/icons/icon-2.png') }}" alt="" />
            </div>
        </div>
    </section>

    <!-- Sale Section -->
    <section class="sale-section">
        <div class="auto-container">
            <div class="row clearfix">

                <!-- Sale Block -->
                <div class="sale-block col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-box">
                        <div class="sale-box">
                            SALE
                            <span>30<i>% OFF</i></span>
                        </div>
                        <div class="image d-flex justify-content-between align-items-center">
                            <img src="{{ asset('themes/clients/images/resource/shop-1.jpg') }}" alt="" />
                            <div class="overlay-box">
                                <div class="overlay-inner">
                                    <div class="off">Giảm giá 30%</div>
                                    <h5><a href="{{ route('shop') }}">Hãy ở bên nhau trong khoảnh khắc này <br> với
                                            Elegant Home gọi</a></h5>
                                    <a class="buy-now" href="{{ route('shop') }}">Mua ngay</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sale Block -->
                <div class="sale-block col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-box">
                        <div class="sale-box">
                            GIẢM GIÁ
                            <span>30<i>%</i></span>
                        </div>
                        <div class="image d-flex justify-content-between align-items-center">
                            <img src="{{ asset('themes/clients/images/resource/shop-2.jpg') }}" alt="" />
                            <div class="overlay-box">
                                <div class="overlay-inner">
                                    <div class="off">Get 30% off</div>
                                    <h5><a href="{{ route('shop') }}">Hãy ở bên nhau trong khoảnh khắc này <br> với
                                            Elegant Home gọi</a></h5>
                                    <a class="buy-now" href="{{ route('shop') }}">Mua ngay</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Products Section Two -->
    <section class="products-section-two">
        <div class="bottom-white-border"></div>
        <div class="auto-container">
            <!-- Sec Title -->
            <div class="sec-title centered">
                <h4><span>Sản phẩm phổ biến</span> cho bạn !</h4>
            </div>
            <div class="inner-container">
                <div class="single-item-carousel owl-carousel owl-theme">

                    <!-- Slide -->
                    <div class="slide">
                        <div class="row clearfix">

                            <!-- Product Block Four -->
                            <div class="product-block-four col-lg-3 col-md-6 col-sm-6">
                                <div class="inner-box d-flex justify-content-between align-items-center flex-wrap">
                                    <div class="image">
                                        <span class="number">01</span>
                                        <img src="{{ asset('themes/clients/images/resource/product-1.png') }}"
                                            alt="" />
                                    </div>
                                    <div class="content">
                                        <h6><a href="shop-detail.html">Full Sleeve Cotton</a></h6>
                                        <div class="total-products">(312 Product)</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Product Block Four -->
                            <div class="product-block-four col-lg-3 col-md-6 col-sm-6">
                                <div class="inner-box d-flex justify-content-between align-items-center flex-wrap">
                                    <div class="image">
                                        <span class="number">02</span>
                                        <img src="{{ asset('themes/clients/images/resource/product-2.png') }}"
                                            alt="" />
                                    </div>
                                    <div class="content">
                                        <h6><a href="shop-detail.html">Full Sleeve Cotton</a></h6>
                                        <div class="total-products">(312 Product)</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Product Block Four -->
                            <div class="product-block-four col-lg-3 col-md-6 col-sm-6">
                                <div class="inner-box d-flex justify-content-between align-items-center flex-wrap">
                                    <div class="image">
                                        <span class="number">03</span>
                                        <img src="{{ asset('themes/clients/images/resource/product-3.png') }}"
                                            alt="" />
                                    </div>
                                    <div class="content">
                                        <h6><a href="shop-detail.html">Monkey Red Caps</a></h6>
                                        <div class="total-products">(213 Product)</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Product Block Four -->
                            <div class="product-block-four col-lg-3 col-md-6 col-sm-6">
                                <div class="inner-box d-flex justify-content-between align-items-center flex-wrap">
                                    <div class="image">
                                        <span class="number">04</span>
                                        <img src="{{ asset('themes/clients/images/resource/product-4.png') }}"
                                            alt="" />
                                    </div>
                                    <div class="content">
                                        <h6><a href="shop-detail.html">Men,s Cotton Pant</a></h6>
                                        <div class="total-products">(461 Product)</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Product Block Four -->
                            <div class="product-block-four col-lg-3 col-md-6 col-sm-6">
                                <div class="inner-box d-flex justify-content-between align-items-center flex-wrap">
                                    <div class="image">
                                        <span class="number">05</span>
                                        <img src="{{ asset('themes/clients/images/resource/product-5.png') }}"
                                            alt="" />
                                    </div>
                                    <div class="content">
                                        <h6><a href="shop-detail.html">Full Sleeve Cotton</a></h6>
                                        <div class="total-products">(312 Product)</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Product Block Four -->
                            <div class="product-block-four col-lg-3 col-md-6 col-sm-6">
                                <div class="inner-box d-flex justify-content-between align-items-center flex-wrap">
                                    <div class="image">
                                        <span class="number">06</span>
                                        <img src="{{ asset('themes/clients/images/resource/product-6.png') }}"
                                            alt="" />
                                    </div>
                                    <div class="content">
                                        <h6><a href="shop-detail.html">Full Sleeve Cotton</a></h6>
                                        <div class="total-products">(567 Product)</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Product Block Four -->
                            <div class="product-block-four col-lg-3 col-md-6 col-sm-6">
                                <div class="inner-box d-flex justify-content-between align-items-center flex-wrap">
                                    <div class="image">
                                        <span class="number">07</span>
                                        <img src="{{ asset('themes/clients/images/resource/product-7.png') }}"
                                            alt="" />
                                    </div>
                                    <div class="content">
                                        <h6><a href="shop-detail.html">Monkey Red Caps</a></h6>
                                        <div class="total-products">(213 Product)</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Product Block Four -->
                            <div class="product-block-four col-lg-3 col-md-6 col-sm-6">
                                <div class="inner-box d-flex justify-content-between align-items-center flex-wrap">
                                    <div class="image">
                                        <span class="number">08</span>
                                        <img src="{{ asset('themes/clients/images/resource/product-8.png') }}"
                                            alt="" />
                                    </div>
                                    <div class="content">
                                        <h6><a href="shop-detail.html">Men,s Cotton Pant</a></h6>
                                        <div class="total-products">(461 Product)</div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Slide -->
                    <div class="slide">
                        <div class="row clearfix">

                            <!-- Product Block Four -->
                            <div class="product-block-four col-lg-3 col-md-6 col-sm-6">
                                <div class="inner-box d-flex justify-content-between align-items-center flex-wrap">
                                    <div class="image">
                                        <span class="number">01</span>
                                        <img src="{{ asset('themes/clients/images/resource/product-1.png') }}"
                                            alt="" />
                                    </div>
                                    <div class="content">
                                        <h6><a href="shop-detail.html">Full Sleeve Cotton</a></h6>
                                        <div class="total-products">(312 Product)</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Product Block Four -->
                            <div class="product-block-four col-lg-3 col-md-6 col-sm-6">
                                <div class="inner-box d-flex justify-content-between align-items-center flex-wrap">
                                    <div class="image">
                                        <span class="number">02</span>
                                        <img src="{{ asset('themes/clients/images/resource/product-2.png') }}"
                                            alt="" />
                                    </div>
                                    <div class="content">
                                        <h6><a href="shop-detail.html">Full Sleeve Cotton</a></h6>
                                        <div class="total-products">(312 Product)</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Product Block Four -->
                            <div class="product-block-four col-lg-3 col-md-6 col-sm-6">
                                <div class="inner-box d-flex justify-content-between align-items-center flex-wrap">
                                    <div class="image">
                                        <span class="number">03</span>
                                        <img src="{{ asset('themes/clients/images/resource/product-3.png') }}"
                                            alt="" />
                                    </div>
                                    <div class="content">
                                        <h6><a href="shop-detail.html">Monkey Red Caps</a></h6>
                                        <div class="total-products">(213 Product)</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Product Block Four -->
                            <div class="product-block-four col-lg-3 col-md-6 col-sm-6">
                                <div class="inner-box d-flex justify-content-between align-items-center flex-wrap">
                                    <div class="image">
                                        <span class="number">04</span>
                                        <img src="{{ asset('themes/clients/images/resource/product-4.png') }}"
                                            alt="" />
                                    </div>
                                    <div class="content">
                                        <h6><a href="shop-detail.html">Men,s Cotton Pant</a></h6>
                                        <div class="total-products">(461 Product)</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Product Block Four -->
                            <div class="product-block-four col-lg-3 col-md-6 col-sm-6">
                                <div class="inner-box d-flex justify-content-between align-items-center flex-wrap">
                                    <div class="image">
                                        <span class="number">05</span>
                                        <img src="{{ asset('themes/clients/images/resource/product-5.png') }}"
                                            alt="" />
                                    </div>
                                    <div class="content">
                                        <h6><a href="shop-detail.html">Full Sleeve Cotton</a></h6>
                                        <div class="total-products">(312 Product)</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Product Block Four -->
                            <div class="product-block-four col-lg-3 col-md-6 col-sm-6">
                                <div class="inner-box d-flex justify-content-between align-items-center flex-wrap">
                                    <div class="image">
                                        <span class="number">06</span>
                                        <img src="{{ asset('themes/clients/images/resource/product-6.png') }}"
                                            alt="" />
                                    </div>
                                    <div class="content">
                                        <h6><a href="shop-detail.html">Full Sleeve Cotton</a></h6>
                                        <div class="total-products">(567 Product)</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Product Block Four -->
                            <div class="product-block-four col-lg-3 col-md-6 col-sm-6">
                                <div class="inner-box d-flex justify-content-between align-items-center flex-wrap">
                                    <div class="image">
                                        <span class="number">07</span>
                                        <img src="{{ asset('themes/clients/images/resource/product-7.png') }}"
                                            alt="" />
                                    </div>
                                    <div class="content">
                                        <h6><a href="shop-detail.html">Monkey Red Caps</a></h6>
                                        <div class="total-products">(213 Product)</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Product Block Four -->
                            <div class="product-block-four col-lg-3 col-md-6 col-sm-6">
                                <div class="inner-box d-flex justify-content-between align-items-center flex-wrap">
                                    <div class="image">
                                        <span class="number">08</span>
                                        <img src="{{ asset('themes/clients/images/resource/product-8.png') }}"
                                            alt="" />
                                    </div>
                                    <div class="content">
                                        <h6><a href="shop-detail.html">Men,s Cotton Pant</a></h6>
                                        <div class="total-products">(461 Product)</div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Slide -->
                    <div class="slide">
                        <div class="row clearfix">

                            <!-- Product Block Four -->
                            <div class="product-block-four col-lg-3 col-md-6 col-sm-6">
                                <div class="inner-box d-flex justify-content-between align-items-center flex-wrap">
                                    <div class="image">
                                        <span class="number">01</span>
                                        <img src="{{ asset('themes/clients/images/resource/product-1.png') }}"
                                            alt="" />
                                    </div>
                                    <div class="content">
                                        <h6><a href="shop-detail.html">Full Sleeve Cotton</a></h6>
                                        <div class="total-products">(312 Product)</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Product Block Four -->
                            <div class="product-block-four col-lg-3 col-md-6 col-sm-6">
                                <div class="inner-box d-flex justify-content-between align-items-center flex-wrap">
                                    <div class="image">
                                        <span class="number">02</span>
                                        <img src="{{ asset('themes/clients/images/resource/product-2.png') }}"
                                            alt="" />
                                    </div>
                                    <div class="content">
                                        <h6><a href="shop-detail.html">Full Sleeve Cotton</a></h6>
                                        <div class="total-products">(312 Product)</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Product Block Four -->
                            <div class="product-block-four col-lg-3 col-md-6 col-sm-6">
                                <div class="inner-box d-flex justify-content-between align-items-center flex-wrap">
                                    <div class="image">
                                        <span class="number">03</span>
                                        <img src="{{ asset('themes/clients/images/resource/product-3.png') }}"
                                            alt="" />
                                    </div>
                                    <div class="content">
                                        <h6><a href="shop-detail.html">Monkey Red Caps</a></h6>
                                        <div class="total-products">(213 Product)</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Product Block Four -->
                            <div class="product-block-four col-lg-3 col-md-6 col-sm-6">
                                <div class="inner-box d-flex justify-content-between align-items-center flex-wrap">
                                    <div class="image">
                                        <span class="number">04</span>
                                        <img src="{{ asset('themes/clients/images/resource/product-4.png') }}"
                                            alt="" />
                                    </div>
                                    <div class="content">
                                        <h6><a href="shop-detail.html">Men,s Cotton Pant</a></h6>
                                        <div class="total-products">(461 Product)</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Product Block Four -->
                            <div class="product-block-four col-lg-3 col-md-6 col-sm-6">
                                <div class="inner-box d-flex justify-content-between align-items-center flex-wrap">
                                    <div class="image">
                                        <span class="number">05</span>
                                        <img src="{{ asset('themes/clients/images/resource/product-5.png') }}"
                                            alt="" />
                                    </div>
                                    <div class="content">
                                        <h6><a href="shop-detail.html">Full Sleeve Cotton</a></h6>
                                        <div class="total-products">(312 Product)</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Product Block Four -->
                            <div class="product-block-four col-lg-3 col-md-6 col-sm-6">
                                <div class="inner-box d-flex justify-content-between align-items-center flex-wrap">
                                    <div class="image">
                                        <span class="number">06</span>
                                        <img src="{{ asset('themes/clients/images/resource/product-6.png') }}"
                                            alt="" />
                                    </div>
                                    <div class="content">
                                        <h6><a href="shop-detail.html">Full Sleeve Cotton</a></h6>
                                        <div class="total-products">(567 Product)</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Product Block Four -->
                            <div class="product-block-four col-lg-3 col-md-6 col-sm-6">
                                <div class="inner-box d-flex justify-content-between align-items-center flex-wrap">
                                    <div class="image">
                                        <span class="number">07</span>
                                        <img src="{{ asset('themes/clients/images/resource/product-7.png') }}"
                                            alt="" />
                                    </div>
                                    <div class="content">
                                        <h6><a href="shop-detail.html">Monkey Red Caps</a></h6>
                                        <div class="total-products">(213 Product)</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Product Block Four -->
                            <div class="product-block-four col-lg-3 col-md-6 col-sm-6">
                                <div class="inner-box d-flex justify-content-between align-items-center flex-wrap">
                                    <div class="image">
                                        <span class="number">08</span>
                                        <img src="{{ asset('themes/clients/images/resource/product-8.png') }}"
                                            alt="" />
                                    </div>
                                    <div class="content">
                                        <h6><a href="shop-detail.html">Men,s Cotton Pant</a></h6>
                                        <div class="total-products">(461 Product)</div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

    <section class="counter-section">
        <div class="auto-container">
            <div class="inner-container d-flex justify-content-between align-items-center flex-wrap">

                <!-- Shipping Box -->
                <div class="shipping-box">
                    <div class="inner-box">
                        Miễn phí <span class="theme_color">Vận chuyển</span>
                        <div class="order">Cho tất cả các đơn hàng</div>
                    </div>
                </div>

                <!-- Arrow -->
                <div class="arrow">
                    <img src="{{ asset('themes/clients/images/icons/arrow.png') }}" alt="" />
                </div>

                <!-- Counter Boxed -->
                <div class="counter-boxed">
                    <div class="row clearfix">

                        <!-- Counter Column -->
                        <div class="counter-block col-lg-6 col-md-6 col-sm-6">
                            <div class="inner-box d-flex align-items-center">
                                <div class="counter"><span class="odometer" data-count="12"></span>k</div>
                                <div class="counter-text">Sản phẩm nội thất cho gia đình</div>
                            </div>
                        </div>
                        <div class="counter-block col-lg-6 col-md-6 col-sm-6">
                            <div class="inner-box d-flex align-items-center">
                                <div class="counter"><span class="odometer" data-count="120"></span>k</div>
                                <div class="counter-text">Khách hàng hài lòng</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="collection-section">
        <div class="auto-container">
            <div class="inner-container">
                <div class="pattern-layer"
                    style="background-image: url({{ asset('themes/clients/images/icons/pattern-1.png') }})"></div>
                <div class="shape-layer"
                    style="background-image: url({{ asset('themes/clients/images/background/pattern-1.png') }})"></div>
                <div class="row clearfix">
                    <div class="title-column col-lg-6 col-md-12 col-sm-12">
                        <div class="title">2024 Bộ sưu tập</div>
                        <h2>Kính mát nam Black Meta</h2>
                        <div class="deals">Deals <span>35% Flat</span></div>
                        <a class="shop-now" href="shop-detail.html">Mua ngay</a>
                        <div class="arrow">
                            <img src="images/icons/arrow-1.png" alt="" />
                        </div>
                    </div>
                    <div class="image-column col-lg-6 col-md-12 col-sm-12">
                        <div class="image">
                            <div class="shadow-layer"
                                style="background-image: url({{ asset('themes/clients/images/icons/pattern-2.png') }})">
                            </div>
                            <img src="{{ asset('themes/clients/images/resource/chair.png') }}" alt="" />
                            <div class="price-tag">
                                99<sup>$</sup>
                                <span>103</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section Three -->
    <section class="products-section-three">
        <div class="auto-container">
            <!-- Sec Title -->
            <div class="sec-title">
                <h4><span>Sản phẩm </span>sự lựa chọn của bạn !</h4>
            </div>

            <!-- MixitUp Galery -->
            <div class="mixitup-gallery">

                <!-- Filter -->
                <div class="filters">
                    <ul class="filter-tabs">
                        <li class="filter" data-role="button" data-filter="all">All</li>
                        @foreach ($categories as $category)
                            <li class="filter" data-role="button" data-filter=".category-{{ $category->id }}">
                                {{ $category->name }}</li>
                        @endforeach
                    </ul>
                </div>

                <div class="filter-list row clearfix">
                    @foreach ($products as $product)
                        <div
                            class="shop-item mix shadow rounded border
                            @foreach ($product->categories as $category)
                                category-{{ $category->id }} @endforeach
                            col-lg-3 col-md-6 col-sm-12 choild  mt-2">
                            <div class="inner-box ">
                                <div class="image">
                                    <a href="{{ route('productDetail', ['slug' => $product->slug]) }}">
                                        @if ($product->img_thumbnail)
                                            <img src="{{ Storage::url($product->img_thumbnail) }}" alt="" />
                                        @endif
                                    </a>
                                    <span class="tag flaticon-heart"></span>
                                    {{-- <div class="cart-box text-center">
                                        <a class="cart" href="#">Add to Cart</a>
                                    </div> --}}
                                </div>
                                <div class="lower-content p-3">
                                    <div class="rating">
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="light fa fa-star"></span>
                                    </div>
                                    <h6><a
                                            href="{{ route('productDetail', ['slug' => $product->slug]) }}">{{ Str::limit($product->name, 30) }}</a>
                                    </h6>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="price">
                                            @if ($product->price_sale == '')
                                                <span
                                                    class="new-price">{{ number_format($product->base_price ?? 0, 0, ',', '.') }}VNĐ</span>
                                            @else
                                                <span
                                                    class="old-price">{{ number_format($product->base_price ?? 0, 0, ',', '.') }}VNĐ</span>
                                                <span
                                                    class="new-price">{{ number_format($product->price_sale ?? 0, 0, ',', '.') }}VNĐ</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="button-box text-center">
                    <a href="{{ route('shop') }}" class="theme-btn btn-style-one">
                        Mua ngay <span class="icon flaticon-right-arrow"></span>
                    </a>
                </div>

            </div>
        </div>
    </section>
    <!-- End Products Section Three -->

    <!-- Sponsors Section -->
    <section class="sponsors-section">
        <div class="auto-container">
            <div class="inner-container">
                <div class="sponsors-outer">
                    <!-- Sponsors Carousel -->
                    <ul class="sponsors-carousel owl-carousel owl-theme">
                        <li class="slide-item">
                            <figure class="image-box"><a href="#"><img
                                        src="{{ asset('themes/clients/images/clients/1.png') }}" alt=""></a>
                            </figure>
                        </li>
                        <li class="slide-item">
                            <figure class="image-box"><a href="#"><img
                                        src="{{ asset('themes/clients/images/clients/2.png') }}" alt=""></a>
                            </figure>
                        </li>
                        <li class="slide-item">
                            <figure class="image-box"><a href="#"><img
                                        src="{{ asset('themes/clients/images/clients/3.png') }}" alt=""></a>
                            </figure>
                        </li>
                        <li class="slide-item">
                            <figure class="image-box"><a href="#"><img
                                        src="{{ asset('themes/clients/images/clients/4.png') }}" alt=""></a>
                            </figure>
                        </li>
                        <li class="slide-item">
                            <figure class="image-box"><a href="#"><img
                                        src="{{ asset('themes/clients/images/clients/5.png') }}" alt=""></a>
                            </figure>
                        </li>
                        <li class="slide-item">
                            <figure class="image-box"><a href="#"><img
                                        src="{{ asset('themes/clients/images/clients/1.png') }}" alt=""></a>
                            </figure>
                        </li>
                        <li class="slide-item">
                            <figure class="image-box"><a href="#"><img
                                        src="{{ asset('themes/clients/images/clients/2.png') }}" alt=""></a>
                            </figure>
                        </li>
                        <li class="slide-item">
                            <figure class="image-box"><a href="#"><img
                                        src="{{ asset('themes/clients/images/clients/3.png') }}" alt=""></a>
                            </figure>
                        </li>
                        <li class="slide-item">
                            <figure class="image-box"><a href="#"><img
                                        src="{{ asset('themes/clients/images/clients/4.png') }}" alt=""></a>
                            </figure>
                        </li>
                        <li class="slide-item">
                            <figure class="image-box"><a href="#"><img
                                        src="{{ asset('themes/clients/images/clients/5.png') }}" alt=""></a>
                            </figure>
                        </li>
                        <li class="slide-item">
                            <figure class="image-box"><a href="#"><img
                                        src="{{ asset('themes/clients/images/clients/1.png') }}" alt=""></a>
                            </figure>
                        </li>
                        <li class="slide-item">
                            <figure class="image-box"><a href="#"><img
                                        src="{{ asset('themes/clients/images/clients/2.png') }}" alt=""></a>
                            </figure>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- News Section -->
    <section class="news-section">
        <div class="auto-container">
            <div class="news-carousel owl-carousel owl-theme">
                <!-- News Block -->
                @foreach ($blogs as $item)
                    <div class="news-block">
                        <div class="inner-box">
                            <div class="image">
                                <div class="tag">bedroom</div>
                                <a href="blog-detail.html"><img
                                        src="https://tse1.mm.bing.net/th?id=OIP.Tn60vMqPKD9zgRwdL5qHeAHaGR&pid=Api"
                                        alt="" /></a>
                            </div>
                            <div class="lower-content">
                                <div class="author">
                                    <img src="https://tse1.mm.bing.net/th?id=OIP.Tn60vMqPKD9zgRwdL5qHeAHaGR&pid=Api"
                                        alt="" />
                                </div>
                                <h5><a href="blog-detail.html">{{ $item->title }}</a></h5>
                                <div class="info">By: <span>{{ $item->user->name }}</span>
                                    <i>{{ $item->created_at }}</i>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="testimonial-section">
        <div class="pattern-layer"
            style="background-image: url({{ asset('themes/clients/images/background/pattern-3.png') }})"></div>
        <div class="auto-container">
            <div class="inner-container">
                <div class="pattern-layer-two"
                    style="background-image: url({{ asset('themes/clients/images/background/pattern-4.png') }})">
                </div>
                <div class="vector-layer"
                    style="background-image: url({{ asset('themes/clients/images/background/pattern-2.png') }})"></div>
                <div class="single-item-carousel owl-carousel owl-theme">

                    <!-- Testimonial Block -->
                    <div class="testimonial-block">
                        <div class="inner-box">
                            <div class="row clearfix">
                                <!-- Image Column -->
                                <div class="image-column col-lg-4 col-md-12 col-sm-12">
                                    <div class="inner-column">
                                        <div class="arrow-layer"
                                            style="background-image: url({{ asset('themes/clients/images/icons/arrow-2.png') }})">
                                        </div>
                                        <div class="image">
                                            <img src="{{ asset('themes/clients/images/resource/author-2.jpg') }}"
                                                alt="" />
                                            <!-- Social Box -->
                                            <ul class="social-box">
                                                <li><a href="https://www.facebook.com/" class="fa fa-facebook-f"></a></li>
                                                <li><a href="https://www.twitter.com/" class="fa fa-twitter"></a>
                                                </li>
                                                <li><a href="https://dribbble.com/" class="fa fa-dribbble"></a>
                                                </li>
                                                <li><a href="https://www.linkedin.com/" class="fa fa-linkedin"></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- Content Column -->
                                <div class="content-column col-lg-8 col-md-12 col-sm-12">
                                    <div class="inner-column">
                                        <div class="rating">
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                        </div>
                                        <div class="text">Doanh thu hơn thế này. Tôi
                                            sẽ
                                            giới thiệu cho mọi người tôi biết tôi thích Level hơn mỗi ngày vì nó
                                            làm cho cuộc sống của tôi dễ dàng hơn rất nhiều. Nó thực sự giúp tôi tiết kiệm
                                            thời gian và công sức.</div>
                                        <div class="quote-icon flaticon-quote"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonial Block -->
                    <div class="testimonial-block">
                        <div class="inner-box">
                            <div class="row clearfix">
                                <!-- Image Column -->
                                <div class="image-column col-lg-4 col-md-12 col-sm-12">
                                    <div class="inner-column">
                                        <div class="arrow-layer"
                                            style="background-image: url({{ asset('themes/clients/images/icons/arrow-2.png') }})">
                                        </div>
                                        <div class="image">
                                            <img src="{{ asset('themes/clients/images/resource/author-2.jpg') }}"
                                                alt="" />
                                            <!-- Social Box -->
                                            <ul class="social-box">
                                                <li><a href="https://www.facebook.com/" class="fa fa-facebook-f"></a></li>
                                                <li><a href="https://www.twitter.com/" class="fa fa-twitter"></a>
                                                </li>
                                                <li><a href="https://dribbble.com/" class="fa fa-dribbble"></a>
                                                </li>
                                                <li><a href="https://www.linkedin.com/" class="fa fa-linkedin"></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- Content Column -->
                                <div class="content-column col-lg-8 col-md-12 col-sm-12">
                                    <div class="inner-column">
                                        <div class="rating">
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                        </div>
                                        <div class="text">Doanh thu hơn thế này. Tôi
                                            sẽ
                                            giới thiệu cho mọi người tôi biết tôi thích Level hơn mỗi ngày vì nó
                                            làm cho cuộc sống của tôi dễ dàng hơn rất nhiều. Nó thực sự giúp tôi tiết kiệm
                                            thời gian và công sức.</div>
                                        <div class="quote-icon flaticon-quote"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
@section('style')
    <style>
        .shop-item .image img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 8px;
        }

        .choild {
            width: calc(25% - 10px);
            margin: 0 5px;
        }
    </style>
@endsection
@section('script-libs')
@endsection
