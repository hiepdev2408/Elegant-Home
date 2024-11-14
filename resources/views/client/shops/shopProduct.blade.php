@extends('client.layouts.master')
@section('title')
    Shop
@endsection
@section('content')
<section class="page-title">
    <div class="auto-container">
        <h2>Shop Page</h2>
        <ul class="bread-crumb clearfix">
            <li><a href="index.html">Home</a></li>
            <li>Pages</li>
            <li>Shop Page</li>
        </ul>
    </div>
</section>
<div class="sidebar-page-container">
    <div class="auto-container">
        <div class="row clearfix">
            
            <!-- Content Side -->
            <div class="content-side col-lg-9 col-md-12 col-sm-12">
                <!-- Filter Box -->
                <div class="filter-box">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <!-- Left Box -->
                        <div class="left-box d-flex align-items-center">
                            <div class="results">Showing 1–12 of 54 results</div>
                        </div>
                        <!-- Right Box -->
                        <div class="right-box d-flex">
                            <div class="form-group">
                                <select name="currency" class="custom-select-box">
                                    <option>Recently Added</option>
                                    <option>Added 01</option>
                                    <option>Added 02</option>
                                    <option>Added 03</option>
                                    <option>Added 04</option>
                                </select>
                            </div>
                            <ul class="pages-list">
                                <li><a class="flaticon-list" href="#"></a></li>
                                <li><a class="flaticon-menu-2" href="#"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- End Filter Box -->
                
                <div class="shops-outer">
                    <div class="row clearfix">
                        @foreach ($products as $product)
                        <div class="shop-item col-lg-4 col-md-4 col-sm-12">
                            <div class="inner-box">
                                <div class="image">
                                    <a href="{{ route('productDetail', ['slug' => $product->slug]) }}"><img src="{{ Storage::url($product->img_thumbnail) }}" alt="" /></a>
                                    <div class="options-box">
                                        <ul class="option-list">
                                            <li><a class="flaticon-resize" href="shop-detail.html"></a></li>
                                            <li><a class="flaticon-heart" href="shop-detail.html"></a></li>
                                            <li><a class="flaticon-shopping-cart-2" href="{{ route('productDetail', ['slug' => $product->slug]) }}"></a></li>
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
                                    <h6><a href="{{ route('productDetail', ['slug' => $product->slug]) }}">{{$product->name}}</a></h6>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="price"><span>{{ number_format($product->base_price, 0, ',', '.')}}VNĐ</span>{{ number_format($product->price_sale, 0, ',', '.')}}VNĐ</div>
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
                        @endforeach
                        <!-- Shop Item -->
                        
                        
                        
                        
                      
                        
                    </div>
                
                    <!-- Styled Pagination -->
                    <div class="styled-pagination text-center">
                        <ul>
                            @if ($products->onFirstPage())
                                <li class="next disabled"><span class="fa fa-angle-double-left"></span></li>
                            @else
                                <li class="next"><a href="{{ $products->previousPageUrl() }}"><span class="fa fa-angle-double-left"></span></a></li>
                            @endif
                    
                            @for ($i = 1; $i <= $products->lastPage(); $i++)
                                @if ($i == $products->currentPage())
                                    <li><a href="#" class="active">{{ $i }}</a></li>
                                @else
                                    <li><a href="{{ $products->url($i) }}">{{ $i }}</a></li>
                                @endif
                            @endfor
                    
                            @if ($products->hasMorePages())
                                <li class="next"><a href="{{ $products->nextPageUrl() }}"><span class="fa fa-angle-double-right"></span></a></li>
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
    <button id="scroll__top"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48"
                d="M112 244l144-144 144 144M256 120v292" />
        </svg></button>
    <script src="{{ asset('themes/client/assets/js/plugins/swiper-bundle.min.js') }}" defer="defer"></script>
    <script src="{{ asset('themes/client/assets/js/plugins/glightbox.min.js') }}" defer="defer"></script>

    <!-- Customscript js -->
    <script src="{{ asset('themes/client/assets/js/script.js') }}" defer="defer"></script>
@endsection
