{{-- <h3>
    {{ $account->name }}
    <p>
        Bạn vừa đăng ký tài khoản bên shop elegant-home của chúng tôi
    </p>
    <p>
        <a href="{{ route('veryfy', $account->email) }}">Nhấn vào đây để xác nhận tài khoản</a>
    </p>
</h3> --}}


@extends('client.layouts.master')
@section('title')
@endsection
@section('content')
    <div class="login__section section--padding ">
        <div class="container">

            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="login__section--inner">
                    <div class="row row-cols-md-2 row-cols-1">
                        <div class="row">
                            <img src="https://noithatgiarehanoi.com/wp-content/uploads/2021/07/banner-11-1024x339.jpg"
                                alt="">
                        </div>
                        <div class="account__login register">
                            <div class="account__login--header mb-25">
                                <h3 class="account__login--header__title mb-10">Quên mật khẩu</h3>
                                <p class="account__login--header__desc">Nhập email tại đây </p>
                            </div>
                            @if (session('status'))
                            <h4 class="text-danger">{{ session('status') }}</h4>
                        @endif
                            <div class="account__login--inner">

                                <label>
                                    <input class="account__login--input" name="email" placeholder="Địa chỉ email"
                                        type="text" required>
                                    @error('email')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </label>



                                <label>
                                    <button class="account__login--btn primary__btn mb-10" type="submit">Gửi đi</button>
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
