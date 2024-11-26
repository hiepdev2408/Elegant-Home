@extends('client.layouts.master')
@section('title')
    Products
@endsection
@section('content')
    <div class="sidebar-page-container">
        <div class="auto-container">
            <div class="row clearfix">
                <!-- Content Side -->
                <div class="content-side col-lg-9 col-md-12 col-sm-12">
                    <div class="shops-outer">
                        <div class="row clearfix">
                            @foreach ($products as $product)
                                <div class="shop-item col-lg-4 col-md-4 col-sm-12">
                                    <div class="inner-box">
                                        <div class="image">
                                            <a href="{{ route('productDetail', ['slug' => $product->slug]) }}"><img
                                                    src="{{ Storage::url($product->img_thumbnail) }}" alt="" /></a>
                                            <div class="options-box">
                                                <ul class="option-list">
                                                    <li><a class="flaticon-resize" href="shop-detail.html"></a></li>
                                                    <li><a class="flaticon-heart" href="shop-detail.html"></a></li>
                                                    <li><a class="flaticon-shopping-cart-2"
                                                            href="{{ route('productDetail', ['slug' => $product->slug]) }}"></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="lower-content">
                                            <div class="rating">
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="light fa fa-star"></span>
                                            </div>
                                            <h6><a
                                                    href="{{ route('productDetail', ['slug' => $product->slug]) }}">{{ $product->name }}</a>
                                            </h6>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="price">
                                                    <span>{{ number_format($product->base_price, 0, ',', '.') }}VNĐ</span>{{ number_format($product->price_sale, 0, ',', '.') }}VNĐ
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <!-- Shop Item -->
                        </div>
                        <!-- Styled Pagination -->
                        <div class="styled-pagination text-center">
                            <ul>
                                @if ($products->onFirstPage())
                                    <li class="next disabled"><span class="fa fa-angle-double-left"></span></li>
                                @else
                                    <li class="next"><a href="{{ $products->previousPageUrl() }}"><span
                                                class="fa fa-angle-double-left"></span></a></li>
                                @endif

                                @for ($i = 1; $i <= $products->lastPage(); $i++)
                                    @if ($i == $products->currentPage())
                                        <li><a href="#" class="active">{{ $i }}</a></li>
                                    @else
                                        <li><a href="{{ $products->url($i) }}">{{ $i }}</a></li>
                                    @endif
                                @endfor

                                @if ($products->hasMorePages())
                                    <li class="next"><a href="{{ $products->nextPageUrl() }}"><span
                                                class="fa fa-angle-double-right"></span></a></li>
                                @else
                                    <li class="next disabled"><span class="fa fa-angle-double-right"></span></li>
                                @endif
                            </ul>
                        </div>
                        <!-- End Styled Pagination -->
                    </div>
                </div>
                @include('client.shops.partials.sideBarfilter')
            </div>
        </div>
    </div>
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
    <script src="{{ asset('themes/client/assets/js/plugins/swiper-bundle.min.js') }}" defer="defer"></script>
    <script src="{{ asset('themes/client/assets/js/plugins/glightbox.min.js') }}" defer="defer"></script>

    <!-- Customscript js -->
    <script src="{{ asset('themes/client/assets/js/script.js') }}" defer="defer"></script>
@endsection
