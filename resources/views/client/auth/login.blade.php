@extends('client.layouts.master')
@section('content')
<section class="page-title">
    <div class="auto-container">
        <h2>Login Page</h2>
        <ul class="bread-crumb clearfix">
            <li><a href="index.html">Home</a></li>
            <li>Pages</li>
            <li>Register</li>
        </ul>
    </div>
</section>
<!-- End Page Title -->

<!-- Register Section -->
<div class="register-section">
    <div class="auto-container">
        <div class="inner-container">
            <div class="row clearfix">
                <!-- Column -->
                {{-- <div class="column col-lg-6 col-md-12 col-sm-12">
                    <!-- Login Form -->
                    <div class="styled-form">
                        <h4>Sign Up</h4>
                        <form method="post" action="https://html.themexriver.com/bloxic/index.html">
                            <div class="form-group">
                                <label>Your Name</label>
                                <input type="text" name="username" value="" placeholder="Enter your name*" required>
                            </div>
                            <div class="form-group">
                                <label>Email address</label>
                                <input type="email" name="emaill" value="" placeholder="Enter Email Adress" required>
                            </div>
                            <div class="form-group">
                                <label>New Password</label>
                                <input type="password" name="password" value="" placeholder="Create password" required>
                            </div>
                            <div class="form-group">
                                <div class="check-box">
                                    <input type="checkbox" name="remember-password" id="type-1">
                                    <label for="type-1">I agree to al <a href="#">Terms</a> & <a href="#">Condition</a> and Feeds</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="button" class="theme-btn btn-style-one">
                                    Sign Up
                                </button>
                            </div>
                        </form>
                    </div>
                </div> --}}
                <!-- Column -->
                <div class="column col-lg-6 col-md-12 col-sm-12">
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
                    <div class="styled-form">
                        <h4>Login here</h4>
                        <form action="{{ route('login.submit') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Email address</label>
                                <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter Email Adress">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>New Password</label>
                                <input type="password" name="password" value="" placeholder="Create password">
                            </div>
                            <div class="form-group">
                                <div class="check-box">
                                    <input type="checkbox" name="remember-password" id="type-2">
                                    <label for="type-2">Remember Me?</label>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
