@extends('client.layouts.master')
@section('title')
{{ $product->name }}
@endsection
@section('content')
<div class="page-wrapper">
    <section class="shop-detail-section">
        <div class="auto-container">
            <form action="{{ route('addToCart') }}" method="post">
                @csrf
                <div class="row clearfix">
                    <div class="gallery-column col-lg-6 col-md-12 col-sm-12">
                        <div class="inner-column">
                            <div class="carousel-outer">
                                <div class="swiper-container content-carousel">
                                    <img src="{{ Storage::url($product->img_thumbnail) }}" alt="">
                                </div>
                                <div class="swiper-container thumbs-carousel">
                                    <div class="swiper-wrapper">
                                        @foreach ($product->galleries as $gallery)
                                        @if ($gallery->img_path)
                                        <div class="swiper-slide mb-5">
                                            <figure class="thumb">
                                                <img src="{{ Storage::url($gallery->img_path) }}"
                                                    style="height: 100px" alt="Thumbnail sản phẩm">
                                            </figure>
                                        </div>
                                        @endif
                                        @endforeach

                                    </div>
                                    <div class="swiper-container thumbs-carousel">
                                        <div class="swiper-wrapper">
                                            @foreach ($product->galleries as $gallery)
                                                @if ($gallery->img_path)
                                                    <div class="swiper-slide mb-5">
                                                        <figure class="thumb">
                                                            <img src="{{ Storage::url($gallery->img_path) }}"
                                                                style="height: 100px" alt="Thumbnail sản phẩm">
                                                        </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-column col-lg-6 col-md-12 col-sm-12">
                        <div class="inner-column">
                            <h3>{{ $product->name }}</h3>
                            <div class="rating">
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="light fa fa-star"></span>
                                <i>(4 customer review)</i>
                            </div>
                            <!-- Price -->
                            <div class="price">
                                <span class="old-price">{{ number_format($product->base_price, 0, ',', '.') }} VNĐ</span>
                                @if(isset($finalPrice) && $finalPrice > 0)
                                <span class="new-price">{{ number_format($finalPrice, 0, ',', '.') }} VNĐ</span>
                                @else
                                <span class="new-price">{{ number_format($product->price_sale, 0, ',', '.') }} VNĐ</span>

                                @endif
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
                                                @foreach ($values as $value)
                                                <option value="{{ $value['id'] }}">
                                                    {{ Str::limit($value['name'], 30) }}
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
                                    <input type="hidden" name="total_amount" value="{{ isset($finalPrice) ? $finalPrice : $product->price_sale }}">
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
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="content-column col-lg-6 col-md-12 col-sm-12">
                            <div class="inner-column">
                                <h3>{{ $product->name }}</h3>
                                <div class="rating">
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="light fa fa-star"></span>
                                    <i>(4 customer review)</i>
                                </div>
                                @if ($product->price_sale != '')
                                    <div class="price">
                                        <span class="old-price">{{ number_format($product->base_price, 0, ',', '.') }}
                                            VNĐ</span>
                                        @if (isset($finalPrice) && $finalPrice > 0)
                                            <span class="new-price">{{ number_format($finalPrice, 0, ',', '.') }} VNĐ</span>
                                        @else
                                            {{ number_format($product->price_sale, 0, ',', '.') }} VNĐ
                                        @endif
                                    </div>
                                @else
                                    <div class="price">
                                        <span class="new-price">{{ number_format($product->base_price, 0, ',', '.') }}
                                            VNĐ</span>
                                        @if (isset($finalPrice) && $finalPrice > 0)
                                            {{ number_format($finalPrice, 0, ',', '.') }} VNĐ
                                        @endif
                                    </div>
                                @endif
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
                                                        @foreach ($values as $value)
                                                            <option value="{{ $value['id'] }}">
                                                                {{ Str::limit($value['name'], 30) }}
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
                                        <input type="hidden" name="total_amount"
                                            value="{{ isset($finalPrice) ? $finalPrice : $product->price_sale }}">
                                        <button type="submit" class="theme-btn btn-style-one">
                                            Add to cart
                                        </button>
                                    </div>
                                    <!-- Quantity Box -->
                                    <div class="quantity-box d-flex align-items-center"
                                        style="gap: 0.5rem; padding: 0.5rem; border: 1px solid #ccc; border-radius: 8px; background-color: #f9f9f9;">
                                        <label for="quantity" style="font-size: 1rem; font-weight: 500;">Quantity:</label>
                                        <input type="number" id="quantity" name="quantity" min="1" value="1"
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
                                                                <button class="btn btn-sm btn-outline-primary reply-btn"
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
                                                                            class="rounded-circle me-3" alt="User Avatar"
                                                                            width="50">
                                                                    @else
                                                                        <img src="{{ asset('themes/image/logo.jpg') }}"
                                                                            class="rounded-circle me-3" alt="User Avatar"
                                                                            width="50">
                                                                    @endif
                                                                    {{ $reply->user->name }}
                                                                </h5>
                                                                <small
                                                                    class="text-muted">{{ $reply->created_at->diffForHumans() }}</small>
                                                                <p class="mt-2">{{ $reply->comment }}</p>
                                                                @if (Auth::check())
                                                                    <button
                                                                        class="btn btn-sm btn-outline-primary reply-btn"
                                                                        type="button" data-id="{{ $comment->id }}">Trả
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
                                                    <form action="{{ route('comments', $comment->id) }}" method="POST">
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

                                        <!-- Khu vực nhập bình luận trả lời -->
                                        <div class="card-body ps-5 d-none reply-form" id="reply-form-{{ $comment->id }}">
                                            <form action="{{ route('comments', $comment->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                                <div class="mb-2">
                                                    <textarea class="form-control" name="comment" rows="2" placeholder="Nhập câu trả lời..."></textarea>
                                                </div>
                                                <button class="btn btn-primary btn-sm">Gửi</button>
                                                <button type="button" class="btn btn-secondary btn-sm cancel-btn">Hủy</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                            </div>

                            <!-- Form gửi bình luận mới -->
                            @if (Auth::check())
                            <div class="shop-comment-form">
                                <form action="{{ route('comments') }}" method="post">
                                    @csrf
                                    <h2 class="reviews__comment--reply__title mb-15">Thêm Bình Luận</h2>
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <textarea class="form-control" style="height: 200px;" name="comment" placeholder="Nhập bình luận..."></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <button class="btn btn-primary p-3">Gửi</button>
                                    </div>
                                </form>
                            </div>
                            @endif
                        </div>
                        <!-- Tab -->
                        <div class="tab" id="prod-faq">
                            <div class="container">
                                <div class="product-detail">
                                    <h1 class="display-4">{{ $product->name }}</h1>
                                    <p class="lead">{{ $product->description }}</p>

                                    <h3 class="mt-4">Gửi Đánh Giá</h3>
                                    <form action="{{ route('review.store') }}" method="POST" class="review-form">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <div class="form-group">
                                            <label for="rating">Đánh giá:</label>
                                            <div class="star-rating">
                                                @for ($i = 5; $i >= 1; $i--)
                                                <input class="form-check-input" type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" required style="display: none;">
                                                <label class="form-check-label" for="star{{ $i }}" style="font-size: 2rem; cursor: pointer;">★</label>
                                                @endfor
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="comment">Nhận xét:</label>
                                            <textarea name="comment" id="comment" class="form-control" maxlength="255" placeholder="Chia sẻ ý kiến của bạn..."></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Gửi</button>
                                    </form>

                                    <style>
                                        .star-rating {
                                            direction: rtl;
                                            /* Ngôi sao sẽ được chọn từ phải sang trái */
                                        }

                                        .star-rating input:checked~label {
                                            color: #f39c12;
                                            /* Màu ngôi sao đã chọn */
                                        }

                                        .star-rating label {
                                            color: #ccc;
                                            /* Màu ngôi sao chưa chọn */
                                            transition: color 0.2s;
                                            /* Hiệu ứng chuyển màu */
                                        }

                                        .star-rating label:hover,
                                        .star-rating label:hover~label {
                                            color: #f39c12;
                                            /* Màu ngôi sao khi hover */
                                        }
                                    </style>

                                    @if(session('success'))
                                    <div class="alert alert-success mt-3">{{ session('success') }}</div>
                                    @endif

                                    @if(session('error'))
                                    <div class="alert alert-danger mt-3">{{ session('error') }}</div>
                                    @endif

                                    <h3 class="mt-4">Đánh Giá Sản Phẩm</h3>
                                    @if($product->reviews && $product->reviews->isNotEmpty())
                                    @foreach ($product->reviews as $review)
                                    <div class="review card mb-3 p-3">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ Storage::url($review->user->avatar)}}" alt="{{ $review->user->name }}" class="rounded-circle" style="width: 50px; height: 50px; margin-right: 10px;">
                                            <div class="flex-grow-1">
                                                <div class="d-flex justify-content-between">
                                                    <strong class="h5">{{ $review->user->name }}</strong>
                                                    <span class="rating">
                                                        <span class="text-warning" style="font-size: 1.5rem;">
                                                            {{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}
                                                        </span>
                                                    </span>
                                                </div>
                                                <p>{{ $review->comment }}</p>
                                                <small class="text-muted">{{ $review->created_at->format('d/m/Y H:i') }}</small>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @else
                                    <p class="text-muted">Chưa có đánh giá nào.</p>
                                    @endif
                                </div>
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
                            <a href="shop-detail.html"><img src="images/resource/products/25.png" alt="" /></a>
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
                                    <div class="select-box"><input type="radio" name="payment-group" id="radio-one"
                                            checked><label for="radio-one">32</label></div>
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
                            <a href="shop-detail.html"><img src="images/resource/products/26.png" alt="" /></a>
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
                                    <div class="select-box"><input type="radio" name="payment-group" id="radio-four"
                                            checked><label for="radio-four">32</label></div>
                                    <div class="select-box not-available"><label for="radio-five">34</label></div>
                                    <div class="select-box"><input type="radio" name="payment-group"
                                            id="radio-six"><label for="radio-six">36</label></div>
                                </div>
                                <!-- Select Size -->
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
        </div>
    </section>
    <!-- End Gallery Section -->


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
@section('style-libs')
<style>
    .new-price {
        text-decoration: line-through;
        /* Gạch ngang cho giá cũ */
        color: rgb(255, 0, 0);
        /* Màu đỏ cho giá mới */
        font-weight: bold;
        /* Đậm */
        font-size: 1.2em;
    }

    .new-price {
        text-decoration: none !important;
        /* Ghi đè gạch ngang */
        color: rgb(255, 0, 0);
        /* Màu đỏ cho giá mới */
        font-weight: bold;
        /* Đậm */
        font-size: 1.2em;
        /* Kích thước lớn hơn (có thể điều chỉnh) */
    }

    .sale-price {
        color: red;
        /* Màu đỏ cho giá sale */
        font-weight: bold;
        /* In đậm giá sale */
    }

    .regular-price {
        color: green;
        /* Màu xanh cho giá hiện tại nếu không có giá sale */
    }
</style>
    <style>
        .new-price {
            text-decoration: line-through;
            /* Gạch ngang cho giá cũ */
            color: rgb(255, 0, 0);
            /* Màu đỏ cho giá mới */
            font-weight: bold;
            /* Đậm */
            font-size: 1.2em;
        }
    text-decoration: line-through; /* Gạch ngang cho giá cũ */
    color: rgb(255, 0, 0); /* Màu đỏ cho giá mới */
    font-weight: bold; /* Đậm */
    font-size: 1.2em;
}
.new-price {
    text-decoration: none !important; /* Ghi đè gạch ngang */
    color: rgb(255, 0, 0); /* Màu đỏ cho giá mới */
    font-weight: bold; /* Đậm */
    font-size: 1.2em; /* Kích thước lớn hơn (có thể điều chỉnh) */
}
.sale-price {
    color: red; /* Màu đỏ cho giá sale */
    font-weight: bold; /* In đậm giá sale */
}


        .new-price {
            text-decoration: none !important;
            /* Ghi đè gạch ngang */
            color: rgb(255, 0, 0);
            /* Màu đỏ cho giá mới */
            font-weight: bold;
            /* Đậm */
            font-size: 1.2em;
            /* Kích thước lớn hơn (có thể điều chỉnh) */
        }

        .sale-price {
            color: red;
            /* Màu đỏ cho giá sale */
            font-weight: bold;
            /* In đậm giá sale */
        }

        .regular-price {
            color: green;
            /* Màu xanh cho giá hiện tại nếu không có giá sale */
        }
    </style>
@endsection
@section('script-libs')
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
@section('style')
<style>
    .swiper-container {
        width: 100%;
        /* Đảm bảo container chiếm đầy đủ chiều rộng */
        overflow: hidden;
    }

    .swiper-wrapper {
        display: flex;
        flex-wrap: wrap;
        /* Cho phép các phần tử nằm trong dòng mới nếu không đủ không gian */
        gap: 10px;
        /* Tạo khoảng cách giữa các ảnh */
        justify-content: center;
        /* Căn giữa các ảnh */
    }

    .swiper-slide {
        flex: 0 1 calc(25% - 10px);
        /* 4 ảnh mỗi dòng (25% mỗi ảnh trừ khoảng cách) */
        box-sizing: border-box;
    }

    .swiper-slide img {
        width: 100%;
        /* Đảm bảo ảnh vừa khung */
        height: auto;
        object-fit: cover;
        border-radius: 5px;
    }
</style>
@endsection
