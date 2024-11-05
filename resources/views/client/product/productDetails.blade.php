@extends('client.layouts.master')
@section('content')
    <div class="page-wrapper">
        <section class="page-title">
            <div class="auto-container">
                <h2>Shop Detail</h2>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Pages</li>
                    <li>Shop Details</li>
                </ul>
            </div>
        </section>

        <!-- Shop Detail Section -->
        <section class="shop-detail-section">
            <div class="auto-container">
                <!-- Upper Box -->
                <div class="upper-box">
                    <div class="row clearfix">
                        <!-- Gallery Column -->
                        <div class="gallery-column col-lg-6 col-md-12 col-sm-12">
                            <div class="inner-column">
                                <div class="carousel-outer">
                                    <!-- Swiper -->
                                    <div class="swiper-container content-carousel">
                                        <div class="swiper-wrapper">
                                            @foreach ($product->galleries as $gallery)
                                                @if ($gallery->img_path)
                                                    <div class="swiper-slide">
                                                        <figure class="image"><a
                                                                href="{{ Storage::url($gallery->img_path) }}"
                                                                class="lightbox-image"><img
                                                                    src="{{ Storage::url($gallery->img_path) }}"
                                                                    alt=""></a></figure>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="swiper-container thumbs-carousel">
                                        <div class="swiper-wrapper">
                                            @foreach ($product->galleries as $gallery)
                                                @if ($gallery->img_path)
                                                    <div class="swiper-slide">
                                                        <figure class="thumb"><img
                                                                src="{{ Storage::url($gallery->img_path) }}"
                                                                style="height: 100px" alt=""></figure>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Content Column -->
                        <div class="content-column col-lg-6 col-md-12 col-sm-12">
                            <div class="inner-column">
                                <h3>{{ $product->name }}</h3>
                                <!-- Rating -->
                                <div class="rating">
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="light fa fa-star"></span>
                                    <i>(4 customer review)</i>
                                </div>
                                <!-- Price -->
                                <div class="price">{{ number_format($product->price_sale) ?? 0, 0, ',', '.' }}VNĐ
                                    <span>{{ number_format($product->base_price) ?? 0, 0, ',', '.' }}VNĐ</span> <i>-34%</i>
                                </div>
                                <div class="text">{{ $product->description }}</div>
                                <div class="d-flex flex-wrap">
                                    @php
                                        // Khởi tạo mảng để lưu trữ các nhóm thuộc tính và giá trị của chúng
                                        // Mục đích ở đây là muốn chuyển attribute thành key và attribute_value thành value
                                        // Hoặc có thể hiểu nó sẽ đưa về kiểu [1][0];
                                        $groupAttribute = [];
                                    @endphp

                                    <!-- Nhóm các giá trị thuộc tính lại với nhau -->
                                    @foreach ($product->variants as $variant)
                                        @foreach ($variant->attributes as $attribute)
                                            @php
                                                // Lấy tên và giá trị của thuộc tính
                                                $attributeName = $attribute->attribute->name;
                                                $attributeValue = $attribute->attributeValue->value;

                                                // Kiểm tra nếu $attributeName đã tồn tại trong mảng chưa
                                                if (!isset($groupAttribute[$attributeName])) {
                                                    $groupAttribute[$attributeName] = [];
                                                }

                                                // Kiểm tra sự tồn tại: Sử dụng if (!isset($groupAttribute[$attributeName]))
                                                // để kiểm tra nếu attributeName đã có trong mảng $groupAttribute chưa.
                                                // Nếu chưa có, thì tạo một mảng mới cho nó.

                                                // Nếu $attributeValue chưa có trong danh sách của $attributeName thì thêm vào
                                                if (!in_array($attributeValue, $groupAttribute[$attributeName])) {
                                                    $groupAttribute[$attributeName][] = $attributeValue;
                                                }

                                                // Loại bỏ trùng lặp: Kiểm tra nếu attributeValue chưa có trong danh sách giá trị của attributeName,
                                                //thì thêm vào.

                                            @endphp
                                        @endforeach
                                    @endforeach

                                    <!-- Hiển thị các nhóm thuộc tính và các giá trị của chúng -->
                                    <div class="d-flex flex-wrap attribute-container">
                                        @foreach ($groupAttribute as $attributeName => $values)
                                            <div class="attribute-group">
                                                <div class="model mb-2">
                                                    <span class="model-title">{{ $attributeName }}</span>
                                                </div>
                                                <div class="select-size-box d-flex flex-wrap">
                                                    @foreach ($values as $index => $value)
                                                        <div class="select-box me-3">
                                                            <input type="radio" name="{{ $attributeName }}"
                                                                id="{{ Str::slug($attributeName . '-' . $value) }}"
                                                                value="{{ $value }}"
                                                                {{ $loop->first ? 'checked' : '' }}>
                                                            <label
                                                                for="{{ Str::slug($attributeName . '-' . $value) }}">{{ $value }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>


                                <!-- Categories -->
                                <div class="categories"><span>Danh mục :</span>
                                    @foreach ($product->categories as $category)
                                        {{ $category->name }}
                                    @endforeach
                                </div>

                                <!-- Tags -->
                                <div class="sku"><span>Mã sản phẩm :</span> {{ $product->sku }}</div>

                                <!-- Social Box -->
                                <ul class="social-box">
                                    <li class="share">Share:</li>
                                    <li><a href="https://www.facebook.com/" class="fa fa-facebook-f"></a></li>
                                    <li><a href="https://www.twitter.com/" class="fa fa-twitter"></a></li>
                                    <li><a href="https://dribbble.com/" class="fa fa-dribbble"></a></li>
                                    <li><a href="https://www.linkedin.com/" class="fa fa-linkedin"></a></li>
                                </ul>

                                <div class="d-flex align-items-center flex-wrap">

                                    <!-- Button Box -->
                                    <div class="button-box">
                                        <a href="shop.html" class="theme-btn btn-style-one">
                                            Add to cart
                                        </a>
                                    </div>

                                    <!-- Quantity Box -->
                                    <div class="quantity-box">
                                        <div class="item-quantity">
                                            <input class="qty-spinner" type="text" value="1" name="quantity">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Upper Box -->

                <!-- Lower Box -->
                <div class="lower-box">

                    <!-- Product Info Tabs -->
                    <div class="product-info-tabs">
                        <!-- Product Tabs -->
                        <div class="prod-tabs tabs-box">

                            <!-- Tab Btns -->
                            <ul class="tab-btns tab-buttons clearfix">
                                <li data-tab="#prod-details" class="tab-btn active-btn">Product Details</li>
                                <li data-tab="#prod-info" class="tab-btn">additional information</li>
                                <li data-tab="#prod-review" class="tab-btn">Review (02)</li>
                                <li data-tab="#prod-faq" class="tab-btn">Faq</li>
                            </ul>

                            <!-- Tabs Container -->
                            <div class="tabs-content">

                                <!-- Tab / Active Tab -->
                                <div class="tab active-tab" id="prod-details">
                                    <div class="content">
                                        <h3>Experience is over the world visit</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vulputate
                                            vestibulum Phasellus rhoncus, dolor eget viverra pretium, dolor tellus aliquet
                                            nunc vitae ultricies erat elit eu lacus. Vestibulum non justo consectetur,
                                            cursus ante, tincidunt sapien. Nulla quis diam sit amet turpis interdum accumsan
                                            quis nec enim. Vivamus faucibus ex sed nibh egestas elementum. Mauris et
                                            bibendum dui. Aenean consequat pulvinar luctus</p>
                                        <h5>More Details</h5>
                                        <div class="row clearfix">
                                            <div class="col-lg-6 col-md-12 col-sm-12">
                                                <ul class="list-one">
                                                    <li>Lorem Ipsum is simply dummy text of the printing and typesetting
                                                        industry</li>
                                                    <li>Lorem Ipsum has been the ‘s standard dummy text. Lorem Ipsumum is
                                                        simply dummy text.</li>
                                                    <li>type here your detail one by one li more add</li>
                                                    <li>has been the industry’s standard dummy text ever since. Lorem Ips
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-lg-6 col-md-12 col-sm-12">
                                                <ul class="list-two">
                                                    <li>Lorem Ipsum generators on the tend to repeat.</li>
                                                    <li>If you are going to use a passage.</li>
                                                    <li>Lorem Ipsum generators on the tend to repeat.</li>
                                                    <li>Lorem Ipsum generators on the tend to repeat.</li>
                                                    <li>If you are going to use a passage.</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tab -->
                                <div class="tab" id="prod-info">
                                    <div class="content">
                                        <h3>Experience is over the world visit</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vulputate
                                            vestibulum Phasellus rhoncus, dolor eget viverra pretium, dolor tellus aliquet
                                            nunc vitae ultricies erat elit eu lacus. Vestibulum non justo consectetur,
                                            cursus ante, tincidunt sapien. Nulla quis diam sit amet turpis interdum accumsan
                                            quis nec enim. Vivamus faucibus ex sed nibh egestas elementum. Mauris et
                                            bibendum dui. Aenean consequat pulvinar luctus</p>
                                    </div>
                                </div>

                                <!--Tab-->
                                <div class="tab" id="prod-review">
                                    <h2 class="">Bình luận</h2>
                                    <!--Reviews Container-->
                                    <div class="comments-area">
                                        <!--Comment Box-->
                                        <!-- Bình luận cấp 1 -->
                                        @if ($product->comments())
                                            @foreach ($product->comments->where('parent_id', null) as $comment)
                                                <div class=" mt-3 mb-3">
                                                    <div class="card-body">
                                                        <div class="d-flex">

                                                            @if ($comment->user->img_thumbnail)
                                                                <img src="{{ $comment->user->img_thumbnail }}"
                                                                    class="rounded-circle me-3" alt="User Avatar">
                                                            @else
                                                                <img src="{{ asset('themes/image/logo.jpg') }}"
                                                                    class="rounded-circle me-3" alt="User Avatar">
                                                            @endif
                                                            <div>
                                                                <h5 class="mb-1"> {{ $comment->user->name }}</h5>
                                                                <small
                                                                    class="text-muted">{{ $comment->created_at->format('d-m-Y') }}</small>
                                                                <p class="mt-2">{!! $comment->comment !!}</p>
                                                                <!-- Nút trả lời -->
                                                                <button class="btn btn-sm btn-outline-primary reply-btn"
                                                                    type="button">Trả lời</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if ($comment->replies)
                                                        <!-- Hiển thị các phản hồi -->
                                                        @foreach ($comment->replies as $reply)
                                                            <!-- Bình luận cấp 2 (trả lời) -->
                                                            <div class="card-body ps-5">
                                                                <div class="d-flex mb-3">
                                                                    @if ($comment->user->img_thumbnail)
                                                                        <img src="{{ $comment->user->img_thumbnail }}"
                                                                            class="rounded-circle me-3" alt="User Avatar">
                                                                    @else
                                                                        <img src="{{ asset('themes/image/logo.jpg') }}"
                                                                            class="rounded-circle me-3" alt="User Avatar">
                                                                    @endif
                                                                    <div>
                                                                        <h5 class="mb-1"> {{ $comment->user->name }}
                                                                        </h5>
                                                                        <small
                                                                            class="text-muted">{{ $comment->created_at->format('d-m-Y') }}</small>
                                                                        <p class="mt-2">{!! $comment->comment !!}</p>
                                                                        <!-- Nút trả lời -->

                                                                    </div>
                                                                </div>
                                                                <!-- Thêm bình luận trả lời cấp 2 khác tại đây nếu cần -->
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                    <!-- Bình luận cấp 2 (trả lời) -->
                                                    <div class="card-body ps-5">
                                                        <div class="d-flex mb-3">
                                                            <img src="https://via.placeholder.com/50"
                                                                class="rounded-circle me-3" alt="User Avatar">
                                                            <div>
                                                                <h6 class="mb-1">Tên người dùng</h6>
                                                                <small class="text-muted">1 giờ trước</small>
                                                                <p class="mt-2">Đây là nội dung bình luận trả lời.</p>
                                                            </div>
                                                        </div>
                                                        <!-- Thêm bình luận trả lời cấp 2 khác tại đây nếu cần -->
                                                    </div>

                                                    <!-- Khu vực nhập bình luận trả lời -->
                                                    <div class="card-body ps-5 d-none reply-form">
                                                        <input type="text" class="form-control mb-2"
                                                            placeholder="Nhập câu trả lời...">
                                                        <button class="btn btn-primary btn-sm">Gửi</button>
                                                        <button class="btn btn-secondary btn-sm cancel-btn">Hủy</button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif



                                    </div>

                                    <!-- Comment Form -->
                                    {{-- @if (Auth::check()) --}}
                                    <div class="shop-comment-form">
                                        <form action="{{ route('comments') }}" method="post">
                                            @csrf
                                            <h3 class="reviews__comment--reply__title mb-15">Thêm Bình Luận </h3>

                                            <div class="row">
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                                    <label>Bình luận của bạn*</label>
                                                    <textarea name="comment" placeholder=""></textarea>
                                                </div>

                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                                <button class="btn btn-primary">
                                                    Gửi
                                                </button>

                                            </div>
                                        </form>
                                    </div>
                                    {{-- @endif --}}


                                </div>

                                <!-- Tab -->
                                <div class="tab" id="prod-faq">
                                    <div class="content">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vulputate
                                            vestibulum Phasellus rhoncus, dolor eget viverra pretium, dolor tellus aliquet
                                            nunc, vitae ultricies erat elit eu lacus. Vestibulum non justo consectetur,
                                            cursus ante, tincidunt sapien. Nulla quis diam sit amet turpis interdum accumsan
                                            quis nec enim. Vivamus faucibus ex sed nibh egestas elementum. Mauris et
                                            bibendum dui. Aenean consequat pulvinar luctus. Suspendisse consectetur
                                            tristique tortor</p>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <!--End Product Info Tabs-->

                </div>
                <!-- End Lower Box -->

            </div>
        </section>

        <section class="products-section-six">
            <div class="auto-container">
                <!-- Sec Title -->
                <div class="sec-title">
                    <h4><span>Populer</span> Products For You !</h4>
                </div>
                <div class="row clearfix">

                    <!-- Shop Item Two -->
                    <div class="shop-item-two col-lg-3 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <div class="image">
                                <a href="shop-detail.html"><img src="images/resource/products/25.png"
                                        alt="" /></a>
                                <div class="options-box">
                                    <ul class="option-list">
                                        <li><a class="flaticon-resize" href="shop-detail.html"></a></li>
                                        <li><a class="flaticon-heart" href="shop-detail.html"></a></li>
                                        <li><a class="flaticon-shopping-cart-2" href="shop-detail.html"></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="content">
                                <h6><a href="shop-detail.html">masks 95 percent 0.3-μm <br> particles</a></h6>
                                <div class="lower-box">
                                    <div class="price"><span>$239.52</span> $362.00</div>
                                    <!-- Select Size -->
                                    <div class="select-amount clearfix">
                                        <div class="select-box"><input type="radio" name="payment-group"
                                                id="radio-one" checked><label for="radio-one">32</label></div>
                                        <div class="select-box not-available"><label for="radio-two">34</label></div>
                                        <div class="select-box"><input type="radio" name="payment-group"
                                                id="radio-three"><label for="radio-three">36</label></div>
                                    </div>
                                    <!-- Select Size -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Shop Item Two -->
                    <div class="shop-item-two col-lg-3 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <div class="image">
                                <a href="shop-detail.html"><img src="images/resource/products/26.png"
                                        alt="" /></a>
                                <div class="options-box">
                                    <ul class="option-list">
                                        <li><a class="flaticon-resize" href="shop-detail.html"></a></li>
                                        <li><a class="flaticon-heart" href="shop-detail.html"></a></li>
                                        <li><a class="flaticon-shopping-cart-2" href="shop-detail.html"></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="content">
                                <h6><a href="shop-detail.html">masks 95 percent 0.3-μm <br> particles</a></h6>
                                <div class="lower-box">
                                    <div class="price"><span>$239.52</span> $362.00</div>
                                    <!-- Select Size -->
                                    <div class="select-amount clearfix">
                                        <div class="select-box"><input type="radio" name="payment-group"
                                                id="radio-four" checked><label for="radio-four">32</label></div>
                                        <div class="select-box not-available"><label for="radio-five">34</label></div>
                                        <div class="select-box"><input type="radio" name="payment-group"
                                                id="radio-six"><label for="radio-six">36</label></div>
                                    </div>
                                    <!-- Select Size -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Shop Item Two -->
                    <div class="shop-item-two col-lg-3 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <div class="image">
                                <a href="shop-detail.html"><img src="images/resource/products/27.png"
                                        alt="" /></a>
                                <div class="options-box">
                                    <ul class="option-list">
                                        <li><a class="flaticon-resize" href="shop-detail.html"></a></li>
                                        <li><a class="flaticon-heart" href="shop-detail.html"></a></li>
                                        <li><a class="flaticon-shopping-cart-2" href="shop-detail.html"></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="content">
                                <h6><a href="shop-detail.html">masks 95 percent 0.3-μm <br> particles</a></h6>
                                <div class="lower-box">
                                    <div class="price"><span>$239.52</span> $362.00</div>
                                    <!-- Select Size -->
                                    <div class="select-amount clearfix">
                                        <div class="select-box"><input type="radio" name="payment-group"
                                                id="radio-seven" checked><label for="radio-seven">32</label></div>
                                        <div class="select-box not-available"><label for="radio-eight">34</label></div>
                                        <div class="select-box"><input type="radio" name="payment-group"
                                                id="radio-nine"><label for="radio-nine">36</label></div>
                                    </div>
                                    <!-- Select Size -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Shop Item Two -->
                    <div class="shop-item-two col-lg-3 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <div class="image">
                                <a href="shop-detail.html"><img src="images/resource/products/28.png"
                                        alt="" /></a>
                                <div class="options-box">
                                    <ul class="option-list">
                                        <li><a class="flaticon-resize" href="shop-detail.html"></a></li>
                                        <li><a class="flaticon-heart" href="shop-detail.html"></a></li>
                                        <li><a class="flaticon-shopping-cart-2" href="shop-detail.html"></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="content">
                                <h6><a href="shop-detail.html">masks 95 percent 0.3-μm <br> particles</a></h6>
                                <div class="lower-box">
                                    <div class="price"><span>$239.52</span> $362.00</div>
                                    <!-- Select Size -->
                                    <div class="select-amount clearfix">
                                        <div class="select-box"><input type="radio" name="payment-group"
                                                id="radio-ten" checked><label for="radio-ten">32</label></div>
                                        <div class="select-box"><input type="radio" name="payment-group"
                                                id="radio-eleven"><label for="radio-eleven">34</label></div>
                                        <div class="select-box"><input type="radio" name="payment-group"
                                                id="radio-twelve"><label for="radio-twelve">36</label></div>
                                    </div>
                                    <!-- Select Size -->
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- End Products Section Six -->

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
        <!-- End Gallery Section -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <div class="auto-container">

                <!-- Widgets Section -->
                <div class="widgets-section">
                    <div class="row clearfix">
                        <!-- Column -->
                        <div class="big-column col-lg-7 col-md-12 col-sm-12">
                            <div class="row clearfix">

                                <!-- Footer Column -->
                                <div class="footer-column col-lg-7 col-md-6 col-sm-12">
                                    <div class="footer-widget links-widget">
                                        <!-- Logo -->
                                        <div class="logo"><a href="index.html"><img src="images/logo.png"
                                                    alt="" title=""></a></div>
                                        <div class="text">4517 Washington Ave. Manchester, Kentucky 39495 ashington Ave.
                                            Manchester, </div>
                                        <ul class="contact-list">
                                            <li><span class="icon flaticon-map"></span>254 Lillian Blvd, Holbrook</li>
                                            <li><span class="icon flaticon-call"></span>1-800-654-3210</li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Footer Column -->
                                <div class="footer-column col-lg-5 col-md-6 col-sm-12">
                                    <div class="footer-widget links-widget">
                                        <h5>Find It Fast</h5>
                                        <ul class="page-list">
                                            <li><a href="#">Laptops & Computers</a></li>
                                            <li><a href="#">Cameras & Photography</a></li>
                                            <li><a href="#">Smart Phones & Tablets</a></li>
                                            <li><a href="#">Video Games & Consoles</a></li>
                                            <li><a href="#">TV & Audio</a></li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Column -->
                        <div class="big-column col-lg-5 col-md-12 col-sm-12">
                            <div class="row clearfix">

                                <!-- Footer Column -->
                                <div class="footer-column col-lg-7 col-md-6 col-sm-12">
                                    <div class="footer-widget links-widget">
                                        <h5>Quick Links</h5>
                                        <ul class="page-list">
                                            <li><a href="#">Your Account</a></li>
                                            <li><a href="#">Returns & Exchanges</a></li>
                                            <li><a href="#">Return Center</a></li>
                                            <li><a href="#">Purchase Hisotry</a></li>
                                            <li><a href="#">App Download</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Footer Column -->
                                <div class="footer-column col-lg-5 col-md-6 col-sm-12">
                                    <div class="footer-widget instagram-widget">
                                        <h5>Service us</h5>
                                        <ul class="page-list-two">
                                            <li><a href="#">Support Center</a></li>
                                            <li><a href="#">Term & Conditions</a></li>
                                            <li><a href="#">Shipping</a></li>
                                            <li><a href="#">Privacy Policy</a></li>
                                            <li><a href="#">Help</a></li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                <!-- Footer Bottom -->
                <div class="footer-bottom">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div class="copyright"><span>&copy; 2022</span> Powered by Theme. All Rights Reserved.</div>
                        <div class="email-box">
                            <a href="mailto:DumTheme@gmail.com"><span
                                    class="icon flaticon-mail"></span>DumTheme@gmail.com</a>
                        </div>
                        <div class="cards"><img src="images/icons/cards.png" alt="" /></div>
                    </div>
                </div>

            </div>
        </footer>
        <!-- End Main Footer -->

    </div>
    <!-- End PageWrapper -->

    <!-- Search Popup -->
    <div class="search-popup">
        <div class="color-layer"></div>
        <button class="close-search"><span class="fa fa-arrow-up"></span></button>
        <form method="post" action="https://html.themexriver.com/bloxic/blog.html">
            <div class="form-group">
                <input type="search" name="search-field" value="" placeholder="Search Here" required="">
                <button type="submit"><i class="fa fa-search"></i></button>
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script>
        // Khi nhấn nút "Trả lời", hiện form trả lời
        document.querySelectorAll('.reply-btn').forEach(button => {
            button.addEventListener('click', function() {
                this.closest('.card').querySelector('.reply-form').classList.toggle('d-none');
            });
        });

        // Khi nhấn nút "Hủy", ẩn form trả lời
        document.querySelectorAll('.cancel-btn').forEach(button => {
            button.addEventListener('click', function() {
                this.closest('.reply-form').classList.add('d-none');
            });
        });
    </script>
@endsection
