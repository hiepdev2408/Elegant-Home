@extends('client.layouts.master')
@section('title')
    Thông tin cá nhân
@endsection
@section('content')
    <section style="padding:30px; ">
        <div class="row">
            <div class="col-6">
                <div class="sidebar">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('profile.user') }}">
                                <i class="bi bi-house"></i> Trang chủ
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-journal-text"></i> Lịch sử mua hàng
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-award"></i> Hạng thành viên
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('profile.show', $user->id) }}">
                                <i class="bi bi-person"></i> Tài khoản của bạn
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('profile.edit', $user->id) }}">
                                <i class="bi bi-person"></i> Cập nhật thông tin
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-headset"></i> Hỗ trợ
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-5">
                <div class="product_rightst">
                    <div class="conts">
                        <div class="image_user">
                            @if ($user->avatar)
                                <img src="{{ Storage::url($user->avatar) }}" alt="Avatar"
                                    style="width: 130px; border-radius: 15px">
                            @endif
                        </div>

                        @if ($idf = 1)
                            <h4>Xin Chào</h4>
                            <h3> {{ $user->name }}</h3>
                        @else
                            <h4>Xin Chào</h4>
                        @endif

                    </div>
                    <div class="smember">
                        <div class="date">
                            <h5>Ngày Tham Gia</h5>
                            <i class="bi bi-calendar-check-fill"></i>
                            <h6>12/10/2023</h6>
                        </div>
                        <div class="member_class">
                            <h5>Hạng Thành Viên</h5>
                            <i class="bi bi-award-fill"></i>
                            <h6>Null</h6>
                        </div>
                        <div class="point">
                            <h5>Điểm Tích Lũy</h5>
                            <i class="bi bi-gear-wide-connected"></i>
                            <h6>0</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('style-libs')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css">
    <style>
        .conts {
            text-align: center;
        }

        .conts h4 {
            text-align: center;
            font-size: 17px;
        }

        .smember {
            display: flex;
            justify-content: center;
            align-items: center
        }

        .date,
        .member_class,
        .point {
            text-align: center;
            font-size: 18px;
            padding: 15px;
        }

        .smember i {
            margin-top: 10px;
            font-size: 25px;
            color: red;
        }

        .smember h6 {
            margin-top: 12px;
            font-size: 15px;
        }

        .product_rightst {
            padding: 10px;
            width: 100%;
            box-shadow: 0 1px 2px 0 rgba(60, 64, 67, .1), 0 2px 6px 2px rgba(60, 64, 67, .15);
            border-radius: 5px;
        }

        .image_user img {
            width: 70px;
            margin-top: 10px;
            z-index: 0;
        }

        .sidebar {
            width: 270px;
            background-color: #f8f9fa;
            padding: 20px;
            position: fixed;
            top: 72px;
            left: 170px;
            height: 150px;
        }

        .nav-link {
            color: #333;
            font-size: 16px;
            padding: 13px 15px;
            display: flex;
            align-items: center;
            margin-bottom: 8px;
        }

        .nav-link i {
            margin-right: 10px;
            margin-top: -3px;
            font-size: 20px;
        }

        .nav-link.active {
            border-radius: 7px;
            border: 1px solid;
            background-color: #ffe6e6;
            color: red;
        }

        .nav-link:hover {
            color: red;
        }

        .badge {
            margin-left: auto;
        }
    </style>
@endsection
