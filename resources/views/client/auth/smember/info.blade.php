@extends('client.layouts.master')
@section('title')
    Lịch sủ mua hàng
@endsection
@section('info', 'active')
@section('content')
    <div class="container mt-3 mb-5">
        <div class="row">
            @include('client.auth.layouts.master')
            <section class="col-9 ms-5">
                <div class="d-flex justify-content-center">
                    <img src="https://static-smember.cellphones.com.vn/smember/_nuxt/img/Shipper_CPS3.77d4065.png"
                        width="100px">
                </div>
                @if (Auth::check())
                    <h4 class="text-center">{{ Auth::user()->name }}</h4>
                @endif
                @if (session('success'))
                    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1050; margin-top: 55px">
                        <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Thành Công!</strong> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif
                <div class="d-flex justify-content-center">
                    <form action="{{ route('profile.update', Auth::user()->id) }}" class="col-6" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Họ và Tên</label>
                            <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Điện thoại</label>
                            <input type="tetx" class="form-control" name="phone" value="{{ Auth::user()->phone }}">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Địa chỉ</label>
                            <input type="text" class="form-control" name="address" value="{{ Auth::user()->address }}">
                        </div>
                        <div class="mb-3">
                            <label for="join" class="form-label">Ngày tham gia</label>
                            <input type="text" class="form-control"
                                value="{{ Auth::user()->created_at->format('d/m/Y') }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <a href="#" class="form-control d-flex justify-content-between align-items-center">Đổi mật
                                khẩu<i class="fa-solid fa-pen-to-square"></i></a>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Cập nhật thông tin</button>
                        </div>
                    </form>
                </div>

            </section>
        </div>
    </div>
@endsection
