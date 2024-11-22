@extends('client.layouts.master')
@section('title')
    {{ $product->name }}
@endsection
@section('content')
    <div class="page-wrapper">
        <!-- Shop Detail Section -->
        <section class="shop-detail-section">
            <div class="auto-container">
                <!-- Upper Box -->
                <div class="upper-box">
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success!</strong> {{ session()->get('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong> {{ session()->get('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('addToCart') }}" method="post">
                        @csrf
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
                                                            <figure class="image">
                                                                <a href="{{ Storage::url($gallery->img_path) }}"
                                                                    class="lightbox-image">
                                                                    <img src="{{ Storage::url($gallery->img_path) }}"
                                                                        alt="">
                                                                </a>
                                                            </figure>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <div class="swiper-container thumbs-carousel">
                                        <div class="swiper-wrapper">
                                            @foreach ($product->galleries as $gallery)
                                                @if ($gallery->img_path)
                                                    <div class="swiper-slide mb-5">
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
                                    <div class="price">{{ number_format($product->price_sale, 0, ',', '.') }} VNĐ
                                        <span>{{ number_format($product->base_price, 0, ',', '.') }}VNĐ</span>
                                    </div>
                                    <div class="text">{{ $product->description }}</div>
                                    <div class="d-flex flex-wrap">
                                        @php
                                            $groupAttribute = [];
                                            $arr = [];
                                        @endphp

                                        @foreach ($product->variants as $variant)
                                            @foreach ($variant->attributes as $attribute)
                                                @php
                                                    $data = [
                                                        'id' => $attribute->attributeValue->id,
                                                        'name' => $attribute->attributeValue->value,
                                                    ];

                                                    if (!in_array($data, $arr)) {
                                                        $arr[] = $data;
                                                    }

                                                    $attributeName = $attribute->attribute->name;
                                                    if (!isset($groupAttribute[$attributeName])) {
                                                        $groupAttribute[$attributeName] = [];
                                                    }

                                                    if (!in_array($data, $groupAttribute[$attributeName])) {
                                                        $groupAttribute[$attributeName][] = $data;
                                                    }
                                                @endphp
                                            @endforeach
                                        @endforeach

                                        <div class="d-grid flex-wrap attribute-container">
                                            @foreach ($groupAttribute as $attributeName => $values)
                                                <div class="attribute-group">
                                                    <div class="model">
                                                        <span class="model-title">{{ $attributeName }}</span>
                                                    </div>
                                                    <div class="select-size-box d-flex flex-wrap">
                                                        <select name="variant_attributes[attribute_value_id][]"
                                                            class="form-select attribute-select me-3"
                                                            data-attribute-name="{{ $attributeName }}">
                                                            <option value="">Chọn biến thể</option>
                                                            @foreach ($values as $value)
                                                                <option value="{{ $value['id'] }}">{{ Str::limit($value['name'], 15) }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

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
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="total_amount" value="{{ $product->price_sale }}">
                                            <button type="submit" class="theme-btn btn-style-one">
                                                Add to cart
                                            </button>
                                        </div>
                                        <!-- Quantity Box -->
                                        <div class="quantity-box d-flex align-items-center"
                                            style="gap: 0.5rem; padding: 0.5rem; border: 1px solid #ccc; border-radius: 8px; background-color: #f9f9f9;">
                                            <label for="quantity"
                                                style="font-size: 1rem; font-weight: 500;">Quantity:</label>
                                            <input type="number" id="quantity" name="quantity" min="1"
                                                value="1"
                                                style="width: 60px; padding: 0.25rem; border-radius: 4px; border: 1px solid #ccc;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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
                                <div class="tab p-2" id="prod-review">
                                    <h1 class="">Bình luận</h1>
                                    <!--Reviews Container-->
                                    <div class="comments-area p-3">
                                        <!--Comment Box-->
                                        <!-- Bình luận cấp 1 -->
                                        @if ($product->comments->count() == 0)
                                            <p>Không có bình luận nào</p>
                                        @else
                                            @foreach ($product->comments->where('parent_id', null) as $comment)
                                                <div class="mb-3 p-4">
                                                    <div class="card-body">
                                                        <div class="d-flex mb-3">
                                                            <div>
                                                                <h4 class="mb-1">
                                                                    @if ($comment->user->img_thumbnail)
                                                                        <img src="{{ Storage::url($comment->user->img_thumbnail) }}"
                                                                            class="rounded-circle me-3" alt="User Avatar"
                                                                            width="50">
                                                                    @else
                                                                        <img src="{{ asset('themes/image/logo.jpg') }}"
                                                                            class="rounded-circle me-3" alt="User Avatar"
                                                                            width="50">
                                                                    @endif
                                                                    {{ $comment->user->name }}
                                                                </h4>
                                                                <small
                                                                    class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                                                <p class="mt-2">{{ $comment->comment }}</p>
                                                                <!-- Nút trả lời -->
                                                                @if (Auth::check())
                                                                    <button
                                                                        class="btn btn-sm btn-outline-primary reply-btn"
                                                                        type="button" data-id="{{ $comment->id }}">Trả
                                                                        lời</button>
                                                                @endif

                                                            </div>

                                                        </div>

                                                    </div>
                                                    <!-- Bình luận cấp 2 (trả lời) -->
                                                    @foreach ($comment->replies as $reply)
                                                        <div class="card-body ps-5 mt-3">
                                                            <div class="d-flex mb-4">

                                                                <div>
                                                                    <h5 class="mb-1">
                                                                        @if ($reply->user->img_thumbnail)
                                                                            <img src="{{ Storage::url($reply->user->img_thumbnail) }}"
                                                                                class="rounded-circle me-3"
                                                                                alt="User Avatar" width="50">
                                                                        @else
                                                                            <img src="{{ asset('themes/image/logo.jpg') }}"
                                                                                class="rounded-circle me-3"
                                                                                alt="User Avatar" width="50">
                                                                        @endif
                                                                        {{ $reply->user->name }}
                                                                    </h5>
                                                                    <small
                                                                        class="text-muted">{{ $reply->created_at->diffForHumans() }}</small>
                                                                    <p class="mt-2">{{ $reply->comment }}</p>
                                                                    @if (Auth::check())
                                                                        <button
                                                                            class="btn btn-sm btn-outline-primary reply-btn"
                                                                            type="button"
                                                                            data-id="{{ $comment->id }}">Trả
                                                                            lời</button>
                                                                    @else
                                                                        <hr width="1200px">
                                                                    @endif
                                                                </div>

                                                            </div>

                                                        </div>
                                                    @endforeach

                                                    <!-- Khu vực nhập bình luận trả lời -->
                                                    <div class="card-body ps-5 d-none reply-form"
                                                        id="reply-form-{{ $comment->id }}">
                                                        <form action="{{ route('comments', $comment->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <input type="hidden" name="product_id"
                                                                value="{{ $product->id }}">
                                                            <input type="hidden" name="parent_id"
                                                                value="{{ $comment->id }}">
                                                            <div class="mb-2">
                                                                <textarea class="form-control" name="comment" rows="2" placeholder="Nhập câu trả lời..."></textarea>
                                                            </div>
                                                            <button class="btn btn-primary btn-sm">Gửi</button>
                                                            <button type="button"
                                                                class="btn btn-secondary btn-sm cancel-btn">Hủy</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif

                                    </div>

                                    <!-- Comment Form -->
                                    @if (Auth::check())
                                        <div class="shop-comment-form">
                                            <form action="{{ route('comments') }}" method="post">
                                                @csrf
                                                <h2 class="reviews__comment--reply__title mb-15">Thêm Bình Luận </h2>

                                                <div class="row">
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                                        <textarea class="form-control" style="height: 200px;" name="comment" placeholder="Nhập câu trả lời..."></textarea>

                                                    </div>

                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                                    <button class="btn btn-primary p-3">
                                                        Gửi
                                                    </button>

                                                </div>
                                            </form>
                                        </div>
                                    @endif


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
        document.addEventListener("DOMContentLoaded", function() {
            // Lấy tất cả các nút trả lời
            const replyButtons = document.querySelectorAll(".reply-btn");

            // Lặp qua từng nút và thêm sự kiện click
            replyButtons.forEach(button => {
                button.addEventListener("click", function() {
                    // Lấy ID của comment
                    const commentId = this.getAttribute("data-id");
                    // Tìm form trả lời tương ứng với comment
                    const replyForm = document.getElementById(`reply-form-${commentId}`);
                    // Toggle lớp d-none để hiện/ẩn form trả lời
                    replyForm.classList.toggle("d-none");
                });
            });

            // Hủy form trả lời khi nhấn nút Hủy
            const cancelButtons = document.querySelectorAll(".cancel-btn");
            cancelButtons.forEach(button => {
                button.addEventListener("click", function() {
                    const replyForm = this.closest(".reply-form");
                    replyForm.classList.add("d-none");
                });
            });
        });
    </script>
@endsection
