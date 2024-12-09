@extends('client.layouts.master')
@section('title')
    Register
@endsection
@section('content')
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic d-flex justify-items-center align-items-center">
                    <div class="team">
                        <img src="{{ asset('themes') }}/clients/images/auth/team.jpg">
                    </div>
                </div>
                <form action="{{ route('register') }}" method="post" class="login100-form validate-form">
                    @csrf
                    <span class="login100-form-title">
                        <b>ĐĂNG KÝ TÀI KHOẢN</b>
                    </span>
                    <form action="#">
                        <div class="wrap-input100 validate-input">
                            <input class="input100" type="text" name="name" id="name" placeholder="Tên của bạn"
                                value="{{ old('name') }}">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class='bx bx-user'></i>
                            </span>
                        </div>

                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <div class="wrap-input100 validate-input">
                            <input class="input100" type="text" name="phone" id="phone" placeholder="Số điện thoại"
                                value="{{ old('phone') }}">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class='bx bx-phone'></i>
                            </span>
                        </div>

                        @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <div class="wrap-input100 validate-input">
                            <input class="input100" type="text" name="address" id="address" placeholder="Địa chỉ"
                                value="{{ old('address') }}">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class='bx bx-current-location'></i>
                            </span>
                        </div>

                        @error('address')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

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
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="container-login100-form-btn">
                            <input type="submit" value="Đăng Ký">
                        </div>
                        <div class="text-right p-t-12 mt-1">
                            Bạn đã có tài khoản?
                            <a class="txt3" href="{{ route('auth.login') }}">
                                Đăng Nhập
                            </a>
                        </div>
                    </form>
                    <div class="text-center p-t-70 txt2 mt-1">
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
