<div class="col-xl-3 col-lg-4">
    <div class="shop__sidebar--widget widget__area d-md-none">
        <div class="single__widget widget__bg">
            <h2 class="widget__title position__relative h3">Search</h2>
            <form class="widget__search--form" action="{{route('shop.search')}}" method="GET">
                <label>
                    <input class="widget__search--form__input border-0" placeholder="Search by" name="search" type="text" required>
                </label>
                <button class="widget__search--form__btn"  type="submit">
                    Search 
                </button>
            </form>   
        </div>
        <div class="single__widget widget__bg">
            <h2 class="widget__title position__relative h3">Categories</h2>
            <ul class="widget__categories--menu">
                @foreach ($categories as $category)
                <li class="widget__categories--menu__list">
                   
                    <label class="widget__categories--menu__label d-flex align-items-center">
                        {{-- <img class="widget__categories--menu__img" src="assets/img/product/small-product1.webp" alt="categories-img"> --}}
                        <span class="widget__categories--menu__text">{{$category->name}}</span>
                        <svg class="widget__categories--menu__arrowdown--icon" xmlns="http://www.w3.org/2000/svg" width="12.355" height="8.394">
                            <path  d="M15.138,8.59l-3.961,3.952L7.217,8.59,6,9.807l5.178,5.178,5.178-5.178Z" transform="translate(-6 -8.59)" fill="currentColor"></path>
                        </svg>
                    </label>
                    
                    @if ($category->children->isNotEmpty())
                    <ul class="widget__categories--sub__menu">
                       @foreach ($category->children as $child)
                           
                       @endforeach
                        <li class="widget__categories--sub__menu--list">
                            <a class="widget__categories--sub__menu--link d-flex align-items-center" href="{{route('shop.categoryProduct',$child->id)}}">
                                {{-- <img class="widget__categories--sub__menu--img" src="assets/img/product/small-product2.webp" alt="categories-img"> --}}
                                <span class="widget__categories--sub__menu--text">{{$child->name}}</span>
                            </a>
                        </li>
                        
                        
                        {{-- <li class="widget__categories--sub__menu--list">
                            <a class="widget__categories--sub__menu--link d-flex align-items-center" href="shop.html">
                                <img class="widget__categories--sub__menu--img" src="assets/img/product/small-product3.webp" alt="categories-img">
                                <span class="widget__categories--sub__menu--text">Woolend Jacket</span>
                            </a>
                        </li>
                        <li class="widget__categories--sub__menu--list">
                            <a class="widget__categories--sub__menu--link d-flex align-items-center" href="shop.html">
                                <img class="widget__categories--sub__menu--img" src="assets/img/product/small-product4.webp" alt="categories-img">
                                <span class="widget__categories--sub__menu--text">Western denim</span>
                            </a>
                        </li>
                        <li class="widget__categories--sub__menu--list">
                            <a class="widget__categories--sub__menu--link d-flex align-items-center" href="shop.html">
                                <img class="widget__categories--sub__menu--img" src="assets/img/product/small-product5.webp" alt="categories-img">
                                <span class="widget__categories--sub__menu--text">Mini Dresss</span>
                            </a>
                        </li> --}}
                    </ul>
                    @endif
                  
                </li>
                @endforeach
                {{-- <li class="widget__categories--menu__list">
                    <label class="widget__categories--menu__label d-flex align-items-center">
                        <img class="widget__categories--menu__img" src="assets/img/product/small-product2.webp" alt="categories-img">
                        <span class="widget__categories--menu__text">Oversize Cotton</span>
                        <svg class="widget__categories--menu__arrowdown--icon" xmlns="http://www.w3.org/2000/svg" width="12.355" height="8.394" >
                            <path  d="M15.138,8.59l-3.961,3.952L7.217,8.59,6,9.807l5.178,5.178,5.178-5.178Z" transform="translate(-6 -8.59)" fill="currentColor"></path>
                        </svg>
                    </label>
                    <ul class="widget__categories--sub__menu">
                        <li class="widget__categories--sub__menu--list">
                            <a class="widget__categories--sub__menu--link d-flex align-items-center" href="shop.html">
                                <img class="widget__categories--sub__menu--img" src="assets/img/product/small-product2.webp" alt="categories-img">
                                <span class="widget__categories--sub__menu--text">Jacket, Women</span>
                            </a>
                        </li>
                        <li class="widget__categories--sub__menu--list">
                            <a class="widget__categories--sub__menu--link d-flex align-items-center" href="shop.html">
                                <img class="widget__categories--sub__menu--img" src="assets/img/product/small-product3.webp" alt="categories-img">
                                <span class="widget__categories--sub__menu--text">Woolend Jacket</span>
                            </a>
                        </li>
                        <li class="widget__categories--sub__menu--list">
                            <a class="widget__categories--sub__menu--link d-flex align-items-center" href="shop.html">
                                <img class="widget__categories--sub__menu--img" src="assets/img/product/small-product4.webp" alt="categories-img">
                                <span class="widget__categories--sub__menu--text">Western denim</span>
                            </a>
                        </li>
                        <li class="widget__categories--sub__menu--list">
                            <a class="widget__categories--sub__menu--link d-flex align-items-center" href="shop.html">
                                <img class="widget__categories--sub__menu--img" src="assets/img/product/small-product5.webp" alt="categories-img">
                                <span class="widget__categories--sub__menu--text">Mini Dresss</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="widget__categories--menu__list">
                    <label class="widget__categories--menu__label d-flex align-items-center">
                        <img class="widget__categories--menu__img" src="assets/img/product/small-product3.webp" alt="categories-img">
                        <span class="widget__categories--menu__text">Dairy & chesse</span>
                        <svg class="widget__categories--menu__arrowdown--icon" xmlns="http://www.w3.org/2000/svg" width="12.355" height="8.394">
                            <path  d="M15.138,8.59l-3.961,3.952L7.217,8.59,6,9.807l5.178,5.178,5.178-5.178Z" transform="translate(-6 -8.59)" fill="currentColor"></path>
                        </svg>
                    </label>
                    <ul class="widget__categories--sub__menu">
                        <li class="widget__categories--sub__menu--list">
                            <a class="widget__categories--sub__menu--link d-flex align-items-center" href="shop.html">
                                <img class="widget__categories--sub__menu--img" src="assets/img/product/small-product2.webp" alt="categories-img">
                                <span class="widget__categories--sub__menu--text">Jacket, Women</span>
                            </a>
                        </li>
                        <li class="widget__categories--sub__menu--list">
                            <a class="widget__categories--sub__menu--link d-flex align-items-center" href="shop.html">
                                <img class="widget__categories--sub__menu--img" src="assets/img/product/small-product3.webp" alt="categories-img">
                                <span class="widget__categories--sub__menu--text">Woolend Jacket</span>
                            </a>
                        </li>
                        <li class="widget__categories--sub__menu--list">
                            <a class="widget__categories--sub__menu--link d-flex align-items-center" href="shop.html">
                                <img class="widget__categories--sub__menu--img" src="assets/img/product/small-product4.webp" alt="categories-img">
                                <span class="widget__categories--sub__menu--text">Western denim</span>
                            </a>
                        </li>
                        <li class="widget__categories--sub__menu--list">
                            <a class="widget__categories--sub__menu--link d-flex align-items-center" href="shop.html">
                                <img class="widget__categories--sub__menu--img" src="assets/img/product/small-product5.webp" alt="categories-img">
                                <span class="widget__categories--sub__menu--text">Mini Dresss</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="widget__categories--menu__list">
                    <label class="widget__categories--menu__label d-flex align-items-center">
                        <img class="widget__categories--menu__img" src="assets/img/product/small-product4.webp" alt="categories-img">
                        <span class="widget__categories--menu__text">Shoulder Bag</span>
                        <svg class="widget__categories--menu__arrowdown--icon" xmlns="http://www.w3.org/2000/svg" width="12.355" height="8.394">
                            <path  d="M15.138,8.59l-3.961,3.952L7.217,8.59,6,9.807l5.178,5.178,5.178-5.178Z" transform="translate(-6 -8.59)" fill="currentColor"></path>
                        </svg>
                    </label>
                    <ul class="widget__categories--sub__menu">
                        <li class="widget__categories--sub__menu--list">
                            <a class="widget__categories--sub__menu--link d-flex align-items-center" href="shop.html">
                                <img class="widget__categories--sub__menu--img" src="assets/img/product/small-product2.webp" alt="categories-img">
                                <span class="widget__categories--sub__menu--text">Jacket, Women</span>
                            </a>
                        </li>
                        <li class="widget__categories--sub__menu--list">
                            <a class="widget__categories--sub__menu--link d-flex align-items-center" href="shop.html">
                                <img class="widget__categories--sub__menu--img" src="assets/img/product/small-product3.webp" alt="categories-img">
                                <span class="widget__categories--sub__menu--text">Woolend Jacket</span>
                            </a>
                        </li>
                        <li class="widget__categories--sub__menu--list">
                            <a class="widget__categories--sub__menu--link d-flex align-items-center" href="shop.html">
                                <img class="widget__categories--sub__menu--img" src="assets/img/product/small-product4.webp" alt="categories-img">
                                <span class="widget__categories--sub__menu--text">Western denim</span>
                            </a>
                        </li>
                        <li class="widget__categories--sub__menu--list">
                            <a class="widget__categories--sub__menu--link d-flex align-items-center" href="shop.html">
                                <img class="widget__categories--sub__menu--img" src="assets/img/product/small-product5.webp" alt="categories-img">
                                <span class="widget__categories--sub__menu--text">Mini Dresss</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="widget__categories--menu__list">
                    <label class="widget__categories--menu__label d-flex align-items-center">
                        <img class="widget__categories--menu__img" src="assets/img/product/small-product5.webp" alt="categories-img">
                        <span class="widget__categories--menu__text">Denim Jacket</span>
                        <svg class="widget__categories--menu__arrowdown--icon" xmlns="http://www.w3.org/2000/svg" width="12.355" height="8.394">
                            <path  d="M15.138,8.59l-3.961,3.952L7.217,8.59,6,9.807l5.178,5.178,5.178-5.178Z" transform="translate(-6 -8.59)" fill="currentColor"></path>
                        </svg>
                    </label>
                    <ul class="widget__categories--sub__menu">
                        <li class="widget__categories--sub__menu--list">
                            <a class="widget__categories--sub__menu--link d-flex align-items-center" href="shop.html">
                                <img class="widget__categories--sub__menu--img" src="assets/img/product/small-product2.webp" alt="categories-img">
                                <span class="widget__categories--sub__menu--text">Jacket, Women</span>
                            </a>
                        </li>
                        <li class="widget__categories--sub__menu--list">
                            <a class="widget__categories--sub__menu--link d-flex align-items-center" href="shop.html">
                                <img class="widget__categories--sub__menu--img" src="assets/img/product/small-product3.webp" alt="categories-img">
                                <span class="widget__categories--sub__menu--text">Woolend Jacket</span>
                            </a>
                        </li>
                        <li class="widget__categories--sub__menu--list">
                            <a class="widget__categories--sub__menu--link d-flex align-items-center" href="shop.html">
                                <img class="widget__categories--sub__menu--img" src="assets/img/product/small-product4.webp" alt="categories-img">
                                <span class="widget__categories--sub__menu--text">Western denim</span>
                            </a>
                        </li>
                        <li class="widget__categories--sub__menu--list">
                            <a class="widget__categories--sub__menu--link d-flex align-items-center" href="shop.html">
                                <img class="widget__categories--sub__menu--img" src="assets/img/product/small-product5.webp" alt="categories-img">
                                <span class="widget__categories--sub__menu--text">Mini Dresss</span>
                            </a>
                        </li>
                    </ul>
                </li> --}}
            </ul>
        </div>
        
        <div class="single__widget price__filter widget__bg">
            <h2 class="widget__title position__relative h3">Filter By Price</h2>
            <form class="price__filter--form" action="{{route('shop.filter')}}" method="GET"> 
                <div class="price__filter--form__inner mb-15 d-flex align-items-center">
                    <div class="price__filter--group">
                        <label class="price__filter--label" for="Filter-Price-GTE1">From</label>
                        <div class="price__filter--input border-radius-5 d-flex align-items-center">
                            <span class="price__filter--currency">$</span>
                            <input class="price__filter--input__field border-0" id="Filter-Price-GTE1" name="min_price" type="number" placeholder="0" min="0" max="500000">
                        </div>
                    </div>
                    <div class="price__divider">
                        <span>-</span>
                    </div>
                    <div class="price__filter--group">
                        <label class="price__filter--label" for="Filter-Price-LTE1">To</label>
                        <div class="price__filter--input border-radius-5 d-flex align-items-center">
                            <span class="price__filter--currency">$</span>
                            <input class="price__filter--input__field border-0" id="Filter-Price-LTE1" name="max_price" type="number" min="0" placeholder="500000" max="500000"> 
                        </div>	
                    </div>
                </div>
                <button class="price__filter--btn primary__btn" type="submit">Filter</button>
            </form>
        </div>
        {{-- <div class="single__widget widget__bg">
            <h2 class="widget__title position__relative h3">Dietary Needs</h2>
            <ul class="widget__form--check">
                <li class="widget__form--check__list">
                    <label class="widget__form--check__label" for="check1">Denim shirt</label>
                    <input class="widget__form--check__input" id="check1" type="checkbox">
                    <span class="widget__form--checkmark"></span>
                </li>
                <li class="widget__form--check__list">
                    <label class="widget__form--check__label" for="check2">Need Winter</label>
                    <input class="widget__form--check__input" id="check2" type="checkbox">
                    <span class="widget__form--checkmark"></span>
                </li>
                <li class="widget__form--check__list">
                    <label class="widget__form--check__label" for="check3">Fashion Trends</label>
                    <input class="widget__form--check__input" id="check3" type="checkbox">
                    <span class="widget__form--checkmark"></span>
                </li>
                <li class="widget__form--check__list">
                    <label class="widget__form--check__label" for="check4">Oversize Cotton</label>
                    <input class="widget__form--check__input" id="check4" type="checkbox">
                    <span class="widget__form--checkmark"></span>
                </li>
                <li class="widget__form--check__list">
                    <label class="widget__form--check__label" for="check5">Baking material</label>
                    <input class="widget__form--check__input" id="check5" type="checkbox">
                    <span class="widget__form--checkmark"></span>
                </li>
            </ul>
        </div> --}}
        <div class="single__widget widget__bg">
            <h2 class="widget__title position__relative h3">Top Rated Product</h2>
            
            <div class="product__grid--inner">
                @foreach ($productnew as $product)
                <div class="product__items product__items--grid d-flex align-items-center">
                    <div class="product__items--grid__thumbnail position__relative">
                        <a class="product__items--link" href="product-details.html">
                            <img class="product__items--img product__primary--img" src="{{Storage::url($product->img_thumbnail)}}" alt="product-img">
                            <img class="product__items--img product__secondary--img" src="{{Storage::url($product->img_thumbnail)}}" alt="product-img">
                        </a>
                    </div>
                    <div class="product__items--grid__content">
                        <h3 class="product__items--content__title h4"><a href="product-details.html">{{$product->name}}</a></h3>
                        <div class="product__items--price">
                            <span class="current__price">{{$product->base_price}}</span>
                        </div>
                        <div class="product__items--color">
                            <ul class="product__items--color__wrapper d-flex">
                                <li class="product__items--color__list"><a class="product__items--color__link one" href="javascript:void(0)"><span class="visually-hidden">Color 1</span></a></li>
                                <li class="product__items--color__list"><a class="product__items--color__link two" href="javascript:void(0)"><span class="visually-hidden">Color 2</span></a></li>
                                <li class="product__items--color__list"><a class="product__items--color__link three" href="javascript:void(0)"><span class="visually-hidden">Color 3</span></a></li>
                                <li class="product__items--color__list"><a class="product__items--color__link four" href="javascript:void(0)"><span class="visually-hidden">Color 4</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach
              
                {{-- <div class="product__items product__items--grid d-flex align-items-center">
                    <div class="product__items--grid__thumbnail position__relative">
                        <a class="product__items--link" href="product-details.html">
                            <img class="product__items--img product__primary--img" src="assets/img/product/small-product3.webp" alt="product-img">
                            <img class="product__items--img product__secondary--img" src="assets/img/product/small-product4.webp" alt="product-img">
                        </a>
                    </div>
                    <div class="product__items--grid__content">
                        <h3 class="product__items--content__title h4"><a href="product-details.html">Plastic Chair</a></h3>
                        <div class="product__items--price">
                            <span class="current__price">$165.00</span>
                        </div>
                        <div class="product__items--color">
                            <ul class="product__items--color__wrapper d-flex">
                                <li class="product__items--color__list"><a class="product__items--color__link one" href="javascript:void(0)"><span class="visually-hidden">Color 1</span></a></li>
                                <li class="product__items--color__list"><a class="product__items--color__link two" href="javascript:void(0)"><span class="visually-hidden">Color 2</span></a></li>
                                <li class="product__items--color__list"><a class="product__items--color__link three" href="javascript:void(0)"><span class="visually-hidden">Color 3</span></a></li>
                                <li class="product__items--color__list"><a class="product__items--color__link four" href="javascript:void(0)"><span class="visually-hidden">Color 4</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="product__items product__items--grid d-flex align-items-center">
                    <div class="product__items--grid__thumbnail position__relative">
                        <a class="product__items--link" href="product-details.html">
                            <img class="product__items--img product__primary--img" src="assets/img/product/small-product5.webp" alt="product-img">
                            <img class="product__items--img product__secondary--img" src="assets/img/product/small-product6.webp" alt="product-img">
                        </a>
                    </div>
                    <div class="product__items--grid__content">
                        <h3 class="product__items--content__title h4"><a href="product-details.html">Design Rooms</a></h3>
                        <div class="product__items--price">
                            <span class="current__price">$165.00</span>
                        </div>
                        <div class="product__items--color">
                            <ul class="product__items--color__wrapper d-flex">
                                <li class="product__items--color__list"><a class="product__items--color__link one" href="javascript:void(0)"><span class="visually-hidden">Color 1</span></a></li>
                                <li class="product__items--color__list"><a class="product__items--color__link two" href="javascript:void(0)"><span class="visually-hidden">Color 2</span></a></li>
                                <li class="product__items--color__list"><a class="product__items--color__link three" href="javascript:void(0)"><span class="visually-hidden">Color 3</span></a></li>
                                <li class="product__items--color__list"><a class="product__items--color__link four" href="javascript:void(0)"><span class="visually-hidden">Color 4</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
        {{-- <div class="single__widget widget__bg">
            <h2 class="widget__title position__relative h3">Brands</h2>
            <ul class="widget__tagcloud">
                <li class="widget__tagcloud--list"><a class="widget__tagcloud--link" href="shop.html">Wooden</a></li>
                <li class="widget__tagcloud--list"><a class="widget__tagcloud--link" href="shop.html">Chair</a></li>
                <li class="widget__tagcloud--list"><a class="widget__tagcloud--link" href="shop.html">Modern</a></li>
                <li class="widget__tagcloud--list"><a class="widget__tagcloud--link" href="shop.html">Fabric  </a></li>
                <li class="widget__tagcloud--list"><a class="widget__tagcloud--link" href="shop.html">Shoulder </a></li>
                <li class="widget__tagcloud--list"><a class="widget__tagcloud--link" href="shop.html">Winter</a></li>
                <li class="widget__tagcloud--list"><a class="widget__tagcloud--link" href="shop.html">Accessories</a></li>
                <li class="widget__tagcloud--list"><a class="widget__tagcloud--link" href="shop.html">Dress </a></li>
            </ul>
        </div> --}}
    </div>
</div>

