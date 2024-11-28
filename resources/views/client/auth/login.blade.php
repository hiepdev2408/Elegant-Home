@extends('client.layouts.master')
@section('title')
    Login
@endsection
@section('content')
    <!-- Register Section -->
    <div class="register-section mt-5">
        <div class="auto-container">
            <div class="inner-container">
                <div class="row clearfix">
                    <!-- Column -->
                    <div class="column col-lg-12 col-md-12 col-sm-12">
                        <style>
                            .alert {
                                padding: 15px;
                                margin: 20px 0;
                                border: 1px solid transparent;
                                border-radius: 4px;
                            }

                            .alert-red {
                                color: #cd2228;
                                background-color: #e1aeb9;
                                border-color: #c3e6cb;
                            }

                            .fw-bold {
                                font-weight: bold;
                            }

                            .text-danger {
                                color: red;
                                font-weight: bold;
                            }
                        </style>
                        <!-- Login Form -->
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
                        <div class="text-center mb-4">
                            <img src="https://account.cellphones.com.vn/_nuxt/img/Shipper_CPS3.77d4065.png" width="150px">
                        </div>
                        <div class="d-flex justify-content-center">
                            <form class="w-50" action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ old('email') }}" placeholder="Enter Email Address">
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Password">
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 d-flex">
                                    <div class="col-sm-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember-password"
                                                id="remember-password">
                                            <label class="form-check-label" for="remember-password">Remember Me?</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 text-end mt-3">
                                        <a href="{{ route('password.request') }}" class="form-label">Quên mật khẩu</a>
                                    </div>
                                </div>

                                <div class="mb-3 text-center">
                                    <button type="submit" class="btn btn-primary  w-100">Login</button>
                                </div>
                            </form>

                        </div>

<<<<<<< HEAD
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" value="" placeholder="Create password">
                            </div>
                            <div class="form-group row container-fluid">
                                <div class="check-box col-sm-6 ">
                                    <input type="checkbox" name="remember-password" id="type-2">
                                    <label for="type-2">Remember Me?</label>
                                </div>
                                <div class="col-sm-6">

                                    <label for="type-2"><a href="{{route('password.request')}}">Quên mật khẩu</a></label>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="theme-btn btn-style-one">
                                    Login here
                                </button>
                            </div>
                        </form>
                        <div class="form-group">
                            <label for="type-2">Bạn chưa có tài khoản ?</label>

                            <button type="submit" class="theme-btn btn-style-one">
                               <a href="{{route('register')}}">Register</a>
                            </button>
=======
                        <div class="mb-5 text-center">
                            <label for="register" class="form-label">Bạn chưa có tài khoản?</label>
                            <a href="{{ route('auth.register') }}">Register</a>
                        </div>
>>>>>>> fb11c8b095388d6e51c66ca83d91c9e5d5da6681
                    </div>
                </div>
            </div>
        </div>
    @endsection
