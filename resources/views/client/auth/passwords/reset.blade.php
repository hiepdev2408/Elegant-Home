@extends('client.layouts.master')
@section('title')
    Reset password
@endsection
@section('content')
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
                <form action="{{ route('password.update') }}" method="post" class="login100-form validate-form">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <span class="login100-form-title">
                        <b>QUÊN MẬT KHẨU</b>
                    </span>
                    <form action="#">
                        <div class="wrap-input100 validate-input mt-3">
                            <input class="input100" type="email" name="email" id="email" placeholder="Email"
                                value="{{ request('email') }}">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class='bx bx-envelope'></i>
                            </span>
                        </div>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

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
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <div class="wrap-input100 validate-input">
                            <input autocomplete="off" class="input100 hidden-show" type="password"
                                name="password_confirmation" id="password_confirmation" placeholder="Nhập lại mật khẩu">
                            <span class="bx fa-fw bx-hide field-icon eye-hidden"></span>
                            <span class="bx bx-show field-icon eye-show hidden"></span>
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class='bx bx-key'></i>
                            </span>
                        </div>

                        @error('password_confirmation')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <div class="container-login100-form-btn">
                            <input type="submit" value="Gửi">
                        </div>
                    </form>
                    <div class="text-center p-t-70 txt2 mt-4">
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
