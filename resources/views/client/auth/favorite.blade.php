@extends('client.layouts.master')
@section('content')
    <main class="main__content_wrapper">

        <!-- Start breadcrumb section -->
        <section class="breadcrumb__section breadcrumb__bg">
            <div class="container">
                <div class="row row-cols-1">
                    <div class="col">
                        <div class="breadcrumb__content">
                            <h1 class="breadcrumb__content--title text-white mb-10">Wishlist</h1>
                            <ul class="breadcrumb__content--menu d-flex">
                                <li class="breadcrumb__content--menu__items"><a class="text-white" href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb__content--menu__items"><span class="text-white">Wishlist</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End breadcrumb section -->

        <!-- cart section start -->
        </section>
        <section class="cart__section section--padding">
            <div class="container">
                <div class="cart__section--inner">
                    <form action="#">
                        <h2 class="cart__title mb-40">Danh sách yêu thích</h2>
                        <div class="cart__table">
                            <table class="cart__table--inner">
                                <thead class="cart__table--header">
                                    <tr class="cart__table--header__items">
                                        <th class="cart__table--header__list">Xóa </th>
                                        <th class="cart__table--header__list">STT</th>
                                        <th class="cart__table--header__list">Tên sản phẩm</th>
                                        <th class="cart__table--header__list">Giá cơ bản</th>
                                        <th class="cart__table--header__list text-center">Ảnh sản phẩm</th>
                                        <th class="cart__table--header__list text-center">Ngày yêu thích </th>
                                        <th class="cart__table--header__list text-right">ADD TO CART</th>
                                    </tr>
                                </thead>
                                <tbody class="cart__table--body">
                                    @foreach ($favorite as $item)

                                        <tr>
                                            <td>
                                                <form action="{{route('deleteFavorite',$item->id)}}" method="post">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button class="cart__remove--btn" aria-label="search button" type="submit"><svg fill="currentColor" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" width="16px" height="16px"><path d="M 4.7070312 3.2929688 L 3.2929688 4.7070312 L 10.585938 12 L 3.2929688 19.292969 L 4.7070312 20.707031 L 12 13.414062 L 19.292969 20.707031 L 20.707031 19.292969 L 13.414062 12 L 20.707031 4.7070312 L 19.292969 3.2929688 L 12 10.585938 L 4.7070312 3.2929688 z"/></svg></button>
                                                </form>

                                            </td>
                                            <td scope='row'>{{ $loop->index + 1 }}</td>
                                            <td>
                                                <a href="productDetail">
                                                    {{ $item->product->name }}

                                                </a>
                                            </td>
                                            <td>{{ number_format($item->product->base_price, 0, ',', '.' ) }} VND</td>
                                            <td>
                                                <img src="{{Storage::url($item->product->img_thumbnail)}}" alt="" width="150" height="150">
                                            </td>
                                            <td >{{$item->created_at->format('d/m/Y')}}</td>
                                            <td class="cart__table--body__list text-right">
                                                <a class="wishlist__cart--btn primary__btn" href="cart.html">Add To Cart</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="continue__shopping d-flex justify-content-between">
                                <a class="continue__shopping--link" href="index.html">Continue shopping</a>
                                <a class="continue__shopping--clear" href="shop.html">View All Products</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- cart section end -->

            <!-- Start product section -->

            <!-- End brand logo section -->
    </main>
@endsection
