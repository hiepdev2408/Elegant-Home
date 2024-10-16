@extends('client.layouts.master')
@section('title')
    Thông tin tài khoản
@endsection
@section('content')
    <section style="padding:30px; ">
        <div class="row">
            <div class="col-6">
                <div class="sidebar">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('profile.user') }}">
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
                            <a class="nav-link active" href="{{ route('profile.show', $user->id) }}">
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
                                    style="width: 100px; border-radius: 15px">
                            @endif
                        </div>
                    </div>
                    @if (session()->has('success'))
                        <div class="alert alert-success fw-bold">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    <div class="smember_info">
                        <div class="form-group"style="margin-top: 10px">
                            <div class="group">
                                <label>Họ và Tên</label>
                            </div>
                            <input class="contact__form--input" type="text" name="name" value="{{ $user->name }}"
                                disabled>
                        </div>
                        <div class="form-group">
                            <div class="group">
                                <label>Email</label>
                            </div>
                            <input class="contact__form--input" type="text" name="email" value="{{ $user->email }}"
                                disabled>
                        </div>
                        <div class="form-group"style="margin-top: 10px">
                            <div class="group">
                                <label>Số điện thoại</label>
                            </div>
                            <input class="contact__form--input" type="text" name="phone" value="{{ $user->phone }}"
                                disabled>
                        </div>
                        <div class="form-group"style="margin-top: 10px">
                            <div class="group">
                                <label>Địa chỉ</label>
                            </div>
                            <input class="contact__form--input" type="text" name="address" value="{{ $user->address }}"
                                disabled>
                        </div>
                    </div>

                    <a href="{{ route('profile.edit', $user->id) }}" class="contact__form--btn primary__btn text-center"
                        style="margin-top: 10px">Cập
                        nhật thông tin</a>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('style-libs')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css">
    <style>
        .alert {
            padding: 10px;
            margin: 20px 0;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        .fw-bold {
            font-weight: bold;
        }

        .text-danger {
            color: red;
            font-weight: bold;
        }

        .conts {
            text-align: center;
        }

        .product_rightst {
            margin-top: -23px;
            padding: 25px;
            width: 100%;
            box-shadow: 0 1px 2px 0 rgba(60, 64, 67, .1), 0 2px 6px 2px rgba(60, 64, 67, .15);
            border-radius: 5px;
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
@section('script-libs')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
