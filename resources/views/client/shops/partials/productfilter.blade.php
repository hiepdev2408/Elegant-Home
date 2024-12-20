<div class="row clearfix">
    @foreach ($products as $product)
        <div class="shop-item col-lg-4 col-md-4 col-sm-12">
            <div class="inner-box">
                <div class="image">
                    <a href="{{ route('productDetail', ['slug' => $product->slug]) }}">
                        <img src="{{ Storage::url($product->img_thumbnail) }}" alt="" />
                    </a>
                </div>
                <div class="lower-content">
                    <h6>
                        <a href="{{ route('productDetail', ['slug' => $product->slug]) }}">{{ Str::limit($product->name, 30) }}</a>
                    </h6>
                    <div class="price">
                        @if ($product->price_sale == '')
                            <span class="new-price">{{ number_format($product->base_price ?? 0, 0, ',', '.') }} VNĐ</span>
                        @else
                            <span class="old-price">{{ number_format($product->base_price ?? 0, 0, ',', '.') }} VNĐ</span>
                            <span class="new-price">{{ number_format($product->price_sale ?? 0, 0, ',', '.') }} VNĐ</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- Phân Trang -->
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