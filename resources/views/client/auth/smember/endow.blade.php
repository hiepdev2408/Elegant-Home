@extends('client.layouts.master')
@section('title')
    Ưu đãi của bạn
@endsection
@section('endow', 'active')
@section('content')
    <div class="container mt-3 mb-5">
        <div class="row">
            @include('client.auth.layouts.master')
            <section class="col-9 ms-5">
                <div class="d-flex">
                    <div class="h-50 p-3 me-3" style="border: 1px solid red; border-radius: 50%">
                        <img src="https://cdn2.cellphones.com.vn/50x50,webp,q100/media/wysiwyg/Shipper_CPS3_1.png"
                            alt="" height="50px">
                    </div>
                    <div class="d-grid">
                        @if (Auth::check())
                            <h4>{{ Auth::user()->name }}</h4>
                            <small class="badge text-bg-primary w-25">SNULL</small>
                            <p class="w-100">Tích lũy xét hạng: 0đ</p>
                        @endif
                    </div>
                </div>
                <div class="headers">
                    <div class="text-center d-flex justify-content-between gap-3">
                        <button class="btn btn-info w-100">Ưu đãi SMember</button>
                        <button class="btn btn-info w-100">Quà của bạn</button>
                    </div>

                </div>

                <div class="container">
                    <!-- Main title -->
                    <div class="main-title">
                        <span>⭐ CẬP NHẬT ƯU ĐÃI HẠNG THÀNH VIÊN SMEMBER ⭐</span>
                    </div>

                    <!-- Member options -->
                    <div class="member-options">
                        <div class="member-option">
                            <img src="https://cdn2.cellphones.com.vn/100x100,webp,q100/media/wysiwyg/S-Stu.png"
                                alt="S-Student">
                            <span>S-STUDENT</span>
                            <input type="radio" name="member" value="student">
                        </div>
                        <div class="member-option">
                            <img src="https://cdn2.cellphones.com.vn/100x100,webp,q100/media/wysiwyg/S-VIP.png"
                                alt="S-VIP">
                            <span>S-VIP</span>
                            <input type="radio" name="member" value="vip">
                        </div>
                        <div class="member-option">
                            <img src="https://cdn2.cellphones.com.vn/100x100,webp,q100/media/wysiwyg/S-MEM.png"
                                alt="S-Mem">
                            <span>S-MEM</span>
                            <input type="radio" name="member" value="mem">
                        </div>
                        <div class="member-option">
                            <img src="https://cdn2.cellphones.com.vn/100x100,webp,q100/media/wysiwyg/S-NEW.png"
                                alt="S-New">
                            <span>S-NEW</span>
                            <input type="radio" name="member" value="new">
                        </div>
                    </div>

                    <!-- Conditions -->
                    <div class="conditions">
                        <div class="conditions-title">ĐIỀU KIỆN</div>
                        <div class="conditions-content">
                            Học sinh THPT và Sinh viên Đại học, Cao Đẳng đang theo học tại các trường trên toàn quốc <br>
                            Đăng ký nhập hội S-Student siêu nhanh <a href="#">TẠI ĐÂY</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
