@extends('client.layouts.master')
@section('title')
@endsection
@section('content')
    <div class="login__section section--padding ">
        <div class="container">

            <form action="{{ route('login.submit') }}" method="POST">
                @csrf
                <div class="login__section--inner">
                    <div class="row row-cols-md-2 row-cols-1">
                        <div class="row">
                            <img src="https://noithatgiarehanoi.com/wp-content/uploads/2021/07/banner-11-1024x339.jpg"
                                alt="">
                        </div>
                        <div class="account__login register">
                            <div class="account__login--header mb-25">
                                <h3 class="account__login--header__title mb-10">Đăng Nhận Tài Khoản</h3>
                                <p class="account__login--header__desc">Đăng nhập tại đây </p>
                            </div>
                            @if (session('messageError'))
                                <h4 class="text-danger">{{ session('messageError') }}</h4>
                            @endif
                            @if (session('status'))
                            <h4 class="text-danger">{{ session('status') }}</h4>
                        @endif
                            <div class="account__login--inner">

                                <label>
                                    <input class="account__login--input" name="email" placeholder="Địa chỉ email"
                                        type="text">
                                    @error('email')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </label>
                                <label>
                                    <input class="account__login--input" name="password" placeholder="Mật Khẩu"
                                        type="password">
                                    @error('password')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </label>
                                <div class="row">

                                        <div class="col-md-6 offset-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                                    {{ old('remember') ? 'checked' : '' }}>

                                                <label class="form-check-label" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                        </div>


                                        <div class="col-md-6 offset-md-4">
                                        <a href="{{route('password.request')}}">Quên mật khẩu</a>
                                        </div>

                                </div><br>
                                <label>
                                    <button class="account__login--btn primary__btn mb-10" type="submit">Đăng Nhập</button>
                                </label>
                                <label>
                                    <a class="account__login--btn success__btn" href="{{ route('register') }}">Đăng ký</a>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
