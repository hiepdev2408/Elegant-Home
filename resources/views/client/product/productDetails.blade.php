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
                                        <span
                                            class="old-price new-price">{{ number_format($product->base_price, 0, ',', '.') }}
                                            VNĐ</span>
                                        @if (isset($finalPrice) && $finalPrice > 0)
                                            {{ number_format($finalPrice, 0, ',', '.') }} VNĐ
                                        @endif
                                    </div>
                                @endif
                                <div class="text">{{ $product->description }}</div>
                                {{-- <div class="d-flex flex-wrap">
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
                                <div class="quantity"><span>Số lượng: </span>
                                    @foreach ($product->variants as $variant)
                                        {{ $variant->stock }}
                                    @endforeach
                                </div> --}}

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
                                                            @php
                                                                // Lấy variant có thuộc tính tương ứng
                                                                $variant = $product->variants->firstWhere(function ($variant) use ($value) {
                                                                    return $variant->attributes->firstWhere('attributeValue.id', $value['id']);
                                                                });

                                                                $stock = $variant ? $variant->stock : 0;
                                                            @endphp

                                                            {{-- Gắn giá trị stock chính xác vào data-stock --}}
                                                            <option value="{{ $value['id'] }}" data-stock="{{ $stock }}">
                                                                {{ Str::limit($value['name'], 30) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="quantity mt-3">
                                    <span>Số lượng: </span>
                                    <span id="variant-stock">{{ $product->variants->first()->stock }}</span>
                                </div>
                                <div class="categories"><span>Danh mục :</span>
                                    @foreach ($product->categories as $category)
                                        {{ $category->name }}
                                    @endforeach
                                </div>
                                <div class="sku"><span>Mã sản phẩm :</span> {{ $product->sku }}</div>
                                <ul class="social-box">
                                    <li class="share">Share:</li>
                                    <li><a href="https://www.facebook.com/" class="fa fa-facebook-f"></a></li>
                                    <li><a href="https://www.twitter.com/" class="fa fa-twitter"></a></li>
                                    <li><a href="https://dribbble.com/" class="fa fa-dribbble"></a></li>
                                    <li><a href="https://www.linkedin.com/" class="fa fa-linkedin"></a></li>
                                </ul>
                                <div class="d-flex align-items-center flex-wrap">
                                    <div class="button-box">
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        @if ($product->price_sale)
                                            <input type="hidden" name="total_amount"
                                                value="{{ isset($finalPrice) ? $finalPrice : $product->price_sale }}">
                                        @elseif ($product->base_price)
                                            <input type="hidden" name="total_amount"
                                                value="{{ isset($finalPrice) ? $finalPrice : $product->base_price }}">
                                        @endif
                                        <button type="submit" class="theme-btn btn-style-one">
                                            Add to cart
                                        </button>
                                    </div>
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
            <div class="container">
                <div class="lower-box">
                    <div class="product-info-tabs">
                        <div class="prod-tabs tabs-box">
                            <ul class="tab-btns tab-buttons clearfix">
                                <li data-tab="#prod-details" class="tab-btn active-btn">Chi tiết sản phẩm</li>
                                <li data-tab="#prod-info" class="tab-btn">Thông tin bổ sung</li>
                                <li data-tab="#prod-review" class="tab-btn">Bình luận</li>
                            </ul>
                            <div class="tabs-content">

                                <div class="tab active-tab" id="prod-details">
                                    <div class="content">
                                        {!! $product->content !!}
                                    </div>
                                </div>
                                <div class="tab p-2" id="prod-review">
                                    <h1 class="">Bình luận</h1>
                                    <div class="comments-area p-3">
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
                                                                @if (Auth::check())
                                                                    <button
                                                                        class="btn btn-sm btn-outline-primary reply-btn"
                                                                        type="button" data-id="{{ $comment->id }}">Trả
                                                                        lời</button>
                                                                @endif

                                                            </div>

                                                        </div>

                                                    </div>
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
                </div>
            </div>
    </div>
    </section>

    <section class="products-section-six">
        <div class="auto-container">
            <div class="sec-title">
                <h4><span>Populer</span> Products For You !</h4>
            </div>
            <div class="row clearfix">
                @foreach ($otherCategoryProducts as $product)
                    <div class="shop-item-two col-lg-3 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <div class="image">
                                <a href="{{ route('productDetail', ['slug' => $product->slug]) }}"><img
                                        src="{{ storage::url($product->img_thumbnail) }}" alt="" /></a>
                                <div class="options-box">
                                    <ul class="option-list">
                                        <li><a class="flaticon-resize"
                                                href="{{ route('productDetail', ['slug' => $product->slug]) }}"></a></li>
                                        <li><a class="flaticon-heart"
                                                href="{{ route('productDetail', ['slug' => $product->slug]) }}"></a></li>
                                        <li><a class="flaticon-shopping-cart-2"
                                                href="{{ route('productDetail', ['slug' => $product->slug]) }}"></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="content">
                                <h6><a
                                        href="{{ route('productDetail', ['slug' => $product->slug]) }}">{{ $product->name }}</a>
                                </h6>
                                <div class="lower-box">
                                    <div class="price">
                                        @if (!is_null($product->price_sale))
                                            <span>{{ number_format($product->base_price, '0', '0', '.') }}VNĐ</span>
                                            {{ number_format($product->price_sale, '0', '0', '.') }}VNĐ
                                        @else
                                            {{ $product->base_price }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <section class="gallery-section">
        <div class="outer-container">
            <div class="instagram-carousel owl-carousel owl-theme">
                <div class="insta-gallery">
                    <img src="images/gallery/1.jpg" alt="" />
                    <div class="overlay-box">
                        <div class="overlay-inner">
                            <a class="lightbox-image icon flaticon-instagram" href="images/gallery/1.jpg"></a>
                        </div>
                    </div>
                </div>
                <div class="insta-gallery">
                    <img src="images/gallery/2.jpg" alt="" />
                    <div class="overlay-box">
                        <div class="overlay-inner">
                            <a class="lightbox-image icon flaticon-instagram" href="images/gallery/1.jpg"></a>
                        </div>
                    </div>
                </div>
                <div class="insta-gallery">
                    <img src="images/gallery/3.jpg" alt="" />
                    <div class="overlay-box">
                        <div class="overlay-inner">
                            <a class="lightbox-image icon flaticon-instagram" href="images/gallery/3.jpg"></a>
                        </div>
                    </div>
                </div>
                <div class="insta-gallery">
                    <img src="images/gallery/4.jpg" alt="" />
                    <div class="overlay-box">
                        <div class="overlay-inner">
                            <a class="lightbox-image icon flaticon-instagram" href="images/gallery/4.jpg"></a>
                        </div>
                    </div>
                </div>
                <div class="insta-gallery">
                    <img src="images/gallery/5.jpg" alt="" />
                    <div class="overlay-box">
                        <div class="overlay-inner">
                            <a class="lightbox-image icon flaticon-instagram" href="images/gallery/5.jpg"></a>
                        </div>
                    </div>
                </div>
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
    </div>
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
            color: rgb(255, 0, 0);
            font-weight: bold;
            font-size: 1.2em;
        }

        .new-price {
            text-decoration: none !important;
            color: rgb(255, 0, 0);
            font-weight: bold;
            font-size: 1.2em;
        }

        .sale-price {
            color: red;
            font-weight: bold;
        }

        .regular-price {
            color: green;
        }
    </style>
@endsection
@section('script-libs')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const replyButtons = document.querySelectorAll(".reply-btn");
            replyButtons.forEach(button => {
                button.addEventListener("click", function() {
                    const commentId = this.getAttribute("data-id");
                    const replyForm = document.getElementById(`reply-form-${commentId}`);
                    replyForm.classList.toggle("d-none");
                });
            });
            const cancelButtons = document.querySelectorAll(".cancel-btn");
            cancelButtons.forEach(button => {
                button.addEventListener("click", function() {
                    const replyForm = this.closest(".reply-form");
                    replyForm.classList.add("d-none");
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Lấy tất cả các dropdown attribute
            const attributeSelects = document.querySelectorAll('.attribute-select');

            // Lấy phần tử hiển thị số lượng
            const stockDisplay = document.getElementById('variant-stock');

            // Lắng nghe sự kiện thay đổi trên mỗi dropdown
            attributeSelects.forEach(select => {
                select.addEventListener('change', function() {
                    // Lấy stock từ option được chọn
                    const selectedOption = this.options[this.selectedIndex];
                    const stock = selectedOption.getAttribute('data-stock') || 0;

                    // Cập nhật số lượng hiển thị
                    stockDisplay.textContent = stock;
                });
            });
        });
    </script>
@endsection
@section('style')
    <style>
        .swiper-container {
            width: 100%;
            overflow: hidden;
        }

        .swiper-wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
        }

        .swiper-slide {
            flex: 0 1 calc(25% - 10px);
            box-sizing: border-box;
        }

        .swiper-slide img {
            width: 100%;
            height: auto;
            object-fit: cover;
            border-radius: 5px;
        }
    </style>
@endsection
