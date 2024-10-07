@extends('client.layouts.master')
@section('title')
@endsection
@section('content')
    <div class="login__section section--padding">
        <div class="container">
            <form action=" {{ route('register.submit') }} " method="POST">
                @csrf
                <div class="login__section--inner">
                    <div class="row row-cols-md-2 row-cols-1">

                        <div class="row">
                            <img src="https://datacare.vn/wp-content/uploads/2020/12/Banner-Noi-That-TR1112202002.jpg"
                                alt="">
                        </div>
                        <div class="account__login register">
                            <div class="account__login--header mb-25">
                                <h3 class="account__login--header__title mb-10">Đăng Ký Tài Khoản</h3>
                                <p class="account__login--header__desc">Đăng ký tại đây nếu bạn là khách hàng mới</p>
                            </div>
                            <div class="account__login--inner">
                                <label>
                                    <input class="account__login--input" name="name" placeholder="Username"
                                        type="text" value="{{ old('name') }}">
                                    @error('name')
                                        <span class="" style="color: red">{{ $message }}</span>
                                    @enderror
                                </label>

                                <label>
                                    <input class="account__login--input" name="email" placeholder="Địa chỉ email"
                                        type="text" value="{{ old('email') }}">
                                    @error('email')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </label>
                                <label>
                                    <input class="account__login--input" name="phone" placeholder="Số điện thoại"
                                        type="text" value="{{ old('phone') }}">
                                    @error('phone')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror

                                </label>
                                <label>
                                    <input class="account__login--input" name="address" placeholder="Địa chỉ" type="text"
                                        value="{{ old('address') }}">
                                    @error('address')
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
                                <label>
                                    <input class="account__login--input" name="config_password"
                                        placeholder="Nhập lại mật khẩu" type="password">
                                    @error('config_password')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </label>
                                <label>
                                    <button class="account__login--btn primary__btn mb-10" type="submit">Đăng Ký</button>
                                </label>
                                <div class="account__login--remember position__relative">
                                    <input class="checkout__checkbox--input" id="check2" type="checkbox">
                                    <span class="checkout__checkbox--checkmark"></span>
                                    <label class="checkout__checkbox--label login__remember--label" for="check2">
                                        Tôi đã đọc và đồng ý với các điều khoản và điều kiện</label>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
