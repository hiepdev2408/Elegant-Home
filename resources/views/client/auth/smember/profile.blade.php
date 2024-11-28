@extends('client.layouts.master')

@section('title')
    Thông tin tài khoản
@endsection

@section('home', 'active')

@section('content')
    <div class="container mt-3 mb-5">
        <div class="row">
            @include('client.auth.layouts.master')
            <section class="col-9 ms-5">
                <div class="d-flex justify-content-center">
                    <img src="https://static-smember.cellphones.com.vn/smember/_nuxt/img/Shipper_CPS3.77d4065.png"
                        width="120px">

                </div>

                @if (Auth::check())
                    <h4 class="text-center">{{ Auth::user()->name }}</h4>
                    <p class="text-center">{{ Auth::user()->phone }}</p>
                    <div class="d-flex justify-content-center">
                        <p class="badge text-bg-primary">SNULL</p>
                    </div>
                @endif
                <div class="mb-3">
                    <div class="alert alert-info">
                        <i class="fa-solid fa-circle-info me-1"></i> Đăng ký S-Student để nhận thêm ưu đãi tới 500k/sản
                        phẩm.
                        <button class="btn btn-sm btn-primary float-end" style="margin-top: -4px">Đăng ký ngay</button>
                    </div>
                    <div class="alert alert-info">
                        <i class="fa-solid fa-circle-info me-1"></i> Cập nhật thông tin cá nhân và địa
                        chỉ để có trải nghiệm đặt
                        hàng
                        nhanh và thuận tiện hơn.
                        <button class="btn btn-sm btn-primary float-end" style="margin-top: -4px">Cập nhật</button>
                    </div>
                </div>
                <div class="box-shadows">
                    <div class="smember">
                        <div class="date">
                            <h6>Ngày Tham Gia</h6>
                            <i class="fa-regular fa-calendar-check"></i>
                            <h6>{{ Auth::user()->created_at->format('d/m/Y') }}
                            </h6>
                        </div>
                        <div class="member_class">
                            <h6>Hạng Thành Viên</h6>
                            <i class="fa-solid fa-medal"></i>
                            <h6>SNULL</h6>
                        </div>
                        <div class="member_class">
                            <h6>Lịch sửa mua hàng</h6>
                            <a href="{{ route('profile.order') }}"> <i class="fas fa-history"></i> </a>
                            <h6>0Đ</h6>
                        </div>
                        <div class="point">
                            <h6>Điểm Tích Lũy</h6>
                            <i class="fa-regular fa-sun"></i>
                            <h6>0</h6>
                        </div>
                        <div class="point">
                            <h6>Sổ địa chỉ</h6>
                            <i class="fa-solid fa-location-dot"></i>
                            <h6>Chưa cập nhật</h6>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
