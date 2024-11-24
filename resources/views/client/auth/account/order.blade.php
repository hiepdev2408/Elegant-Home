<style>
    .child {
        width: 250px;
        margin: 10px;
        padding: 15px;
        cursor: pointer;
    }

    .child a {
        margin-left: 10px;
        text-decoration: none;
        color: #080808;
        font-size: 1em;
        font-weight: bold;
    }

    .child a:hover {
        color: rgb(38, 0, 253);
    }

    .child li {
        list-style: none;
        display: inline-block;
    }

    .child .active {
        color: rgb(255, 21, 0);
    }

    .product_rights {
        float: left;
        border-radius: 10px;
        width: 230px;
        box-shadow: 0 1px 2px 0 rgba(60, 64, 67, .1), 0 2px 6px 2px rgba(60, 64, 67, .15);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th,
    td {
        padding: 12px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #4CAF50;
        color: white;
    }

    tr:hover {
        background-color: #f5f5f5;
    }

    .product_rightst th {
        text-align: center;
    }

    .bold {
        font-weight: bold;
        color: red;
        cursor: pointer;
    }

    .product_rightst .btn {
        border-radius: 5px;
    }

    .product_rights .active {
        color: red;
    }

    .active {
        color: red;
    }
</style>
@extends('client.layouts.master')
@section('content')
    <section style="padding:30px;">
        <div class="row">
            <div class="col-2">
                <nav class="product_rights">
                    <div class="child">
                        <i class="fa-solid fa-house-chimney"></i>
                        <li><a href="{{ route('profile.user') }}">Trang Chủ</a></li>
                    </div>
                    <div class="child">
                        {{-- <i class="fa-solid fa-cart-arrow-down"></i> --}}
                        <li><a href="" class="active">Đơn hàng</a></li>
                    </div>
                    <div class="child">
                        {{-- <i class="fa-solid fa-user-shield"></i> --}}
                        <li> <a href="">Tài khoản của bạn</a></li>
                    </div>
                    <div class="child">
                        {{-- <i class="fa-solid fa-recycle"></i> --}}
                        <li> <a href="">Cập Nhật Thông Tin</a></li>
                    </div>
                </nav>
            </div>
            <div class="col-10">
                <div class="product_rightst">
                    <main>
                        <table>
                            <thead>
                                <tr>
                                    <th>Mã_ĐH</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số Lượng</th>
                                    <th>Tổng giá</th>
                                    <th>Sửa đơn hàng</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </main>
                </div>
            </div>
    </section>
@endsection
