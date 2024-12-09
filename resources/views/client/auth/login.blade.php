@extends('client.layouts.master')
@section('title')
    Đăng Nhập
@endsection
@section('content')
    @if (session()->has('erorr'))
        <div class="alert alert-red fw-bold">
            {{ session()->get('erorr') }}
        </div>
    @endif
    @if (session()->has('ok'))
        <div class="alert alert-success fw-bold">
            {{ session()->get('ok') }}
        </div>
    @endif
    @if (session()->has('oke'))
        <div class="alert alert-primary">
            {{ session()->get('oke') }}
        </div>
    @endif
    @if (session()->has('messageError'))
        <div class="alert alert-red fw-bold">
            {{ session()->get('messageError') }}
        </div>
    @endif
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="limiter">
        <div class="container-login90">
            <div class="wrap-login100s">
                <div class="login100-pic d-flex justify-items-center align-items-center">
                    <div>
                        <img src="{{ asset('themes') }}/clients/images/auth/team.jpg">
                    </div>
                </div>
                <form action="{{ route('login') }}" method="post" class="login100-form validate-form">
                    @csrf
                    <span class="login100-form-title">
                        <b>ĐĂNG NHẬP HỆ THỐNG</b>
                    </span>
                    <form action="#">
                        <div class="wrap-input100 validate-input">
                            <input class="input100" type="email" name="email" id="email" placeholder="Email"
                                value="{{ old('email') }}">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class='bx bx-envelope'></i>
                            </span>

                        </div>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <p id="errorUsername"></p>
                        <div class="wrap-input100 validate-input">
                            <input autocomplete="off" class="input100 hidden-show" type="password" name="password"
                                id="password" placeholder="Mật khẩu">
                            <span class="bx fa-fw bx-hide field-icon eye-hidden"></span>
                            <span class="bx bx-show field-icon eye-show hidden"></span>
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class='bx bx-key'></i>
                            </span>
                        </div>
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <p id="errorPassword"></p>
                        <div class="container-login100-form-btn">
                            <input type="submit" value="Đăng Nhập">
                        </div>
                        <div class="text-left p-t-12 mt-1">
                            Bạn chưa có tài khoản?
                            <a class="txt3" href="{{ route('auth.register') }}">
                                Đăng ký
                            </a>
                        </div>
                        <div class="text-right p-t-12 mt-1">
                            <a class="txt2" href="{{ route('password.request') }}">
                                Bạn quên mật khẩu?
                            </a>
                        </div>
                    </form>
                    <div class="text-center p-t-70 txt2 mt-5">
                        Phần mềm quản lý bán hàng <i class="fa fa-copyright" aria-hidden="true"></i>
                        <script type="text/javascript">
                            document.write(new Date().getFullYear());
                        </script> code bởi Elegant
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('style-libs')
    <link rel="stylesheet" href="{{ asset('themes') }}/clients/css/auth.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
@endsection
@section('script-libs')
    <script src="{{ asset('themes') }}/clients/js/auth.js"></script>
@endsection
