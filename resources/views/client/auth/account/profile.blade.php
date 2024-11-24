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

                <div class="box-shadows">
                    <div class="smember">
                        <div class="date">
                            <h6>Ngày Tham Gia</h6>
                            <i class="fa-regular fa-calendar-check"></i>
                            <h6>12/10/2023</h6>
                        </div>
                        <div class="member_class">
                            <h6>Hạng Thành Viên</h6>
                            <i class="fa-solid fa-medal"></i>
                            <h6>Null</h6>
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
