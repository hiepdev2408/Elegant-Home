@extends('client.layouts.master')
@section('title')
@endsection
@section('content')
    <div class="login__section section--padding ">
        <div class="container">

            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                <div class="login__section--inner">
                    <div class="row row-cols-md-2 row-cols-1">
                        <div class="row">
                            <img src="https://noithatgiarehanoi.com/wp-content/uploads/2021/07/banner-11-1024x339.jpg"
                                alt="">
                        </div>
                        <div class="account__login register">
                            <div class="account__login--header mb-25">
                                <h3 class="account__login--header__title mb-10">Cập nhật lại mật khẩu</h3>
                                
                            </div>
                            @if (session('status'))
                                <h4 class="text-danger">{{ session('status') }}</h4>
                            @endif
                            
                            <div class="account__login--inner">
                                <label>
                                    <input type="hidden" name="token" value="{{ $token }}">
                                </label>

                                <label>
                                    <input class="account__login--input" name="email" placeholder="Địa chỉ email"
                                        type="text" required>
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
                                <label>
                                    <input class="account__login--input" name="password_confirmation" placeholder="Xác nhận mật khẩu"
                                        type="password">
                                    @error('password')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </label>
                                <br>
                                <label>
                                    <button class="account__login--btn primary__btn mb-10" type="submit">Đặt lại mật khẩu</button>
                                </label>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
